<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Collateral Entry",1);
    
    
    require_once("../template/header.php");
    require_once("../template/sidebar.php");
 
    $data=$con->myQuery("SELECT * FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
    if(empty($_GET['id']) || empty($data)){
        redirect('collateral_form.php');
        Alert('User not found','success');
    }
    $ml = "";
    if(isset($_GET['ml'])){
        $ml = "&ml";
    }
    if(isset($_GET['edit'])){
        if(empty($_GET['edit'])){
            // redirect('collateral_form.php');
            Alert('Collateral Info not found','warning');
        }
        $auth = $con->myQuery("SELECT * FROM collateral_info WHERE id = ? AND loan_list_id = ? AND is_deleted = 0",array($_GET['edit'],$_GET['id']));
        if($auth->rowCount() <= 0 ){
            // redirect('collateral_form.php');
            Alert('Collateral Info not found','warning');
        }
        $collatInfo = $auth->fetch(PDO::FETCH_ASSOC);
    }
    $client = $con->myQuery("SELECT CONCAT(fname,' ' , mname, ' ' , lname) as client_fullname, client_number FROM client_list WHERE client_number=?",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);

?>

<div class="content-wrapper">
	
<section class="content-header">
	<?php
		Alert();
		
	?>
	<div class="box">
	<div class="box-body">
	<center>
	<h3> Collateral Entry </h3>
	</center>
    <a href='collateral_list.php?id=<?=$data['id'].$ml;?>'>
	<button type='button' class="btn btn-default"><span class="fa fa-arrow-left"></span> Collateral List</button></a><br><br>
	<hr>
			<div class="row">
                <form action="save_collateral.php" method="post" class="form-horizontal" id='frmCollat' >
                <input type='hidden' name='id' id='id' value="<?=$data['id'];?>">
                <input type="hidden" name="tbl_id" id="tbl_id" value="<?php echo $collatInfo['id'] ?>">
                <input type="hidden" name="ml" value="<?php echo $ml;?>">
                	 <div class='form-group'>
                     <label class="col-md-3 control-label">Client Number: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="client_no" name='client_no' value='<?php echo htmlspecialchars($client['client_number']); ?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Client Name: </label>
                      <div class="col-md-3">
                      <input type="text" class="form-control" id="client_name" name='client_name'  value='<?php echo htmlspecialchars($client['client_fullname']); ?>' readonly>
                      </div>
                  </div>
                   <div class='form-group'>
                     <label class="col-md-3 control-label">Assignee:</label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" id="assignee" name='assignee' value="<?php echo empty($collatInfo['assignee'])?'':$collatInfo['assignee']; ?>" placeholder="Assignee" >
                      </div>
                    <br><br>
                    <hr>
                  </div>
                     <div class='form-group'>
                      <label class="col-md-3 control-label">Unit Description / Lot Dimension:</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="unit_lot_d" name='unit_lot_d' value="<?php echo empty($collatInfo['unit_description'])?'':$collatInfo['unit_description']; ?>" placeholder="Unit Description / Lot Dimension" >
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Motor no. / Location:</label>
                      <div class="col-sm-3">
                          <input type="text"  class="form-control " id="motor_no_location" value="<?php echo empty($collatInfo['location_motor'])?'':$collatInfo['location_motor']; ?>" placeholder="Motor no. / Location" name='motor_no_location' >
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Chassis no. / TCT no.:</label>
                      <div class="col-sm-3">
                          <input type="text"  class="form-control" id="chassis_tct_no" value="<?php echo empty($collatInfo['tct_no'])?'':$collatInfo['tct_no']; ?>" placeholder="Chassis no. / TCT no." name='chassis_tct_no' >
                      </div>
                  </div>
                  <hr>
                  <div class="form-group">
				      <label for="text" class="col-sm-3 control-label">Plate no.:</label>
				      <div class="col-sm-3">
				        <input type="text" class="form-control" id="plate_no" name='plate_no' value="<?php echo empty($collatInfo['plate_no'])?'':$collatInfo['plate_no']; ?>" placeholder="Plate no."  >
				      </div>
                      <label class="col-sm-2 control-label">LCP / Approve value:</label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control ls-type" id="lcp" name='lcp' value="<?php echo !empty($collatInfo)?isEmptyFloat($collatInfo['approve_value']):''; ?>" placeholder="LCP / Approve value" >
                        </div>
				    </div>
                    <div class="form-group">
				      <label for="text" class="col-sm-3 control-label">O.R no.:</label>
				      <div class="col-sm-3">
				        <input type="text" class="form-control numeric" id="or_no" name='or_no' value='<?php echo !empty($collatInfo['or_no'])?$collatInfo['or_no']:'';?>' placeholder="O.R no." >
				      </div>
                      <label class="col-sm-2 control-label">Latest O.R Date:</label>
                      <div class="col-md-3">
                      <input type="text"  class="form-control date_picker" value="<?php echo !empty($collatInfo)?isEmptyDate($collatInfo['or_date']):''; ?>" id="or_date" placeholder="Latest O.R Date" name='or_date' >
                      </div>
				    </div>
                    <div class="form-group">
				      <label for="email" class="col-sm-3 control-label">C.R no.:</label>
				      <div class="col-sm-3">
				        <input type="text" class="form-control" id="cr_no"  name='cr_no' value="<?php echo empty($collatInfo['cr_no'])?'':$collatInfo['cr_no']; ?>" placeholder="C.R no." value='' >
				      </div>
                      <label class="col-sm-2 control-label">with Stencile: </label>
                        <div class='col-sm-3'>
                           <select name="stencile" id="stencile" class="form-control cbo" data-allow-clear="true" data-placeholder="Stencile" data-selected="<?php echo empty($collatInfo['with_stencile'])?'':$collatInfo['with_stencile']; ?>" style="width:100%;">
                           <option value=""></option>
                           <option value="yes">Yes</option>
                           <option value="no">No</option>
                           </select>
                        </div>
				    </div>
                    <div class='form-group'>
                      <label class="col-sm-3 control-label">LTO Agency:</label>
                      <div class="col-sm-3">
                          <input type="text"  class="form-control " id="lto_agency" name='lto_agency' value="<?php echo empty($collatInfo['lto_agency'])?'':$collatInfo['lto_agency']; ?>" placeholder="LTO Agency" >
                      </div>
                  </div>
                    <hr>
                    <div class='form-group'>
                      <label class="col-sm-3 control-label">Insurance status:</label>
                      <div class="col-sm-3">
                          <select name="insurance_status" id="insurance_status" class="form-control cbo" data-allow-clear="true" data-selected="<?php echo empty($collatInfo['insurance_status'])?'':$collatInfo['insurance_status']; ?>" data-placeholder="Insurance Status">
                          <option value="" ></option>
                          <option value="insured" >Insured</option>
                          <option value="not_insured">Not Insured</option>
                          </select>
                      </div>
                  </div>
                  
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Insurance Company Number:</label>
                      <div class="col-sm-3">
                          <input type="text"  class="form-control" id="ins_com_num"  name='ins_com_num' value="<?php echo empty($collatInfo['insurance_comp_no'])?'':$collatInfo['insurance_comp_no']; ?>" placeholder="Insurance Company Number" readonly>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Insurance Company:</label>
                      <div class="col-sm-3">
                          <input type="text"  class="form-control " id="ins_co" value="<?php echo empty($collatInfo['insurance_comp'])?'':$collatInfo['insurance_comp']; ?>" name='ins_co' placeholder="Insurance Company" readonly>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Policy Number:</label>
                      <div class="col-sm-3">
                          <input type="text"  class="form-control" id="policy_num" name='policy_num'  value="<?php echo empty($collatInfo['policy_no'])?'':$collatInfo['policy_no']; ?>" placeholder="Policy Number" readonly>
                      </div>
                  </div>

                  <div class='form-group'>
                      <label class="col-sm-3 control-label">Expiration Date:</label>
                      <div class="col-sm-3">
                      <input type="text"  class="form-control date_picker" id="exp_date" name='exp_date' value="<?php echo !empty($collatInfo)?isEmptyDate($collatInfo['exp_date']):''; ?>" placeholder="Expiration Date" readonly disabled>
                      </div>
                  </div>
                  <div class="form-group">
                  <div class="text-center">
                  <?php if(empty($collatInfo)) :?>
                  <input type="hidden" name="submit_type" value="create">
                  <button type="submit" class="btn btn-primary" id="SaveCollat" data-submit-title="Saving data..." name="submit">Save</button>
                  <?php else:?>
                  <input type="hidden" name="submit_type" value="edit">
                  <button type="submit" class="btn btn-info" id="SaveCollat" data-submit-title="Saving data..." name="submit">Update</button>
                  <?php endif; ?>
                  <a href="collateral_list.php?id=<?php echo $data['id']; ?>" class="btn btn-default">Cancel</a>
                  </div>
                  </div>
                </form>
            </div>		
		</div>
	</div>
	</div>
</section>




 
</div>


<script>
$(document).ready(function () {
           
    $('#insurance_status').change(function() {
        isLocked($(this).val());
    });

     $('.form-horizontal').on('submit', function() {
        var self = $(this),
            button = self.find('button[type="submit"], button'),
            submitVal = button.data('submit-title');
            // console.log(submitVal);
        button.attr('disabled','disabled').html((submitVal)?submitVal:'Processing...');
        
    });

function isLocked(val) {
    if(val == 'insured'){
           $('#ins_com_num, #ins_co, #policy_num, #exp_date').attr('readonly',false);
           $('#exp_date').attr('disabled',false);
       }else{
        $('#ins_com_num, #ins_co, #policy_num, #exp_date').attr('readonly',true).val('');
        $('#exp_date').attr('disabled',true).val('');
       }
}


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



});


     

</script>
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
