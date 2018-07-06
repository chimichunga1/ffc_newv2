<?php
require_once("../support/config.php");

if(!isLoggedIn()){
	toLogin();
    die();
}

if(!AllowUser(array(1))){
  redirect("index.php");
}

if(!empty($_POST)){
		//Validate form inputs
	$inputs=$_POST;
	$inputs=array_map('trim', $inputs);
	// $user=$con->myQuery("SELECT * FROM users WHERE is_deleted=0 and user_id=?",array($inputs['user_id']));

	$errors="";

		if($inputs['user_type_id'] == 3){
			if(empty($inputs['course_level_id'])){
				// $errors.="Enter Dean Level. <br/>";
			}
		}
		if (empty($inputs['first_name'])) {
			$errors.="Enter First name<br/>";
		}
		if (empty($inputs['last_name'])) {
			$errors.="Enter Last name<br/>";
		}
		if (empty($inputs['username'])) {
			$errors.="Enter username<br/>";
		}
		if (empty($inputs['user_type_id'])) {
			$errors.="Enter user type<br/>";
		}

		if($errors!=""){

				Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($inputs['user_id'])){
					redirect("frm_user.php");
				}
				else{
					redirect("frm_user.php?user_id=".urlencode($inputs['user_id']));
				}
				die;
			}
		// if (empty($inputs['password'])){
		// 	$errors.="Enter Password. <br/>";
		// }
		// if (empty($inputs['utype_id'])){
		// 	$errors.="Select User Type. <br/>";
		// }
		// var_dump($inputs);
		// die;
		// if(empty($inputs['get_id'])){
		// 	if (empty($inputs['emp_id'])){
		// 		$errors.="Select Employee. <br/>";
		// 	}
		// 	if ($employee_user->fetchcolumn() > 0) {
		// 		$errors.="Selected Employee already has an Account. <br />";
		// 	}
		// }

		// $uname=$con->myQuery("SELECT user_id,lcase(username) FROM users WHERE is_deleted=0 and username=?",array(strtolower($inputs['username'])))->fetch(PDO::FETCH_ASSOC);
	
	

	
			//IF id exists update ELSE insert
	
			// var_dump($inputs);
	if(empty($inputs['user_id'])){
// var_dump('what!');
// die;
		try {
			$con->beginTransaction();
			$inputsForUser=$inputs;

			unset($inputsForUser['user_id']);
			// unset($inputsForUser['company_id']);
			// unset($inputsForUser['branch_id']);
			
	
			$uname=$con->myQuery("SELECT user_id,lcase(username) as username FROM users WHERE is_deleted=0 and username=? ",array(strtolower($inputsForUser['username'])))->fetch(PDO::FETCH_ASSOC);
			if(!empty($uname)){
				if($uname['username'] == strtolower($inputsForUser['username'])){
					$errors.="Username " . $inputsForUser['username'] . " is exist already.";

				}
			}
			

			if($errors!=""){

				Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($inputsForUser['user_id'])){
					redirect("frm_user.php");
				}
				else{
					redirect("frm_user.php?user_id=".urlencode($inputsForUser['user_id']));
				}
				die;
			}
			// if($inputsForUser['user_type_id']!=3){
			// 	if(!empty($inputsForUser['company_id']) && !empty($inputsForUser['branch_id'])){
				
			// }
			// }
			
			$inputsForUser['password']=encryptIt('default');
			
				$con->myQuery("INSERT INTO users(username,password,user_type_id,first_name,last_name,middle_initial,is_active) VALUES(:username,:password,:user_type_id,:first_name,:last_name,:middle_initial,1)",$inputsForUser);
			
			
			
			// $user_id=$con->lastInsertId();
			// var_dump($user_id);
			// die;	
			
			$con->commit();

			insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Add User named " . $inputs['user_name'] . ".");

		} catch (Exception $e) {
			$con->rollBack();
			Alert("Save failed. Please try again.","danger");
			redirect("frm_users.php");
		}	


	}else{
				//Update
			// var_dump('die');
			// die;
			//unset($inputs['con_password']);
		try {
			$con->beginTransaction();

			$inputsForUser=$inputs;
				// unset($inputsForUser['company_id']);
				// unset($inputsForUser['branch_id']);
			$uname=$con->myQuery("SELECT user_id,lcase(username) as `user_name` FROM users WHERE is_deleted=0 and username=? and user_id <> ?",array(strtolower($inputsForUser['username']),$inputsForUser['user_id']))->fetch(PDO::FETCH_ASSOC);
			
		if(!empty($uname)){
			
				$errors.="Username " . $inputs['username'] . " is exist already.";
			
		}
		if($errors!=""){

			Alert("You have the following errors: <br/>".$errors,"danger");
			if(empty($inputsForUser['user_id'])){
				redirect("frm_user.php");
			}
			else{
				redirect("frm_user.php?user_id=".urlencode($inputsForUser['user_id']));
			}
			die;
		}
		
		// var_dump($inputsForUser);
		// die;
		
			$con->myQuery("UPDATE users SET username=:username,user_type_id=:user_type_id,first_name=:first_name,last_name=:last_name,middle_initial=:middle_initial,course_level_id=null WHERE user_id=:user_id",$inputsForUser);
		
		

		$con->commit();
		insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Update User ID " . $inputs['users_id']. ".");

		} catch (Exception $e) {
			$con->rollBack();
			Alert("Save failed. Please try again.","danger");
			redirect("frm_users.php");
		}

		
	} 

			// die;
	Alert("Save successful","success");
	redirect("view_users.php");

	die;
}
else{
	redirect('index.php');
	die();
}
		//redirect('index.php');
?>
