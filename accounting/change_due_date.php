<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}

makeHead("Due Date",1);


require_once("../template/header.php");
require_once("../template/sidebar.php");
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
        <section class="content-header">
            
            <h1 class="text-primary">Change of Due Date</h1>                
           
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>
            <li class="active">Change of Due Date  </li>
          </ol>

        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
            <div class="row">

                <div class='col-md-12 '>
                    <?php
                    Alert();
                    ?>
                
                    <div class="box box-primary flat">
                        <div class="box-body">

                            <div class='col-md-12'>
	
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
                                            <label class="col-sm-5 control-label">Client Name: </label>
                                            <div class='col-sm-3'>
                                                <select class='form-control cbo' name='borrower_name' id='borrower_name' data-placeholder="Select Borrower Name">
                                                    <?php echo makeOptions(); ?>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class='form-group'>
                                        <label class="col-md-5 control-label">Contact No. </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number">
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
                                            <th>Contract No.</th>
                                            
                                            <th>Client Name</th>
                                            <th>Maturity</th>
                                            <th>Billing Date</th>
                                            <th>Due Date</th>
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
                </div>
            </div>
        </section>
	
	
</div>

 
</div>
<?php
    $request_type="submit_ci";
    require_once("../include/modal_submit_ci.php");
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
		var string = href.substr(0,href.lastIndexOf('/'))+"/create_loan.php?id=" + id;
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
               
                "select":true,
                // "ajax":{
                //   "url":"ajax/ci_checking.php"
                  
                // },"language": {
                //     "zeroRecords": "No Records Found."
                // },
                // order:[[0,'desc']]
                // ,"columnDefs": [	
                //     { "orderable": false, "targets": [-1] },
                //     {"sClass": "text-center", "aTargets": [ -1 ]}
                //   ] 
        });
        
    });
    
</script>


<?php
Modal();
makeFoot(WEBAPP,1);
?>