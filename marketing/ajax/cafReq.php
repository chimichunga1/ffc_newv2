<?php
require_once("../../support/config.php");

if(!empty($_POST['loanCode']) && !empty($_POST['id'])){
    if(!filter_var($_POST['loanCode'],FILTER_VALIDATE_INT)){
        die();
    }
    $auth = $con->myQuery("SELECT * FROM loan_approval_type WHERE id = ? AND is_deleted = 0",array($_POST['loanCode']))->rowCount();
    if($auth <= 0){
        die();
    }
    $authUser = $con->myQuery("SELECT * FROM loan_list WHERE id = ? AND loan_type_id = ? AND is_deleted = 0 AND loan_status_id >= 6",array($_POST['id'],$_POST['loanCode']));
    if($authUser->rowCount() <= 0){die();}
    $data = $authUser->fetch(PDO::FETCH_ASSOC);
    $availReq = $con->myQuery("SELECT * FROM client_requirements_caf WHERE app_no = ? AND client_no = ? AND is_deleted = 0",array($data['app_no'],$data['client_no']));
    
    $queryCode = "''";

    if($availReq->rowCount() > 0){
        $queryCode = "";
        while($row = $availReq->fetch(PDO::FETCH_ASSOC)){
            $reqCode[] = $row['requirement_code'];
        }
        for($i = 0; $i<count($reqCode);$i++){
            if($i == 0){$queryCode .= "'{$reqCode[$i]}'";}
                else{$queryCode .= ",'{$reqCode[$i]}'";}
        }
    }
    // // echo print_r($authUser->fetch(PDO::FETCH_ASSOC));
    // echo $availReq->rowCount();
    // // echo json_encode($availReq->fetch(PDO::FETCH_ASSOC));
    // print_r($reqCode);

    $req = $con->myQuery("SELECT * FROM requirements WHERE requirement_code NOT IN ({$queryCode}) AND is_deleted = 0");
    $option = "<option value=''></option>";
        while($row = $req->fetch(PDO::FETCH_ASSOC)){
            $option .= "<option value='{$row['requirement_code']}'>{$row['name']}</option>";
        }
    if($req->rowCount() > 0){
        $sel[0]['name'] = "reqSel";
        $sel[0]['value'] = $option;
    }else{
        $sel = NULL;
    }
    
}

    echo json_encode($sel);
    die();