<?php
require_once("../support/config.php");

if(!empty($_GET['tblid']) && !empty($_GET['id'])){
    $authUser = $con->myQuery("SELECT * FROM loan_list WHERE id = ? AND is_deleted =0 ",array($_GET['id']));
    if($authUser->rowCount() <= 0){
        redirect('credit_advising.php');
        Alert('Unknown User','warning');
        die();
    }
    $data = $authUser->fetch(PDO::FETCH_ASSOC);
    $authReq = $con->myQuery("SELECT * FROM client_requirements_caf WHERE app_no = ? AND client_no = ? AND id = ? AND is_deleted = 0",
                            array($data['app_no'],$data['client_no'],$_GET['tblid']));
    if($authReq->rowCount() <= 0){
        redirect('credit_advising.php');
        Alert('Unknown Requirement','warning');
        die();
    }
    $con->beginTransaction();
    $con->myQuery("UPDATE client_requirements_caf SET is_deleted = 1 WHERE id = ?",array($_GET['tblid']));
    $con->commit();
    redirect("credit_advising_form.php?id=".$_GET['id']."#reqSel");
    Alert('Successfully Deleted Requirement','warning');
    die();

    
}