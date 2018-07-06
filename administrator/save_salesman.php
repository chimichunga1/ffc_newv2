<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
	  }
	$errors="";
	$check=$con->myQuery("SELECT id FROM salesman WHERE name=? AND id!=? AND is_deleted=0",array($_POST['name'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Salesman Name already exist.";
		}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("frm_salesman.php");}
				else{
				redirect("frm_salesman.php?id=".$_POST['id']);}
			die;
		}else{
		$con->beginTransaction();
		try {
			if(empty($_POST['id'])){
			$con->myQuery("INSERT INTO salesman(name) VALUES(?)",array($_POST['name']));
			Alert("Successfully Added.","success");}
			else{
			$con->myQuery("UPDATE salesman SET name=? WHERE id=?",array($_POST['name'],$_POST['id']));
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("salesman.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("salesman.php");
			die;
		}
	}
?>