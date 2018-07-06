<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
if(empty($data)){
    redirect("ci_checking.php");
}
$tab=4;

$trades=$con->myQuery("SELECT * FROM neighbor_check WHERE loan_id=? AND client_no=?",array($data['id'],$client['client_number']))->fetch(PDO::FETCH_ASSOC);
$lt=$con->myQuery("SELECT CONCAT(lt.code,' - ',lt.name) as code FROM loan_approval_type lt WHERE id=?",array($data['loan_type_id']))->fetch(PDO::FETCH_ASSOC);
$cf=$con->myQuery("SELECT CONCAT(cf.code,' - ',cf.name) as code FROM credit_facility cf WHERE id=?",array($data['credit_fac_id']))->fetch(PDO::FETCH_ASSOC);
$pl=$con->myQuery("SELECT CONCAT(pl.code,' - ',pl.name) as code FROM product_line pl WHERE id=?",array($data['prod_line_id']))->fetch(PDO::FETCH_ASSOC);
$mt=$con->myQuery("SELECT CONCAT(mt.code,' - ',mt.name) as code FROM marketing_type mt WHERE id=?",array($data['mark_type_id']))->fetch(PDO::FETCH_ASSOC);
$cc=$con->myQuery("SELECT CONCAT(cc.code,' - ',cc.desc) as code FROM collateral_code cc WHERE id=?",array($data['coll_code_id']))->fetch(PDO::FETCH_ASSOC);
$home_add=$client['home_no']." ".$client['home_brgy'].", ".$client['home_city']." ".$client['home_zip'];
$bus_add=$client['bus_no']." ".$client['bus_brgy'].", ".$client['bus_city']." ".$client['bus_zip'];
$gar_add=$client['gar_no']." ".$client['gar_brgy'].", ".$client['gar_city']." ".$client['gar_zip'];
$deal=$con->myQuery("SELECT CONCAT(lname,', ',fname,' ',ename,' ',mname) as name FROM client_list WHERE client_number=?",array($data['dealer_id']))->fetch(PDO::FETCH_ASSOC);
$sale=$con->myQuery("SELECT CONCAT(lname,', ',fname,' ',ename,' ',mname) as name FROM client_list WHERE client_number=?",array($data['salesman_id']))->fetch(PDO::FETCH_ASSOC);

