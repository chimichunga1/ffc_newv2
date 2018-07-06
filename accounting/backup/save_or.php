<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
	}


	$errors="";
	$inputs=$_POST;
	$check=$con->myQuery("SELECT id FROM loan_list WHERE app_no=? AND id!=?",array($_POST['app_no'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Application Number already exist.";
		}
		if($errors!="")
		{
			setAlert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("create_loan.php");}
				else{
				redirect("create_loan.php?id=".$_POST['id']);}
			die;
		}else{
		$con->beginTransaction();
		try {
			if(empty($_POST['id'])){
					$approver_id=$con->myQuery("SELECT * from approval_flow ORDER BY id asc limit 1")->fetch(PDO::FETCH_ASSOC);
				
				    $inputs['applied_by']=$_SESSION[WEBAPP]['user']['user_id'];
					$params1=array(
					"applied_by"=>$inputs['applied_by'],
					"app_type"=>$inputs['app_type'],
					"app_no"=>$inputs['app_no'],
					"client_no"=>$inputs['client_no'],
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
					"approver_id"=>$approver_id['user_id']
					);
					$con->myQuery("INSERT INTO
								loan_list(
									app_type,
									app_no,
									client_no,
									last_name,
									first_name,
									spouse,
									loan_type_id,
									credit_fac_id,
									prod_line_id,
									mark_type_id,
									coll_code_id,
									bus_add,
									home_add,
									email_add,
									bus_tel,
									home_tel,
									pri_con,
									sec_con,
									applied_by,
									date_applied,
									current_approver_id
								) VALUES(
									:app_type,
									:app_no,
									:client_no,
									:last_name,
									:first_name,
									:spouse,
									:loan_type,
									:cre_fac,
									:pro_line,
									:mar_type,
									:col_code,
									:bus_add,
									:home_add,
									:email,
									:bus_tel,
									:home_tel,
									:pri_con,
									:sec_con,
									:applied_by,
									CURDATE(),
									:approver_id
								)",$params1);
			Alert("Successfully Added.","success");}
			else{
					$params1=array(
					"id"=>$inputs['id'],
					"app_type"=>$inputs['app_type'],
					"app_no"=>$inputs['app_no'],
					"client_no"=>$inputs['client_no'],
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
					"sec_con"=>$inputs['sec_con']
					);
					$con->myQuery("UPDATE
								loan_list SET
									app_type=:app_type,
									app_no=:app_no,
									client_no=:client_no,
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
									date_modified=CURDATE()
									WHERE id=:id
								",$params1);
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("loan_management.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			setAlert('Please try again.',"danger");
			redirect("create_loan.php");
			die;
		}
	}
?>