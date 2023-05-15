<?php

class History extends Connection {
    public static function getHistory() {
        return parent::$conn->query("SELECT * FROM orders 
            WHERE 
                payment_status = 'Paid' OR
                payment_status = 'Balance'
            ORDER BY status, update_at;
        ");
    }

    public static function getReceipt() {
        return parent::$conn->query("
            SELECT *
            FROM orders
            ORDER BY
            CASE 
                WHEN payment_status = 'Unpaid' THEN 1
                WHEN payment_status = 'Balance' THEN 2
                WHEN payment_status = 'Paid' THEN 3
                ELSE 4 
            END, `create_at`
        ");
    }

    public function clear_history() {
        parent::$conn->query("DELETE FROM orders");
        return parent::alert('success', '');
    }

    public function delete_row() {
        if (empty($_POST['data']) || empty($_POST['data'][0])) {
            return parent::alert('error', 'Select at least one row to delt.');
        }

        foreach($_POST['data'] as $id) {
            $query = parent::$conn->query("DELETE FROM orders WHERE order_id = '{$id}'");
            
            if ($query) {
                return parent::alert('success', 'Successfully deleted.');
            }
            return parent::alert('error', 'Error deleting order.');
        }
    }

    public function toexportcsv() {
        if (empty($_POST['data']) && empty($_POST['data'][0])) {
            return parent::alert('error', 'Please select a row to export.');
        }

        $_SESSION['fromDate'] = $_POST['fromDate'] !== '' ? $_POST['fromDate'] : 'No date from';
        $_SESSION['toDate'] = $_POST['toDate'] !== '' ? $_POST['toDate'] : 'No date to';
        $_SESSION['orders_ids'] = $_POST['data'];
        return parent::alert('success', '');
    }

    public function export_csv() {
        header('Content-Type: text/csv; charset=utf-8');
        $filename = 'orders_report_-' . date('m-d-Y') . '.csv';
        header('Content-Disposition: attachment; filename=' . $filename);
        $output = fopen("php://output", "w");
        fputcsv($output, array('OID.', 'INV#', 'PURCHASE', 'TYPE', 'CASH', 'CHANGE','DISCOUNT', 'TOTAL'));

        $total = 0;
        $discount = 0;

        foreach ($_SESSION['orders_ids'] as $ids) {
            $query = parent::$conn->query("SELECT * FROM orders WHERE order_id = '{$ids}'");
            foreach ($query as $row) {
                $customer = explode(", ", $row['name']);
                $name = array_filter($customer);

                $fquantity  = array_map('intval', explode(", ", $row['quantity']));
                $quantity = array_filter($fquantity);

                $fprice  = array_map('intval', explode(", ", $row['price']));
                $price = array_filter($fprice);

                $data = [];
                for ($i = 0; $i < count($name); $i++) {
                    $data[$i] = array(
                        'order_id' => $row['order_id'],
                        'Invoice_no' => $row['invoice_no'],
                        'purchase' => $name[$i] . ', ' . $quantity[$i] . ', ' . $price[$i],
                        'service' => $row['service'],
                        'payment' => $row['payment'],
                        'change' => $row['pay_change'],
                        'discount' => $row['discount'],
                        'total' => $row['total_discount'],
                    );
                }

                for ($i = 0; $i < count($name); $i++) {
                    fputcsv($output, $data[$i]);
                }
                fputcsv($output, array(''));
            }

            $discount += $row['discount'];
            $total += $row['total_discount'];
        }

        fputcsv($output, array('', '','','','','TOTAL', number_format($discount), number_format($total)));
        fputcsv($output, array('From Date', 'To Date'));
        fputcsv($output, array($_SESSION['fromDate'], $_SESSION['toDate']));
        unset($_SESSION['fromDate']);
        unset($_SESSION['toDate']);
        unset($_SESSION['orders_ids']);
    }

    public function toexportpdf() {
        if (empty($_POST['data']) || empty($_POST['data'][0])) {
            return parent::alert('error', 'Please select a row to export.');
        }

        $_SESSION['fromDatePdf'] = $_POST['fromDate'] !== '' ? $_POST['fromDate'] : 'No date from';
        $_SESSION['toDatePdf'] = $_POST['toDate'] !== '' ? $_POST['toDate'] : 'No date to';
        $_SESSION['pdf'] = $_POST['data'];
        return parent::alert('success', '');
    }

    public function getsale() {
        $start = $_POST['start_date'];
        $end = $_POST['end_date'];

        if (!empty($start) || !empty($end)) {
            $result = parent::$conn->query("
                SELECT SUM(total_discount) AS total_price 
                FROM orders
                WHERE 
                    payment_status = 'Paid' AND
                    create_at BETWEEN '{$start} 00:00:00' AND '{$end} 23:59:59'
            ");
            
            foreach($result as $row){
                return floatval($row['total_price']);
            }
        }

        $result = parent::$conn->query("
            SELECT SUM(total_discount) AS total_price 
            FROM orders 
            WHERE payment_status = 'Paid'
        ");

        foreach($result as $row){
            return floatval($row['total_price']);
        }
    }

    public function receipt() {
        $query = parent::$conn->query("SELECT * FROM orders WHERE order_id = '{$_POST['order_id']}'");
        foreach ($query as $row) {
            $query = parent::$conn->query("SELECT * FROM orders WHERE order_id = '{$_POST['order_id']}'");
            foreach ($query as $row) {
                $customer = explode(", ", $row['name']);
                $name = array_filter($customer);

                $fquantity  = array_map('intval', explode(", ", $row['quantity']));
                $quantity = array_filter($fquantity);

                $fprice  = array_map('intval', explode(", ", $row['price']));
                $price = array_filter($fprice);

                $data = [];
                for ($i = 0; $i < count($name); $i++ ) {
                    $data[$i] = array(
                        'purchase' => $name[$i] . ', ' . $quantity[$i] . ', ' . $price[$i],
                    );
                }
                
                $new_array = array();
                foreach ($data as $item) {
                    $parts = explode(", ", $item['purchase']);
                    $name = substr($parts[0], 0);
                    $price = $parts[2];
                    $quantity = $parts[1];
                    $new_item = array(
                        "name" => $name,
                        "price" => $price,
                        "quantity" => $quantity
                    );
                    if (!in_array($new_item, $new_array)) {
                        $new_array[] = $new_item;
                    }
                }

                $_SESSION['data'] =  $new_array; 
            }

            $_SESSION['total'] = $_POST['total'];
            $_SESSION['customer'] = $row['customer'];
            $_SESSION['service'] = $row['service'];
            $_SESSION['payment_amount'] = $_POST['payment_amount'];
            $_SESSION['payment_change'] = $_POST['change'];
            $_SESSION['discount'] = $_POST['discount'];
            $_SESSION['invoice_no'] = $row['invoice_no'];
            $_SESSION['create_at'] = $row['create_at'];
        }

        $total_discount = $_POST['total'] - $_POST['discount_amount'];

        $payment_status = 'Paid';
        if ($_POST['payment_amount'] > 0 && $_POST['payment_amount'] < $_POST['total']) {
            $payment_status = 'Balance';
        }

        parent::$conn->query("
            update orders set 
                payment = '{$_POST['payment_amount']}',
                pay_change = '{$_POST['change']}',
                discount = '{$_POST['discount_amount']}',
                total_discount = '{$total_discount}',
                payment_status = '{$payment_status}'
            where order_id = '{$_POST['order_id']}'
        ");
    }

    public function reissue_receipt() {
        $query = parent::$conn->query("SELECT * FROM orders WHERE order_id = '{$_POST['order_id']}'");
        foreach ($query as $row) {
            $query = parent::$conn->query("SELECT * FROM orders WHERE order_id = '{$_POST['order_id']}'");
            foreach ($query as $row) {
                $customer = explode(", ", $row['name']);
                $name = array_filter($customer);

                $fquantity  = array_map('intval', explode(", ", $row['quantity']));
                $quantity = array_filter($fquantity);

                $fprice  = array_map('intval', explode(", ", $row['price']));
                $price = array_filter($fprice);

                $data = [];
                for ($i = 0; $i < count($name); $i++ ) {
                    $data[$i] = array(
                        'purchase' => $name[$i] . ', ' . $quantity[$i] . ', ' . $price[$i],
                    );
                }
                
                $new_array = array();
                foreach ($data as $item) {
                    $parts = explode(", ", $item['purchase']);
                    $name = substr($parts[0], 0);
                    $price = $parts[2];
                    $quantity = $parts[1];
                    $new_item = array(
                        "name" => $name,
                        "price" => $price,
                        "quantity" => $quantity
                    );
                    if (!in_array($new_item, $new_array)) {
                        $new_array[] = $new_item;
                    }
                }

                $_SESSION['data'] =  $new_array; 
            }

            $_SESSION['total'] = $row['total'];
            $_SESSION['customer'] = $row['customer'];
            $_SESSION['service'] = $row['service'];
            $_SESSION['payment_amount'] = $row['payment'];
            $_SESSION['payment_change'] = $row['pay_change'];
            $_SESSION['discount_amount'] = $row['discount'];
            $_SESSION['invoice_no'] = $row['invoice_no'];
            $_SESSION['create_at'] = $row['create_at'];
        }
    }

    public function unset_receipt() {
        unset($_SESSION['data']);
        unset($_SESSION['total']);
        unset($_SESSION['customer']);
        unset($_SESSION['service']);
        unset($_SESSION['payment_amount']);
        unset($_SESSION['payment_change']);
        unset($_SESSION['discount_amount']);
        unset($_SESSION['invoice_no']);
        unset($_SESSION['discount']);
    }
}

require_once(core('routes/history-routes'));