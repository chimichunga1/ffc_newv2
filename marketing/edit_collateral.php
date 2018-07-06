<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Collateral Update",1);
    
    
    require_once("../template/header.php");
    require_once("../template/sidebar.php");
    // $data=$con->myQuery("SELECT * FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
    $client = $con->myQuery("SELECT * FROM collateral_info WHERE id=? AND is_deleted=0",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);

?>

<div class="content-wrapper">
	
<section class="content-header">
	<?php
		Alert();
		
	?>
	<div class="box">
	<div class="box-body">
	<center>
	<h3> Collateral Update </h3>
	</center>
    <a href='collateral_list.php?id=<?php echo $client['loan_list_id'];?>'>
	<button type='button' class="btn btn-default"><span class="fa fa-arrow-left"></span> Collateral List</button></a><br><br>
	<hr>
			<div class="row">
                <form action="save_collateral.php" method="post" class="form-horizontal" id='frmclear'>
                <input type='hidden' name='id' id='id' value="<?php echo $client['id'];?>">
                <input type="hidden" name="submit_type" value="edit">
                	 <div class='form-group'>
                     <label class="col-md-3 control-label">Client Number: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="client_no" name='client_no' value='<?php echo ($client['client_no']) ? htmlspecialchars($client['client_no']) : ''; ?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Client Name</label>
                      <div class="col-md-3">
                      <input type="text" class="form-control" id="client_name" name='client_name'  value='<?php echo ($client['client_name']) ? htmlspecialchars($client['client_name']) : '';?>' readonly>
                      </div>
                  </div>
                   <div class='form-group'>
                     <label class="col-md-3 control-label">Assignee: *</label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" id="assignee" name='assignee' value='<?php echo ($client['assignee']) ? htmlspecialchars($client['assignee']) : '';?>' required>
                      </div>
                    <br><br>
                    <hr>
                  </div>
                     <div class='form-group'>
                      <label class="col-md-3 control-label">Unit Description / Lot Dimension: * </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="unit_lot_d" name='unit_lot_d'  value='<?php echo ($client['unit_description']) ? htmlspecialchars($client['unit_description']) : '';?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Motor no. / Location: *</label>
                      <div class="col-sm-3">
                          <input type="text"  value='<?php echo ($client['location_motor']) ? htmlspecialchars($client['location_motor']) : '';?>' class="form-control " id="motor_no_location" name='motor_no_location' required>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Chassis no. / TCT no.: *</label>
                      <div class="col-sm-3">
                          <input type="text"  value='<?php echo ($client['tct_no']) ? htmlspecialchars($client['tct_no']) : '';?>' class="form-control numeric" id="chassis_tct_no" name='chassis_tct_no' required>
                      </div>
                  </div>
                  <hr>
                  <div class="form-group">
				      <label for="text" class="col-sm-3 control-label">Plate no.: *</label>
				      <div class="col-sm-3">
				        <input type="text" class="form-control numeric" id="plate_no" name='plate_no' value='<?php echo ($client['plate_no']) ? htmlspecialchars($client['plate_no']) : '';?>' required>
				      </div>
                      <label class="col-sm-2 control-label">LCP / Approve value: *</label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control numeric" id="lcp" name='lcp' value='<?php echo ($client['approve_value']) ? htmlspecialchars($client['approve_value']) : '';?>' required>
                        </div>
				    </div>
                    <div class="form-group">
				      <label for="text" class="col-sm-3 control-label">O.R no.: *</label>
				      <div class="col-sm-3">
				        <input type="text" class="form-control numeric" id="or_no" name='or_no' value='<?php echo ($client['or_no']) ? htmlspecialchars($client['or_no']) : '';?>' required>
				      </div>
                      <label class="col-sm-2 control-label">Latest O.R Date: *</label>
                      <div class="col-md-3">
                      <input type="text"  value='<?php echo ($client['or_date']) ? htmlspecialchars(date_format(date_create($client['or_date']),"m/d/Y")) : '';?>' class="form-control date_picker" id="or_date" name='or_date' required>
                      </div>
				    </div>
                    <div class="form-group">
				      <label for="email" class="col-sm-3 control-label">C.R no.: *</label>
				      <div class="col-sm-3">
				        <input type="text" class="form-control" id="cr_no"  name='cr_no' value='<?php echo ($client['cr_no']) ? htmlspecialchars($client['cr_no']) : '';?>' required>
				      </div>
                      <label class="col-sm-2 control-label">with Stencile: </label>
                        <div class='col-sm-3'>
                           <select name="stencile" id="stencile" class="form-control" required>
                           <option value="yes" <?php echo (($client['with_stencile']=="yes") ? 'selected' : '')?>>Yes</option>
                           <option value="no" <?php echo (($client['with_stencile']=="no") ? 'selected' : '')?>>No</option>
                           </select>
                        </div>
				    </div>
                    <div class='form-group'>
                      <label class="col-sm-3 control-label">LTO Agency: *</label>
                      <div class="col-sm-3">
                          <input type="text"  value='<?php echo ($client['lto_agency']) ? htmlspecialchars($client['lto_agency']) : '';?>' class="form-control " id="lto_agency" name='lto_agency' required>
                      </div>
                  </div>
                    <hr>
                    <div class='form-group'>
                      <label class="col-sm-3 control-label">Insureance status: *</label>
                      <div class="col-sm-3">
                          <select name="insurance_status" id="insurance_status" class="form-control" required>
                          <option value="insured" <?php echo (($client['insurance_status']=="insured") ? 'selected' : '')?>>Insured</option>
                          <option value="not_insured" <?php echo (($client['insurance_status']=="not_insured") ? 'selected' : '')?>>Not Insured</option>
                          </select>
                      </div>
                  </div>
                  
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Insurance Company Number: *</label>
                      <div class="col-sm-3">
                          <input type="text"  value='<?php echo ($client['insurance_comp_no']) ? htmlspecialchars($client['insurance_comp_no']) : '';?>' class="form-control numeric" id="ins_com_num" name='ins_com_num' required>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Insurance Company: *</label>
                      <div class="col-sm-3">
                          <input type="text"  value='<?php echo ($client['insurance_comp']) ? htmlspecialchars($client['insurance_comp']) : '';?>' class="form-control " id="ins_co" name='ins_co' required>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Policy Number: *</label>
                      <div class="col-sm-3">
                          <input type="text"  value='<?php echo ($client['policy_no']) ? htmlspecialchars($client['policy_no']) : '';?>' class="form-control numeric" id="policy_num" name='policy_num' required>
                      </div>
                  </div>

                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Expiration Date: *</label>
                      <div class="col-sm-3">
                      <input type="text"  value='<?php echo ($client['exp_date']) ? htmlspecialchars(date_format(date_create($client['exp_date']),"m/d/Y")) : '';?>' class="form-control date_picker" id="exp_date" name='exp_date' required>
                      </div>
                  </div>
                  <div class="form-group">
                  <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="submit">Save</button>
                  </div>
                  </div>
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
</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>
