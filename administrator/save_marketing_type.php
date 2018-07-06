<?php

	require_once("../support/config.php");
	if(!isLoggedIn()){
		toLogin();
		die();
	}
	$errors="";
	$check=$con->myQuery("SELECT id FROM marketing_type WHERE code=? AND id!=? AND is_deleted=0",array($_POST['mark_code'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Marketing Code already exist.";
		}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("frm_marketing_type.php");}
				else{
				redirect("frm_marketing_type.php?id=".$_POST['id']);}
			die;
		}else{
		$con->beginTransaction();
		try {
			if(empty($_POST['id'])){
			$con->myQuery("INSERT INTO marketing_type(code,name) VALUES(?,?)",array($_POST['mark_code'],$_POST['mark_name']));
			Alert("Successfully Added.","success");}
			else{
			$con->myQuery("UPDATE marketing_type SET code=? , name=? WHERE id=?",array($_POST['mark_code'],$_POST['mark_name'],$_POST['id']));
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("marketing_type.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("marketing_type.php");
			die;
		}
	}
?>