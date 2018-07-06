 

<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}




$loantypes=$con->myQuery("SELECT `id`,`code` FROM loan_types where is_deleted = 0 ")->fetchAll(PDO::FETCH_ASSOC);



$accountno=$con->myQuery("SELECT a.id, CONCAT(a.acc_no,' ',cl.fname, ' ',cl.lname ) FROM client_list cl INNER JOIN account_no a on a.clnt_id=cl.client_number  where cl.is_deleted = 0 ")->fetchAll(PDO::FETCH_ASSOC);


$account=$con->myQuery("SELECT client_number,  CONCAT(fname,' ',lname)  FROM client_list where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);


makeHead("Cashier/Official Receipt",1);


$bank=$con->myQuery("SELECT id,  name FROM bank where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);




require_once("../template/header.php");
require_once("../template/sidebar.php");


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Counter Payments</h1>                
           
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

 <form class="form-horizontal" id='addor'  action="../accounting/report/official_receipt.php" method="POST" target="_blank">


                                   <div class='form-group row'>

                               


                                        <label class='col-sm-12 col-md-5 control-label'> O.R. Date : </label>
                                       
                                            <div class='col-sm-12 col-md-4'>
                                                <input type="text" readonly class="form-control"  id='ordate' name="ordate" value="<?php echo date('Y-m-d');?>" >
                                            </div>

                              </div>



                              <div class='form-group row'>
                                    <label class='col-sm-12 col-md-5 control-label'> O.R. NO. :</label>
                                  
                                        <div class='col-sm-12 col-md-4'>

                                           <input type="text"  class="form-control" required id='orno' name="orno"  >

                                     
                                    </div>

                            </div>


                              <div class='form-group row'>
                                    <label class='col-sm-12 col-md-5 control-label'> Payment type :</label>
                                  
                                        <div class='col-sm-12 col-md-4'>

                                           
                                                 <select class='form-control cbo' readonly id="payment" required name="payment" on style="width: 100%;" data-placeholder="" onchange="paymentos()"  >
                                                    <?php echo makeOptions($loantypes); ?>
                                                   <option value="0">Others</option>
                                                </select>

                                     
                                    </div>

                            </div>



                             <div class="form-group row">
                       
                                       
                                       <label class="col-sm-12 col-md-2 control-label"> Selector : </label>
                                       <div class="col-sm-12 col-md-4">
                                            <select class='form-control cbo' readonly id="selector" required name="selector" 
                                            style="width: 100%;" data-placeholder="" onchange="selectors()"  >
                          
                                                </select>
                                                
                                            

                                            </div>



                                        <label class="col-sm-12 col-md-2 control-label"> Account / Ref. No.: </label>
                                            <div class="col-sm-12 col-md-4">
                                              

                                          
                                   <input type="text" class="form-control" readonly id="oraccno" readonly name="oraccno"   placeholder=" "   >

                                            </div>
                                      


                                    </div> 



                                 <div class="form-group row">


                                     
                                               <label class="col-sm-12 col-md-2 control-label"> Client No.: </label>
                                            <div class="col-sm-12 col-md-4">
                                                <input type="text" class="form-control" readonly id="orclnt" readonly name="orclnt" required  placeholder=" "   >
                                            </div>



                                               <label class="col-sm-12 col-md-2 control-label"> Client Name: </label>
                                            <div class="col-sm-12 col-md-4">
                                              

                                          
                                                    <input type="text" class="form-control" readonly id="orname" readonly name="orname" required  placeholder=" "   >

                                            


                                            </div>


                                    </div> 

                                            <div class='form-group row'>
                                        <label class='col-md-2 col-xs-12 control-label'> Details: </label>
                              
                                        <div class='col-md-10  col-xs-12'>
                                            <textarea class='form-control'style="width: 100%;resize:none;" required rows="5"  name='details' id='details' placeholder="Details" id='details' required></textarea>
                                        </div>
                                    </div>







<div class="row" >
 
                            <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Payment </div>
                            <div class="col-md-3"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Amount</div>
                            <div class="col-md-3"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Bank</div>
                            <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Cheque No.</div>
                    
                             <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Date</div>
</div>            


<div class="row" style="padding:10px;">

                              <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;">  CASH </div>

                            <div class="col-md-3"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="credit()" id="cr1" name="cr1" > 
                              </div>
                      
</div>             

<div class="row" style="padding:10px;">

                               <div class="col-md-2"  style="padding:10px;text-align:center;border: none transparent;">  CHEQUE </div>

                            <div class="col-md-3"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall"  style="border: none transparent;text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="credit()"  id="cr2"  name="cr2"> 
                              </div>

                            <div class="col-md-3" style="text-align:center;padding-right: 3px;padding-left:3px;"> 
                                              <select class="form-control  getall cbo" required data-placeholder="" id='b1' name="bank" >           
                                                      <?php echo  makeOptions($bank); ?>
                                              </select>
                            </div>
                            <div class="col-md-2"  style="text-align:center;padding-right: 10px;padding-left:10px;"> 
                                              <input class="form-control  getall" required  style="border: none transparent;text-align:center;padding-right: 0px;padding-left:0px;" type="text" id='b2' name="cheque"  >
                      
                            </div>
                         
                  
                            <div class="col-md-2" style="text-align:center;padding-right: 10px;padding-left:10px;">  
                                              <input class="form-control  getall" required style="text-align:right;padding-right: 0px;padding-left:0px;" type="date"  id='b3' name="chequedate"  >
                            </div>
                           
</div>           
<div id='panel2'>   
                <div class="row">
                  <div class="col-xs-12 col-md-3">
                        <button type="button" class="btn btn-default btn-block pull-left" onclick="back()" data-dismiss="modal">Clear</button>
                    </div>
                    <div class="col-xs-12 col-md-6">
                    </div>
              
                    <div class="col-xs-12 col-md-3"> 
                         <button type="button" class="btn btn-primary btn-block" id="proceed" >Proceed</button>
                     </div>          
                        </div> 
</div>

 
<div id='panel' style="display: none;">

<div class="box box-primary">



<div class="row" style="padding:10px;">
                               <div class="col-md-4"  style="text-align:left">  Handling Fee Charges </div>
                               <div class="col-md-8"  style="text-align:right;">  
                                <input class="form-control  getallcr"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="cr()" value='0' id="crs1" name="crs1" > 
                                 </div>
 </div> 
 <div class="row" style="padding:10px;">
                               <div class="col-md-4"  style="text-align:left">  Penalty Charges </div>
                               <div class="col-md-8"  style="text-align:right;">  
                                <input class="form-control  getallcr"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="cr()" value='0'  id="crs2" name="crs2" > 
                                 </div>
 </div> 
 <div class="row" style="padding:10px;">
                               <div class="col-md-4"  style="text-align:left">  Late Payment Charges </div>
                               <div class="col-md-8"  style="text-align:right;">  
                                <input class="form-control  getallcr"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="cr()" value='0'  id="crs3" name="crs3" > 
                                 </div>
 </div> 
 <div class="row" style="padding:10px;">
                               <div class="col-md-4"  style="text-align:left">  Unearned Disc. / Int. </div>
                               <div class="col-md-8"  style="text-align:right;">  
                                <input class="form-control  getallcr"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="cr()" value='0'  id="crs4" name="crs4" > 
                                 </div>
 </div> 
 <div class="row" style="padding:10px;">
                               <div class="col-md-4"  style="text-align:left">  Other Charges </div>
                               <div class="col-md-8"  style="text-align:right;">  
                                <input class="form-control  getallcr"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="cr()" value='0'  id="crs5"  name="crs5" > 
                                 </div>
 </div> 

<hr>
        <div class="row" style="padding:10px;">
                               <div class="col-md-4"  style="text-align:left">  Reb. Coll. Fee </div>
                               <div class="col-md-8"  style="text-align:right;">  
                                <input class="form-control  getallcr"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="cr()" value='0'  id="crs6" name="crs6" > 
                                 </div>
 </div> 
 <div class="row" style="padding:10px;">
                               <div class="col-md-4"  style="text-align:left">  Discount </div>
                               <div class="col-md-8"  style="text-align:right;">  
                                <input class="form-control  getallcr"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="cr()" value='0'  id="crs7" name="crs7" > 
                                 </div>
 </div> 
 <div class="row" style="padding:10px;">
                               <div class="col-md-4"  style="text-align:left">  Other Discounts</div>
                               <div class="col-md-8"  style="text-align:right;">  
                                <input class="form-control  getallcr"  style="text-align:right;padding-right: 0px;padding-left:0px;" type="text" onkeyup="cr()" value='0'  id="crs8" name="crs8" > 
                                 </div>
 </div>                      
                           
         



</div>





 <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <button type="button" class="btn btn-default btn-block pull-left" onclick="back()" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-xs-12 col-md-6">
                    </div>
              
                    <div class="col-xs-12 col-md-3">
                       <button type="submit" class="btn btn-default  btn-block" id="print"><i class="fa fa-print"></i> </button>
                         <button type="button" class="btn btn-primary btn-block" id="save"> Save & Verify </button>
                    </div>
                       
                             
</div>  
</div>

   
</form>




        </section>


<script>
   
  

    $("#proceed").click(function(){
        $("#panel2").hide();
        $("#panel").show();
        $('html,body').animate({ scrollTop: 9999 }, 'slow');
        cr();
    });
   



 var totalcr=0;



 

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
     
       
     

    

 

      if ($('input#cr1').val()!="" && $('input#cr2').val()=="")
      {    
             
           $("input#cr2").val('');
           $("select#b1").val('');
           $("input#b2").val('');
           $("input#b3").val('');

$('#proceed').attr("disabled", false);
            $("input#cr1").attr({"readonly":false,"required":true});
            $("input#cr2").attr({"readonly":true,"required":false});
            $("select#b1").attr({"disabled":true,"required":false});
            $("input#b2").attr({"readonly":true,"required":false});
            $("input#b3").attr({"readonly":true,"required":false});
     

      }
      else if ($('input#cr1').val()=="" && $('input#cr2').val()!="")
      {
           $("input#cr1").val('');

$('#proceed').attr("disabled", false);
            $("input#cr1").attr({"readonly":true,"required":false});
            $("input#cr2").attr({"readonly":false,"required":true});
            $("select#b1").attr({"disabled":false,"required":true});
            $("input#b2").attr({"readonly":false,"required":true});
            $("input#b3").attr({"readonly":false,"required":true});

      }
      else
      { 
           $("input#cr1").val('');
            $("input#cr2").val('');
           $("select#b1").val('');
           $("input#b2").val('');
           $("input#b3").val('');
         $('#proceed').attr("disabled", true);

            $("input#cr1").attr({"readonly":false,"required":true});
           $("input#cr2").attr({"readonly":false,"required":true});
            $("select#b1").attr({"disabled":false,"required":true});
            $("input#b2").attr({"readonly":false,"required":true});
            $("input#b3").attr({"readonly":false,"required":true});
      }
  
    }
 





credit();


    function cr() 
    {

    
        var val = $('input#crs1').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('crs1').value = val;
        var crs1=Number(parseFloat($('input#crs1').val().replace(/,/g, '')));
      
    
        var val = $('input#crs2').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('crs2').value = val;
        var crs2=Number(parseFloat($('input#crs2').val().replace(/,/g, '')));


        var val = $('input#crs3').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('crs3').value = val;
        var crs3=Number(parseFloat($('input#crs3').val().replace(/,/g, '')));


        var val = $('input#crs4').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('crs4').value = val;
        var crs4=Number(parseFloat($('input#crs4').val().replace(/,/g, '')));


        var val = $('input#crs5').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('crs5').value = val;
        var crs5=Number(parseFloat($('input#crs5').val().replace(/,/g, '')));

        var val = $('input#crs6').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('crs6').value = val;
        var crs6=Number(parseFloat($('input#crs6').val().replace(/,/g, '')));

        var val = $('input#crs7').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('crs7').value = val;
        var crs7=Number(parseFloat($('input#crs7').val().replace(/,/g, '')));

        var val = $('input#crs8').val();
          val = val.replace(/[^0-9.]/g,'');
          if(val != "") {
            valArr = val.split('.');
            valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
            val = valArr.join('.');
          }
        document.getElementById('crs8').value = val;
        var crs8=Number(parseFloat($('input#crs8').val().replace(/,/g, '')));


     
var total1 = (crs1 + crs2 + crs3 + crs4 + crs5) - (crs6 + crs7 + crs8); 
console.log(Number(total1));





      if(Number($('input#cr1').val()) >= total1  && total1>=Number(-1)  )  
      {
  $('#save').attr("disabled", false);
      }
      else  if(Number ($('input#cr2').val()) >= total1 && total1>=Number(-1) )  
  {
  $('#save').attr("disabled", false);
      }
      else
      {
  $('#save').attr("disabled", true);
      }
        // console.log(Number($('input#CR').val()));
        // console.log(Number($('input#DB').val()));





  
    }
 






cr();




$( "form#addor" ).onclick (function(  ) {
 
  
var cr1=Number(parseFloat($('input#cr1').val().replace(/,/g, '')));
var cr2=Number(parseFloat($('input#cr2').val().replace(/,/g, '')));
  var total1 = crs1 + crs2 + crs3 + crs4 + crs5 - crs6 - crs7 - crs8; 
  var crs1=Number(parseFloat($('input#crs1').val().replace(/,/g, '')));
  var crs2=Number(parseFloat($('input#crs2').val().replace(/,/g, '')));
  var crs3=Number(parseFloat($('input#crs3').val().replace(/,/g, '')));
  var crs4=Number(parseFloat($('input#crs4').val().replace(/,/g, '')));
  var crs5=Number(parseFloat($('input#crs5').val().replace(/,/g, '')));
  var crs6=Number(parseFloat($('input#crs6').val().replace(/,/g, '')));
  var crs7=Number(parseFloat($('input#crs7').val().replace(/,/g, '')));
  var crs8=Number(parseFloat($('input#crs8').val().replace(/,/g, '')));


    var payload = new FormData();
        var finan =((cr1+cr2)-(total1));
        var z = $('select#payment').val();
        var ordate=$("input#ordate").val();
        var orno=$("input#orno").val();
         var orclnt=$("input#orclnt").val();
         var details=$("textarea#details").val();




         if(cr1!='')
         {
          

              var or = ordate + '|' + orno + '|' + orclnt + '|' +  details +'|'+ cr1 +'|'+ finan;
         }

         else
         {
     
             var b1=$("select#b1").val();
             var b2=$("input#b2").val();
            var b3=$("input#b3").val();

              var or = ordate + '|' + orno  + '|' + orclnt + '|' +  details +'|'+ cr2  +'|'+ b1  +'|'+ b2  +'|'+ b3 +'|'+ finan;

         }

          var valuecr = $("input.getallcr").map(function() {
        
                return this.value
          
        }).get().join('|');


 

    

        var x =  or +'|inputs|'+ valuecr ;

        console.log(x);

        payload.append('data', x);



        $.ajax({
            url: 'backend/addorcp.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
           
            },
            success: function(data) {

                    // swal({
                    // title: "Success!",
                    // text: "Successfully Added OR ",
                    // type: "success",

                    //           closeOnConfirm: false,
                    //                     showLoaderOnConfirm: true
                    //                 }, function () {
                    //                     setTimeout(function () {
                    //                         window.location.href='or_c_cp.php';
                    //                     }, 1000);
                    //                 });
                
            },
            cache: false,
            contentType: false,
            processData: false
        });

});

  





  function selectors()
  {

    

 
   var x = $('select#payment').val();


  
 
           if(Number(x)==0)
            {

              document.getElementById('orclnt').value = $('select#selector').val();

           var res = document.getElementById('select2-selector-container').title.split(" ");
           document.getElementById('orname').value='';
            for (var i = 0; i < res.length; i++) {
              document.getElementById('orname').value += res[i]+ ' ';
            }


          document.getElementById('oraccno').value = '';

           // console.log(document.getElementById('select2-selector-container').title);
            }


    else if(Number(x)>=0)
            {
              document.getElementById('orclnt').value = $('select#selector').val();


           var res = document.getElementById('select2-selector-container').title.split(" ");

             document.getElementById('orname').value='';

            for (var i = 1; i < res.length; i++) {
              document.getElementById('orname').value += res[i]+ ' ';
            }


          document.getElementById('oraccno').value = res[0];

           // console.log(document.getElementById('select2-selector-container').title);
            }

else
{

}







  }

 




function paymentos()
{  


        var x =  $('select#payment').val();

        console.log(x);

     if(x!='0' && x!='')
     {
        $('select#selector').val('').trigger('change');
        $('input#orclnt').val('');
        $('input#orname').val('');
        $('input#oraccno').val('');
        document.getElementById("selector").innerHTML="<?php echo makeOptions($accountno); ?> ";
      }
      else if(x=='0')
      {
         $('select#selector').val('').trigger('change');
        $('input#orclnt').val('');
        $('input#orname').val('');
        $('input#oraccno').val('');
         document.getElementById("selector").innerHTML="<?php echo makeOptions($account); ?> ";
      }
      else
      {
        $('select#selector').val('').trigger('change');
        $('input#orclnt').val('');
        $('input#orname').val('');
        $('input#oraccno').val('');
         document.getElementById("selector").innerHTML=" ";
      }

}


    function back() 
    {
       window.location.reload(); 
    }


paymentos();











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
