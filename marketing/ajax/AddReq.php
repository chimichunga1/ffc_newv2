<?php
require_once("../../support/config.php");

if(!empty($_POST['code']) && !empty($_POST['appNo']) && !empty($_POST['clientNo']) ){
 
    foreach($_POST['code'] AS $val) {
    $con->beginTransaction();
    $auth = $con->myQuery("SELECT * FROM requirements WHERE requirement_code = ? AND is_deleted = 0",array($val));
    if($auth->rowCount() <= 0){continue;die;}
    $data = $auth->fetch(PDO::FETCH_ASSOC);
    $authUser = $con->myQuery("SELECT * FROM loan_list WHERE app_no = ? AND client_no = ? AND is_deleted = 0",array($_POST['appNo'],$_POST['clientNo']));
    if($authUser->rowCount() <= 0){break;die;}
    $isAvail = $con->myQuery("SELECT * FROM client_requirements_caf WHERE requirement_code = ? AND client_no = ? AND app_no = ? AND is_deleted = 1",
                             array($val,$_POST['clientNo'],$_POST['appNo']));
    
    if($isAvail->rowCount() > 0){
        $isData = $isAvail->fetch(PDO::FETCH_ASSOC);
        $stat = $con->myQuery("UPDATE client_requirements_caf SET is_deleted = 0 WHERE id = ?",array($isData['id']));
        
    }
    if($isAvail->rowCount() <= 0){
        $stat = $con->myQuery("INSERT INTO client_requirements_caf (requirement_name, requirement_code,client_no,app_no) VALUES (?,?,?,?)",
                      array($data['name'],$data['requirement_code'],$_POST['clientNo'],$_POST['appNo']));
                      
    }             
    
    $con->commit();
}
    
    
}