<?php
require_once("../support/config.php");
if(!isLoggedIn()){
    toLogin();
    die();
  }
  if(empty($_POST['id'])){
      redirect('checklist_entry_update.php');
  }
  $con->beginTransaction();
    if(isset($_POST['submit'])){    
        $query = "";
        $i = 0;
        foreach($_POST['status'] as $key => $value){
            if(!empty($_POST['status'])){
                $auth = $con->myQuery("UPDATE client_requirements_cf SET status = :value WHERE requirement_code = :code 
                                                                                        AND application_no = :app_no 
                                                                                        AND client_no = :client_no 
                                                                                        AND is_deleted = 0",array('app_no' => $_POST['app_no'],
                                                                                                                  'client_no'=> $_POST['client_no'],
                                                                                                                  'value' => $value,
                                                                                                                  'code' => $key));
            }    
        }
    }
    $con->commit();
    redirect("checklist_checking_form.php?id=".$_POST['id'].$_POST['ml']);
    Alert('Successfully Updated Checklist','success');