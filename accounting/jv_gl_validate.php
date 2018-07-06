 

<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}



 




makeHead("Distribution/Preparation",1);


$account=$con->myQuery("SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);


// $jv_no=$con->myQuery("SELECT j.jv_id, j.jv_no FROM `journal_voucher` j WHERE  j.isDeleted=0 and j.isValidated=0")->fetchAll(PDO::FETCH_ASSOC);


require_once("../template/header.php");
require_once("../template/sidebar.php");


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Journal Voucher Validate</h1>                
           
           <ol class="breadcrumb">
           <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>
            <li ><a href="#" >   <i class="fa fa-file-text"></i>General Ledger Entries </a> </li>
             <li class="active">Journal Voucher Validate </li>
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
                                          

<?php ////////////////////////////////////////////////////////////////////////////////////////////////  ?>







<form action="" method="" class="form-horizontal" id='frmclear'>

    <div class='form-group'>
        <label class='col-sm-12 col-md-4 control-label'> JV No: </label>
               <div class='col-sm-12 col-md-5'>
             

                  <input type="text" class="form-control numeric"  id="filterjv"    placeholder="Enter jv no"   >
            </div>

    </div>
    <div class='form-group'>
        <label class='col-sm-12 col-md-4 control-label'> Client:</label>
            <div class='col-sm-12 col-md-5'>
                <select class='form-control cbo' style="width: 100%;" data-placeholder="Select a client"  id='filterclnt'>
                    <?php echo makeOptions($account) ?>
                </select>
            </div>

    </div>

   
  
    
<?php ////////////////////////////////////////////////////////////////////////////////////////////////  ?>


    
    <div class='form-group'>
        <div class='col-sm-12 col-md-9 col-md-offset-5 '>
            <button type='button' class='btn-flat btn btn-warning' onclick='filter_search()'><span class="fa fa-search"></span> Filter</button>
            <button  type='button' onclick="form_clear('frmclear')" class="btn btn-default">Clear</button>
        </div>

    </div>     

</form>


                        <!-- </div>
                    </div>
                </div>
            </div> -->
            <div class="box-body">
                <table id='dataTables' class="table responsive-table table-bordered table-striped" >
                    <thead>
                        <tr >
                            <th>JV No.</th>
                            <th>Client</th>
                            <th>Client No.</th>
                            <th>Validate</th>
                            <th>Action</th>
                     
        
          
                        </tr>
                    </thead>
                    <tbody>
           

                            
                    </tbody>
                </table>
            </div>
        </section>



   
<script>
    var dttable="";
      $(document).ready(function() {
        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",
                "scrollX":"100%",
                "searching": false,
                "processing": true,
    
                "select":true,
                 "processing": true,
   
              // "ajax": "ajax/serverside_cv.php",
                "ajax":{
                  "url":"ajax/serverside_jv_validated.php",
                    "data":function(d)
                    {
       
                        d.jv_no           = $("input#filterjv").val();
                        d.clnt_id              = $("select#filterclnt").val(); 
                      }
                  
                },
                "language": {
                    "zeroRecords": "No Records Found."
                },
                order:[[0,'desc']]
                ,"columnDefs": [  
                    { "searchable": false, "targets": 0 },
                    { "orderable": false, "targets": [-1] },
                    { "sClass": "text-center", "aTargets": [ -1 ]}
                  ] 

 


        });
        
    });
    
    function filter_search() 
    {
            dttable.ajax.reload();
            //console.log(dttable);
    }



 


</script>


















<?php ////////////////////////////////////////////////////////////////////////////////////////////////  ?>



















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
