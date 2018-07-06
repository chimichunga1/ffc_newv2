<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1))){
  redirect("../index.php");
}

makeHead("Manner of Payment",1);

require_once("../template/header.php");
require_once("../template/sidebar.php");
?>

<div class="content-wrapper">
	
<section class="content-header">
	<h2> Manner of Payment </h2>
	<?php
		Alert();
		
	?>
	<div class="box">
		<div class="box-body">
				<a href='frm_manner_of_payment.php'><button type="submit" class="btn btn-primary" id="btn-add" name="btnadd" style="float:right;"><i class="fa fa-plus"> Add New Payment Type</i></button></a>
		</div>
	<div class="box-body">
		<table id='dataTables' class="table responsive-table table-bordered table-striped" >
			<thead>
				<tr class="tableheader">
					<th>Payment Code</th>
					<th>Payment Name</th>
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
		if (confirm("The record will be deleted. Are you sure?") == true) {
            var href = window.location.href;
			var string = href.substr(0,href.lastIndexOf('/'))+"/../php/delete.php?id=" + id + "&type=mt";
			window.location=string;
          } else {
            return false;
          }
	}
	
	function edit(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/frm_manner_of_payment.php?id=" + id;
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
                  "url":"ajax/manner_of_payment.php"
                  
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