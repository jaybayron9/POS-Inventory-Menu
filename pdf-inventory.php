<?php
session_start();
require('core/functions.php');
require(core('connection'));
require(core('history'));
require(core('dashboard'));
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
        $this->Cell(0,10,'SALES AND INVENTORY',0,0,'C');
        $this->Ln(-3);
        
        $this->SetCol(2);
        $this->SetFont('Courier','',8);
        $this->Cell(2,4,"                  DATE: " . date("d/m/Y"),10,0,'');
        $this->Ln(4);
        $this->Cell(1,4,"                  CATEGORY: {$_SESSION['category']}",10,0,'');
        $this->Ln(19);
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
        if($this->col<2)
        {
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
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Header
        $w = array(13, 40, 14, 23, 23, 25, 28, 24);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach ($data as $id) {
            $query = Connection::$conn->query("select * from products where product_id = '{$id}'");
            foreach ($query as $row) {
                $this->Cell($w[0], 6, $row['product_id'], 'LR', 0, 'L', $fill);
                $this->Cell($w[1], 6, $row['name'], 'LR', 0, 'L', $fill);
                $this->Cell($w[2], 6, $row['orig_quantity'], 'LR', 0, 'R', $fill);
                $this->Cell($w[3], 6, $row['quantity'], 'LR', 0, 'R', $fill);
                $this->Cell($w[4], 6, $row['reorder_level'], 'R', 0, 'R', $fill);
                $this->Cell($w[5], 6, number_format($row['total'], 2), 'LR', 0, 'R', $fill);
                $this->Cell($w[6], 6, number_format($row['sale'], 2), 'LR', 0, 'R', $fill);
                $this->Cell($w[7], 6,  date("d/m/Y", strtotime($row['update_at'])), 'LR', 0, 'R', $fill);
                $this->Ln();
                $fill = !$fill;
            }
        }

        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function unsetSession() {
        unset($_SESSION['product_id']);
        unset($_SESSION['category']);
    }
}

$pdf = new PDF();
$pdf->AddPage();

$header = array('PID.', 'NAME', 'QTY', 'ON HAND','RE-ORDER', 'TOTAL', 'SALES', 'MODIFIED');
$pdf->SetFont('Courier', '', 10);
$pdf->FancyTable($header, $_SESSION['product_id']);

$pdf->SetCol(0);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
$pdf->SetLineWidth(.3);
$pdf->SetFont('','B');
$pdf->Cell(113,7,'TOTAL',1,0,'C',true);
$pdf->Cell(25,7,number_format($dash->onHandTotalProduct($_SESSION['product_id']), 2),1,0,'C',true);
$pdf->Cell(28,7,number_format($dash->totalProductSale($_SESSION['product_id']), 2),1,0,'C',true);
$pdf->Cell(24,7,'Php',1,0,'C',true);

$pdf->Output();

// $pdf->unsetSession();
?>