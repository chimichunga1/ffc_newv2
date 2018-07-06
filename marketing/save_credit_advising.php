<?php
require_once("../support/config.php");

if(!empty($_POST['create']) || !empty($_POST['edit'])){
    $authUser = $con->myQuery("SELECT * FROM loan_list WHERE id = ? AND client_no = ? AND is_deleted = 0",array($_POST['id'],$_POST['client_no']));
    if($authUser->rowCount() <= 0){
        redirect('credit_advising_form.php?id='.$_POST['id']);
        Alert('User not found','warning');
        die();
    }
    $data = $authUser->fetch(PDO::FETCH_ASSOC);
    $client = $con->myQuery("SELECT * FROM client_list WHERE client_number = ? AND is_deleted = 0",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);

    $inputs['client_no'] = $client['client_number'];
    $inputs['app_no'] = $data['app_no'];
    $inputs['client_name'] = $client['fname'] ." " . substr($client['mname'],0,1). ", ".$client['lname'];
    $inputs['client_name'] = strtoupper($inputs['client_name'] ); 
    $inputs['spouse'] = $data['spouse'];
    $inputs['co_maker'] = $_POST['co_maker'];
    $inputs['pri_con'] = $client['pri_con'];
    $inputs['address'] = $client['home_no'] . !empty($client['home_brgy'] ? ', Brgy. '.$client['home_brgy']:''. ", ". $client['home_city']);
    $inputs['dealer_id'] = empty($_POST['dealer'])?'':$_POST['dealer'];
    $inputs['salesman_id'] = empty($_POST['salesman'])?'':$_POST['salesman'];
    $inputs['unit'] = $_POST['unit'];
    $inputs['lcp'] = stripFloat($_POST['list_cash_price']);
    $inputs['av'] = stripFloat($_POST['appraised']);
    $inputs['downpayment'] = stripFloat($_POST['downpayment']);
    $inputs['amount_fin'] = stripFloat($_POST['amount_financed']);
    $inputs['term'] = isEmptyInt($_POST['term']);
    $inputs['int_rate'] = $_POST['interest_rate'];
    $inputs['mon_first'] = stripFloat($_POST['monthly_payment']);
    $inputs['mon_second'] = stripFloat($_POST['second_payment']);
    $inputs['prepared_by'] = $_SESSION[WEBAPP]['user']['first_name'] . ' ' .$_SESSION[WEBAPP]['user']['middle_initial']." ". $_SESSION[WEBAPP]['user']['last_name'];
    $inputs['noted_by'] = "RAMON R. RAMOS";

    $status = $_POST['status'];
    $con->beginTransaction();
    foreach($status AS $key => $value){
        $con->myQuery("UPDATE client_requirements_caf SET status = ? WHERE requirement_code = ? AND client_no = ? AND app_no = ? AND is_deleted = 0",
                      array($value,$key,$data['client_no'],$data['app_no']));
    }
}

if(!empty($_POST['create']) && $_POST['create'] == "create"){
    $i = 0;
    $num = count($inputs);
    $names = "";
    $values = "";
    foreach($inputs AS $key => $value){
        if($i == $num -1){
            $names .= $key;
            $values .= ":".$key;
        }
            else{
                $names .= $key.", ";
                $values .= ":".$key.", ";
            }
        $i++;        
    }
    $authCreate = $con->myQuery("INSERT INTO caf_info({$names}) VALUES ({$values})",$inputs);
    
    redirect('credit_advising_form.php?id='.$_POST['id']."".$_POST['ml']);
    Alert('Successfully Saved','success');
    
    
}

if(!empty($_POST['edit']) && $_POST['edit'] == 'edit'){
    $i = 0;
    $num = count($inputs);
    $query = "";
    foreach($inputs AS $key => $value){
        if($i == $num - 1){
            $query .= $key." = :".$key;
        }else{
            $query .= $key." = :".$key.", ";
        }
        $i++;
    }
    // echo $query;
$updateAuth = $con->myQuery("UPDATE caf_info SET {$query} WHERE id = {$_POST['tblCaf']} AND is_deleted = 0",$inputs);

// print_r($updateAuth);
// die();
redirect('credit_advising_form.php?id='.$_POST['id']."".$_POST['ml']);
Alert('Update Successfully','success');
}
$con->commit();    
die();
