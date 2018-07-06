<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1))){
  redirect("../index.php");
}

makeHead("Form Civil Status",1);

require_once("../template/header.php");
require_once("../template/sidebar.php");
if (!empty($_GET['id'])) {
	$data=$con->myQuery("SELECT * FROM civil_status WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);

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
	<h3> Civil Status Form </h3>
	</center>
	<hr>
			<div class="row">
                <form action="save_civil_status.php" method="post" class="form-horizontal" id='frmclear'>
                  <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                   <div class='form-group'>
                     <label class="col-md-4 control-label">Name: </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="name" name='name' placeholder="Civil Status Name" value='<?php echo !empty($data)?htmlspecialchars($data['name']):''; ?>' required>
                      </div>
                  </div> 
                  <div class="col-sm-11 col-md-offset-1 text-center">
                    <button type='submit' class='btn btn-primary'>Save </button>
                    <a href='civil_status.php' class='btn btn-default'>Cancel</a><br>
                </div>
                </form>
            </div>		
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
