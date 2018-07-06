 

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

$accountno=$con->myQuery("SELECT a.id, CONCAT(a.acc_no,' ',cl.fname, ' ',cl.lname ) FROM client_list cl INNER JOIN account_no a on a.clnt_id=cl.client_number  where cl.is_deleted = 0 ")->fetchAll(PDO::FETCH_ASSOC);

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
         
        <h1 class="text-primary">Account Distribution</h1>                
           
          <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>
            <li ><a href="#" >   <i class="fa fa-file-text"></i>General Ledger Entries </a> </li>
             <li class="active">Cheque Voucher </li>
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
                                          

<?php  
//////////////////////////////////////////////////////////////////////////////////////////////// 
$cv=$_POST['cv'];
$client=$_POST['client'];
$debit=$_POST['debit'];
$details=$_POST['details'];
$npt1=$_POST['npt1'];
$cr1=$_POST['cr1'];
$npt2=$_POST['npt2'];
$cr2=$_POST['cr2'];
$npt3=$_POST['npt3'];
$cr3=$_POST['cr3'];
$npt4=$_POST['npt4'];
$cr4=$_POST['cr4'];
$npt5=$_POST['npt5'];
$cr5=$_POST['cr5'];

if(empty($cr1))
{
  $cr1=0;
}
if(empty($cr2))
{
  $cr2=0;
}
if(empty($cr3))
{
  $cr3=0;
}
if(empty($cr4))
{
  $cr4=0;
}
if(empty($cr5))
{
  $cr5=0;
}



//////////////////////////////////////////////////////////////////////////////////////////////// 
?>







                                </div>

 <form class="form-horizontal" id='addcv'>

<div class="row" >
 
                            <div class="col-md-2" style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Account No.</div>
                            <div class="col-md-1"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> CD</div>
                            <div class="col-md-3"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Account Code</div>
                            <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Debit</div>
                            <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Credit</div>
                             <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Client</div>
</div>            


<div class="row" style="padding:10px;">
 
                            <div class="col-md-2" style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   id="an1">           
                                                      <?php echo  makeOptions($accountno); ?>
                                              </select>
                            </div>
                            <div class="col-md-1"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall" id='cd1'  style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" >
                      
                            </div>
                            <div class="col-md-3"  style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   id="ac1">
                                                      <?php
                                                    
                                                      $masterquerycode="SELECT id, CONCAT(acc_id,' ',account_name) as `acc_name`  FROM accounts where  id='0' ";
                                                      $querycode=$con->myQuery($masterquerycode);
                                                      $rowcode=$querycode->fetch(PDO::FETCH_NUM);
                                                      echo '<option selected value="'.$rowcode[0].'">'.$rowcode[1].'</option>';
                                                                                                            ?>
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db1" onkeyup="conditionadd()" value="<?php echo $debit ?>"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="cr1" onkeyup="conditionadd()" value="0">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   id="cl1">
                                                      <?php
                                                      if (!empty($client))
                                                      {
                                                      $masterqueryacc="SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where client_number='".$client."' ";
                                                      $queryacc=$con->myQuery($masterqueryacc);
                                                      $rowacc=$queryacc->fetch(PDO::FETCH_NUM);
                                                      echo '<option selected value="'.$rowacc[0].'">'.$rowacc[1].'</option>';
                                                      }
                                                      ?>
                                                      <?php echo  makeOptions($account); ?>
                                              </select>
                            </div>
</div>              
 
<?php /////////////////////////////////////////////////////////////////////////////////////////// ?>
   
<div class="row" style="padding:10px;">
 
                            <div class="col-md-2" style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   id="an2">           
                                                      <?php echo  makeOptions($accountno); ?>
                                              </select>
                            </div>
                            <div class="col-md-1"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall" id='cd2'  style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" >
                      
                            </div>
                            <div class="col-md-3"  style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   id="ac2">
                                                <?php
                                                   if(!empty($npt1))
                                                {
                                                $masterquerycode="SELECT id, CONCAT(acc_id,' ',account_name) as `acc_name`  FROM accounts where  id='5' ";
                                                $querycode=$con->myQuery($masterquerycode);
                                                $rowcode=$querycode->fetch(PDO::FETCH_NUM);
                                                echo '<option selected value="'.$rowcode[0].'">'.$rowcode[1].'</option>';
                                              }
                                                ?>
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db2" onkeyup="conditionadd()"  value="0"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="cr2" onkeyup="conditionadd()"  value="<?php echo $cr1 ?>">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   id="cl2">
                                                      <?php
                                                      if (!empty($npt1))
                                                      {
                                                      $masterqueryacc="SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where client_number='".$npt1."' ";
                                                      $queryacc=$con->myQuery($masterqueryacc);
                                                      $rowacc=$queryacc->fetch(PDO::FETCH_NUM);
                                                      echo '<option selected value="'.$rowacc[0].'">'.$rowacc[1].'</option>';
                                                      }
                                                      ?>
                                                      <?php echo  makeOptions($account); ?>
                                              </select>
                            </div>
