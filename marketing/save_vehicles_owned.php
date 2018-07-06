<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
	  }
	$errors="";
	// $check=$con->myQuery("SELECT id FROM country WHERE name=? AND id!=? AND is_deleted=0",array($_POST['name'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
	// 	if(!empty($check)){
	// 		$errors.="Country Name already exist.";
    // 	}
    $inputs=$_POST;
    $inputs['applied_by']=$_SESSION[WEBAPP]['user']['user_id'];
		if($errors!="")
		{
			// Alert("You have the following errors: <br/>".$errors,"danger");
			// 	if(empty($_POST['tc_id'])){
			// 	redirect("ci_checking_form.php?id=".$inputs['id']."&tab=".$inputs['tab']);}
			// 	else{
            //     redirect("ci_checking_form.php?id=".$inputs['id']."&tab=".$inputs['tab']);}
			// die;
		}else{
            // var_dump($inputs);die;
		$con->beginTransaction();
		try {
			if(empty($_POST['vo_id'])){
			$con->myQuery("INSERT INTO cred_app_vehicles(loan_id,unit,name,description) 
            VALUES(?,?,?,?)",array($inputs['id'],$inputs['unit'],$inputs['name'],$inputs['desc']));
            Alert("Successfully Added.","success");
            }
			else{
			$con->myQuery("UPDATE cred_app_vehicles SET unit=?,name=?,description=?
            WHERE id=?",array($inputs['unit'],$inputs['name'],$inputs['desc'],$inputs['vo_id']));
            Alert("Successfully Updated.","success");
            }
			$con->commit();
			redirect("business_writeup.php?id=".$inputs['id']."#vehicles_owned");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("business_writeup.php?id=".$inputs['id']."#vehicles_owned");
			die;
		}
	}
?>