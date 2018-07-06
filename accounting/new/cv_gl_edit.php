
 

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
$accountno=$con->myQuery("SELECT a.id, CONCAT(a.acc_no,' ',cl.fname, ' ',cl.lname ) FROM client_list cl INNER JOIN account_no a on a.clnt_id=cl.client_number  where cl.is_deleted = 0 ")->fetchAll(PDO::FETCH_ASSOC);

$accountcode=$con->myQuery("SELECT id,   CONCAT(acc_id,' ',account_name) as `acc_name` FROM accounts where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);



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

<div class="row" >
 
                            <div class="col-md-2" style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Account No.</div>
                            <div class="col-md-1"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> CD</div>
                            <div class="col-md-3"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Account Code</div>
                            <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Debit</div>
                            <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Credit</div>
                             <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Client</div>
</div>          

<?php          

$z=0;
     $slavequerycode="SELECT acc_no,cd,acc_code,debit_amount,credit_amount,clnt_id,cv_id  FROM cheque_dbcr where  cv_v_id='".$d."' ";
                                                      $slavecode=$con->myQuery($slavequerycode);
                                                     while($rowslavecode=$slavecode->fetch(PDO::FETCH_NUM))
                                                     {
                                                      $z=$z+1;


?>

        <div class="row" style="padding:10px;">
 
                            <div class="col-md-2" style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                 <input class="form-control  getall" style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="hidden"  value="<?php echo $rowslavecode[6]; ?>" >
                      


                                              <select class="form-control  getall cbo  getall" data-placeholder=""  <?php echo 'id="an'.$z.'"'; ?> >  

                                          
                                                <?php
                                                    if(!empty($rowslavecode[0]))
                                                    {
                                                      $masterquerycode="SELECT a.id, CONCAT(a.acc_no,' ',cl.fname, ' ',cl.lname ) FROM client_list cl INNER JOIN account_no a on a.clnt_id=cl.client_number  where cl.is_deleted = 0  and  a.id='".$rowslavecode[0]."' ";
                                                      $querycode=$con->myQuery($masterquerycode);
                                                      $rowcode=$querycode->fetch(PDO::FETCH_NUM);

                                                      echo '<option selected value="'.$rowcode[0].'">'.$rowcode[1].'</option>';
                                                         }
                                                           ?>

                                                      <?php echo  makeOptions($accountno); ?>
                                              </select>
                            </div>
                            <div class="col-md-1"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall" <?php echo 'id="cd'.$z.'"'; ?>  style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text"  value="<?php echo $rowslavecode[1]; ?>" >
                      
                            </div>
                            <div class="col-md-3"  style="text-align:center;padding-right: 0px;padding-left:0px;"> 
                                              <select class="form-control  getall cbo  getall" data-placeholder=""   <?php echo 'id="ac'.$z.'"'; ?>>
                                                      <?php
                                                    
                                                      $masterquerycode="SELECT id, CONCAT(acc_id,' ',account_name) as `acc_name`  FROM accounts where  id='".$rowslavecode[2]."' ";
                                                      $querycode=$con->myQuery($masterquerycode);
                                                      $rowcode=$querycode->fetch(PDO::FETCH_NUM);
                                                      echo '<option selected value="'.$rowcode[0].'">'.$rowcode[1].'</option>';
                                                                                                            ?>
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall debit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" <?php echo 'id="db'.$z.'"'; ?> onkeyup="conditionadd()" value="<?php echo $rowslavecode[3]; ?>"> 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall credit"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text"  <?php echo 'id="cr'.$z.'"'; ?> onkeyup="conditionadd()" value="<?php echo $rowslavecode[4]; ?>">
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 0px;padding-left:0px;">  
                                              <select class="form-control  getall cbo  getall" data-placeholder="Select a client"   <?php echo 'id="cl'.$z.'"'; ?>>
                                                      <?php
                                                      if (!empty($rowslavecode[5]))
                                                      {
                                                      $masterqueryacc="SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where client_number='".$rowslavecode[5]."' ";
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



                                                     }
                                                ?>





<?php
 }
?>
 <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <button type="button" class="btn btn-default btn-block pull-left" onclick="back()" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-xs-12 col-md-6">
                    </div>
              
                    <div class="col-xs-12 col-md-3">
                         <button type="button" class="btn btn-primary btn-block" id="sumcv"  onclick="editcv()">Save</button>
                    </div>
                       
                             
</div>



        </section>



   
<script>
 

  function back() 
    {

        
              window.location.href='cv_gl_validate.php';
          

    }

function editcv()
{



       var payload = new FormData();
  

     

         var valueinput = $("input.getall").map(function() {
        
                return this.value
          
        }).get().join('|');
        var valueselect = $("select.getall").map(function() {
        
                return this.value
         
        }).get().join('|');

    

        var x =    valueinput +'|select|'+ valueselect ;

        console.log(x);

        payload.append('data', x);



        $.ajax({
            url: 'backend/updatecv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
           
            },
            success: function(data) {
                    swal({
                    title: "Success!",
                    text: "Successfully Updated CV ",
                    type: "success",

                              closeOnConfirm: false,
                                        showLoaderOnConfirm: true
                                    }, function () {
                                        setTimeout(function () {
                                            window.location.href='cv_gl_validate.php';
                                        }, 1000);
                                    });
                
            },
            cache: false,
            contentType: false,
            processData: false
        });


}
  
    
  



var totaldb=0;
var totalcr=0;

  function db() 
    {
var len="<?php echo $z; ?>";
   
  if(len>=1)
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

       
  }
   if(len>=2)
  {
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
  }
   if(len>=3)
  {

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
 }
   if(len>=4)
  {
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
  }
   if(len>=5)
  {
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
  }
   if(len>=6)
  {

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

}
     
       if(len==1)
  {
    totaldb = db1;
  }
      else if(len==2)
  {
    totaldb = db1+db2;
  }
      else if(len==3)
  {
    totaldb = db1+db2+db3;
  }
      if(len==4)
  {
    totaldb = db1+db2+db3+db4;
  }
      if(len==5)
  {
    totaldb =db1+db2+db3+db4+db5;
  }
      if(len==6)
  {
    totaldb = db1+db2+db3+db4+db5+db6;
  }
else
{

}

        



        
        



  

    }



    function cr() 
    {

       var len="<?php echo $z; ?>";
   
  if(len>=1)
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

       
  }
   if(len>=2)
  {
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
  }
   if(len>=3)
  {

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
 }
   if(len>=4)
  {
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
  }
   if(len>=5)
  {
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
  }
   if(len>=6)
  {

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

}
     
       if(len==1)
  {
    totalcr = cr1;
  }
      else if(len==2)
  {
    totalcr = cr1+cr2;
  }
      else if(len==3)
  {
    totalcr = cr1+cr2+cr3;
  }
      if(len==4)
  {
    totalcr = cr1+cr2+cr3+cr4;
  }
      if(len==5)
  {
    totalcr =cr1+cr2+cr3+cr4+cr5;
  }
      if(len==6)
  {
    totalcr = cr1+cr2+cr3+cr4+cr5+cr6;
  }
else
{

}

       


  
    }
 








    function conditionadd() 
    {
      cr();
      db();

      console.log(totalcr + totaldb);
        if (( totalcr=='0') || (totaldb =='0')) {
            $('#sumcv').attr("disabled", false);
        } else if (Number(totalcr) == Number(totaldb)) {

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
<?php



   ?>
