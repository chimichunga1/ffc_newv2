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
                        JOIN loan_status B ON B.id = A.loan_status_id
                        JOIN loan_approval_type C ON C.id = A.loan_type_id
                        WHERE loan_status_id >= 6");
  while($row = $data->fetch(PDO::FETCH_ASSOC)){
    $dataIn = array(
      'app_no' => $row['ApplicationNo'],
      'client_no' => $row['ClientNo']
    );

    $check = $con->myQuery("SELECT * FROM client_requirements_caf WHERE client_no=:client_no AND app_no=:app_no AND is_deleted=0",array('client_no'=>$row['ClientNo'], 'app_no'=>$row['ApplicationNo']))->fetchColumn();
    if($check <= 0){
      $getReq = $con->myQuery("SELECT * FROM requirements WHERE caf LIKE '%".$row['loan_id']."%' AND is_deleted=0");
      while($row1 = $getReq->fetch(PDO::FETCH_ASSOC)){
          $dataInsert = array(
          'req_name'=>$row1['name'],
          'req_code'=>$row1['requirement_code'],
          'status'=>'pending', 
          'client_no'=>$row['ClientNo'],
          'app_no'=>$row['ApplicationNo']);
         
        $con->myQuery("INSERT 
        INTO client_requirements_caf(requirement_name, requirement_code, status, client_no, app_no) 
        VALUES(:req_name, :req_code, :status, :client_no, :app_no)", $dataInsert);
      }
    }else{
      $CountReq = $con->myQuery("SELECT * FROM requirements WHERE caf LIKE '%".$row['loan_id']."%' AND is_deleted=0 ORDER BY requirement_code");
      
      $userReq = $con->myQuery("SELECT * FROM client_requirements_caf WHERE client_no=:client_no AND app_no=:app_no AND is_deleted=0 ORDER BY requirement_code",array('client_no'=>$row['ClientNo'],'app_no'=>$row['ApplicationNo']));

        if(count($CountReq->fetchAll(PDO::FETCH_ASSOC)) !== count($userReq->fetchAll(PDO::FETCH_ASSOC))){
           //Ayusin mo after mo nt matapos ung marketing module #Urgent Fix
        }else{
            //Ayusin mo after mo nt matapos ung marketing module #Urgent Fix
        }
    }
  }

$con->commit();

