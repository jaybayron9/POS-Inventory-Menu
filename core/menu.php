<?php 

class Menu extends Connection {

    public function products_menu($column) {
        return parent::$conn->query("SELECT * FROM products where category = '{$column}' ORDER BY CAST(price AS UNSIGNED) ASC");
    }

    public function print_receipt() {
        // Set session to this data to generate receipt
        $_SESSION['data'] = $_POST['data'];
        $_SESSION['total'] = $_POST['total'];
        $_SESSION['service'] = $_POST['service'];
        $_SESSION['payment_amount'] = $_POST['payment_amount'];
        $_SESSION['payment_change'] = $_POST['payment_change'];
        $_SESSION['discount'] = $_POST['discount'];
        $_SESSION['invoice_no'] = rand(1, 199);

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
            $_SESSION['invoice_no'] = rand(1, 100);
        }

        $discount = floatval($_SESSION['total']) * floatval($_SESSION['discount']) / 100;

        $grandtotal = floatval($_SESSION['total']) - abs($discount);

        $save = parent::$conn->query("INSERT INTO orders (
            name, price, quantity, total, total_discount, discount, service, invoice_no
        ) VALUES (
            '{$name}', '{$price}', '{$quantity}', '{$_SESSION['total']}', '{$grandtotal}', '{$discount}', '{$_SESSION['service']}', '{$_SESSION['invoice_no']}'
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
                    ?, ?, 'On Hand', ?, ?
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
                    description = '{$_POST['description']}'
                where 
                    product_id = {$_POST['id']}
            ");
        }

        return parent::alert('success', 'Product updated.');
    }

    public function delete($table, $column, $id) 
    {
        parent::del_photo($table, $column, $id);
        parent::$conn->query("delete from $table where $column = '{$id}'");
        parent::alert('success', '');
    }

    public function up_status_meal() 
    {
        parent::$conn->query("update products set status = '{$_POST['status']}' where product_id = '{$_POST['id']}'");
        echo 'success';
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

    public function today_report() {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=POSSale.csv');
        $output = fopen("php://output", "w");
        fputcsv($output, array('order_id', 'customer', 'name', 'price', 'quantity', 'total', 'service'));
        
        $result = parent::$conn->query("SELECT order_id, customer, name, price, quantity, total, service FROM orders");
        $total = 0;
        
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, $row);
            $total += $row['total'];
        }
        fputcsv($output, array('', '', '', '', '', ''));
        fputcsv($output, array('', '', '', '', '', '', 'Total', $total, ''));

        fclose($output);
    }
}

require_once('core/routes/menu-routes.php');