 

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


// $jv_no=$con->myQuery("SELECT j.jv_id, j.jv_no FROM `journal_voucher` j WHERE  j.isDeleted=0 and j.isValidated=0")->fetchAll(PDO::FETCH_ASSOC);


require_once("../template/header.php");
require_once("../template/sidebar.php");


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Journal Voucher Entries</h1>                
           
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
                                          



<div  class="box box primary" style="padding-top:10px;padding-bottom:10px; ">

    <form action="tableresultjv.php" method="POST" class="form-horizontal" id='addjv'>
                              
                                   <div class='form-group row'>
                                        <label class='col-sm-12 col-md-1 control-label'> JV Date: </label>
                                            <div class='col-sm-12 col-md-5'>
                                                <input type="text" readonly class="form-control"  id='jvdate' name="jvdate" value="<?php echo date('Y-m-d');?>" >
                                            </div>

                              
                                    <label class='col-sm-12 col-md-1 control-label'> JV no.:</label>
                                        <div class='col-sm-12 col-md-5'>

                                                 <input type="text" class="form-control" readonly id="jvno" name="jvno" readonly value="<?php echo date('Ymd');?>"  placeholder=" "   >
                                     
                                    </div>

                                  </div>
                                    <!--  <div id="dropdown-result" style="display: none;"></div>
 -->


                                    <div class="form-group row">
                       
                                        <label class="col-sm-12 col-md-1 control-label"> Client No.: </label>
                                            <div class="col-sm-12 col-md-5">
                                                <input type="text" class="form-control" readonly id="jvclnt" readonly name="jvclnt" required  placeholder=" "   >
                                            </div>

                            

                                        <label class="col-sm-12 col-md-1 control-label"> Name: </label>
                                            <div class="col-sm-12 col-md-5">
                                              

                                                 <select class='form-control cbo' readonly id="jvname" required name="jvname" onchange="clientrealtime();" style="width: 100%;" data-placeholder="Select a client" >
                                                    <?php echo makeOptions($account) ?>
                                                </select>


                                            </div>


                                    </div> 

                                    <div class='form-group row'>
                                        <label class='col-md-1 col-xs-1 '> &nbsp;Details: </label>
                               
                            
                                        <div class='col-md-11  col-xs-12'>
                                            <textarea class='form-control' name='details' style="width: 100%;resize:none;  " name="details" required rows="5" id='details' placeholder="Details"  required></textarea>
                                        </div>
                                    </div>


  
                 

                         
                                   


                                    
                                    <div class='form-group'>

                                         <div class='col-sm-1 col-md-3  '>
                                         </div>
                                          <div class='col-sm-5 col-md-3 '>
                                            <button type='submit' class='btn btn-primary btn-flat btn-block'  ><span class="fa fa-check"></span> Confirm</button>
                                          
                                        </div>


                                        <div class='col-sm-5 col-md-3  '>
                                          
                                           <button type='button' class='btn btn-flat btn-block ' onclick='canceljv();'><span class="fa fa-times"></span> clear</button>
                                        </div>
                                         <div class='col-sm-1 col-md-3  '>
                                         </div>

                                    </div>     

                                </form>
                                </div>



</div>

        </section>



   
<script>
    





    function clientrealtime()
  {

    

 
   var x = $('select#jvname').val();

  
 document.getElementById('jvclnt').value = x.toString();


  }
function canceljv()

{


      $("#formjv select").each(function() {
            $(this).val('').trigger('change');
        });
        $("#formjv input").each(function() {
            $(this).val('').trigger('change');
        });
        $("#formjv textarea").each(function() {
            $(this).val('').trigger('change');
        });

        $('#panel').css({
            'display': 'none'
        });
        $('#generatejv').css({
            'display': 'block'
        });

        document.getElementById('jvno').value="<?php echo date('Ymd');?>";
         document.getElementById('jvdate').value="<?php echo date('Y-m-d');?>";


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
