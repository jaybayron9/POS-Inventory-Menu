<?php

class History extends Connection {
    public static function getHistory() {
        return parent::$conn->query("SELECT * FROM orders order by status");
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
        $filename = 'sales_report_-' . date('m-d-Y') . '.csv';
        header('Content-Disposition: attachment; filename=' . $filename);
        $output = fopen("php://output", "w");
        fputcsv($output, array('Order ID', 'Invoice No.', 'Purchase', 'Total', 'Discounted Total', 'Service'));

        $total = 0;
        $discount = 0;
        $newTotal = 0;

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
                        'total' => $row['total'],
                        'discount' => $row['discount'],
                        'service' => $row['service']
                    );
                }

                for ($i = 0; $i < count($name); $i++) {
                    fputcsv($output, $data[$i]);
                }
                fputcsv($output, array(''));
            }

            $total += $row['total'];
            $discount += $row['discount'];
            $newTotal += $row['total_discount'];
        }

        fputcsv($output, array('', '', 'TOTAL', number_format($total, 2), number_format($discount, 2)));
        fputcsv($output, array('', '','NEW TOTAL', number_format($newTotal, 2)));
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
                    create_at BETWEEN '{$start} 00:00:00' AND '{$end} 23:59:59'
            ");
            
            foreach($result as $row){
                return floatval($row['total_price']);
            }
        }

        $result = parent::$conn->query("
            SELECT SUM(total_discount) AS total_price 
            FROM orders
        ");

        foreach($result as $row){
            return floatval($row['total_price']);
        }
    }
}

require_once(core('routes/history-routes'));