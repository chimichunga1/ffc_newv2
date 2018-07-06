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
			if(empty($_POST['rel_id'])){
			$con->myQuery("INSERT INTO cred_app_relations(loan_id,acct_no,facility,unit,plate_no,af,tlv,granted,terms,ma,balance,rule78,exp,applied_by,date_applied) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,CURDATE())",array($inputs['id'],$inputs['acct_no'],$inputs['facility'],$inputs['unit'],$inputs['plate_no'],$inputs['af'],$inputs['tlv']
            ,$inputs['granted'],$inputs['terms'],$inputs['ma'],$inputs['balance'],$inputs['rule78'],$inputs['exp'],$inputs['applied_by']));
            Alert("Successfully Added.","success");
            }
			else{
			$con->myQuery("UPDATE cred_app_relations SET acct_no=?,facility=?,unit=?,plate_no=?,af=?,tlv=?,granted=?,terms=?,ma=?,balance=?,rule78=?,exp=?
            WHERE id=?",array($inputs['acct_no'],$inputs['facility'],$inputs['unit'],$inputs['plate_no'],$inputs['af'],$inputs['tlv'],$inputs['granted'],
            $inputs['terms'],$inputs['ma'],$inputs['balance'],$inputs['rule78'],$inputs['exp'],$inputs['rel_id']));
            Alert("Successfully Updated.","success");
            }
			$con->commit();
			redirect("business_writeup.php?id=".$inputs['id']."#our_relations");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("business_writeup.php?id=".$inputs['id']."#our_relations");
			die;
		}
	}
?>