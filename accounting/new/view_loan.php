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
if(!empty($_GET['id'])){
    $data=$con->myQuery("SELECT * FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
  }
?>

<div class="content-wrapper">
        <section class="content-header">
              
              <h1 class="text-primary text-center">Loan Check Approval</h1>                
                
                <ol class="breadcrumb">
                  <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                 
                  <li><a href="loan_approval.php" ><i class="fa fa-file"></i> Loan Approval</a></li>
                  <li class="active">View Loan Approval  </li>
                </ol>

        </section>
        <section class="content-header">
            <?php
                Alert();
                
            ?>
            <div class="box">
                <div class="box-body">
                
                    <a href='loan_approval.php' class="btn btn-default"><span class="fa fa-arrow-left"></span> Back</a><br><br>
                        <div class="row">
                            <form action="save_view_loan.php" method="post" class="form-horizontal" id='frmclear'>
                                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                                
                                <div class='form-group'>
                                    <label class="col-md-3 control-label">Application Number: </label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control numeric" id="app_no" name='app_no' placeholder="Application Number" value='<?php echo !empty($data)?htmlspecialchars($data['app_no']):''; ?>' disabled>
                                    </div>
                                    <label class="col-md-2 control-label">Client Number: </label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number" value='<?php echo !empty($data)?htmlspecialchars($data['client_no']):''; ?>' required disabled>
                                    </div>
                                
                                </div>
                                <div class='form-group'>
                                    <label class="col-md-3 control-label">Last Name: </label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="lname" name='lname' placeholder="Last Name" value='<?php echo !empty($data)?htmlspecialchars($data['last_name']):''; ?>' required>
                                    </div>
                                    <label class="col-md-2 control-label">First Name: </label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="fname" name='fname' placeholder="First Name" value='<?php echo !empty($data)?htmlspecialchars($data['first_name']):''; ?>' required>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class="col-md-3 control-label">Spouse: </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" id="spouse" name='spouse' placeholder="Spouse" value='<?php echo !empty($data)?htmlspecialchars($data['spouse']):''; ?>'>
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
                                        <textarea class='form-control' name='bus_add' id='bus_add' required><?php echo !empty($data)?htmlspecialchars($data['bus_add']):''; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="address1" class="col-md-3 control-label">Home Address: </label>
                                <div class="col-md-8">
                                    <textarea class='form-control' name='home_add' id='home_add' required><?php echo !empty($data)?htmlspecialchars($data['home_add']):''; ?> </textarea>
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="email" class="col-md-3 control-label">Email Address: </label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" id="email" placeholder="Email Address" name='email' value='<?php echo !empty($data)?htmlspecialchars($data['email_add']):''; ?>' required>
                                </div>
                                </div>
                                <div class='form-group'>
                                    <label class="col-sm-3 control-label">Business Tel. No: </label>
                                    <div class='col-sm-3'>
                                        <input type="text" class="form-control" id="bus_tel" placeholder="Business Telephone Number" name='bus_tel' value='<?php echo !empty($data)?htmlspecialchars($data['bus_tel']):''; ?>' required>
                                    </div>
                                    <label class="col-sm-2 control-label">Home Tel. No: </label>
                                    <div class='col-sm-3'>
                                    <input type="text" class="form-control" id="home_tel" placeholder="Home Telephone Number" name='home_tel' value='<?php echo !empty($data)?htmlspecialchars($data['home_tel']):''; ?>' required>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class="col-sm-3 control-label">Primary Contact No: </label>
                                    <div class='col-sm-3'>
                                        <input type="text" class="form-control" id="pri_con" placeholder="Primary Contact Number" name='pri_con' value='<?php echo !empty($data)?htmlspecialchars($data['pri_con']):''; ?>' required>
                                    </div>
                                    <label class="col-sm-2 control-label">Secondary Contact No: </label>
                                    <div class='col-sm-3'>
                                    <input type="text" class="form-control" id="sec_con" placeholder="Secondary Contact Number" name='sec_con' value='<?php echo !empty($data)?htmlspecialchars($data['sec_con']):''; ?>'>
                                    </div>
                                </div><br>
                                <div class='form-group'>
                                    <label class="col-sm-5 control-label">Loan Receivable Type: </label>
                                    <div class='col-sm-3'>
                                        <select class='form-control cbo' name='loan_receivable_type' id='loan_type' data-placeholder="Select Loan Receivable Type" required>
                                            <option value=''></option>
                                            <option value='1'>Check Voucher</option>
                                            <option value='2'>Journal Voucher</option>
                                        </select>
                                    </div>
                                    
                                </div><br>

                                <div class="form-group">
                                    <div class="col-sm-11 col-md-offset-1 text-center">
                                        <button type='submit' class='btn btn-primary'>Approve </button>
                                        
                                        <a href="../php/reject.php?id=<?php echo $_GET['id']; ?>&type=loan" class='btn btn-danger'>Reject</a>
                                    </div>
                                </div>
                            </form>
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