</div>                                        

<?php /////////////////////////////////////////////////////////////////////////////////////////// 



?>
   
<div class="row" style="padding:10px;">
 
                            <div class="col-md-2" style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall getall" data-placeholder=""   id="an3">           
                                                      <?php echo  makeOptions($accountno); ?>
                                              </select>
                            </div>
                            <div class="col-md-1"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall" id='cd3' style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" >
                      
                            </div>
                            <div class="col-md-3"  style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   id="ac3">
                                                <?php
                                                   if(!empty($npt2))
                                                {
                                                $masterquerycode="SELECT id, CONCAT(acc_id,' ',account_name) as `acc_name`  FROM accounts where  id='5' ";
                                                $querycode=$con->myQuery($masterquerycode);
                                                $rowcode=$querycode->fetch(PDO::FETCH_NUM);
                                                echo '<option selected value="'.$rowcode[0].'">'.$rowcode[1].'</option>';
                                                }
                                                ?>
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db3" onkeyup="conditionadd()"  value="0"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="cr3" onkeyup="conditionadd()"  value="<?php echo $cr2 ?>">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   id="cl3">
                                                      <?php
                                                      if (!empty($npt2))
                                                      {
                                                      $masterqueryacc="SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where client_number='".$npt2."' ";
                                                      $queryacc=$con->myQuery($masterqueryacc);
                                                      $rowacc=$queryacc->fetch(PDO::FETCH_NUM);
                                                      echo '<option selected value="'.$rowacc[0].'">'.$rowacc[1].'</option>';
                                                      }
                                                      ?>
                                                      <?php echo  makeOptions($account); ?>
                                              </select>
                            </div>
</div>                  
<?php /////////////////////////////////////////////////////////////////////////////////////////// 

?>
   
<div class="row" style="padding:10px;">
 
                            <div class="col-md-2" style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   id="an4">           
                                                      <?php echo  makeOptions($accountno); ?>
                                              </select>
                            </div>
                            <div class="col-md-1"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall" id='cd4' style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" >
                      
                            </div>
                            <div class="col-md-3"  style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   id="ac4">
                                                <?php
                                                if(!empty($npt3))
                                                {
                                                $masterquerycode="SELECT id, CONCAT(acc_id,' ',account_name) as `acc_name`  FROM accounts where  id='5' ";
                                                $querycode=$con->myQuery($masterquerycode);
                                                $rowcode=$querycode->fetch(PDO::FETCH_NUM);
                                                echo '<option selected value="'.$rowcode[0].'">'.$rowcode[1].'</option>';
                                                }
                                                ?>
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db4" onkeyup="conditionadd()"  value="0"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="cr4" onkeyup="conditionadd()"  value="<?php echo $cr3 ?>">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   id="cl4">
                                                      <?php
                                                      if (!empty($npt3))
                                                      {
                                                      $masterqueryacc="SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where client_number='".$npt3."' ";
                                                      $queryacc=$con->myQuery($masterqueryacc);
                                                      $rowacc=$queryacc->fetch(PDO::FETCH_NUM);
                                                      echo '<option selected value="'.$rowacc[0].'">'.$rowacc[1].'</option>';
                                                      }
                                                      ?>
                                                      <?php echo  makeOptions($account); ?>
                                              </select>
                            </div>
</div>        

<?php /////////////////////////////////////////////////////////////////////////////////////////// 

?>
   
