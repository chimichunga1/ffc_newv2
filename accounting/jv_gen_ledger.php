 

<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}

if (empty($_GET['tab'])) {
    $tab="1";
}
else {
    
    // $account=$con->myQuery("SELECT id,  CONCAT(first_name,' ',last_name) as `acc_name` FROM loan_list where id = {$_GET['id']}")->fetch(PDO::FETCH_ASSOC);
    
}


 




makeHead("Distribution/Preparation",1);


$account=$con->myQuery("SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
$jv=$con->myQuery("SELECT c.cv_id,j.jv_id FROM `journal_voucher` j INNER JOIN `cheque_voucher` c on c.cv_id=j.jv_id where c.isDeleted=0 and c.isValidated=1 and c.isJournal=1 ")->fetchAll(PDO::FETCH_ASSOC);
$cv=$con->myQuery("SELECT cntrct_id,cv_id FROM `cheque_voucher` where isValidated=1 and isJournal=0 and isDeleted=0 ")->fetchAll(PDO::FETCH_ASSOC);
require_once("../template/header.php");
require_once("../template/sidebar.php");


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">General Ledger Entries</h1>                
           
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>
            <li class="active">General Ledger Entries  </li>
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
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <?php
                                            $no_employee_msg=' Personal Information must be saved.';
                                        ?>
                                        <li  ><a href="cv_gen_ledger.php" >Check Voucher</a>
                                        </li>
                                        <li class="active"><a href="jv_gen_ledger.php">Journal Voucher</a>
                                        </li>
                                        
                                        
                                    </ul>
                                    <div class="tab-content">
                                        <div class="active tab-pane" >
                                          

<?php ////////////////////////////////////////////////////////////////////////////////////////////////  ?>







<form action="" method="" class="form-horizontal" id='frmclear'>

    <div class='form-group'>
        <label class='col-sm-12 col-md-4 control-label'> JV No: </label>
               <div class='col-sm-12 col-md-5'>
                <select class='form-control cbo' style="width: 100%;" data-placeholder="Select a jv"  id='filterjv'>
                    <?php echo makeOptions($jv) ?>
                </select>
            </div>

    </div>
    <div class='form-group'>
        <label class='col-sm-12 col-md-4 control-label'> Client:</label>
            <div class='col-sm-12 col-md-5'>
                <select class='form-control cbo' style="width: 100%;" data-placeholder="Select a client"  id='filterclnt'>
                    <?php echo makeOptions($account) ?>
                </select>
            </div>

    </div>

   
  
    
<?php ////////////////////////////////////////////////////////////////////////////////////////////////  ?>


    
    <div class='form-group'>
        <div class='col-sm-12 col-md-9 col-md-offset-5 '>
            <button type='button' class='btn-flat btn btn-warning' onclick='filter_search()'><span class="fa fa-search"></span> Filter</button>
            <button  type='button' onclick="form_clear('frmclear')" class="btn btn-default">Clear</button>
        </div>

    </div>     

</form>


<div class="row">
  <div class="col-sm-12 col-md-10" style="padding:10px;">


  </div>
  <div class="col-sm-12 col-md-2" style="padding:10px;">

  <button type='button' id='generatejv' class='btn-flat btn btn-warning btn-block' onclick='generatejv()'><i class="fa fa-plus"> </i> Create JV</button>


  </div>
</div>

<div id='panel' class="box box primary" style="display:none;padding-top:10px;padding-bottom:10px; ">

   <form action="" method="" class="form-horizontal" id='formjv'>
                              
                                   <div class='form-group row'>
                                        <label class='col-sm-12 col-md-1 control-label'> JV Date: </label>
                                            <div class='col-sm-12 col-md-5'>
                                                <input type="text" readonly class="form-control"  id='jvdate' value="<?php echo date('Y-m-d'); ?>" >
                                            </div>

                              
                                    <label class='col-sm-12 col-md-1 control-label'> JV no.:</label>
                                        <div class='col-sm-12 col-md-5'>
                                            <select class='form-control cbo' onchange="autofilljv();" style="width: 100%;" data-placeholder="JV No." id='jvno'>
                                            <?php echo makeOptions($cv) ?>
                                            </select>
                                    </div>

                                  </div>
                                     <div id="dropdown-result" style="display: none;"></div>



                                    <div class='form-group row'>
                                        <label class='col-md-1 col-xs-1 '> &nbsp;Details: </label>
                               
                            
                                        <div class='col-md-11  col-xs-12'>
                                            <textarea class='form-control' name='details' style="width: 100%;resize:none; " rows="5" id='details' placeholder="Details"  required></textarea>
                                        </div>
                                    </div>


  
                 

                         
                                   


                                    
                                    <div class='form-group'>

                                         <div class='col-sm-1 col-md-3  '>
                                         </div>
                                          <div class='col-sm-5 col-md-3 '>
                                            <button type='button' class='btn btn-primary btn-flat btn-block' onclick='addjv();' ><span class="fa fa-save"></span> Add</button>
                                          
                                        </div>


                                        <div class='col-sm-5 col-md-3  '>
                                          
                                           <button type='button' class='btn btn-flat btn-block ' onclick='canceljv();'><span class="fa fa-times"></span> Cancel</button>
                                        </div>
                                         <div class='col-sm-1 col-md-3  '>
                                         </div>

                                    </div>     

                                </form>
                                </div>



</div>

                        <!-- </div>
                    </div>
                </div>
            </div> -->
            <div class="box-body">
                <table id='dataTables' class="table responsive-table table-bordered table-striped" >
                    <thead>
                        <tr >
                            <th>JV No.</th>
                            <th>Client</th>
                            <th>Client No.</th>
                              <th>Action </th>
          
                        </tr>
                    </thead>
                    <tbody>
           

                            
                    </tbody>
                </table>
            </div>
        </section>



   
<script>
    var dttable="";
      $(document).ready(function() {
        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",
                "scrollX":"100%",
                "searching": false,
                "processing": true,
    
                "select":true,
                 "processing": true,
   
              // "ajax": "ajax/serverside_cv.php",
                "ajax":{
                  "url":"ajax/serverside_jv.php",
                    "data":function(d)
                    {
                        // d.loan_type_id           = $("select[name='loan_type_id']").val();
                        // d.client_no              = $("input[name='client_no']").val();
                        // d.app_no                 = $("input[name='app_no']").val();
                        // d.status_id              = $("select[name='status_id']").val();
                        d.jv_id           = $("input#filterjv").val();
                        d.clnt_id              = $("select#filterclnt").val(); 
                      }
                  
                },
                "language": {
                    "zeroRecords": "No Records Found."
                },
                order:[[0,'desc']]
                ,"columnDefs": [  
                    { "searchable": false, "targets": 0 },
                    { "orderable": false, "targets": [-1] },
                    { "sClass": "text-center", "aTargets": [ -1 ]}
                  ] 

 


        });
        
    });
    
    function filter_search() 
    {
            dttable.ajax.reload();
            //console.log(dttable);
    }


  function addjv()
  {

    

    var a1 = $('input#jvdate').val();
   var a2 = $('select#jvno').val();
   var a3 = $('input#jvclnt').val();
   var a4 = $('input#jvclntname').val();
   var a5 = $('textarea#details').val();

   var x= a1+'|'+a2+'|'+a3+'|'+a4+'|'+a5;
    console.log(x);
 var payload = new FormData();
        payload.append('data', x);
        $.ajax({
            url: 'backend/addjv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
                location.reload();
            },
            success: function(data) {
                swal({
                    title: "Success!",
                    text: "Successfully Added!",
                    type: "success",
                    showConfirmButton: false
                });

            },
            cache: false,
            contentType: false,
            processData: false
        });
  }
