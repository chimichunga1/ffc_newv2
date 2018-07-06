<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}

if (empty($_GET['tab'])) {
    $tab="1";
}
else {
    
    redirect("preparation.php");
    
}
makeHead("Distribution/Preparation",1);


$loan_types=$con->myQuery("SELECT * FROM loan_approval_type where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
$loan_status=$con->myQuery("SELECT * FROM loan_status where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
$account=$con->myQuery("SELECT id,  CONCAT(first_name,' ',last_name) as `acc_name` FROM loan_list where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

require_once("../template/header.php");
require_once("../template/sidebar.php");
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Distribution/Preparation</h1>                
           
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="view_users.php" ><i class="fa fa-users"></i> Marketing</a></li>
            <li class="active">Distribution/Preparation  </li>
          </ol>

        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
            <div class="row">

                <div class='col-md-12 '>
                    <?php
                    Alert();
                    ?>
                
                    <div class="box box-primary flat">
                        <div class="box-body">

                            <div class='col-md-12'>
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <?php
                                            $no_employee_msg=' Personal Information must be saved.';
                                        ?>
                                      
                                        
                                    </ul>
                                    <div class="tab-content">
                                        <div class="active tab-pane" >
                                            <?php
                                                switch ($tab) {
                                                    case '1':
                                                        #PERSONAL INFORMATION
                                                        $form='prep_cv.php';
                                                        break;
                                                   
                                                    
                                                    default:
                                                        $form='prep_cv.php';
                                                        break;
                                                }
                                                require_once($form);
                                            ?>
                                        </div><!-- /.tab-pane -->
                                    </div><!-- /.tab-content -->
                                </div><!-- /.nav-tabs-custom -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
<?php
Modal();
makeFoot(WEBAPP,1);
?>