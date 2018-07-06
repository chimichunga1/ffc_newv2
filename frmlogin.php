
<?php
	require_once("support/config.php");
 
  if(isLoggedIn()){
    redirect("index.php");
    die();
  }

	makeHead("Login");
?>

    <div class="login-box">
      <div class="login-box-body" style="border-radius: 10px;border: #A5A0A4 1px solid;">
        
        <div class="login-logo">
        <img src="dist/img/ffclogo.png" class='img-responsive center-block' >
        </div><!-- /.login-logo -->
        <?php
          Alert();
        ?>
        <h4 class="login-box-msg text-primary">Login to your Account</h4>
       
    <!--  <h4 class="form-signin-heading">Login to your Account</h4>-->
        <form action="logingin.php" method="post">
          <div class="form-group has-feedback">
            <i class="glyphicon glyphicon-user form-control-feedback"></i>
            <input type="text" class="form-control" placeholder="Username" name='username'>
            <!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name='password'>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12 col-xs-offset-0">
              <!--<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>-->
              <button type="submit" class="btn btn-lg btn-block bg-yellow">Login</button>
              <br/>
              <center><a class='text-yellow' href='forgot_password.php' >Forgot Password</a>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

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
  Modal();
	makeFoot();
?>