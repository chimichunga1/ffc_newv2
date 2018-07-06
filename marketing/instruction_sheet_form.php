<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    if(empty($_GET['id']) || !isset($_GET['id'])){
        redirect("instruction_sheet_prep.php");
    }
        $auth = $con->myQuery("SELECT * FROM loan_list WHERE id=".$_GET['id']." AND is_deleted=0")->fetchColumn();
            if($auth <= 0){
                redirect("instruction_sheet_prep.php");
            }
    
    makeHead("Instruction Sheet Preparation",1);
    
    
    require_once("../template/header.php");
    require_once("../template/sidebar.php");
    $data=$con->myQuery("SELECT * FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
    $client = $con->myQuery("SELECT * FROM client_list WHERE client_number=? AND is_deleted=0",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);
    $dataIn = array(
        'app_no' => $data['app_no'],
        'client_no' => $data['client_no']
    );
    $mp = $con->myQuery("SELECT id,CONCAT(code ,' - ',name) AS paymentName FROM manner_of_payment WHERE is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
    $printISType = $con->myQuery("SELECT * FROM loan_approval_type WHERE id = :loan_id",array('loan_id' => $data['loan_type_id']))->fetch(PDO::FETCH_ASSOC);
    $clientLoan = $con->myQuery("SELECT B.code AS loan_type_code , 
                                        C.code AS credit_facility_code, 
                                        D.code AS prod_line_code, 
                                        E.code AS marketing_type_code
FROM loan_list A
JOIN loan_approval_type B ON A.loan_type_id = B.id
JOIN credit_facility C ON A.credit_fac_id = C.id 
JOIN product_line D ON A.prod_line_id = D.id
JOIN marketing_type E ON A.mark_type_id = E.id
WHERE A.id=? AND A.client_no=?
",array($_GET['id'],$data['client_no']))->fetch(PDO::FETCH_ASSOC);

$clientOtherLoan = $con->myQuery("SELECT B.name AS bus_code, C.name AS ind_code
FROM client_list A
JOIN business_type B ON A.bus_type_id = B.id
JOIN industry_code C ON A.ind_code_id = C.id
WHERE A.client_number = :client_num",array('client_num'=>$data['client_no']))->fetch(PDO::FETCH_ASSOC);

$clientAddon = $con->myQuery("SELECT * FROM instruction_sheet WHERE app_no = :app_no AND client_no = :client_no AND is_deleted= 0",$dataIn)->fetch(PDO::FETCH_ASSOC);
$countAddon = $con->myQuery("SELECT * FROM instruction_sheet WHERE app_no = :app_no AND client_no = :client_no AND is_deleted= 0",$dataIn)->fetchColumn();
    $bor_name = (empty($client['lname'])?'':$client['lname'].',') . " ".$client['fname'] ." " . substr($client['mname'],0,1);

    $dl=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_dealer='checked' ORDER BY lname")->fetchAll(PDO::FETCH_ASSOC);
    $sm=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_salesman='checked' ORDER BY lname")->fetchAll(PDO::FETCH_ASSOC);

    $clientStatus = !empty($clientAddon['client_stat'])?$clientAddon['client_stat']:cStat($client['status_id']);
?>

<div class="content-wrapper">
	
<section class="content-header">
	<?php
		Alert();
		
	?>
	<div class="box">
	<div class="box-body">
	<center>
	<h3> Instruction Sheet Preparation (<?php echo $printISType['name']; ?>) <?php //print_r($clientAddon);?></h3>
	</center>
    <a href='instruction_sheet_prep.php'>
	<button type='button' class="btn btn-default"><span class="fa fa-arrow-left"></span> Instruction Sheet Prep. </button></a><br><br>
	<hr>
			<div class="row">
            
                <form action="save_instruction.php" method="post" class="form-horizontal" id='frmclear' >
                <input type='hidden' name='id' id='id' value="<?=$_GET['id'];?>">
                	<div class="form-group">
                        <label for="" class="col-md-3 control-label">Application No.: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="app_no" value="<?php echo (empty($data['app_no'])?'':htmlspecialchars($data['app_no'])) ; ?>" readonly>
                        </div>
                        <label for="" class="col-md-2 control-label">Account No.: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" value="" name="acc_no" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Borrower: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="bor_name" value="<?php echo (empty($bor_name)?'':htmlspecialchars($bor_name)) ; ?>" readonly>
                        </div>
                        <label class="col-md-2 control-label">Client No.: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="client_no" value="<?php echo (empty($client['client_number'])?'':htmlspecialchars($client['client_number'])) ; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Spouse: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="spouse" value="<?php echo (empty($client['spouse'])?'':htmlspecialchars($client['spouse'])) ; ?>" readonly>
                        </div>
                        <label class="col-md-2 control-label">New/Old: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="client_status" value="<?php echo $clientStatus; ; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Address: </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="address" value="<?php echo (empty($client['home_no'])?'':htmlspecialchars($client['home_no'] .(!empty($client['home_brgy'])?', Brgy. '.$client['home_brgy']:''). ", ". $client['home_city'])) ; ?>" readonly>
                        </div>
                        <label class="col-md-1 control-label">Tel. No.: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="pri_con" value="<?php echo (empty($client['pri_con'])?'':htmlspecialchars($client['pri_con'])) ; ?>" readonly>
                        </div>
                    </div>
                        <br>
                    <div class="form-group">
                    <div class="col-md-2"></div>
                        <label for="" class="col-md-2 control-label">Loan Type: <span class="badge badge-pill bg-blue"><?php echo $clientLoan['loan_type_code']; ?></span></label>
                        <label for="" class="col-md-2 control-label">Product Line: <span class="badge badge-pill bg-blue"><?php echo $clientLoan['prod_line_code']; ?></span> </label>
                        <label for="" class="col-md-2 control-label">Credit Facility: <span class="badge badge-pill bg-blue"><?php echo $clientLoan['credit_facility_code']; ?></span></label>
                        <label for="" class="col-md-2 control-label">Marketing Type: <span class="badge badge-pill bg-blue"><?php echo $clientLoan['marketing_type_code']; ?></span></label>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4"></div>
                        <label for="" class="col-md-4 control-label">Business Type: <span class="badge badge-pill bg-blue"><?php echo $clientOtherLoan['bus_code']; ?></span></label>
                        <label for="" class="col-md-2 control-label">Industry Type: <span class="badge badge-pill bg-blue"><?php echo substr($clientOtherLoan['ind_code'],0,2); ?></span></label>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Unit Description </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="unit_desc" value = "<?php echo (!empty($data['unit_desc'])?htmlspecialchars($data['unit_desc']):''); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Tie-up Account: </label>
                        <div class="col-md-3">
                           <select name="tieup_account" id="" class="form-control cbo">
                            <option value="0">Dummy D. Dimagiba</option>
                           </select>
                        </div>
                        <label class="control-label col-md-2">Last Name: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="ta_lname" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">First Name: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="ta_fname" readonly>
                        </div>
                        <label for="" class="control-label col-md-2">Unit Description: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="ta_unit_desc" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Term:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <div class="input-group">
                            <input type="text" class="form-control numeric" name="term" value="<?php echo isEmptyInt($clientAddon['term']); ?>" placeholder ="Term" required>
                            <span class="input-group-addon bg-blue" >months</span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">List Cash Price:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <input type="text" id="lcp" class="form-control ls-type" name="list_cash_price" value="<?php echo isEmptyFloat($clientAddon['list_cash_price']); ?>" placeholder="List Cash Price" >
                        </div>
                        <label for="" class="control-label col-md-2">Add-on Rate:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <div class="input-group">
                            <input type="text" class="form-control ls-type" name="add_on_rate" value="<?php echo isEmptyFloat($clientAddon['addon_rate']); ?>" placeholder="Add-on Rate" required>
                                <span class="input-group-addon bg-blue">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Appraised Value:<span class="text-red">*</span> </label>
                            <div class="col-md-3">
                                <input type="text" id="av" class="form-control ls-type" name="appraised_value" value="<?php echo isEmptyFloat($clientAddon['appraised_value']); ?>" placeholder="Appraised Value">
                            </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6"></div>
                        <label for="" class="control-label col-md-2">Monthly (1st Payment): </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="mon_first" value="<?php echo isFloat($clientAddon['mon_first_payment']);?>" placeholder ="First Payment" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">DP/GD/RV:<span class="text-red">*</span></label>
                        <div class="col-md-3">
                            <input type="text" id="dp_gd" class="form-control ls-type" name="dp_gd_rv" value="<?php echo isEmptyFloat($clientAddon['dp_gd_rv']);?>" placeholder="DP / GD / RV">
                        </div>
                        <label for="" class="control-label col-md-2">(2nd Payment to <span id='term_dynamic'><?php echo (!empty($clientAddon['term'])?htmlspecialchars($clientAddon['term']):''); ?></span>): </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="second_payment" value="<?php echo isFloat($clientAddon['mon_second_payment']);?>" placeholder="Second Payment" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6"></div>
                        <label for="" class="control-label col-md-2">Start Date:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                        <input type="text" class="form-control date_picker" name="start_date" value="<?php echo isEmptyDate($clientAddon['start_date'])?>" placeholder ="Start Date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Amount Financed:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" id="amt_fin" name="amount_financed" value="<?php echo isEmptyFloat($clientAddon['amount_fin']); ?>" placeholder="Amount Financed">
                        </div>
                        <label for="" class="control-label col-md-2">Maturity Date: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control"  name="maturity_date" value="<?php echo isEmptyDate($clientAddon['maturity_date']);?>" placeholder="Maturity Date" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-md-5"></div>
                    <label for="" class="control-label col-md-3">Duedate: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="duedate" value="<?php echo (!empty($clientAddon['due_date'])?htmlspecialchars($clientAddon['due_date']):'')?>" placeholder="Duedate" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">PN Amount: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="pn_amount" value="<?php echo isFloat($clientAddon['amount_pn']);?>" placeholder="PN Amount" readonly>
                        </div>
                        <label for="" class="control-label col-md-2">Value Date</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control " name="value_date" value="<?php echo isEmptyDate($clientAddon['value_date']);?>" placeholder="Value Date" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Rebatable Collection Fee: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="rcf" value="<?php echo isFloat($clientAddon['rcf']);?>" placeholder="Rebatable Collection Fee" readonly>
                        </div>
                        <label for="" class="control-label col-md-2">Rebate (RCF):<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" name="rebate_rcf" value = "<?php echo isEmptyFloat($clientAddon['rebate_rcf']); ?>" placeholder="RCF" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Total Loan Value:  </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="total_loan_value" value="<?php echo isFloat($clientAddon['TLV']);?>" placeholder="Total Loan Value" readonly>
                        </div>
                        <label for="" class="control-label col-md-2">Manner of Payment:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <select name="manner_payment" id="manner_payment" class="form-control cbo" data-allow-clear="true" data-placeholder="Select Manner of Payment" data-selected='<?php echo !empty($clientAddon)?htmlspecialchars($clientAddon['manner_payment']):''; ?>' style="width: 100%;" required>
                                    <?php echo makeOptions($mp); ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                    <label for="" class="control-label col-md-3">PN Amount: </label>
                    <div class="col-md-5"></div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-lock" name="pn_amount_2" value="<?php echo isFloat($clientAddon['amount_pn']);?>" placeholder="PN Amount" readonly>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Less: UDI/ALIR/INT. <span class="text-red">*</span></label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control ls-type" name="less_udi_alir" value="<?php echo isEmptyFloat($clientAddon['less_udi_percent']);?>" placeholder="Less Percent" required>
                                    <span class="input-group-addon bg-blue">%</span>
                                </div>
                            </div>
                         <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="less_total" value="<?php echo isFloat($clientAddon['less_total']);?>" placeholder="Total Less" readonly>
                        </div>
                        </div>
                    <div class="form-group">
                    <div class="col-md-6"></div>
                    <label for="" class="control-label col-md-2">Sub-Total: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="total_above" value="<?php echo isFloat($clientAddon['udi_bal']);?>" placeholder="Sub-total" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-3 text-center">
                            <label for="" class="control-label">Amount</label>
                        </div>
                        <div class="col-md-3 text-center">
                            <label for="" class="control-label">From O.R</label>
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">Mortgage Fee: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" placeholder="Mortgage Fee" name="mort_fee" value="<?php echo isEmptyFloat($clientAddon['mort_fee']);?>">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="mort_total" value="<?php echo isFloat($clientAddon['mort_or']);?>" <?php echo isEmptyFloat($clientAddon['mort_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="mort_total_above" value="<?php echo isFloat($clientAddon['mort_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">Processing Fee: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="proc_fee" value="<?php echo isEmptyFloat($clientAddon['proc_fee']);?>" placeholder="Processing Fee">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="proc_total" value="<?php echo isEmptyFloat($clientAddon['proc_or']);?>" <?php echo isEmptyFloat($clientAddon['proc_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="proc_total_above" value="<?php echo isFloat($clientAddon['proc_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">Appraisal Fee: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="apprais_fee" value="<?php echo isEmptyFloat($clientAddon['apprais_fee']);?>" placeholder="Appraisal Fee"> 
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="apprais_total" value="<?php echo isEmptyFloat($clientAddon['apprais_or']);?>" <?php echo isEmptyFloat($clientAddon['apprais_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="apprais_total_above" value="<?php echo isFloat($clientAddon['apprais_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">Commitment Fee: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="comm_fee" value="<?php echo isEmptyFloat($clientAddon['comm_fee']);?>" placeholder="Commitment Fee">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="comm_total" value="<?php echo isEmptyFloat($clientAddon['comm_or']);?>" <?php echo isEmptyFloat($clientAddon['comm_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="comm_total_above" value="<?php echo isFloat($clientAddon['comm_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">Front-in Fee: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="front_in_fee" value="<?php echo isEmptyFloat($clientAddon['front_fee']);?>" placeholder="Front-in Fee">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="front_in_total" value="<?php echo isEmptyFloat($clientAddon['front_or']);?>" <?php echo isEmptyFloat($clientAddon['front_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="front_in_total_above" value="<?php echo isFloat($clientAddon['front_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="control-label col-md-2">Salesman Commission: </label>
                        <div class="col-md-3">
                             <input type="text" class="form-control ls-type" name="sm_fee" id="sm_fee" value="<?php echo isEmptyFloat($clientAddon['sm_fee']);?>" placeholder="Salesman Fee">
                         </div>
                         <div class="col-md-3">
                            <select class='form-control cbo' name='salesman_id' id='salesman_id'  data-allow-clear='true' data-placeholder="Select Salesman" data-selected='<?php echo !empty($clientAddon)?$clientAddon['salesman_id']:''; ?>' style="width:100%;" disabled>
                                <?php echo makeOptions($sm); ?>
                            </select>
                         </div>
                         <div class="col-md-2"></div>
                         <div class="col-md-3">
                            <input type="text" class="form-control  ls-lock" name="sm_total_above" value="<?php echo isFloat($clientAddon['sm_total']);?>" readonly>
                         </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="control-label col-md-2">Dealer Commission: </label>
                        <div class="col-md-3">
                             <input type="text" class="form-control ls-type" name="dealer_fee" id="dealer_fee" value="<?php echo isEmptyFloat($clientAddon['dealer_fee']);?>" placeholder="Dealer Fee">
                         </div>
                         <div class="col-md-3">                    
                                <select class='form-control cbo' name='dealer_id' id='dealer_id' data-allow-clear='true' data-placeholder="Select Dealer" data-selected='<?php echo !empty($clientAddon)?$clientAddon['dealer_id']:''; ?>' style="width:100%;" disabled>
                                    <?php echo makeOptions($dl); ?>
                                </select>
                                </div>
                         <div class="col-md-2"></div>
                         <div class="col-md-3">
                            <input type="text" class="form-control  ls-lock" name="dealer_total_above" value="<?php echo isFloat($clientAddon['dealer_total']);?>" readonly>
                         </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">Real Estate Fee: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="real_estate_fee" value="<?php  echo isEmptyFloat($clientAddon['real_estate_fee']);?>" placeholder="Real Estate Fee">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="real_estate_total" value="<?php echo isEmptyFloat($clientAddon['real_estate_or']);?>" <?php echo isEmptyFloat($clientAddon['real_estate_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="real_estate_total_above" value="<?php echo isFloat($clientAddon['real_estate_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">Insurance Prem.: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="insur_prem_fee" value="<?php echo isEmptyFloat($clientAddon['insur_prem_fee']);?>" placeholder="Insurance Prem.">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="insur_prem_total" value="<?php echo isEmptyFloat($clientAddon['insur_prem_or']);?>" <?php echo isEmptyFloat($clientAddon['insur_prem_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="insur_prem_total_above" value="<?php echo isFloat($clientAddon['insur_prem_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">Handling Fee: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="handling_fee" value="<?php echo isEmptyFloat($clientAddon['handling_fee']);?>" placeholder="Handling Fee">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="handling_total" value="<?php echo isEmptyFloat($clientAddon['handling_or']);?>" <?php echo isEmptyFloat($clientAddon['handling_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="handling_total_above" value="<?php echo isFloat($clientAddon['handling_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">DPB Fee: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="dpb_fee" value="<?php echo isEmptyFloat($clientAddon['dpb_fee']);?>" placeholder="DPB Fee">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="dpb_total" value="<?php echo isEmptyFloat($clientAddon['dpb_or']);?>" <?php echo isEmptyFloat($clientAddon['dpb_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="dpb_total_above" value="<?php echo isEmptyFloat($clientAddon['dpb_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">Documentary Stamps: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="doc_fee" value="<?php echo isEmptyFloat($clientAddon['doc_fee']);?>" placeholder="Documentary Fee">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="doc_total" value="<?php echo isEmptyFloat($clientAddon['dpb_or']);?>" <?php echo isEmptyFloat($clientAddon['doc_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="doc_total_above" value="<?php echo isFloat($clientAddon['dpb_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">SBGFC Fee: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="sbgfc_fee" value="<?php echo isEmptyFloat($clientAddon['sbgfc_fee']);?>" placeholder="SBGFC Fee">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="sbgfc_total" value="<?php echo isEmptyFloat($clientAddon['sbgfc_or']);?>" <?php echo isEmptyFloat($clientAddon['sbgfc_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="sbgfc_total_above" value="<?php echo isFloat($clientAddon['sbgfc_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">Other Fee 1: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="other_one_fee" value="<?php echo isEmptyFloat($clientAddon['other_one_fee']);?>" placeholder="Other Fee 1">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="other_one_total" value="<?php echo isEmptyFloat($clientAddon['other_one_or']);?>" <?php echo isEmptyFloat($clientAddon['other_one_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="other_one_total_above" value="<?php echo isFloat($clientAddon['other_one_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="" class="control-label col-md-2">Other Fee 2: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="other_two_fee" value="<?php echo isEmptyFloat($clientAddon['other_two_fee']);?>" placeholder="Other Fee 2">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="other_two_total" value="<?php echo isEmptyFloat($clientAddon['other_two_or']);?>" <?php echo isEmptyFloat($clientAddon['other_two_or'])?'':'readonly'; ?>>
                    </div>
                    <div class="col-md-2"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="other_two_total_above" value="<?php echo isFloat($clientAddon['other_two_total']);?>" readonly>
                        </div>
                    </div>
                    
                    <br>
                    <div class="form-group">
                    <div class="col-md-8"></div>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-lock" name="sum_all_fee" value="<?php echo isFloat($clientAddon['amount_deduct']);?>"  readonly>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="col-md-6"></div>
                    <label for="" class="control-label col-md-2">Amount Due: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-lock" name="amount_due" value="<?php echo isFloat($clientAddon['amount_due']); ?>" readonly>
                    </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">O.R Number: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="or_no" value="<?php echo isEmptyInt($clientAddon['or_no']);?>" placeholder="O.R Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">O.R Date: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control date_picker" name="or_date" placeholder="O.R Date" value="<?php echo isEmptyDate($clientAddon['or_date']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">O.R Amount: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" name="or_amount" value="<?php echo isEmptyFloat($clientAddon['or_amount']);?>" placeholder="O.R Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Payee 1: </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="payee_1" value="<?php echo !empty($clientAddon['payee1'])?$clientAddon['payee1']:'';?>" placeholder="Payee Name">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" name="amount_payee_1" value="<?php echo isEmptyFloat($clientAddon['amount_payee1']);?>" placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Payee 2: </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="payee_2" value="<?php echo !empty($clientAddon['payee2'])?$clientAddon['payee2']:'';?>" placeholder="Payee Name">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" name="amount_payee_2" value="<?php echo isEmptyFloat($clientAddon['amount_payee2']);?>" placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Payee 3: </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="payee_3" value="<?php echo !empty($clientAddon['payee3'])?$clientAddon['payee3']:'';?>" placeholder="Payee Name">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" name="amount_payee_3" value="<?php echo isEmptyFloat($clientAddon['amount_payee3']);?>" placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Payee 4: </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="payee_4" value="<?php echo !empty($clientAddon['payee4'])?$clientAddon['payee4']:'';?>" placeholder="Payee Name">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" name="amount_payee_4" value="<?php echo isEmptyFloat($clientAddon['amount_payee4']);?>" placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Payee 5: </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="payee_5" value="<?php echo !empty($clientAddon['payee5'])?$clientAddon['payee5']:'';?>" placeholder="Payee Name">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" name="amount_payee_5" value="<?php echo isEmptyFloat($clientAddon['amount_payee5']);?>" placeholder="Amount">
                        </div>
                    </div>

                  <div class="form-group">
                  <div class="text-center">
                  <?php if($countAddon == 0) : ?>
                  <input type="submit" class="btn btn-primary" id="SaveInstruction" name="submit" value="Save" >
                  <input type="hidden" name="submit" value="true">
                  <?php else : ?>
                  <div class="form-group">
                  <div class="col-md-4"></div>
                    <div class="col-md-2 text-center">
                    <input type="hidden" name="update" value="true">
                    <input type="hidden" name="tbl_id" value="<?php echo $clientAddon['id']; ?>">
                    <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-edit"></i> Update</button>
                    
                    </form>
                    </div>
                    <div class="col-md-2 text-center">
                    <form action="addon_print.php" target="_blank" method="post" class="form-horizontal" >
                    <input type="hidden" name="tbl_id" value="<?php echo $clientAddon['id']; ?>">
                    <button class="btn btn-default" type="submit"><i class="fa fa-print"></i> Print</button>
                    </form>
                    <?php endif; ?>
                    </div>
                  </div>
                  </div>
                  </div>
                
            </div>		
		</div>
	</div>
	</div>
</section>




 
</div>




<script>


$('input[name="start_date"], input[name="term"]').blur(function() {
    var date_start = $('input[name="start_date"]').val(),
        term_val = $('input[name="term"]').val();
        $('span[id="term_dynamic"]').html(term_val);
        
        // console.log(date_start+" "+term_val);
        if(date_start){
            $.ajax({
        url: "ajax/dateAdd.php",
        method: "POST",
        dataType: "json",
        data: {date: date_start, term: term_val},
        success: function(data) {
            // console.log(data);
            const values = data;
                    values.forEach(function(val) {
                        $('input[name="'+val.name+'"]').val(val.value);
                    });
        },error: function(msg) {console.log(msg.responseText);}
    });   
        }
});


$('input[name="term"],input[name="add_on_rate"], input[id="amt_fin"],input[name="rebate_rcf"], input[name="less_udi_alir"], input[name="list_cash_price"],input[name="appraised_value"],input[name="dp_gd_rv"]').change(function() {
     
    var val = $('input[name="add_on_rate"]').val(),
        valRcf = $('input[name="rebate_rcf"]').val(),
        amtFin = $('input[name="amount_financed"]').val(),
        terms = $('input[name="term"]').val(),
        lessPer = $('input[name="less_udi_alir"]').val(),
        lcp = $('#lcp').val(),
        av = $('#av').val(),
        dp= $('#dp_gd').val();

        terms = !isNaN(parseFloat(terms))?terms:1;

        val = val.split(',').join('');
        valRcf = valRcf.split(',').join('');
        amtFin = amtFin.split(',').join('');
        lessPer = lessPer.split(',').join('');
        av = av.split(',').join('');
        dp = dp.split(',').join('');
        lcp = lcp.split(',').join('');
        
        if(!isNaN(parseFloat(lcp)) || !isNaN(parseFloat(av)) || !isNaN(parseFloat(amtFin))|| !isNaN(parseFloat(val)) || !isNan(parseInt(terms))){
            $.ajax({
                url: "ajax/computeAddon.php",
                method: "POST",
                data: {
                    listcp: lcp,
                    appVal: av,
                    downGau: dp,
                    addOn: val,
                    amtFin: amtFin,
                    rcf: valRcf,
                    term: terms,
                    less: lessPer
                    },
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    const values = data;
                    values.forEach(function(val) {
                        $('input[name="'+val.name+'"]').val(val.value);
                    });
                },
                error: function(msg){
                    console.log(msg.responseText);
                }
            });
        }else{
            $(this).val('');
        }
});
</script>

<script>

$(document).ready(function() {

function orAble() {
    $('input[name$="_fee"]').each(function(){
        if($(this).attr('name') != "sum_all_fee"){
            if($(this).val()){
                var next = $(this).attr('name'),
                    next = next.replace('_fee','_total');
                    $('input[name="'+next+'"]').attr('readonly',false);
            }
        }
    });
}
orAble();

function dsFee() {
    $('#sm_fee, #dealer_fee').each(function(){
        if($(this).attr('id') == "sm_fee"){
            if($(this).val()){
                $('#salesman_id').attr('disabled',false).attr('required',true);
            }else{
                $('#salesman_id').attr('disabled',true).attr('required',false);
                $('#salesman_id').val(null).trigger('change');
            }
        }
        if($(this).attr('id') == "dealer_fee"){
            if($(this).val()){
                $('#dealer_id').attr('disabled',false).attr('required',true);
            }else{
                $('#dealer_id').attr('disabled',true).attr('required',false);
                $('#dealer_id').val(null).trigger('change');
            }
        }
        $(this).blur(function() {
        if($(this).attr('id') == "sm_fee"){
            if($(this).val()){
                $('#salesman_id').attr('disabled',false).attr('required',true);
            }else{
                $('#salesman_id').attr('disabled',true).attr('required',false);
                $('#salesman_id').val(null).trigger('change');
            }
        }
        if($(this).attr('id') == "dealer_fee"){
            if($(this).val()){
                $('#dealer_id').attr('disabled',false).attr('required',true);
            }else{
                $('#dealer_id').attr('disabled',true).attr('required',false);
                $('#dealer_id').val(null).trigger('change');
            }
        }
        });
    });
}
dsFee();


    $('#lcp ,#av').focus(function() {
        
    var name = $(this).attr('id'),
        amtFin = $('#amt_fin');
     $(this).keyup(function() {
         var val = $(this).val();
        if(name == "lcp"){
            if(!isNaN(parseFloat(val))){
                $('#av').attr('readonly',true);
                $('#av').val('');
            }else{$('#av').attr('readonly',false); }
        }
        if(name == "av"){
            if(!isNaN(parseFloat(val))){
                $('#lcp').attr('readonly',true);
                $('#lcp').val('');
            }else{$('#lcp').attr('readonly',false);}
        }
     });
});

$('#dp_gd').focus(function() {
    var amtFin = $('#amt_fin');
        $(this).keyup(function() {
            var val = $(this).val();
            if(!isNaN(parseFloat(val))){amtFin.attr('readonly',true);}
            else{amtFin.attr('readonly',false);}
        });
});
disableAF();
function disableAF(){
        var lcp = $('#lcp').val().split(',').join(''),
            av  = $('#av').val().split(',').join(''),
            dpGdRv = $('#dp_gd').val().split(',').join(''),
            amtFin = $('#amt_fin');        
    if(!isNaN(parseFloat(lcp))){
        $('#av').val('');
        $('#av').attr('readonly',true);
        amtFin.attr('readonly',!isNaN(parseFloat(dpGdRv))?true:false);
    }
    if(!isNaN(parseFloat(av))){
        $('#lcp').val('');
        $('#lcp').attr('readonly',true);
        amtFin.attr('readonly',!isNaN(parseFloat(dpGdRv))?true:false);

    }
    
}


$('#frmclear').submit(function(){
    var button = $(this).find('input#SaveInstruction');
    button.attr('disabled','disabled').val('Saving data...');
});
$('.ls-lock').each(function() {
    var val = $(this).val(),
        valName = $(this).attr('name');
    if(!isNaN(parseFloat(val)) && val != "" && val != null){
            lockValue(val,valName);
    }
});
$('.ls-type').each(function() {
    $(this).click(function() {$(this).select();});
        $(this).focus(function() {
            $(this).select();
            var val = $(this).val();
            if(val != "" && !isNaN(parseFloat(val))){
                $(this).val(val.split(',').join(''));
            }else{
                $(this).val('');
            }
        })
        .blur(function() {
            var val = $(this).val(),
            valName = $(this).attr('name');
            if(!isNaN(parseFloat(val)) && val != ""){
                typeValue(val,valName);
            }else{
                $(this).val('');
            }
        });
    });
});

function typeValue(v,n){
    $.ajax({
        url: "ajax/typeConvert.php",
        method: "POST",
        data: {num: v, name:n},
        dataType:"html",
        success: function(data) {
            $('input[name="'+n+'"').val(data);
        },
        error: function(msg) {
            console.log(msg.responseText);
        }
    });
}

function lockValue(v,n) {
    $.ajax({
        url: "ajax/lockConvert.php",
        method: "POST",
        data: {num: v},
        dataType:"html",
        success: function(data) {
            $('input[name="'+n+'"]').val((data)?data:'');      
        },
        error: function(msg) {
            console.log(msg.responseText);
        }
    });
}

$('input[name$="_fee"]').each(function() {
        var name = $(this).attr('name'),
            disTotal = name.replace('fee','total'),
            disTotal = $('input[name="'+disTotal+'"]');
    if(name != "sum_all_fee"){
        
        $(this).change(function() {
            var val = $(this).val(),
                disVal = "";
                computeFee(name, val, disVal);
            if(!isNaN(parseFloat(val.split(',').join('')))){
                disTotal.attr('readonly',false);
                disTotal.change(function(){
                    disVal = $(this).val();
                    computeFee(name, val, disVal);
                    $(this).val((parseFloat(disVal) > parseFloat(val))?'':disVal);
                    });
                }
            else{
                disTotal.val('');
                disTotal.attr('readonly',true);
                }
        });
      
        $(disTotal).change(function() {
            var val = $('input[name="'+name+'"]').val(),
                val = val.split(',').join(''),
                orVal = $(this).val(),
                orVal = orVal.split(',').join('');
                if(!isNaN(parseFloat(orVal))){
                    computeFee(name,val,orVal);
                }
        });

    }
});

function computeFee(name, val, disVal){
     $.ajax({
        url: "ajax/computeFees.php",
        method: "POST",
        dataType:"json",
        data:{name: name, amt: val, amtOr: disVal},
        success: function(data) {
            var sumAll = 0;
            const fee = data;
            fee.forEach(function(fee){
                $('input[name="'+fee.name+'"]').val(fee.value);
            });
            computeAll();
            computeOr();
        },
        error: function(msg){console.log(msg.responseText);}
    });
}

function computeAll(){
    var sumAll = 0,
        subTotal = $('input[name="total_above"]').val(),
        subTotal = parseFloat(subTotal.split(',').join(''));
    $('input[name$="_total_above"]').each(function(){
        var val = $(this).val();
        if(val){
            val = parseFloat(val.split(',').join(''));
            sumAll += val;
        }
    });

    lockValue(sumAll,"sum_all_fee");
    lockValue(subTotal-sumAll,"amount_due");
}

function computeOr(){
    var sumOr = 0;
    $('input[name$="_total"]').each(function() {
        var val = $(this).val(),
            val = val.split(',').join('');
        if(!isNaN(parseFloat(val)) && $(this).attr('name') != "less_total"){
            sumOr += parseFloat(val);
        }

    });
    lockValue(sumOr,"or_amount");

}

</script>




<?php
Modal();
makeFoot(WEBAPP,1);
?>
