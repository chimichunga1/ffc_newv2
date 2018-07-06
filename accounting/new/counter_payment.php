<br>
<form action="" method="" class="form-horizontal" id='frmclear'>
    <input type='hidden' name='user_id' value='<?php echo !empty($theUser)?$theUser['user_id']:""?>'>
    <div class='form-group'>
        <label class='col-sm-12 col-md-4 control-label'> Client Name:</label>
            <div class='col-sm-12 col-md-5'>
                <select class='form-control cbo' data-placeholder="Search Account"  name='account_id'>
                    <?php echo makeOptions($account) ?>
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

<!-- <a href='create_loan.php' class="btn btn-primary" id="btn-add" style="float:right;"><i class="fa fa-plus"> &nbsp; Add New</i> -->
<!-- </a> -->
<div class="box-body">
    <table id='dataTables' class="table responsive-table table-bordered table-striped" >
        <thead>
            <tr >
                <th>Client No.</th>
                <th>Client Name</th>
                <th>Account No.</th>
               
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
                  "url":"ajax/counter_payment.php",
                    "data":function(d)
                    {
                        
                        d.account_id              = $("select[name='account_id']").val();
                    
                       
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
