<?php
require_once('../support/config.php');
$trade=$con->myQuery("SELECT * FROM cred_app_vehicles WHERE is_deleted='0' AND loan_id=?",array($_GET['id']))->fetchAll(PDO::FETCH_ASSOC);
if(!empty($_GET['vo'])){
    $data=$con->myQuery("SELECT * FROM cred_app_vehicles WHERE loan_id=? AND id=?",array($_GET['id'],$_GET['vo']))->fetch(PDO::FETCH_ASSOC);
  }
?>
<div class='box-body'>
<div class='text-right'>
            <button id='vehicles_owned' class='btn btn-warning' data-toggle="collapse" data-target="#hide1" aria-expanded="false" aria-controls="collapseForm">Add Vehicle </button><br><br>
            </div>
                <div id='hide1' class='collapse'>
                <form action="save_vehicles_owned.php" method="post" class="form-horizontal" id='frmclear'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <input type='hidden' name='vo_id' id='vo_id' value="<?php echo !empty($data['id'])?htmlspecialchars($data['id']):''?>">
                <div class='form-group'>
                     <label class="col-md-3 control-label">Units: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="unit" name='unit' placeholder="Unit" value='<?php echo !empty($data)?htmlspecialchars($data['unit']):''; ?>' required>
                      </div>
                      <label class="col-md-2 control-label">Name: *</label>
                      <div class="col-md-3">
                      <input type="text" class="form-control" id="name" name='name' placeholder="Name" value='<?php echo !empty($data)?htmlspecialchars($data['name']):''; ?>' required>
                    </div>
                </div>
                <div class='form-group'>
                     <label class="col-md-3 control-label">Description: *</label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="desc" name='desc' placeholder="Description" value='<?php echo !empty($data)?htmlspecialchars($data['description']):''; ?>' required>
                      </div>
                </div> 
                <div class="form-group">
                    <div class="col-sm-10 col-md-offset-1 text-center">
                    <button type='submit' class='btn btn-warning' id='submitbtn'>Save </button>
                    <button type='button' class='btn btn-default' data-toggle="collapse" data-target="#hide1" aria-expanded="false" aria-controls="collapseForm">Cancel</button>
                    </div>
                </div>  
                </form>
            </div>
<div class="box-body">
		<table id='ResultTable1' class="table responsive-table table-bordered table-striped" >
			<thead>
				<tr >
					<th class='text-center'>Units</th>
					<th class='text-center'>Name</th>
					<th class='text-center'>Description</th>
					<th width='10%' class='text-center'>Action</th>
				</tr>
			</thead>
            <tbody style=' word-break: break-all;'>
                        <?php
                        foreach($trade as $row):
                        ?>
                        <tr>
                            <td class='text-center'><?php echo htmlspecialchars($row['unit'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['name'])?></td>
                            <td class='text-center'><?php echo htmlspecialchars($row['description'])?></td>
                            <td class='text-center'>
                            <a href='business_writeup.php?id=<?php echo $_GET['id']?>&vo=<?php echo $row['id']?>' class='btn btn-success'><span class='fa fa-pencil'></span></a>
                            <a href='../php/delete.php?type=cred_app_vo&loan=<?php echo $_GET['id']?>&id=<?php echo $row['id']?>' onclick="return confirm('This record will be deleted.')" class='btn btn-danger'><span class='fa fa-trash'></span></a>
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
    $('#hide1').collapse({
      toggle: true
    })    
  });
  window.location.hash='#vehicles_owned';
</script>
<?php
  endif;
?>
<script>
    // $(function () {
    //     $('#ResultTable1').DataTable({
    //             "searching": false,
    //            dom: 'Bfrtip',
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
