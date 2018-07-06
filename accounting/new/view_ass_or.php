<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Assigning of OR",1);
    
    
    require_once("../template/header.php");
    require_once("../template/sidebar.php");

    $payment_type=$con->myQuery("SELECT id, name FROM payment_type WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $bank=$con->myQuery("SELECT id, name FROM bank WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($_GET['id'])){
    $data=$con->myQuery("SELECT id, app_no, client_no, CONCAT(first_name,' ',last_name) as name FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
  }
?>
<script type="text/javascript">
    function isNumberKey(evt, element) {
     
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
        return false;
        
      else {
        var len = $(element).val().length;
        var index = $(element).val().indexOf('.');
        //alert(index);
        
        if (index >= 0 && charCode == 46) {
          return false;
        }
      }
      

      $("input[name='total']").val($("input[name='cash']").val()+" PHP")
      return true;
    } 
    

</script>
<div class="content-wrapper">
	

    <section class="content-header">
        
        <h1 class="text-primary">View Assigning of O.R</h1>                
        
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>

            <li><a href="ass_or.php" ><i class="fa fa-file"></i> Assigning of O.R</a></li>
            <li class="active">O.R  </li>
        </ol>

    </section>
        
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
                            <a href='save_counter_payment.php'  class="btn btn-default"><span class="fa fa-arrow-left"></span> Back to list</a><br><br>
                        
                            
                                <form action="save_counter_payment.php" method="post" class="form-horizontal" id='frmclear'>
                                    <input type='hidden' name='client_id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                                    
                                    <div class='form-group'>
                                        <div class='col-md-offset-1'>
                                        <h4 class="text-primary">Application Number:<b><?php echo !empty($data)?htmlspecialchars($data['app_no']):''; ?></b></h4>
                                    
                                        <h4 class="text-primary">Client Number: <?php echo !empty($data)?htmlspecialchars($data['client_no']):''; ?></h4>
                            
                                        <h4 class="text-primary">Client Name: <b><?php echo !empty($data)?htmlspecialchars($data['name']):''; ?></b></h4>
                                        </div>
                                    </div>
                            
                                    <div class='form-group'>
                                        <label class="col-sm-3 control-label">Payment Type: </label>
                                        <div class='col-sm-3'>
                                            <select class='form-control cbo' name='payment_type' id='payment_type' data-placeholder="Select Payment Type" required>
                                                <?php echo makeOptions($payment_type); ?>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">Bank: </label>
                                        <div class='col-sm-3'>
                                            <select class='form-control cbo' name='bank' id='bank' data-placeholder="Select Bank" required>
                                                <?php echo makeOptions($bank); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="col-sm-3 control-label">Details: </label>
                                        <div class='col-sm-3'>
                                            <textarea class='form-control' name='details' id='details' placeholder="Details" required></textarea>
                                        </div>
                                        <label class="col-sm-2 control-label">Check No.: </label>
                                        <div class='col-sm-3'>
                                      
                                            <input type="text" class="form-control" name="check_no" placeholder="Enter Check No" >
            
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="col-sm-3 control-label">Deposit Date: </label>
                                        <div class='col-sm-3'>
                                            <input type="text" class="form-control date_picker" name='dep_date' value="<?php echo date('m/d/Y'); ?>">
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                       
                                        <label class="col-sm-5 control-label">Cash : </label>
                                        <div class='col-sm-3'>
                                      
                                            <input type="text" class="form-control"  oninput="getSum()" onkeypress="return isNumberKey(event,this)" name="cash" id="cash" placeholder="Enter Cash">
            
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                       
                                        <label class="col-sm-5 control-label">Check : </label>
                                        <div class='col-sm-3'>
                                      
                                            <input type="text" class="form-control"  oninput="getSum()" onkeypress="return isNumberKey(event,this)" name="check" id="check" placeholder="Enter Check">
            
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                       
                                        <label class="col-sm-5 control-label">Total : </label>
                                        <div class='col-sm-3'>
                                      
                                            <input type="text" class="form-control" name="total" id="total" placeholder="Total" disabled>
                                            <input type="hidden" class="form-control" name="total" id="total">
            
                                        </div>
                                    </div>
                            
                                    <div class="form-group">
                                        <div class="col-sm-11 col-md-offset-1 text-center">
                                            <button type='submit' class='btn btn-primary'>Save </button>
                                            <a href='ass_or.php' class='btn btn-default'>Cancel</a>
                                        </div>
                                    </div>
                                </form>
                               
                                <table id='dataTables' class="table responsive-table table-bordered table-striped" >
                                    <thead>
                                        <tr >
                                            <th>Payment Type</th>
                                            <th>Bank</th>
                                            <th>Check No.</th>
                                            
                                            <th>Cash</th>
                                            <th>Check</th>
                                            <th>Total</th>
                                            <th>Details</th>
                                            <th>Deposit Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr class="tableheader"> -->


                                            
                                    </tbody>
                                </table>
                            
                        </div>
                    </div>
                </div>
                
            
            
            </div>
        </div>
	</section>


 
</div>

<script type="text/javascript">

    function getSum() {
        var x = document.getElementById("cash").value;
        var y = document.getElementById("check").value;
        if (y === "") {
            y = 0;
        } else if (x === "") {
            x = 0;
        }
        var z = parseInt(x) + parseInt(y);
        $("input[name='total']").val(z+" PHP");
        
    }

    var dttable="";
      $(document).ready(function() {
        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",
                "scrollX":"100%",
                "searching": true,
                
                "select":true,
                "ajax":{
                  "url":"ajax/view_ass_or.php",
                    "data":function(d)
                    {
                        
                        d.client_id              = $("input[name='client_id']").val();
                    
                       
                    }
                  
                },"language": {
                    "zeroRecords": "No Records Found."
                },
                order:[[7,'desc']]
               
        });
        
    });
    
    function filter_search() 
    {
            dttable.ajax.reload();
            //console.log(dttable);
    }

</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>
