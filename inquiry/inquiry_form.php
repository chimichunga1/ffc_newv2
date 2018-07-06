<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Client Form",1);
    
    
    require_once("../template/header.php");
    require_once("../template/sidebar.php");
    $ind_corp=$con->myQuery("SELECT id,name FROM industry_corp WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $cv=$con->myQuery("SELECT id,name FROM civil_status WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $bt=$con->myQuery("SELECT id,name FROM business_type WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $country=$con->myQuery("SELECT id,name FROM country WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $ind_code=$con->myQuery("SELECT id,name FROM industry_code WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $reg=$con->myQuery("SELECT id,name FROM region WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $ct=$con->myQuery("SELECT id,name FROM client_type WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
if(!empty($_GET['id'])){
    $data=$con->myQuery("SELECT * FROM client_list WHERE client_number=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
  }
?>

<div class="content-wrapper">
	
<section class="content-header">
	<?php
		Alert();
		
	?>
	<div class="box">
	<div class="box-body">
	<center>
	<h3> Client Form </h3>
	</center>
	<hr>
	<a href='inquiry.php'>
	<button type='button' class="btn btn-default"><span class="fa fa-arrow-left"></span> Client List</button></a><br><br>
    <center><h4>Personal Information</h4></center><br>
			<div class="row">
            <!-- save_inquiry.php -->
                <form action="" method="post" class="form-horizontal" id='frmclear'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                	 <div class='form-group'>
                     <label class="col-md-3 control-label">Client Number: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number" value='<?php echo !empty($data)?htmlspecialchars($data['client_number']):''; ?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Ind / Corp: *</label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='ind_corp' id='ind_corp' data-allow-clear='true' data-placeholder="Select Ind / Corp" data-selected='<?php echo !empty($data)?htmlspecialchars($data['ind_corp_id']):''; ?>' required>
                                <?php echo makeOptions($ind_corp); ?>
                            </select>
                      </div>
                  </div>
                   <div class='form-group'>
                      <label class="col-md-3 control-label">First Name: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="fname" name='fname' placeholder="First Name" value='<?php echo !empty($data)?htmlspecialchars($data['fname']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Middle Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="mname" name='mname' placeholder="Middle Name" value='<?php echo !empty($data)?htmlspecialchars($data['mname']):''; ?>'>
                      </div>
                  </div>
                     <div class='form-group'>
                     <label class="col-md-3 control-label">Last Name: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="lname" name='lname' placeholder="Last Name" value='<?php echo !empty($data)?htmlspecialchars($data['lname']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Extension Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="ename" name='ename' placeholder="Extension Name" value='<?php echo !empty($data)?htmlspecialchars($data['ename']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Birthdate: *</label>
                      <div class="col-sm-3">
                          <input type="text"  value='<?php echo !empty($data)?htmlspecialchars($data['birthdate']):''; ?>' class="form-control date_picker" id="birth_date" name='birth_date' required>
                      </div>
                      <label class="col-sm-2 control-label">Gender: *</label>
                      <div class="col-sm-3">
                      <select name='gender' class='form-control cbo'  required>
                        <option value='' disabled <?php echo empty($data)?'selected="selected"':''; ?>>Select Gender</option>
                        <option value='Male' <?php echo !empty($data) && $data['gender']=='Male'?'selected="selected"':''; ?>>Male</option>
                        <option value='Female' <?php echo !empty($data) && $data['gender']=='Female'?'selected="selected"':''; ?>>Female</option>
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
                  <hr>
                  <center><h4>Identification References</h4></center><br>
                  <div class='form-group'>
                        <label class="col-sm-3 control-label">TIN: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control numeric" id="tin" placeholder="Taxpayer Identification Number" name='tin' value='<?php echo !empty($data)?htmlspecialchars($data['tin_no']):''; ?>'>
                        </div>
	                    <label class="col-sm-2 control-label">SSS Number: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control numeric" id="sss_no" placeholder="SSS Number" name='sss_no' value='<?php echo !empty($data)?htmlspecialchars($data['sss_no']):''; ?>'>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">ACR Number: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control numeric" id="acr_no" placeholder="ACR Number" name='acr_no' value='<?php echo !empty($data)?htmlspecialchars($data['acr_no']):''; ?>' >
                        </div>
	                    <label class="col-sm-2 control-label">Pag-IBIG: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control numeric" id="pag_ibig" placeholder="Pag-IBIG Number" name='pag_ibig' value='<?php echo !empty($data)?htmlspecialchars($data['pagibig_no']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-sm-3 control-label">ResCert: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control numeric" id="rc_no" placeholder="Residence Certificate Number" name='rc_no' value='<?php echo !empty($data)?htmlspecialchars($data['rescert_no']):''; ?>' >
                        </div>
	                    <label class="col-sm-2 control-label">ResCert Date: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control date_picker"  value='<?php echo !empty($data)?htmlspecialchars($data['rescert_date']):''; ?>' id="rescert_date" name='rc_date' >
                        </div>
                    </div>
                    <div class='form-group'>
                      <label class="col-md-3 control-label">ResCert Place: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="rc_place" name='rc_place' placeholder="Residence Certificate Place" value='<?php echo !empty($data)?htmlspecialchars($data['rescert_place']):''; ?>'>
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
                                <?php echo makeOptions($country); ?>
                            </select>
                        </div>
                    </div>
	                   <div class='form-group'>
                        <label class="col-sm-3 control-label">Industry Code: *</label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='ind_code' id='ind_code' data-allow-clear='true' data-placeholder="Select Industry Code" data-selected='<?php echo !empty($data)?htmlspecialchars($data['ind_code_id']):''; ?>' required>
                                <?php echo makeOptions($ind_code); ?>
                            </select>
                        </div>
	                    <label class="col-sm-2 control-label">Region: *</label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='region' id='region' data-allow-clear='true' data-placeholder="Select Region" data-selected='<?php echo !empty($data)?htmlspecialchars($data['region_id']):''; ?>' required>
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
                        <input type='checkbox' name='is_borrower' id='is_borrower' <?php echo !empty($data)?htmlspecialchars($data['is_borrower']):''; ?>><font size='3'> Borrower</font><?php echo str_repeat('&nbsp;',40);?>
                        <input type='checkbox' name='is_dealer' id='is_dealer' <?php echo !empty($data)?htmlspecialchars($data['is_dealer']):''; ?>><font size='3'> Dealer</font><?php echo str_repeat('&nbsp;',40);?>
                        <input type='checkbox' name='is_salesman' id='is_salesman' <?php echo !empty($data)?htmlspecialchars($data['is_salesman']):''; ?>><font size='3'> Salesman</font>
                        </div>
                    </div>
                    <hr>
                    <center><h4>Contact Person</h4></center><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Name: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="con_name" name='con_name' placeholder="Name of Contact Person" value='<?php echo !empty($data)?htmlspecialchars($data['con_name']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">ResCert: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="con_rc_no" name='con_rc_no' placeholder="Contact Person ResCert Number" value='<?php echo !empty($data)?htmlspecialchars($data['con_rescert_no']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">ResCert Date: *</label>
                      <div class="col-md-3">
                      <input type="text" class="form-control date_picker" value='<?php echo !empty($data)?htmlspecialchars($data['con_rescert_date']):''; ?>' id="con_rc_date" name='con_rc_date' required>
                      </div>
                      <label class="col-md-2 control-label">ResCert Place: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="con_rc_place" name='con_rc_place' placeholder="Contact Person ResCert Place" value='<?php echo !empty($data)?htmlspecialchars($data['con_rescert_place']):''; ?>' required>
                      </div>
                  </div>
                    <hr>
                    <center><h4>Home Address</h4></center><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_no" name='home_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($data)?htmlspecialchars($data['home_no']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Barangay: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_brgy" name='home_brgy' placeholder="Barangay" value='<?php echo !empty($data)?htmlspecialchars($data['home_brgy']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_city" name='home_city' placeholder="City" value='<?php echo !empty($data)?htmlspecialchars($data['home_city']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Zip Code: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_zip" name='home_zip' placeholder="Zip Code" value='<?php echo !empty($data)?htmlspecialchars($data['home_zip']):''; ?>' required>
                      </div>
                  </div><br>
                  <center><h4>Business Address</h4><br>
                  <center><input type='checkbox' name='same_add' id='same_add' <?php echo !empty($data)?htmlspecialchars($data['same_add']):''; ?>><i> Check if Business Address is the same as Home Address</i></center>
                  <div id="autoUpdate" class="autoUpdate"><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_no" name='bus_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($data)?htmlspecialchars($data['bus_no']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Barangay: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_brgy" name='bus_brgy' placeholder="Barangay" value='<?php echo !empty($data)?htmlspecialchars($data['bus_brgy']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_city" name='bus_city' placeholder="City" value='<?php echo !empty($data)?htmlspecialchars($data['bus_city']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Zip Code: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_zip" name='bus_zip' placeholder="Zip Code" value='<?php echo !empty($data)?htmlspecialchars($data['bus_zip']):''; ?>' required>
                      </div>
                  </div>
                  </div><br>
                  <center><h4>Garage Address</h4><br>
                  <input type='checkbox' name='same_add1' id='same_add1' <?php echo !empty($data)?htmlspecialchars($data['same_add1']):''; ?>><i> Check if Garage Address is the same as Home Address</i></center>
                  <div id="autoUpdate1" class="autoUpdate1"><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_no" name='gar_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($data)?htmlspecialchars($data['gar_no']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Barangay: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_brgy" name='gar_brgy' placeholder="Barangay" value='<?php echo !empty($data)?htmlspecialchars($data['gar_brgy']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_city" name='gar_city' placeholder="City" value='<?php echo !empty($data)?htmlspecialchars($data['gar_city']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Zip Code: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_zip" name='gar_zip' placeholder="Zip Code" value='<?php echo !empty($data)?htmlspecialchars($data['gar_zip']):''; ?>' required>
                      </div>
                  </div>
                  </div>
                  <hr>
                  <center><h4>Contact Information</h4><br>
				     <div class="form-group">
				      <label for="email" class="col-sm-3 control-label">Email Address: *</label>
				      <div class="col-sm-3">
				        <input type="email" class="form-control" id="email" placeholder="Email Address" name='email' value='<?php echo !empty($data)?htmlspecialchars($data['email']):''; ?>' required>
				      </div>
                      <label class="col-sm-2 control-label">FAX No: *</label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="fax_no" placeholder="FAX Number" name='fax_no' value='<?php echo !empty($data)?htmlspecialchars($data['home_tel']):''; ?>' required>
                        </div>
				    </div>
				      <div class='form-group'>
                        <label class="col-sm-3 control-label">Business Tel. No: *</label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control" id="bus_tel" placeholder="Business Telephone Number" name='bus_tel' value='<?php echo !empty($data)?htmlspecialchars($data['bus_tel']):''; ?>' required>
                        </div>
	                    <label class="col-sm-2 control-label">Home Tel. No: *</label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="home_tel" placeholder="Home Telephone Number" name='home_tel' value='<?php echo !empty($data)?htmlspecialchars($data['home_tel']):''; ?>' required>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Primary Contact No: *</label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control" id="pri_con" placeholder="Primary Contact Number" name='pri_con' value='<?php echo !empty($data)?htmlspecialchars($data['pri_con']):''; ?>' required>
                        </div>
	                    <label class="col-sm-2 control-label">Secondary Contact No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="sec_con" placeholder="Secondary Contact Number" name='sec_con' value='<?php echo !empty($data)?htmlspecialchars($data['sec_con']):''; ?>'>
                        </div>
                    </div><br>
                         <!-- <div class="form-group">
					      <div class="col-sm-11 col-md-offset-1 text-center">
					      	<button type='submit' class='btn btn-primary'>Save </button>
					      	<a href='inquiry.php' class='btn btn-default'>Cancel</a>
					      </div>
					    </div> -->
                </form>
            </div>		
		</div>
	</div>
	</div>
</section>

 
</div>



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
</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>
