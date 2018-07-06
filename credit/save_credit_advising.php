<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
      }
      $con->beginTransaction();
      if(isset($_POST['id'])){
          $data = array(
              'client_name' => $_POST['client_name'],
              'spouse' => $_POST['spouse'],
              'co_maker' => $_POST['co_maker'],
              'contact_no' =>$_POST['contact_no'],
              'address' => $_POST['address'],
              'dealer' => $_POST['dealer'],
              'salesman' =>$_POST['salesman'],
              'unit' => $_POST['unit'],
              'list_cash_price' => $_POST['list_cash_price'],
              'appraised' => $_POST['appraised'],
              'downpayment' => $_POST['downpayment'],
              'term' => $_POST['term'],
              'amount_financed' => $_POST['amount_financed'],
              'interest_rate' => $_POST['interest_rate'],
              'monthly_payment'=> $_POST['monthly_payment'],
              'second_payment' => $_POST['second_payment'],
              'prepared_by' => $_POST['prepared_by'],
              'noted_by' => $_POST['noted_by'],
              'application_no' =>$_POST['id'],
              'client_no' => $_POST['client_no']
          
          );
          $try = $con->myQuery("INSERT INTO caf_info(
              client_no, application_no, client_name,
              spouse, co_maker, contact_no, address, dealer, salesman,
              unit, list_cash_price, appraised_value, 
              downpayment, amount_financed, term,
              interest_rate, monthly_payment, second_payment,
              prepared_by, noted_by
          ) VALUES(
              :client_no, :application_no, :client_name,
              :spouse, :co_maker, :contact_no, :address, :dealer, :salesman,
              :unit, :list_cash_price, :appraised, 
              :downpayment, :amount_financed, :term,
              :interest_rate, :monthly_payment, :second_payment,
              :prepared_by, :noted_by
          )",$data);
            
            
          $received = "('".implode("','",$_POST['req'])."')";
          $con->myQuery("UPDATE client_requirements_caf
          SET status='received' 
          WHERE requirement_code IN {$received}
          AND client_no={$_POST['client_no']} AND application_no = {$_POST['id']}");

$con->myQuery("UPDATE client_requirements_caf
SET status='pending' 
WHERE requirement_code NOT IN {$received}
AND client_no={$_POST['client_no']} AND application_no = {$_POST['id']}");
          Alert("Successfully Saved",'success');
      }

      if(isset($_POST['update'])){
        $data = array(
            'client_name' => $_POST['client_name'],
            'spouse' => $_POST['spouse'],
            'co_maker' => $_POST['co_maker'],
            'contact_no' =>$_POST['contact_no'],
            'address' => $_POST['address'],
            'dealer' => $_POST['dealer'],
            'salesman' =>$_POST['salesman'],
            'unit' => $_POST['unit'],
            'list_cash_price' => $_POST['list_cash_price'],
            'appraised' => $_POST['appraised'],
            'downpayment' => $_POST['downpayment'],
            'term' => $_POST['term'],
            'amount_financed' => $_POST['amount_financed'],
            'interest_rate' => $_POST['interest_rate'],
            'monthly_payment'=> $_POST['monthly_payment'],
            'second_payment' => $_POST['second_payment'],
            'prepared_by' => $_POST['prepared_by'],
            'noted_by' => $_POST['noted_by'],
            'application_no' =>$_POST['id'],
            'client_no' => $_POST['client_no'],
            'tbl_id' => $_POST['tbl_id']

        );
           $stat =  $con->myQuery("UPDATE caf_info 
            SET client_no=:client_no, application_no=:application_no, client_name=:client_name,
              spouse=:spouse, co_maker=:co_maker, contact_no=:contact_no, address=:address, dealer=:dealer, salesman=:salesman,
              unit=:unit, list_cash_price=:list_cash_price, appraised_value=:appraised, 
              downpayment=:downpayment, amount_financed=:amount_financed, term=:term,
              interest_rate=:interest_rate, monthly_payment=:monthly_payment, second_payment=:second_payment,
              prepared_by=:prepared_by, noted_by=:noted_by
              WHERE id=:tbl_id",$data);
              
              $received = "('".implode("','",$_POST['req'])."')";
              $con->myQuery("UPDATE client_requirements_caf
              SET status='received' 
              WHERE requirement_code IN {$received}
              AND client_no={$_POST['client_no']} AND application_no = {$_POST['id']}");
    
    $con->myQuery("UPDATE client_requirements_caf
    SET status='pending' 
    WHERE requirement_code NOT IN {$received}
    AND client_no={$_POST['client_no']} AND application_no = {$_POST['id']}");
              Alert("Successfully Updated",'success');
      }
      $con->commit();
redirect("ci_checking.php");
        
      ?>
