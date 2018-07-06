<?php

	require_once("../support/config.php");

	if(!isLoggedIn()){
	toLogin();
	die();
	}
	$errors="";
	$check=$con->myQuery("SELECT id FROM credit_facility WHERE code=? AND id!=? AND is_deleted=0",array($_POST['cf_code'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Credit Facility Code already exist.";
		}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("frm_credit_facility.php");}
				else{
				redirect("frm_credit_facility.php?id=".$_POST['id']);}
			die;
		}else{
		$con->beginTransaction();
		try {
			if(empty($_POST['id'])){
			$con->myQuery("INSERT INTO credit_facility(code,name) VALUES(?,?)",array($_POST['cf_code'],$_POST['cf_name']));
			Alert("Successfully Added.","success");}
			else{
			$con->myQuery("UPDATE credit_facility SET code=? , name=? WHERE id=?",array($_POST['cf_code'],$_POST['cf_name'],$_POST['id']));
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("credit_facility.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("credit_facility.php");
			die;
		}
	}
?>