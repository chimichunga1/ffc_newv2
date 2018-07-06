<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
	  }
	$errors="";
	$check=$con->myQuery("SELECT id FROM requirements WHERE requirement_code=? AND id!=? AND is_deleted=0",array($_POST['requirement_code'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Requirement Code already exist.";
		}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("frm_requirement.php");}
				else{
				redirect("frm_requirement.php?id=".$_POST['id']);}
			die;
		}else{
		$con->beginTransaction();
		try {
			if(empty($_POST['id'])){
			$con->myQuery("INSERT INTO requirements(requirement_code,name) VALUES(?,?)",array(strtoupper($_POST['requirement_code']),$_POST['requirement_name']));
			Alert("Successfully Added.","success");}
			else{
			$con->myQuery("UPDATE requirements SET requirement_code=? , name=? WHERE id=?",array(strtoupper($_POST['requirement_code']),$_POST['requirement_name'],$_POST['id']));
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("requirement.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("requirement.php");
			die;
		}
	}
?>