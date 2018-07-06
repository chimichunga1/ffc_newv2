<?php
require_once('../support/config.php');
$trade=$con->myQuery("SELECT * FROM cred_app_relations WHERE is_deleted='0' AND loan_id=?",array($_GET['id']))->fetchAll(PDO::FETCH_ASSOC);
if(!empty($_GET['tc'])){
    $data=$con->myQuery("SELECT * FROM cred_app_relations WHERE loan_id=? AND id=?",array($_GET['id'],$_GET['tc']))->fetch(PDO::FETCH_ASSOC);
  }
?>
<div class='box-body'>
<div class='text-right'>
            <button id='our_relations' class='btn btn-warning' data-toggle="collapse" data-target="#hide" aria-expanded="false" aria-controls="collapseForm">Add Relation </button><br><br>
            </div>
                <div id='hide' class='collapse'>
                <form action="save_our_relations.php" method="post" class="form-horizontal" id='frmclear'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <input type='hidden' name='rel_id' id='rel_id' value="<?php echo !empty($data['id'])?htmlspecialchars($data['id']):''?>">
                <div class='form-group'>
                     <label class="col-md-3 control-label">Account Number: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="acct_no" name='acct_no' placeholder="Account Number" value='<?php echo !empty($data)?htmlspecialchars($data['acct_no']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Facility: *</label>
                      <div class="col-md-3">
                      <input type="text" class="form-control" id="facility" name='facility' placeholder="Facility" value='<?php echo !empty($data)?htmlspecialchars($data['facility']):''; ?>' required>
                    </div>
                </div>
                <div class='form-group'>
                     <label class="col-md-3 control-label">Unit: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="unit" name='unit' placeholder="Unit" value='<?php echo !empty($data)?htmlspecialchars($data['unit']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Plate Number: </label>
                      <div class="col-md-3">
                      <input type="text" class="form-control" id="plate_no" name='plate_no' placeholder="Plate Number" value='<?php echo !empty($data)?htmlspecialchars($data['plate_no']):''; ?>'>
                    </div>
                </div> 
                <div class='form-group'>
                     <label class="col-md-3 control-label">AF: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="af" name='af' placeholder="AF" value='<?php echo !empty($data)?htmlspecialchars($data['af']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">TLV: *</label>
                      <div class="col-md-3">
                      <input type="text" class="form-control numeric" id="tlv" name='tlv' placeholder="TLV" value='<?php echo !empty($data)?htmlspecialchars($data['tlv']):''; ?>' required>
                    </div>
                </div>
                <div class='form-group'>
                     <label class="col-md-3 control-label">Granted: *</label>
                      <div class="col-md-3">
                      <input type="text" class="form-control date_picker" value='<?php echo !empty($data)?htmlspecialchars($data['granted']):''; ?>' id="granted" name='granted' required>
                      </div>
                      <label class="col-md-2 control-label">Terms: *</label>
                      <div class="col-md-3">
                      <input type="text" class="form-control numeric" id="terms" name='terms' placeholder="Terms" value='<?php echo !empty($data)?htmlspecialchars($data['terms']):''; ?>' required>
                    </div>
                </div>
                <div class='form-group'>
                     <label class="col-md-3 control-label">M.A: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="ma" name='ma' placeholder="M.A" value='<?php echo !empty($data)?htmlspecialchars($data['ma']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Balance: *</label>
                      <div class="col-md-3">
                      <input type="text" class="form-control numeric" id="balance" name='balance' placeholder="Balance" value='<?php echo !empty($data)?htmlspecialchars($data['balance']):''; ?>' required>
                    </div>
                </div>
                <div class='form-group'>
                     <label class="col-md-3 control-label">Rule 78 Bal: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="rule78" name='rule78' placeholder="Rule 78 Balance" value='<?php echo !empty($data)?htmlspecialchars($data['rule78']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Experience: *</label>
                      <div class="col-md-3">
                      <input type="text" class="form-control" id="exp" name='exp' placeholder="Experience" value='<?php echo !empty($data)?htmlspecialchars($data['exp']):''; ?>' required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-md-offset-1 text-center">
                    <button type='submit' class='btn btn-warning' id='submitbtn'>Save </button>
                    <button type='button' class='btn btn-default' data-toggle="collapse" data-target="#hide" aria-expanded="false" aria-controls="collapseForm">Cancel</button>
                    </div>
                </div>  
                </form>
            </div>
