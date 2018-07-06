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
    
    } elseif($_GET['tab'] < 1 || $_GET['tab'] > 3) {
        redirect("ci_checking.php");
    }
if(empty($data)){
    redirect("ci_checking.php");
}
$tab=2;

$trade=$con->myQuery("SELECT * FROM trade_check WHERE is_deleted='0' AND loan_id=? AND client_no=?",array($data['id'],$client['client_number']))->fetchAll(PDO::FETCH_ASSOC);
if(!empty($_GET['tc'])){
    $trades=$con->myQuery("SELECT * FROM trade_check WHERE id=?",array($_GET['tc']))->fetch(PDO::FETCH_ASSOC);
  }
?>
	<?php
		Alert();
		
	?>
             <div align='center'>
            <h3><b>TRADE CHECKINGS</b>
            </div>
            <div style='float:right;'>
            <!-- <a href="trade_checking_print.php?id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>" class='btn btn-success'> View &nbsp;<span class='fa fa-search'></span> </a> -->
            <button onclick="printExternal('trade_checking_print.php?id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>')" class='btn btn-default no-print'>Print &nbsp;<span class='fa fa-print'></span></button>  
            </h3>
            </div>
            <table style='width: 60% !important;margin-left: 15%;'>
            <tr><td align='right'><b>Last Name: &nbsp;</b></td><td><?php echo $client['lname'];?></td><td align='right'><b>Client Number: &nbsp;</b></td><td><?php echo $client['client_number'];?></td></tr>
            <tr><td align='right'><b>First Name: &nbsp;</b></td><td><?php echo $client['fname'];?></td><td align='right'><b>Application Number: &nbsp;</b></td><td><?php echo $data['app_no'];?></td></tr>
            </table><br>
            <div class='text-right'>
            <button class='btn btn-warning' data-toggle="collapse" data-target="#hide" aria-expanded="false" aria-controls="collapseForm">Add Trade Check </button><br><br>
            </div>
                <div id='hide' class='collapse'>
                <form action="save_trade_check.php" method="post" class="form-horizontal" id='frmclear'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <input type='hidden' name='tab' id='tab' value="<?php echo !empty($_GET['tab'])?htmlspecialchars($_GET['tab']):''?>">
                <input type='hidden' name='client_no' id='client_no' value="<?php echo !empty($client['client_number'])?htmlspecialchars($client['client_number']):''?>">
                <input type='hidden' name='tc_id' id='tc_id' value="<?php echo !empty($trades['id'])?htmlspecialchars($trades['id']):''?>">
                <div class='form-group'>
                     <label class="col-md-3 control-label">Informant: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="inform" name='inform' placeholder="Informant" value='<?php echo !empty($trades)?htmlspecialchars($trades['informant']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Telephone: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="tel_no" name='tel_no' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($tradest['tel_no']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Dealings: </label>
                      <div class="col-md-8">
                      <textarea class='form-control' name='dealings' id='dealings'  required><?php echo !empty($trades)?htmlspecialchars($trades['dealings']):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Since: </label>
                      <div class="col-md-7">
                          <input type="text" class="form-control" id="since" name='since' placeholder="Since" value='<?php echo !empty($trades)?htmlspecialchars($trades['since']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Average Billing: </label>
                      <div class="col-md-7">
                          <input type="text" class="form-control" id="ave_bill" name='ave_bill' placeholder="Average Billing" value='<?php echo !empty($trades)?htmlspecialchars($trades['ave_bill']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Terms: </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="terms" name='terms' placeholder="Terms" value='<?php echo !empty($trades)?htmlspecialchars($trades['terms']):''; ?>' required>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Experience: </label>
                      <div class="col-md-7">
                      <textarea class='form-control' name='exp' id='exp'  required><?php echo !empty($trades)?htmlspecialchars($trades['experience']):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Date Checked: </label>
                      <div class="col-md-3">
                      <input type="text" class="form-control date_picker" value='<?php echo !empty($trades)?htmlspecialchars($trades['date_checked']):''; ?>' id="date_checked" name='date_checked' required>
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
                            <th class='text-center'>Since</th>
                            <th class='text-center'>Terms</th>
                            <th class='text-center'>Date Checked</th>
                            <th class='text-center'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($trade as $row):
                        ?>
                        <tr>
                            <td class='text-center'><?php echo htmlspecialchars($row['informant'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['since'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['terms'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['date_checked'])?></td>
                            <td class='text-center'>
                            <a href='ci_checking_form.php?id=<?php echo $data['id']?>&tab=<?php echo $tab?>&tc=<?php echo $row['id']?>' class='btn btn-success'><span class='fa fa-pencil'></span></a>
                            <button type='submit' class='btn bg-gray' id='btn-print' name='btnprint' data-toggle='tooltip' data-placement='top' title='Print' onclick='submit(<?php echo $row['id']?>);'> <i class='fa fa-print'> </i></button>
                            <a href='../php/delete.php?type=trade_check&tab=2&loan=<?php echo $data['id']?>&id=<?php echo $row['id']?>' onclick="return confirm('This record will be deleted.')" class='btn btn-danger'><span class='fa fa-trash'></span></a>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
<?php
    $request_type="submit_ci";
    require_once("../include/modal_trade_check.php");
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
