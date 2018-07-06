<?php
require_once("support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1))){
  redirect("index.php");
}

makeHead("User Form");

$cbo_user_types=$con->myQuery("SELECT *
  FROM user_types where is_deleted = 0
  ")->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_GET['user_id'])){

  if ($_GET['user_id'] == $_SESSION[WEBAPP]['user']['user_id'] ){
    redirect("view_users.php");
  }
  $theUser =$con->myQuery("SELECT user_id, username , first_name,last_name,middle_initial,user_type_id, password, course_level_id
  FROM users WHERE user_id = ? AND is_deleted=0",array($_GET['user_id']))->fetch(PDO::FETCH_ASSOC); //dagdag ung session :) sa query
  // var_dump($theUser);
  // die;

  // $staff_details=$con->myQuery("SELECT user_id, branch_id , company_id
  //   FROM user_company_tag WHERE user_id = ? ",array($_GET['user_id']))->fetch(PDO::FETCH_ASSOC);


  if(empty($theUser)){
    redirect("view_users.php");
    die;
  }

}
//$companies=$con->myQuery("SELECT company_id,company_name FROM companies WHERE is_deleted=0" )->fetchAll(PDO::FETCH_ASSOC);
//$branches=$con->myQuery("SELECT branch_id,branch_name FROM branches WHERE is_deleted=0" )->fetchAll(PDO::FETCH_ASSOC);

require_once("template/header.php");
require_once("template/sidebar.php");
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
          <!-- <h1>
            Create New User
          </h1> -->
          <?php
          if(!empty($_GET['user_id'])){
            ?>
            <h1 class="text-primary text-center">Update User</h1>
            <?php
          }
          else{                    
            ?>
            <h1 class="text-primary text-center">Create New User</h1>                
            <?php
          }
          ?>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="view_users.php" ><i class="fa fa-users"></i> User Management</a></li>
            <li class="active">User Form  </li>
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
                  <div class="row">
                   <div class='col-sm-12 col-md-8 col-md-offset-2'>
                     <br/>
                     <form class='form-horizontal disable-submit' method='POST' action='save_user.php' name='frm_user' onsubmit='return validate(this)'s>
                      <input type='hidden' name='user_id' value='<?php echo !empty($theUser)?$theUser['user_id']:""?>'>
                      <div class='form-group'>
                        <label class='col-sm-12 col-md-3 control-label'> First Name:<span class='text-red'>*</span> </label>
                        <div class='col-sm-12 col-md-9'>
                          <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value='<?php echo !empty($theUser)?$theUser['first_name']:""?>'   required>
                        </div>

                      </div>
                      <div class='form-group'>
                        <label class='col-sm-12 col-md-3 control-label'> Last Name:<span class='text-red'>*</span> </label>
                        <div class='col-sm-12 col-md-9'>
                          <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value='<?php echo !empty($theUser)?$theUser['last_name']:""?>'   required>
                        </div>

                      </div> 
                      <div class='form-group'>
                        <label class='col-sm-12 col-md-3 control-label'> Middle Initial: </label>
                        <div class='col-sm-12 col-md-9'>
                          <input type="text" class="form-control" name="middle_initial" placeholder="Enter Midlle Initial" value='<?php echo !empty($theUser)?$theUser['middle_initial']:""?>'>
                        </div>

                      </div> 
                      <div class='form-group'>
                        <label class='col-sm-12 col-md-3 control-label'> User Name:<span class='text-red'>*</span> </label>
                        <div class='col-sm-12 col-md-9'>
                          <input type="text" class="form-control" name="username" placeholder="Enter User Name" value='<?php echo !empty($theUser)?$theUser['username']:""?>'   required>
                        </div>

                      </div> 
                      <!-- <div class="form-group">
                          <label for="name" class="col-sm-12 col-md-3 control-label">Password:<span class='text-red'>*</span></label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" placeholder="Password" name='password' value='<?php echo !empty($theUser)?htmlspecialchars(decryptIt($theUser['password'])):''; ?>' required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="name" class="col-sm-12 col-md-3 control-label">Confirm Password:<span class='text-red'>*</span></label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="con_password" placeholder="Confirm Password" name='con_password'  required>
                          </div>
                        </div> -->

                        <div class='form-group'>
                          <label class='col-sm-12 col-md-3 control-label'> User Type:<span class='text-red'>*</span></label>
                          <div class='col-sm-12 col-md-9'>
                            <select class='form-control' required  id='user_type_id' onchange="loadSelect()" data-placeholder="Select User Type" name='user_type_id'  <?php echo!(empty($cbo_user_types))?"data-selected='".$theUser['user_type_id']."'":NULL ?> style='width:100%' required>
                              <?php echo makeOptions($cbo_user_types) ?>
                            </select>
                          </div>

                        </div>
                        <div class='form-group' id="here" 
                        <?php
                        if(empty($_GET['user_id'])){
                          ?>
                          style="display:none;"
                          <?php
                        }else{
                          if($theUser['user_type_id']==3){
                            ?>
                            style="display:block;"
                            <?php      
                          }
                          ?>

                          <?php
                        }
                        ?>
                        >
                       <!--  <label class='col-sm-12 col-md-3 control-label' id='lbl_dean_level' > Dean Level:<span class='text-red'>*</span></label>

                        <div class='col-sm-12 col-md-9' id='dean_level' >
                          <select name="course_level_id" id="course_level_id" class="form-control" <?php echo!(empty($theUser))?"data-selected='".$theUser['course_level_id']."'":NULL ?>  style="width:100%;">
                            <option value="1">Elementary</option>
                            <option value="2">High School</option>
                            <option value="3">College/University</option>
                          </select>
                        </div> -->

                      </div>


                        <!-- <div class='form-group'>
                          <label class='col-sm-12 col-md-3 control-label' id='lbl_com' style="display: none;"> Company:<span class='text-red'>*</span></label>
                          <div class='col-sm-12 col-md-9' id=com_id  style=" display: none;">
                            <select class='form-control'   id='company_id' data-placeholder="Select Company" name='company_id'    style='width:100%;' >
                              <?php echo makeOptions($companies) ?>
                            </select>
                          </div>

                        </div> -->
                        <!-- <div class='form-group'>
                          <label class='col-sm-12 col-md-3 control-label' id='lbl_bra' style="display: none;"> Branch:<span class='text-red'>*</span></label>
                          <div class='col-sm-12 col-md-9' id=bra_id style='display: none;'>
                            <select style='width:100%;' class='form-control'   id='branch_id'  name='branch_id'  data-placeholder="Select Branch" name='branch_id'      >
                              <?php echo makeOptions($branches) ?>
                            </select>
                          </div>

                        </div> -->    






                        <div class='form-group'>
                          <div class='col-sm-12 col-md-9 col-md-offset-3 '>
                            <button type='submit' class='btn btn-primary btn-flat'> <!-- <span class='fa fa-save'></span> --> Save</button>
                            <a href='view_users.php' class='btn btn-flat btn-default'>Cancel</a>
                          </div>

                        </div>     

                      </form>
                    </div>
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
    <!--   <script type="text/javascript">
      //   $(document).ready(function(){
      //     $("#company_id").change(function () {
      //    // alert("sdfsdfsdf");ss
      //      // console.log($("#departments").val());
      //      company_id=$("select[name='company_id']").val();

      //   //gl_sy = <?php //echo $schoolyear['school_year_id']; ?>;

      //   // $("input[name='grade_name']").val($("select[name='grade_level'] :selected").text());
      //   $("select[name='branch_id']").val(null).trigger("change"); 

      //   $("select[name='branch_id']").load("ajax/cb_branches.php?id="+company_id);
      // })
      //     loadSelect();
      //   });
// $('#company_id').select2({
//     containerCss: function (element) {
//         var style = $(element)[0].style;
//         return {
//             display: style.display
//         };
//     }
// });
// $('#branch_id').select2({
//     containerCss: function (element) {
//         var style = $(element)[0].style;
//         return {
//             display: style.display
//         };
//     }
// });

</script> -->
<script type="text/javascript">

 //  $(document).ready(function(){
 //       // $("#category_id").change(function () {})
 //   //loadSelectus();
 // });
 function validate(frm) 
 {
  var js_new_pass = document.forms["frm_user"]["password"].value;
  var js_confirm_pass = document.forms["frm_user"]["con_password"].value;

  if (js_new_pass !== js_confirm_pass) 
  {
    alert("Retry Confirm Password.");
    return false;
  }
  if (checkPassword(js_new_pass)==false)
  {
    alert("Password should consist of atleast 1 Capital Letter and atleast 1 Number");
    return false;
  }
  return true;
}

function checkPassword(pwd)
{
  var letterSmall = /[a-z]/;
  var letterCap = /[A-Z]/; 
  var number = /[0-9]/;
  var valid = number.test(pwd) && letterCap.test(pwd) && letterSmall.test(pwd); 
  return valid;
}
  // function loadSelectus()
  // {

  //   var company_id=$("select[name='company_id']").val();
  //   var branch_id = $("select[name='branch_id']").val();
  //   //var student_type = document.getElementById('student_type');
  
  
  //   //status_type_id.value = student_type.value;
  //   //console.log(status_type_id.value);
  //   if($(branch_id) !='')
  //   {
  //    // $("select[name='branch_id']").val(null).trigger("change"); 

  //     $("select[name='branch_id']").load("ajax/cb_branches.php?id="+company_id);
  //       // alert(branch_id);
  //   $("select[name='branch_id']").val(branch_id);

  //   }
  // }

  function loadSelect()
  {  

    var user_type_id = document.getElementById('user_type_id');
    //var student_type = document.getElementById('student_type');
    
    //status_type_id.value = student_type.value;
    //console.log(status_type_id.value);


    if($(user_type_id).val() == '3')
    {

      document.getElementById("here").style.display='block';
      // document.getElementById("course_level_id").style.display='block';
      // document.getElementById("dean_level").style.display='block';
  //document.getElementById("student_no").disabled=false;


}else{

  document.getElementById("here").style.display='none';
  // document.getElementById("course_level_id").style.display='none';
  // document.getElementById("dean_level").style.display='none';
  //document.getElementById("student_no").disabled=true;

}

}

</script>
<?php
Modal();
makeFoot();
?>