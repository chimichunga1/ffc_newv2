<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Instruction Sheet Preparation",1);
    if (empty($_GET['tab'])) {
        redirect("instruction_sheet_prep.php");
    } elseif($_GET['tab'] < 1 || $_GET['tab'] > 2) {
        redirect("instruction_sheet_prep.php");
    }
if(empty($data)){
    redirect("instruction_sheet_prep.php");
}
?>
<form action="save_instruction_td.php" method="post" class="form-horizontal" id='frmclear' >
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
                            <input type="text" class="form-control" name="client_status" value="<?php echo $clientStatus; ?>" readonly>
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
                        <label for="" class="col-md-2 control-label">Loan Type: <span class="badge badge-pill bg-green"><?php echo $clientLoan['loan_type_code']; ?></span></label>
                        <label for="" class="col-md-2 control-label">Product Line: <span class="badge badge-pill bg-green"><?php echo $clientLoan['prod_line_code']; ?></span> </label>
                        <label for="" class="col-md-2 control-label">Credit Facility: <span class="badge badge-pill bg-green"><?php echo $clientLoan['credit_facility_code']; ?></span></label>
                        <label for="" class="col-md-2 control-label">Marketing Type: <span class="badge badge-pill bg-green"><?php echo $clientLoan['marketing_type_code']; ?></span></label>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4"></div>
                        <label for="" class="col-md-4 control-label">Business Type: <span class="badge badge-pill bg-green"><?php echo $clientOtherLoan['bus_code']; ?></span></label>
                        <label for="" class="col-md-2 control-label">Industry Type: <span class="badge badge-pill bg-green"><?php echo substr($clientOtherLoan['ind_code'],0,2); ?></span></label>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Unit Description </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="unit_desc" value = "<?php echo (!empty($data['unit_desc'])?htmlspecialchars($data['unit_desc']):''); ?>" placeholder="Unit Description">
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
                        <label for="" class="control-label col-md-3">Amount of Line:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" name="amount_line" value="<?php echo isEmptyFloat($clientAddon['amount_line']); ?>" placeholder="Amount of Line" required>
                        </div>
                        <label for="" class="control-label col-md-2">Available Balance:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" name="avail_bal" value="<?php echo isEmptyFloat($clientAddon['avail_bal']); ?>" placeholder="Available Balance" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Outstanding Avail:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" name="outstanding_avail" value="<?php echo isEmptyFloat($clientAddon['outstanding_avail']); ?>" placeholder="Outstanding Avail" required>
                        </div>
                        <label for="" class="control-label col-md-2">Proposed Availment:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-type" name="prop_avail" value="<?php echo isEmptyFloat($clientAddon['prop_avail']); ?>" placeholder="Proposed Avail" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Date Approved:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                        <input type="text" class="form-control date_picker" name="date_approved" value="<?php echo isEmptyDate($clientAddon['date_approved']); ?>" placeholder="Date Appproved" required>
                        </div>                        
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Term: </label>
                        <div class="col-md-3">
                            <div class="input-group">
                            <input type="text" class="form-control numeric" name="term" value="<?php echo isEmptyInt($clientAddon['term']); ?>" placeholder="Term" readonly>
                            <span class="input-group-addon bg-green" >days</span>
                            </div>
                        </div>
                        <label for="" class="control-label col-md-2">Maximum Term: </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control numeric" name="max_term" value="<?php echo isEmptyInt($clientAddon['max_term']);?>" placeholder="Maximum Term" readonly>
                                <span class="input-group-addon bg-green">days</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="" class="control-label col-md-3">Interest Rate:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <div class="input-group">
                            <input type="text" class="form-control ls-type" name="int_rate" value="<?php echo isEmptyFloat($clientAddon['int_rate']); ?>" placeholder="Interest Rate" required>
                            <span class="input-group-addon bg-green">%</span>
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="col-md-6"></div>
                        <label for="" class="control-label col-md-2">Start Date:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                        <input type="text" class="form-control date_picker" id="start_date" name="start_date" value="<?php echo isEmptyDate($clientAddon['start_date']);?>" placeholder="Start Date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6"></div>
                        <label for="" class="control-label col-md-2">Maturity Date: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control"  name="maturity_date" value="<?php echo isEmptyDate($clientAddon['maturity_date']);?>" placeholder="Maturity Date" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">PN Amount: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control " placeholder="PN Amount" name="pn_amount" value="<?php echo isEmptyFloat($clientAddon['amount_pn']);?>" readonly>
                        </div>
                        <label for="" class="control-label col-md-2">Value Date</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control " name="value_date" value="<?php echo isEmptyDate($clientAddon['value_date']);?>" placeholder="Value Date" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Discount: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control " name="discount" value="<?php echo isEmptyFloat($clientAddon['discount']);?>" placeholder="Discount" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Net Proceeds:  </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control "  name="net_proceeds" value="<?php echo isEmptyFloat($clientAddon['net_proceeds']);?>" placeholder="Net Proceeds" readonly>
                        </div>
                        <label for="" class="control-label col-md-2">Manner of Payment:<span class="text-red">*</span> </label>
                        <div class="col-md-3">
                            <select name="manner_payment" id="manner_payment" class="form-control cbo" data-allow-clear="true" data-placeholder="Select Manner of Payment" data-selected='<?php echo !empty($clientAddon)?htmlspecialchars($clientAddon['manner_payment']):''; ?>' required>
                                    <?php echo makeOptions($mp); ?>
                            </select>
                        </div>
                    </div>
                    <hr>
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
                        <input type="text" class="form-control ls-type" name="mort_total" value="<?php echo isEmptyFloat($clientAddon['mort_or']);?>" <?php echo isEmptyFloat($clientAddon['mort_or'])?'':'readonly'; ?>>
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
                  <input type="submit" class="btn btn-success" id="SaveInstruction" name="submit" value="Save" >
                  <input type="hidden" name="submit" value="true">
                  <?php else : ?>
                  <div class="form-group">
                  <div class="col-md-4"></div>
                    <div class="col-md-2 text-center">
                    <input type="hidden" name="update" value="true">
                    <input type="hidden" name="tbl_id" value="<?php echo $clientAddon['id']; ?>">
                    <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-edit"></i> Update</button>
                    
                    </form>
                    </div>
                    <div class="col-md-2 text-center">
                    <form action="td_print.php" target="_blank" method="post" class="form-horizontal" >
                    <input type="hidden" name="tbl_id" value="<?php echo $clientAddon['id']; ?>">
                    <button class="btn btn-default" type="submit"><i class="fa fa-print"></i> Print</button>
                    </form>
                    <?php endif; ?>
                    </div>
                  </div>