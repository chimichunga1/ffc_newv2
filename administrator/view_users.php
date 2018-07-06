<?php
require_once '../support/config.php';

if(!isLoggedIn()){
  toLogin();
    die();
}

if(!AllowUser(array(1))){
  redirect("index.php");
}

makeHead("User List",1);

// $getEnrollmentFee=$con->myQuery("SELECT enrollment_fee_id,grade_level_code,grade_level_name,total_fee 
//   FROM enrollment_fee INNER JOIN grade_levels ON enrollment_fee.grade_level_id = grade_levels.grade_level_id WHERE enrollment_fee.is_deleted='0'");

require_once("../template/header.php");
require_once("../template/sidebar.php");
?>
<div class='content-wrapper'>
  <section class="content-header">
    <h1 class="text-blue">
      User
      <small>List</small>
      
    </h1>
    
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><i class="fa fa-cogs"></i> Administrator</a></li>
      <li class="active">Users</li>
    </ol>
  </section>
  <section class='content'>
<div class="row">
  <div class='col-md-12'>
    <div class="box box-primary">
      <div class='box-header with-border'>
        
        <div class='row'>
          <div class='col-md-12 text-right'>
            <a href='frm_user.php' class='btn btn-primary btn-flat' style="float:right;" > <span class='fa fa-plus'></span> Create New  </a>
          </div>                                
        </div> 
      
      </div>

            <div class="box-body">

          <?php
          Alert();
          ?>
          <br/>

            <div class='panel panel-default'>
            <div class='panel-body ' >
            <table id='ResultTable' class='table table-bordered table-striped'>
              <thead>
                <tr>
                  <th class='text-center'>User ID </th>
                  <th class='text-center'>Employee Name</th>
                  <th class='text-center'>User Name </th>
                  <th class='text-center'>User Type </th>
                  <th class='text-center'>Actions</th>
                </tr>
              </thead>
              <tbody>

              </tbody>

            </table>
          </div>
          </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>



<script type="text/javascript">
  $(function () {
    $('#ResultTable').DataTable({
      "scrollX": true,
      "searching":true,
      "ajax":{
                  "url":"ajax/view_users.php"
              },
      "language": {
        "zeroRecords": "No User/s Found."
      }
    });
  });
</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>