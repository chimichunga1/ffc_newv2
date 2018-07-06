<?php

$loan_types=$con->myQuery("SELECT * FROM loan_approval_type where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
$loan_status=$con->myQuery("SELECT * FROM loan_status where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

?>
<form action="" method="" class="form-horizontal" id='frmclear'>
<input type='hidden' name='user_id' value='<?php echo !empty($theUser)?$theUser['user_id']:""?>'>
    <div class='form-group'>
        <label class='col-sm-12 col-md-4 control-label'> Type:</label>
            <div class='col-sm-12 col-md-5'>
                <select class='form-control cbo' data-placeholder="Select Loan Type"  name='loan_type_id'>
                    <?php echo makeOptions($loan_types) ?>
                </select>
            </div>

    </div>
    <div class='form-group'>
        <label class='col-sm-12 col-md-4 control-label'> Client No: </label>
            <div class='col-sm-12 col-md-5'>
                <input type="text" class="form-control" name="client_no" placeholder="Enter Client">
            </div>

    </div>
    <div class='form-group'>
        <label class='col-sm-12 col-md-4 control-label'> Application No: </label>
            <div class='col-sm-12 col-md-5'>
                <input type="text" class="form-control" name="app_no" placeholder="Enter Application No" >
            </div>

    </div> 
    <div class='form-group'>
        <label class='col-sm-12 col-md-4 control-label'> Status:</label>
            <div class='col-sm-12 col-md-5'>
                <select class='form-control cbo'  id='status_id' data-placeholder="Select Loan Status" name='status_id' style='width:100%'>
                <?php echo makeOptions($loan_status) ?>
                </select>
            </div>

    </div>
    


    
    <div class='form-group'>
        <div class='col-sm-12 col-md-9 col-md-offset-5 '>
            <button type='button' class='btn-flat btn btn-warning' onclick='filter_search()'><span class="fa fa-search"></span> Filter</button>
            <button  type='button' onclick="form_clear('frmclear')" class="btn btn-default">Clear</button>
        </div>

    </div>     

</form>
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
                  "url":"ajax/check_voucher.php",
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
