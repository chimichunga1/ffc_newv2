
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
$bank=$con->myQuery("SELECT id,  name FROM bank where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

require_once("../template/header.php");
require_once("../template/sidebar.php");


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Validation</h1>                
           
          <ol class="breadcrumb">
           <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>
            <li ><a href="#" >   <i class="fa fa-file-text"></i>General Ledger Entries </a> </li>
             <li class="active">Journal Voucher  </li>
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
                                          
                                                <h4>JV No. <?php echo $_GET['id']; ?> </h4>   
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
                            <th style="opacity: 0;"></th>
                            <th style="opacity: 0;"></th>
                            <th style="opacity: 0;"></th>
                         
                                            
                        </tr>
                    </thead>
                    <tbody>
                                 <tr >
                            <td style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">Client</td>
                            <td style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">Amount</td>
                            <td style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">Bank </td>
                   
                                            
                        </tr>       

<?php

          // $queryv=mysqli_query($conn,"SELECT c.`credit_amount`,CONCAT(cl.fname,' ',cl.lname) namee FROM `cheque_dbcr` c INNER JOIN client_list cl ON cl.client_number=c.clnt_id WHERE NOT c.credit_amount='0' AND c.isDeleted='0' and `cv_id`='".$d."' ");

          //           while ($rowv=mysqli_fetch_array($queryv)) 



$queryv=$con->myQuery("SELECT j.`credit_amount`,CONCAT(cl.fname,' ',cl.lname) namee ,cl.client_number,j.jv_id FROM `journal_dbcr` j INNER JOIN client_list cl ON cl.client_number=j.clnt_id WHERE NOT j.credit_amount='0' AND j.isDeleted='0' and `jv_no`='".$d."' ");
                    while ($rowv=$queryv->fetch(PDO::FETCH_NUM)) 
                      
                    {
 ?>
 <tr>
                            
                           
                                          <td>
                                                     <input class="form-control validatee"  type="hidden"  value="<?php echo $d; ?>"> 
                                                          <input class="form-control validatee"  type="hidden"  value="<?php echo $rowv[3]; ?>"> 
                                             <input class="form-control validatee" readonly style="border: none transparent;width: 100%; text-align: center;" type="hidden"  value="<?php echo $rowv[2]; ?>"> 
                                                  <input class="form-control" readonly style="border: none transparent;width: 100%; text-align: center;" type="text"  value="<?php echo $rowv[1]; ?>"> 
                                          </td>
                                            <td>
                                            <input class="form-control  validatee"   readonly style="border: none transparent;width: 100%; text-align: center;" type="text"  value="<?php echo $rowv[0]; ?>"> 


                                          </td>
                                  

            <td width="20%">
               <select class="form-control cbo validatee "  data-placeholder="Bank Name" >
                                                  <?php echo makeOptions($bank) ?>
                                                  </select> 
            </td>
         

    

                   </tr>         
            
                             
 
                                    

<?php

                    }

                    ?>

        
                    
              
                  
                       
                             
</div>
                    <?php

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
                         <button type="button" class="btn btn-primary btn-block" id="valid" onclick="validcv()">Validate</button>
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

        
              window.location.href='jv_gl_entries.php';
          

    }

      function validcv()
    {

      var payload = new FormData();

       

           var valueinput = $("input.validatee").map(function() {
            if (this.value !== '') {
                return this.value
            };
        }).get().join('|');

           var valuebank = $("select.validatee").map(function() {
            if (this.value !== '') {
                return this.value
            };
        }).get().join('|');


        // console.log(valueinput);

        var x=valueinput+'|bank|'+valuebank;
console.log(x);
        payload.append('data', x);

          $.ajax({
            url: 'backend/validjv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
                window.location.href='jv_gl_entries.php';
                // location.reload();
            },
            success: function(data) {
                swal({
                    title: "Success!",
                    text: "Successfully Validated!",
                    type: "success",
                    showConfirmButton: false
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });

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

