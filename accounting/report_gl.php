 

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
         
        <h1 class="text-primary">Report</h1>                
           
           <ol class="breadcrumb">
           <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>
            <li ><a href="#" >   <i class="fa fa-file-text"></i>General Ledger Entries </a> </li>
             <li class="active">Report  </li>
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







<form action="" method="" class="form-horizontal" id='frmclear'>

    <div class='form-group row'>
        <div class='col-sm-12 col-md-4'>
        </div>
        <div class='col-sm-12 col-md-4'>
                  <input type="date" class="form-control "  id="date"   onchange="cvps()" >
            </div>

          <div class='col-sm-12 col-md-4'>
        </div>
    

    </div>
</form>

    <hr>



    
<?php ////////////////////////////////////////////////////////////////////////////////////////////////  ?>

<div class="box box-primary"> 
        <h4>Chuque Voucher</h4>
  <div class='form-group row'>
    	<div class='col-md-4'>

        <form method="get" action="../accounting/report/cv_ps.php">
        <input type="hidden" class="form-control"  name='cvpsdate' id="cvpsdate"     >
    		<button class="btn btn-primary btn-block" type="submit">Proofsheet</button>
        </form>
    	</div>
    	<div class='col-md-4'>

    
        <form method="get" action="../accounting/report/cv_ps_sa.php">
        <input type="hidden" class="form-control"  name='cvpsdate' id="cvpsdate"     >
        <button class="btn btn-primary btn-block" type="submit">Proofsheet Summary of accounts</button>
        </form>
    	</div>
    	<div class='col-md-4'>
    	
         <form method="get" action="../accounting/report/cv_gld.php">
        <input type="hidden" class="form-control"  name='cvpsdate' id="cvpsdate"     >
        <button class="btn btn-primary btn-block" type="submit">Details of subsidiary ledger GL distribution</button>
        </form>
    	</div>
  </div>

</div>

<div class="box box-primary"> 
        <h4>Journal Voucher</h4>
  <div class='form-group row'>
      <div class='col-md-4'>

        <form method="get" action="../accounting/report/jv_ps.php">
        <input type="hidden" class="form-control"  name='jvpsdate' id="jvpsdate"     >
        <button class="btn btn-primary btn-block" type="submit">Proofsheet</button>
        </form>
      </div>
      <div class='col-md-4'>

    
        <form method="get" action="../accounting/report/jv_ps_sa.php">
        <input type="hidden" class="form-control"  name='jvpsdate' id="jvpsdate"     >
        <button class="btn btn-primary btn-block" type="submit">Proofsheet Summary of accounts</button>
        </form>
      </div>
      <div class='col-md-4'>
      
         <form method="get" action="../accounting/report/jv_gld.php">
        <input type="hidden" class="form-control"  name='jvpsdate' id="jvpsdate"     >
        <button class="btn btn-primary btn-block" type="submit">Details of subsidiary ledger GL distribution</button>
        </form>
      </div>
  </div>

</div>



            </div>
        </section>



   
<script>
   




    function clientrealtime()
  {

    

 
   var x = $('select#jvname').val();

  
 document.getElementById('jvclnt').value = x.toString();


  }


  function cvps()
  {

    var x = $("input#date").val();


      if (x=='undifined' || x==null )

       {
          var x = '<?php echo date("Y-m-d") ?>';
          document.getElementById('cvpsdate').value = x.toString();
             document.getElementById('jvpsdate').value = x.toString();


       }
       else
       {
             document.getElementById('cvpsdate').value = x.toString();
             document.getElementById('jvpsdate').value = x.toString();
       }

    console.log(x);
  }
         

         var x = '<?php echo date("Y-m-d") ?>';
          document.getElementById('cvpsdate').value = x.toString();
             document.getElementById('jvpsdate').value = x.toString();   
    


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
