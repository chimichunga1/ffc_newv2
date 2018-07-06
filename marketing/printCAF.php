<?php
  require_once('../support/config.php');
  if(!isLoggedIn()){
    toLogin();
    die();
}

function toStringStat($val){
    switch($val){
        case "pending":
        return "Pending";
        break;
        case "received":
        return "Received";
        break;
        case "to_follow":
        return "To Follow";
        break;
    }
}

if(empty($_POST['tblid']) && empty($_POST['app_no']) && empty($_POST['client_no'])){
    redirect('credit_advising.php');
    Alert('User not found','warning');
}

$auth = $con->myQuery("SELECT * FROM caf_info WHERE id = ? AND app_no = ? AND client_no = ? AND is_deleted = 0",array($_POST['tblid'],$_POST['app_no'],$_POST['client_no']));

if($auth->rowCount() <= 0){
    redirect('credit_advising.php');
    Alert('User not found','warning');
}

$data = $auth->fetch(PDO::FETCH_ASSOC);
$dealer = $con->myQuery("SELECT * FROM client_list WHERE client_number = ? AND is_deleted = 0",array($data['dealer_id']))->fetch(PDO::FETCH_ASSOC);
$dealerName = empty($dealer)?"":$dealer['fname'] ." " . substr($dealer['mname'],0,1). ", ".$dealer['lname'];
$dealerName = strtoupper($dealerName);

$ll = $con->myQuery("SELECT * FROM loan_list WHERE app_no = ? AND client_no = ? AND is_deleted = 0",array($data['app_no'],$data['client_no']))->fetch(PDO::FETCH_ASSOC);

$salesman = $con->myQuery("SELECT * FROM client_list WHERE client_number = ? AND is_deleted = 0",array($data['salesman_id']))->fetch(PDO::FETCH_ASSOC);
$salesman = empty($salesman)?"":$salesman['fname'] ." " . substr($salesman['mname'],0,1). ", ".$salesman['lname'];
$salesmanName = strtoupper($salesman);

$loanType = $con->myQuery("SELECT name FROM loan_approval_type WHERE id = ? AND is_deleted = 0",array($ll['loan_type_id']))->fetch(PDO::FETCH_ASSOC);
$loanName = strtoupper($loanType['name']);

$requirement = $con->myQuery("SELECT * FROM client_requirements_caf WHERE app_no = ? AND client_no = ? AND is_deleted = 0",array($data['app_no'],$data['client_no']));
// print_r($dealer);
require('../support/PHPPdf/fpdf.php');

