<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
      }

	$errors="";
	$check=$con->myQuery("SELECT id FROM payment_type WHERE code=? AND id!=? AND is_deleted=0",array($_POST['payment_code'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Payment Code already exist.";
        }
        // var_dump($check);
    // die;
		if($errors!="")
		{   
            Alert("You have the following errors: <br/>".$errors,"danger");
            echo "<script> window.history.back(); </script>";
			die;
		}else{
	
			if(empty($_POST['id'])){
                $con->myQuery("INSERT INTO payment_type(code,name) VALUES(?,?)",array($_POST['payment_code'],$_POST['payment_name']));
                Alert("Successfully Added.","success");
                redirect("payment_type.php");
                die;
            }
			else{
                $con->myQuery("UPDATE payment_type SET code=? , name=? WHERE id=?",array($_POST['payment_code'],$_POST['payment_name'],$_POST['id']));
                Alert("Successfully Updated.","success");
                redirect("frm_payment_type.php?id=".$_POST['id']);
                die;
            }
           
            
		
	}
?>