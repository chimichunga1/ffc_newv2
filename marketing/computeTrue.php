<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }


   $compute = $con->myQuery("SELECT SUM(amount_sched) AS Amount,SUM(discount) AS discount,SUM(net_proceeds_sched) AS net_proceeds
                             FROM td_sched 
                             WHERE app_no = ? AND is_deleted = 0
                             ORDER BY date_created DESC",array($data['app_no']))->fetch(PDO::FETCH_ASSOC);

$term = $con->myQuery("SELECT term_sched
FROM td_sched 
WHERE app_no = ? AND is_deleted = 0
ORDER BY date_created DESC LIMIT 1",array($data['app_no']))->fetch(PDO::FETCH_ASSOC);

$saveTerm = !empty($term['term_sched'])?$term['term_sched']:0;
$termDays = $saveTerm. " days";
$sDay = $con->myQuery("SELECT * FROM instruction_sheet_td WHERE app_no = ? AND is_deleted = 0",array($data['app_no']))->fetch(PDO::FETCH_ASSOC);
$startDate = date_format(date_create($sDay['start_date']),'m/d/Y');
$matDay = date_add(date_create($startDate),date_interval_create_from_date_string($termDays));
$matDay = date_format($matDay,'Y-m-d');
$inputs['maturity_date'] = $saveTerm == 0 ? "0000-00-00" : $matDay;
$inputs['amount_pn'] = !empty($compute['Amount'])?$compute['Amount']: 0.0;
$inputs['discount'] = !empty($compute['discount'])?$compute['discount']: 0.0;
$inputs['net_proceeds'] = !empty($compute['net_proceeds'])?$compute['net_proceeds']:0.0;
$inputs['term'] = $saveTerm;
$inputs['amount_due'] = !empty($compute['net_proceeds'])?(float)($compute['net_proceeds'] - $sDay['amount_deduct']):$sDay['amount_due'];

$set = "";
$count = count($inputs) - 1;
$i = 0;
foreach($inputs AS $key => $value){
        if($i == $count){
            $set .= $key . " = :".$key;
        }else{
            $set .= $key . " = :".$key.", ";
        }
        $i++;
}
$con->beginTransaction();

$authUpdate = $con->myQuery("UPDATE instruction_sheet_td SET ".$set." WHERE app_no = ".$data['app_no']." AND is_deleted = 0",$inputs);
$con->commit();