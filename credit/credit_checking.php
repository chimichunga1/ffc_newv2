<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Update Loan",1);
    if (empty($_GET['tab'])) {
          
        redirect("ci_checking.php");
    
    } elseif($_GET['tab'] < 1 || $_GET['tab'] > 6) {
        redirect("ci_checking.php");
    }
if(empty($data)){
    redirect("ci_checking.php");
}
$tab=3;

$trade=$con->myQuery("SELECT * FROM credit_check WHERE is_deleted='0' AND loan_id=? AND client_no=?",array($data['id'],$client['client_number']))->fetchAll(PDO::FETCH_ASSOC);
if(!empty($_GET['cc'])){
    $trades=$con->myQuery("SELECT * FROM credit_check WHERE id=?",array($_GET['cc']))->fetch(PDO::FETCH_ASSOC);
  }
?>
	<?php
		Alert();
		
	?>          
            <div align='center'>
            <h3><b>CREDIT CHECKINGS</b>
            </div>
            <div style='float:right;'>
            <!-- <a href="credit_checking_print.php?id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>" class='btn btn-success'> View &nbsp;<span class='fa fa-search'></span> </a> -->
            <button onclick="printExternal('credit_checking_print.php?id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>')" class='btn btn-default no-print'>Print &nbsp;<span class='fa fa-print'></span></button>  
            </h3>
            </div>
            <table style='width: 60% !important;margin-left: 15%;'>
            <tr><td align='right'><b>Last Name: &nbsp;</b></td><td><?php echo $client['lname'];?></td><td align='right'><b>Client Number: &nbsp;</b></td><td><?php echo $client['client_number'];?></td></tr>
            <tr><td align='right'><b>First Name: &nbsp;</b></td><td><?php echo $client['fname'];?></td><td align='right'><b>Application Number: &nbsp;</b></td><td><?php echo $data['app_no'];?></td></tr>
            </table><br>
            <div class='text-right'>
            <button class='btn btn-warning' data-toggle="collapse" data-target="#hide" aria-expanded="false" aria-controls="collapseForm">Add Credit Check </button><br><br>
            </div>
                <div id='hide' class='collapse'>
            <form action="save_credit_check.php" method="post" class="form-horizontal" id='frmclear'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <input type='hidden' name='tab' id='tab' value="<?php echo !empty($_GET['tab'])?htmlspecialchars($_GET['tab']):''?>">
                <input type='hidden' name='client_no' id='client_no' value="<?php echo !empty($client['client_number'])?htmlspecialchars($client['client_number']):''?>">
                <input type='hidden' name='cc_id' id='cc_id' value="<?php echo !empty($trades['id'])?htmlspecialchars($trades['id']):''?>">
                <div class='form-group'>
                     <label class="col-md-3 control-label">Informant: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="inform" name='inform' placeholder="Informant" value='<?php echo !empty($trades)?htmlspecialchars($trades['informant']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Telephone: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="tel_no" name='tel_no' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['tel_no']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-md-3 control-label">Loan Type: </label>
                      <div class="col-md-3">
                      <select style='width: 100% !important;' class='form-control cbo' name='loan_type' id='loan_type' data-allow-clear='true'  data-placeholder="Select Loan Type" data-selected='<?php echo !empty($trades)?htmlspecialchars($trades['loan_type_id']):''; ?>'>
                        <?php echo makeOptions($lt); ?>
                        </select>
                      </div>
                      <label class="col-md-2 control-label">Unit: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="unit" name='unit' placeholder="Unit" value='<?php echo !empty($trades)?htmlspecialchars($trades['unit']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Amt. Fin: </label>
                      <div class="col-md-3">
                      <input type="text" class="form-control" id="amt_fin" name='amt_fin' placeholder="Amount Fin." value='<?php echo !empty($trades)?htmlspecialchars($trades['amt_fin']):''; ?>' required>
                      </div>
                     <label class="col-md-2 control-label">PN Amount: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="pn_amount" name='pn_amount' placeholder="PN Amount" value='<?php echo !empty($trades)?htmlspecialchars($trades['pn_amount']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Terms: </label>
                      <div class="col-md-3">
                      <input type="text" class="form-control" id="terms" name='terms' placeholder="Terms" value='<?php echo !empty($trades)?htmlspecialchars($trades['terms']):''; ?>' required>
                      </div>
                     <label class="col-md-2 control-label">Monthly Amortization: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="mon_amor" name='mon_amor' placeholder="Monthly Amortization" value='<?php echo !empty($trades)?htmlspecialchars($trades['mon_amor']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Date Granted: </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control date_picker" value='<?php echo !empty($trades)?htmlspecialchars($trades['date_granted']):''; ?>' id="date_granted" name='date_granted' required>
                      </div>
                     <label class="col-md-2 control-label">Balance: </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="balance" name='balance' placeholder="Balance" value='<?php echo !empty($trades)?htmlspecialchars($trades['balance']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Security: </label>
                      <div class="col-md-8">
                      <input type="text" class="form-control" id="security" name='security' placeholder="Security" value='<?php echo !empty($trades)?htmlspecialchars($trades['security']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Experience: </label>
                      <div class="col-md-8">
                      <textarea class='form-control' name='exp' id='exp'  required><?php echo !empty($trades)?htmlspecialchars($trades['experience']):''; ?></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-10 col-md-offset-2 text-center">
                    <button type='submit' class='btn btn-warning'>Save </button>
                    <a href='ci_checking_form.php?id=<?php echo $data['id']?>&tab=<?php echo $tab?>' class='btn btn-default'>Cancel</a>
                    </div>
                </div>        
                </form>
            </div>
                <table id='ResultTable' class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th class='text-center'>Informant</th>
                            <th class='text-center'>Loan Type</th>
                            <th class='text-center'>Terms</th>
                            <th class='text-center'>Date Granted</th>
                            <th class='text-center'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($trade as $row):
                        ?>
                        <tr>
                            <td class='text-center'><?php echo htmlspecialchars($row['informant'])?></td>
                            <td class='text-center'>
                            <?php $loan=$con->myQuery("SELECT name FROM loan_approval_type WHERE id=?",array($row['loan_type_id']))->fetch(PDO::FETCH_ASSOC);
                                echo $loan['name'];
                            ?>
                            </td>
                            <td class='text-center'><?php echo htmlspecialchars($row['terms'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['date_granted'])?></td>
                            <td class='text-center'>
                            <a href='ci_checking_form.php?id=<?php echo $data['id']?>&tab=3&cc=<?php echo $row['id']?>' class='btn btn-success'><span class='fa fa-pencil'></span></a>
                            <button type='submit' class='btn bg-gray' id='btn-print' name='btnprint' data-toggle='tooltip' data-placement='top' title='Print' onclick='submit(<?php echo $row['id']?>);'> <i class='fa fa-print'> </i></button>
                            <a href='../php/delete.php?type=credit_check&tab=3&loan=<?php echo $data['id']?>&id=<?php echo $row['id']?>' onclick="return confirm('This record will be deleted.')" class='btn btn-danger'><span class='fa fa-trash'></span></a>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
<?php
    $request_type="submit_ci";
    require_once("../include/modal_submit_ci.php");
?>
<?php 
  if(!empty($trades)):
?>
<script type="text/javascript">
  $(function(){
    $('#hide').collapse({
      toggle: true
    })    
  });
</script>
<?php
  endif;
?>
<script type="text/javascript">

	function redirect(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/journal_entry.php?id=" + id;
		window.location=string;
	};
	
	function archive(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/php/archive.php?id=" + id;
		window.location=string;
	}
	
	function edit(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/create_loan.php?id=" + id;
		window.location=string;
	}
	    function filter_search()
    {
            dttable.ajax.reload();
            //console.log(dttable);
    }
    $("#client_no").change(function(){
        $("#comment_table").html("<span class='fa fa-refresh fa-pulse'></span>")
            $("#comment_table").load("../marketing/ajax/autofill_form.php?id="+$("#client_no").val());
    });
    $("#lname").change(function(){
        $("#comment_table").html("<span class='fa fa-refresh fa-pulse'></span>")
            $("#comment_table").load("../marketing/ajax/autofill_form.php?id="+$("#client_no").val());
    });
    $(document).ready(function() {
        $("#comment_table").load("../marketing/ajax/autofill_form.php?");
    });
    if ($("#same_add").is(':checked')){
    $("#autoUpdate").hide();
    $('#bus_no').prop('required',false);
    $('#bus_brgy').prop('required',false);
    $('#bus_city').prop('required',false);
    $('#bus_zip').prop('required',false);
}
    $('#same_add').change(function(){
        if (this.checked) {
            $('#autoUpdate').hide();
            $('#bus_no').prop('required',false);
            $('#bus_brgy').prop('required',false);
            $('#bus_city').prop('required',false);
            $('#bus_zip').prop('required',false);
        }
        else {
            $('#autoUpdate').show();
            $('#bus_no').prop('required',true);
            $('#bus_brgy').prop('required',true);
            $('#bus_city').prop('required',true);
            $('#bus_zip').prop('required',true);
        }                   
    });
    $(function () {
        $('#ResultTable').DataTable({
                "order": [[ 0, "desc" ]]
        });
      });
      function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
        printWindow.close();
    }, true);
}
</script>
<?php
Modal();
makeFoot(WEBAPP,1);
?>
