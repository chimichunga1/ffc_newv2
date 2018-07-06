<?php

	require_once("../support/config.php");

	if(!isLoggedIn()){
	toLogin();
	die();
	}
	$errors="";
	$check=$con->myQuery("SELECT id FROM collateral_code WHERE code=? AND id!=? AND is_deleted=0",array($_POST['col_code'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Collateral Code already exist.";
		}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("frm_collateral_code.php");}
				else{
				redirect("frm_collateral_code.php?id=".$_POST['id']);}
			die;
		}else{
		$con->beginTransaction();
		try {
			if(empty($_POST['id'])){
			$con->myQuery("INSERT INTO collateral_code(code,`desc`) VALUES(?,?)",array($_POST['col_code'],$_POST['col_des']));
			Alert("Successfully Added.","success");}
			else{
			$con->myQuery("UPDATE collateral_code SET code=? , `desc`=? WHERE id=?",array($_POST['col_code'],$_POST['col_des'],$_POST['id']));
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("collateral_code.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("collateral_code.php");
			die;
		}
	}
?>