<?php
require_once 'support/config.php';

if(!empty($_POST)){

	
	$_POST['password'] = encryptIt($_POST['password']);
	$_POST['cur_password'] = encryptIt($_POST['cur_password']);
	$_POST['answer'] = encryptIt($_POST['answer']);
	//$_SESSION[WEBAPP]['user']['user_id']
	$_POST['user_id'] =  $_SESSION[WEBAPP]['user']['user_id']; 
	

	try {
		$con->beginTransaction();


		$inputsForUser = $_POST;
		// var_dump($_POST);
		// die;
		$errors="";

		if(empty($inputsForUser['cur_password'])){
			$errors.="Please enter current password.<br/>";
		}
		else{
			if($inputsForUser['password']!=$inputsForUser['cur_password']){
				$errors.="confirmation password is wrong.<br/>";
			}
		}

		if (empty($inputsForUser['password'])){
			$errors.="Enter password. <br/>";	
		}else{
			$password_regex="/^(.{0,7}|[^0-9]*|[^A-Z]*|[^a-z]*|[a-zA-Z0-9]*)$/";
			preg_match($password_regex, $inputsForUser['password'], $is_valid, PREG_OFFSET_CAPTURE);
			if(!empty($is_valid)){
				$errors.="Password should contain the ff:<br/>";
				$errors.="One Integer<br>";
				$errors.="One character<br>";
				$errors.="One Uppercase character<br>";
				$errors.="One Special Character<br>";
			}
			// var_dump($is_valid);
		}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
			redirect("setup_acc.php");
			die;
		}
		 unset($inputsForUser['cur_password']);
		// die;
		$con->myQuery("UPDATE  users set password=:password , question_id=:sq_id, answer=:answer where user_id=:user_id",$inputsForUser);


		// $existUser =$con->myQuery("SELECT user_id FROM `employee_sec_ans`
		// WHERE user_id=? ",array($inputsForUser['user_id']))->fetch(PDO::FETCH_ASSOC);

		// if(empty($existUser)){
		// 	$inputsForAnswer = $_POST;
		// 	// var_dump($inputsForAnswer);
		// 	// die;
		// 	unset($inputsForAnswer['password']);
		// 	$con->myQuery("INSERT INTO employee_sec_ans(question_id,answer,user_id)
		// 			VALUES(:sq_id,:answer,:user_id)",$inputsForAnswer);
		// }else{
		// 	$inputsForAnswer = $_POST;
		// 	unset($inputsForAnswer['password']);
		// 	$con->myQuery("UPDATE  employee_sec_ans set question_id=:sq_id  , answer=:answer where user_id=:user_id",$inputsForAnswer);
		// }
		$con->commit();
		//session_destroy();
		
		redirect('logout.php?id=given');

	}catch (Exception $e) {
		$con->rollBack();
		Alert("Save failed. Please try again.","danger");
	  	redirect("setup_acc.php");	

	}	
}