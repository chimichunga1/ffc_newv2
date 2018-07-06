
<?php
require_once 'support/config.php';
	// var_dump($_POST);
	// die;
makeHead("Login");
if(!empty($_POST)){

	$user=$con->myQuery("SELECT first_name, middle_initial, last_name,user_id,user_type_id as user_type_id,is_login,is_active,answer,question_id,username, image  FROM users WHERE BINARY username=? AND BINARY password=? AND is_deleted=0",array($_POST['username'],encryptIt($_POST['password'])))->fetch(PDO::FETCH_ASSOC);

// var_dump($user);
// die;
	if(!empty($_SESSION[WEBAPP]['attempt_no']) && $_SESSION[WEBAPP]['attempt_no']>2){
		Alert("Maximum login attempts achieved, Your account will be deactivated. Contact your system administrator to retreive your password.","danger");
		UNSET($_SESSION[WEBAPP]['attempt_no']);
		$con->myQuery("UPDATE users SET is_active=0 WHERE username=?",array($_POST['username']));
		redirect("frmlogin.php");
		die;
	}
	if(empty($user)){
		Alert("Invalid Username/Password","warning");
		redirect('frmlogin.php');
		if(!empty($_SESSION[WEBAPP]['attempt_no'])){
				// setcookie("attempt_no",$_SESSION[WEBAPP]['attempt_no']+1,time()+(3600));
			$_SESSION[WEBAPP]['attempt_no']+=1;
		}
		else{
			$_SESSION[WEBAPP]['attempt_no']=1;
		}
	}
	else{
	
		 // var_dump($user['user_type_id']);
		 // die;
		
			if($user['is_active']==1){
				UNSET($_SESSION[WEBAPP]['attempt_no']);
				$con->myQuery("UPDATE users SET is_login=1 WHERE user_id=?",array($user['user_id']));
				//$user['answer']=!empty($user['answer']);
				$_SESSION[WEBAPP]['user']=$user;
				refresh_activity($_SESSION[WEBAPP]['user']['user_id']);
					// var_dump($user['password_question']);
					// die;
				// var_dump($user['question_id']);
				// die;
				if($user['question_id'] == null){
					redirect('setup_acc.php');
					insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Logged in to set Account.");
					die;
				}else{
					insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Logged in.");
					
					
					Alert("Successfully Logged in","success");
					redirect("dashboard");
					die;
				}

				die;
			}
			else{
				Alert("This account is currently deactivated.","warning");
				redirect("frmlogin.php");
				die;
			}

		// if($user['is_login']==0){
		// }
		// else{
		// 	Alert("This account is currently already logged in.","danger");
		// 	redirect("frmlogin.php");
		// 	die;
		// }
	}
	die;
}
else{
	redirect('frmlogin.php');
	die();
}
makeFoot();
redirect('frmlogin.php');


?>
<?php
require_once 'support/config.php';
	// var_dump($_POST);
	// die;
makeHead("Login");
if(!empty($_POST)){

	$user=$con->myQuery("SELECT first_name, middle_initial, last_name,user_id,user_type_id as user_type_id,is_login,is_active,answer,question_id,username, image  FROM users WHERE BINARY username=? AND BINARY password=? AND is_deleted=0",array($_POST['username'],encryptIt($_POST['password'])))->fetch(PDO::FETCH_ASSOC);

// var_dump($user);
// die;
	if(!empty($_SESSION[WEBAPP]['attempt_no']) && $_SESSION[WEBAPP]['attempt_no']>2){
		Alert("Maximum login attempts achieved, Your account will be deactivated. Contact your system administrator to retreive your password.","danger");
		UNSET($_SESSION[WEBAPP]['attempt_no']);
		$con->myQuery("UPDATE users SET is_active=0 WHERE username=?",array($_POST['username']));
		redirect("frmlogin.php");
		die;
	}
	if(empty($user)){
		Alert("Invalid Username/Password","warning");
		redirect('frmlogin.php');
		if(!empty($_SESSION[WEBAPP]['attempt_no'])){
				// setcookie("attempt_no",$_SESSION[WEBAPP]['attempt_no']+1,time()+(3600));
			$_SESSION[WEBAPP]['attempt_no']+=1;
		}
		else{
			$_SESSION[WEBAPP]['attempt_no']=1;
		}
	}
	else{
	
		 // var_dump($user['user_type_id']);
		 // die;
		
			if($user['is_active']==1){
				UNSET($_SESSION[WEBAPP]['attempt_no']);
				$con->myQuery("UPDATE users SET is_login=1 WHERE user_id=?",array($user['user_id']));
				//$user['answer']=!empty($user['answer']);
				$_SESSION[WEBAPP]['user']=$user;
				refresh_activity($_SESSION[WEBAPP]['user']['user_id']);
					// var_dump($user['password_question']);
					// die;
				// var_dump($user['question_id']);
				// die;
				if($user['question_id'] == null){
					redirect('setup_acc.php');
					insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Logged in to set Account.");
					die;
				}else{
					insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Logged in.");
					
					
					Alert("Successfully Logged in","success");
					redirect("dashboard");
					die;
				}

				die;
			}
			else{
				Alert("This account is currently deactivated.","warning");
				redirect("frmlogin.php");
				die;
			}

		// if($user['is_login']==0){
		// }
		// else{
		// 	Alert("This account is currently already logged in.","danger");
		// 	redirect("frmlogin.php");
		// 	die;
		// }
	}
	die;
}
else{
	redirect('frmlogin.php');
	die();
}
makeFoot();
redirect('frmlogin.php');


?>

