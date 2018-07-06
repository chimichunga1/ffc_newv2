 

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
             <li class="active">Journal Voucher </li>
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

if(!empty($_POST['jvno']))
{

$jvdate=$_POST['jvdate'];
$jv=$_POST['jvno'];
$client=$_POST['jvclnt'];
$clientname=$_POST['jvname'];
$details=$_POST['details'];






//////////////////////////////////////////////////////////////////////////////////////////////// 
?>







                                </div>

 <form class="form-horizontal" id='addjv'>

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
                                                    
                                                      $masterquerycode="SELECT id, CONCAT(acc_id,' ',account_name) as `acc_name`  FROM accounts where  id='1' ";
                                                      $querycode=$con->myQuery($masterquerycode);
                                                      $rowcode=$querycode->fetch(PDO::FETCH_NUM);
                                                      echo '<option selected value="'.$rowcode[0].'">'.$rowcode[1].'</option>';
                                                                                                            ?>
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db1" onkeyup="conditionadd()" value="0"> 
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
                                      
                                                $masterquerycode="SELECT id, CONCAT(acc_id,' ',account_name) as `acc_name`  FROM accounts where  id='5' ";
                                                $querycode=$con->myQuery($masterquerycode);
                                                $rowcode=$querycode->fetch(PDO::FETCH_NUM);
                                                echo '<option selected value="'.$rowcode[0].'">'.$rowcode[1].'</option>';
                                       
                                                ?>
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db2" onkeyup="conditionadd()"  value="0"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="cr2" onkeyup="conditionadd()"  value="0">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   id="cl2">
                                                      <?php
                                                  
                                                      $masterqueryacc="SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where client_number='".$client."' ";
                                                      $queryacc=$con->myQuery($masterqueryacc);
                                                      $rowacc=$queryacc->fetch(PDO::FETCH_NUM);
                                                      echo '<option selected value="'.$rowacc[0].'">'.$rowacc[1].'</option>';
                                                      
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
                                               
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db3" onkeyup="conditionadd()"  value="0"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="cr3" onkeyup="conditionadd()"  value="0">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   id="cl3">
                                                     
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
                                              
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db4" onkeyup="conditionadd()"  value="0"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="cr4" onkeyup="conditionadd()"  value="0">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   id="cl4">
                                                     
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
                                               
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db5" onkeyup="conditionadd()"  value="0"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="cr5" onkeyup="conditionadd()"  value="0">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   id="cl5">
                                                     
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
                                               
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="db6" onkeyup="conditionadd()"  value="0"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" id="cr6" onkeyup="conditionadd()"  value="0">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   id="cl6">
                                                    
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
                         <button type="button" class="btn btn-primary btn-block" id="sumjv"  onclick="addjv()">Save</button>
                    </div>
                       
                             
</div>  

</form>


      <?php 

}

else
{
?>

<script type="text/javascript"> window.history.back();</script>

<?php
}
?>

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
            val = val.replace(/[^0-9.]/g,'');
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
            val = val.replace(/[^0-9.]/g,'');
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
            val = val.replace(/[^0-9.]/g,'');
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
            val = val.replace(/[^0-9.]/g,'');
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
            val = val.replace(/[^0-9.]/g,'');
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
            val = val.replace(/[^0-9.]/g,'');
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
          val = val.replace(/[^0-9.]/g,'');
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
          val = val.replace(/[^0-9.]/g,'');
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
          val = val.replace(/[^0-9.]/g,'');
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
          val = val.replace(/[^0-9.]/g,'');
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
          val = val.replace(/[^0-9.]/g,'');
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
          val = val.replace(/[^0-9.]/g,'');
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
 















  

function addjv()
{




       var payload = new FormData();
  

        var jv = '<?php echo $jv ?>' + '|';
        var jvdate = '<?php echo $jvdate ?>' + '|';
        var client ='<?php echo $client ?>' + '|';
        var details = '<?php echo $details ?>';
        var first = jv + jvdate + client  + details;

   

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
            url: 'backend/addjv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
           
            },
            success: function(data) {
                    swal({
                    title: "Success!",
                    text: "Successfully Added jV ",
                    type: "success",

                              closeOnConfirm: false,
                                        showLoaderOnConfirm: true
                                    }, function () {
                                        setTimeout(function () {
                                            window.location.href='jv_gl_entries.php';
                                        }, 1000);
                                    });
                
            },
            cache: false,
            contentType: false,
            processData: false
        });


}



function conditionadd() 
    {
      cr();
      db();

      console.log(totalcr + totaldb);
        if (( totalcr=='0') || (totaldb =='0')) {
            $('#sumjv').attr("disabled", true);
        } else if (Number(totalcr) == Number(totaldb)) {

            $('#sumjv').attr("disabled", false);

        } else {
            $('#sumjv').attr("disabled", true);
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
