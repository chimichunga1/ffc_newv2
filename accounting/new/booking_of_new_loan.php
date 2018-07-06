<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}

makeHead("Booking of New Loan",1);


$loan_types=$con->myQuery("SELECT id, CONCAT('(',code,') ',name) FROM loan_approval_type where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
$loan_status=$con->myQuery("SELECT * FROM loan_status where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
$account=$con->myQuery("SELECT id,  CONCAT(first_name,' ',last_name) as `acc_name` FROM loan_list where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

require_once("../template/header.php");
require_once("../template/sidebar.php");
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Booking of New Loan</h1>                
           
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>
            <li class="active">Booking of New Loan  </li>
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
                               
                                <form action="" method="" class="form-horizontal" id='frmclear'>
                                    <input type='hidden' name='user_id' value='<?php echo !empty($theUser)?$theUser['user_id']:""?>'>
                                    <div class='form-group'>
                                        <label class='col-sm-12 col-md-4 control-label'> Type:</label>
                                            <div class='col-sm-12 col-md-5'>
                                                <select class='form-control cbo' data-placeholder="Loan Type"  name='loan_type_id'>
                                                <?php echo makeOptions($loan_types) ?>
                                                </select>
                                            </div>

                                    </div>

                                    <div class='form-group'>
                                        <label class='col-sm-12 col-md-4 control-label'> Client Number</label>
                                            <div class='col-sm-12 col-md-5'>
                                                <select class='form-control cbo' data-placeholder="Select Client Number" >
                                                    <option></option>
                                                    
                                                </select>
                                            </div>

                                    </div>
                                    <div class='form-group'>
                                        <label class='col-sm-12 col-md-4 control-label'> Application Number</label>
                                            <div class='col-sm-12 col-md-5'>
                                                <select class='form-control cbo' data-placeholder="Select Application Number" >
                                                    <option></option>
                                                    
                                                </select>
                                            </div>

                                    </div>
                                    <div class='form-group'>
                                        <label class='col-sm-12 col-md-4 control-label'> Status</label>
                                            <div class='col-sm-12 col-md-5'>
                                                <select class='form-control cbo' data-placeholder="Select Status" >
                                                    <option></option>
                                                    
                                                </select>
                                            </div>

                                    </div>
                                    
                                    


                                    
                                    <div class='form-group'>
                                        <div class='col-sm-12 col-md-12 col-md-offset-5 '>
                                            <button type='button' class='btn-flat btn btn-warning' onclick='filter_search()'><span class="fa fa-search"></span> Filter</button>
                                            <button  type='button' onclick="form_clear('frmclear')" class="btn btn-default">Clear</button>
                                        </div>

                                    </div>     

                                </form>
                                <a href='add_prep_cv.php' class="btn btn-primary" id="btn-add" style="float:right;"><i class="fa fa-plus"> &nbsp; Add New</i>
                                </a>
                                <div class="box-body">
                                    <table id='dataTables' class="table responsive-table table-bordered table-striped" >
                                        <thead>
                                            <tr >
                                                <th>Application No.</th>
                                                <th>Client No.</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Loan Date</th>
                                                <th>Status</th>
                                              
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <tr class="tableheader"> -->


                                                
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
<script>
    var dttable="";
      $(document).ready(function() {
        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",
                "scrollX":"100%",
                "searching": false,
                "processing": true,
                "serverSide": true,
                "select":true,
                "ajax":{
                  "url":"../marketing/ajax/loan_management.php",
                    "data":function(d)
                    {
                        d.loan_type_id           = $("select[name='loan_type_id']").val();
                        d.client_no              = $("input[name='client_no']").val();
                        d.app_no                 = $("input[name='app_no']").val();
                        d.status_id              = $("select[name='status_id']").val();
                       
                    }
                  
                },"language": {
                    "zeroRecords": "No Records Found."
                },
                order:[[0,'desc']]
                ,"columnDefs": [	
                    { "orderable": false, "targets": [-1] },
                    {"sClass": "text-center", "aTargets": [ -1 ]}
                  ] 
        });
        
    });
    
    function filter_search() 
    {
            dttable.ajax.reload();
            //console.log(dttable);
    }
</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>