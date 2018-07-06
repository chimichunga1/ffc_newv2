 

<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}

if (empty($_GET['tab'])) {
    $tab="1";
}
else {
    
    // $account=$con->myQuery("SELECT id,  CONCAT(first_name,' ',last_name) as `acc_name` FROM loan_list where id = {$_GET['id']}")->fetch(PDO::FETCH_ASSOC);
    
}

$accountcode=$con->myQuery("SELECT id,  CONCAT(acc_id,' ',account_name) FROM accounts where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

$accountno=$con->myQuery("SELECT id,  acc_id FROM accounts where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

makeHead("Distribution/Preparation",1);




// $maxcv=mysqli_query($conn,'SELECT max(cntrct_id) from cheque_voucher '); $maxfetch=mysqli_fetch_array($maxcv); echo $maxfetch[0]+200001;

$account=$con->myQuery("SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

// $bank=$con->myQuery("SELECT id,  name FROM bank where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
$cv_no=$con->myQuery("SELECT c.cv_id, c.cv_no FROM `cheque_voucher` c WHERE  c.isDeleted=0 and c.isValidated=0")->fetchAll(PDO::FETCH_ASSOC);

require_once("../template/header.php");
require_once("../template/sidebar.php");


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Cheque Voucher Entries</h1>                
           
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








   <form action="tableresultcv.php" method="POST" class="form-horizontal" id='addcv'>
                              
                                   <div class='form-group row'>
                                        <label class='col-sm-12 col-md-1 control-label'> CV No: </label>
                                            <div class='col-sm-12 col-md-3'>
                                                <input type="text" readonly class="form-control" value="<?php echo date('Ymd'); ?>" name='cv' id='cv' >
                                            </div>

                              
                                    <label class='col-sm-12 col-md-1 control-label'> Name:</label>
                                        <div class='col-sm-12 col-md-3'>
                                            <select class='form-control cbo' style="width: 100%;" name='client'  required data-placeholder="Name" id='client' >
                                            <?php echo makeOptions($account) ?>
                                            </select>
                                    </div>
                       
                                        <label class='col-sm-12 col-md-1 control-label'> Amount: </label>
                                            <div class='col-sm-12 col-md-3'>
                                                <input type="text" class="form-control" style="text-align:right;" name='debit' onkeyup="db()" required placeholder="Enter Amount" id='amount' >
                                            </div>

                                    </div> 

                                        <div class='form-group row'>
                                        <label class='col-md-1 col-xs-21 '> &nbsp;Details: </label>
                               
                               
                                 
                                        <div class='col-md-11  col-xs-12'>
                                            <textarea class='form-control'style="width: 100%;resize:none;" required rows="5"  name='details' id='details' placeholder="Details" id='details' required></textarea>
                                        </div>
                                    </div>

 
    
  

                                    <div class='form-group '>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Pay to: </label>
                                            <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <select class="form-control cbo" data-placeholder="Name Pay To" id='npt1' name='npt1' required style="width: 100%;" >
                                                 <?php echo makeOptions($account) ?>
                                                </select>
                                            </div>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Amount: </label>  
                                              <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <input class="form-control" type="text" style="text-align:right;" required onkeyup="cr()" id='cr1' name="cr1">    
                                              </div>
                                    </div>
                                    <div class='form-group '>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Pay to: </label>
                                            <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <select class="form-control cbo" data-placeholder="Name Pay To" id='npt2' name='npt2'  style="width: 100%;" >
                                                 <?php echo makeOptions($account) ?>
                                                </select>
                                            </div>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Amount: </label>  
                                              <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <input class="form-control" type="text" style="text-align:right;"  onkeyup="cr()" id='cr2' name="cr2">    
                                              </div>
                                    </div> 
                                     <div class='form-group '>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Pay to: </label>
                                            <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <select class="form-control cbo" data-placeholder="Name Pay To" id='npt3' name='npt3' style="width: 100%;" >
                                                 <?php echo makeOptions($account) ?>
                                                </select>
                                            </div>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Amount: </label>  
                                              <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <input class="form-control" type="text" style="text-align:right;" onkeyup="cr()" id='cr3' name="cr3">    
                                              </div>
                                    </div> 
                                    <div class='form-group '>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Pay to: </label>
                                            <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <select class="form-control cbo" data-placeholder="Name Pay To" id='npt4' name='npt4'  style="width: 100%;" >
                                                 <?php echo makeOptions($account) ?>
                                                </select>
                                            </div>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Amount: </label>  
                                              <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <input class="form-control" type="text" style="text-align:right;" onkeyup="cr()" id='cr4' name="cr4">    
                                              </div>
                                    </div> 
                                     <div class='form-group '>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Pay to: </label>
                                            <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <select class="form-control cbo" data-placeholder="Name Pay To" id='npt5' name='npt5' style="width: 100%;" >
                                                 <?php echo makeOptions($account) ?>
                                                </select>
                                            </div>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Amount: </label>  
                                              <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <input class="form-control" type="text" style="text-align:right;" onkeyup="cr()" id='cr5' name="cr5" >    
                                              </div>
                                    </div> 
                                    
                           






<hr>



                                    <div class='form-group '>
                                    
                                          <label class='col-sm-12 col-md-1 control-label'> ∑BD: </label>
                                            <div class='col-sm-12 col-md-5'>
                                                
                                                <input class="form-control"  readonly type="text"  id='DB'  >
                                                    
                                            </div>
                                          <label class='col-sm-12 col-md-1 control-label'> ∑CR: </label>  
                                              <div class='col-sm-12 col-md-5'>
                                                 <input class="form-control"  readonly type="text"  id='CR'  >
                                                    
                                              </div>
                                            
                                          
                                       
                                    </div> 
                       
                                   


                                    
                                    <div class='form-group'>

                                         <div class='col-sm-1 col-md-3  '>
                                         </div>
                                          <div class='col-sm-5 col-md-3 '>
                                            <button type='submit' class='btn btn-primary btn-flat btn-block'  id='sumcv'><span class="fa fa-check"></span> Confirm</button>
                                          
                                        </div>


                                        <div class='col-sm-5 col-md-3  '>
                                          
                                           <button type='button' class='btn btn-flat btn-block ' onclick='cancelcv()'><span class="fa fa-times"></span> Clear</button>
                                        </div>
                                         <div class='col-sm-1 col-md-3  '>
                                         </div>

                                    </div>     

                                </form>
                                </div>




      
        </section>



   
<script>
   





 

    function cancelcv() 
    {
        $("select").each(function() {
            $(this).val('').trigger('change');
        });
        $("input").each(function() {
            $(this).val('').trigger('change');
        });
        $("textarea").each(function() {
            $(this).val('').trigger('change');
        });


          $('input#cv').val('<?php echo date("Ymd"); ?>').trigger('change');

    }




    function db() 
    {


        var val = $('#amount').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('amount').value = val;



        document.getElementById('DB').value = $('#amount').val();

   conditionadd();

    }



    function cr() 
    {

        if($('#cr1').val() != "") {
        var val = $('#cr1').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr1').value = val;
        var cr1=Number(parseFloat($('#cr1').val().replace(/,/g, '')));
        }
        else
        {
            var cr1=0;
        }
        if($('#cr2').val() != "") {
        var val = $('#cr2').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr2').value = val;
        var cr2=Number(parseFloat($('#cr2').val().replace(/,/g, '')));
        }
        else
        {
            var cr2=0;
        }
        if($('#cr3').val() != "") {
        var val = $('#cr3').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr3').value = val;
        var cr3=Number(parseFloat($('#cr3').val().replace(/,/g, '')));
        }
        else
        {
            var cr3=0;
        }
        if($('#cr4').val() != "") {
        var val = $('#cr4').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr4').value = val;
        var cr4=Number(parseFloat($('#cr4').val().replace(/,/g, '')));
        }
        else
        {
            var cr4=0;
        }
        if($('#cr5').val() != "") {
        var val = $('#cr5').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr5').value = val;
        var cr5=Number(parseFloat($('#cr5').val().replace(/,/g, '')));
        }
        else
        {
            var cr5=0;
        }

       
        var total = cr1 + cr2 + cr3 + cr4 + cr5;
        console.log(total);



        var val = total.toString();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        console.log(val);
        document.getElementById('CR').value =val;
        // console.log(Number($('#CR').val()));
        // console.log(Number($('#DB').val()));

   conditionadd();

  
    }
 








    function conditionadd() 
    {
        if (((($('#DB').val()) == "") || (($('#CR').val()) == ""))) {
            $('#sumcv').attr("disabled", true);
        } else if (($('#DB').val()) === ($('#CR').val())) {

            $('#sumcv').attr("disabled", false);

        } else {
            $('#sumcv').attr("disabled", true);
        }
    }








    conditionadd();










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
