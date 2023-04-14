<?php
session_start();
require('core/functions.php');
require(core('connection'));
require(core('history'));
require("public/receipt/fpdf.php");

class PDF extends FPDF {
    function FancyTable($header, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(20, 26, 82, 18, 25, 20);
        for ($i = 0; $i < count($header); $i++)
        $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true );
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach ($data as $id) {
            $query = Connection::$conn->query("SELECT * FROM orders WHERE order_id = '{$id}'");
            foreach ($query as $row) {
                $customer = explode(", ", $row['name']);
                $name = array_filter($customer);

                $fquantity  = array_map('intval', explode(", ", $row['quantity']));
                $quantity = array_filter($fquantity);

                $fprice  = array_map('intval', explode(", ", $row['price']));
                $price = array_filter($fprice);

                $orders = [];
                for ($i = 0; $i < count($name); $i++) {
                    $orders[$i] = array(
                        'order_id' => $row['order_id'],
                        'Invoice_no' => $row['invoice_no'],
                        'purchase' => $name[$i] . ', ' . $quantity[$i] . ', ' . $price[$i],
                        'total' => $row['total'],
                        'discount' => $row['discount'],
                        'service' => $row['service']
                    );
                }
                
                foreach($orders as $order) {
                    $this->Cell($w[0], 6, $order['order_id'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[1], 6, $order['Invoice_no'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[2], 6, $order['purchase'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[3], 6, $order['total'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[4], 6, $order['discount'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[5], 6, $order['service'], 'LR', 0, 'L', $fill);
                    $this->Ln();
                    $fill = !$fill;
                }
            }
        }

        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function getSale($data) {
        foreach ($data as $id) {
            $query = Connection::$conn->query("SELECT * FROM orders WHERE order_id = '{$id}'");
            $total = 0;
            foreach ($query as $row) {
                $total += $row['total_discount'];
            }
            return $total;
        }
    }

    public function unsetSession() {
        unset($_SESSION['pdf']);
        unset($_SESSION['fromDatePdf']);
        unset($_SESSION['toDatePdf']);
    }
}

$pdf = new PDF();
$header = array('Order ID', 'Invoice No.', 'Purchase', 'Total', 'Discount', 'Service');
// Data loading
$pdf->SetFont('Courier', '', 10);
$pdf->AddPage();
$pdf->FancyTable($header, $_SESSION['pdf']);

$pdf->SetX(7);
$pdf->SetFont('Courier','',15);
$pdf->Cell(22,15,'Total: ' . number_format($pdf->getSale($_SESSION['pdf']), 2) . 'Php' ,0,1,'');

$pdf->SetX(7);
$pdf->SetFont('Courier','',10);
$pdf->Cell(20,1,"From : {$_SESSION['fromDatePdf']}",0,1,'');

$pdf->SetX(7);
$pdf->SetFont('Courier','',10);
$pdf->Cell(20,10,"To : {$_SESSION['toDatePdf']}",0,1,'');

$pdf->unsetSession();

$filename = 'sales_report_' . date('m-d-Y') . '.pdf';
$pdf->Output($filename, 'D');
?>