function canceljv()

{


      $("#formjv select").each(function() {
            $(this).val('').trigger('change');
        });
        $("#formjv input").each(function() {
            $(this).val('').trigger('change');
        });
        $("#formjv textarea").each(function() {
            $(this).val('').trigger('change');
        });

        $('#panel').css({
            'display': 'none'
        });
        $('#generatejv').css({
            'display': 'block'
        });


}
    function generatejv() 
    {

        $('#panel').css({
            'display': 'block'
        });
        $('#generatejv').css({
            'display': 'none'
        });


    }


 


function  autofilljv(){
    var selectedValue =  document.querySelector('#jvno').value;
    if (selectedValue) {
        var request = new XMLHttpRequest();
        request.open('GET', 'backend/generatejv.php?value=' + selectedValue, true);
        request.onload = function() {
            if (request.status >= 200 && request.status < 400) {
                var dropdownResult = document.querySelector('#dropdown-result');
                dropdownResult.innerHTML = request.responseText;
                dropdownResult.style.display = '';
            }
        };
        request.send();
    }
}


</script>


















<?php ////////////////////////////////////////////////////////////////////////////////////////////////  ?>



















                                        </div><!-- /.tab-pane -->
                                    </div><!-- /.tab-content -->
                                </div><!-- /.nav-tabs-custom -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
<?php
Modal();
makeFoot(WEBAPP,1);
?>
