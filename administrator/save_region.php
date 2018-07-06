<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
	  }
	$errors="";
	$check=$con->myQuery("SELECT id FROM region WHERE name=? AND country_id=? AND id!=? AND is_deleted=0",array($_POST['name'],$_POST['country'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Region Name already exist.";
		}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("frm_region.php");}
				else{
				redirect("frm_region.php?id=".$_POST['id']);}
			die;
		}else{
		$con->beginTransaction();
		try {
			if(empty($_POST['id'])){
			$con->myQuery("INSERT INTO region(country_id,name) VALUES(?,?)",array($_POST['country'],$_POST['name']));
			Alert("Successfully Added.","success");}
			else{
			$con->myQuery("UPDATE region SET country_id=?, name=? WHERE id=?",array($_POST['country'],$_POST['name'],$_POST['id']));
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("region.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("region.php");
			die;
		}
	}
?>