<?php
session_start();
require('core/functions.php');
require("core/connection.php");
require("core/settings.php");

date_default_timezone_set("Asia/Manila");
require("public/receipt/fpdf.php");

$pdf = new FPDF ('P','mm',array(80,200));
$pdf->AddPage();

$pdf->SetFont('Courier','B',15);

$pdf->Cell(60,8,'HotPlate POS',1,1,'C');

$pdf->SetFont('Courier','',8);

$address_array = explode(", ", Settings::settings('address'));
$new_address = "";
for ($i = 0; $i < count($address_array); $i++) {
    $new_address .= $address_array[$i];
    if (($i + 1) % 2 == 0) {
        $new_address .= "\n";
    } else {
        $new_address .= ", ";
    }
}

$address_lines = explode("\n", $new_address);

$pdf->Cell(60,5,$address_lines[0],0,1,'C');
$pdf->Cell(60,5,$address_lines[1],0,1,'C');
$pdf->Cell(60,5,$address_lines[2],0,1,'C');
$pdf->Cell(60,5,'Contact #: ' . Settings::settings('contact_no') ,0,1,'C');
$pdf->Cell(60,5,'E-mail Address : ' . Settings::settings('email') ,0,1,'C');
$pdf->Cell(60,5,'FaceBook : ' . Settings::settings('URL') ,0,1,'C');

$pdf->Line(4,38,77,38);
$pdf->Line(4,48,77,48);

//Line break
$pdf->Ln(1);

$pdf->SetFont('Courier','',8);
$pdf->Cell(20,4,'Cashier: ',0,0,'');

$cashier = Connection::$conn->query("SELECT * FROM users WHERE user_id = '{$_SESSION['log_id']}'");
$pdf->SetFont('Courier','',8);
$pdf->Cell(10,4,mysqli_fetch_array($cashier)['name'],0,1,'');

$pdf->SetFont('Courier','',8);
$pdf->Cell(20,4,'Bill To: ',0,0,'');

$pdf->SetFont('Courier','B',12);
$pdf->Cell(10,4,$_SESSION['invoice_no'],0,1,'');

$pdf->SetFont('Courier','',8);
$pdf->Cell(20,4,'Service: ',0,0,'');

$service = $_SESSION['service'] == 'DN' ? 'Dine in' : 'Take out';

$pdf->SetFont('Courier','',8);
$pdf->Cell(10,4,$service,0,1,'');

$pdf->SetFont('Courier','',8);
$pdf->Cell(20,4,'Invoice #: ',0,0,'');
$pdf->SetFont('Courier','',8);
$pdf->Cell(40,4,$_SESSION['invoice_no'],0,1,'');

$pdf->SetFont('Courier','',8);
$pdf->Cell(8,4,'Date: ',0,0,'');
$pdf->Cell(20,4,date("d/m/Y"),0,0,'');


$pdf->Cell(10,4,'Time: ',0,0,'');

$pdf->SetFont('Courier','',8);
$pdf->Cell(60,4,date("g:i a"),0,1,'');

// Product
$pdf->SetX(7);
$pdf->SetFont('Courier','',8);
$pdf->SetFillColor(208,208,208);
$pdf->Cell(34,5,'PRODUCT',1,0,'C'); 
$pdf->Cell(11,5,'QTY',1,0,'C');
$pdf->Cell(8,5,'PRC',1,0,'C');
$pdf->Cell(12,5,'TOTAL',1,1,'C');

foreach($_SESSION['data'] as $row){
    $pdf->SetX(7);   
    $pdf->SetFont('Courier','B',8);
    $pdf->Cell(34,5,$row['name'],1,0,'L');
    $pdf->Cell(11,5,$row['quantity'],1,0,'C');
    $pdf->Cell(8,5,(int)$row['price']/(int)$row['quantity'],1,0,'C');
    $pdf->Cell(12,5,$row['price'],1,1,'C');
}

//product table code
$pdf->SetX(7);
$pdf->SetFont('courier','',8);
$pdf->Cell(20,5,'',0,0,'L');
$pdf->Cell(25,5,'SUBTOTAL',1,0,'C');
$pdf->Cell(20,5,$_SESSION['total'],1,1,'C');

$discount = floatval($_SESSION['total']) * floatval($_SESSION['discount']) / 100;

if ($_SESSION['discount'] !== '0' && $_SESSION['discount'] !== '0.00') {
    $pdf->SetX(7);
    $pdf->SetFont('courier','',8);
    $pdf->Cell(20,5,'',0,0,'L');
    $pdf->Cell(25,5,'DISCOUNT',1,0,'C');
    $pdf->Cell(20,5,'-' . $discount,1,1,'C');
}

$grandtotal = floatval($_SESSION['total']) - $discount;

$pdf->SetX(7);
$pdf->SetFont('courier','B',10);
$pdf->Cell(20,5,'',0,0,'L');
$pdf->Cell(25,5,'GRANDTOTAL',1,0,'C');
$pdf->Cell(20,5,$grandtotal,1,1,'C');

$pdf->SetX(7);
$pdf->SetFont('courier','',8);
$pdf->Cell(20,5,'',0,0,'L');
$pdf->Cell(25,5,'PAYMENT',1,0,'C');
$pdf->Cell(20,5,$_SESSION['payment_amount'],1,1,'C');

$pdf->SetX(7);
$pdf->SetFont('courier','',8);
$pdf->Cell(20,5,'',0,0,'L');
$pdf->Cell(25,5,'CHANGE',1,0,'C');
$pdf->Cell(20,5,abs($_SESSION['payment_change']),1,1,'C');

$pdf->Cell(20,5,'',0,1,'');

$pdf->SetX(7);
$pdf->SetFont('Courier','',8);
$pdf->Cell(65,5,'Thankyou for choosing',0,1,'C');

$pdf->SetX(3);
$pdf->SetFont('Courier','',12);
$pdf->Cell(75,5,'Hot Plate Sizzling House',0,1,'C');

$pdf->SetX(3);
$pdf->SetFont('Courier','',12);
$pdf->Cell(75,5,"Hope you liked it!",0,1,'C');

$pdf->SetX(7);
$pdf->Cell(20,7,'- - - - - - - - - - - - - ',0,1,'');

$pdf->SetX(3);
$pdf->SetFont('Courier','',8);
$pdf->Cell(75,5,'Developed By : fb.com/jay.bayron900',0,1,'C');

$pdf->SetX(3);
$pdf->SetFont('Courier','',8);
$pdf->Cell(75,5,'Contact at : +62 9504523523',0,1,'C');

$pdf->Output();

?>