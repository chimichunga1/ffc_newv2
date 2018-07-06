<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}

makeHead("Credit Committee",1);


require_once("../template/header.php");
require_once("../template/sidebar.php");
?>

<div class="content-wrapper">

<section class="content-header">
	<?php
		Alert();
		
	?>
	<div class="box">
	<div class="box-body">
	<center>
	<h2> Credit Committee </h2>
	</center>
	<hr><br>
			<div class="row">
                <form action="" method="" class="form-horizontal" id='frmclear'>
                    <div class='form-group'>
                      <label class="col-md-3 control-label">Date Start: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control date_picker" id="date_start" name='date_start'>
                      </div>
                      <label class="col-md-2 control-label">Date End: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control date_picker" id="date_end" name='date_end'>
                      </div>
                  </div>
                   <div class='form-group'>
                        <label class="col-sm-3 control-label">Borrower Name: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='borrower_name' id='borrower_name' data-placeholder="Select Borrower Name">
                        
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Loan Type: </label>
                        <div class='col-sm-3'>
                            <select class='form-control cbo' name='loan_type' id='loan_type' data-placeholder="Select Loan Type">
                              
                            </select>
                        </div>
                    </div>
                    <div class='form-group'>
                      <label class="col-md-3 control-label">Client No. </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number">
                      </div>
                  </div>
                    <div class='form-group'>
                        <div class='col-md-7 text-right'>
                            <button type='button' class='btn-flat btn btn-primary' onclick='filter_search()'><span class="fa fa-search"></span> Search</button>
                            <button type='button' onclick="form_clear('frmclear')" class="btn btn-default">Clear</button>
                        </div>
                    </div>
                </form>
            </div>
			<!-- <?php if($_SESSION[WEBAPP]['user']['user_type_id'] <> 4): ?>		
				<a href='create_loan.php'><button type="submit" class="btn btn-primary" id="btn-add" name="btnadd" style="float:right;"><i class="fa fa-plus"> &nbsp; Apply New Loan</i>
				</button></a>
			<?php endif; ?> -->
		
		</div>
	<div class="box-body">
		<table id='dataTables' class="table responsive-table table-bordered table-striped" >
			<thead>
				<tr >
					<th>Application No.</th>
					<th>Client No.</th>
					<th>Borrower Name</th>
					<th>Loan Type</th>
					<th>Loan Date</th>
                    <th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<!-- <tr class="tableheader"> -->


					
			</tbody>
		</table>
	</div>
	</div>
	</div>
</section>

 
</div>
<?php
    // $request_type="submit_ci";
    require_once("../include/modal_business_write_up.php");
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
		if (confirm("The record will be deleted. Are you sure?") == true) {
            var href = window.location.href;
			var string = href.substr(0,href.lastIndexOf('/'))+"/php/delete.php?id=" + id +"&type=loan";
			window.location=string;
          } else {
            return false;
          }
	}
	
	function edit(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/business_writeup.php?id=" + id;
		window.location=string;
	}
	    function filter_search()
    {
            dttable.ajax.reload();
            //console.log(dttable);
    }
</script>




<script>
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
                  "url":"ajax/credit_approval.php"
                  
                },"language": {
                    "zeroRecords": "No Records Found."
                },
                order:[[0,'desc']]
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