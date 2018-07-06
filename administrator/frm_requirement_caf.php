<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1))){
  redirect("../index.php");
}
if(empty($_GET['id'])){
    redirect("loan_type.php");
}

if(isset($_GET['id'])){
    $auth = $con->myQuery("SELECT * FROM loan_approval_type WHERE id=".$_GET['id'])->fetchColumn();
    if($auth <= 0){
        redirect("loan_type.php");
    }
}else{
    redirect("loan_type.php");
}
makeHead("Requirements - (CAF)",1);

require_once("../template/header.php");
require_once("../template/sidebar.php");

?>
<div class="content-wrapper">

<section class="content-header">
	<h2> Requirements (CAF) </h2>
	<?php
		Alert();
		
	?>
    <a href='frm_loan_type.php?id=<?php echo $_GET['id'];?>'>
	<button type='button' class="btn btn-default"><span class="fa fa-arrow-left"></span> Loan Type Form </button></a><br><br>
	<div class="box">
		<div class="box-body">
				<a href='frm_add_caf_requirement.php?id=<?php echo $_GET['id'];?>'><button type="submit" class="btn btn-primary" id="btn-add" name="btnadd" style="float:right;"><i class="fa fa-plus"> Add Requirement </i></button></a>
		</div>
	<div class="box-body">
		<table id='dataTables' class="table responsive-table table-bordered table-striped" >
			<thead>
				<tr class="tableheader">
					<th>Requirement Code</th>
					<th>Requirement Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				

					
			</tbody>
		</table>
	</div>
	</div>
	</div>
</section>

 
</div>

<script type="text/javascript">


	
	function archive(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		if (confirm("The requirement will be deleted. Are you sure?") == true) {
            var href = window.location.href;
			var string = href.substr(0,href.lastIndexOf('/'))+"/../php/delete.php?id=" + id +"&type=cafReq&loan_type_id="+<?php echo $_GET['id']; ?>;
			window.location=string;
          } else {
            return false;
          }
	}
	
	function edit(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/frm_requirement.php?id=" + id;
		window.location=string;
	}
	

    var dttable="";
      $(document).ready(function() {
        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",
                "scrollX":"100%",
                "searching": false,
                "processing": true,
                "serverSide": true,
                "select":true,
                "ajax":{
                  "url":"ajax/requirement_caf.php?id=<?=$_GET['id'];?>"
                  
                },"language": {
                    "zeroRecords": "No Records Found."
                },
                order:[[0,'asc']]
                ,"columnDefs": [	
                    { "orderable": false, "targets": [-1] },
                    {"sClass": "text-center", "aTargets": [ -1 ]}
                  ] 
        });
        
    });
    
</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>