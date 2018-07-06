<?php

	require_once("../support/config.php");

	if(!isLoggedIn()){
		toLogin();
		die();
	}
	$errors="";
	$check=$con->myQuery("SELECT id FROM product_line WHERE code=? AND id!=? AND is_deleted=0",array($_POST['pl_code'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Product Line Code already exist.";
		}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("frm_product_line.php");}
				else{
				redirect("frm_product_line.php?id=".$_POST['id']);}
			die;
		}else{
		$con->beginTransaction();
		try {
			if(empty($_POST['id'])){
			$con->myQuery("INSERT INTO product_line(code,name) VALUES(?,?)",array($_POST['pl_code'],$_POST['pl_name']));
			Alert("Successfully Added.","success");}
			else{
			$con->myQuery("UPDATE product_line SET code=? , name=? WHERE id=?",array($_POST['pl_code'],$_POST['pl_name'],$_POST['id']));
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("product_line.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("product_line.php");
			die;
		}
	}
?>