
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
                                        <li class="active" ><a href="cv_gen_ledger.php" >Check Voucher</a>
                                        </li>
                                        <li ><a href="jv_gen_ledger.php">Journal Voucher</a>
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
                            <th style="opacity: 0;"></th>
                            <th style="opacity: 0;"></th>
                                            
                        </tr>
                    </thead>
                    <tbody>
                                 <tr >
                            <td style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">Pay to</td>
                            <td style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">Amount</td>
                                            
                        </tr>       

<?php

          // $queryv=mysqli_query($conn,"SELECT c.`credit_amount`,CONCAT(cl.fname,' ',cl.lname) namee FROM `cheque_dbcr` c INNER JOIN client_list cl ON cl.client_number=c.clnt_id WHERE NOT c.credit_amount='0' AND c.isDeleted='0' and `cv_id`='".$d."' ");

          //           while ($rowv=mysqli_fetch_array($queryv)) 



$queryv=$con->myQuery("SELECT c.`credit_amount`,CONCAT(cl.fname,' ',cl.lname) namee FROM `cheque_dbcr` c INNER JOIN client_list cl ON cl.client_number=c.clnt_id WHERE NOT c.credit_amount='0' AND c.isDeleted='0' and `cv_id`='".$d."' ");
                    while ($rowv=$queryv->fetch(PDO::FETCH_NUM)) 
                      
                    {
 ?>
 <tr>
                            
                           
                                          <td>
                                                     <input class="form-control" id='did' type="hidden"  value="<?php echo $d; ?>"> 
                           
                                                  <input class="form-control" readonly style="border: none transparent;width: 100%; text-align: center;" type="text"  value="<?php echo $rowv[1]; ?>"> 
                                          </td>
                                            <td>
                                            <input class="form-control  validatee"   readonly style="border: none transparent;width: 100%; text-align: center;" type="text" id="getcredit" value="<?php echo $rowv[0]; ?>"> 


                                          </td>
                                  

                   </tr>         
            
                             
 
                                    

<?php

                    }

                    ?>

                   <tr >
                            <td style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">Bank </td>
                            <td style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">Amount</td>
                                            
                        </tr>

          <tr>
            <td>
                <select class="form-control cbo validatee " style="border: none transparent;width: 99%; text-align: center;" data-placeholder="Bank Name" >
                                                  <?php echo makeOptions($bank) ?>
                                                  </select>
            </td>
             <td>
                  <input class="form-control validatee"  style="width: 99%; text-align: center;" type="text" id="getamount" onkeyup="conditionvalid()"> 
            </td>

          </tr>
                    
              
                  
                       
                             
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

        
               window.location.href='cv_gen_ledger.php';
          

    }

      function validcv()
    {

      var payload = new FormData();

        var valueinput = $("input#did").val();

        var valuebank = $("select.validatee").val();


         var valueamount = $("input#getamount").val();
        // console.log(valueinput);

        var x=valueinput+'|'+valuebank+'|'+valueamount;
console.log(x);
        payload.append('data', x);

          $.ajax({
            url: 'backend/validcv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
               window.location.href='cv_gen_ledger.php';
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
         function conditionvalid() 
    {
       sumjq = function(selector) 
        {
            var sum = 0;
            $(selector).each(function() {
                sum += Number($(this).val());
            });
            return sum;
        }

        var credit = sumjq('input#getcredit');
        var amount =  sumjq('input#getamount');
        console.log(credit+' & '+amount);

        if (((Number(credit) === 0) || (Number(amount) === 0))) {
            $('#valid').attr("disabled", true);

        } else if (Number(credit) === Number(amount)) {

            $('#valid').attr("disabled", false);

        } else {
            $('#valid').attr("disabled", true);
        }
    }
    conditionvalid();

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

