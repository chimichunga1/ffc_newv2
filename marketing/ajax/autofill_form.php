<?php
require_once("../../support/config.php");
//$con->myQuery("SELECT FROM comments c WHERE ");
$empty_message="No data available in table.";

$lt=$con->myQuery("SELECT lt.id,CONCAT(lt.code,' - ',lt.name) as lt_code FROM loan_approval_type lt WHERE lt.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
$cf=$con->myQuery("SELECT cf.id,CONCAT(cf.code,' - ',cf.name) as cf_code FROM credit_facility cf WHERE cf.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
$pl=$con->myQuery("SELECT pl.id,CONCAT(pl.code,' - ',pl.name) as pl_code FROM product_line pl WHERE pl.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
$mt=$con->myQuery("SELECT mt.id,CONCAT(mt.code,' - ',mt.name) as mt_code FROM marketing_type mt WHERE mt.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
$cc=$con->myQuery("SELECT cc.id,CONCAT(cc.code,' - ',cc.desc) as cc_code FROM collateral_code cc WHERE cc.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
$lname1=$con->myQuery("SELECT lname,CONCAT(lname,', ',fname,' ',mname) FROM client_list WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
$dl=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_dealer='checked'")->fetchAll(PDO::FETCH_ASSOC);
$sm=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_salesman='checked'")->fetchAll(PDO::FETCH_ASSOC);
$bt=$con->myQuery("SELECT id,name FROM business_type WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
$co=$con->myQuery("SELECT id,name FROM country WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
$ic=$con->myQuery("SELECT id,name FROM industry_code WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
$re=$con->myQuery("SELECT id,name FROM region WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
$cv=$con->myQuery("SELECT id,name FROM civil_status WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
// $a = substr($_GET['id'], 0, 1);
// if ($a == "o")
// {
//  $_GET['request_type'] = "overtime";
//  $_GET['id'] = ltrim($_GET['id'],'o');
// }
// if ($a == "p")
// {
//  $_GET['request_type'] = "pre_overtime";
//  $_GET['id'] = ltrim($_GET['id'],'p');
// }
if((!empty($_GET['id']))OR(!empty($_GET['lname']))){

    if(!empty($_GET['id'])){
    $messages=$con->myQuery("SELECT *
        FROM client_list
         WHERE client_number=?",array($_GET['id']))->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $messages=$con->myQuery("SELECT *
        FROM client_list
         WHERE lname=?",array($_GET['lname']))->fetchAll(PDO::FETCH_ASSOC);
    }
    //echo $_GET['request_type']."<br>".$_GET['id'];
    // var_dump($messages);
    // die();

    if(empty($messages)){ ?>
              <div class='form-group'>
          <label class="col-md-3 control-label">Application Number: </label>
          <div class="col-md-3">
            <input type="text" class="form-control numeric" id="app_no" name='app_no' placeholder="Application Number" value='<?php echo !empty($data)?htmlspecialchars($data['id']):''; ?>' readonly>
          </div>
          <label class="col-md-2 control-label">Client Status* : </label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='cli_stat' id='cli_stat' data-placeholder="Select Client Status" data-selected='<?php echo !empty($client)?htmlspecialchars($client['client_stat']):''; ?>' required>
                                <option value='0'>New</option>
                                <option value='1'>Old</option>
                            </select>
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-3 control-label">Client Number: </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number" value='<?php echo !empty($data)?htmlspecialchars($data['client_no']):''; ?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Ind / Corp: </label>
                      <div class="col-md-3">
                            <input type="text" class="form-control numeric" id="ind_corp" name='ind_corp' placeholder="Individual / Corporation" value='<?php echo !empty($client)?htmlspecialchars($client['ind_corp_id']):''; ?>' required>
                      </div>
                  </div>
                   <div class='form-group'>
                      <label class="col-md-3 control-label">First Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="fname" name='fname' placeholder="First Name" value='<?php echo !empty($client)?htmlspecialchars($client['fname']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Middle Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="mname" name='mname' placeholder="Middle Name" value='<?php echo !empty($client)?htmlspecialchars($client['mname']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-3 control-label">Last Name: </label>
                      <div class="col-md-3">
                        <div id='dlname'>
                        <select class='form-control cbo' name='lname' id='lname' data-placeholder="Select Last Name" data-selected='<?php echo !empty($data)?htmlspecialchars($data['lname']):''; ?>' required>
                                    <?php echo makeOptions($lname1); ?>
                                </select>
                                </div>
                        <div id='dlname1' style='display: none'>
                        <input type="text" class="form-control" id="lname" name='lname' placeholder="Last Name" value='<?php echo !empty($data)?htmlspecialchars($data['lname']):''; ?>'>
                                </div>
                        </div>
                      <label class="col-md-2 control-label">Extension Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="ename" name='ename' placeholder="Extension Name" value='<?php echo !empty($data)?htmlspecialchars($data['ename']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Birthdate: *</label>
                      <div class="col-sm-3">
                          <input type="text"  value='<?php echo !empty($clinet)?htmlspecialchars($client['birthdate']):''; ?>' class="form-control date_picker" id="birth_date" name='birth_date' required>
                      </div>
                      <label class="col-sm-2 control-label">Gender: *</label>
                      <div class="col-sm-3">
                      <select name='gender' class='form-control cbo'  required>
                        <option value='' disabled <?php echo empty($client)?'selected="selected"':''; ?>>Select Gender</option>
                        <option value='Male' <?php echo !empty($client) && $client['gender']=='Male'?'selected="selected"':''; ?>>Male</option>
                        <option value='Female' <?php echo !empty($client) && $client['gender']=='Female'?'selected="selected"':''; ?>>Female</option>
                    </select>
                    </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-md-3 control-label">Civil Status: *</label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='civil_status' id='civil_status' data-allow-clear='true' data-placeholder="Select Civil Status" data-selected='<?php echo !empty($data)?htmlspecialchars($data['civil_status_id']):''; ?>' required>
                        <?php echo makeOptions($cv); ?>
                        </select>
                      </div>
                      <label class="col-md-2 control-label">Spouse: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse" name='spouse' placeholder="Spouse" value='<?php echo !empty($data)?htmlspecialchars($data['spouse']):''; ?>' >
                      </div>
                  </div>
                  </div>
                  <hr>
                  <div class='form-group'>
                        <label class="col-sm-3 control-label">Dealer: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='dealer' id='dealer' data-allow-clear='true' data-placeholder="Select Dealer" data-selected='<?php echo !empty($data)?htmlspecialchars($data['dealer_id']):''; ?>'>
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
                            <select class='form-control cbo' name='loan_type' id='loan_type' data-placeholder="Select Loan Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['loan_type_id']):''; ?>' required>
                                <?php echo makeOptions($lt); ?>
                            </select>
                        </div>
                      <label class="col-sm-2 control-label">Credit Facility: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='cre_fac' id='cre_fac' data-placeholder="Select Credit Facility" data-selected='<?php echo !empty($data)?htmlspecialchars($data['credit_fac_id']):''; ?>' required>
                                <?php echo makeOptions($cf); ?>
                            </select>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Product Line: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='pro_line' id='pro_line' data-placeholder="Select Product Line" data-selected='<?php echo !empty($data)?htmlspecialchars($data['prod_line_id']):''; ?>' required>
                                <?php echo makeOptions($pl); ?>
                            </select>
                        </div>
                      <label class="col-sm-2 control-label">Marketing Type: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='mar_type' id='mar_type' data-placeholder="Select Marketing Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['mark_type_id']):''; ?>' required>
                                <?php echo makeOptions($mt); ?>
                            </select>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Collateral Code: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='col_code' id='col_code' data-placeholder="Select Collateral Code" data-selected='<?php echo !empty($data)?htmlspecialchars($data['coll_code_id']):''; ?>' required="">
                                <?php echo makeOptions($cc); ?>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">Unit Description: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="unit_desc" name='unit_desc' placeholder="Unit Description" value='<?php echo !empty($data)?htmlspecialchars($data['unit_desc']):''; ?>' required>
                      </div>
                    </div>
                    <hr>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Amount Financed: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="amt_fin" name='amt_fin' placeholder="Amount Financed" value='<?php echo !empty($data)?htmlspecialchars($data['amt_fin']):''; ?>' required>
                        </div>
                        <label class="col-md-2 control-label">Residual Value: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="res_val" name='res_val' placeholder="Residual Value" value='<?php echo !empty($data)?htmlspecialchars($data['res_val']):''; ?>' required>
                      </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Down Payment: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="down_pay" name='down_pay' placeholder="Down Payment" value='<?php echo !empty($data)?htmlspecialchars($data['down_pay']):''; ?>' required>
                        </div>
                        <label class="col-md-2 control-label">List Price: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="list_pri" name='list_pri' placeholder="List Price" value='<?php echo !empty($data)?htmlspecialchars($data['list_pri']):''; ?>' required>
                      </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Term: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="term" name='term' placeholder="Term" value='<?php echo !empty($data)?htmlspecialchars($data['term']):''; ?>' required>
                        </div>
                        <label class="col-md-2 control-label">Interest Rate: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="int_rate" name='int_rate' placeholder="Interest Rate" value='<?php echo !empty($data)?htmlspecialchars($data['int_rate']):''; ?>' required>
                      </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Monthly Amortization: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="mon_amor" name='mon_amor' placeholder="Monthly Amortization" value='<?php echo !empty($data)?htmlspecialchars($data['mon_amor']):''; ?>' required>
                        </div>
                    </div>
                    <hr>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">TIN: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control numeric" id="tin" placeholder="Taxpayer Identification Number" name='tin' value='<?php echo !empty($client)?htmlspecialchars($client['tin_no']):''; ?>' >
                        </div>
                      <label class="col-sm-2 control-label">SSS Number: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control numeric" id="sss_no" placeholder="SSS Number" name='sss_no' value='<?php echo !empty($client)?htmlspecialchars($client['sss_no']):''; ?>' >
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">ACR Number: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control numeric" id="acr_no" placeholder="ACR Number" name='acr_no' value='<?php echo !empty($client)?htmlspecialchars($client['acr_no']):''; ?>' >
                        </div>
                      <label class="col-sm-2 control-label">Pag-IBIG: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control numeric" id="pag_ibig" placeholder="Pag-IBIG Number" name='pag_ibig' value='<?php echo !empty($client)?htmlspecialchars($client['pagibig_no']):''; ?>' >
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">ResCert: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control numeric" id="rc_no" placeholder="Residence Certificate Number" name='rc_no' value='<?php echo !empty($client)?htmlspecialchars($client['rescert_no']):''; ?>'>
                        </div>
                      <label class="col-sm-2 control-label">ResCert Date: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control date_picker"  value='<?php echo !empty($client)?htmlspecialchars($client['rescert_date']):''; ?>' id="rescert_date" name='rc_date'>
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
                        <label class="col-sm-3 control-label">Business Type: *</label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='bus_type' id='bus_type' data-allow-clear='true' data-placeholder="Select Business Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['bus_type_id']):''; ?>' required>
                                <?php echo makeOptions($bt); ?>
                            </select>
                        </div>
	                    <label class="col-sm-2 control-label">Country: *</label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='country' id='country' data-allow-clear='true' data-placeholder="Select Country" data-selected='<?php echo !empty($data)?htmlspecialchars($data['country_id']):''; ?>' required>
                                <?php echo makeOptions($co); ?>
                            </select>
                        </div>
                    </div>
	                   <div class='form-group'>
                        <label class="col-sm-3 control-label">Industry Code: *</label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='ind_code' id='ind_code' data-allow-clear='true' data-placeholder="Select Industry Code" data-selected='<?php echo !empty($data)?htmlspecialchars($data['ind_code_id']):''; ?>' required>
                                <?php echo makeOptions($ic); ?>
                            </select>
                        </div>
	                    <label class="col-sm-2 control-label">Region: *</label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='region' id='region' data-allow-clear='true' data-placeholder="Select Region" data-selected='<?php echo !empty($data)?htmlspecialchars($data['region_id']):''; ?>' required>
                                <?php echo makeOptions($re); ?>
                            </select>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Client Type: *</label>
                        </div>
                        <div class='form-group'>
                        <label class="col-sm-3 control-label"> </label>
                        <div class='col-sm-9'>
                        <input type='checkbox' name='is_borrower' id='is_borrower' <?php echo !empty($client)?htmlspecialchars($client['is_borrower']):''; ?> ><font size='3'> Borrower</font><?php echo str_repeat('&nbsp;',40);?>
                        <input type='checkbox' name='is_dealer' id='is_dealer' <?php echo !empty($client)?htmlspecialchars($client['is_dealer']):''; ?> ><font size='3'> Dealer</font><?php echo str_repeat('&nbsp;',40);?>
                        <input type='checkbox' name='is_salesman' id='is_salesman' <?php echo !empty($client)?htmlspecialchars($client['is_salesman']):''; ?> ><font size='3'> Salesman</font>
                        </div>
                    </div>
                    <hr>
                    <center><b>Contact Person</b></center><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="con_name" name='con_name' placeholder="Name of Contact Person" value='<?php echo !empty($client)?htmlspecialchars($client['con_name']):''; ?>' required>
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
                          <input type="text" class="form-control" id="con_rc_place" name='con_rc_place' placeholder="Contact Person ResCert Place" value='<?php echo !empty($client)?htmlspecialchars($client['con_rescert_place']):''; ?>' >
                      </div>
                  </div>
                    <hr>
                    <center><b>Home Address</b></center><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_no" name='home_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($client)?htmlspecialchars($client['home_no']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_brgy" name='home_brgy' placeholder="Barangay" value='<?php echo !empty($client)?htmlspecialchars($client['home_brgy']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_city" name='home_city' placeholder="City" value='<?php echo !empty($client)?htmlspecialchars($client['home_city']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_zip" name='home_zip' placeholder="Zip Code" value='<?php echo !empty($client)?htmlspecialchars($client['home_zip']):''; ?>' required>
                      </div>
                  </div>
                  <center><b>Business Address</b><br><br>
                  <input type='checkbox' name='same_add' id='same_add' <?php echo !empty($client)?htmlspecialchars($client['same_add']):''; ?>><i> Check if Business Address is the same as Home Address</i></center>
                  <div id="autoUpdate" class="autoUpdate"><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_no" name='bus_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($client)?htmlspecialchars($client['bus_no']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_brgy" name='bus_brgy' placeholder="Barangay" value='<?php echo !empty($client)?htmlspecialchars($client['bus_brgy']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_city" name='bus_city' placeholder="City" value='<?php echo !empty($client)?htmlspecialchars($client['bus_city']):''; ?>'required>
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_zip" name='bus_zip' placeholder="Zip Code" value='<?php echo !empty($client)?htmlspecialchars($client['bus_zip']):''; ?>' required>
                      </div>
                  </div>
                  </div>
                  <center><b>Garage Address</b><br><br>
                  <input type='checkbox' name='same_add1' id='same_add1' <?php echo !empty($client)?htmlspecialchars($client['same_add1']):''; ?>><i> Check if Garage Address is the same as Home Address</i></center>
                  <div id="autoUpdate1" class="autoUpdate1"><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_no" name='gar_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($client)?htmlspecialchars($client['gar_no']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_brgy" name='gar_brgy' placeholder="Barangay" value='<?php echo !empty($client)?htmlspecialchars($client['gar_brgy']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_city" name='gar_city' placeholder="City" value='<?php echo !empty($client)?htmlspecialchars($client['gar_city']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_zip" name='gar_zip' placeholder="Zip Code" value='<?php echo !empty($client)?htmlspecialchars($client['gar_zip']):''; ?>' required>
                      </div>
                  </div>
                  </div>
                  <hr>
             <div class="form-group">
              <label for="email" class="col-sm-3 control-label">Email Address: </label>
              <div class="col-sm-3">
                <input type="email" class="form-control" id="email" placeholder="Email Address" name='email' value='<?php echo !empty($client)?htmlspecialchars($client['email']):''; ?>' required>
              </div>
                      <label class="col-sm-2 control-label">FAX No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="fax_no" placeholder="FAX Number" name='fax_no' value='<?php echo !empty($client)?htmlspecialchars($client['fax_no']):''; ?>' required>
                        </div>
            </div>
              <div class='form-group'>
                        <label class="col-sm-3 control-label">Business Tel. No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control tel" id="bus_tel" placeholder="Business Telephone Number" name='bus_tel' value='<?php echo !empty($client)?htmlspecialchars($client['bus_tel']):''; ?>' required>
                        </div>
                      <label class="col-sm-2 control-label">Home Tel. No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control tel" id="home_tel" placeholder="Home Telephone Number" name='home_tel' value='<?php echo !empty($client)?htmlspecialchars($client['home_tel']):''; ?>' required>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Primary Contact No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control" id="pri_con" placeholder="Primary Contact Number" name='pri_con' value='<?php echo !empty($client)?htmlspecialchars($client['pri_con']):''; ?>' required>
                        </div>
                      <label class="col-sm-2 control-label">Secondary Contact No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="sec_con" placeholder="Secondary Contact Number" name='sec_con' value='<?php echo !empty($client)?htmlspecialchars($client['sec_con']):''; ?>' >
                        </div>
                    </div>
        <?php
        }
    else{
      //echo "<ul class='timeline'>";
            foreach ($messages as $data):
                $ct=$con->myQuery("SELECT name FROM client_type WHERE id=?",array($data['client_type_id']))->fetch(PDO::FETCH_ASSOC);
            ?>      
          <div class='form-group'>
          <label class="col-md-3 control-label">Application Number: </label>
          <div class="col-md-3">
            <input type="text" class="form-control numeric" id="app_no" name='app_no' placeholder="Application Number" readonly>
          </div>
          </div>
                  <div class='form-group'>
                  <label class="col-md-3 control-label">Last Name: </label>
                      <div class="col-md-3">
                        <div id='dlname'>
                        <select class='form-control cbo' name='lname' id='lname' data-placeholder="Select Last Name" data-selected='<?php echo !empty($data)?htmlspecialchars($data['lname']):''; ?>' required>
                                    <?php echo makeOptions($lname1); ?>
                                </select>
                                </div>
                        <div id='dlname1' style='display: none'>
                        <input type="text" class="form-control" id="lname" name='lname' placeholder="Last Name" value='<?php echo !empty($data)?htmlspecialchars($data['lname']):''; ?>'>
                                </div>
                        </div>
                  <label class="col-md-2 control-label">Client Number: </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number" value='<?php echo !empty($data)?htmlspecialchars($data['client_number']):''; ?>' readonly>
                      </div>
                  </div>
                   <div class='form-group'>
                      <label class="col-md-3 control-label">First Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="fname" name='fname' placeholder="First Name" value='<?php echo !empty($data)?htmlspecialchars($data['fname']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Client Status* : </label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='cli_stat' id='cli_stat' data-placeholder="Select Client Status" data-selected='<?php echo !empty($client)?htmlspecialchars($client['client_stat']):''; ?>' required>
                                <option value='0'>New</option>
                                <option value='1'>Old</option>
                            </select>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-md-3 control-label">Spouse: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse" name='spouse' placeholder="Spouse" value='<?php echo !empty($data)?htmlspecialchars($data['spouse']):''; ?>' >
                      </div>
                  </div>
                  </div>
                  <hr>
                  <div class='form-group'>
                        <label class="col-sm-3 control-label">Dealer: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='dealer' id='dealer' data-allow-clear='true' data-placeholder="Select Dealer" data-selected='<?php echo !empty($data)?htmlspecialchars($data['dealer_id']):''; ?>'>
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
                            <select class='form-control cbo' name='loan_type' id='loan_type' data-allow-clear='true' data-placeholder="Select Loan Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['loan_type_id']):''; ?>' required>
                                <?php echo makeOptions($lt); ?>
                            </select>
                        </div>
                      <label class="col-sm-2 control-label">Credit Facility: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='cre_fac' id='cre_fac'  data-allow-clear='true' data-placeholder="Select Credit Facility" data-selected='<?php echo !empty($data)?htmlspecialchars($data['credit_fac_id']):''; ?>' required>
                                <?php echo makeOptions($cf); ?>
                            </select>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Product Line: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='pro_line' id='pro_line'  data-allow-clear='true' data-placeholder="Select Product Line" data-selected='<?php echo !empty($data)?htmlspecialchars($data['prod_line_id']):''; ?>' required>
                                <?php echo makeOptions($pl); ?>
                            </select>
                        </div>
                      <label class="col-sm-2 control-label">Marketing Type: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='mar_type' id='mar_type'  data-allow-clear='true' data-placeholder="Select Marketing Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['mark_type_id']):''; ?>' required>
                                <?php echo makeOptions($mt); ?>
                            </select>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Collateral Code: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='col_code' id='col_code' data-allow-clear='true' data-placeholder="Select Collateral Code" data-selected='<?php echo !empty($data)?htmlspecialchars($data['coll_code_id']):''; ?>' required>
                                <?php echo makeOptions($cc); ?>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">Unit Description: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="unit_desc" name='unit_desc' placeholder="Unit Description" >
                      </div>
                    </div>
                    <hr>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Amount Financed: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="amt_fin" name='amt_fin' placeholder="Amount Financed">
                        </div>
                        <label class="col-md-2 control-label">Residual Value: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="res_val" name='res_val' placeholder="Residual Value">
                      </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Down Payment: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="down_pay" name='down_pay' placeholder="Down Payment">
                        </div>
                        <label class="col-md-2 control-label">List Price: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="list_pri" name='list_pri' placeholder="List Price">
                      </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Term: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="term" name='term' placeholder="Term">
                        </div>
                        <label class="col-md-2 control-label">Interest Rate: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="int_rate" name='int_rate' placeholder="Interest Rate">
                      </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Monthly Amortization: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="mon_amor" name='mon_amor' placeholder="Monthly Amortization">
                        </div>
                    </div>
                    <hr>
                    <center><b>Home Address</b></center><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_no" name='home_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($data)?htmlspecialchars($data['home_no']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_brgy" name='home_brgy' placeholder="Barangay" value='<?php echo !empty($data)?htmlspecialchars($data['home_brgy']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_city" name='home_city' placeholder="City" value='<?php echo !empty($data)?htmlspecialchars($data['home_city']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_zip" name='home_zip' placeholder="Zip Code" value='<?php echo !empty($data)?htmlspecialchars($data['home_zip']):''; ?>'>
                      </div>
                  </div>
                  <center><b>Business Address</b><br><br>
                  <input type='checkbox' name='same_add' id='same_add' <?php echo !empty($data)?htmlspecialchars($data['same_add']):''; ?> ><i> Check if Business Address is the same as Home Address</i></center>
                  <div id="autoUpdate" class="autoUpdate"><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_no" name='bus_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($data)?htmlspecialchars($data['bus_no']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_brgy" name='bus_brgy' placeholder="Barangay" value='<?php echo !empty($data)?htmlspecialchars($data['bus_brgy']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_city" name='bus_city' placeholder="City" value='<?php echo !empty($data)?htmlspecialchars($data['bus_city']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_zip" name='bus_zip' placeholder="Zip Code" value='<?php echo !empty($data)?htmlspecialchars($data['bus_zip']):''; ?>'>
                      </div>
                  </div>
                  </div><br>
                  <hr>
              <div class='form-group'>
                        <label class="col-sm-3 control-label">Business Tel. No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control tel" id="bus_tel" placeholder="Business Telephone Number" name='bus_tel' value='<?php echo !empty($data)?htmlspecialchars($data['bus_tel']):''; ?>'>
                        </div>
                      <label class="col-sm-2 control-label">Home Tel. No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control tel" id="home_tel" placeholder="Home Telephone Number" name='home_tel' value='<?php echo !empty($data)?htmlspecialchars($data['home_tel']):''; ?>'>
                        </div>
                    </div>
      <!-- <li>
      <div class='timeline-item'>
        <span class='time'>
          <i class='fa fa-clock-o'></i>
          <?php //echo htmlspecialchars($row['date_sent'])?>
        </span>
        <div class='timeline-header'>
          <a><?php //echo htmlspecialchars($row['sender'])?></a>
        </div>
        <div class='timeline-body'>
          <?php //echo htmlspecialchars($row['message'])?>
        </div>
      </div>
      </li> -->
      <?php

      endforeach;
      //echo "</ul>";
    }
}
else{?>
              <div class='form-group'>
          <label class="col-md-3 control-label">Application Number: </label>
          <div class="col-md-3">
            <input type="text" class="form-control numeric" id="app_no" name='app_no' placeholder="Application Number" value='<?php echo !empty($data)?htmlspecialchars($data['id']):''; ?>' readonly>
          </div>
          </div>
          <div class="form-group">
          <label class="col-md-3 control-label">Last Name: </label>
                      <div class="col-md-3">
                        <div id='dlname'>
                        <select class='form-control cbo' name='lname' id='lname' data-placeholder="Select Last Name" data-selected='<?php echo !empty($data)?htmlspecialchars($data['lname']):''; ?>' required>
                                    <?php echo makeOptions($lname1); ?>
                                </select>
                                </div>
                        <div id='dlname1' style='display: none'>
                        <input type="text" class="form-control" id="lname" name='lname' placeholder="Last Name" value='<?php echo !empty($data)?htmlspecialchars($data['lname']):''; ?>'>
                                </div>
                        </div>
                        <label class="col-md-2 control-label">Client Number: </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number" value='<?php echo !empty($data)?htmlspecialchars($data['client_no']):''; ?>' readonly>
                      </div>
                      </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">First Name: </label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="fname" name='fname' placeholder="First Name" value='<?php echo !empty($client)?htmlspecialchars($client['fname']):''; ?>' required>
                            </div>
                <label class="col-md-2 control-label">Client Status : </label>
                            <div class="col-md-3">
                            <select class='form-control cbo' name='cli_stat' id='cli_stat' data-placeholder="Select Client Status" data-selected='<?php echo !empty($client)?htmlspecialchars($client['client_stat']):''; ?>' >
                                        <option value='0'>New</option>
                                        <option value='1'>Old</option>
                                    </select>
                            </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-md-3 control-label">Spouse: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse" name='spouse' placeholder="Spouse" value='<?php echo !empty($data)?htmlspecialchars($data['spouse']):''; ?>' >
                      </div>
                  </div>
                  </div>
                  <hr>
                  <div class='form-group'>
                        <label class="col-sm-3 control-label">Dealer: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='dealer' id='dealer' data-allow-clear='true' data-placeholder="Select Dealer" data-selected='<?php echo !empty($data)?htmlspecialchars($data['dealer_id']):''; ?>'>
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
                            <select class='form-control cbo' name='loan_type' id='loan_type' data-placeholder="Select Loan Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['loan_type_id']):''; ?>' required>
                                <?php echo makeOptions($lt); ?>
                            </select>
                        </div>
                      <label class="col-sm-2 control-label">Credit Facility: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='cre_fac' id='cre_fac' data-placeholder="Select Credit Facility" data-selected='<?php echo !empty($data)?htmlspecialchars($data['credit_fac_id']):''; ?>' required>
                                <?php echo makeOptions($cf); ?>
                            </select>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Product Line: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='pro_line' id='pro_line' data-placeholder="Select Product Line" data-selected='<?php echo !empty($data)?htmlspecialchars($data['prod_line_id']):''; ?>' required>
                                <?php echo makeOptions($pl); ?>
                            </select>
                        </div>
                      <label class="col-sm-2 control-label">Marketing Type: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='mar_type' id='mar_type' data-placeholder="Select Marketing Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['mark_type_id']):''; ?>' required>
                                <?php echo makeOptions($mt); ?>
                            </select>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Collateral Code: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='col_code' id='col_code' data-placeholder="Select Collateral Code" data-selected='<?php echo !empty($data)?htmlspecialchars($data['coll_code_id']):''; ?>' required>
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
                          <input type="text" class="form-control numeric" id="res_val" name='res_val' placeholder="Residual Value" value='<?php echo !empty($data)?htmlspecialchars($data['res_val']):''; ?>'>
                      </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">Down Payment: </label>
                        <div class='col-sm-3'>
                        <input type="text" class="form-control numeric" id="down_pay" name='down_pay' placeholder="Down Payment" value='<?php echo !empty($data)?htmlspecialchars($data['down_pay']):''; ?>'>
                        </div>
                        <label class="col-md-2 control-label">List Price: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="list_pri" name='list_pri' placeholder="List Price" value='<?php echo !empty($data)?htmlspecialchars($data['list_pri']):''; ?>'>
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
                        <input type="text" class="form-control numeric" id="mon_amor" name='mon_amor' placeholder="Monthly Amortization" value='<?php echo !empty($data)?htmlspecialchars($data['mon_amor']):''; ?>'>
                        </div>
                    </div>
                    <hr>
                    <center><b>Home Address</b></center><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_no" name='home_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($client)?htmlspecialchars($client['home_no']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_brgy" name='home_brgy' placeholder="Barangay" value='<?php echo !empty($client)?htmlspecialchars($client['home_brgy']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_city" name='home_city' placeholder="City" value='<?php echo !empty($client)?htmlspecialchars($client['home_city']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_zip" name='home_zip' placeholder="Zip Code" value='<?php echo !empty($client)?htmlspecialchars($client['home_zip']):''; ?>' >
                      </div>
                  </div>
                  <center><b>Business Address</b><br><br>
                  <input type='checkbox' name='same_add' id='same_add' <?php echo !empty($client)?htmlspecialchars($client['same_add']):''; ?> ><i> Check if Business Address is the same as Home Address</i></center>
                  <div id="autoUpdate" class="autoUpdate"><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_no" name='bus_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($client)?htmlspecialchars($client['bus_no']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_brgy" name='bus_brgy' placeholder="Barangay" value='<?php echo !empty($client)?htmlspecialchars($client['bus_brgy']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_city" name='bus_city' placeholder="City" value='<?php echo !empty($client)?htmlspecialchars($client['bus_city']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_zip" name='bus_zip' placeholder="Zip Code" value='<?php echo !empty($client)?htmlspecialchars($client['bus_zip']):''; ?>' >
                      </div>
                  </div>
                  </div>
                  <hr>
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
<?php }
?>
<script type="text/javascript">
               $('.cbo').select2({
        placeholder:$(this).data("placeholder"),
            allowClear:$(this).data("allow-clear")
      });

    $('.cbo').each(function(index,element){
        if(typeof $(element).data("selected") !== "undefined"){
        $(element).val($(element).data("selected")).trigger("change");
        }
        });
    var text = document.getElementById("client_no");
    var text1 = document.getElementById("lname");
    $("#client_no").change(function(){
        $("#comment_table").html("<span class='fa fa-refresh fa-pulse'></span>")
            $("#comment_table").load("../marketing/ajax/autofill_form.php?id="+text.value);
    });

    $("#lname").change(function(){
        $("#comment_table").html("<span class='fa fa-refresh fa-pulse'></span>")
            $("#comment_table").load("../marketing/ajax/autofill_form.php?lname="+text1.value);
    });
      //  $('.cbo').each(function(index,element){
    //     if(typeof $(element).data("selected") !== "undefined"){
    //     $(element).val($(element).data("selected")).trigger("change");
    //     }
        // });
        if ($("#same_add").is(':checked')){
    $("#autoUpdate").hide();
}
if ($("#same_add1").is(':checked')){
    $("#autoUpdate1").hide();
}
$("#dealer").on('change',function(){
        if(document.getElementById("dealer").selectedIndex > 0){
            $("#salesman").attr('disabled',false);
        }else{
            $("#salesman").attr('disabled',true);
        }
    });
$("#cli_stat").change(function(){
        if((document.getElementById("cli_stat").value) == '0'){
            $("#dlname").hide();
            $("#dlname1").show();
            $("#lname").attr('required',false);
        }
        else if((document.getElementById("cli_stat").value) == '1'){
            $("#dlname").show();
            $("#dlname1").hide();
            $("#lname").attr('required',true);
        }
    });
    if ($("#same_add").is(':checked')){
    $("#autoUpdate").hide();
    $('#bus_no').prop('required',false);
    $('#bus_brgy').prop('required',false);
    $('#bus_city').prop('required',false);
    $('#bus_zip').prop('required',false);
}
    $('#same_add').change(function(){
        if (this.checked) {
            $('#autoUpdate').hide();
            $('#bus_no').prop('required',false);
            $('#bus_brgy').prop('required',false);
            $('#bus_city').prop('required',false);
            $('#bus_zip').prop('required',false);
        }
        else {
            $('#autoUpdate').show();
            $('#bus_no').prop('required',true);
            $('#bus_brgy').prop('required',true);
            $('#bus_city').prop('required',true);
            $('#bus_zip').prop('required',true);
        }                   
    });

    if ($("#same_add1").is(':checked')){
    $("#autoUpdate1").hide();
    $('#gar_no').prop('required',false);
    $('#gar_brgy').prop('required',false);
    $('#gar_city').prop('required',false);
    $('#gar_zip').prop('required',false);
}
    $('#same_add1').change(function(){
        if (this.checked) {
            $('#autoUpdate1').hide();
            $('#gar_no').prop('required',false);
            $('#gar_brgy').prop('required',false);
            $('#gar_city').prop('required',false);
            $('#gar_zip').prop('required',false);
        }
        else {
            $('#autoUpdate1').show();
            $('#gar_no').prop('required',true);
            $('#gar_brgy').prop('required',true);
            $('#gar_city').prop('required',true);
            $('#gar_zip').prop('required',true);
        }                   
    });
        $('.date_picker').datepicker();  
        $(".date_picker").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        $(".tel").inputmask("999-9999", {"placeholder": "###-####"});

</script>