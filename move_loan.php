<?php
require_once("support/config.php");
 if(!isLoggedIn()){
 	toLogin();
 	die();
 }

// var_dump($_POST);
// die;

if(empty($_POST['type'])){
	Modal("Invalid Record Selected");
	redirect("index.php");
	die;
}
else{
	if(!in_array($_POST['type'],array("submit_ci","submit_mark","submit_mark1","submit_mark2","submit_mark_redo"))){
		Modal("Invalid Record Selected");
		redirect("index.php");
		die;
	}
}
$startTimeStamp="";
$endTimeStamp="";
$errors="";

function validate($fields)
{
	global $page;
	$inputs=$_POST;
	$errors="";
	foreach ($fields as $key => $value) {
		if(empty($inputs[$key])){
			$errors.=$value;
			//var_dump($inputs[$key]);
		}else{
			#CUSTOM VALIDATION
		}
	}
	if($errors!=""){
		Alert("You have the following errors: <br/>".$errors,"danger");
		redirect($page);
		return false;
		die;
	}
	else{
		return true;
	}


}
$inputs=$_POST;
$required_fieds=array();
$page='index.php';
switch ($inputs['type']) {
	case 'submit_ci':
		$page="marketing/loan_management.php";
		break;
	case 'submit_mark':
		$page="credit/reco_app.php";
		break;
	case 'submit_mark1':
		$page="marketing/loan_management.php";
		break;
	case "submit_mark_redo":
		$page = "credit/ci_checking.php";
	break;
	case 'submit_mark2':
	$page="marketing/credit_approval.php";
	$bwu_files=$con->myQuery("SELECT * FROM bwu_files WHERE is_deleted='0' AND loan_id=?",array($inputs['id']))->fetchAll(PDO::FETCH_ASSOC);
	if(empty($bwu_files)){
		$errors.="No Business Write-Up uploaded. ";
		$page="credit/reco_app.php";
	}
	break;
	default:
		redirect("index.php");
		break;

}
                    if($errors!=""){
                    Alert("You have the following errors: ".$errors,"danger");
                    redirect($page);
                    return false;
                    die;
                    }
                    
if(empty($_POST['id'])){
	Modal("Invalid Record Selected");
	redirect($page);
	die;
}
else{
	try {
		switch ($inputs['type']) {
                case 'submit_ci':

                $current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
                                $con->myQuery("UPDATE loan_list SET loan_status_id = 3, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
                                Alert("Loan record has been updated.","success");
							break;

				case 'submit_mark':

				$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
								$con->myQuery("UPDATE loan_list SET loan_status_id = 4, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
								Alert("Loan record has been updated.","success");
							break;

				case 'submit_mark1':

							$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
											$con->myQuery("UPDATE loan_list SET loan_status_id = 2, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
											Alert("Loan record has been updated.","success");
										break;
				case 'submit_mark2':
				$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
								$con->myQuery("UPDATE loan_list SET loan_status_id = 5, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
								Alert("Loan record has been updated.","success");
							break;

				case 'submit_mark_redo':
							$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
											$con->myQuery("UPDATE loan_list SET loan_status_id = 3, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
											Alert("Loan record has been redo.","success");
										break;
        }
    }
    catch (Exception $e) {

		die($e);
        redirect("index.php");
	}
}
// die;
if(!empty($page)){
	redirect($page);
}
else{
	die;
 redirect('index.php');
}
?>