<div class="box-body">
		<table id='ResultTable' class="table responsive-table table-bordered table-striped">
			<thead>
				<tr >
					<th>Acct. No.</th>
					<th>Facility</th>
					<th>Unit</th>
					<th>Plate No.</th>
					<th>AF</th>
                    <th>TLV</th>
                    <th>Granted</th>
                    <th>Terms</th>
                    <th>M.A</th>
                    <th>Balance</th>
                    <th>Rule 78 Bal.</th>
                    <th>Experience</th>
					<th width='10%' class='text-center'>Action</th>
				</tr>
			</thead>
            <tbody style=' word-break: break-all;'>
                        <?php
                        foreach($trade as $row):
                        ?>
                        <tr>
                            <td class='text-center'><?php echo htmlspecialchars($row['acct_no'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['facility'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['unit'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['plate_no'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['af'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['tlv'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['granted'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['terms'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['ma'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['balance'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['rule78'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['exp'])?></td>
                            <td class='text-center'>
                            <a href='business_writeup.php?id=<?php echo $_GET['id']?>&tc=<?php echo $row['id']?>' class='btn btn-success'><span class='fa fa-pencil'></span></a>
                            <a href="../php/delete.php?type=cred_app_rel&loan=<?php echo $_GET['id']?>&id=<?php echo $row['id']?>" onclick="return confirm('This record will be deleted.')" class='btn btn-danger'><span class='fa fa-trash'></span></a>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
		</table>
	</div>
</div>
<?php 
  if(!empty($data)):
?>
<script type="text/javascript">
  $(function(){
    $('#hide').collapse({
      toggle: true
    })    
  });
  window.location.hash='#our_relations';
</script>
<?php
  endif;
?>
<script>
    // $(function () {
    //     $('#ResultTable').DataTable({
    //            dom: 'Bfrtip',
    //             buttons: [
    //                 {
    //                     extend:"excel",
    //                     text:"<span class='fa fa-download'></span> Download as Excel File "
    //                 }
    //                 ],
    //             "order": [[ 0, "desc" ]]
    //     });
    //   });
	function redirect(id){
	
    //window.location ="/journal_entry.php?id=" + id;
    var href = window.location.href;
    var string = href.substr(0,href.lastIndexOf('/'))+"/journal_entry.php?id=" + id;
    window.location=string;
};

function archive(id){

    //window.location ="/journal_entry.php?id=" + id;
    if (confirm("The record will be deleted. Are you sure?") == true) {
        var href = window.location.href;
        var string = href.substr(0,href.lastIndexOf('/'))+"/../php/delete.php?id=" + id +"&type=cred_app_rel&loan_id="+<?php echo $_GET['id'];?>;
        window.location=string;
      } else {
        return false;
      }
}

function edit(id){

    //window.location ="/journal_entry.php?id=" + id;
    var href = window.location.href;
    var string = href.substr(0,href.lastIndexOf('/'))+"/our_relations.php?id=" + id;
    window.location=string;
}

    var id= document.getElementsByName("id")[0].value;
    var ajaxurl="ajax/our_relations.php?id="+id;

    $('.date_picker').datepicker();  
        $(".date_picker").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        $('.numeric').inputmask('Regex', { 
            regex: "^[0-9]+"
        });
    
    // $(document).ready(function()
    // {
    //     $('#submitbtn').on('click',function()
    //     {
    //         $.ajax({
    //             type:'post',
    //             url:'save_our_relations.php',
    //             data:{
                    
    //             },
    //             cache:false,
    //             success: function(res)
    //             {
    //                 $('#div1').html(res);
    //             }
    //         })
    //     })
    // });
</script>
