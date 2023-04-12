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
        $w = array(15, 18, 96, 18, 28, 15);
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
                        'New total' => $row['total_discount'],
                        'service' => $row['service']
                    );
                }
                
                $purchase = '';
                for ($i = 0; $i < count($orders); $i++) {
                    $purchase .= $orders[$i]['purchase'] . ', ';
                }
                
                    $this->Cell($w[0], 6, $row['order_id'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[1], 6, $row['invoice_no'], 'R', 0, 'L', $fill);
                    $this->Cell($w[2], 6, $purchase, 'LR', 0, 'LR', $fill);
                    $this->Cell($w[3], 6, $row['total'], 'LR', 0, 'R', $fill);
                    $this->Cell($w[4], 6, $row['total_discount'], 'R', 0, 'R', $fill);
                    $this->Cell($w[5], 6, $row['service'], 'LR', 0, 'LR', $fill);
                    $this->Ln();
                    $fill = !$fill;
            }
        }

        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function getSale() {
        $query = Connection::$conn->query("SELECT * FROM orders");
        $total = 0;
        foreach ($query as $row) {
            $total += $row['total_discount'];
        }
        return $total;
    }
}

$pdf = new PDF();
$header = array('Order ID', 'Invoice No.', 'Purchase', 'Total', 'Discounted Total', 'Service');
// Data loading
$pdf->SetFont('Courier', '', 8);
$pdf->AddPage();
$pdf->FancyTable($header, $_SESSION['pdf']);

$pdf->SetX(7);
$pdf->SetFont('Courier','',18);
$pdf->Cell(20,20,'Total: ' . number_format($pdf->getSale(), 2) . 'Php' ,0,1,'');

$pdf->Output();
?>