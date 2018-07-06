<?php
require_once('../support/config.php');
// makeHead('Print Instruction Sheet (Add-on)',1);
if(!isLoggedIn()){
    toLogin();
    die();
}




if(!isset($_POST['tbl_id']) || empty($_POST['tbl_id'])){
    redirect('instruction_sheet_prep.php');
    Alert('User not found','warning');
}


function convert($val){
    return number_format((float)$val,2,'.',',');
}
function dateCon($date ){

    return date_format(new DateTime($date),'m / d / Y') ;
}

$client =  $con->myquery("SELECT * FROM instruction_sheet WHERE id = ?",array($_POST['tbl_id']))->fetch(PDO::FETCH_ASSOC);
    if(count($client) <= 0){
    redirect('instruction_sheet_prep.php');
    Alert('User not found','warning');
    }

    $dealer = $con->myQuery("SELECT * FROM client_list WHERE client_number = ? AND is_deleted = 0",array($client['dealer_id']))->fetch(PDO::FETCH_ASSOC);
    $dealerName = empty($dealer)?"":$dealer['fname'] ." " . substr($dealer['mname'],0,1). ", ".$dealer['lname'];
    $dealerName = strtoupper($dealerName);


    $salesman = $con->myQuery("SELECT * FROM client_list WHERE client_number = ? AND is_deleted = 0",array($client['salesman_id']))->fetch(PDO::FETCH_ASSOC);
$salesman = empty($salesman)?"":$salesman['fname'] ." " . substr($salesman['mname'],0,1). ", ".$salesman['lname'];
$salesmanName = strtoupper($salesman);

$collat = $con->myQuery("SELECT * FROM collateral_info WHERE loan_list_id = :app_no AND client_no = :client_no AND is_deleted = 0 LIMIT 5",array(
    "app_no" => $client['ll_id'],
    'client_no' => $client['client_no']));
  