?>
	<?php
		Alert();
		
	?>
            <center><h3><b>RESIDENCE / NEIGHBORHOOD CHECKINGS</b></h3></center>
            <!-- <div style='width:100%;border:3px solid black;margin:0;'><br>
            <table style='width: 100% !important;margin-left:10%;display:block !important;'>
            <tr><td width='20%'><b>Application Number</b></td><td>: <?php echo $data['app_no'];?></td><td width='22%'><b>Application Type</b></td><td width='25%'>: <?php echo ucwords($data['app_type']);?></td></tr>
            <tr><td><b>Client Number</b></td><td>: <?php echo $client['client_number'];?></td><td ><b>Client Status</b></td><td>: <?php if($client['status_id']=='1'){echo "New";}else{echo "Old";}?></td></tr>
            <tr><td><b>Name</b></td><td>: <?php echo $cname;?></td><td ><b>Spouse</b></td><td>: <?php echo $client['spouse'];?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Dealer</b></td><td>: <?php echo $deal['name'];?></td><td><b>Salesman</b></td><td>: <?php echo $sale['name'];?></td></tr>
            <tr><td><b>Loan Type</b></td><td>: <?php echo $lt['code'];?></td><td ><b>Credit Facility</b></td><td>: <?php echo $cf['code'];?></td></tr>
            <tr><td><b>Product Line</b></td><td>: <?php echo $pl['code'];?></td><td ><b>Marketing Type</b></td><td>: <?php echo $mt['code'];?></td></tr>
            <tr><td ><b>Collateral Code</b></td><td>: <?php echo $cc['code'];?></td><td><b>Unit Description</b></td><td>: <?php echo $data['unit_desc'];?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Amount Financed</b></td><td>: <?php echo $data['amt_fin'];?></td><td><b>Residual Value</b></td><td>: <?php echo $data['res_val'];?></td></tr>
            <tr><td><b>Down Payment</b></td><td>: <?php echo $data['down_pay'];?></td><td><b>List Price</b></td><td>: <?php echo $data['list_pri'];?></td></tr>
            <tr><td><b>Term</b></td><td>: <?php echo $data['term'];?></td><td ><b>Interest Rate</b></td><td>: <?php echo $data['int_rate'];?></td></tr>
            <tr><td><b>Monthly Amortization</b></td><td>: <?php echo $data['mon_amor'];?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Home Address</b></td><td colspan='3'>: <?php echo $home_add;?></td></tr>
            <tr><td><b>Business Address</b></td><td colspan='3'>: <?php echo $bus_add;?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Business Tel. No</b></td><td>: <?php echo $client['bus_tel'];?></td><td ><b>Home Tel. No</b></td><td>: <?php echo $client['home_tel'];?></td></tr>
            </table><br>
            </div> -->
            <div class="text-center">
            <!-- <a href="word.php?id=<?php echo $_GET['id'];?>"><button type="button" class="btn btn-success no-print">Download Template</button></a> -->
            </div><br>
                <form action="save_neighbor_checking.php" method="post" class="form-horizontal" id='frmclear'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <input type='hidden' name='tab' id='tab' value="<?php echo !empty($_GET['tab'])?htmlspecialchars($_GET['tab']):''?>">
                <input type='hidden' name='client_no' id='client_no' value="<?php echo !empty($client['client_number'])?htmlspecialchars($client['client_number']):''?>">
                <div class='form-group'>
                     <label class="col-md-3 control-label">Date : </label>
                      <div class="col-md-3">
                      <input type="text"  value='<?php echo !empty($trades)?htmlspecialchars($trades['date_applied']):''; ?>' class="form-control date_picker" id="date_applied" name='date_applied' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Subject : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" placeholder="Subject" value='<?php echo !empty($cname)?htmlspecialchars($cname):''; ?>' readonly>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Spouse : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" placeholder="Spouse" value='<?php echo !empty($client)?htmlspecialchars($client['spouse']):''; ?>' readonly>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Present Address : </label>
                      <div class="col-md-8">
                      <textarea class='form-control' placeholder='Previous Address' readonly><?php echo !empty($home_add)?htmlspecialchars($home_add):''; ?></textarea>
                      </div>
                  </div>
                <div class='form-group'>
                     <label class="col-md-3 control-label">Tel. No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="tel_no" name='tel_no' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['tel_no']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Cell Phone No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="cel_no" name='cel_no' placeholder="Cell Phone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['cel_no']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Length of Stay : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="leng_stay" name='leng_stay' placeholder="Length of Stay" value='<?php echo !empty($trades)?htmlspecialchars($trades['leng_stay']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='acquire' value='owned' <?php if($trades['acquire']=='owned'){echo "checked";}?> > Owned
                    </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='acquire' value='free' <?php if($trades['acquire']=='free'){echo "checked";}?>> Provided free by:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Name:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="free_name" name='free_name' placeholder="Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['free_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Relationship:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="free_rel" name='free_rel' placeholder="Relationship" value='<?php echo !empty($trades)?htmlspecialchars($trades['free_rel']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="free_tel" name='free_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['free_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='acquire' value='rent' <?php if($trades['acquire']=='rent'){echo "checked";}?>> Rented:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Landlord:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="rent_name" name='rent_name' placeholder="Landlord Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['rent_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Monthly Rental:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="rent_pay" name='rent_pay' placeholder="Monthly Rental" value='<?php echo !empty($trades)?htmlspecialchars($trades['rent_pay']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="rent_tel" name='rent_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['rent_tel']):''; ?>'  >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='acquire' value='mort' <?php if($trades['acquire']=='mort'){echo "checked";}?>> Mortgage:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Bank / Financing:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="mort_name" name='mort_name' placeholder="Bank / Financing" value='<?php echo !empty($trades)?htmlspecialchars($trades['mort_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Monthly Rental:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="mort_pay" name='mort_pay' placeholder="Monthly Paymebt" value='<?php echo !empty($trades)?htmlspecialchars($trades['mort_pay']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="mort_tel" name='mort_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['mort_tel']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Previous Address if less than 2 years: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='prev_add' id='prev_add' placeholder='Previous Address' ><?php echo !empty($trades)?htmlspecialchars($trades['prev_add']):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Other Provincial Address: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='other_add' id='other_add' placeholder='Provincial Address' ><?php echo !empty($trades)?htmlspecialchars($trades['other_add']):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Tel. No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="other_tel" name='other_tel' placeholder="Provincial Address Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Description / Improvements: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='desc_imp' id='desc_imp' placeholder='Description / Improvements'><?php echo !empty($trades)?htmlspecialchars($trades['desc_imp']):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Equipped With: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='equip_with' id='equip_with' placeholder='Equipments'><?php echo !empty($trades)?htmlspecialchars($trades['equip_with']):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-inline'>
                     <label class="col-md-3 control-label">Living Condition: </label>
                      <div class="col-md-8">
                        <input type='radio' name='liv_con' value='good' <?php if($trades['liv_con']=='good'){ echo "checked";}?> > Good &emsp;
                        <input type='radio' name='liv_con' value='fair' <?php if($trades['liv_con']=='fair'){ echo "checked";}?> > Fair &emsp;
                        <input type='radio' name='liv_con' value='poor' <?php if($trades['liv_con']=='poor'){ echo "checked";}?> > Poor &emsp;
                        <input type='radio' name='liv_con' value='tidy' <?php if($trades['liv_con']=='tidy'){ echo "checked";}?> > Tidy &emsp;
                        <input type='radio' name='liv_con' value='untidy' <?php if($trades['liv_con']=='untidy'){ echo "checked";}?> > Untidy &emsp;
                        <input type='radio' name='liv_con' value='adequate' <?php if($trades['liv_con']=='adequate'){ echo "checked";}?> > Adequate &emsp;
                        <input type='radio' name='liv_con' value='other' <?php if($trades['liv_con']=='other'){ echo "checked";}?> > Others <input type="text" class="form-control" id="liv_con_oth" name='liv_con_oth' placeholder="Others" value='<?php echo !empty($trades)?htmlspecialchars($trades['liv_con_oth']):''; ?>'>
                      </div>
                  </div><br><br><br>
                  <div class='form-inline'>
                     <label class="col-md-3 control-label">Neighborhood: </label>
                      <div class="col-md-8">
                        <input type='radio' name='neigh_spec' value='residential' <?php if($trades['neigh_spec']=='residential'){ echo "checked";}?> > Residential &emsp;
                        <input type='radio' name='neigh_spec' value='commercial' <?php if($trades['neigh_spec']=='commercial'){ echo "checked";}?> > Commercial &emsp;
                        <input type='radio' name='neigh_spec' value='subdivision' <?php if($trades['neigh_spec']=='subdivision'){ echo "checked";}?> > Subdivision &emsp;
                        <input type='radio' name='neigh_spec' value='gov_proj' <?php if($trades['neigh_spec']=='gov_proj'){ echo "checked";}?> > Gov't Project &emsp;
                        <input type='radio' name='neigh_spec' value='slum' <?php if($trades['neigh_spec']=='slum'){ echo "checked";}?> > Slum Area &emsp;<br>
                        <input type='radio' name='neigh_spec' value='other' <?php if($trades['neigh_spec']=='other'){ echo "checked";}?> > Others <input type="text" class="form-control" id="neigh_spec_oth" name='neigh_spec_oth' placeholder="Others" value='<?php echo !empty($trades)?htmlspecialchars($trades['neigh_spec_oth']):''; ?>'>
                      </div>
                  </div><br><br><br><br>
                  <div class='form-inline'>
                     <label class="col-md-3 control-label">Accessible to: </label>
                      <div class="col-md-8">
                        <input type='radio' name='access_to' value='bus' <?php if($trades['access_to']=='bus'){ echo "checked";}?> > Residential &emsp;
                        <input type='radio' name='access_to' value='jeep' <?php if($trades['access_to']=='jeep'){ echo "checked";}?> > Commercial &emsp;
                        <input type='radio' name='access_to' value='tric' <?php if($trades['access_to']=='tric'){ echo "checked";}?> > Subdivision &emsp;
                        <input type='radio' name='access_to' value='car' <?php if($trades['access_to']=='car'){ echo "checked";}?> > Gov't Project &emsp;
                        <input type='radio' name='access_to' value='no_access' <?php if($trades['access_to']=='no_access'){ echo "checked";}?> > Slum Area &emsp;<br>
                      </div>
                  </div><br><br>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Subject's Reputation in the neighborhood: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='subj_rep' id='subj_rep' placeholder="Subject's Reputation" ><?php echo !empty($trades)?htmlspecialchars($trades['subj_rep']):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Direction: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='direction' id='direction' placeholder="Direction" ><?php echo !empty($trades)?htmlspecialchars($trades['direction']):''; ?></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-10 col-md-offset-1 text-center">
                    <button type='submit' class='btn btn-warning'>Save </button>
                    </div>
                </div>        
                </form>
<?php
    $request_type="submit_ci";
    require_once("../include/modal_trade_check.php");
?>
<?php 
  if(!empty($trades)):
?>
<script type="text/javascript">
  $(function(){
    $('#hide').collapse({
      toggle: true
    })    
  });
</script>
<?php
  endif;
?>
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
