<?php
require_once '../support/config.php';

if(!isLoggedIn()){
  toLogin();
    die();
}

if(!AllowUser(array(1))){
  redirect("index.php");
}

makeHead("Account Settings",1);

$user_info=$con->myQuery("SELECT * FROM users WHERE user_id={$_SESSION[WEBAPP]['user']['user_id']}")->fetch(PDO::FETCH_ASSOC);


// var_dump(decryptIt($getpass['password']));
// die;

require_once("../template/header.php");
require_once("../template/sidebar.php");
?>
<div class='content-wrapper'>
  <section class="content-header">
    <h1 class="text-blue"><i class="fa fa-gear"></i>
      Account Settings
    </h1>
    
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><i class="fa fa-cogs"></i> Maintenance</a></li>
      <li class="active">Account Settings</li>
    </ol>
  </section>
  <section class='content'>
    <div class="row">
      <div class='col-md-12'>
        <div class="box box-primary">
          
          
        <div class="box-body">
        <br/>
            <?php
          Alert();
        ?>
            <form method='POST' class='form-horizontal disable-submit' action ="save_profile.php" enctype="multipart/form-data">
              <input type='hidden' name='user_id' value='<?php echo htmlspecialchars("{$_SESSION[WEBAPP]['user']['user_id']}")?>'>
                <div class='form-group'>
                  <div class='col-md-12 '>
                    <center>
                    <img src="user_image/<?php echo $user_info['image']; ?>" class="user-image" alt="User Image" style='width:140px;'>
           
                      <input type="file" id="image"  name='image' accept='image/*' class="filestyle" data-classButton="btn btn-primary" data-input="false" data-classIcon="icon-plus" data-buttonText=" &nbsp;Change Image">
                    </center>
                  </div>
                </div>                                                
                <div class='form-group'>
                    <label class='col-md-4 text-right' >First Name: *</label>
                    <div class='col-md-5'>
                      <input name="f_name" type="text"  class='form-control' value="<?php echo $user_info['first_name'] ?>" required> 
                    </div>
                    

                 </div>
                 <div class='form-group'>
                    <label class='col-md-4 text-right' >Middle Name:</label>
                    <div class='col-md-5'>
                      <input name="m_name" type="text" class='form-control' value="<?php echo $user_info['middle_initial'] ?>"> 
                    </div>
                    

                 </div>
                 <div class='form-group'>
                    <label class='col-md-4 text-right' >Last Name: *</label>
                    <div class='col-md-5'>
                      <input name="l_name" type="text" class='form-control' value="<?php echo $user_info['last_name'] ?>" required> 
                    </div>
                    

                 </div>
                 <div class="text-center">
                    <div class="form-group">
                          <div class="col-sm-8 col-md-offset-2 ">
                            <button type='submit' class='btn btn-primary btn-flat'>Save </button>
                            <!-- <a href='index.php' class='btn btn-default btn-flat'>Cancel</a> -->
                          </div>
                    </div>
                </div>
                

            </form>
         
          </div>

        </div>
      </div>
    </div>
  </section>
</div>














<?php
Modal();
makeFoot(WEBAPP,1);
?>