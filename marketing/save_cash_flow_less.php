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
			if(empty($_POST['cfl_id'])){
			$con->myQuery("INSERT INTO cred_app_less(loan_id,name,description,amount,percent) 
            VALUES(?,?,?,?,?)",array($inputs['id'],$inputs['name'],$inputs['desc'],$inputs['amount'],$inputs['percent']));
            Alert("Successfully Added.","success");
            }
			else{
			$con->myQuery("UPDATE cred_app_less SET name=?,description=?,amount=?,percent=?
            WHERE id=?",array($inputs['name'],$inputs['desc'],$inputs['amount'],$inputs['percent'],$inputs['cfl_id']));
            Alert("Successfully Updated.","success");
            }
            $inc=$con->myQuery("SELECT gross_inc FROM cred_app_bwu WHERE loan_id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
            $less_amt=$con->myQuery("SELECT SUM(amount) AS amount FROM cred_app_less WHERE is_deleted='0' AND loan_id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
            $less_per=$con->myQuery("SELECT SUM(percent) AS per FROM cred_app_less WHERE is_deleted='0' AND loan_id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
                $net_inc=$inc['gross_inc']-(($inc['gross_inc']*($less_per['per']/100)));
                $net_inc=$net_inc-$less_amt['amount'];
            $con->myQuery("UPDATE cred_app_bwu SET net_inc=?
            WHERE loan_id=?",array($net_inc,$inputs['id']));
			$con->commit();
			redirect("business_writeup.php?id=".$inputs['id']."#cash_flow");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("business_writeup.php?id=".$inputs['id']."#cash_flow");
			die;
		}
	}
?>