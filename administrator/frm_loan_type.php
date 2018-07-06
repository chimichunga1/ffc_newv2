<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1))){
  redirect("../index.php");
}

makeHead("Frm Loan Type",1);

require_once("../template/header.php");
require_once("../template/sidebar.php");
$view = FALSE;
if (!empty($_GET['id'])) {
	$data=$con->myQuery("SELECT * FROM loan_approval_type WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
        $view = TRUE;
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
	<h3> Loan Type Form </h3>
	</center>
	<hr>
			<div class="row">
                <form action="save_loan_type.php" method="post" class="form-horizontal" id='frmclear'>
                  <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                	 <div class='form-group'>
                     <label class="col-md-4 control-label">Loan Type Code: </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="loan_code" name='loan_code' placeholder="Loan Type Code" value='<?php echo !empty($data)?htmlspecialchars($data['code']):''; ?>' required>
                      </div>
                  </div>
                   <div class='form-group'>
                     <label class="col-md-4 control-label">Loan Type Name: </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="loan_name" name='loan_name' placeholder="Loan Type Name" value='<?php echo !empty($data)?htmlspecialchars($data['name']):''; ?>' required>
                      </div>
                  </div> 
                  <div class="col-sm-11 col-md-offset-1 text-center">
                    <button type='submit' class='btn btn-primary'>Save </button>
                    <a href='loan_type.php' class='btn btn-default'>Cancel</a><br>
                </div>
                </form>
            </div>		
            <br>
            <?php if($view) :?>
        <div class="form-group justify-content-md-center">
            <div class="col-md-3"></div>
            <div class="col-md-3">
            <a href='frm_requirement_caf.php?id=<?php echo $data['id'];?>'><button type="submit" class="btn btn-info" id="btn-add" name="btnadd" style="float:right;"><i class="fa fa-plus"> Add Requirements(Credit Advicing Form)</i></button></a>
            </div>  
            <div class="col-md-1"></div>
            <div class="col-md-3">
            <a href='frm_requirement_cf.php?id=<?php echo $data['id'];?>'><button type="submit" class="btn btn-danger" id="btn-add" name="btnadd" style="float:right;"><i class="fa fa-plus"> Add Requirements(Checklist Form)</i></button></a>
            </div>
        </div>
<?php endif;?>
        <br>
		</div>
	</div>
	</div>
</section>

 
</div>



<script type="text/javascript">

</script>
<?php
Modal();
makeFoot(WEBAPP,1);
?>
