<?php
require_once("../support/config.php");
 if(!isLoggedIn()){
 	toLogin();
 	die();
 }
    if(!isset($_POST['tbl_id']) || empty($_POST['tbl_id'])){
        redirect('instruction_sheet_prep.php');
        Alert('Error in table id','warning');
	}
	$auth = $con->myQuery("SELECT * FROM instruction_sheet WHERE id = ?",array($_POST['tbl_id']))->fetchColumn();
    if($auth == 0 ){
        redirect('instruction_sheet_prep.php');
        Alert('User not found','warning');
	}
	$client = $con->myQuery("SELECT * FROM instruction_sheet WHERE id = ?",array($_POST['tbl_id']))->fetch(PDO::FETCH_ASSOC);
	$collat = $con->myQuery("SELECT * FROM collateral_info WHERE loan_list_id = :app_no AND client_no = :client_no AND is_deleted = 0 LIMIT 7",array(
    "app_no" => $client['ll_id'],
    'client_no' => $client['client_no']
));
$clientBInfo = $con->myQuery("SELECT 
B.code AS loan_type_code , 
C.code AS credit_facility_code, 
D.code AS prod_line_code, 
E.code AS marketing_type_code
FROM loan_list A
JOIN loan_approval_type B ON A.loan_type_id = B.id
JOIN credit_facility C ON A.credit_fac_id = C.id 
JOIN product_line D ON A.prod_line_id = D.id
JOIN marketing_type E ON A.mark_type_id = E.id
WHERE A.id = :app_id
",array('app_id'=> $client['ll_id']))->fetch(PDO::FETCH_ASSOC);
$clientOInfo = $con->myQuery("SELECT B.name AS bus_code, C.name AS ind_code
FROM client_list A
JOIN business_type B ON A.bus_type_id = B.id
JOIN industry_code C ON A.ind_code_id = C.id
WHERE A.client_number = :client_num",array('client_num'=>$client['client_no']))->fetch(PDO::FETCH_ASSOC);


$inputs['curdate'] = date('F d, Y');
$inputs['appno'] = $client['app_no'];
$inputs['borname'] = $client['bor_name'];
$inputs['spouse'] = $client['spouse'];
$inputs['address'] = $client['address'];
$inputs['clientno'] = $client['client_no'];
$inputs['stat'] = $client['client_stat'];
$inputs['pricon'] = $client['pri_con'];
$inputs['indcode'] = $clientOInfo['ind_code'];
$inputs['bustype'] = "BS";
$inputs['loantype'] = $clientBInfo['loan_type_code'];
$inputs['prodline'] = $clientBInfo['prod_line_code'];
$inputs['credfac'] = $clientBInfo['credit_facility_code'];
$inputs['mkttype'] = $clientBInfo['marketing_type_code'];

$collatVar = array( 
    'facility'=>'facility',
    'engineno'=>'engineno',
    'chassisno'=>'chassisno',
    'plateno'=>'plateno',
    'lcpav'=>'lcpav',
    'ltooff'=>'ltooff',
    'ltocr'=>    'ltocr',
    'ltoor' =>'ltoor',
    'date'=>    'date',
    'insco'=>    'insco',
	'policy'=>    'policy',
	'expdate'=>    'expdate',
	'tuacc'=>    'tuacc',
	'unit'=>    'unit',
	'engineno_'=>    'engineno_',
	'chassisno_'=>    'chassisno_',
	'plateno_'=>    'plateno_'
);

for($i = 0; $i<7;$i++){
    $inputs[$collatVar['facility'].($i+1)] = "";
    $inputs[$collatVar['engineno'].($i+1)] = "";
    $inputs[$collatVar['chassisno'].($i+1)] = "";
    $inputs[$collatVar['plateno'].($i+1)] = "";
    $inputs[$collatVar['lcpav'].($i+1)] = "";
    $inputs[$collatVar['ltooff'].($i+1)] = "";
    $inputs[$collatVar['ltocr'].($i+1)] = "";
	$inputs[$collatVar['ltoor'].($i+1)] = "";
	$inputs[$collatVar['date'].($i+1)] = "";
    $inputs[$collatVar['insco'].($i+1)] = "";
    $inputs[$collatVar['policy'].($i+1)] = "";
    $inputs[$collatVar['expdate'].($i+1)] = "";
	$inputs[$collatVar['tuacc'].($i+1)] = "";
	$inputs[$collatVar['unit'].($i+1)] = "";
	$inputs[$collatVar['engineno_'].($i+1)] = "";
	$inputs[$collatVar['chassisno_'].($i+1)] = "";
	$inputs[$collatVar['plateno_'].($i+1)] = "";
}

$i=1;
while($row = $collat->fetch(PDO::FETCH_ASSOC)){
    $inputs[$collatVar['facility'].$i] = $row['unit_description'];
    $inputs[$collatVar['engineno'].$i] = $row['location_motor'];
    $inputs[$collatVar['chassisno'].$i] = $row['tct_no'];
    $inputs[$collatVar['plateno'].$i] = $row['tct_no'];
    $inputs[$collatVar['lcpav'].$i] = !empty($row['approve_value'])?number_format($row['approve_value'],2,'.',','):'';
	$inputs[$collatVar['ltooff'].$i] = $row['lto_agency'];
	$inputs[$collatVar['ltocr'].$i] = $row['cr_no'];
	$inputs[$collatVar['ltoor'].$i] = $row['or_no'];
	$inputs[$collatVar['date'].$i] = date_format(date_create($row['collat_created_date']),'m/d/Y');
	$inputs[$collatVar['insco'].$i] = $row['insurance_comp'];
	$inputs[$collatVar['policy'].$i] = $row['policy_no'];
    $inputs[$collatVar['expdate'].$i] = date_format(date_create($row['exp_date']),'m/d/Y');
    $inputs[$collatVar['tuacc'].$i] = "";
    $inputs[$collatVar['unit'].$i] = "";
    $inputs[$collatVar['engineno_'].$i] = "";
	$inputs[$collatVar['chassisno_'].$i] = "";
	$inputs[$collatVar['plateno_'].$i] = "";
    $i++;
}

$inputs['term'] = $client['term'];
if(empty($client['list_cash_price']) || (float)$client['list_cash_price'] == 0){
	$inputs['lcp'] = !empty($client['appraised_value'])?number_format($client['appraised_value'],2,'.',','):"0.00";
}else{
	$inputs['lcp'] = !empty($client['list_cash_price'])?number_format($client['list_cash_price'],2,'.',','):"0.00";
}

$inputs['dp'] = !empty($client['dp_gd_rv'])?number_format($client['dp_gd_rv'],2,'.',','):"0.00";
$inputs['amtfin'] = !empty($client['amount_fin'])?number_format($client['amount_fin'],2,'.',','):"0.00";
$inputs['pnamt']  = !empty($client['amount_pn'])?number_format($client['amount_pn'],2,'.',','):"0.00";
$inputs['rcf']  = !empty($client['rcf'])?number_format($client['rcf'],2,'.',','):"0.00";
$inputs['tlv']  = !empty($client['TLV'])?number_format($client['TLV'],2,'.',','):"0.00";
$inputs['addonrate']  = !empty($client['addon_rate'])?number_format($client['addon_rate'],2,'.',','):"0.00";
$inputs['monfirst'] = !empty($client['mon_first_payment'])?number_format($client['mon_first_payment'],2,'.',','):"0.00";
$inputs['monsec'] = !empty($client['mon_second_payment'])?number_format($client['mon_second_payment'],2,'.',','):"0.00";
$inputs['startdate'] = date_format(date_create($client['start_date']),'m/d/Y');
$inputs['maturitydate'] = date_format(date_create($client['maturity_date']),'m/d/Y');
$inputs['duedate'] = $client['due_date'];
$inputs['valdate']  = date_format(date_create($client['value_date']),'m/d/Y');
$inputs['rebate'] = !empty($client['rebate_rcf'])?number_format($client['rebate_rcf'],2,'.',','):"0.00";
switch($client['manner_payment']){
	case "pdc":
	$inputs['manner'] = "PostDated Checks";
	break;
	case "collection":
	$inputs['manner'] = "Collection";
	break;
	case "sd":
	$inputs['manner'] = "Salary Deduct";
	break;
}
$inputs['lessper'] = !empty($client['less_udi_percent'])?number_format($client['less_udi_percent'],2,'.',','):"0.00";
$inputs['lessamt'] = !empty($client['less_total'])?number_format($client['less_total'],2,'.',','):"0.00";
$inputs['lesstotal'] = !empty($client['udi_bal'])?number_format($client['udi_bal'],2,'.',','):"0.00";
$inputs['orno']= $client['or_no'];
$inputs['ordate'] = !empty($client['or_date'])?date_format(date_create($client['or_date']),'m/d/Y'):" /  / ";

$inputs['mortfee'] = !empty($client['mort_fee'])?number_format($client['mort_fee'],2,'.',','):"0.00";
$inputs['procfee'] = !empty($client['proc_fee'])?number_format($client['proc_fee'],2,'.',','):"0.00";
$inputs['apprfee'] = !empty($client['apprais_fee'])?number_format($client['apprais_fee'],2,'.',','):"0.00";
$inputs['commitfee'] = !empty($client['comm_fee'])?number_format($client['comm_fee'],2,'.',','):"0.00";
$inputs['frontfee'] = !empty($client['front_fee'])?number_format($client['front_fee'],2,'.',','):"0.00";
$inputs['smfee'] = !empty($client['sm_fee'])?number_format($client['sm_fee'],2,'.',','):"0.00";
$inputs['dlfee'] = !empty($client['dealer_fee'])?number_format($client['dealer_fee'],2,'.',','):"0.00";
$inputs['refee'] = !empty($client['real_estate_fee'])?number_format($client['real_estate_fee'],2,'.',','):"0.00";
$inputs['insupremfee'] = !empty($client['insur_prem_fee'])?number_format($client['insur_prem_fee'],2,'.',','):"0.00";
$inputs['handlingfee'] = !empty($client['handling_fee'])?number_format($client['handling_fee'],2,'.',','):"0.00";
$inputs['dpbfee'] = !empty($client['dpb_fee'])?number_format($client['dpb_fee'],2,'.',','):"0.00";
$inputs['docstampfee'] = !empty($client['doc_fee'])?number_format($client['doc_fee'],2,'.',','):"0.00";
$inputs['sbgfcfee'] = !empty($client['sbgfc_fee'])?number_format($client['sbgfc_fee'],2,'.',','):"0.00";
$inputs['otheronefee'] = !empty($client['other_one_fee'])?number_format($client['other_one_fee'],2,'.',','):"0.00";
$inputs['othertwofee'] = !empty($client['other_two_fee'])?number_format($client['other_two_fee'],2,'.',','):"0.00";

$inputs['mortor'] = !empty($client['mort_or'])?number_format($client['mort_or'],2,'.',','):"0.00";
$inputs['procor'] = !empty($client['proc_or'])?number_format($client['proc_or'],2,'.',','):"0.00";
$inputs['appror'] = !empty($client['apprais_or'])?number_format($client['apprais_or'],2,'.',','):"0.00";
$inputs['commitor'] = !empty($client['comm_or'])?number_format($client['comm_or'],2,'.',','):"0.00";
$inputs['frontor'] = !empty($client['front_or'])?number_format($client['front_or'],2,'.',','):"0.00";
$inputs['smor'] = !empty($client['sm_or'])?number_format($client['sm_or'],2,'.',','):"0.00";
$inputs['dlor'] = !empty($client['dealer_or'])?number_format($client['dealer_or'],2,'.',','):"0.00";
$inputs['reor'] = !empty($client['real_estate_or'])?number_format($client['real_estate_or'],2,'.',','):"0.00";
$inputs['insupremor'] = !empty($client['insur_prem_or'])?number_format($client['insur_prem_or'],2,'.',','):"0.00";
$inputs['handlingor'] = !empty($client['handling_or'])?number_format($client['handling_or'],2,'.',','):"0.00";
$inputs['dpbor'] = !empty($client['dpb_or'])?number_format($client['dpb_or'],2,'.',','):"0.00";
$inputs['docstampor'] = !empty($client['doc_or'])?number_format($client['doc_or'],2,'.',','):"0.00";
$inputs['sbgfcor'] = !empty($client['sbgfc_or'])?number_format($client['sbgfc_or'],2,'.',','):"0.00";
$inputs['otheroneor'] = !empty($client['other_one_or'])?number_format($client['other_one_or'],2,'.',','):"0.00";
$inputs['othertwoor'] = !empty($client['other_two_or'])?number_format($client['other_two_or'],2,'.',','):"0.00";

$inputs['morttotal'] = !empty($client['mort_total'])?number_format($client['mort_total'],2,'.',','):"0.00";
$inputs['proctotal'] = !empty($client['proc_total'])?number_format($client['proc_total'],2,'.',','):"0.00";
$inputs['apprtotal'] = !empty($client['apprais_total'])?number_format($client['apprais_total'],2,'.',','):"0.00";
$inputs['committotal'] = !empty($client['comm_total'])?number_format($client['comm_total'],2,'.',','):"0.00";
$inputs['fronttotal'] = !empty($client['front_total'])?number_format($client['front_total'],2,'.',','):"0.00";
$inputs['smtotal'] = !empty($client['sm_total'])?number_format($client['sm_total'],2,'.',','):"0.00";
$inputs['dltotal'] = !empty($client['dealer_total'])?number_format($client['dealer_total'],2,'.',','):"0.00";
$inputs['retotal'] = !empty($client['real_estate_total'])?number_format($client['real_estate_total'],2,'.',','):"0.00";
$inputs['insupremtotal'] = !empty($client['insur_prem_total'])?number_format($client['insur_prem_total'],2,'.',','):"0.00";
$inputs['handlingtotal'] = !empty($client['handling_total'])?number_format($client['handling_total'],2,'.',','):"0.00";
$inputs['dpbtotal'] = !empty($client['dpb_total'])?number_format($client['dpb_total'],2,'.',','):"0.00";
$inputs['docstamptotal'] = !empty($client['doc_total'])?number_format($client['doc_total'],2,'.',','):"0.00";
$inputs['sbgfctotal'] = !empty($client['sbgfc_total'])?number_format($client['sbgfc_total'],2,'.',','):"0.00";
$inputs['otheronetotal'] = !empty($client['other_one_total'])?number_format($client['other_one_total'],2,'.',','):"0.00";
$inputs['othertwototal'] = !empty($client['other_two_total'])?number_format($client['other_two_total'],2,'.',','):"0.00";

$inputs['payee1'] = strtoupper($client['payee1']);
$inputs['amtdue'] = !empty($client['amount_due'])?number_format($client['amount_due'],2,'.',','):"0.00";
// print_r($inputs);
// die();
$rtf=file_get_contents('instruction_sheet_addon.rtf');
$rtf=str_replace("\r\n", '',$rtf);

foreach($inputs as $tag => $value)
    $rtf= str_replace('\{'.$tag.'\}',$value,$rtf);
    header('Content-type: application/rtf');
    header("Content-Disposition: attachment;filename=is_sheet_addon.rtf");
    header('Pragma:no-cache');
    header('Expires:0');

    echo $rtf;
exit;
