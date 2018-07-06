<?php
require_once("../support/config.php");
if(!isLoggedIn()){
    toLogin();
    die();
  }

  function CustomR($msg="",$id){
    redirect("instruction_sheet_td.php?id={$id}&tab=1");
    Alert($msg,'warning');
  } 
  if(empty($_POST['id']) || !ctype_digit($_POST['id'])){
      redirect('instruction_sheet_prep.php');
  }
  function redirectTD($id){ redirect('instruction_sheet_form.php?id='.$id.'&tab=1'); Alert('Invalid Fields Inputed'); }
  $con->beginTransaction();

  if((isset($_POST['submit']) && !empty($_POST['submit'])) || (isset($_POST['update']) && !empty($_POST['update']))){
  
        $_POST['start_date'] = isDate28($_POST['start_date']) ? isDate28($_POST['start_date'],true) : redirectTD($_POST['id']);
        $day = date_format(date_create($_POST['start_date']),'d') . "";
        $day = (int)$day;
        $year = date_format(date_create($_POST['start_date']),'Y');
        $year = (int)$year;
        if($year < 2000){
          CustomR('Invalid date: ('.$year.")/nDate must be later than 2000",$_POST['id']);
          die();
        }
      
        $_POST['int_rate'] = filter_var($_POST['int_rate'], FILTER_VALIDATE_FLOAT) && (float)$_POST['int_rate'] <= 100.00 ? $_POST['int_rate'] : redirectTD($_POST['id']);
        $_POST['value_date'] = date_sub(date_create($_POST['start_date']),date_interval_create_from_date_string("30 days"));
        $_POST['value_date'] = isDate28(date_format($_POST['value_date'],'m/d/Y'),true,$day);
        
$customValidate = array('amount_due','amount_payee_1','amount_payee_2','amount_payee_3','amount_payee_4','amount_payee_5',
'amount_line','discount','outstanding_avail','prop_avail','avail_bal');

$fee = array('mort','proc','apprais','comm','front_in','real_estate','insur_prem','handling',
                      'dpb','doc','sbgfc','other_one','other_two');
         $sum_all_fee = 0;   
         $or_total =0 ;
                      
    for($i =0 ;$i < count($fee) ;$i++){
      //If O.R is greater than amount
      $total =  (float)str_replace(',','',$_POST[$fee[$i].'_fee'])  - (float)str_replace(',','',$_POST[$fee[$i].'_total']);
      echo $_POST[$fee[$i].'_fee'] . " | " . $_POST[$fee[$i].'_total']." = {$total}<br>";

      if((float)str_replace(',','',$_POST[$fee[$i].'_fee']) < (float)str_replace(',','',$_POST[$fee[$i].'_total']) || $total < 0.00){
        CustomR('Invalid parameters (O.R exceed Amount)',$_POST['id']);
        die();
      }
      //If (Fee - OR) isn't a match
      
      // elseif((float)str_replace(',','',$_POST[$fee[$i]."_total_above"]) != $total){
      //   redirect('instruction_sheet_td.php?id='.$_POST['id']."&tab=1");
      //   Alert('Invalid parameters (C.V Error)','warning');
      //   die();
      // }
    
      // elseif($total < 0.0){
      //   redirect('instruction_sheet_td.php?id='.$_POST['id']."&tab=1");
      //   Alert('Invalid parameters (Negative Amount)','warning');
      //   die();
      // }

      $_POST[$fee[$i]."_total_above"] = (float)stripFloat($_POST[$fee[$i]."_fee"]) - (float)stripFloat($_POST[$fee[$i]."_total"]);
      $sum_all_fee += (float)stripFloat($_POST[$fee[$i]."_total_above"]);
      $or_total += (float)stripFloat($_POST[$fee[$i]."_total"]);

    }                     
    $sum_all_fee += (float)stripFloat($_POST['sm_total_above']);  
    $sum_all_fee += (float)stripFloat($_POST['dealer_total_above']);  
    $_POST['sum_all_fee'] = $sum_all_fee;
    $_POST['or_amount']  = $or_total;

    //If input datatype isn't float
        foreach($_POST AS $key => $value){
          if(strpos($key,'_fee') > 0 || strpos($key,'_total') > 0 || strpos($key,"amount",1) > 0 || strpos($key,'proceeds') > 0 || in_array($key,$customValidate)){
            if(!empty($value) && !filter_var(str_replace(',','',$value),FILTER_VALIDATE_FLOAT)){
                redirect('instruction_sheet_td.php?id='.$_POST['id']."tab=1");
                Alert('Invalid parameters (Invalid datatype)','warning');
            }
          }
        }
       
      $aT = str_replace(',','',$_POST['amount_due']);  
      $aD = str_replace(',','',$_POST['sum_all_fee']);
      //If amount deduct is greater amoung due || amount due is -negative value
      if((float)$aT < (float)$aD || (float)$aT < 0 || strpos('-',$aD) > 0){
        redirect('instruction_sheet_td.php?id='.$_POST['id']."&tab=1");
        Alert('Invalid parameters. (Fee is greater than Amount Due)','warning');
        die();
      }

    $inputs['ll_id'] = $_POST['id'];
    $inputs['app_no'] = $_POST['app_no'];
    $inputs['acc_no'] = $_POST['acc_no'];
    $inputs['bor_name'] = $_POST['bor_name'];
    $inputs['client_no'] =  $_POST['client_no'];
    $inputs['spouse'] = $_POST['spouse'];
    $inputs['client_stat'] = $_POST['client_status'];
    $inputs['address'] = $_POST['address'];
    $inputs['pri_con'] = $_POST['pri_con'];
    $inputs['unit_desc'] = $_POST['unit_desc'];
    $inputs['tie_up_account'] = $_POST['tieup_account'];
    $inputs['tu_lname'] = $_POST['ta_lname'];
    $inputs['tu_fname'] = $_POST['ta_fname'];
    $inputs['tu_unit_desc'] = $_POST['ta_unit_desc'];
    $inputs['amount_line'] = !empty($_POST['amount_line'])?stripFloat($_POST['amount_line']):'';
    $inputs['avail_bal'] = !empty($_POST['avail_bal'])?stripFloat($_POST['avail_bal']):'';
    $inputs['outstanding_avail'] = !empty($_POST['outstanding_avail'])?stripFloat($_POST['outstanding_avail']):'';
    $inputs['prop_avail'] = !empty($_POST['prop_avail'])?stripFloat($_POST['prop_avail']):'';
    $inputs['date_approved'] = format_date($_POST['date_approved']);
    $inputs['term'] = $_POST['term'];
    $inputs['max_term'] = !empty($_POST['max_term'])?$_POST['max_term']:'';
    $inputs['int_rate'] = !empty($_POST['int_rate'])?$_POST['int_rate']:'';
    $inputs['start_date'] = !empty($_POST['start_date'])?date_format(date_create($_POST['start_date']),'Y-m-d'):'0000-00-00';
    $inputs['maturity_date'] = !empty($_POST['maturity_date'])?date_format(date_create($_POST['maturity_date']),'Y-m-d'):"0000-00-00";
    
    $inputs['value_date'] = !empty($_POST['value_date'])?date_format(date_create($_POST['value_date']),'Y-m-d'):"0000-00-00";
    
    // $inputs['amount_pn'] = str_replace(',','',$_POST['pn_amount']); 
    // $inputs['discount'] = !empty($_POST['discount'])?stripFloat($_POST['discount']):'';
    // $inputs['net_proceeds'] = !empty($_POST['net_proceeds'])?stripFloat($_POST['net_proceeds']):'';
    $inputs['manner_payment'] = $_POST['manner_payment'];
    

    $inputs['mort_fee'] = str_replace(',','',$_POST['mort_fee']); 
    $inputs['mort_or'] = str_replace(',','',$_POST['mort_total']); 
    $inputs['mort_total'] = str_replace(',','',$_POST['mort_total_above']);

    $inputs['proc_fee'] = str_replace(',','',$_POST['proc_fee']); 
    $inputs['proc_or'] = str_replace(',','',$_POST['proc_total']); 
    $inputs['proc_total'] = str_replace(',','',$_POST['proc_total_above']); 

    $inputs['apprais_fee'] = str_replace(',','',$_POST['apprais_fee']); 
    $inputs['apprais_or'] = str_replace(',','',$_POST['apprais_total']); 
    $inputs['apprais_total'] = str_replace(',','',$_POST['apprais_total_above']); 

    $inputs['comm_fee'] = str_replace(',','',$_POST['comm_fee']); 
    $inputs['comm_or'] = str_replace(',','',$_POST['comm_total']); 
    $inputs['comm_total'] = str_replace(',','',$_POST['comm_total_above']); 

    $inputs['front_fee'] = str_replace(',','',$_POST['front_in_fee']); 
    $inputs['front_or'] = str_replace(',','',$_POST['front_in_total']); 
    $inputs['front_total'] = str_replace(',','',$_POST['front_in_total_above']); 

    $inputs['sm_fee'] = str_replace(',','',$_POST['sm_fee']); 
    $inputs['salesman_id'] = $_POST['salesman_id'];
    $inputs['sm_total'] = str_replace(',','',$_POST['sm_total_above']); 

    $inputs['dealer_fee'] = str_replace(',','',$_POST['dealer_fee']); 
    $inputs['dealer_id'] = $_POST['dealer_id'];
    $inputs['dealer_total']  = str_replace(',','',$_POST['dealer_total_above']); 

    $inputs['real_estate_fee'] = str_replace(',','',$_POST['real_estate_fee']); 
    $inputs['real_estate_or'] = str_replace(',','',$_POST['real_estate_total']); 
    $inputs['real_estate_total'] = str_replace(',','',$_POST['real_estate_total_above']); 

    $inputs['insur_prem_fee'] = str_replace(',','',$_POST['insur_prem_fee']); 
    $inputs['insur_prem_or'] = str_replace(',','',$_POST['insur_prem_total']); 
    $inputs['insur_prem_total'] = str_replace(',','',$_POST['insur_prem_total_above']); 

    $inputs['handling_fee'] = str_replace(',','',$_POST['handling_fee']); 
    $inputs['handling_or'] = str_replace(',','',$_POST['handling_total']); 
    $inputs['handling_total'] = str_replace(',','',$_POST['handling_total_above']); 

    $inputs['dpb_fee'] = str_replace(',','',$_POST['dpb_fee']); 
    $inputs['dpb_or'] = str_replace(',','',$_POST['dpb_total']); 
    $inputs['dpb_total'] = str_replace(',','',$_POST['dpb_total_above']); 
    
    $inputs['doc_fee'] = str_replace(',','',$_POST['doc_fee']); 
    $inputs['doc_or'] = str_replace(',','',$_POST['doc_total']); 
    $inputs['doc_total'] = str_replace(',','',$_POST['doc_total_above']); 

    $inputs['sbgfc_fee'] = str_replace(',','',$_POST['sbgfc_fee']); 
    $inputs['sbgfc_or'] = str_replace(',','',$_POST['sbgfc_total']); 
    $inputs['sbgfc_total'] = str_replace(',','',$_POST['sbgfc_total_above']); 

    $inputs['other_one_fee'] = str_replace(',','',$_POST['other_one_fee']); 
    $inputs['other_one_or'] = str_replace(',','',$_POST['other_one_total']); 
    $inputs['other_one_total'] = str_replace(',','',$_POST['other_one_total_above']); 

    $inputs['other_two_fee'] = str_replace(',','',$_POST['other_two_fee']); 
    $inputs['other_two_or'] = str_replace(',','',$_POST['other_two_total']); 
    $inputs['other_two_total'] = str_replace(',','',$_POST['other_two_total_above']); 

    $inputs['amount_deduct'] = str_replace(',','',$_POST['sum_all_fee']); 
    $inputs['amount_due'] = str_replace(',','',$_POST['amount_due']);
    
    $inputs['or_no'] = $_POST['or_no'];
    $inputs['or_date'] = !empty($_POST['or_date'])?date_format(date_create($_POST['or_date']),'Y-m-d'):'0000-00-00';
    $inputs['or_amount'] = str_replace(',','',$_POST['or_amount']);

    $inputs['payee1'] = $_POST['payee_1'];
    $inputs['amount_payee1'] = str_replace(',','',$_POST['amount_payee_1']);
    $inputs['payee2'] = $_POST['payee_2'];
    $inputs['amount_payee2'] = str_replace(',','',$_POST['amount_payee_2']);
    $inputs['payee3'] = $_POST['payee_3'];
    $inputs['amount_payee3'] = str_replace(',','',$_POST['amount_payee_3']);
    $inputs['payee4'] = $_POST['payee_4'];
    $inputs['amount_payee4'] = str_replace(',','',$_POST['amount_payee_4']);
    $inputs['payee5'] = $_POST['payee_5'];
    $inputs['amount_payee5'] = str_replace(',','',$_POST['amount_payee_5']);
  }

  if(isset($_POST['submit']) && !empty($_POST['submit'])){

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
    $query = $names . " VALUES".$values;
    $authCreate = $con->myQuery("INSERT INTO instruction_sheet_td".$query,$inputs);
    redirect("instruction_sheet_td.php?id=".$inputs['ll_id']."&tab=1");
    Alert('Successfully Saved Data','success');

  }

  if(isset($_POST['update']) && !empty($_POST['update'])){

    $query = "UPDATE instruction_sheet_td SET ";
    $num =  count($inputs);
    $i = 0;
    foreach($inputs AS $key => $value){
        if($i == ($num - 1)){
          $query .= $key ." = :".$key. "";
        }else{
          $query .= $key." = :".$key.", ";
        }
        $i++;
    }

    $query .= " WHERE id = ".$_POST['tbl_id']. " AND is_deleted = 0";
    $authUpdate = $con->myQuery($query,$inputs);
    // print_r($inputs);
    // die();
    redirect("instruction_sheet_td.php?id=".$inputs['ll_id']."&tab=1");
    Alert('Successfully Update Data','success');
  }
  $con->commit();

