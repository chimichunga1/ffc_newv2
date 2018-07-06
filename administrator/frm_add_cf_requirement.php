<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1))){
  redirect("../index.php");
}

makeHead("Add Requirement (CF)",1);

require_once("../template/header.php");
require_once("../template/sidebar.php");
$view = FALSE;
if (!empty($_GET['id'])) {
    $check = $con->myQuery("SELECT * FROM loan_approval_type WHERE id=? AND is_deleted=0",array($_GET['id']))->fetchColumn();
        if($check <= 0){
            redirect('loan_type.php');
        }
    $data=$con->myQuery("SELECT * FROM requirements WHERE cf NOT LIKE '%".$_GET['id']."%' AND is_deleted=0");
    $count =$con->myQuery("SELECT * FROM requirements WHERE cf NOT LIKE '%".$_GET['id']."%' AND is_deleted=0")->fetchColumn();
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
	<h3> Add Requirement - (CF) </h3>
	</center>
	<hr>
			<div class="row">
                <form action="save_requirement_cf.php" method="post" class="form-horizontal" id='frmclear'>
                  <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                	 <div class='form-group'>
                     <label class="col-md-4 control-label">Requirements : </label>
                      <div class="col-md-5">
                        <?php if($count > 0) :?>
                        <?php //print_r($data->fetch(PDO::FETCH_ASSOC));?>
                        <select name="reqAvail" class="form-control cbo" data-placeholder="Select a Requirement">
                                <?php while($row = $data->fetch(PDO::FETCH_ASSOC)) :?>
                                <option value="<?php echo $row['requirement_code']; ?>"><?php echo $row['name'];?></option>        
                                <?php endwhile;?>
                        </select>
                        <?php else :?>
                        <input type="text" id="disabled" data-placeholder="Nothing to Select" class="form-control cbo" disabled>
                        <?php endif;?>

                        
                                <!-- <input type="text" class="form-control" placeholder="Enter Requirement Name" id="req">                      
                                <div id="reqList"></div> -->
                      </div>
                  </div>
                   
                  <div class="col-sm-11 col-md-offset-1 text-center">
                    <button type='submit' class='btn btn-primary' name="submit">Save </button>
                    <a href='frm_requirement_cf.php?id=<?php echo $_GET['id']; ?>' class='btn btn-default'>Cancel</a><br>
                </div>
                </form>
            </div>		
            <br>
        <br>
		</div>
	</div>
	</div>
</section>

 
</div>



<script type="text/javascript">
 var element =  document.getElementById('disabled');
  if (typeof(element) != 'undefined' && element != null)
  { 
     $('button[type="submit"]').addClass('disabled');
  }
</script>
<?php
Modal();
makeFoot(WEBAPP,1);
?>
