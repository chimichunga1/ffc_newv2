<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    if(empty($_GET['id']) || !isset($_GET['id']) || !ctype_digit($_GET['id'])){
        redirect("instruction_sheet_prep.php");
    }
    $auth = $con->myQuery("SELECT * FROM loan_list WHERE id=? AND is_deleted=0",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
    if(count($auth) <= 0){
        redirect("instruction_sheet_prep.php");
    }

        $listAdd = AddonList();

    //Addon
    if(in_array($auth['loan_type_id'],$listAdd)){
        redirect('instruction_sheet_form.php?id='.$_GET['id']);
    }
    
        //Lump Sum
    if(in_array($auth['loan_type_id'],array(7))){}
    
        //Annuity
    if(in_array($auth['loan_type_id'],array(8))){}
    
        //True Discount
    if(in_array($auth['loan_type_id'],array(6))){
        redirect('instruction_sheet_td.php?id='.$_GET['id'].'&tab=1');
    }