<div class="row" style="padding:10px;">
 
                            <div class="col-md-2" style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   id="an5">           
                                                      <?php echo  makeOptions($accountno); ?>
                                              </select>
                            </div>
                            <div class="col-md-1"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall" id='cd5'  style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" >
                      
                            </div>
                            <div class="col-md-3"  style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   id="ac5">
                                                <?php
                                                if(!empty($npt4))
                                                {
                                                $masterquerycode="SELECT id, CONCAT(acc_id,' ',account_name) as `acc_name`  FROM accounts where  id='5' ";
                                                $querycode=$con->myQuery($masterquerycode);
                                                $rowcode=$querycode->fetch(PDO::FETCH_NUM);
                                                echo '<option selected value="'.$rowcode[0].'">'.$rowcode[1].'</option>';
                                                }
                                                ?>
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db5" onkeyup="conditionadd()"  value="0"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="cr5" onkeyup="conditionadd()"  value="<?php echo $cr4 ?>">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   id="cl5">
                                                      <?php
                                                      if (!empty($npt4))
                                                      {
                                                      $masterqueryacc="SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where client_number='".$npt4."' ";
                                                      $queryacc=$con->myQuery($masterqueryacc);
                                                      $rowacc=$queryacc->fetch(PDO::FETCH_NUM);
                                                      echo '<option selected value="'.$rowacc[0].'">'.$rowacc[1].'</option>';
                                                      }
                                                      ?>
                                                      <?php echo  makeOptions($account); ?>
                                              </select>
                            </div>
</div>                                        


<?php /////////////////////////////////////////////////////////////////////////////////////////// 


?>
   
<div class="row" style="padding:10px;">
 
                            <div class="col-md-2" style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   id="an6">           
                                                      <?php echo  makeOptions($accountno); ?>
                                              </select>
                            </div>
                            <div class="col-md-1"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall" id='cd6' style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" >
                      
                            </div>
                            <div class="col-md-3"  style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   id="ac6">
                                                <?php
                                                if(!empty($npt5))
                                                {
                                                $masterquerycode="SELECT id, CONCAT(acc_id,' ',account_name) as `acc_name`  FROM accounts where  id='5' ";
                                                $querycode=$con->myQuery($masterquerycode);
                                                $rowcode=$querycode->fetch(PDO::FETCH_NUM);
                                                echo '<option selected value="'.$rowcode[0].'">'.$rowcode[1].'</option>';
                                                }
                                                ?>
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db6" onkeyup="conditionadd()"  value="0"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="cr6" onkeyup="conditionadd()"  value="<?php echo $cr5 ?>">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   id="cl6">
                                                      <?php
                                                      if (!empty($npt5))
                                                      {
                                                      $masterqueryacc="SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where client_number='".$npt5."' ";
                                                      $queryacc=$con->myQuery($masterqueryacc);
                                                      $rowacc=$queryacc->fetch(PDO::FETCH_NUM);
                                                      echo '<option selected value="'.$rowacc[0].'">'.$rowacc[1].'</option>';
                                                      }
                                                      ?>
                                                      <?php echo  makeOptions($account); ?>
                                              </select>
                            </div>
</div>                                        

<?php 

?>

     


 <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <button type="button" class="btn btn-default btn-block pull-left" onclick="back()" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-xs-12 col-md-6">
                    </div>
              
                    <div class="col-xs-12 col-md-3">
                         <button type="button" class="btn btn-primary btn-block" id="sumcv"  onclick="addcv()">Save</button>
                    </div>
                       
                             
</div>  

</form>


      
        </section>



   
