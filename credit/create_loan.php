<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Update Loan",1);
    if (empty($_GET['tab'])) {
          
        redirect("ci_checking.php");
    
    } elseif($_GET['tab'] < 1 || $_GET['tab'] > 4) {
        redirect("ci_checking.php");
    }
if(empty($data)){
    redirect("ci_checking.php");
}
?>
	<?php
		Alert();
		
	?>
            <div align='right'>
            <!-- <a href="ci_checking_print.php?id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>" class='btn btn-success'> View &nbsp;<span class='fa fa-search'></span> </a> -->
            <button onclick="printExternal('ci_checking_print.php?id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>')" class='btn btn-default no-print'>Print &nbsp;<span class='fa fa-print'></span></button>  
            </h3>
            </div><br>
                <form action="save_ci_checking.php" method="post" class="form-horizontal" id='frmclear'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                	<?php if(empty($_GET['id'])){?>
                  <div class='form-group'>
                		<label class="col-sm-5 control-label"></label>
                		<div class="col-sm-2">
                          <input type='radio' name='app_type' id='app_type' value="new" checked> New Loan
                      </div>
                      <label class="col-sm-0 control-label"></label>
                		<div class="col-sm-2">
                          <input type='radio' name='app_type' id='app_type' value="renew" > Renew Loan
                      </div>
                	</div>
                  <?php }else{ ?>
                    <div class='form-group'>
                    <label class="col-sm-5 control-label"></label>
                    <div class="col-sm-2">
                          <input type='radio' name='app_type' id='app_type' value="new" <?php if($data['app_type']=='new'){?> checked <?php } ?> > New Loan
                      </div>
                      <label class="col-sm-0 control-label"></label>
                    <div class="col-sm-2">
                          <input type='radio' name='app_type' id='app_type' value="renew" <?php if($data['app_type']=='renew'){?> checked <?php } ?> > Renew Loan
                      </div>
                  </div>
                  <?php } if(empty($_GET['id'])){  ?>
                      <div class='' id='comment_table' style=' word-wrap: break-word;'>
                    </div>
                  <?php } else{?>
                    <div class='form-group'>
					<label class="col-md-3 control-label">Application Number: </label>
					<div class="col-md-3">
						<input type="text" class="form-control numeric" id="app_no" name='app_no' placeholder="Application Number" value='<?php echo !empty($data)?htmlspecialchars($data['app_no']):''; ?>' readonly>
					</div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Client Number: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number" value='<?php echo !empty($data)?htmlspecialchars($data['client_no']):''; ?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Ind / Corp: </label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='ind_corp' id='ind_corp' data-allow-clear='true' data-placeholder="Select Ind / Corp" data-selected='<?php echo !empty($client)?htmlspecialchars($client['ind_corp_id']):''; ?>'>
                                <?php echo makeOptions($ind_corp); ?>
                            </select>
                      </div>
                  </div>
                   <div class='form-group'>
                     <label class="col-md-3 control-label">Last Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="lname" name='lname' placeholder="Last Name" value='<?php echo !empty($client)?htmlspecialchars($client['lname']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">First Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="fname" name='fname' placeholder="First Name" value='<?php echo !empty($client)?htmlspecialchars($client['fname']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-md-3 control-label">Middle Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="mname" name='mname' placeholder="Middle Name" value='<?php echo !empty($client)?htmlspecialchars($client['mname']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Birthdate: </label>
                      <div class="col-sm-3">
                          <input type="text"  value='<?php echo !empty($client)?htmlspecialchars($client['birthdate']):''; ?>' class="form-control date_picker" id="birth_date" name='birth_date' >
                      </div>
                      <label class="col-sm-2 control-label">Gender: </label>
                      <div class="col-sm-3">
                      <select name='gender' class='form-control cbo' >
                        <option value='' disabled <?php echo empty($client)?'selected="selected"':''; ?>>Select Gender</option>
                        <option value='Male' <?php echo !empty($client) && $client['gender']=='Male'?'selected="selected"':''; ?>>Male</option>
                        <option value='Female' <?php echo !empty($client) && $client['gender']=='Female'?'selected="selected"':''; ?>>Female</option>
                    </select>
                    </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-md-3 control-label">Civil Status: </label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='civil_status' id='civil_status' data-allow-clear='true' data-placeholder="Select Civil Status" data-selected='<?php echo !empty($client)?htmlspecialchars($client['civil_status_id']):''; ?>' >
                        <?php echo makeOptions($cv); ?>
                        </select>
                      </div>
                      <label class="col-md-2 control-label">Spouse: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse" name='spouse' placeholder="Spouse" value='<?php echo !empty($client)?htmlspecialchars($client['spouse']):''; ?>' >
                      </div>
                  </div>
                  <hr>
                  <div class='form-group'>
                        <label class="col-sm-3 control-label">Dealer: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='dealer' id='dealer' data-allow-clear='true' data-placeholder="Select Dealer" data-selected='<?php echo !empty($data)?htmlspecialchars($data['dealer_id']):''; ?>' >
                                <?php echo makeOptions($dl); ?>
                            </select>
                        </div>
                      <label class="col-sm-2 control-label">Salesman: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='salesman' id='salesman'  data-allow-clear='true' data-placeholder="Select Salesman" data-selected='<?php echo !empty($data)?htmlspecialchars($data['salesman_id']):''; ?>' disabled>
                                <?php echo makeOptions($sm); ?>
                            </select>
                        </div>
                    </div>
                   <div class='form-group'>
                        <label class="col-sm-3 control-label">Loan Type: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='loan_type' id='loan_type' data-allow-clear='true' data-placeholder="Select Loan Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['loan_type_id']):''; ?>' >
                                <?php echo makeOptions($lt); ?>
                            </select>
                        </div>
	                    <label class="col-sm-2 control-label">Credit Facility: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='cre_fac' id='cre_fac' data-allow-clear='true' data-placeholder="Select Credit Facility" data-selected='<?php echo !empty($data)?htmlspecialchars($data['credit_fac_id']):''; ?>' >
                                <?php echo makeOptions($cf); ?>
                            </select>
                        </div>
                    </div>
	                   <div class='form-group'>
                        <label class="col-sm-3 control-label">Product Line: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='pro_line' id='pro_line' data-allow-clear='true' data-placeholder="Select Product Line" data-selected='<?php echo !empty($data)?htmlspecialchars($data['prod_line_id']):''; ?>' >
                                <?php echo makeOptions($pl); ?>
                            </select>
                        </div>
	                    <label class="col-sm-2 control-label">Marketing Type: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='mar_type' id='mar_type' data-allow-clear='true' data-placeholder="Select Marketing Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['mark_type_id']):''; ?>' >
                                <?php echo makeOptions($mt); ?>
                            </select>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Collateral Code: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='col_code' id='col_code' data-allow-clear='true' data-placeholder="Select Collateral Code" data-selected='<?php echo !empty($data)?htmlspecialchars($data['coll_code_id']):''; ?>'>
                                <?php echo makeOptions($cc); ?>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">Unit Description: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="unit_desc" name='unit_desc' placeholder="Unit Description" value='<?php echo !empty($data)?htmlspecialchars($data['unit_desc']):''; ?>' >
                      </div>
                    </div>
                    <hr>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Amount Financed: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="amt_fin" name='amt_fin' placeholder="Amount Financed" value='<?php echo !empty($data)?htmlspecialchars($data['amt_fin']):''; ?>' >
                        </div>
                        <label class="col-md-2 control-label">Residual Value: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="res_val" name='res_val' placeholder="Residual Value" value='<?php echo !empty($data)?htmlspecialchars($data['res_val']):''; ?>' >
                      </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Down Payment: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="down_pay" name='down_pay' placeholder="Down Payment" value='<?php echo !empty($data)?htmlspecialchars($data['down_pay']):''; ?>' >
                        </div>
                        <label class="col-md-2 control-label">List Price: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="list_pri" name='list_pri' placeholder="List Price" value='<?php echo !empty($data)?htmlspecialchars($data['list_pri']):''; ?>' >
                      </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Term: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="term" name='term' placeholder="Term" value='<?php echo !empty($data)?htmlspecialchars($data['term']):''; ?>' >
                        </div>
                        <label class="col-md-2 control-label">Interest Rate: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="int_rate" name='int_rate' placeholder="Interest Rate" value='<?php echo !empty($data)?htmlspecialchars($data['int_rate']):''; ?>' >
                      </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Monthly Amortization: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="mon_amor" name='mon_amor' placeholder="Monthly Amortization" value='<?php echo !empty($data)?htmlspecialchars($data['mon_amor']):''; ?>' >
                        </div>
                    </div>
                    <hr>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">TIN: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control tin" id="tin" placeholder="Taxpayer Identification Number" name='tin' value='<?php echo !empty($client)?htmlspecialchars($client['tin_no']):''; ?>' >
                        </div>
	                    <label class="col-sm-2 control-label">SSS Number: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control sss" id="sss_no" placeholder="SSS Number" name='sss_no' value='<?php echo !empty($client)?htmlspecialchars($client['sss_no']):''; ?>' >
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">ACR Number: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control numeric" id="acr_no" placeholder="ACR Number" name='acr_no' value='<?php echo !empty($client)?htmlspecialchars($client['acr_no']):''; ?>' >
                        </div>
	                    <label class="col-sm-2 control-label">Pag-IBIG: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control pagibig" id="pag_ibig" placeholder="Pag-IBIG Number" name='pag_ibig' value='<?php echo !empty($client)?htmlspecialchars($client['pagibig_no']):''; ?>' >
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">ResCert: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control numeric" id="rc_no" placeholder="Residence Certificate Number" name='rc_no' value='<?php echo !empty($client)?htmlspecialchars($client['rescert_no']):''; ?>' >
                        </div>
	                    <label class="col-sm-2 control-label">ResCert Date: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control date_picker"  value='<?php echo !empty($client)?htmlspecialchars($client['rescert_date']):''; ?>' id="rescert_date" name='rc_date' >
                        </div>
                    </div>
                    <div class='form-group'>
                      <label class="col-md-3 control-label">ResCert Place: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="rc_place" name='rc_place' placeholder="Residence Certificate Place" value='<?php echo !empty($client)?htmlspecialchars($client['rescert_place']):''; ?>' >
                      </div>
                  </div>
                    <hr>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Business Type: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='bus_type' id='bus_type' data-allow-clear='true' data-placeholder="Select Business Type" data-selected='<?php echo !empty($client)?htmlspecialchars($client['bus_type_id']):''; ?>' >
                                <?php echo makeOptions($bt); ?>
                            </select>
                        </div>
	                    <label class="col-sm-2 control-label">Country: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='country' id='country' data-allow-clear='true' data-placeholder="Select Country" data-selected='<?php echo !empty($client)?htmlspecialchars($client['country_id']):''; ?>' >
                                <?php echo makeOptions($country); ?>
                            </select>
                        </div>
                    </div>
	                   <div class='form-group'>
                        <label class="col-sm-3 control-label">Industry Code: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='ind_code' id='ind_code' data-allow-clear='true' data-placeholder="Select Industry Code" data-selected='<?php echo !empty($client)?htmlspecialchars($client['ind_code_id']):''; ?>' >
                                <?php echo makeOptions($ind_code); ?>
                            </select>
                        </div>
	                    <label class="col-sm-2 control-label">Region: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='region' id='region' data-allow-clear='true' data-placeholder="Select Region" data-selected='<?php echo !empty($client)?htmlspecialchars($client['region_id']):''; ?>' >
                                <?php echo makeOptions($reg); ?>
                            </select>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Client Type: *</label>
                        </div>
                        <div class='form-group'>
                        <label class="col-sm-3 control-label"> </label>
                        <div class='col-sm-9'>
                        <input type='checkbox' name='is_borrower' id='is_borrower' <?php echo !empty($client)?htmlspecialchars($client['is_borrower']):''; ?>><font size='3'> Borrower</font><?php echo str_repeat('&nbsp;',40);?>
                        <input type='checkbox' name='is_dealer' id='is_dealer' <?php echo !empty($client)?htmlspecialchars($client['is_dealer']):''; ?>><font size='3'> Dealer</font><?php echo str_repeat('&nbsp;',40);?>
                        <input type='checkbox' name='is_salesman' id='is_salesman' <?php echo !empty($client)?htmlspecialchars($client['is_salesman']):''; ?>><font size='3'> Salesman</font>
                        </div>
                    </div>
                    <hr>
                    <center><b>Contact Person</b></center><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="con_name" name='con_name' placeholder="Name of Contact Person" value='<?php echo !empty($client)?htmlspecialchars($client['con_name']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">ResCert: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="con_rc_no" name='con_rc_no' placeholder="Contact Person ResCert Number" value='<?php echo !empty($client)?htmlspecialchars($client['con_rescert_no']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">ResCert Date: </label>
                      <div class="col-md-3">
                      <input type="text" class="form-control date_picker" value='<?php echo !empty($client)?htmlspecialchars($client['con_rescert_date']):''; ?>' id="con_rc_date" name='con_rc_date' >
                      </div>
                      <label class="col-md-2 control-label">ResCert Place: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="con_rc_place" name='con_rc_place' placeholder="Contact Person ResCert Place" value='<?php echo !empty($client)?htmlspecialchars($client['con_rescert_place']):''; ?>'>
                      </div>
                  </div>
                    <hr>
                    <center><b>Home Address</b></center><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_no" name='home_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($client)?htmlspecialchars($client['home_no']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_brgy" name='home_brgy' placeholder="Barangay" value='<?php echo !empty($client)?htmlspecialchars($client['home_brgy']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_city" name='home_city' placeholder="City" value='<?php echo !empty($client)?htmlspecialchars($client['home_city']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="home_zip" name='home_zip' placeholder="Zip Code" value='<?php echo !empty($client)?htmlspecialchars($client['home_zip']):''; ?>'>
                      </div>
                  </div>
                  <center><b>Business Address</b><br><br>
                  <input type='checkbox' name='same_add' id='same_add' <?php echo !empty($client)?htmlspecialchars($client['same_add']):''; ?>><i> Check if Business Address is the same as Home Address</i></center>
                  <div id="autoUpdate" class="autoUpdate"><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_no" name='bus_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($client)?htmlspecialchars($client['bus_no']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_brgy" name='bus_brgy' placeholder="Barangay" value='<?php echo !empty($client)?htmlspecialchars($client['bus_brgy']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_city" name='bus_city' placeholder="City" value='<?php echo !empty($client)?htmlspecialchars($client['bus_city']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numberic" id="bus_zip" name='bus_zip' placeholder="Zip Code" value='<?php echo !empty($client)?htmlspecialchars($client['bus_zip']):''; ?>' >
                      </div>
                  </div>
                  </div><br>
                  <center><b>Garage Address</b><br><br>
                  <input type='checkbox' name='same_add1' id='same_add1' <?php echo !empty($client)?htmlspecialchars($client['same_add1']):''; ?>><i> Check if Business Address is the same as Home Address</i></center>
                  <div id="autoUpdate1" class="autoUpdate"><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_no" name='gar_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($client)?htmlspecialchars($client['gar_no']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_brgy" name='gar_brgy' placeholder="Barangay" value='<?php echo !empty($client)?htmlspecialchars($client['gar_brgy']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_city" name='gar_city' placeholder="City" value='<?php echo !empty($client)?htmlspecialchars($client['gar_city']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numberic" id="gar_zip" name='gar_zip' placeholder="Zip Code" value='<?php echo !empty($client)?htmlspecialchars($client['gar_zip']):''; ?>'>
                      </div>
                  </div>
                  </div>
                  <hr>
				     <div class="form-group">
				      <label for="email" class="col-sm-3 control-label">Email Address: </label>
				      <div class="col-sm-3">
				        <input type="email" class="form-control" id="email" placeholder="Email Address" name='email' value='<?php echo !empty($client)?htmlspecialchars($client['email']):''; ?>' >
				      </div>
                      <label class="col-sm-2 control-label">FAX No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="fax_no" placeholder="FAX Number" name='fax_no' value='<?php echo !empty($client)?htmlspecialchars($client['home_tel']):''; ?>' >
                        </div>
				    </div>
				      <div class='form-group'>
                        <label class="col-sm-3 control-label">Business Tel. No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control tel" id="bus_tel" placeholder="Business Telephone Number" name='bus_tel' value='<?php echo !empty($client)?htmlspecialchars($client['bus_tel']):''; ?>' >
                        </div>
	                    <label class="col-sm-2 control-label">Home Tel. No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control tel" id="home_tel" placeholder="Home Telephone Number" name='home_tel' value='<?php echo !empty($client)?htmlspecialchars($client['home_tel']):''; ?>' >
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Primary Contact No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control" id="pri_con" placeholder="Primary Contact Number" name='pri_con' value='<?php echo !empty($client)?htmlspecialchars($client['pri_con']):''; ?>' >
                        </div>
	                    <label class="col-sm-2 control-label">Secondary Contact No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="sec_con" placeholder="Secondary Contact Number" name='sec_con' value='<?php echo !empty($client)?htmlspecialchars($client['sec_con']):''; ?>'>
                        </div>
                    </div><br>
                    <?php }?>
                         <div class="form-group">
					      <div class="col-sm-11 col-md-offset-1 text-center">
					      	<button type='submit' class='btn btn-primary'>Save </button>
					      	<a href='ci_checking.php' class='btn btn-default'>Cancel</a>
					      </div>
					    </div>
                </form>



<script type="text/javascript">

	function redirect(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/journal_entry.php?id=" + id;
		window.location=string;
	};
	
	function archive(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/php/archive.php?id=" + id;
		window.location=string;
	}
	
	function edit(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/create_loan.php?id=" + id;
		window.location=string;
	}
	    function filter_search()
    {
            dttable.ajax.reload();
            //console.log(dttable);
    }
    $("#client_no").change(function(){
        $("#comment_table").html("<span class='fa fa-refresh fa-pulse'></span>")
            $("#comment_table").load("../marketing/ajax/autofill_form.php?id="+$("#client_no").val());
    });
    $("#lname").change(function(){
        $("#comment_table").html("<span class='fa fa-refresh fa-pulse'></span>")
            $("#comment_table").load("../marketing/ajax/autofill_form.php?id="+$("#client_no").val());
    });
    $(document).ready(function() {
        $("#comment_table").load("../marketing/ajax/autofill_form.php?");
    });
//     if ($("#same_add").is(':checked')){
//     $("#autoUpdate").hide();
//     $('#bus_no').prop('required',false);
//     $('#bus_brgy').prop('required',false);
//     $('#bus_city').prop('required',false);
//     $('#bus_zip').prop('required',false);
// }
    // $('#same_add').change(function(){
    //     if (this.checked) {
    //         $('#autoUpdate').hide();
    //         $('#bus_no').prop('required',false);
    //         $('#bus_brgy').prop('required',false);
    //         $('#bus_city').prop('required',false);
    //         $('#bus_zip').prop('required',false);
    //     }
    //     else {
    //         $('#autoUpdate').show();
    //         $('#bus_no').prop('required',true);
    //         $('#bus_brgy').prop('required',true);
    //         $('#bus_city').prop('required',true);
    //         $('#bus_zip').prop('required',true);
    //     }                   
    // });

//     if ($("#same_add1").is(':checked')){
//     $("#autoUpdate1").hide();
//     $('#gar_no').prop('required',false);
//     $('#gar_brgy').prop('required',false);
//     $('#gar_city').prop('required',false);
//     $('#gar_zip').prop('required',false);
// }
//     $('#same_add1').change(function(){
//         if (this.checked) {
//             $('#autoUpdate1').hide();
//             $('#gar_no').prop('required',false);
//             $('#gar_brgy').prop('required',false);
//             $('#gar_city').prop('required',false);
//             $('#gar_zip').prop('required',false);
//         }
//         else {
//             $('#autoUpdate1').show();
//             $('#gar_no').prop('required',true);
//             $('#gar_brgy').prop('required',true);
//             $('#gar_city').prop('required',true);
//             $('#gar_zip').prop('required',true);
//         }                   
//     });
    $("#dealer").on('change',function(){
        if(document.getElementById("dealer").selectedIndex > 0){
            $("#salesman").attr('disabled',false);
        }else{
            $("#salesman").attr('disabled',true);
        }
    });

    $("#civil_status").on('change',function(){
        if(document.getElementById("civil_status").selectedIndex > 1){
            $("#spouse").attr('disabled',false);
            $("#spouse").attr('required',true);
        }else{
            $("#spouse").attr('disabled',true);
            document.getElementById("spouse").value="";
            $("#spouse").attr('required',false);
        }
    });

      function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
        printWindow.close();
    }, true);
}
</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>
