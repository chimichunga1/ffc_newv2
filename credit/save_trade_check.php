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
			if(empty($_POST['tc_id'])){
			$con->myQuery("INSERT INTO trade_check(loan_id,client_no,informant,tel_no,dealings,since,ave_bill,terms,experience,date_checked,checked_by) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?)",array($inputs['id'],$inputs['client_no'],$inputs['inform'],$inputs['tel_no'],$inputs['dealings'],$inputs['since'],$inputs['ave_bill']
			,$inputs['terms'],$inputs['exp'],$inputs['date_checked'],$inputs['applied_by']));
			// $con->myQuery("UPDATE loan_list SET loan_status_id = 4 WHERE id=:loan_id AND client_no=:client_no",array(
			// 	'loan_id' => $inputs['id'],
			// 	'client_no' => $inputs['client_no']
			// ));
            Alert("Successfully Added.","success");
            }
			else{
			$con->myQuery("UPDATE trade_check SET informant=?,tel_no=?,dealings=?,since=?,ave_bill=?,terms=?,experience=?,date_checked=? 
            WHERE id=?",array($inputs['inform'],$inputs['tel_no'],$inputs['dealings'],$inputs['since'],$inputs['ave_bill']
            ,$inputs['terms'],$inputs['exp'],$inputs['date_checked'],$inputs['tc_id']));
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