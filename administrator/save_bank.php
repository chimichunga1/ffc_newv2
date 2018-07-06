<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
      }

	$errors="";

		if($errors!="")
		{   
            Alert("You have the following errors: <br/>".$errors,"danger");
            echo "<script> window.history.back(); </script>";
			die;
		}else{
	
			if(empty($_POST['id'])){
                $con->myQuery("INSERT INTO bank(name) VALUES(?)",array($_POST['bank_name']));
                Alert("Successfully Added.","success");
                redirect("bank.php");
                die;
            }
			else{
                $con->myQuery("UPDATE bank SET name=? WHERE id=?",array($_POST['bank_name'],$_POST['id']));
                Alert("Successfully Updated.","success");
                redirect("frm_bank.php?id=".$_POST['id']);
                die;
            }
           
            
		
	}
?>