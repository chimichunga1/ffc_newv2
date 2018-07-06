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

$client = $con->myQuery("SELECT * FROM instruction_sheet_addon WHERE id = ?",array($_POST['tbl_id']))->fetch(PDO::FETCH_ASSOC);
$collat = $con->myQuery("SELECT * FROM collateral_info WHERE loan_list_id = :app_no AND client_no = :client_no AND is_deleted = 0 LIMIT 5",array(
    "app_no" => $client['loan_list_id'],
    'client_no' => $client['client_no']
));

$collatVar = array( 
    'assigne'=>'assigne',
    'unitdesc'=>'unitdesc',
    'motorno'=>'motorno',
    'chassisno'=>'chassisno',
    'plateno'=>'plateno',
    'insco'=>'insco',
    'policyno'=>    'policyno',
    'ltoagency' =>'ltoagency',
    'expdate'=>    'expdate',
    'ltocr'=>    'ltocr',
    'ltoor'=>    'ltoor'
);

$inputs['client_name'] = strtoupper($client['bor_name']);
$inputs['contract_no'] = "RDLA2201801002";
$inputs['cur_date'] = date("F d, Y");
$filename = "is[{$client['bor_name']}]";

for($i = 0; $i<5;$i++){
    $inputs[$collatVar['assigne'].($i+1)] = "";
    $inputs[$collatVar['unitdesc'].($i+1)] = "";
    $inputs[$collatVar['motorno'].($i+1)] = "";
    $inputs[$collatVar['chassisno'].($i+1)] = "";
    $inputs[$collatVar['insco'].($i+1)] = "";
    $inputs[$collatVar['policyno'].($i+1)] = "";
    $inputs[$collatVar['expdate'].($i+1)] = "";
    $inputs[$collatVar['ltocr'].($i+1)] = "";
    $inputs[$collatVar['ltoor'].($i+1)] = "";
    $inputs[$collatVar['plateno'].($i+1)] = "";
    $inputs[$collatVar['ltoor'].($i+1)] = "";
    $inputs[$collatVar['ltoagency'].($i+1)] = "";
}
$i=1;
while($row = $collat->fetch(PDO::FETCH_ASSOC)){
    $inputs[$collatVar['assigne'].$i] = $row['assignee'];
    $inputs[$collatVar['unitdesc'].$i] = $row['unit_description'];
    $inputs[$collatVar['motorno'].$i] = $row['location_motor'];
    $inputs[$collatVar['chassisno'].$i] = $row['tct_no'];
    $inputs[$collatVar['insco'].$i] = $row['insurance_comp_no'];
    $inputs[$collatVar['policyno'].$i] = $row['policy_no'];
    $inputs[$collatVar['expdate'].$i] = date_format(date_create($row['exp_date']),'m/d/Y');
    $inputs[$collatVar['ltocr'].$i] = $row['cr_no'];
    $inputs[$collatVar['ltoor'].$i] = $row['or_no'];
    $inputs[$collatVar['ltoagency'].$i] = $row['lto_agency'];
    $inputs[$collatVar['plateno'].$i] = $row['plate_no'];
    $i++;
}
$term = "30 days";
$inputs['dealer'] = "Dummy. Dealer";//(dummy)
$inputs['salesman'] = "Dummy. Salesman";//(dummy)
$inputs['date_granted'] = date_sub(date_create($client['start_date']),date_interval_create_from_date_string($term));
$inputs['date_granted'] = "02/02/02";//(dummy)date_format($inputs['date_granted'],"m/d/Y");
$inputs['ref_comp'] = "CV 54023 ";//(dummy)
$inputs['lcp'] = "0.00";//(dummy)
$inputs['dp'] = "0.00";//(dummy)
$inputs['af'] = number_format($client['amount_fin'],2,'.',',');
$inputs['pn_amount'] = number_format($client['amount_pn'],2,'.',',');
$inputs['rcf'] = number_format($client['rcf'],2,'.',',');
$inputs['tlv'] = number_format($client['TLV'],2,'.',',');
$inputs['red_val'] = "0.00";// (dummy)
$inputs['udi'] = number_format($client['udi_bal'],2,'.',',');
$inputs['date_pn'] = date_sub(date_create($client['start_date']),date_interval_create_from_date_string($term));
$inputs['date_pn'] = "02/02/02 ";/*(dummy)date_format($inputs['date_pn'],"m/d/Y");*/
$inputs['addon_rate'] = number_format($client['addon_rate'],2,'.',',');
$inputs['udi_rate'] = number_format($client['less_udi_percent'],2,'.',',');

$inputs['bal'] = "0.00";//(dummy)
$inputs['overpay'] = "0.00";//(dummy)
$inputs['pastdue'] = "0.00";//(dummy)
$inputs['md_arrear'] = "0.00";//(dummy)
$inputs['last_trans'] = "02/02/02 ";//(dummy)
$inputs['ref_stat'] = "OR 24134";//(dummy)
$inputs['date_filed'] = "02/02/02 ";//(dummy)
$inputs['case_no'] = "";//(dummy)

$inputs['start_date'] = date_format(date_create($client['start_date']),'m/d/Y');
$inputs['mat_date'] = date_format(date_create($client['maturity_date']),'m/d/Y');
$inputs['due_date'] = date_format(date_create($client['due_date']),'m/d/Y');
$inputs['fir_mon'] = number_format($client['mon_first_payment'],2,'.',',');
$inputs['sec_mon'] = number_format($client['mon_second_payment'],2,'.',',');
$inputs['fir_mon_udi'] = number_format($client['udi_first_mon'],2,'.',',');
$inputs['sec_mon_udi'] = number_format($client['udi_second_mon'],2,'.',',');
$inputs['mon_rcf'] = number_format($client['rebate_rcf'],2,'.',',');
$inputs['term'] = $client['term'];
$inputs['rem_term'] = ($client['term'] - 1);

$inputs['day130'] = "0.00";//(dummy)
$inputs['day160'] = "0.00";//(dummy)
$inputs['day190'] = "0.00";//(dummy)
$inputs['day1120'] = "0.00";//(dummy)
$inputs['dayplus'] = "0.00";//(dummy)
$inputs['late_payment'] = "0.00";//(dummy)
$inputs['handling_fee'] = "0.00";//(dummy)
$inputs['bounce'] = "0.00";//(dummy)
$inputs['experience'] ="";//(dummy)
$inputs['remarks'] = "";//(dummy)

$rtf=file_get_contents('instruction_addon.rtf');
$rtf=str_replace("\r\n", '',$rtf);
foreach($inputs as $tag => $value)
    $rtf= str_replace('\{'.$tag.'\}',$value,$rtf);
    header('Content-type: application/rtf');
    header("Content-Disposition: attachment;filename=is_sheet.rtf");
    header('Pragma:no-cache');
    header('Expires:0');

    echo $rtf;
exit;



// print_r($client);
// print_r($collat);