$pdf = new FPDF('P','mm','Legal');
$pdf->AddPage();
$pdf->SetTitle('caf_'.$data['app_no']);
$pdf->SetFont('Times','B',12);
$pdf->Cell(196,5,"FILIPINO FINANCIAL CORPORATION",0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(196,4,"Unit 1803, 88 Corporate Center Bldg., Sedeno cor. Vakero Sts., Salcedo Vill., Makati City",0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->Cell(196,4,"Tel# 856-6354         Fax# 812-7454",0,1,'L');
$pdf->cell(196,5,"",0,1);
$pdf->SetFont('Arial','UB',9);
$pdf->Cell(10,3,"CREDIT ADVICE",0,0,'l');
$pdf->Cell(186,3,"",0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,4,"(Valid for 30 days only)",0,0,'L');
$pdf->Cell(96,4,"",0,0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,4,"DATE: ".strtoupper(date("F d, Y")),0,1,'L');
$pdf->Cell(196,1,"","B",1);
$pdf->Cell(196,.8,"","B",1);

$pdf->Cell(25,10,"ACCOUNT NAME",0,0,'L');
$pdf->Cell(5,10,":",0,0,'C');
$pdf->Cell(166,6,$data['client_name'],'B',1);
$pdf->Cell(25,9,"SPOUSE",0,0,'L');
$pdf->Cell(5,9,":",0,0,'C');
$pdf->Cell(166,5.8,$data['spouse'],'B',1);

$pdf->Cell(25,9,"CO-MAKER",0,0,'L');
$pdf->Cell(5,9,":",0,0,'C');
$pdf->Cell(58,6,$data['co_maker'],'B',0,"L");
$pdf->Cell(30,9,"TEL / CEL NOS.#",0,0,'L');
$pdf->Cell(10,9,":",0,0,'C');
$pdf->Cell(68,6,$data['pri_con'],'B',1,"L");

$pdf->Cell(25,9,"ADDRESS",0,0,'L');
$pdf->Cell(5,9,":",0,0,'C');
$pdf->Cell(166,5.8,$data['address'],'B',1);
$pdf->Cell(25,9,"",0,0,'L');
$pdf->Cell(5,9,"",0,0,'C');
$pdf->Cell(166,5.8,"",'B',1);

$pdf->Cell(25,9,"DEALER",0,0,'L');
$pdf->Cell(5,9,":",0,0,'C');
$pdf->Cell(58,6,$dealerName,'B',0,"L");
$pdf->Cell(30,9,"SALESMAN",0,0,'L');
$pdf->Cell(10,9,":",0,0,'C');
$pdf->Cell(68,6,$salesmanName,'B',1,"L");

$pdf->Cell(25,9,"UNIT",0,0,'L');
$pdf->Cell(5,9,":",0,0,'C');
$pdf->Cell(58,6,$data['unit'],'B',0,"L");
$pdf->Cell(30,9,"LIST CASH PRICE",0,0,'L');
$pdf->Cell(10,9,":",0,0,'C');
$pdf->Cell(68,6,"P".isEmptyFloat($data['lcp']),'B',1,"L");

$pdf->Cell(25,9,"",0,0,'L');
$pdf->Cell(5,9,"",0,0,'C');
$pdf->Cell(58,6,'','B',0,"L");
$pdf->Cell(30,9,"APPRAISED VALUE",0,0,'L');
$pdf->Cell(10,9,":",0,0,'C');
$pdf->Cell(68,6,"P".isEmptyFloat($data['av']),'B',1,"L");

$pdf->SetFont('Arial','BUI',8);
$pdf->Cell(196,7,"FOR FINANCING FACILITY",0,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(25,9,"DOWNPAYMENT",0,0,'L');
$pdf->Cell(5,9,":",0,0,'C');
$pdf->Cell(48,6,"P".isEmptyFloat($data['downpayment']),'B',0,"L");
$pdf->Cell(30,9,"AMOUNT FINANCED",0,0,'L');
$pdf->Cell(5,9,":",0,0,'C');
$pdf->Cell(43,6,"P".isEmptyFloat($data['amount_fin']),'B',0,"L");
$pdf->Cell(10,9,"TERM",0,0,'L');
$pdf->Cell(5,9,":",0,0,'C');
$pdf->Cell(25,9,$data['term']." months",0,1,'C');

$pdf->Cell(25,7,"INTEREST RATE",0,0,'L');
$pdf->Cell(5,7,":",0,0,'C');
$pdf->Cell(48,5,isEmptyFloat($data['int_rate'])." %",'B',0,"L");
$pdf->Cell(30,7,"MONTHLY PAYMENT",0,0,'L');
$pdf->Cell(5,7,":",0,0,'C');
$pdf->Cell(43,5,"P".isEmptyFloat($data['mon_first']),'B',0,"L");
$pdf->Cell(25,5,"<- 1st PAYMENT",0,0,'R');
$pdf->Cell(15,5,"",0,1);


$pdf->Cell(78,7,"",0,0,'C');

$pdf->Cell(30,7,"",0,0,'L');
$pdf->Cell(5,7,"",0,0,'C');
$pdf->Cell(43,6,"P".isEmptyFloat($data['mon_second']),'B',0,"L");
$pdf->Cell(26,7,"<- 2nd PAYMENT",0,0,'R');
$pdf->Cell(14,5,"",0,1);

$pdf->Cell(25,7,"NOTE",0,0,'L');
$pdf->Cell(5,7,":",0,0,'C');
$pdf->SetFont('Arial','BU',8);
$pdf->Cell(78,7,'PAYMENT WILL START 30 DAYS AFTER DELIVERY DATE.',0,1,"L");

$pdf->Cell(196,1,"","B",1);
$pdf->Cell(196,.8,"","B",1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(25,7,"REQUIREMENTS",0,0,'L');
$pdf->Cell(5,7,":",0,0,'C');
$pdf->Cell(48,7,$loanName,0,1,"L");

while($row = $requirement->fetch(PDO::FETCH_ASSOC)){
    
$pdf->Cell(30,7,"",0,0);
$pdf->Cell(20,5,toStringStat($row['status']),"B",0,"C");
$pdf->Cell(10,7,"",0,0);
$pdf->Cell(100,7,$row['requirement_name'],0,1,"L");
}

$pdf->Cell(25,9,"Prepared by: ",0,0,'L');
$pdf->Cell(5,9,":",0,0,'C');
$pdf->Cell(48,9,$data['prepared_by'],0,1,"L");
$pdf->Cell(25,9,"Noted by: ",0,0,'L');
$pdf->Cell(5,9,":",0,0,'C');
$pdf->Cell(48,9,$data['noted_by'],0,1,"L");

$pdf->Cell(196,7,'"NO HOLD POLICY", ALL CHECKS WILL BE DEPOSITED ON DUE DATE',0,1,'C');


$pdf->Output();
