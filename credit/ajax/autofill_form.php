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
// $a = substr($_GET['id'], 0, 1);
// if ($a == "o")
// {
// 	$_GET['request_type'] = "overtime";
// 	$_GET['id'] = ltrim($_GET['id'],'o');
// }
// if ($a == "p")
// {
// 	$_GET['request_type'] = "pre_overtime";
// 	$_GET['id'] = ltrim($_GET['id'],'p');
// }
if((!empty($_GET['id']))OR(!empty($_GET['lname']))){

    if(!empty($_GET['id'])){
		$messages=$con->myQuery("SELECT client_number,lname,fname,spouse,
        CONCAT(home_no,' ',home_brgy,', ',home_city,' ',home_zip) AS home_add,
        CONCAT(bus_no,' ',bus_brgy,', ',bus_city,' ',bus_zip) AS bus_add,email,
        bus_tel,home_tel,pri_con,sec_con
        FROM client_list
         WHERE client_number=?",array($_GET['id']))->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $messages=$con->myQuery("SELECT client_number,lname,fname,spouse,
        CONCAT(home_no,' ',home_brgy,', ',home_city,' ',home_zip) AS home_add,
        CONCAT(bus_no,' ',bus_brgy,', ',bus_city,' ',bus_zip) AS bus_add,email,
        bus_tel,home_tel,pri_con,sec_con
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
						<label class="col-md-2 control-label">Client Number: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number" value='<?php echo !empty($data)?htmlspecialchars($data['client_no']):''; ?>' required>
                      </div>
                  </div>
                   <div class='form-group'>
                     <label class="col-md-3 control-label">Last Name: </label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='lname' id='lname' data-placeholder="Select Loan Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['lname']):''; ?>' required>
                                <?php echo makeOptions($lname1); ?>
                            </select>
                      </div>
                      <label class="col-md-2 control-label">First Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="fname" name='fname' placeholder="First Name" value='<?php echo !empty($data)?htmlspecialchars($data['first_name']):''; ?>' readonly>
                      </div>
                  </div>
                     <div class='form-group'>
                      <label class="col-md-3 control-label">Spouse: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse" name='spouse' placeholder="Spouse" value='<?php echo !empty($data)?htmlspecialchars($data['spouse']):''; ?>' readonly>
                      </div>
                  </div>
                  <hr>
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
                    </div>
                    <hr>
                   <div class="form-group">
				      <label for="address1" class="col-md-3 control-label">Business Address: </label>
				      <div class="col-md-8">
				      	<textarea class='form-control' name='bus_add' id='bus_add' readonly><?php echo !empty($data)?htmlspecialchars($data['bus_add']):''; ?></textarea>
				      </div>
				    </div>
				     <div class="form-group">
				      <label for="address1" class="col-md-3 control-label">Home Address: </label>
				      <div class="col-md-8">
				      	<textarea class='form-control' name='home_add' id='home_add' readonly><?php echo !empty($data)?htmlspecialchars($data['home_add']):''; ?> </textarea>
				      </div>
				    </div>
				     <div class="form-group">
				      <label for="email" class="col-md-3 control-label">Email Address: </label>
				      <div class="col-md-8">
				        <input type="email" class="form-control" id="email" placeholder="Email Address" name='email' value='<?php echo !empty($data)?htmlspecialchars($data['email_add']):''; ?>' readonly>
				      </div>
				    </div>
				      <div class='form-group'>
                        <label class="col-sm-3 control-label">Business Tel. No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control" id="bus_tel" placeholder="Business Telephone Number" name='bus_tel' value='<?php echo !empty($data)?htmlspecialchars($data['bus_tel']):''; ?>' readonly>
                        </div>
	                    <label class="col-sm-2 control-label">Home Tel. No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="home_tel" placeholder="Home Telephone Number" name='home_tel' value='<?php echo !empty($data)?htmlspecialchars($data['home_tel']):''; ?>' readonly>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Primary Contact No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control" id="pri_con" placeholder="Primary Contact Number" name='pri_con' value='<?php echo !empty($data)?htmlspecialchars($data['pri_con']):''; ?>' readonly>
                        </div>
	                    <label class="col-sm-2 control-label">Secondary Contact No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="sec_con" placeholder="Secondary Contact Number" name='sec_con' value='<?php echo !empty($data)?htmlspecialchars($data['sec_con']):''; ?>' readonly>
                        </div>
                    </div>
        <?php
        }
		else{
			//echo "<ul class='timeline'>";
            foreach ($messages as $data):
            ?>			
				<div class='form-group'>
					<label class="col-md-3 control-label">Application Number: </label>
					<div class="col-md-3">
						<input type="text" class="form-control numeric" id="app_no" name='app_no' placeholder="Application Number" readonly>
					</div>
						<label class="col-md-2 control-label">Client Number: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number" value='<?php echo !empty($data)?htmlspecialchars($data['client_number']):''; ?>' required>
                      </div>
                  </div>
                   <div class='form-group'>
                     <label class="col-md-3 control-label">Last Name: </label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='lname' id='lname' data-placeholder="Select Loan Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['lname']):''; ?>' required>
                                <?php echo makeOptions($lname1); ?>
                            </select>
                      </div>
                      <label class="col-md-2 control-label">First Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="fname" name='fname' placeholder="First Name" value='<?php echo !empty($data)?htmlspecialchars($data['fname']):''; ?>' readonly>
                      </div>
                  </div>
                     <div class='form-group'>
                      <label class="col-md-3 control-label">Spouse: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse" name='spouse' placeholder="Spouse" value='<?php echo !empty($data)?htmlspecialchars($data['spouse']):''; ?>' readonly>
                      </div>
                  </div>
                  <hr>
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
                    </div>
                    <hr>
                   <div class="form-group">
				      <label for="address1" class="col-md-3 control-label">Business Address: </label>
				      <div class="col-md-8">
				      	<textarea class='form-control' name='bus_add' id='bus_add' readonly><?php echo !empty($data)?htmlspecialchars($data['bus_add']):''; ?></textarea>
				      </div>
				    </div>
				     <div class="form-group">
				      <label for="address1" class="col-md-3 control-label">Home Address: </label>
				      <div class="col-md-8">
				      	<textarea class='form-control' name='home_add' id='home_add' readonly><?php echo !empty($data)?htmlspecialchars($data['home_add']):''; ?> </textarea>
				      </div>
				    </div>
				     <div class="form-group">
				      <label for="email" class="col-md-3 control-label">Email Address: </label>
				      <div class="col-md-8">
				        <input type="email" class="form-control" id="email" placeholder="Email Address" name='email' value='<?php echo !empty($data)?htmlspecialchars($data['email']):''; ?>' readonly>
				      </div>
				    </div>
				      <div class='form-group'>
                        <label class="col-sm-3 control-label">Business Tel. No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control" id="bus_tel" placeholder="Business Telephone Number" name='bus_tel' value='<?php echo !empty($data)?htmlspecialchars($data['bus_tel']):''; ?>' readonly>
                        </div>
	                    <label class="col-sm-2 control-label">Home Tel. No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="home_tel" placeholder="Home Telephone Number" name='home_tel' value='<?php echo !empty($data)?htmlspecialchars($data['home_tel']):''; ?>' readonly>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Primary Contact No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control" id="pri_con" placeholder="Primary Contact Number" name='pri_con' value='<?php echo !empty($data)?htmlspecialchars($data['pri_con']):''; ?>' readonly>
                        </div>
	                    <label class="col-sm-2 control-label">Secondary Contact No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="sec_con" placeholder="Secondary Contact Number" name='sec_con' value='<?php echo !empty($data)?htmlspecialchars($data['sec_con']):''; ?>' readonly>
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
						<label class="col-md-2 control-label">Client Number: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number" value='<?php echo !empty($data)?htmlspecialchars($data['client_no']):''; ?>' required>
                      </div>
                  </div>
                   <div class='form-group'>
                     <label class="col-md-3 control-label">Last Name: </label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='lname' id='lname' data-placeholder="Select Loan Type" data-selected='<?php echo !empty($data)?htmlspecialchars($data['last_name']):''; ?>' required>
                                <?php echo makeOptions($lname1); ?>
                            </select>
                      </div>
                      <label class="col-md-2 control-label">First Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="fname" name='fname' placeholder="First Name" value='<?php echo !empty($data)?htmlspecialchars($data['first_name']):''; ?>' readonly>
                      </div>
                  </div>
                     <div class='form-group'>
                      <label class="col-md-3 control-label">Spouse: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse" name='spouse' placeholder="Spouse" value='<?php echo !empty($data)?htmlspecialchars($data['spouse']):''; ?>' readonly>
                      </div>
                  </div>
                  <hr>
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
                    </div>
                    <hr>
                   <div class="form-group">
				      <label for="address1" class="col-md-3 control-label">Business Address: </label>
				      <div class="col-md-8">
				      	<textarea class='form-control' name='bus_add' id='bus_add' readonly><?php echo !empty($data)?htmlspecialchars($data['bus_add']):''; ?></textarea>
				      </div>
				    </div>
				     <div class="form-group">
				      <label for="address1" class="col-md-3 control-label">Home Address: </label>
				      <div class="col-md-8">
				      	<textarea class='form-control' name='home_add' id='home_add' readonly><?php echo !empty($data)?htmlspecialchars($data['home_add']):''; ?> </textarea>
				      </div>
				    </div>
				     <div class="form-group">
				      <label for="email" class="col-md-3 control-label">Email Address: </label>
				      <div class="col-md-8">
				        <input type="email" class="form-control" id="email" placeholder="Email Address" name='email' value='<?php echo !empty($data)?htmlspecialchars($data['email_add']):''; ?>' readonly>
				      </div>
				    </div>
				      <div class='form-group'>
                        <label class="col-sm-3 control-label">Business Tel. No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control" id="bus_tel" placeholder="Business Telephone Number" name='bus_tel' value='<?php echo !empty($data)?htmlspecialchars($data['bus_tel']):''; ?>' readonly>
                        </div>
	                    <label class="col-sm-2 control-label">Home Tel. No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="home_tel" placeholder="Home Telephone Number" name='home_tel' value='<?php echo !empty($data)?htmlspecialchars($data['home_tel']):''; ?>' readonly>
                        </div>
                    </div>
                     <div class='form-group'>
                        <label class="col-sm-3 control-label">Primary Contact No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control" id="pri_con" placeholder="Primary Contact Number" name='pri_con' value='<?php echo !empty($data)?htmlspecialchars($data['pri_con']):''; ?>' readonly>
                        </div>
	                    <label class="col-sm-2 control-label">Secondary Contact No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="sec_con" placeholder="Secondary Contact Number" name='sec_con' value='<?php echo !empty($data)?htmlspecialchars($data['sec_con']):''; ?>' readonly>
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
    	// 	$('.cbo').each(function(index,element){
		//     if(typeof $(element).data("selected") !== "undefined"){
		//     $(element).val($(element).data("selected")).trigger("change");
		//     }
        // });
</script>