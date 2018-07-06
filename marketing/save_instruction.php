<?php
require_once("../support/config.php");
if(!isLoggedIn()){
    toLogin();
    die();
  }
  if(empty($_POST['id']) || !ctype_digit($_POST['id'])){
      redirect('instruction_sheet_prep.php');
  }

  
  function CustomR($msg="",$id){
    redirect("instruction_sheet_form.php?id={$id}");
    Alert($msg,'warning');
    die();
  } 

  $con->beginTransaction();

if((isset($_POST['submit']) && !empty($_POST['submit'])) || (isset($_POST['update']) && !empty($_POST['update']))){


    $_POST['start_date'] = isDate28($_POST['start_date']) ? isDate28($_POST['start_date'],true) : CustomR('Invalidate date',$_POST['id']);
    $day = date_format(date_create($_POST['start_date']),'d') . "";
    $day = (int)$day;
    $year = date_format(date_create($_POST['start_date']),'Y');
    $year = (int)$year;
    if($year < 2000){
      CustomR('Invalid date: ('.$year.")\nDate must be later than 2000",$_POST['id']);
      die();
    }
    $fChecks = array('term','add_on_rate','less_udi_alir','list_cash_price','appraised_value','dp_gd_rv','rebate_rcf');

    for($i = 0; $i< count($fChecks); $i++){
      if(!filter_var(stripFloat($_POST[$fChecks[$i]]),FILTER_VALIDATE_FLOAT)){
        // CustomR('Invalid Parameters A',$_POST['id']);
        // die();
      }
    }

    $percCheck = array('add_on_rate','less_udi_alir');
    for($i = 0; $i < count($percCheck) ; $i++){
      if((float)$_POST[$percCheck[$i]] > 100.00){
        CustomR('Invalid Parameters B',$_POST['id']);
        die();
      }
    }
    if(!empty($_POST['list_cash_price']) && !empty($_POST['appraised_value'])){
      CustomR('Invalid Parameters C',$_POST['id']);
      die();
    }
    $choosen = empty($_POST['list_cash_price'])?stripFloat($_POST['appraised_value']):stripFloat($_POST['list_cash_price']);
    if((float)stripFloat($_POST['dp_gd_rv']) > (float)$choosen){
      CustomR('DP/GD/RV exceeded LCP/AV',$_POST['id']);
      die();
    }
    $dp = (float)stripFloat($_POST['dp_gd_rv']);
    $term = $_POST['term'];
    $addOn = ((float)$_POST['add_on_rate'] / 100) + 1;
    $rebate = (float)stripFloat($_POST['rebate_rcf']);
    $_POST['amount_financed'] = isEmptyFloat($choosen - $dp);
    $_POST['rcf'] = isEmptyFloat($term * $rebate);
    $pn = ($choosen - $dp) * $addOn;
    $tlv = ($pn) + ($term * $rebate);
    $_POST['total_loan_value'] = isEmptyFloat($tlv);
    $_POST['pn_amount'] = isEmptyFloat($pn);

    $second = floor($tlv / $term);
    $first = ceil($tlv - ($second * ($term - 1)));
    $_POST['second_payment'] = isEmptyFloat($second);
    $_POST['mon_first'] = isEmptyFloat($first);
    
    $termDays = ($term - 1)." months";
    $mat = date_create($_POST['start_date']);
    $val = date_create($_POST['start_date']);
    date_add($mat,date_interval_create_from_date_string($termDays));
    date_sub($val,date_interval_create_from_date_string('30 days'));

    $mat = date_format($mat,'m/d/Y');
    $val = date_format($val,'m/d/Y');
    $_POST['maturity_date'] =  $mat = isDate28($mat,true,$day);
    $_POST['value_date']  = $val = isDate28($val,true,$day);
    $_POST['duedate'] = $day;

    $lessPer = (float)$_POST['less_udi_alir'] / 100;
    $lessTotal = $pn * $lessPer;
    $_POST['less_total'] = isEmptyFloat($lessTotal);
    $_POST['total_above'] = isEmptyFloat($pn - $lessTotal);

    $fee = array('mort','proc','apprais','comm','front_in','real_estate','insur_prem','handling',
                      'dpb','doc','sbgfc','other_one','other_two');
         $sum_all_fee = 0;   
         $or_total =0 ;
                      
    for($i =0 ;$i < count($fee) ;$i++){
      //If O.R is greater than amount
      $total =  (float)str_replace(',','',$_POST[$fee[$i].'_fee'])  - (float)str_replace(',','',$_POST[$fee[$i].'_total']);
      // echo $_POST[$fee[$i].'_fee'] . " | " . $_POST[$fee[$i].'_total']." = {$total}<br>";

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
    $_POST['amount_due'] = ($pn - $lessTotal) - $sum_all_fee;

    if($_POST['sum_all_fee'] > $lessTotal){
      CustomR('Fee exceeded from sub-total',$_POST['id']);
    }

    if((float)$_POST['amount_due'] < 0 || strpos('-',$_POST['sum_all_fee']) > 0){
      redirect('instruction_sheet_td.php?id='.$_POST['id']."&tab=1");
      Alert('Invalid parameters. (Fee is greater than Amount Due)','warning');
      die();
    }
    // print_r($_POST);
    // die();


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
    $inputs['term'] = $_POST['term'];
    $inputs['list_cash_price'] = str_replace(',','',$_POST['list_cash_price']);
    $inputs['addon_rate'] = $_POST['add_on_rate'];
    $inputs['appraised_value'] = str_replace(',','',$_POST['appraised_value']);
    $inputs['mon_first_payment'] = str_replace(',','',$_POST['mon_first']);
    $inputs['dp_gd_rv'] = str_replace(',','',$_POST['dp_gd_rv']); 
    $inputs['mon_second_payment'] = str_replace(',','',$_POST['second_payment']);
    $inputs['start_date'] = date_format(date_create($_POST['start_date']),'Y-m-d');
    $inputs['maturity_date'] = date_format(date_create($_POST['maturity_date']),'Y-m-d');
    $inputs['due_date'] = $_POST['duedate'];
    $inputs['value_date'] = date_format(date_create($_POST['value_date']),'Y-m-d');
    $inputs['amount_fin'] = str_replace(',','',$_POST['amount_financed']); 
    $inputs['amount_pn'] = str_replace(',','',$_POST['pn_amount']); 
    $inputs['rcf'] = str_replace(',','',$_POST['rcf']); 
    $inputs['rebate_rcf'] = str_replace(',','',$_POST['rebate_rcf']); 
    $inputs['TLV'] = str_replace(',','',$_POST['total_loan_value']); 
    $inputs['manner_payment'] = $_POST['manner_payment'];
    $inputs['less_udi_percent'] = $_POST['less_udi_alir'];
    $inputs['less_total'] = str_replace(',','',$_POST['less_total']); 
    $inputs['udi_bal'] = str_replace(',','',$_POST['total_above']); 
    // $inputs['udi_first_mon'] = str_replace(',','',$_POST['first_udi']); 
    // $inputs['udi_second_mon'] = str_replace(',','',$_POST['second_udi']); 

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
    $inputs['or_date'] = (!empty($_POST['or_date'])?date_format(date_create($_POST['or_date']),'Y-m-d'):'0000-00-00');
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
    $authCreate = $con->myQuery("INSERT INTO instruction_sheet".$query,$inputs);
        $con->myQuery("UPDATE client_list SET(amt_fin = :amt_fin) WHERE id = :ll_id AND is_deleted = 0",array(
            'amt_fin' => $inputs['amount_fin'],
            'll_id' => $inputs['ll_id']
        ));

    //     print_r($authCreate);
    // die();
    redirect("instruction_sheet_form.php?id=".$inputs['ll_id']);
    Alert('Successfully Saved Data','success');

  }

  if(isset($_POST['update']) && !empty($_POST['update'])){

    $query = "UPDATE instruction_sheet SET ";
    $num =  count($inputs);
    $i = 0;
    foreach($inputs AS $key => $value){
        if($i == ($num - 1)){
          $query .= $key ." = :".$key. " ";
        }else{
          $query .= $key." = :".$key.", ";
        }
        $i++;
    }

    $query .= " WHERE id = ".$_POST['tbl_id']. " AND is_deleted = 0";
    $authUpdate = $con->myQuery($query,$inputs);
    redirect("instruction_sheet_form.php?id=".$inputs['ll_id']);
    Alert('Successfully Update Data','success');
  }
  $con->commit();