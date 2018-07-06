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
            if($inputs['type']=='statement'){
                if(empty($_POST['bwu_id'])){
                $con->myQuery("INSERT INTO cred_app_bwu(loan_id,note,statement) 
                VALUES(?,?,?)",array($inputs['id'],$inputs['note'],$inputs['statement']));
                Alert("Successfully Added.","success");
                }
                else{
                $con->myQuery("UPDATE cred_app_bwu SET note=?,statement=?
                WHERE id=?",array($inputs['note'],$inputs['statement'],$inputs['bwu_id']));
                Alert("Successfully Updated.","success");
                }
                $con->commit();
                redirect("business_writeup.php?id=".$inputs['id']."#statement");
                die;
            }elseif($inputs['type']=='cash_flow'){
                $less_amt=$con->myQuery("SELECT SUM(amount) AS amount FROM cred_app_less WHERE is_deleted='0' AND loan_id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
                $less_per=$con->myQuery("SELECT SUM(percent) AS per FROM cred_app_less WHERE is_deleted='0' AND loan_id=?",array($inputs['id']))->fetch(PDO::FETCH_ASSOC);
                    $net_inc=$inputs['gross_inc']-($inputs['gross_inc']*($less_per['per']/100));
                    $net_inc=$net_inc-$less_amt['amount'];
                if(empty($_POST['bwu_id'])){
                    $con->myQuery("INSERT INTO cred_app_bwu(loan_id,gross_inc,net_inc) 
                    VALUES(?,?,?)",array($inputs['id'],$inputs['gross_inc'],$net_inc));
                    Alert("Successfully Added.","success");
                    }
                    else{
                    $con->myQuery("UPDATE cred_app_bwu SET gross_inc=?,net_inc=?
                    WHERE id=?",array($inputs['gross_inc'],$net_inc,$inputs['bwu_id']));
                    Alert("Successfully Updated.","success");
                    }
                    $con->commit();
                    redirect("business_writeup.php?id=".$inputs['id']."#cash_flow");
                    die;
            }elseif($inputs['type']=='strengths'){
                if(empty($_POST['bwu_id'])){
                $con->myQuery("INSERT INTO cred_app_bwu(loan_id,strength,weak,reco) 
                VALUES(?,?,?,?)",array($inputs['id'],$inputs['strength'],$inputs['weak'],$inputs['reco']));
                Alert("Successfully Added.","success");
                }
                else{
                $con->myQuery("UPDATE cred_app_bwu SET strength=?,weak=?,reco=?
                WHERE id=?",array($inputs['strength'],$inputs['weak'],$inputs['reco'],$inputs['bwu_id']));
                Alert("Successfully Updated.","success");
                }
                $con->commit();
                redirect("business_writeup.php?id=".$inputs['id']."#strengths");
                die;
            }
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("business_writeup.php?id=".$inputs['id']."#cash_flow");
			die;
		}
	}
?>