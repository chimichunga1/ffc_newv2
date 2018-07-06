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
	if(!in_array($_POST['type'],array(
		"submit_collat",
		"submit_collat_redo",
		"submit_credit_advising",
		"submit_credit_advising_redo",
		"submit_collateral_approval1",
		"submit_credit_approval1",
		"submit_credit_approval",
		"submit_credit",
		"submit_credit1",
		"submit_instruction_redo"
		))){
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
	case 'submit_credit_approval':
		$page="marketing/instruction_sheet_prep.php";
		break;
	case 'submit_credit_approval1':
		$page = "marketing/collateral_form.php";
		break;
	case 'submit_collateral_approval1':
		$page = "marketing/checklist_entry_update.php";
		break;
	case 'submit_credit':
		$page="marketing/credit_advising.php";
		break;
	case 'submit_credit1':
		$page="credit/reco_app.php";
		break;
	case 'submit_collat';
		$page="marketing/checklist_entry_update.php";
		break;
	case 'submit_collat_redo';
		$page="marketing/credit_advising.php";
		break;
	case 'submit_credit_advising';
		$page="marketing/collateral_form.php";
		break;
	case 'submit_credit_advising_redo';
		$page="marketing/credit_approval.php";
		break;
	case "submit_instruction_redo":
		$page="marketing/checklist_entry_update.php";
	default:
		redirect("index.php");
		break;

}
                    if($errors!=""){
                    Alert("You have the following errors: <br/>".$errors,"danger");
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
			case "submit_collat":
			$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
                                $con->myQuery("UPDATE loan_list SET loan_status_id = 8, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
                                Alert("Loan record has been updated.","success");
			break;
			case "submit_collat_redo":
			$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
                                $con->myQuery("UPDATE loan_list SET loan_status_id = 6, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
                                Alert("Loan record has been redo.","success");
			break;
                case 'submit_credit_approval':
				
                $current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
								$try = $con->myQuery("UPDATE loan_list SET loan_status_id = 9, date_modified=CURDATE() WHERE id=?",array($inputs['id']));

                                Alert("Loan record has been updated.","success");
							break;
				case 'submit_credit_approval1':
				$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
				$con->myQuery("UPDATE loan_list SET loan_status_id = 7, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
				Alert("Loan record has been updated.","success");
				break;

				case 'submit_collateral_approval1':
				$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
				$con->myQuery("UPDATE loan_list SET loan_status_id = 5, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
				Alert("Loan record has been updated.","success");
				break;
				case 'submit_credit':

				$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
								$con->myQuery("UPDATE loan_list SET loan_status_id = 6, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
								Alert("Loan record has been updated.","success");
							break;

				case 'submit_credit1':

							$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
											$con->myQuery("UPDATE loan_list SET loan_status_id = 4, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
											Alert("Loan record has been updated.","success");
										break;
				case 'submit_credit_advising':
							$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
														$con->myQuery("UPDATE loan_list SET loan_status_id = 7, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
														Alert("Loan record has been updated.","success");
													break;				
				case 'submit_credit_advising_redo':
				$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
											$con->myQuery("UPDATE loan_list SET loan_status_id = 5, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
											Alert("Loan record has been redo.","success");
										break;																							
				case 'submit_instruction_redo':
				$current=$con->myQuery("SELECT * FROM  loan_list WHERE id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
											$con->myQuery("UPDATE loan_list SET loan_status_id = 8, date_modified=CURDATE() WHERE id=?",array($inputs['id']));
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
