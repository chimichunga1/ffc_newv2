
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
             <li class="active">Cheque Voucher  </li>
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

<?php 


if(!empty($_GET['id']))
{
  $d=$_GET['id'];



?>


                        

  <div class='form-group row'>
                                        <label class='col-sm-12 col-md-4 control-label' style="padding-top:10px;text-align:right;"> CV No. </label>
                                            <div class='col-sm-12 col-md-5'>
                                                <input type="text"  class="form-control numeric"  id="cv" >
                                            </div>

</div>

  

<div class="row" >
 
                            <div class="col-md-4" style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">Pay to</div>
                            <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Amount</div>
                            <div class="col-md-4"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Bank</div>
                            <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Cheque No.</div>
                     
</div>  

<div class="row" >
 
 <?php 
$queryv=$con->myQuery("SELECT c.`debit_amount`,CONCAT(cl.fname,' ',cl.lname) namee ,cl.client_number,c.cv_id FROM `cheque_dbcr` c INNER JOIN client_list cl ON cl.client_number=c.clnt_id WHERE NOT c.debit_amount='0' AND c.isDeleted='0' and `cv_v_id`='".$d."' ");
                    while ($rowv=$queryv->fetch(PDO::FETCH_NUM)) 
                    {
                      ?>
                            <div class="col-md-4" style="padding:10px;text-align:center;">
                                            
                                              <input class="form-control" readonly style="border: none transparent;width: 100%; text-align: center;" type="text"  value="<?php echo $rowv[1]; ?>"> 
                            </div>
                            <div class="col-md-2"  style="padding:10px;text-align:right;"> 
                                              <input class="form-control"   readonly style="border: none transparent;width: 100%; text-align: right;" type="text"  value="<?php echo number_format($rowv[0]); ?>"> 
                            </div>
                            <div class="col-md-4"  style="padding:10px;text-align:center;"> </div>
                            <div class="col-md-2"  style="padding:10px;text-align:center;"> </div>
                      <?php
                    }
  ?>
                       
                     
</div>            

<div class="row" >
 
 <?php 
$queryv=$con->myQuery("SELECT c.`credit_amount`,CONCAT(cl.fname,' ',cl.lname) namee ,cl.client_number,c.cv_id FROM `cheque_dbcr` c INNER JOIN client_list cl ON cl.client_number=c.clnt_id WHERE NOT c.credit_amount='0' AND c.isDeleted='0' and `cv_v_id`='".$d."'  ");
                    while ($rowv=$queryv->fetch(PDO::FETCH_NUM)) 
                    {
                      ?>
                            <div class="col-md-4" style="padding:10px;text-align:center;">
                                              <input class="form-control validatee"  type="hidden"  value="<?php echo $d; ?>"> 
                                              <input class="form-control validatee"  type="hidden"  value="<?php echo $rowv[3]; ?>"> 
                                              <input class="form-control validatee" readonly style="border: none transparent;width: 100%; text-align: center;" type="hidden"  value="<?php echo $rowv[2]; ?>"> 
                                              <input class="form-control" readonly style="border: none transparent;width: 100%; text-align: center;" type="text"  value="<?php echo $rowv[1]; ?>"> 
                            </div>
                            <div class="col-md-2"  style="padding:10px;text-align:right;"> 
                                              <input class="form-control "   readonly style="border: none transparent;width: 100%; text-align: right;" type="text"  value="<?php echo number_format($rowv[0]); ?>"> 
                            </div>
                            <div class="col-md-4" style="padding:10px;text-align:center;"> 
                                                  <select class="form-control cbo validatee " data-placeholder="Bank Name"  style="width: 100%;">
                                                  <?php echo makeOptions($bank) ?>
                                                  </select>

                            </div>
                            <div class="col-md-2" style="padding:10px;text-align:center;">
                                                  <input class="form-control validatee "  style="width: 100%;" type="text"  >
                             </div>
                      <?php
                    }
  ?>
                       
                     
</div>  

                   

    
      



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
                       
                             
</div>  
 <?php
}
else
{

}



?>




        </section>



   
<script>
 
  function back() 
    {

        
              window.location.href='cv_gl_validate.php';
          

    }

      function validcv()
    {

      var payload = new FormData();

        var cv= $("input#cv").val();

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

        var x=cv+'|cheque|'+valueinput+'|bank|'+valuebank;
console.log(x);
        payload.append('data', x);

          $.ajax({
            url: 'backend/validcv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
                window.location.href='cv_gl_validate.php';
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