<script>
   


 var totaldb=0;
 var totalcr=0;


 

    function back() 
    {
        window.history.back();
    }




    function db() 
    {

   

          if($('input#db1').val() != "") {
          var val = $('input#db1').val();
            val = val.replace(/[^0-9]/g,'');
            if(val != "") {
              valArr = val.split('.');
              valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
              val = valArr.join('.');
            }
          document.getElementById('db1').value = val;
          var db1=Number(parseFloat($('input#db1').val().replace(/,/g, '')));
          }
          else
          {
              var db1=0;
          }
                 if($('input#db2').val() != "") {
          var val = $('input#db2').val();
            val = val.replace(/[^0-9]/g,'');
            if(val != "") {
              valArr = val.split('.');
              valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
              val = valArr.join('.');
            }
          document.getElementById('db2').value = val;
          var db2=Number(parseFloat($('input#db2').val().replace(/,/g, '')));
          }
          else
          {
              var db2=0;
          }

       if($('input#db3').val() != "") {
          var val = $('input#db3').val();
            val = val.replace(/[^0-9]/g,'');
            if(val != "") {
              valArr = val.split('.');
              valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
              val = valArr.join('.');
            }
          document.getElementById('db3').value = val;
          var db3=Number(parseFloat($('input#db3').val().replace(/,/g, '')));
          }
          else
          {
              var db3=0;
          }

       if($('input#db4').val() != "") {
          var val = $('input#db4').val();
            val = val.replace(/[^0-9]/g,'');
            if(val != "") {
              valArr = val.split('.');
              valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
              val = valArr.join('.');
            }
          document.getElementById('db4').value = val;
          var db4=Number(parseFloat($('input#db4').val().replace(/,/g, '')));
          }
          else
          {
              var db4=0;
          }

       if($('input#db5').val() != "") {
          var val = $('input#db5').val();
            val = val.replace(/[^0-9]/g,'');
            if(val != "") {
              valArr = val.split('.');
              valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
              val = valArr.join('.');
            }
          document.getElementById('db5').value = val;
          var db5=Number(parseFloat($('input#db5').val().replace(/,/g, '')));
          }
          else
          {
              var db5=0;
          }

       if($('input#db6').val() != "") {
          var val = $('input#db6').val();
            val = val.replace(/[^0-9]/g,'');
            if(val != "") {
              valArr = val.split('.');
              valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
              val = valArr.join('.');
            }
          document.getElementById('db6').value = val;
          var db6=Number(parseFloat($('input#db6').val().replace(/,/g, '')));
          }
          else
          {
              var db6=0;
          }


     
      

        



        
         totaldb = db1 + db2 + db3 + db4 + db5 + db6;
        console.log(totaldb);


  

    }



    function cr() 
    {

        if($('input#cr1').val() != "") {
        var val = $('input#cr1').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr1').value = val;
        var cr1=Number(parseFloat($('input#cr1').val().replace(/,/g, '')));
        }
        else
        {
            var cr1=0;
        }
        if($('input#cr2').val() != "") {
        var val = $('input#cr2').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr2').value = val;
        var cr2=Number(parseFloat($('input#cr2').val().replace(/,/g, '')));
        }
        else
        {
            var cr2=0;
        }
        if($('input#cr3').val() != "") {
        var val = $('input#cr3').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr3').value = val;
        var cr3=Number(parseFloat($('input#cr3').val().replace(/,/g, '')));
        }
        else
        {
            var cr3=0;
        }
        if($('input#cr4').val() != "") {
        var val = $('input#cr4').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr4').value = val;
        var cr4=Number(parseFloat($('input#cr4').val().replace(/,/g, '')));
        }
        else
        {
            var cr4=0;
        }
        if($('input#cr5').val() != "") {
        var val = $('input#cr5').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr5').value = val;

        var cr5=Number(parseFloat($('input#cr5').val().replace(/,/g, '')));
        }
        else
        {
            var cr5=0;
        }

          if($('input#cr6').val() != "") {
        var val = $('input#cr6').val();
          val = val.replace(/[^0-9]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr6').value = val;

        var cr6=Number(parseFloat($('input#cr6').val().replace(/,/g, '')));
        }
        else
        {
            var cr6=0;
        }


       
         totalcr = cr1 + cr2 + cr3 + cr4 + cr5 + cr6;
        console.log(totalcr);




        // console.log(Number($('input#CR').val()));
        // console.log(Number($('input#DB').val()));



  
    }
 








    function conditionadd() 
    {
      cr();
      db();

      console.log(totalcr + totaldb);
        if (( totalcr=='0') || (totaldb =='0')) {
            $('#sumcv').attr("disabled", true);
        } else if (Number(totalcr) == Number(totaldb)) {

            $('#sumcv').attr("disabled", false);

        } else {
            $('#sumcv').attr("disabled", true);
        }
    }



 conditionadd();





  

function addcv()
{



       var payload = new FormData();
  

        var cv = '<?php echo $cv ?>' + '|';
        var client ='<?php echo $client ?>' + '|';
        var details = '<?php echo $details ?>';
        var first = cv + client  + details;

   

         var valueinput = $("input.getall").map(function() {
        
                return this.value
          
        }).get().join('|');
        var valueselect = $("select.getall").map(function() {
        
                return this.value
         
        }).get().join('|');

    

        var x = first + '|client|' + valueselect + '|amount|' + valueinput;

        console.log(x);

        payload.append('data', x);



        $.ajax({
            url: 'backend/addcv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
           
            },
            success: function(data) {
                    swal({
                    title: "Success!",
                    text: "Successfully Added CV ",
                    type: "success",

                              closeOnConfirm: false,
                                        showLoaderOnConfirm: true
                                    }, function () {
                                        setTimeout(function () {
                                            window.location.href='cv_gl_entries.php';
                                        }, 1000);
                                    });
                
            },
            cache: false,
            contentType: false,
            processData: false
        });


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
