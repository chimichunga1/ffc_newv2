<?php

	require_once("../support/config.php");
	if(!isLoggedIn()){
		toLogin();
		die();
	}
	$errors="";
	$check=$con->myQuery("SELECT id FROM manner_of_payment WHERE code=? AND id!=? AND is_deleted=0",array($_POST['payment_code'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Marketing Code already exist.";
		}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("frm_manner_of_payment.php");}
				else{
				redirect("frm_manner_of_payment.php?id=".$_POST['id']);}
			die;
		}else{
		$con->beginTransaction();
		try {
            $_POST['payment_code'] = strtoupper($_POST['payment_code']);
			if(empty($_POST['id'])){
			$con->myQuery("INSERT INTO manner_of_payment(code,name) VALUES(?,?)",array($_POST['payment_code'],$_POST['payment_name']));
			Alert("Successfully Added.","success");}
			else{
			$con->myQuery("UPDATE manner_of_payment SET code=? , name=? WHERE id=?",array($_POST['payment_code'],$_POST['payment_name'],$_POST['id']));
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("manner_of_payment.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("manner_of_payment.php");
			die;
		}
	}
?>