$clientBInfo = $con->myQuery("SELECT 
B.code AS loan_code , 
C.code AS credit_code, 
D.code AS prod_code, 
E.code AS marketing_code
FROM loan_list A
JOIN loan_approval_type B ON A.loan_type_id = B.id
JOIN credit_facility C ON A.credit_fac_id = C.id 
JOIN product_line D ON A.prod_line_id = D.id
JOIN marketing_type E ON A.mark_type_id = E.id
WHERE A.id = :app_id
",array('app_id'=> $client['ll_id']))->fetch(PDO::FETCH_ASSOC);
 
$mp = $con->myQuery("SELECT name FROM manner_of_payment WHERE id = ? AND is_deleted = 0",array($client['manner_payment']))->fetch(PDO::FETCH_ASSOC);
   
$clientOInfo = $con->myQuery("SELECT B.name AS bus_code, C.name AS ind_code
FROM client_list A
JOIN business_type B ON A.bus_type_id = B.id
JOIN industry_code C ON A.ind_code_id = C.id
WHERE A.client_number = :client_num",array('client_num'=>$client['client_no']))->fetch(PDO::FETCH_ASSOC);
  

  $collatVar = array( 
    'facility',
    'engineno',
    'chassisno',
    'plateno',
    'lcpav',
    'ltooff',
    'ltocr',
    'ltoor',
    'date',
    'insco',
	'policy',
    'expdate',
	'tuacc',
	'unit',
	'engineno_',
	'chassisno_',
	'plateno_'
);
$collatName = array('Facility Given','Engine No.','Chassis No.','Plate No.',
                    'LCP / AV','LTO-Office','LTO-CR#','LTO-OR#',
                    'Date','Ins. Co.','Policy No.','Exp. Date',
                    'Tie-up Account No.','Unit','Engine No.',
                    'Chassis No.','Plate No.');
$i = 0;
$collatOut[$i]['facility'] = "";
$collatOut[$i]['engineno'] = "";
$collatOut[$i]['chassisno'] = "";
$collatOut[$i]['plateno'] = "";
$collatOut[$i]['lcpav'] = "";
$collatOut[$i]['ltooff'] = "";
$collatOut[$i]['ltocr'] = "";
$collatOut[$i]['ltoor'] = "";
$collatOut[$i]['date'] = "";
$collatOut[$i]['insco'] = "";
$collatOut[$i]['policy'] = "";
$collatOut[$i]['expdate'] = "";
$collatOut[$i]['tuacc'] = "";
$collatOut[$i]['unit'] = "";
$collatOut[$i]['engineno_'] = "";
$collatOut[$i]['chassisno_'] = "";
$collatOut[$i]['plateno_'] = "";
while($row = $collat->fetch(PDO::FETCH_ASSOC) && $i != 1){
    $collatOut[$i]['facility'] = !empty($row['unit_description'])?$row['unit_description']:'';
    $collatOut[$i]['engineno'] = !empty($row['location_motor'])?$row['location_motor']:'';
    $collatOut[$i]['chassisno'] = !empty($row['tct_no'])?$row['tct_no']:'';
    $collatOut[$i]['plateno'] = !empty($row['tct_no'])?$row['tct_no']:'';
    $collatOut[$i]['lcpav'] = !empty($row['approve_value'])?number_format($row['approve_value'],2,'.',','):'';
    $collatOut[$i]['ltooff'] = !empty($row['lto_agency'])?$row['lto_agency']:'';
    $collatOut[$i]['ltocr'] = !empty($row['cr_no'])?$row['cr_no']:'';
    $collatOut[$i]['ltoor'] = !empty($row['or_no'])?$row['or_no']:'';
    $collatOut[$i]['date'] = isEmptyDate($row['collat_created_date']);
    $collatOut[$i]['insco'] = !empty($row['insurance_comp'])?$row['insurance_comp']:'';
    $collatOut[$i]['policy'] = !empty($row['policy_no'])?$row['policy_no']:'';
    $collatOut[$i]['expdate'] = isEmptyDate($row['exp_date']);
    $collatOut[$i]['tuacc'] = "";
    $collatOut[$i]['unit'] = "";
    $collatOut[$i]['engineno_'] = "";
    $collatOut[$i]['chassisno_'] = "";
    $collatOut[$i]['plateno_'] = "";
    $i++;
}



require('../support/PHPPdf/fpdf.php');

$pdf = new FPDF('P','mm','Legal');
$pdf->AddPage();
$pdf->SetTitle('is_'.$client['app_no']);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(40,5,'Date Printed: '.date('F d,Y'),0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(196,5,'INSTRUCTION SHEET (ADD-ON)',0,1,"C");
$pdf->SetFont('Arial','B',8);
$pdf->Cell(65,10,'Application No.:'.$client['app_no'],0,0,'L');
$pdf->Cell(66,10,'',0,0);
$pdf->Cell(65,10,'Account No.: ____________________',0,1,'R');
$pdf->Cell(196,2,'',0,1);
$pdf->Cell(15,5,'Borrower',0,0);
$pdf->Cell(5,5,':',0,0,'L');
$pdf->Cell(45,5,$client['bor_name'],0,0,'L');
$pdf->Cell(66,5,'',0,0);
$pdf->Cell(15,5,'Client No.',0,0);
$pdf->Cell(5,5,':',0,0,'L');
$pdf->Cell(45,5,$client['client_no'],0,1,'L');
$pdf->Cell(15,3,'Spouse',0,0);
$pdf->Cell(5,5,':',0,0,'L');
$pdf->Cell(45,5,$client['spouse'],0,0,'L');
$pdf->Cell(66,3,'',0,0);
$pdf->Cell(15,3,'New/Old',0,0);
$pdf->Cell(5,5,':',0,0,'L');
$pdf->Cell(45,5,$client['client_stat'],0,1,'L');
$pdf->Cell(15,3,'Address',0,0);
$pdf->Cell(5,3,':',0,0,'L');
$pdf->Cell(45,3,$client['address'],0,0,'L');
$pdf->Cell(66,3,'',0,0);
$pdf->Cell(15,3,'Tel. No.',0,0);
$pdf->Cell(5,3,':',0,0,'L');
$pdf->Cell(45,3,$client['pri_con'],0,1,'L');
$pdf->Cell(196,2,'',0,1,'C');
$pdf->Cell(49,5,'',0,0,'C');
$pdf->Cell(49,5,'',0,0,'C');
$pdf->Cell(49,5,'Industry Code : '.substr($clientOInfo['ind_code'],0,2),0,0,'C');
$pdf->Cell(49,5,'Business Type : '."BPI",0,1,'R');
$pdf->Cell(49,3,'Loan Type : '.$clientBInfo['loan_code'],0,0,'L');
$pdf->Cell(49,3,'Product Line : '.$clientBInfo['prod_code'],0,0,'L');
$pdf->Cell(49,3,'Credit Facility : '.$clientBInfo['credit_code'],0,0,'C');
$pdf->Cell(49,3,'Marketing Type : '.$clientBInfo['marketing_code'],0,1,'R');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(196,7,'*************************************************************************** COLLATERAL INFORMATION *************************************************************************',0,1,'C');


$border = 1;                    
$numCollat = $collat->rowCount();
$numCollat = ($numCollat <= 0)?1:$numCollat;
$gridLen = ((float)160 / (float)$numCollat);


for($i=0;$i<count($collatName);$i++){
    $pdf->Cell(30,4,$collatName[$i],$border==1?"TLB":0,0,'L');
    $pdf->Cell(6,4,':',$border==1?"TBR":0,0,'C');
    for($a=0;$a<$numCollat;$a++){
        if($a == $numCollat - 1){
            $pdf->Cell($gridLen,4,$collatOut[$a][$collatVar[$i]],$border==1?"TRB":0,1,'L');
        }else{
            $pdf->Cell($gridLen,4,$collatOut[$a][$collatVar[$i]],$border==1?"TRB":0,0,'L');
        }
    }

}
$pdf->Cell(196,7,'******************************************************************************** LOAN INFORMATION ******************************************************************************',0,1,'C');

$left = $border==1?"TBL":$border;
$colon = $right = $border==1?"TBR":$border;


$pdf->Cell(40,5,'TERM',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,$client['term'].' months',$right,0);
$pdf->Cell(40,5,'ADD-ON RATE',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,$client['addon_rate'].'%',$right,1);

$pdf->Cell(40,5,'LCP / APPRAISED VALUE',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,convert($client['list_cash_price']),$right,0);
$pdf->Cell(40,5,'MONTHLY INSTALLMENT 1ST',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,convert($client['mon_first_payment']),$right,1);

$pdf->Cell(40,5,'DOWN PAYMENT',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,convert($client['dp_gd_rv']),$right,0);
$pdf->Cell(40,5,'2ND TO '.$client['term'],$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,convert($client['mon_second_payment']),$right,1);

$pdf->Cell(98,5,'---------------------------------------------------',$border,0,'R');
$pdf->Cell(40,5,'START DATE',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,dateCon($client['start_date']),$right,1);

$pdf->Cell(40,5,'AMOUNT FINANCED',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,convert($client['amount_fin']),$right,0);
$pdf->Cell(40,5,'MATURITY DATE',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,dateCon($client['maturity_date']),$right,1);

$pdf->Cell(40,5,'PN AMOUNT',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,convert($client['amount_pn']),$right,0);
$pdf->Cell(40,5,'DUEDATE',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,$client['due_date'],$right,1);

$pdf->Cell(40,5,'R C F',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,convert($client['rcf']),$right,0);
$pdf->Cell(40,5,'VALUE DATE',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,dateCon($client['value_date']),$right,1);

$pdf->Cell(98,5,'---------------------------------------------------',$border,0,'R');
$pdf->Cell(40,5,'REBATE (RCF)',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,convert($client['rebate_rcf']),$right,1);

$pdf->Cell(40,5,'TOTAL LOAN VALUE',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,convert($client['TLV']),$right,0);
$pdf->Cell(40,5,'MANNER OF PAYMENT',$left,0);
$pdf->Cell(9,5,':',$colon,0,'C');
$pdf->Cell(49,5,$mp['name'],$right,1);

$pdf->Cell(196,7,'============================================================================================================================',0,1,'C');

$pdf->Cell(98,5,'PN AMOUNT',1,0);
$pdf->Cell(98,5,convert($client['amount_pn']),1,1,'R');

$pdf->Cell(49,5,'LESS: UDI/ALIR/INT.',1,0);
$pdf->Cell(49,5,$client['less_udi_percent'].' %',1,0);
$pdf->Cell(98,5,convert($client['less_total']),1,1,'R');

$gridCustom = ((float)196 / (float)3)+16.66;
$gridFee = (float)196 / (float)5;
$pdf->Cell($gridCustom,5,'O.R No. : '.isEmptyInt($client['or_no']),1,0);
$pdf->Cell($gridCustom,5,'O.R Date: '.isEmptyDate($client['or_date']),1,0);
$pdf->Cell(32,5,convert($client['udi_bal']),1,1,'R');

$dbName = array('mort','proc','apprais','comm','front','sm','dealer','real_estate','insur_prem','handling','dpb','doc',
                'sbgfc','other_one','other_two');

$feeNames = array('Mortage Fee','Processing Fee','Appraisal Fee','Commitment Fee','Front-in Fee','Salesman Fee',
                  'Dealer Commission','Real Estate Fee','Insurance Prem.','Handling Fee',
                  'DPB Fee','Documentary Stamp','SBGFC Fee','Other Fee 1','Other Fee 2');

$toPrint = "";
for($i=0;$i < count($dbName); $i++){
    $dbName[$i] .= "_fee";
    if($client[$dbName[$i]] > 0){
        $toPrint .= " ".$i;
    }
    $dbName[$i] = str_replace('_fee','',$dbName[$i]);
}

$toPrint = explode(' ',$toPrint);

$toPrint = array_filter($toPrint, function($val){return $val !== "";});
$toPrint = explode(' ',implode(' ',$toPrint));

$pdf->Cell($gridFee,4,'Fee Detail ',1,0,'C');
$pdf->Cell($gridFee,4,'Amount',1,0,'C');
$pdf->Cell($gridFee,4,'O.R',1,0,'C');
$pdf->Cell($gridFee,4,'CV',1,0,'C');
$pdf->Cell($gridFee,4,'',1,1,'C');

$plugIn = array('_fee','_or','_total','_total');
$limit = 4;

if($toPrint[0] != ""){
for($i=0;$i < count($toPrint) ; $i++){
    $pdf->Cell($gridFee,4,$feeNames[$toPrint[$i]],1,0);
    for($b=0;$b<$limit;$b++){
        $val = '';
            if($b == 1 && ($dbName[$toPrint[$i]] == 'sm' || $dbName[$toPrint[$i]] == 'dealer')){
                if($dbName[$toPrint[$i]] == 'sm'){
                    $val = $salesmanName;
                }else{
                    $val = $dealerName;
                }          
            }else{
                $val = convert($client[$dbName[$toPrint[$i]].$plugIn[$b]]);
            }

            if($b == $limit - 1){
                $pdf->Cell($gridFee,4,$val,1,1,'R');
                $pdf->SetFont('Arial','B',8);
            }else{
                if(($dbName[$toPrint[$i]] == 'sm' || $dbName[$toPrint[$i]] == 'dealer') && $b == 1){
                    $pdf->SetFont('Arial','B',5);
                }else{
                    $pdf->SetFont('Arial','B',8);
                }
                $pdf->Cell($gridFee,4,$val,1,0,'R');
                $pdf->SetFont('Arial','B',8);
            }
    }
}
}

$pdf->Cell($gridFee,4,'',1,0,'C');
$pdf->Cell($gridFee,4,'',1,0,'C');
$pdf->Cell($gridFee,4,convert($client['or_amount']),1,0,'R');
$pdf->Cell($gridFee,4,'',1,0,'C');
$pdf->Cell($gridFee,4,convert($client['amount_due']),1,1,'R');

$payee = array('payee1','payee2','payee3','payee4','payee5');
$toPayee = "";
for($i = 0 ; $i < count($payee); $i++){
    if($client[$payee[$i]] != "" && $client[$payee[$i]] != null){
        $toPayee .= " ".$i;
    }
}
$toPayee = array_filter(explode(' ', $toPayee), function($val) {return $val !== "";});
$toPayee = explode(' ',implode(' ',$toPayee));

for($i = 0 ;$i < count($toPayee); $i++){
    $pdf->Cell(98,5,'DUE TO: '.$client[$payee[$i]],1,0);
    $pdf->Cell(98,5,isEmptyFloat($client["amount_".$payee[$i]]),1,1,'C');
}

$pdf->Cell(196,2,'',0,1);
$pdf->Cell(98,5,'Check Voucher No.: __________________________________________',0,0,'L');
$pdf->Cell(98,5,'Date.: __________________________________________',0,1,'R');

$pdf->Cell(196,7,'============================================================================================================================',0,1,'C');

$pdf->Cell(65.33,3,'PREPARED BY: ',0,0,'L');
$pdf->Cell(65.33,3,'CERTIFIED CORRECT:',0,0,'L');
$pdf->Cell(65.33,3,'FOR CHECK PREPARATION',0,1,'L');

$pdf->Cell(65.33,3,'MARKETING DEPARTMENT',0,0,'L');
$pdf->Cell(65.33,3,'MARKETING DEPARTMENT',0,0,'L');
$pdf->Cell(65.33,3,'ACCOUNTING DEPARTMENT',0,1,'L');

$pdf->Cell(65.33,3,'________________________',0,0,'L');
$pdf->Cell(65.33,3,'________________________',0,0,'L');
$pdf->Cell(65.33,3,'_________________________',0,1,'L');

$pdf->Cell(65.33,5,'Authorized Signature',0,0,'L');
$pdf->Cell(65.33,5,'Authorized Signature',0,0,'L');
$pdf->Cell(65.33,5,'Authorized Signature',0,1,'L');

$pdf->Cell(65.33,3,'Date:___________________',0,0,'L');
$pdf->Cell(65.33,3,'Date:___________________',0,0,'L');
$pdf->Cell(65.33,3,'Date:_____________________',0,1,'L');

$pdf->Output();

