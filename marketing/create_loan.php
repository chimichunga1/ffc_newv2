<?php
  require_once('../support/config.php');
  if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Create Loan",1);
    
    
    require_once("../template/header.php");
    require_once("../template/sidebar.php");
    $lt=$con->myQuery("SELECT lt.id,CONCAT(lt.code,' - ',lt.name) as lt_code FROM loan_approval_type lt WHERE lt.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $cf=$con->myQuery("SELECT cf.id,CONCAT(cf.code,' - ',cf.name) as cf_code FROM credit_facility cf WHERE cf.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $pl=$con->myQuery("SELECT pl.id,CONCAT(pl.code,' - ',pl.name) as pl_code FROM product_line pl WHERE pl.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $mt=$con->myQuery("SELECT mt.id,CONCAT(mt.code,' - ',mt.name) as mt_code FROM marketing_type mt WHERE mt.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $cc=$con->myQuery("SELECT cc.id,CONCAT(cc.code,' - ',cc.desc) as cc_code FROM collateral_code cc WHERE cc.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $dl=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_dealer='checked'")->fetchAll(PDO::FETCH_ASSOC);
    $sm=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_salesman='checked'")->fetchAll(PDO::FETCH_ASSOC);
if(!empty($_GET['id'])){
    $data=$con->myQuery("SELECT * FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
    $client=$con->myQuery("SELECT * FROM client_list WHERE client_number=?",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);
    $cv=$con->myQuery("SELECT name FROM civil_status WHERE id=?",array($client['civil_status_id']))->fetch(PDO::FETCH_ASSOC);
    $bt=$con->myQuery("SELECT name FROM business_type WHERE id=?",array($client['bus_type_id']))->fetch(PDO::FETCH_ASSOC);
    $co=$con->myQuery("SELECT name FROM country WHERE id=?",array($client['country_id']))->fetch(PDO::FETCH_ASSOC);
    $ic=$con->myQuery("SELECT name FROM industry_code WHERE id=?",array($client['ind_code_id']))->fetch(PDO::FETCH_ASSOC);
    $re=$con->myQuery("SELECT name FROM region WHERE id=? AND country_id=?",array($client['region_id'],$client['country_id']))->fetch(PDO::FETCH_ASSOC);
    $ct=$con->myQuery("SELECT name FROM client_type WHERE id=?",array($client['client_type_id']))->fetch(PDO::FETCH_ASSOC);
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
  <h3> Loan Management Form </h3>
  </center>
  <hr>
  <a href='loan_management.php'>
  <button type='button' class="btn btn-default"><span class="fa fa-arrow-left"></span> Employee Loan</button></a><br><br>
      <div class="row">
                <form action="save_create_loan.php" method="post" class="form-horizontal" id='frmclear'>
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
                  <label class="col-md-3 control-label">Last Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="lname" name='lname' placeholder="Last Name" value='<?php echo !empty($client)?htmlspecialchars($client['lname']):''; ?>' readonly>
                      </div>
                  <label class="col-md-2 control-label">Client Number: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number" value='<?php echo !empty($data)?htmlspecialchars($data['client_no']):''; ?>' readonly>
                      </div>
                  </div>
                   <div class='form-group'>
                      <label class="col-md-3 control-label">First Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="fname" name='fname' placeholder="First Name" value='<?php echo !empty($client)?htmlspecialchars($client['fname']):''; ?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Client Status: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="cli_stat" name='cli_stat' placeholder="Client Status" value='<?php if($client['status_id']=='0'){ echo "Old";}elseif($client['status_id']=='1'){echo "New";}?>' readonly>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-md-3 control-label">Spouse: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse" name='spouse' placeholder="Spouse" value='<?php echo !empty($client)?htmlspecialchars($client['spouse']):''; ?>' readonly>
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
                        <label class="col-md-2 control-label">List Cash Price: </label>
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
                    <center><b>Home Address</b></center><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_no" name='home_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($client)?htmlspecialchars($client['home_no']):''; ?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_brgy" name='home_brgy' placeholder="Barangay" value='<?php echo !empty($client)?htmlspecialchars($client['home_brgy']):''; ?>' readonly>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_city" name='home_city' placeholder="City" value='<?php echo !empty($client)?htmlspecialchars($client['home_city']):''; ?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="home_zip" name='home_zip' placeholder="Zip Code" value='<?php echo !empty($client)?htmlspecialchars($client['home_zip']):''; ?>' readonly>
                      </div>
                  </div>
                  <center><b>Business Address</b><br><br>
                  <input type='checkbox' name='same_add' id='same_add' <?php echo !empty($client)?htmlspecialchars($client['same_add']):''; ?> disabled><i> Check if Business Address is the same as Home Address</i></center>
                  <div id="autoUpdate" class="autoUpdate"><br>
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Blk# / Bldg. No. / St. Name: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_no" name='bus_no' placeholder="Blk # / Building No. / Street Name" value='<?php echo !empty($client)?htmlspecialchars($client['bus_no']):''; ?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Barangay: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_brgy" name='bus_brgy' placeholder="Barangay" value='<?php echo !empty($client)?htmlspecialchars($client['bus_brgy']):''; ?>' readonly>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">City: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_city" name='bus_city' placeholder="City" value='<?php echo !empty($client)?htmlspecialchars($client['bus_city']):''; ?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Zip Code: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="bus_zip" name='bus_zip' placeholder="Zip Code" value='<?php echo !empty($client)?htmlspecialchars($client['bus_zip']):''; ?>' readonly>
                      </div>
                  </div>
                  </div>
                  <hr>
              <div class='form-group'>
                        <label class="col-sm-3 control-label">Business Tel. No: </label>
                        <div class='col-sm-3'>
                            <input type="text" class="form-control" id="bus_tel" placeholder="Business Telephone Number" name='bus_tel' value='<?php echo !empty($client)?htmlspecialchars($client['bus_tel']):''; ?>' readonly>
                        </div>
                      <label class="col-sm-2 control-label">Home Tel. No: </label>
                        <div class='col-sm-3'>
                           <input type="text" class="form-control" id="home_tel" placeholder="Home Telephone Number" name='home_tel' value='<?php echo !empty($client)?htmlspecialchars($client['home_tel']):''; ?>' readonly>
                        </div>
                    </div><br>
                    <?php }?>
                         <div class="form-group">
                <div class="col-sm-11 col-md-offset-1 text-center">
                  <button type='submit' class='btn btn-primary'>Save </button>
                  <a href='loan_management.php' class='btn btn-default'>Cancel</a>
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

    $("#dealer").on('change',function(){
        if(document.getElementById("dealer").selectedIndex > 0){
            $("#salesman").attr('disabled',false);
        }else{
            $("#salesman").attr('disabled',true);
        }
    });
</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>
