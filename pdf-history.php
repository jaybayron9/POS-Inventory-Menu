<?php
session_start();
require('core/functions.php');
require(core('connection'));
require(core('history'));
require("public/receipt/fpdf.php");

class PDF extends FPDF {
    protected $col = 0; // Current column
    protected $y0; 

    function Header() {
        // Logo
        $this->Image('public/storage/eximage/icon.jpg',10,6,50);
        // Line break
        $this->SetFont('Arial','B',15);
        $this->Cell(15);
        $this->Cell(0,10,'ORDER HISTORY',0,0,'C');
        $this->Ln(-3);
        
        $this->SetCol(2);
        $this->SetFont('Courier','',8);
        $this->Cell(2,4,"                  DATE: " . date("d/m/Y"),10,0,'');
        $this->Ln(4);
        $this->Cell(1,4,"                  FROM: " . date("d/m/Y", strtotime($_SESSION['fromDatePdf'])),10,0,'');
        $this->Ln(4);
        $this->Cell(2,4,"                  TO:   " . date("d/m/Y", strtotime($_SESSION['toDatePdf'])),10,0,'');
        $this->Ln(15);
    }

    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        $this->SetTextColor(0);
        // Page number
        $this->Cell(0,10,$this->PageNo(),0,0,'C');
    }

    function SetCol($col) {
        // Set position at a given column
        $this->col = $col;
        $x = 10+$col*65;
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }

    function AcceptPageBreak() {
        // Method accepting or not automatic page break
        if($this->col<2) {
            // Go to next column
            $this->SetCol($this->col+1);
            // Set ordinate to top
            $this->SetY($this->y0);
            // Keep on page
            return false;
        }
        else
        {
            // Go back to first column
            $this->SetCol(0);
            // Page break
            return true;
        }
    }

    function FancyTable($header, $data) {
        $this->SetCol(0);
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(12, 15, 50,13, 25, 25, 25, 25);
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
                        'service' => $row['service'],
                        'payment' => $row['payment'],
                        'change' => $row['pay_change']
                    );
                }
                
                foreach($orders as $order) {
                    $this->Cell($w[0], 6, $order['order_id'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[1], 6, $order['Invoice_no'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[2], 6, $order['purchase'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[3], 6, $order['service'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[4], 6, number_format($order['payment']), 'LR', 0, 'R', $fill);
                    $this->Cell($w[5], 6, number_format($order['change']), 'LR', 0, 'R', $fill);
                    $this->Cell($w[6], 6, number_format($order['discount']), 'LR', 0, 'R', $fill);
                    $this->Cell($w[7], 6, number_format($order['total']), 'LR', 0, 'R', $fill);
                    $this->Ln();
                    $fill = !$fill;
                }
            }
        }

        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function getSale($data) {
        $total = 0;
        foreach ($data as $id) {
            $query = Connection::$conn->query("SELECT * FROM orders WHERE order_id = '{$id}'");
            foreach ($query as $row) {
                $total += $row['total_discount'];
            }
        }
        return $total;
    }

    public function getDiscount($data) {
        $total = 0;
        foreach ($data as $id) {
            $query = Connection::$conn->query("SELECT * FROM orders WHERE order_id = '{$id}'");
            foreach ($query as $row) {
                $total += $row['discount'];
            }
        }
        return $total;
    }

    public function unsetSession() {
        unset($_SESSION['pdf']);
        unset($_SESSION['fromDatePdf']);
        unset($_SESSION['toDatePdf']);
    }
}

$pdf = new PDF();
$pdf->AddPage();

$header = array('OID.', 'INV#', 'PURCHASE','TYPE', 'CASH', 'CHANGE', 'DISCOUNT', 'TOTAL');
$pdf->SetFont('Courier', '', 10);
$pdf->FancyTable($header, $_SESSION['pdf']);

$pdf->SetCol(0);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
$pdf->SetLineWidth(.3);
$pdf->SetFont('','B');
$pdf->Cell(140,7,'TOTAL',1,0,'C',true);
$pdf->Cell(25,7,number_format($pdf->getDiscount($_SESSION['pdf'])),1,0,'C',true);
$pdf->Cell(25,7,number_format($pdf->getSale($_SESSION['pdf'])),1,0,'C',true);

// $filename = 'history_report_' . date('m-d-Y') . '.pdf';
// $pdf->Output($filename, 'D');

$pdf->Output();
$pdf->unsetSession();
?>