<?php 
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}
$con->beginTransaction();
$data = $con->myQuery("SELECT A.app_no AS ApplicationNo, client_no AS ClientNo, B.name, C.name, C.id AS loan_id
                        FROM loan_list A 
                        JOIN loan_status B ON A.loan_status_id =  B.id
                        JOIN loan_approval_type C ON A.loan_type_id =  C.id 
                        WHERE loan_status_id = 8 AND A.is_deleted = 0");
  while($row = $data->fetch(PDO::FETCH_ASSOC)){
    $check = $con->myQuery("SELECT * FROM client_requirements_cf WHERE client_no=:client_no AND application_no=:app_no AND is_deleted=0",array('client_no'=>$row['ClientNo'], 'app_no'=>$row['ApplicationNo']))->fetchColumn();
    if($check <= 0){
      $getReq = $con->myQuery("SELECT * FROM requirements WHERE cf LIKE '%".$row['loan_id']."%' AND is_deleted=0");
      // echo "{$row['loan_id']} <br />";
      // print_r($getReq->fetchAll(PDO::FETCH_ASSOC));
      // die();
      while($row1 = $getReq->fetch(PDO::FETCH_ASSOC)){
          $dataInsert = array(
          'req_name'=>$row1['name'],
          'req_code'=>$row1['requirement_code'],
          'client_no'=>$row['ClientNo'],
          'app_no'=>$row['ApplicationNo']);
        $con->myQuery("INSERT 
        INTO client_requirements_cf(requirement_name, requirement_code, client_no, application_no) 
        VALUES(:req_name, :req_code, :client_no, :app_no)", $dataInsert);
      }
    }else{
      $CountReq = $con->myQuery("SELECT * FROM requirements WHERE cf LIKE '%".$row['loan_id']."%' AND is_deleted=0 ORDER BY requirement_code");
      
      $userReq = $con->myQuery("SELECT * FROM client_requirements_cf WHERE client_no=:client_no AND application_no=:app_no AND is_deleted=0 ORDER BY requirement_code",array('client_no'=>$row['ClientNo'],'app_no'=>$row['ApplicationNo']));

        if(count($CountReq->fetchAll(PDO::FETCH_ASSOC)) !== count($userReq->fetchAll(PDO::FETCH_ASSOC))){
           //Ayusin mo after mo nt matapos ung marketing module #Urgent Fix
        }else{
            //Ayusin mo after mo nt matapos ung marketing module #Urgent Fix
        }
    }
  }

$con->commit();

