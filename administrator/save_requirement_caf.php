<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
      }
      $errro="";
      $con->beginTransaction();
      $id='';
      if(isset($_POST['submit'])){
            $loan_type_id="";
            $check = $con->myQuery("SELECT caf FROM requirements WHERE requirement_code=?",array($_POST['reqAvail']))->fetch(PDO::FETCH_ASSOC);
            if(empty($check['caf'])){
                  $loan_type_id.=$_POST['id'].",";
            }else{
                  $loan_type_id.=$check['caf'].$_POST['id'].",";
            }
            $id.="?id=".$_POST['id'];
            $con->myQuery("UPDATE requirements SET caf=:loan_type_id WHERE requirement_code=:req_code",array('loan_type_id'=>$loan_type_id,'req_code'=>$_POST['reqAvail']));
            Alert("Successfully added",'success');
      }        
      $con->commit();
      redirect("frm_requirement_caf.php".$id);