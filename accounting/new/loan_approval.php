<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}

makeHead("Loan Approval",1);



if (empty($_GET['tab'])) {
    $tab="1";
}
else {
    
    $tab="2";
    
}
    

require_once("../template/header.php");
require_once("../template/sidebar.php");
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
        <section class="content-header">
              <h1 class="text-blue"><i class="fa fa-check"></i>
                Loan Check Approval
              </h1>
                   
                
                <ol class="breadcrumb">
                  <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a href="#" ><i class="fa fa-file"></i> Loan Receivable</a></li>
                  <li class="active">Loan Approval  </li>
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
                         
                          <div class="tab-content">
                              <div class="active tab-pane" >
                                  <?php
                                      switch ($tab) {
                                          case '1':
                                              #PERSONAL INFORMATION
                                              $form='check_voucher.php';
                                              break;
                                         
                                          default:
                                              $form='check_voucher.php';
                                              break;
                                      }
                                      require_once($form);
                                  ?>
                              </div><!-- /.tab-pane -->
                          </div><!-- /.tab-content -->
                        </div><!-- /.nav-tabs-custom -->
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>


<?php
Modal();
makeFoot(WEBAPP,1);
?>