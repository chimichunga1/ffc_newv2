
<form action="" method="" class="form-horizontal" id='frmclear'>
<input type='hidden' name='user_id' value='<?php echo !empty($theUser)?$theUser['user_id']:""?>'>
<div class='form-group'>
    <label class='col-sm-12 col-md-4 control-label'> Home Pay To:</label>
        <div class='col-sm-12 col-md-5'>
            <select class='form-control cbo' data-placeholder="Home Pay To"  name='loan_type_id'>
            <?php echo makeOptions($account) ?>
            </select>
        </div>

</div>

<div class='form-group'>
    <label class='col-sm-12 col-md-4 control-label'> Voucher Type:</label>
        <div class='col-sm-12 col-md-5'>
            <select class='form-control cbo' data-placeholder="Select Voucher Type"  name='voucher_type'>
                <option></option>
                <option value='1'>Check Voucher</option>
                <option value='2'>Journal Voucher</option>
            </select>
        </div>

</div>





<div class='form-group'>
    <div class='col-sm-12 col-md-12 col-md-offset-5 '>
        <button type='button' class='btn-flat btn btn-warning' onclick='filter_search()'><span class="fa fa-search"></span> Filter</button>
        <button  type='button' onclick="form_clear('frmclear')" class="btn btn-default">Clear</button>
    </div>

</div>     

</form>
<!-- <a href='add_prep_cv.php' class="btn btn-primary" id="btn-add" style="float:right;"><i class="fa fa-plus"> &nbsp; Add New</i>
</a> -->
<div class="box-body">
<table id='dataTables' class="table responsive-table table-bordered table-striped" >
    <thead>
        <tr >
            <th>Application No.</th>
            <th>Client No.</th>
            <th>Borrower Name</th>
            <th>Loan Type</th>
            <th>Loan Date</th>

            <th>Voucher Type</th>
            <th>Status</th>
           
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- <tr class="tableheader"> -->


            
    </tbody>
</table>
</div>

<script type="text/javascript">


	
	function archive(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		if (confirm("The record will be deleted. Are you sure?") == true) {
            var href = window.location.href;
			var string = href.substr(0,href.lastIndexOf('/'))+"/../php/reject.php?id=" + id +"&type=dist";
			window.location=string;
          } else {
            return false;
          }
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
              "url":"ajax/prep_cv.php",
                "data":function(d)
                {
                    d.loan_type_id           = $("select[name='loan_type_id']").val();
                    d.client_no              = $("input[name='client_no']").val();
                    d.app_no                 = $("input[name='app_no']").val();
                    d.status_id              = $("select[name='status_id']").val();
                   
                }
              
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

function filter_search() 
{
        dttable.ajax.reload();
        //console.log(dttable);
}
</script>
