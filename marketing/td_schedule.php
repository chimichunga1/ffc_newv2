<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Instruction Sheet Preparation",1);
    if (empty($_GET['tab'])) {
          
        redirect("instruction_sheet_prep.php");
    
    } elseif($_GET['tab'] < 1 || $_GET['tab'] > 2) {
        redirect("instruction_sheet_prep.php");
    }
    if(!empty($_GET['ee'])){
        $authTD = $con->myQuery("SELECT * FROM td_sched WHERE id = ? AND app_no = ? AND is_deleted = 0",array($_GET['ee'],$data['app_no']))->rowCount();
            if($authTD <= 0){
                redirect('instruction_sheet_prep.php');
                Alert('User not found','warning');
            }
            $elementTd = $con->myQuery("SELECT * FROM td_sched WHERE id = ? AND app_no = ? AND is_deleted = 0",array($_GET['ee'],$data['app_no']))->fetch(PDO::FETCH_ASSOC);
                if(empty($elementTd)){
                    redirect('instruction_sheet_prep.php');
                    Alert('User not found','warning');}
    }

if(empty($data)){
    redirect("instruction_sheet_prep.php");
}

$addDis = $con->myQuery("SELECT * FROM instruction_sheet_td WHERE app_no = ? AND is_deleted = 0",array($data['app_no']))->rowCount();
$printTd = $con->myQuery("SELECT * FROM td_sched WHERE app_no = ? AND is_deleted = 0",array($data['app_no']))->rowCount();
?>
<div class="form-horizontal">

                <input type='hidden' name='id' id='id' value="<?=$_GET['id'];?>">
                	<div class="form-group">
                        <label for="" class="col-md-3 control-label">Application No.: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="app_no" value="<?php echo (empty($data['app_no'])?'':htmlspecialchars($data['app_no'])) ; ?>" readonly>
                        </div>
                        <label for="" class="col-md-2 control-label">Account No.: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" value="" name="acc_no" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Borrower: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="bor_name" value="<?php echo (empty($bor_name)?'':htmlspecialchars($bor_name)) ; ?>" readonly>
                        </div>
                        <label class="col-md-2 control-label">Client No.: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="client_no" value="<?php echo (empty($client['client_number'])?'':htmlspecialchars($client['client_number'])) ; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Principal: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="principal" value="<?php echo isEmptyFloat($clientAddon['net_proceeds']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Interest Rate: </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control ls-lock" name="int_rate" value="<?php echo isEmptyFloat($clientAddon['int_rate']); ?>" readonly>
                        </div>
                        <label for="" class="col-md-2 control-label">Release Date: </label>
                        <div class="col-md-3">
                            <input type="text" name="rel_date" id="rel_date" class="form-control" value="<?php echo isEmptyDate($clientAddon['start_date']); ?>" readonly>
                        </div>
                    </div>
                    <div class="text-left" style="padding-left:20px;">
                    <?php if ($printTd >0) :?>
                    <div style="padding-bottom:10px;">
                    <form action="td_sched_print.php" method="POST" target="_blank">
                        <input type="hidden" name="app_no" value="<?php echo $clientAddon['app_no']; ?>">
                        <button type="submit" class="btn btn-default" name="submit"><span class="fa fa-print"></span>  Print </button>
                    </form>
                    </div>
                    <?php endif; ?>
                    <?php if($addDis > 0) :?>
                    <button class='btn btn-success' type="button" data-toggle="collapse" data-target="#hide" aria-expanded="false" aria-controls="collapseForm">Add Discount</button>
<?php endif;?>
                    <br><br>
                    </div>
                    <div id='hide' class='collapse'>
                    <form action="save_td_sched.php" method="post" class="form-horizontal" id='addSched'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <div class='form-group'>
                     <label class="col-md-3 control-label">Bank: </label>
                      <div class="col-md-3">
                      <select name="bank" id="bank" class="form-control cbo" data-allow-clear="true" data-placeholder="Select a Bank" style="width: 100%;" data-selected="<?php echo isEmptyInt($elementTd['bank']); ?>" required>
                                    <?php echo makeOptions($bank); ?>
                            </select>
                      </div>
                      <label class="col-md-2 control-label">Check No.: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="check_no" name='check_no' placeholder="Check Number" value="<?php echo !empty($elementTd)?isEmptyInt($elementTd['check_no']):''; ?>" required>
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-md-3 control-label">Amount: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control ls-type" name="amount" placeholder="Amount" value="<?php echo !empty($elementTd)?isEmptyFloat($elementTd['amount_sched']):''; ?>" required>
                    </div>
                    <label for="" class="col-md-2 control-label">Maturity Date: </label>
                    <div class="col-md-3">
                         <input type="text" class="form-control date_picker" name="maturity_date_sched" placeholder="Maturity Date" value="<?php echo !empty($elementTd)?isEmptyDate($elementTd['maturity_date_sched']):''; ?>" required>
                    </div>
                  </div>
                 <div class="form-group text-center">
                 <?php if(empty($elementTd)) : ?>
                    <button class="btn btn-success" name="submit" type="submit" id="save"> Save </button>
                    <input type="hidden" name="create" value="create"> 
                <?php else: ?>
                <button class="btn btn-info" name="submit" type="submit" id="save"> Update </button>
                <input type="hidden" name="idTbl" value="<?php echo $_GET['ee']; ?>">
                <input type="hidden" name="update" value="update">
                <?php endif; ?>
                    <a href="instruction_sheet_td.php?id=<?php echo $_GET['id']; ?>&tab=2" class="btn btn-default"> Cancel </a>
                 </div>
                  </form>
                  </div>
    
    <table id='dataTables' class="table responsive-table table-bordered table-striped" >
			<thead>
				<tr >
					<th>Bank</th>
					<th>Check No.</th>
					<th>Amount</th>
					<th>Maturity Date</th>
					<th>Term (Days)</th>
                    <th>Discount</th>
					<th>Net Proceeds</th>
                    <th>Action</th>
				</tr>
			</thead>
			<tbody>
				<!-- <tr class="tableheader"> -->


					
			</tbody>
		</table>
    
    </div>
                    






<script>
<?php if(!empty($elementTd)) : ?>
 $(function(){
    $('#hide').collapse({
      toggle: true
    })    
  });
  <?php endif;?>
  var dttable="";
      $(document).ready(function() {
          var id = <?php echo $clientAddon['app_no']; ?>;

        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",
                "scrollX":"100%",
                "searching": false,
                "processing": true,
                "serverSide": true,
                "select":true,
                "ajax":{
                  "url":"ajax/td_sched.php?id="+id
                  
                },"language": {
                    "zeroRecords": "No Records Found."
                },
                order:[[0,'desc']]
                ,"columnDefs": [	
                    { "orderable": false, "targets": [-1] },
                    {"sClass": "text-center", "aTargets": [ -1 ]}
                  ]
                ,"lengthMenu": [[10,-1],[10,'All']]

        });
        
    });
    $('form#addSched').submit(function(){
        $('button#save').attr('disabled','disabled').html('Saving data...');
    });


</script>