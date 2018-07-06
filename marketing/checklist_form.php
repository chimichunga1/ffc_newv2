<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Update Checklist",1);

if(empty($data)){
    redirect("checklist_entry_update.php");
}
?>
	<?php
		Alert();
        $fullname = $client['fname'] . " " . $client['mname'] . " " . $client['lname'];
        $requirement = $con->myQuery("SELECT * FROM client_requirements_cf WHERE client_no=:client_no AND application_no=:app_no",array('client_no'=>$client['client_number'], 'app_no'=>$data['app_no']));
	?>
                <form action="save_checklist.php" method="post" class="form-horizontal" id='frmclear'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <input type="hidden" name="client_no" value="<?php echo $client['client_number'];?>">
                  <?php  if(empty($_GET['id'])){  ?>
                      <div class='' id='comment_table' style=' word-wrap: break-word;'>
                    </div>
                  <?php } else{?>

                    <div class='form-group'>
					<label class="col-md-3 control-label">Application Number: </label>
					<div class="col-md-3">
						<input type="text" class="form-control numeric" id="app_no" name='app_no' placeholder="Application Number" value='<?php echo !empty($data)?htmlspecialchars($data['app_no']) :''; ?>' readonly>
					</div>
                    <label for="" class="col-md-2 control-label">Name: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="fullname" value="<?=$fullname;?>" readonly>
                    </div>
                  </div>
                  <div class="box-body">
		<table id='' class="table responsive-table table-bordered table-striped" >
			<thead>
				<tr >
					<th>Document Code</th>
					<th>Document Description</th>
					<th>Status</th>
					<th>Document Type</th>
				</tr>
                <?php
                
                while($row = $requirement->fetch(PDO::FETCH_ASSOC)) :?>
                <tr >
                    <td><?php echo $row['requirement_code']; ?></td>
                    <td style="width:50%;"><?php echo $row['requirement_name']; ?></td>
                    <td>
                        <select name="status[<?php echo $row['requirement_code']; ?>]" id="" class="form-control cbo" data-placeholder="Select a status" style="width:150px" data-allow-clear="true" data-selected="<?php echo $row['status']; ?>">                        
                            <option value="received" >Received</option>
                            <option value="pending">Pending</option>
                            <option value="to_follow">To Follow</option>
                        </select>
                    </td>
                    <td>Credential Document</td>
                    
                </tr>
                  <?php endwhile; ?>
			</thead>
			<tbody>
				<!-- <tr class="tableheader"> -->


					
			</tbody>
		</table>
	</div>
                  
                    <?php }?>
                         <div class="form-group">
					      <div class="col-sm-11 col-md-offset-1 text-center">
                          <input type="hidden" name="submit" id="submit" value="submit">
					      	<button type='submit' name="submit" class='btn btn-primary'>Save </button>
					      	<a href='checklist_entry_update.php' class='btn btn-default'>Cancel</a>
					      </div>
					    </div>
                </form>



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
</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>
