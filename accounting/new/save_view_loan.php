<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
	}


	$errors="";
	$inputs=$_POST;


	$check=$con->myQuery("SELECT id FROM loan_list WHERE app_no=? AND id!=?",array($_POST['app_no'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		// if(!empty($check)){
		// 	$errors.="Application Number already exist.";
		// }
		if($errors!="")
		{
			setAlert("You have the following errors: <br/>".$errors,"danger");

			redirect("view_loan.php?id=".$_POST['id']);
			die;
		}else{
		$con->beginTransaction();
		try {
			if(empty($_POST['id'])){
			}
			else{
					$params1=array(
					"id"=>$inputs['id'],
					"app_type"=>$inputs['app_type'],
				
					"last_name"=>$inputs['lname'],
					"first_name"=>$inputs['fname'],
					"spouse"=>$inputs['spouse'],
					"loan_type"=>$inputs['loan_type'],
					"cre_fac"=>$inputs['cre_fac'],
					"pro_line"=>$inputs['pro_line'],
					"mar_type"=>$inputs['mar_type'],
					"col_code"=>$inputs['col_code'],
					"bus_add"=>$inputs['bus_add'],
					"home_add"=>$inputs['home_add'],
					"email"=>$inputs['email'],
					"bus_tel"=>$inputs['bus_tel'],
					"home_tel"=>$inputs['home_tel'],
					"pri_con"=>$inputs['pri_con'],
					"sec_con"=>$inputs['sec_con'],
					"approve_type"=>$inputs['loan_receivable_type']
				
					); 
					$con->myQuery("UPDATE
								loan_list SET
									app_type=:app_type,
								
									last_name=:last_name,
									first_name=:first_name,
									spouse=:spouse,
									loan_type_id=:loan_type,
									credit_fac_id=:cre_fac,
									prod_line_id=:pro_line,
									mark_type_id=:mar_type,
									coll_code_id=:col_code,
									bus_add=:bus_add,
									home_add=:home_add,
									email_add=:email,
									bus_tel=:bus_tel,
									home_tel=:home_tel,
									pri_con=:pri_con,
									sec_con=:sec_con,
									date_modified=CURDATE(),
									voucher_type=:approve_type,
									loan_status_id='11'
									WHERE id=:id
								",$params1);
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("../php/approve.php?id={$_POST['id']}&type=loan");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			setAlert('Please try again.',"danger");
			redirect("loan_approval.php");
			die;
		}
	}
?>