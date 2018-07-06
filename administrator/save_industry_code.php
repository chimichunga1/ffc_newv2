<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
	  }
	$errors="";
	$check=$con->myQuery("SELECT id FROM industry_code WHERE name=? AND id!=? AND is_deleted=0",array($_POST['name'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Industry Code already exist.";
		}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("frm_industry_code.php");}
				else{
				redirect("frm_industry_code.php?id=".$_POST['id']);}
			die;
		}else{
		$con->beginTransaction();
		try {
			if(empty($_POST['id'])){
			$con->myQuery("INSERT INTO industry_code(name) VALUES(?)",array($_POST['name']));
			Alert("Successfully Added.","success");}
			else{
			$con->myQuery("UPDATE industry_code SET name=? WHERE id=?",array($_POST['name'],$_POST['id']));
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("industry_code.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("industry_code.php");
			die;
		}
	}
?>