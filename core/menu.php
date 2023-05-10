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

        $payment_status = empty($_SESSION['payment_amount']) && $_SESSION['payment_amount'] == '' ? 'Unpaid' : 'Paid';
        
        if ($_SESSION['payment_amount'] > 0 && $_SESSION['payment_amount'] < $grandtotal) {
            $payment_status = 'Balance';
        }

        $save = parent::$conn->query("INSERT INTO orders (
            customer, name, price, quantity, total, total_discount, discount, service, invoice_no, note, payment_status, payment, pay_change
        ) VALUES (
            '{$_SESSION['customer']}', '{$name}', '{$price}', '{$quantity}', '{$_SESSION['total']}', '{$grandtotal}', '{$discount}', '{$_SESSION['service']}', '{$_SESSION['invoice_no']}', '{$_SESSION['note']}', '{$payment_status}', '{$_SESSION['payment_amount']}', '{$_SESSION['payment_change']}'
        )");

        if ($save) {
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

    public function unset_session() {
        unset($_SESSION['success']);
    }

    public function orders() {
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

    public function up_order() {
        $result = parent::$conn->query("
            update orders 
            set 
                status = 'served' 
            where 
                order_id = '{$_POST['order_id']}'
        ");

        if ($result) {
            $query = parent::$conn->query("SELECT * FROM orders WHERE order_id = '{$_POST['order_id']}'");
                foreach ($query as $row) {
                    $data = explode(', ', $row['name']);
                    $price = explode(', ', $row['price']);
                    $quantity = explode(', ', $row['quantity']);

                    for ($i = 0; $i < count($data); $i++) {
                        $prices = parent::$conn->query("select * from products");

                        foreach ($prices as $price) {
                            if ($data[$i] == $price['name']) {
                                $newSale = (int)$price['sale'] + ((int)$price['price'] * (int)$quantity[$i]);
                                $newQuantity = (int)$price['quantity'] - (int)$quantity[$i];
                                $newTotal = $price['price'] * $newQuantity;
                
                                parent::$conn->query("
                                    update products 
                                    set 
                                        sale = '{$newSale}',
                                        quantity = '{$newQuantity}',
                                        total = '{$newTotal}'
                                    where 
                                        name = '{$data[$i]}'
                                ");
                            }
                        }
                    }
                }

            return parent::alert('success', 'Order served');
        }

        return parent::alert('failed', 'There\'s a problem.');
    }

    public function add_product() {
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
        } else {
            $query = "insert into products (
                    name, price, status, category,  description
                ) values (
                    ?, ?, 'Available', ?, ?
                )";
            $stmt = parent::$conn->prepare($query);
            $stmt->bind_param("ssss", $_POST['product'], $_POST['price'], $_POST['category'] , $_POST['description']);
            $stmt->execute();
        }
        
        parent::$conn->query("update products set total = '{$_POST['price']}' * quantity");
        return parent::alert('success', 'Product added.');
    }

    public function data_product() {
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
                    product_id = '{$_POST['id']}'
            ");
        }

        parent::$conn->query("update products set total = '{$_POST['price']}' * quantity where  product_id = '{$_POST['id']}'");
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
        extract($_POST);
        $parts = explode("|", $reference);
        $parts = array_map('trim', $parts);
        $table = $parts[0];
        $invoice_no = $parts[1];
        $order_id = $parts[2];

        $query = parent::$conn->query("
                SELECT * FROM orders 
                WHERE 
                    customer = '{$table}' and
                    invoice_no = '{$invoice_no}' and
                    order_id = '{$order_id}' and
                    DATE(create_at) = CURDATE()
                LIMIT 1
            ");

        if($query->num_rows > 0) {
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
                    'status' => 'success',
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
        return parent::alert('failed', 'No record');
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
                return parent::alert('failed', 'The customer\'s order is currently being processed.');
            }
        }
    }

    public function in_out() {
        $get_quantity = parent::$conn->query("select * from products where product_id = '{$_POST['product_id']}'");

        foreach ($get_quantity as $row) {
            $new_quantity = $row['quantity'];

            if (isset($_POST['in'])) {
                $new_quantity = $row['quantity'] + $_POST['in'];

                parent::$conn->query("
                        insert into product_history 
                        set 
                            product_id = '{$_POST['product_id']}',
                            product_name = '{$row['name']}',
                            type = 'IN',
                            transaction_count = '{$_POST['in']}',
                            updated_quantity = '{$new_quantity}'
                    ");
                
                if ($new_quantity > 0) {
                    parent::$conn->query("
                        update products 
                        set 
                            status = 'Available'
                        where 
                            product_id = '{$_POST['product_id']}'
                    ");
                }
            } else {
                $new_quantity = $row['quantity'] - $_POST['out'];
                if ( $new_quantity < 0 ) {
                    return parent::alert('failed', 'Unable to update product quantity.');
                }

                if ($new_quantity == 0) {
                    parent::$conn->query("
                        update products 
                        set 
                            status = 'Unavailable'
                        where 
                            product_id = '{$_POST['product_id']}'
                    ");
                } 

                parent::$conn->query("
                        insert into product_history 
                        set 
                            product_id = '{$_POST['product_id']}',
                            product_name = '{$row['name']}',
                            type = 'OUT',
                            transaction_count = '{$_POST['out']}',
                            updated_quantity = '{$new_quantity}'
                    ");
            }

            $new_total = $row['price'] * $new_quantity;

            $update_product = parent::$conn->query("
                update products 
                set 
                    quantity = '{$new_quantity}',
                    total = '{$new_total}'
                where 
                    product_id = '{$_POST['product_id']}'
            ");
    
            if ($update_product) {
                return parent::alert('success', 'Product quantity updated.');
            }
            return parent::alert('failed', 'Unable to update product quantity.');
        }
    }

    public function product_history() {
        return parent::$conn->query("
                select * from product_history 
                JOIN products 
                ON product_history.product_id = products.product_id 
                order by created_at desc"
            );
    }

    public function reorder_product() {
        parent::$conn->query("
            update products
            set
                reorder_level = '{$_POST['reorder']}'
            where 
                product_id = '{$_POST['product_id']}'
        ");
    }

    public function delete_row() {
        if (empty($_POST['data']) || empty($_POST['data'][0])) {
            return parent::alert('error', 'Select at least one row to delt.');
        }

        foreach($_POST['data'] as $id) {
            parent::$conn->query("DELETE FROM products WHERE product_id = '{$id}'");
        }
        return parent::alert('success', 'Successfully deleted.');
    }

    public function delete_row_his() {
        if (empty($_POST['data']) || empty($_POST['data'][0])) {
            return parent::alert('error', 'Select at least one row to delt.');
        }

        foreach($_POST['data'] as $id) {
            parent::$conn->query("DELETE FROM product_history WHERE id = '{$id}'");
        }
        return parent::alert('success', 'Successfully deleted.');
    }

    public function product_report() {
        if (empty($_POST['product_ids']) || empty($_POST['product_ids'][0])) {
            return parent::alert('error', 'Select at least one row(s).');
        }

        $_SESSION['product_id'] = $_POST['product_ids'];
        $_SESSION['category'] = $_POST['category'];

        return parent::alert('success', '');
    }

    public function product_table($id) {
        return parent::$conn->query("
            select * from products 
            where product_id = '{$id}'"
        );
    }

    public function update_sale() {
        parent::$conn->query("update products set total = price * quantity");
        parent::$conn->query("UPDATE products SET status = 'Unavailable' WHERE quantity < 1");
        parent::$conn->query("UPDATE products SET status = 'Available' WHERE quantity > 0");
    }

    public function checkProductQuantity() {
        $get_quantity = parent::$conn->query("select quantity from products where product_id = '{$_POST['p_id']}'");
        foreach ($get_quantity as $row) {
            if ($_POST['p_quantity'] >= $row['quantity']) {
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    public function tableAddons() {
        return parent::$conn->query("
            SELECT * FROM orders
            ORDER BY ABS(TIMESTAMPDIFF(SECOND, create_at, NOW())) 
            LIMIT 50
        ");
    }

    public function remove_pict() {
        $get_pict = parent::$conn->query("select * from products where product_id = '{$_POST['id']}'");

        if ($get_pict->num_rows > 0) {
            foreach ($get_pict as $row) {
                unlink('public/storage/uploads/' . $row['picture']);
                parent::$conn->query("update products set picture = NULL where product_id = '{$_POST['id']}'");
                return parent::alert('success', 'Product picture removed.');
            }
        }
        return parent::alert('error', 'There\'s an error removing the picture.');
    }
}

require_once(core('routes/menu-routes'));