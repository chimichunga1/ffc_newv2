<?php
require_once("support/config.php");

	if(!isLoggedIn()){
		redirect("logout.php");
		die();
	}
if($_SESSION[WEBAPP]['user']['question_id']!=null){
      redirect("logout.php");
      die();
  }

  makeHead("Login");
$questions = $con->myQuery("SELECT question_id,question	FROM questions")->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="login-box" >
      <div class="login-box-body" style="border-radius: 10px;border: #A5A0A4 1px solid;">
        
        <div class="login-logo">
			<img src="dist/img/ffclogo.png" class='img-responsive center-block' >
        </div><!-- /.login-logo -->
        <?php
          Alert();
        ?>
        <h4 class="login-box-msg text-primary">Set up your Account</h4>

		<form action="save_setupAcc.php" method="post" class="disable-submit">
			<div class="row" style="margin-left: 10px; margin-right:10px;">	

				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Password" name='password' style="padding-left: 42.5px;padding-right: 0px" required="">
						<span class="glyphicon glyphicon-lock form-control-feedback" style='left:0px'></span>
				</div>
				
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Confirm Password" name='cur_password' style="padding-left: 42.5px;padding-right: 0px" required="">
						<span class="glyphicon glyphicon-lock form-control-feedback" style='left:0px'></span>
				</div>
				
				<div class="form-group has-feedback">
					<select  class='form-control cbo' id='sq_id'  name='sq_id' data-placeholder="Select Secret Question"  style='width:100%' required>
						<?php echo makeOptions($questions) ?>
					</select>
				</div>

				<div class="form-group has-feedback">
					<input  class="form-control" placeholder="Answer" name='answer' style="padding-left: 42.5px;padding-right: 0px" required="">
						<span class=" fa fa-lightbulb-o form-control-feedback" style='left:0px'></span>
				</div>

				<div class='form-group pull-right'>
					<button type='submit' class='btn btn-success btn-flat' > <span class='fa fa-save'></span> Save</button>
					<a href='logout.php' class='btn btn-danger btn-flat' >Cancel</a>
				</div>

			</div>


		</form>
	</div>
</div>
<style>

#b1 { background: url("dist/img/login/loan.jpg"); background-repeat: no-repeat; background-size: cover; }
#b2 { background: url("dist/img/login/truck.jpg"); background-repeat: no-repeat; background-size: cover; }
#b3 { background: url("dist/img/login/house.jpg"); background-repeat: no-repeat; background-size: cover; }
#b4 { background: url("dist/img/login/loan1.jpg"); background-repeat: no-repeat; background-size: cover; }
#b5 { background: url("dist/img/login/car.jpg"); background-repeat: no-repeat; background-size: cover; }

</style>
<script>
function run(interval, frames) {
  var int = 1;
  
  function func() {
      document.body.id = "b"+int;
      int++;
      if(int === frames) { int = 1; }
  }
  
  var swap = window.setInterval(func, interval);
}

run(1000, 6); //milliseconds, frames
</script>
<?php
//Modal();
makeFoot();

?>