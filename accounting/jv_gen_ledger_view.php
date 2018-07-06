
 

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


require_once("../template/header.php");
require_once("../template/sidebar.php");


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">General Ledger Entries</h1>                
           
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>
            <li class="active">General Ledger Entries  </li>
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
                                        <li ><a href="cv_gen_ledger.php" >Check Voucher</a>
                                        </li>
                                        <li  class="active" ><a href="jv_gen_ledger.php">Journal Voucher</a>
                                        </li>
                                        
                                        
                                    </ul>
                                    <div class="tab-content">
                                        <div class="active tab-pane" >
                                          

<?php ////////////////////////////////////////////////////////////////////////////////////////////////  ?>

<?php 


if(!empty($_GET['id']))
{
  $d=$_GET['id'];



?>




  <div class="box-body">
                <table id='dataTables' class="table responsive-table table-bordered table-striped" >
                    <thead>
                        <tr >
                            <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Account No.</th>
                            <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> CD</th>
                            <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Account Code</th>
                            <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Debit</th>
                            <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Credit</th>
                             <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Client</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                                       

<?php

$x=0;

      // $query1=mysqli_query($conn,"SELECT c.`cntrct_id`,c.`cd`,c.`acc_code`,c.`debit_amount`,c.`credit_amount`,c.`clnt_id`,CONCAT(cl.fname,' ',cl.lname ) fullname FROM `cheque_dbcr` c INNER JOIN client_list cl ON c.clnt_id=cl.client_number WHERE `cv_id`='".$d."' and c.isDeleted='0' ");

      //               while ($row1=mysqli_fetch_array($query1)) 

$query1=$con->myQuery("SELECT c.`cntrct_id`,c.`cd`,c.`acc_code`,c.`debit_amount`,c.`credit_amount`,c.`clnt_id`,CONCAT(cl.fname,' ',cl.lname ) fullname FROM `cheque_dbcr` c INNER JOIN client_list cl ON c.clnt_id=cl.client_number WHERE `cv_id`='".$d."' and c.isDeleted='0'  ");
                    while ($row1=$query1->fetch(PDO::FETCH_NUM)) 
                    	
                    {
 ?>
 <tr>
                            
                           
                                          <td>
                                            <input class="form-control"  style="width: 100%; text-align: center;background-color: white; border: none transparent;" type="hidden" id="getallup" readonly value="<?php echo $_GET['id']; ?>"> 
                                            <input class="form-control"  style="width: 100%; text-align: center;background-color: white; border: none transparent;" type="text" id="getallup" readonly value="<?php echo $row1[0]; ?>"> 
                                          </td>
                                            <td>
                                            <input class="form-control"  style="border: none transparent;width: 100%;background-color: white; text-align: center;" type="text" id="getallup" readonly value="<?php echo $row1[1]; ?>">


                                          </td>
                                            <td>
                                            <input class="form-control"  style="border: none transparent;width: 100%;background-color: white; text-align: center;" type="text"  readonly value="<?php echo $row1[2]; ?>"> 
                                             </td>
                                            <td>
                                                   <input class="form-control debit"  style="border: none transparent;width: 100%;background-color: white; text-align: center;" type="text" readonly id="getallup" onkeyup="conditionedit();" value="<?php echo $row1[3]; ?>"> 
                                             </td>
                                            <td>
                                                 <input class="form-control credit"  style="border: none transparent;width: 100%;background-color: white; text-align: center;" type="text" id="getallup" readonly onkeyup="conditionedit();" value="<?php echo $row1[4]; ?>"> 
                                             </td>
                                            <td>
                                                 <input class="form-control credit"  style="border: none transparent;width: 100%;background-color: white; text-align: center;" type="text" id="getallup" readonly onkeyup="conditionedit();" value="<?php echo $row1[6]; ?>"> 
                                             </td>
                               
          
       

                   </tr>         
            
                             
 
                                    

<?php
$x+=1;

                    }

echo '       
        </tbody>
                </table>
            </div>



 <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <button type="button" class="btn btn-default btn-block pull-left" onclick="back();" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-xs-12 col-md-6">
                    </div>
              
                    <div class="col-xs-12 col-md-3">
                         <button type="button" class="btn btn-primary btn-block" id="updateget"  onclick="back();"> Okay</button>
                    </div>
                       
                             
</div>  ';
}
else
{

}



?>




        </section>



   
<script>
 

  function back() 
    {

        
               window.location.href='jv_gen_ledger.php';
          

    }



    var dttable="";
      $(document).ready(function() {
        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",
                "scrollX":"100%",
                "searching": false,
       
               "lengthChange": false,
               "bPaginate": false,
                "info": false,
                "bSort" : false,
    

   
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
<?php



   ?>
