 

<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}


$accountcode=$con->myQuery("SELECT id,  CONCAT(acc_id,' ',account_name) FROM accounts where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);


makeHead("Cashier/Official Receipt",1);


$accountno=$con->myQuery("SELECT a.id, CONCAT(a.acc_no,' ',cl.fname, ' ',cl.lname ) FROM client_list cl INNER JOIN account_no a on a.clnt_id=cl.client_number  where cl.is_deleted = 0 ")->fetchAll(PDO::FETCH_ASSOC);


$account=$con->myQuery("SELECT client_number,  CONCAT(fname,' ',lname)  FROM client_list where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

$bank=$con->myQuery("SELECT id,  name FROM bank where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);




require_once("../template/header.php");
require_once("../template/sidebar.php");


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Accounts w/ PDC's</h1>                
           
          <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>
            <li ><a href="#" >   <i class="fa fa-file-text"></i>Cashier</a> </li>
             <li class="active">Assigning of O.R. </li>
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

?>




                                </div>

 <form class="form-horizontal" id='addor'>


                                   <div class='form-group row'>

                               


                                        <label class='col-sm-12 col-md-2 control-label'> O.R. Date </label>
                                         <label class='col-sm-12 col-md-1 control-label'>  : </label>
                                            <div class='col-sm-12 col-md-5'>
                                                <input type="text" readonly class="form-control"  id='ordate' name="ordate" value="<?php echo date('Y-m-d');?>" >
                                            </div>

                              </div>
                              <div class='form-group row'>
                                    <label class='col-sm-12 col-md-2 control-label'> O.R. NO. </label>
                                    <label class='col-sm-12 col-md-1 control-label'> : </label> 
                                        <div class='col-sm-12 col-md-5'>

                                           <input type="text"  class="form-control" required id='orno' name="orno"  >

                                     
                                    </div>

                            </div>
                             <div class='form-group row'>
                                      <label class='col-sm-12 col-md-2 control-label'> Client </label>
                                    <label class='col-sm-12 col-md-1 control-label'> : </label> 
                                     <div class='col-sm-12 col-md-5'>
                                              <select class="form-control  cbo " required style="width:100%;" data-placeholder="" id="clnt">           
                                                      <?php echo  makeOptions($account); ?>
                                              </select>
                                    </div>
                            </div>

                              <div class='form-group row'>
                                      <label class='col-sm-12 col-md-2 control-label'> Account No. </label>
                                    <label class='col-sm-12 col-md-1 control-label'> : </label> 
                                     <div class='col-sm-12 col-md-5'>
                                              <select class="form-control  cbo " required style="width:100%;" data-placeholder="" id="oraccno">           
                                                      <?php echo  makeOptions($accountno); ?>
                                              </select>
                                    </div>
                            </div>




<div class="row" >
 
                      
                            <div class="col-md-3"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Account</div>
                            <div class="col-md-3"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Bank</div>
                            <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Cheque No.</div>
                            <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Amount </div>
                             <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Date</div>
</div>            


<div class="row" style="padding:10px;">
                               <div class="col-md-3"  style="text-align:center;padding-right: 3px;padding-left:3px;"> 
                                              <select class="form-control  getall cbo  " required data-placeholder="" >
                                                
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-3" style="text-align:center;padding-right: 3px;padding-left:3px;"> 
                                              <select class="form-control  getall cbo" required data-placeholder=""  >           
                                                      <?php echo  makeOptions($bank); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall" required  style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" >
                      
                            </div>
                         
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall" required style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="credit()" value="0" id="cr1"  > 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall" required style="text-align:right;padding-right: 0px;padding-left:0px;" type="date"  >
                            </div>
                           
</div>              
 
 <div class="row" style="padding:10px;">
                               <div class="col-md-3"  style="text-align:center;padding-right: 3px;padding-left:3px;"> 
                                              <select class="form-control  getall cbo  " data-placeholder="" >
                                                
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-3" style="text-align:center;padding-right: 3px;padding-left:3px;"> 
                                              <select class="form-control  getall cbo" data-placeholder=""  >           
                                                      <?php echo  makeOptions($bank); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall"   style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" >
                      
                            </div>
                         
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="credit()" value="0" id="cr2"  > 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="date"  >
                            </div>
                           
</div>
<div class="row" style="padding:10px;">
                               <div class="col-md-3"  style="text-align:center;padding-right: 3px;padding-left:3px;"> 
                                              <select class="form-control  getall cbo  " data-placeholder="" >
                                                
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-3" style="text-align:center;padding-right: 3px;padding-left:3px;"> 
                                              <select class="form-control  getall cbo" data-placeholder=""  >           
                                                      <?php echo  makeOptions($bank); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall"   style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" >
                      
                            </div>
                         
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="credit()" value="0" id="cr3"  > 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="date"  >
                            </div>
                           
</div>
<div class="row" style="padding:10px;">
                               <div class="col-md-3"  style="text-align:center;padding-right: 3px;padding-left:3px;"> 
                                              <select class="form-control  getall cbo  " data-placeholder="" >
                                                
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-3" style="text-align:center;padding-right: 3px;padding-left:3px;"> 
                                              <select class="form-control  getall cbo" data-placeholder=""  >           
                                                      <?php echo  makeOptions($bank); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall"   style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" >
                      
                            </div>
                         
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="credit()" value="0" id="cr4"  > 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="date"  >
                            </div>
                           
</div>
<div class="row" style="padding:10px;">
                               <div class="col-md-3"  style="text-align:center;padding-right: 3px;padding-left:3px;"> 
                                              <select class="form-control  getall cbo  " data-placeholder="" >
                                                
                                                      <?php echo  makeOptions($accountcode); ?>
                                              </select>
                            </div>
                            <div class="col-md-3" style="text-align:center;padding-right: 3px;padding-left:3px;"> 
                                              <select class="form-control  getall cbo" data-placeholder=""  >           
                                                      <?php echo  makeOptions($bank); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall"   style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" >
                      
                            </div>
                         
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="credit()" value="0" id="cr5"   > 
                            </div>
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="date"  >
                            </div>
                           
</div>

     


 <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <button type="button" class="btn btn-default btn-block pull-left" onclick="back()" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-xs-12 col-md-6">
                    </div>
              
                    <div class="col-xs-12 col-md-3">
                         <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </div>
                       
                             
</div>  

</form>


   

        </section>



   
<script>
   



 var totalcr=0;


 

    function back() 
    {
        window.history.back();
    }








    function credit() 
    {

    
        var val = $('input#cr1').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr1').value = val;
        var cr1=Number(parseFloat($('input#cr1').val().replace(/,/g, '')));
      
    
        var val = $('input#cr2').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr2').value = val;
        var cr2=Number(parseFloat($('input#cr2').val().replace(/,/g, '')));
     
       
        var val = $('input#cr3').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr3').value = val;
        var cr3=Number(parseFloat($('input#cr3').val().replace(/,/g, '')));
     
  
        var val = $('input#cr4').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr4').value = val;
        var cr4=Number(parseFloat($('input#cr4').val().replace(/,/g, '')));
     
      
        var val = $('input#cr5').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('cr5').value = val;

        var cr5=Number(parseFloat($('input#cr5').val().replace(/,/g, '')));
      

   
       
         totalcr = cr1 + cr2 + cr3 + cr4 + cr5 ;
        console.log(totalcr);




        // console.log(Number($('input#CR').val()));
        // console.log(Number($('input#DB').val()));



  
    }
 






credit();






$( "form#addor" ).submit(function( event ) {
 
  event.preventDefault();
credit();
    var payload = new FormData();
        
oraccno
        var ordate=$("input#ordate").val();
        var orno=$("input#orno").val();
        var clnt=$("select#clnt").val();
             var oraccno=$("select#oraccno").val();
        var or = ordate + '|' + orno + '|' + clnt +'|'+ totalcr +'|'+ oraccno;

         var valueinput = $("input.getall").map(function() {
        
                return this.value
          
        }).get().join('|');
        var valueselect = $("select.getall").map(function() {
        
                return this.value
         
        }).get().join('|');

    

        var x =  or +'|select|'+valueselect + '|inputs|' + valueinput;

        console.log(x);

        payload.append('data', x);



        $.ajax({
            url: 'backend/addorawp.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
           
            },
            success: function(data) {
                    swal({
                    title: "Success!",
                    text: "Successfully Added OR ",
                    type: "success",

                              closeOnConfirm: false,
                                        showLoaderOnConfirm: true
                                    }, function () {
                                        setTimeout(function () {
                                            window.location.href='or_c_awp.php';
                                        }, 1000);
                                    });
                
            },
            cache: false,
            contentType: false,
            processData: false
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
