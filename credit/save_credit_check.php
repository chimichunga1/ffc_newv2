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
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['tc_id'])){
				redirect("ci_checking_form.php?id=".$inputs['id']."&tab=".$inputs['tab']);}
				else{
                redirect("ci_checking_form.php?id=".$inputs['id']."&tab=".$inputs['tab']);}
			die;
		}else{
            // var_dump($inputs);die;
		$con->beginTransaction();
		try {
			if(empty($_POST['cc_id'])){
			$con->myQuery("INSERT INTO credit_check(loan_id,client_no,informant,tel_no,loan_type_id,unit,amt_fin,pn_amount,terms,mon_amor,date_granted,balance,security,experience,checked_by) 
			VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",array($inputs['id'],$inputs['client_no'],$inputs['inform'],$inputs['tel_no'],$inputs['loan_type'],$inputs['unit'],$inputs['amt_fin']
			,$inputs['pn_amount'],$inputs['terms'],$inputs['mon_amor'],$inputs['date_granted'],$inputs['balance'],$inputs['security'],$inputs['exp'],$inputs['applied_by']));
			// $con->myQuery("UPDATE loan_list SET loan_status_id = 5 WHERE id=:loan_id AND client_no=:client_no",array(
			// 	'loan_id' => $inputs['id'],
			// 	'client_no' => $inputs['client_no']
			// ));
			Alert("Successfully Added.","success");
            }
			else{
			$con->myQuery("UPDATE credit_check SET informant=?,tel_no=?,loan_type_id=?,unit=?,amt_fin=?,pn_amount=?,terms=?,mon_amor=?,date_granted=?,balance=?,security=?,experience=? 
            WHERE id=?",array($inputs['inform'],$inputs['tel_no'],$inputs['loan_type'],$inputs['unit'],$inputs['amt_fin']
			,$inputs['pn_amount'],$inputs['terms'],$inputs['mon_amor'],$inputs['date_granted'],$inputs['balance'],$inputs['security'],$inputs['exp'],$inputs['cc_id']));
            Alert("Successfully Updated.","success");
            }
			$con->commit();
			redirect("ci_checking_form.php?id=".$inputs['id']."&tab=".$inputs['tab']);
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("ci_checking_form.php?id=".$inputs['id']."&tab=".$inputs['tab']);
			die;
		}
	}
?>