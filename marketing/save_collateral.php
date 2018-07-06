<?php
require_once("../support/config.php");
if(!isLoggedIn()){
    toLogin();
    die();
  }
  if(empty($_POST['id']) && empty($_POST['tbl_id'])){
      redirect('collateral_form.php');
      Alert('Collateral not found','warning');
  }
  
  $con->beginTransaction();
  $loan_list_id = 0;
  $_POST['exp_date'] = empty($_POST['exp_date'])?'0000-00-00':$_POST['exp_date'];
  $_POST['or_date']  = empty($_POST['or_date'])?'0000-00-00':$_POST['or_date'];
  $_POST['lcp'] = stripFloat($_POST['lcp']);
if($_POST['submit_type']=="create"){
    
    $data = array(
        'client_no' => $_POST['client_no'],
        'client_name' => $_POST['client_name'],
        'assignee' => $_POST['assignee'],
        'unit_lot_d' => $_POST['unit_lot_d'],
        'motor_no_location' => $_POST['motor_no_location'],
        'chassis_tct_no' => $_POST['chassis_tct_no'],
        'plate_no' => $_POST['plate_no'],
        'or_no' => $_POST['or_no'],
        'cr_no' => $_POST['cr_no'],
        'lto_agency' => $_POST['lto_agency'],
        'lcp' => $_POST['lcp'],
        'or_date' => date_format(date_create($_POST['or_date']),'Y-m-d'),
        'stencile' => $_POST['stencile'],
        'insurance_status' => $_POST['insurance_status'],
        'ins_com_num' => $_POST['ins_com_num'],
        'ins_co' => $_POST['ins_co'],
        'policy_no' => $_POST['policy_num'],
        'exp_date' => date_format(date_create($_POST['exp_date']),'Y-m-d'),
        'applied_by' => $_SESSION[WEBAPP]['user']['user_id'],
        'loan_list_id' =>$_POST['id']
    );


$loan_list_id = $data['loan_list_id'];
        $con->myQuery("INSERT INTO 
                        collateral_info(client_no, client_name, assignee, 
                                        unit_description, location_motor, tct_no, 
                                        plate_no, or_no, cr_no, lto_agency, 
                                        approve_value, or_date, with_stencile, 
                                        insurance_status, insurance_comp_no, 
                                        insurance_comp, policy_no, exp_date, 
                                        applied_by, loan_list_id)
                       VALUES(:client_no, :client_name, :assignee, 
                              :unit_lot_d, :motor_no_location, :chassis_tct_no, 
                              :plate_no, :or_no, :cr_no, :lto_agency, 
                              :lcp, :or_date, :stencile,
                              :insurance_status, :ins_com_num,
                              :ins_co,:policy_no, :exp_date,
                              :applied_by, :loan_list_id)",$data);
        redirect('collateral_list.php?id='.$_POST['id'].$_POST['ml']);
        Alert("Successfully Added.","success");

       
}

if($_POST['submit_type']=="edit"){
    $data = array(
        'client_no' => $_POST['client_no'],
        'client_name' => $_POST['client_name'],
        'assignee' => $_POST['assignee'],
        'unit_lot_d' => $_POST['unit_lot_d'],
        'motor_no_location' => $_POST['motor_no_location'],
        'chassis_tct_no' => $_POST['chassis_tct_no'],
        'plate_no' => $_POST['plate_no'],
        'or_no' => $_POST['or_no'],
        'cr_no' => $_POST['cr_no'],
        'lto_agency' => $_POST['lto_agency'],
        'lcp' => $_POST['lcp'],
        'or_date' => date_format(date_create($_POST['or_date']),'Y-m-d'),
        'stencile' => $_POST['stencile'],
        'insurance_status' => $_POST['insurance_status'],
        'ins_com_num' => $_POST['ins_com_num'],
        'ins_co' => $_POST['ins_co'],
        'policy_no' => $_POST['policy_num'],
        'exp_date' => date_format(date_create($_POST['exp_date']),'Y-m-d'),
        'applied_by' => $_SESSION[WEBAPP]['user']['user_id'],
        'collat_id' =>$_POST['tbl_id']
    );
//     print_r($_POST);   
// die();

        $con->myQuery("UPDATE collateral_info 
                       SET client_no=:client_no,
                           client_name=:client_name,
                           assignee=:assignee,
                           unit_description=:unit_lot_d,
                           location_motor=:motor_no_location,
                           tct_no=:chassis_tct_no,
                           plate_no=:plate_no,
                           or_no=:or_no,
                           cr_no=:or_no,
                           lto_agency=:lto_agency,
                           approve_value=:lcp,
                           or_date=:or_date,
                           with_stencile=:stencile,
                           insurance_status=:insurance_status,
                           insurance_comp_no=:ins_com_num,
                           insurance_comp=:ins_co,
                           policy_no=:policy_no,
                           exp_date=:exp_date,
                           applied_by=:applied_by
                        WHERE id=:collat_id",$data);
                        redirect('collateral_entry_form.php?id='.$_POST['id'].'&edit='.$_POST['tbl_id'].$_POST['ml']);
        Alert("Successfully Updated.","success");
}

if(isset($_POST['submit']) && $_POST['submit_type']=="delete"){
    
    $data = array('id' => $_POST['id']);
    $con->myQuery("UPDATE collateral_info
                    SET is_deleted=1
                    WHERE id=:id",$data);
Alert("Successfully Deleted.","warning");
}

$con->commit();
// if($_POST['submit_type'] == "create"){
//     redirect("collateral_list.php?id=".$loan_list_id);
// }else{
//     redirect("collateral_form.php");
// }


?>
