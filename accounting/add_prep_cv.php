<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}

if (empty($_GET['id'])) {
    redirect("preparation.php");
}
else {
    
$account=$con->myQuery("SELECT id,  CONCAT(first_name,' ',last_name) as `acc_name` FROM loan_list where id = {$_GET['id']}")->fetch(PDO::FETCH_ASSOC);


}
makeHead("Distribution/Preparation",1);


$loan_types=$con->myQuery("SELECT * FROM loan_approval_type where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
$loan_status=$con->myQuery("SELECT * FROM loan_status where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

require_once("../template/header.php");
require_once("../template/sidebar.php");
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Add Distribution/Preparation</h1>                
           
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="view_users.php" ><i class="fa fa-users"></i> Marketing</a></li>
            <li class="active">Add Distribution/Preparation  </li>
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
                                    <input type='hidden' name='id' value='<?php echo !empty($account)?$account['id']:""?>'>
                                    <div class='form-group'>
                                        <label class='col-sm-12 col-md-4 control-label'> Home Pay To:</label>
                                            <div class='col-sm-12 col-md-5'>
                                            <input type="text" class="form-control" name="acc_name" value="<?php echo $account['acc_name']; ?>" disabled>
                                            </div>

                                    </div>
                                    <div class='form-group'>
                                        <label class='col-sm-12 col-md-4 control-label'> CV No: </label>
                                            <div class='col-sm-12 col-md-5'>
                                                <input type="text" class="form-control" name="cv_no" placeholder="Enter CV No.">
                                            </div>

                                    </div>
                                    <div class='form-group'>
                                        <label class='col-sm-12 col-md-4 control-label'> Amount: </label>
                                            <div class='col-sm-12 col-md-5'>
                                                <input type="text" class="form-control" name="amount" placeholder="Enter Amount" >
                                            </div>

                                    </div> 
                                    <div class='form-group'>
                                        <label class='col-sm-12 col-md-4 control-label'> Details: </label>
                                        <div class='col-sm-5'>
                                            <textarea class='form-control' name='details' id='details' placeholder="Details" required></textarea>
                                        </div>
                                    </div>


                                    
                                    <div class='form-group'>
                                        <div class='col-sm-12 col-md-12 col-md-offset-5 '>
                                            <button type='button' class='btn-flat btn btn-warning' onclick='filter_search()'><span class="fa fa-save"></span> Add</button>
                                            <a href='preparation.php'class="btn btn-default">Cancel</a>
                                        </div>

                                    </div>     

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <table id='dataTables' class="table responsive-table table-bordered table-striped" >
                    <thead>
                        <tr >
                            <th>Account No.</th>
                            <th>CD</th>
                            <th>Account Code</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Client No.</th>
                          
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr class="tableheader"> -->


                            
                    </tbody>
                </table>
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
                  "url":"ajax/add_prep_cv.php",
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