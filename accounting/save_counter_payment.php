<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
	}


	$errors="";
    $inputs=$_POST;
    // var_dump($inputs);
    // die;
	
    
    if(empty($_POST['id'])){
            
            
            $con->myQuery("INSERT INTO
                        official_receipt(
                            client_id,
                            payment_type_id,
                            bank_id,
                            check_no,
                            details,
                            deposit_date,
                            cash,
                            cheque,
                            total,
                            date
                        ) VALUES(
                            :client_id,
                            :payment_type,
                            :bank,
                            :check_no,
                            :details,
                            :dep_date,
                            :cash,
                            :check,
                            :total,
                            CURDATE()
                            
                        )",$inputs);
            Alert("Successfully Added.","success");
            redirect("view_ass_or.php?id={$inputs['client_id']}");
            die;
    }
  

?>