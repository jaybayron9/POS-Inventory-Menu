<?php 

class Menu extends Connection {

    public function products_menu($column) {
        return parent::$conn->query("SELECT * FROM products where category = '{$column}' ORDER BY CAST(price AS UNSIGNED) ASC");
    }

    public function print_receipt() {
        // Set session to this data to generate receipt
        $_SESSION['total'] = $_POST['total'];
        $_SESSION['data'] = $_POST['data'];
        $_SESSION['customer'] = $_POST['customer'];
        $_SESSION['service'] = $_POST['service'];
        $_SESSION['payment_amount'] = $_POST['payment_amount'];
        $_SESSION['payment_change'] = $_POST['payment_change'];
        $_SESSION['note'] = $_POST['note'];
        $_SESSION['discount'] = $_POST['discount'];
        $_SESSION['invoice_no'] = rand(1, 999);

        return parent::alert('success', '');
    }

    public function save() {
        $name = "";
        $price = "";
        $quantity = "";

        foreach ($_SESSION['data'] as $value) {
            $name .= $value['name'] . ', ';
            $price .= $value['price'] . ', ';
            $quantity .= $value['quantity'] . ', ';
        }

        $_SESSION['success'] = 'Order Placed';
        $_SESSION['notif'] = 'bell';

        $no = parent::$conn->query("SELECT * FROM orders WHERE invoice_no = '{$_SESSION['invoice_no']}'");
        if ($no->num_rows > 0) {
            $_SESSION['invoice_no'] = rand(1, 999);
        }

        $discount = floatval($_SESSION['total']) * floatval($_SESSION['discount']) / 100;

        $grandtotal = floatval($_SESSION['total']) - abs($discount);

        $save = parent::$conn->query("INSERT INTO orders (
            customer, name, price, quantity, total, total_discount, discount, service, invoice_no, note
        ) VALUES (
            '{$_SESSION['customer']}', '{$name}', '{$price}', '{$quantity}', '{$_SESSION['total']}', '{$grandtotal}', '{$discount}', '{$_SESSION['service']}', '{$_SESSION['invoice_no']}', '{$_SESSION['note']}'
        )");

        if ($save) {
            foreach ($_SESSION['data'] as $sub_array) {
                $prices = parent::$conn->query("select * from products");
    
                foreach ($prices as $price) {
                    if ($sub_array['name'] == $price['name']) {
                        $newsale = (int)$price['sale'] + (int)$sub_array['price'];
                        
                        parent::$conn->query("
                            update products 
                            set 
                                sale = '{$newsale}' 
                            where 
                                name = '{$sub_array['name']}'
                        ");
                    }
                }
            }
            self::unset_orders();
            return parent::alert('success', 'Order placed.');
        }
    }

    public function unset_orders() {
        unset($_SESSION['data']);
        unset($_SESSION['total']);
        unset($_SESSION['service']);
        unset($_SESSION['payment_amount']);
        unset($_SESSION['payment_change']);
        unset($_SESSION['discount']);
        unset($_SESSION['invoice_no']);
    }

    public function cancel_orders() {
        $query = parent::$conn->query("DELETE FROM orders WHERE order_id = '{$_POST['order_id']}'");

        if ($query) {
            return parent::alert('success', 'Order canceled.');
        } 
        return parent::alert('failed', 'There\'s a problem.');
    }

    public function unset_session()
    {
        unset($_SESSION['success']);
    }

    public function orders()
    {
        return parent::$conn->query("select * from orders where status like '' order by create_at");
    }

    public function check_order() {
        $query = parent::$conn->query("select count(*) as count from orders where status like ''");
        foreach ($query as  $row) {
            if ($row['count'] == '0') {
                return true;
            }
            return false;
        }
    }

    public function up_order()
    {
        $result = parent::$conn->query(
            "update orders 
                    set 
                        status = 'served' 
                    where 
                        order_id = '{$_POST['order_id']}'"
        );

        if ($result) {
            return parent::alert('success', 'Order served');
        }

        return parent::alert('failed', 'There\'s a problem.');
    }

    public function add_product()
    {
        $newImage = parent::photo();
        if ($newImage) {
            $query =
            "insert into products (
                    name, price, picture, status, category, description
                ) values (
                    ?, ?, ?, 'Available', ?, ?
                )";
            $stmt = parent::$conn->prepare($query);
            $stmt->bind_param("sssss", $_POST['product'], $_POST['price'], $newImage, $_POST['category'], $_POST['description']);
            $stmt->execute();

            return parent::alert('success', 'Product added.');
        } else {
            $query = "insert into products (
                    name, price, status, category,  description
                ) values (
                    ?, ?, 'Available', ?, ?
                )";
            $stmt = parent::$conn->prepare($query);
            $stmt->bind_param("ssss", $_POST['product'], $_POST['price'], $_POST['category'] , $_POST['description']);
            $stmt->execute();
            // $_SESSION['failed'] = 'Unable to save';
            return parent::alert('success', '');
        }
    }

    public function data_product() 
    {
        $query = parent::$conn->query("select * from products where product_id = '{$_POST['id']}'");
        foreach ($query as $row) {
            if($row['picture'] == null) {
                $row['picture'] == 'default.jpg';
            }
            echo json_encode($row);
        }
    }

    public function update_product() {
        $newImage = parent::photo();
        if ($newImage) {
            self::del_photo('products', 'product_id', $_POST['id']);

            $query = parent::$conn->query("update products
                set
                    name = '{$_POST['product']}', 
                    price = '{$_POST['price']}',
                    category = '{$_POST['category']}',
                    picture = '{$newImage}',
                    description = '{$_POST['description']}'
                where 
                    product_id = '{$_POST['id']}'
            ");
        } else {
            $query = parent::$conn->query("
                update products 
                set
                    name = '{$_POST['product']}', 
                    price = '{$_POST['price']}',
                    category = '{$_POST['category']}',
                    description = '{$_POST['description']}'
                where 
                    product_id = {$_POST['id']}
            ");
        }

        return parent::alert('success', 'Product updated.');
    }

    public function delete($table, $column, $id) {
        parent::del_photo($table, $column, $id);
        $query = parent::$conn->query("delete from {$table} where {$column} = '{$id}'");

        if ($query) {
            return parent::alert('success', 'Product deleted.');
        }
        return parent::alert('error', 'Product can\'t be deleted.');
    }

    public function up_status_meal() {
        $query = parent::$conn->query("
            update products 
            set 
                status = '{$_POST['status']}' 
            where product_id = '{$_POST['id']}'
        ");

        if ($query) {
            return parent::alert('success', 'Status updated.');
        }
    }

    public function total_product_sale() {
        $result = parent::$conn->query("
            SELECT name, sale FROM products ORDER BY sale DESC LIMIT 1
        ");
        foreach($result as $row){
            return array(
                'name' => $row['name'],
                'sale' => $row['sale']
            );        
        }
    }

    public function total_sale() {
        $result = parent::$conn->query("
            SELECT SUM(total_discount) AS total_price FROM orders
        ");
        foreach($result as $row){
            return floatval($row['total_price']);
        }
    }

    public function notif_orders() {
        if (isset($_POST['view'])) {
            if ($_POST["view"] != '') {
                parent::$conn->query("UPDATE orders SET order_seen = 1 WHERE order_seen=0");
            }

            $seen = parent::$conn->query("select * from orders where order_seen = '0'");
            $count = mysqli_num_rows($seen);
            $data = array(
                'unseen_notification' => $count,
            );
            echo json_encode($data);
        }
    }

    public function ring_notif() {
        if(isset($_SESSION['notif'])) {
            return parent::alert('success', '');
        }
    }

    public function pause_bell() {
        if(isset($_SESSION['notif'])) {
            unset($_SESSION['notif']);
            return parent::alert('success', '');
        }
    }

    public function reset_sale() {
        $sale = parent::$conn->query("update products set sale = '0'");
        return parent::alert('success', 'success');
    }

    public function find_order() {
        $reference = $_POST['reference'];
        $query = parent::$conn->query("
                SELECT * FROM orders 
                where 
                    (invoice_no = '{$reference}' or 
                    order_id = '{$reference}' or 
                    customer = '{$reference}') 
                    LIMIT 1
            ");

        if($query) {
            foreach ($query as $row) {
                $pname = explode(", ", $row['name']);
                $name = array_filter($pname);

                $pquantity  = array_map('intval', explode(", ", $row['quantity']));
                $quantity = array_filter($pquantity);

                $order_list = "";
                for ($i = 0; $i < count($name); $i++) {
                    $order_list .= "<div class='col-span-3 border-r border-gray-700 px-2 font-normal text-dark hover:bg-green-200 border-b border-gray-700 capitalize '>" . $name[$i] . "</div>";
                    $order_list .= "<div class='col-span-1 border-r border-gray-700 px-2 font-normal text-dark hover:bg-green-200 border-b border-gray-700 capitalize '>" . $quantity[$i] . "x</div>";
                }

                return json_encode(array(
                    'order_id' => $row['order_id'],
                    'invoice_no' => $row['invoice_no'],
                    'customer' => $row['customer'],
                    'ordered_list' => $order_list,
                    'total' => $row['total'],
                    'total_discount' => $row['total_discount'],
                    'status' => $row['status'],
                    'create_at' => date('F j, Y \a\t g:i A', strtotime($row['create_at'])),
                    'order_seen' => $row['order_seen'],
                ));
            }
        }
        return parent::alert('failed', 'No records.');
    }

    public function addons() {
        $name = ""; $price = ""; $quantity = "";
        foreach ($_POST['data'] as $value) {
            $count = parent::$conn->query("select count_update from orders where order_id = '{$_POST['order_id']}'");
            foreach ($count as $row) {
                
                    $c = '';
                    for ($i = 0; $i <= $row['count_update']; $i++) {
                        $c .= '+';
                    }
                    $name .= $c . $value['name'] . ', ';
                    $price .= $value['price'] . ', ';
                    $quantity .= $value['quantity'] . ', ';
            }
        }

        $getOrders = parent::$conn->query("select * from orders where order_id = '{$_POST['order_id']}'");

        if ($getOrders->num_rows > 0) {
            foreach ($getOrders as $row) {
                if ($row['status'] !== '') {
                    $addName = $name . $row['name'];
                    $newPrice = $price . $row['price'];
                    $newQuantity = $quantity . $row['quantity'] ;
                    $newTotal = $row['total'] + $_POST['total'];
                    $newTotalDiscount = $row['total_discount'] + $_POST['final_total'];
                    
                    foreach ($count as $row) {
                        $count_update = $row['count_update'] + 1;

                        $updateOrder = parent::$conn->query("
                            update orders
                            set
                                name = '{$addName}',
                                price = '{$newPrice}',
                                quantity = '{$newQuantity}',
                                total = '{$newTotal}',
                                total_discount = '{$newTotalDiscount}',
                                status = '',
                                order_seen = '0',
                                count_update = '{$count_update}'
                            where 
                                order_id = '{$_POST['order_id']}'
                        ");

                        foreach ($_POST['data'] as $sub_array) {
                            $prices = parent::$conn->query("select * from products");

                            foreach ($prices as $price) {
                                $name = str_replace('+', '', $sub_array['name']);
                                if ($name == $price['name']) {
                                    $newsale = (int)$price['sale'] + (int)$sub_array['price'];
                                    
                                    parent::$conn->query("
                                        update products 
                                        set 
                                            sale = '{$newsale}' 
                                        where 
                                            name = '{$sub_array['name']}'
                                    ");
                                }
                            }
                        }

                        if ($updateOrder) {
                            $_SESSION['success'] = 'Order Placed';
                            $_SESSION['notif'] = 'bell';
                            return parent::alert('success', 'Add Ons Added.');
                        }
                        return parent::alert("failed", "Unable to update order.");
                    }
                } 
                return parent::alert('failed', 'The customer\'s order is still being processed.');
            }
        }
    }
}

require_once('core/routes/menu-routes.php');