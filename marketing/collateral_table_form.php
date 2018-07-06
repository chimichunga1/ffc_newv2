<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead(" Collateral Entry/Update ",1);
    if (empty($_GET['tab']) || $_GET['tab'] <> 1 ) {
        redirect("collateral_entry_update.php");
    }

    if(isset($_GET['id'])){
        $data=$con->myQuery("SELECT * FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
        $rowNum=$con->myQuery("SELECT * FROM collateral_info WHERE client_no=?",array($data['client_no']))->fetchColumn();
        $client = $con->myQuery("SELECT CONCAT(fname,' ' , mname, ' ' , lname) as fullname, client_number FROM client_list WHERE client_number=?",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);

        
        // if($rowNum > 0){
        //     $collateral=$con->myQuery("SELECT * FROM collateral_info WHERE client_no=? AND is_deleted=0",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);
        //     // require_once();
        // }
        //     else{
        //         $client = $con->myQuery("SELECT CONCAT(fname,' ' , mname, ' ' , lname) as client_fullname, client_number FROM client_list WHERE client_number=?",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);
        //         // print_r($client);
        //         require_once('collateral_entry_update_form.php');
        //     }
    }