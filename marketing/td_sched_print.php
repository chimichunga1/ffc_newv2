<?php
require_once('../support/config.php');
// makeHead('Print Instruction Sheet (Add-on)',1);
if(!isLoggedIn()){
    toLogin();
    die();
}


if(!isset($_POST['app_no']) || empty($_POST['app_no'])){
    redirect('instruction_sheet_prep.php');
    Alert('User not found','warning');
}

function bName($numB){
    global $con;
    $ret = $con->myQuery('SELECT name FROM bank WHERE id = ? AND is_deleted = 0',array($numB))->fetch(PDO::FETCH_ASSOC);
    return $ret['name'];
}

$clientIS = $con->myQuery("SELECT * FROM instruction_sheet_td WHERE app_no = ? AND is_deleted = 0",array($_POST['app_no']))->fetch(PDO::FETCH_ASSOC);
$clientSched = $con->myQuery("SELECT * FROM td_sched WHERE app_no = ? AND is_deleted = 0",array($_POST['app_no']))->fetch(PDO::FETCH_ASSOC);
$clientSchedWhile = $con->myQuery("SELECT * FROM td_sched WHERE app_no = ? AND is_deleted = 0",array($_POST['app_no']));
$schedSum = $con->myQuery("SELECT SUM(amount_sched) AS amount_sum, SUM(discount) AS discount_sum, SUM(net_proceeds_sched) AS proceeds_sum
                           FROM td_sched  A
                           WHERE A.app_no = ? AND A.is_deleted = 0",array($_POST['app_no']))->fetch(PDO::FETCH_ASSOC);

require('../support/PHPPdf/fpdf.php');

$pdf = new FPDF('P','mm','Legal');
$pdf->AddPage();
$pdf->SetTitle('td_sched_'.$clientIS['app_no']);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(196,5,'Filipino Financial Corporation',0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(196,5,'Date Printed:  '.date('F d, Y'),0,1,'L');
$pdf->SetFont('Arial','B',15);
$pdf->Cell(196,5,'TRUE DISCOUNTING SCHEDULE',0,1,'C');
$pdf->Cell(196,5,'(W/ PDCs)',0,1,'C');
$pdf->Cell(196,10,'',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(98,5,'Application No. :  '.$clientIS['app_no'],0,0,'L');
$pdf->Cell(98,5,'Account No. : _______________________ ',0,1,'R');
$pdf->Cell(196,10,'',0,1,'C');
$pdf->Cell(98,5,'Borrower:  '.$clientIS['bor_name'],0,0,'L');
$pdf->Cell(98,5,'Client No. : '.$clientIS['client_no'],0,1,'R');
$pdf->Cell(196,10,'',0,1,'C');
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(20,5,'Principal',0,0);
$pdf->Cell(10,5,':',0,0);
$pdf->Cell(141,5,floatConvert($clientSched['net_proceeds_sched']),0,1,'L');
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(20,5,'Interest Rate',0,0);
$pdf->Cell(10,5,':',0,0);
$pdf->Cell(48,5,$clientIS['int_rate']. ' %',0,0,'L');
$pdf->Cell(98,5,"Release Date : ".inputmask_format_date($clientIS['start_date']),0,1,'R');
$pdf->Cell(196,10,'',0,1,'C');
$pdf->SetFont('Arial','',8);

$pdf->Cell(28,5,'Bank',1,0,'C');
$pdf->Cell(28,5,'Check No.',1,0,'C');
$pdf->Cell(28,5,'Amount',1,0,'C');
$pdf->Cell(28,5,'Maturity Date',1,0,'C');
$pdf->Cell(28,5,'Term (days)',1,0,'C');
$pdf->Cell(28,5,'Discount',1,0,'C');
$pdf->Cell(28,5,'Net Proceeds',1,1,'C');

while($row = $clientSchedWhile->fetch(PDO::FETCH_ASSOC)){
    $pdf->Cell(28,5,bName($row['bank']),1,0,'C');
    $pdf->Cell(28,5,$row['check_no'],1,0,'C');
    $pdf->Cell(28,5,floatConvert($row['amount_sched']),1,0,'C');
    $pdf->Cell(28,5,inputmask_format_date($row['maturity_date_sched']),1,0,'C');
    $pdf->Cell(28,5,$row['term_sched'],1,0,'C');
    $pdf->Cell(28,5,floatConvert($row['discount']),1,0,'C');
    $pdf->Cell(28,5,floatConvert($row['net_proceeds_sched']),1,1,'C');
}
$pdf->Cell(28,5,'',0,0,'C');
$pdf->Cell(28,5,'.',0,0,'C');
$pdf->Cell(28,5,floatConvert($schedSum['amount_sum']),'TB',0,'C');
$pdf->Cell(28,5,'',0,0,'C');
$pdf->Cell(28,5,'',0,0,'C');
$pdf->Cell(28,5,floatConvert($schedSum['discount_sum']),'TB',0,'C');
$pdf->Cell(28,5,floatConvert($schedSum['proceeds_sum']),'TB',1,'C');

$pdf->Cell(196,20,'',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(196,5,'CONFORME : _________________________',0,1,'L');
$pdf->Cell(196,20,'',0,1,'C');
$three = (float)196 / 3;

$pdf->Cell($three,5,'Prepared By: ',0,0,'C');
$pdf->Cell($three,5,'Reviewed By: ',0,0,'C');
$pdf->Cell($three,5,'Approved By: ',0,1,'C');



$pdf->Output();