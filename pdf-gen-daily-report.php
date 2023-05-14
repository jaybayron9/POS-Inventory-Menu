<?php 

require('core/functions.php');
require(core('connection'));
require(core('history'));
require("public/receipt/fpdf.php");

class GenDailyReport extends FPDF {
    protected $col = 0; // Current column
    protected $y0; 

    function PHeader($title) {
        // Logo
        $this->Image('public/storage/eximage/icon.jpg',10,6,50);
        // Line break
        $this->SetFont('Arial','B',15);
        $this->Cell(15);
        $this->Cell(0,10,$title,0,0,'C');
        $this->Ln(-3);
        
        $this->SetCol(2);
        $this->SetFont('Courier','',8);
        $this->Cell(2,4,"                  DATE: " . date("d/m/Y"),10,0,'');
        $this->Ln(25);
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

    function table($category, $header, $tableHeight, $colcategory = '') {
        $this->SetCol(0);
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        if ($category == 'TransactionHistory') {
            // Header
            $w = array(12, 48, 13, 25, 23, 23, 23, 23);
            for ($i = 0; $i < count($header); $i++) {
                $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
            }
            $this->Ln();
            // Color and font restoration
            $this->SetFillColor(224, 235, 255);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Data
            $fill = false;
    
            $query = Connection::$conn->query("SELECT * FROM orders WHERE payment_status = 'Paid' and DATE(create_at) = CURDATE()");
            foreach ($query as $row) {
                // Check if there is enough space for the next row
                if ($this->GetY() + 6 > $tableHeight) { // Adjust the value 6 as needed
                    $this->AddPage();
                    $this->SetCol(0);
                    $this->SetFont('', 'B');
                    for ($i = 0; $i < count($header); $i++) {
                        $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
                    }
                    $this->Ln();
                    $this->SetFillColor(224, 235, 255);
                    $this->SetTextColor(0);
                    $this->SetFont('');
                    $fill = false;
                }
    
                $customer = explode(", ", $row['name']);
                $name = array_filter($customer);
    
                $fquantity  = array_map('intval', explode(", ", $row['quantity']));
                $quantity = array_filter($fquantity);
    
                $fprice  = array_map('intval', explode(", ", $row['price']));
                $price = array_filter($fprice);
    
                $orders = [];
                for ($i = 0; $i < count($name); $i++) {
                    $orders[$i] = array(
                        'Invoice_no' => $row['invoice_no'],
                        'purchase' => $name[$i] . ', ' . $quantity[$i] . ', ' . $price[$i],
                        'service' => $row['service'],
                        'cash' => $row['payment'],
                        'change' => $row['pay_change'],
                        'subtotal' => $row['total'],
                        'discount' => $row['discount'],
                        'totaldue' => $row['total_discount'],
                    );
                }
                
                foreach($orders as $order) {
                    $this->Cell($w[0], 6, $order['Invoice_no'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[1], 6, $order['purchase'], 'LR', 0, 'L', $fill);
                    $this->Cell($w[2], 6, $order['service'], 'LR', 0, 'C', $fill);
                    $this->Cell($w[3], 6, number_format($order['cash'],2), 'LR', 0, 'R', $fill);
                    $this->Cell($w[4], 6, number_format($order['change'],2), 'LR', 0, 'R', $fill);
                    $this->Cell($w[5], 6, number_format($order['subtotal'],2), 'LR', 0, 'R', $fill);
                    $this->Cell($w[6], 6, number_format($order['discount'],2), 'LR', 0, 'R', $fill);
                    $this->Cell($w[7], 6, number_format($order['totaldue'],2), 'LR', 0, 'R', $fill);
                    $this->Ln();
                    $fill = !$fill;
                }
            }

            // Closing line
            $this->Cell(array_sum($w), 0, '', 'T');

        } elseif ($category == 'SalesINventory') {
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
            $query = Connection::$conn->query("SELECT * FROM products WHERE category = '{$colcategory}'");
            foreach ($query as $row) {
                // Check if there is enough space for the next row
                if ($this->GetY() + 6 > $tableHeight) { // Adjust the value 6 as needed
                    $this->AddPage();
                    $this->SetCol(0);
                    $this->SetFont('', 'B');
                    for ($i = 0; $i < count($header); $i++) {
                        $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
                    }
                    $this->Ln();
                    $this->SetFillColor(224, 235, 255);
                    $this->SetTextColor(0);
                    $this->SetFont('');
                    $fill = false;
                }
    
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
            
         // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
        }
    }

    public function getTotal($table, $column, $colcondition, $condition, $coldate) {
        $total = 0;
        $query = Connection::$conn->query("SELECT * FROM $table WHERE $colcondition = '{$condition}' and DATE($coldate) = CURDATE()");
        foreach ($query as $row) {
            $total += $row[$column];
        }
        return $total;
    }

    function pages($category, $condition, $colcategory) {
        $header = array('PID.', 'NAME', 'QTY', 'ON HAND','RE-ORDER', 'TOTAL', 'SALES', 'MODIFIED');
        $this->SetFont('Courier', '', 10);

        // Calculate the height of the table based on the number of rows
        $tableHeight = $this->GetPageHeight() - $this->GetY() - 1;

        $this->table($category, $header, $tableHeight, $colcategory);
    
        $this->SetCol(0);
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        $this->Cell(113,7,'TOTAL',1,0,'C',true);
        $this->Cell(25,7,number_format($this->getTotal('products', 'total', 'category', $condition, 'CURDATE()'), 2),1,0,'C',true);
        $this->Cell(28,7,number_format($this->getTotal('products', 'sale', 'category', $condition, 'CURDATE()'), 2),1,0,'C',true);
        $this->Cell(24,7,'Php',1,0,'C',true);

        // Check if there is enough space for the next content
        if ($this->GetY() + 20 > $this->GetPageHeight()) { // Adjust the value 20 as needed
            $this->AddPage();
        }
    }

    function outPages($dheader, $category, $colcategory) {
        $this->SetTextColor(0);
        $this->AddPage();
        $this->Pheader($dheader);
        $this->pages('SalesINventory', $category, $colcategory);
    }
}

$pdf = new GenDailyReport();
$pdf->AddPage();

$pdf->PHeader("TRANSACTION HISTORY");
$header = array('INV#', 'PURCHASE','TYPE', 'CASH', 'CHANGE', 'SUBTOTAL', 'DISCOUNT', 'TOTALDUE');

$pdf->SetFont('Courier', '', 10);
$tableHeight = $pdf->GetPageHeight() - $pdf->GetY() - 1;
$pdf->Table('TransactionHistory', $header, 'Sales');

$pdf->SetCol(0);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
$pdf->SetLineWidth(.3);
$pdf->SetFont('','B');
$pdf->Cell(121,7,'TOTAL',1,0,'C',true);
$pdf->Cell(23,7,number_format($pdf->getTotal('orders', 'total', 'payment_status', 'Paid', 'create_at'),2),1,0,'C',true);
$pdf->Cell(23,7,number_format($pdf->getTotal('orders', 'discount', 'payment_status', 'Paid', 'create_at'),2),1,0,'C',true);
$pdf->Cell(23,7,number_format($pdf->getTotal('orders', 'total_discount', 'payment_status', 'Paid', 'create_at'),2),1,0,'C',true);

if ($pdf->GetY() + 20 > $pdf->GetPageHeight()) {
    $pdf->AddPage();
}

// ---------------------------------------------------------

$pdf->SetCol(0);
$pdf->SetTextColor(0);

$pdf->outPages('Meals', 'meals', 'meals');
$pdf->outPages('Drinks', 'drinks', 'drinks');
$pdf->outPages('Supplies', 'supplies', 'supplies');

$pdf->Output();