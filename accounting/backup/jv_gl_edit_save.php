
 

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


// $accountno=$con->myQuery("SELECT acc_types_id, name FROM account_types ")->fetchAll(PDO::FETCH_ASSOC);
$accountno=$con->myQuery("SELECT id,  acc_id FROM accounts where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

$accountcode=$con->myQuery("SELECT id,  acc_id FROM accounts where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);


require_once("../template/header.php");
require_once("../template/sidebar.php");


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Account Distribution</h1>                
           
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




 <div class='form-group '>
   <div class=' col-md-3'>
      <input class="form-control numeric"  value="0" type="hidden"  id='numfields'  >
 </div>
 <div class=' col-md-3'>
      <input class="form-control" value="<?php echo $_GET['id']; ?>"   type="hidden"  id='numjv'  >
 </div>
 <div class=' col-md-3'>
   
</div>
 <div class='col-xs-12 col-md-3'>
   <button class="add_form_field btn btn-primary btn-block btn-flat">Add Inputs &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
 </div>
</div>
    
    <br>
    <Br>

                          <div class="containerzero" >
                                    <div class='form-group row '>
                                    
                                              <label class='col-md-2'>
                                                Account No.
                                           
                                            </label>

                                            <label class='col-md-1'>
                                              CD
                                                
                                              </label>

                                               <label class='col-md-2'>
                                               Account Code

                                            </label>
                                             <label class='col-md-2'>
                                                Debit
                                              </label>

                                              <label class='col-md-2'>
                                                 Credit
                                              </label>
                                            <label class='col-md-2'>
                                                  Client
                                            </label>
                                            <label class='col-md-1'>
                                            
                                              </label>
                                     
                                            
                                            
                                          
                                       
                                    </div> 
                                </div>
                 

                                <div class="containerzero">
                                    <div class='form-group row'>
                                    
                                              <div class='col-md-2'>
                                                 <select class="cbo form-control " data-placeholder="" id='selectfield'   style="width: 100%;" >
                                      
                                                 <?php echo makeOptions($accountno) ?>
                                                </select>

                                            </div>

                                            <div class='col-md-1'>
                                                 <input class="form-control numeric"  type="text" onkeyup="cr()" class="numeric" id='selectfield1'  >
                                                    
                                              </div>

                                               <div class='col-md-2'>
                                                 <select class="cbo form-control " data-placeholder="" id='selectfield'   style="width: 100%;" >
                                               
                                                 <?php echo makeOptions($accountcode) ?>
                                                </select>

                                            </div>
                                             <div class='col-md-2'>
                                                 <input class="form-control numeric credit"  type="text" onkeyup="conditionedit()" value='0' class="numeric" id='selectfield1'  >
                                                    
                                              </div>

                                              <div class='col-md-2'>
                                                 <input class="form-control numeric debit"  type="text" onkeyup="conditionedit()" value='0' class="numeric" id='selectfield1'  >
                                                    
                                              </div>
                                            <div class='col-md-2'>
                                                 <select class="cbo form-control " data-placeholder="Name Pay To" id='selectfield'   style="width: 100%;" >
                                                    <?php

                                              if (!empty($_GET['id']))

                                              {
                                              $masterqueryacc="SELECT a.client_number, CONCAT(a.fname,' ',a.lname) AS `acc_name`   FROM journal_voucher j INNER JOIN client_list a ON j.clnt_id=a.client_number WHERE j.isDeleted=0 AND a.is_deleted = 0 AND j.jv_no='".$_GET['id']."' ";

                                              $queryacc=$con->myQuery($masterqueryacc);

                                              $rowacc=$queryacc->fetch(PDO::FETCH_NUM);
                                              echo '<option  value="0">&nbsp;</option>';
                                              echo '<option selected value="'.$rowacc[0].'">'.$rowacc[1].'</option>';
                                              

                                              }


                                              ?>
                                                 <?php echo makeOptions($account) ?>
                                                </select>

                                            </div>
                                            <div class='col-md-1'>
                                                 
                                              </div>
                                     
                                            
                                            
                                          
                                       
                                    </div> 
                                </div>


                                       <div class="containerzero">
                                    <div class='form-group row'>
                                    
                                              <div class='col-md-2'>
                                                 <select class="cbo form-control " data-placeholder="" id='selectfield'   style="width: 100%;" >
                                            
                                                 <?php echo makeOptions($accountno) ?>
                                                </select>

                                            </div>

                                            <div class='col-md-1'>
                                                 <input class="form-control numeric"  type="text" onkeyup="cr()" class="numeric" id='selectfield1'  >
                                                    
                                              </div>

                                               <div class='col-md-2'>
                                                 <select class="cbo form-control " data-placeholder="" id='selectfield'   style="width: 100%;" >
                                            
                                                 <?php echo makeOptions($accountcode) ?>
                                                </select>

                                            </div>
                                             <div class='col-md-2'>
                                                 <input class="form-control numeric credit"  type="text" onkeyup="conditionedit()"  value='0' class="numeric" id='selectfield1'  >
                                                    
                                              </div>

                                              <div class='col-md-2'>
                                                 <input class="form-control numeric debit"  type="text" onkeyup="conditionedit()" value='0' class="numeric" id='selectfield1'  >
                                                    
                                              </div>
                                            <div class='col-md-2'>
                                                 <select class="cbo form-control " data-placeholder="Name Pay To" id='selectfield'   style="width: 100%;" >
                                                          <?php

                                              if (!empty($_GET['id']))

                                              {
                                              $masterqueryacc="SELECT a.client_number, CONCAT(a.fname,' ',a.lname) AS `acc_name`   FROM journal_voucher j INNER JOIN client_list a ON j.clnt_id=a.client_number WHERE j.isDeleted=0 AND a.is_deleted = 0 AND j.jv_no='".$_GET['id']."' ";

                                              $queryacc=$con->myQuery($masterqueryacc);

                                              $rowacc=$queryacc->fetch(PDO::FETCH_NUM);
                                              echo '<option  value="0">&nbsp;</option>';
                                              echo '<option selected value="'.$rowacc[0].'">'.$rowacc[1].'</option>';
                                              

                                              }


                                              ?>
                                        
                                                 <?php echo makeOptions($account) ?>
                                                </select>

                                            </div>
                                            <div class='col-md-1'>
                                                 
                                              </div>
                                     
                                            
                                            
                                          
                                       
                                    </div> 
                                </div>
       <div class="addcontain">
<?php for ($i=0; $i < 20; $i++) { 
?>
                    <?php echo '<div class="container'.$i.'" style="display:none;" id="downs"> ' ; ?>
                                    <div class='form-group row'>
                                    
                                               <div class='col-md-2'>
                                                 <select class="cbo form-control " data-placeholder="" id='selectfield'   style="width: 100%;" >
                                           
                                                 <?php echo makeOptions($accountno) ?>
                                                </select>

                                            </div>

                                            <div class='col-md-1'>
                                                 <input class="form-control numeric"  type="text" onkeyup="cr()" class="numeric" id='selectfield1'  >
                                                    
                                              </div>

                                               <div class='col-md-2'>
                                                 <select class="cbo form-control " data-placeholder="" id='selectfield'   style="width: 100%;" >
                                                                                           <?php echo makeOptions($accountcode) ?>
                                                </select>

                                            </div>
                                             <div class='col-md-2'>
                                                 <input class="form-control numeric credit"  type="text" onkeyup="conditionedit()" class="numeric" id='selectfield1'  >
                                                    
                                              </div>

                                              <div class='col-md-2'>
                                                 <input class="form-control numeric debit"  type="text" onkeyup="conditionedit()" class="numeric" id='selectfield1'  >
                                                    
                                              </div>
                                            <div class='col-md-2'>
                                                 <select class="cbo form-control " data-placeholder="" id='selectfield'   style="width: 100%;" >



                                       
                                                 <?php echo makeOptions($account) ?>
                                                </select>

                                            </div>
                                         
                                     
                                            
                                            <a href="#"  class="delete btn btn-danger "><i class="fa fa-times"></i></a>
                                       
                                    </div> 
                                </div>
<?php
}          

    ?>



</div>         









    
        </div>
              
            </div>



 <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <button type="button" class="btn btn-default btn-block pull-left" onclick="back();" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-xs-12 col-md-6">
                    </div>
              
                    <div class="col-xs-12 col-md-3">
                         <button type="button" class="btn btn-primary btn-block" id="updateget"  onclick="getallupdate();">Save changes</button>
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

        
              window.location.href='jv_gl_entries.php';
          

    }

  
    
   
  $("input").css({'text-align':'center'});


    function getallupdate() 
    {

     

            var valueinput = $("input#selectfield1").map(function() {
   
                return this.value

        }).get().join('|');
        var valueselect = $("select#selectfield").map(function() {
          
                return this.value
     
        }).get().join('|');

         var valuesfields = $("input#numfields").val() ;
          var valuesfields1 = $("input#numjv").val() ;
     

        var x = valueinput+"|client|"+valueselect+'|fields|'+valuesfields+'|'+valuesfields1;
        console.log(x);
        var payload = new FormData();
        payload.append('data', x);
        $.ajax({
            url: 'backend/updatejv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
               window.location.href='jv_gl_entries.php';
               // location.reload();
            },
            success: function(data) {
                swal({
                    title: "Success!",
                    text: "Successfully Update!",
                    type: "success",
                    showConfirmButton: false
                });

            },
            cache: false,
            contentType: false,
            processData: false
        });

    }

    

  
conditionedit();
  function conditionedit() 
    {
       sumjq = function(selector) 
        {
            var sum = 0;
            $(selector).each(function() {
         sum += Number($(this).val())  ;
            });
            return sum;
        }

        var credit = sumjq('input.credit');
        var debit =  sumjq('input.debit');
        console.log(credit+' & '+debit);




        if (((Number(credit) === 0) || (Number(debit) === 0))) {
            $('#updateget').attr("disabled", true);

        } else if (Number(credit) === Number(debit)) {

            $('#updateget').attr("disabled", false);

        } else {
            $('#updateget').attr("disabled", true);
        }
    }




    $(document).ready(function() 
    {

        var wrapper = $(".addcontain");
        var add_button = $(".add_form_field");
        var y = 0;
        var z=0;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (y == 'undefined' || y === null) {
                y = 0;
            }
            x = '.container' + y;
            $(x).css({
                "display": "block"
            });
               $('input#numfields').val(z=z + 1);
            console.log(y = y + 1);
         

        });

        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
            $(this).parent('div').each(function() {
                $(this).val('').trigger('change');
            });

           $('input#numfields').val(z=z - 1);


       
conditionedit();

        })
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
