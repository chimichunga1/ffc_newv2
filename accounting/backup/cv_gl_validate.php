 

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




// $maxcv=mysqli_query($conn,'SELECT max(cntrct_id) from cheque_voucher '); $maxfetch=mysqli_fetch_array($maxcv); echo $maxfetch[0]+200001;

$account=$con->myQuery("SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

// $bank=$con->myQuery("SELECT id,  name FROM bank where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
$cv_no=$con->myQuery("SELECT c.cv_id, c.cv_no FROM `cheque_voucher` c WHERE  c.isDeleted=0 and c.isValidated=1")->fetchAll(PDO::FETCH_ASSOC);

require_once("../template/header.php");
require_once("../template/sidebar.php");


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Cheque Voucher Validate</h1>                
           
          <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>
            <li ><a href="#" >   <i class="fa fa-file-text"></i>General Ledger Entries </a> </li>
             <li class="active">Cheque Voucher Validate</li>
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
                             
                                    <div class="tab-content">
                                        <div class="active tab-pane" >
                                          

<?php ////////////////////////////////////////////////////////////////////////////////////////////////  ?>







<form action="" method="" class="form-horizontal" id='frmclear'>

    <div class='form-group'>
        <label class='col-sm-12 col-md-4 control-label'> CV No: </label>
            <div class='col-sm-12 col-md-5'>
             
                <input type="text"  class="form-control"  placeholder="CV Number" id='filtercv' >
             
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


                        <!-- </div>
                    </div>
                </div>
            </div> -->
            <div class="box-body">
                <table id='dataTables' class="table responsive-table table-bordered table-striped" >
                    <thead>
                        <tr >
                            <th>CV No.</th>
                            <th>Client No.</th>
                            <th>Client</th>
                     

                       
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
                  "url":"ajax/serverside_cv_validated.php",
                    "data":function(d)
                    {
                        // d.loan_type_id           = $("select[name='loan_type_id']").val();
                        // d.client_no              = $("input[name='client_no']").val();
                        // d.app_no                 = $("input[name='app_no']").val();
                        // d.status_id              = $("select[name='status_id']").val();
                        d.cv_no           = $("input#filtercv").val();
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


    $(document).ready(function() 
    {

        var wrapper = $(".addcontain");
        var add_button = $(".add_form_field");
        var y = 0;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (y == 'undefined' || y === null) {
                y = 0;
            }
            x = '.container' + y;
            $(x).css({
                "display": "block"
            });
            console.log(y = y + 1);
        });

        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
            $(this).parent('div').each(function() {
                $(this).val('').trigger('change');
            });


            sumjq = function(selector) {
                var sum = 0;
                $(selector).each(function() {
                    sum += Number($(this).val());
                });
                return sum;

            }
            // console.log(sumjq('input#selectfield1'));
            document.getElementById('CR').value = sumjq('input#selectfield1').toString();

        })
    });

  



    function generatecv() 
    {

     
        $('#panel').css({
            'display': 'block'
        });
        $('#generatecv').css({
            'display': 'none'
        });


    }

    function cancelcv() 
    {
        $("#addcv select").each(function() {
            $(this).val('').trigger('change');
        });
        $("#addcv input").each(function() {
            $(this).val('').trigger('change');
        });
        $("#addcv textarea").each(function() {
            $(this).val('').trigger('change');
        });


        $('#panel').css({
            'display': 'none'
        });
        $('#generatecv').css({
            'display': 'block'
        });


    }

   

 



    function db() 
    {
        document.getElementById('DB').value = $('#amount').val();
        conditionadd();
    }



    function cr() 
    {
        sumjq = function(selector) 
        {
            var sum = 0;
            $(selector).each(function() {
                sum += Number($(this).val());
            });
            return sum;
        }
        // console.log(sumjq('input#selectfield1'));
        document.getElementById('CR').value = sumjq('input#selectfield1').toString();
        // console.log(Number($('#CR').val()));
        // console.log(Number($('#DB').val()));
        conditionadd();
    }
    function conditionadd() 
    {
        if (((Number($('#DB').val()) == 0) || (Number($('#CR').val()) == 0))) {
            $('#sumcv').attr("disabled", true);
        } else if (Number($('#DB').val()) === Number($('#CR').val())) {

            $('#sumcv').attr("disabled", false);

        } else {
            $('#sumcv').attr("disabled", true);
        }
    }








    conditionadd();
  


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
