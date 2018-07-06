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
if (!empty($_GET['id'])) {
	$data=$con->myQuery("SELECT * FROM requirements WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);

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
	<h3> Requirement Form </h3>
	</center>
	<hr>
			<div class="row">
                <form action="save_requirement.php" method="post" class="form-horizontal" id='frmclear'>
                  <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                	 <div class='form-group'>
                     <label class="col-md-4 control-label">Requirement Code: </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="requirement_code" name='requirement_code' placeholder="Requirement Code" value='<?php echo !empty($data)?htmlspecialchars($data['requirement_code']):''; ?>' required>
                          <span id="code-message"></span>
                      </div>
                  </div>
                   <div class='form-group'>
                     <label class="col-md-4 control-label">Requirement Name: </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="requirement_name" name='requirement_name' placeholder="Requirement Name" value='<?php echo !empty($data)?htmlspecialchars($data['name']):''; ?>' required>
                      </div>
                  </div> 
                  <div class="col-sm-11 col-md-offset-1 text-center">
                    <button type='submit' class='btn btn-primary' data-btn-title="Submitting...">Save </button>
                    <a href='requirement.php' class='btn btn-default'>Cancel</a><br>
                </div>
                </form>
            </div>		
		</div>
	</div>
	</div>
</section>

 
</div>



<script >
$(document).ready(function(){
    $('#requirement_code').keyup(function(){
        var value = $(this).val(),
            id = $('input#id').val();
        $.ajax({
            url:"ajax/code_requirement_auth.php",
            method:"POST",
            data:{val: value, req_id: id},
            dataType:'html',
            success:function(html){
                $('span#code-message').html(html);
            }
        });
    });
    $('form#frmclear').submit(function() {
        var self = $(this),
            button = self.find('button[type="submit"]'),
            btnVal = button.data('btn-title'),
            notSubmit = $('#false');

            if(notSubmit.attr('id') == 'false'){
                return false;
            }else{
                button.attr('disabled','disabled').html((btnVal)?btnVal:'Please wait...');
            }
    });
});

</script>
<?php
Modal();
makeFoot(WEBAPP,1);
?>
