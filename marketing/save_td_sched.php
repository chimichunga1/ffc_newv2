<?php
require_once("../support/config.php");
if(!isLoggedIn()){
    toLogin();
    die();
  }
  if(empty($_POST['id']) || !ctype_digit($_POST['id']) || !filter_var(str_replace(',','',$_POST['amount']),FILTER_VALIDATE_FLOAT)){
    redirect('instruction_sheet_prep.php');
         Alert('Invalid Fields','warning');
      $auth = $con->myQuery("SELECT * FROM loan_list WHERE id = ? AND loan_type_id = 4 AND is_deleted = 0",array($_POST['id']))->rowCount();
        if($auth > 0){
            redirect('instruction_sheet_prep.php');
            Alert('User not found','warning');
        }
  }
  function cDate($date){return new DateTime($date);}
  $data = $con->myQuery("SELECT * FROM instruction_sheet_td WHERE ll_id = ? AND is_deleted = 0",array($_POST['id']))->fetch(PDO::FETCH_ASSOC);
  $con->beginTransaction();

  $rel = $data['start_date'];
  $rel = date_create($rel);
  $mat = format_date($_POST['maturity_date_sched']);
  $mat = date_create($mat);
  $diff = date_diff($rel,$mat);
  $diff = $diff->format("%R %a days");
  $diff = explode(' ',$diff);
  
  
    if($diff[0] == "-" || $diff[1] == 0){
        echo "Working";
        redirect('instruction_sheet_td.php?id='.$_POST['id'].'&tab=2');
        Alert('Maturity date is invalid. (Must be after release date)','warning');
        die();
    }

    $_POST['amount'] = stripFloat($_POST['amount']);
    $term = (int)$diff[1];
    $int_rate = (float)$data['int_rate'] / 100;
    $factor = ($term * $int_rate + 360 ) / 360;
    $factor = number_format((float)$factor,6);
    $proceed = (float)$_POST['amount'] / $factor;
    $discount = (float)$_POST['amount'] - $proceed;

    
    $inputs['app_no'] = $data['app_no'];
    $inputs['client_no'] = $data['client_no'];
    $inputs['bank'] = $_POST['bank'];
    $inputs['check_no'] = $_POST['check_no'];
    $inputs['amount_sched'] = $_POST['amount'];
    $inputs['maturity_date_sched'] = date_format($mat,'Y-m-d');
    $inputs['term_sched'] = $term;
    $inputs['discount'] = $discount;
    $inputs['net_proceeds_sched'] = $proceed;

    if(!empty($_POST['create'])){
        $names = "(";
    $num = count($inputs);
    $i = 0;
    foreach($inputs AS $key => $value){
        if($i == ($num - 1)){
          $names .= $key . ")";
        }else{
          $names .= $key.", ";
        }
        $i++;
    }

    $values = "(";
    $i = 0;
    foreach($inputs AS $key => $value){
        if($i == ($num - 1)){
          $values .= ":".$key . ")";
        }else{
          $values .= ":".$key.", ";
        }
        $i++;
    }
    $query = "INSERT INTO td_sched".$names . " VALUES".$values;
    
    $authCreate = $con->myQuery($query,$inputs);    
    
    
    redirect('instruction_sheet_td.php?id='.$_POST['id'].'&tab=2');
    Alert('Successfully added','success');
    }

    if(!empty($_POST['update'])){
            $authTbl = $con->myQuery("SELECT * FROM td_sched WHERE id = ? AND is_deleted = 0",array($_POST['idTbl']))->rowCount();
            if($authTbl <= 0){
                redirect('instruction_sheet_prep.php');
                Alert('Element not found','warning');
            }
            $set = "";
            $i = 0;
            $num = count($inputs) - 1;
            foreach($inputs AS $key => $value){
                    if($i == $num){
                        $set .= $key." = :".$key;
                    }else{
                        $set .= $key." = :".$key.", ";
                    }
                    $i++;
            }
            
        $authUp = $con->myQuery("UPDATE td_sched SET {$set} WHERE id = {$_POST['idTbl']} AND app_no = {$data['app_no']}  AND is_deleted = 0",$inputs);
        redirect('instruction_sheet_td.php?id='.$_POST['id']."&tab=2");
    }
    
$con->commit();

