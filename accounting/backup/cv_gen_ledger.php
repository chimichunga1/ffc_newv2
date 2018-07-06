 

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

$maxcv1=$con->myQuery("SELECT max(cntrct_id) from cheque_voucher ");
 $maxcv = $maxcv1->fetch(PDO::FETCH_NUM);



// $maxcv=mysqli_query($conn,'SELECT max(cntrct_id) from cheque_voucher '); $maxfetch=mysqli_fetch_array($maxcv); echo $maxfetch[0]+200001;

$account=$con->myQuery("SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

$bank=$con->myQuery("SELECT id,  name FROM bank where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
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
                                        <li class="active" ><a href="cv_gen_ledger.php" >Check Voucher</a>
                                        </li>
                                        <li ><a href="jv_gen_ledger.php">Journal Voucher</a>
                                        </li>
                                        
                                        
                                    </ul>
                                    <div class="tab-content">
                                        <div class="active tab-pane" >
                                          

<?php ////////////////////////////////////////////////////////////////////////////////////////////////  ?>







<form action="" method="" class="form-horizontal" id='frmclear'>

    <div class='form-group'>
        <label class='col-sm-12 col-md-4 control-label'> CV No: </label>
            <div class='col-sm-12 col-md-5'>
                <input type="text" class="form-control" id='filtercv' placeholder="Enter CV number">
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

  <button type='button' id='generatecv' class='btn-flat btn btn-warning btn-block' onclick='generatecv()'><i class="fa fa-plus"> </i> Create CV</button>


  </div>
</div>

<div id='panel' class="box box primary" style="display:none;padding-top:10px;padding-bottom:10px; ">

   <form action="" method="" class="form-horizontal" id='addcv'>
                                <input type='hidden' name='user_id' value='<?php echo !empty($theUser)?$theUser['user_id']:""?>'>

                                   <div class='form-group row'>
                                        <label class='col-sm-12 col-md-1 control-label'> CV No: </label>
                                            <div class='col-sm-12 col-md-3'>
                                                <input type="text" readonly class="form-control" name="cv_no" placeholder="Enter CV No." id='cv' >
                                            </div>

                              
                                    <label class='col-sm-12 col-md-1 control-label'> Name:</label>
                                        <div class='col-sm-12 col-md-3'>
                                            <select class='form-control cbo' style="width: 100%;" data-placeholder="Name" id='client' name='loan_type_id'>
                                            <?php echo makeOptions($account) ?>
                                            </select>
                                    </div>
                       
                                        <label class='col-sm-12 col-md-1 control-label'> Amount: </label>
                                            <div class='col-sm-12 col-md-3'>
                                                <input type="text" class="form-control numeric" onkeyup="db()" class="numeric"  name="amount" placeholder="Enter Amount" id='amount' >
                                            </div>

                                    </div> 

                                        <div class='form-group row'>
                                        <label class='col-md-1 col-xs-21 '> &nbsp;Details: </label>
                               
                               
                                 
                                        <div class='col-md-11  col-xs-12'>
                                            <textarea class='form-control' name='details' style="width: 100%;resize:none; " rows="5" id='details' placeholder="Details" id='details' required></textarea>
                                        </div>
                                    </div>

 <div class='form-group '>
   <div class=' col-md-3'>
 </div>
 <div class=' col-md-3'>
 </div>
 <div class=' col-md-3'>
   
</div>
 <div class='col-xs-12 col-md-3'>
   <button class="add_form_field btn btn-primary btn-block btn-flat">Add Inputs &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
 </div>
</div>
    
  
                 

                                <div class="containerzero">
                                    <div class='form-group '>
                                    
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Pay to: </label>
                                            <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <select class="cbo form-control " data-placeholder="Name Pay To" id='selectfield'   style="width: 100%;" >
                                                 <?php echo makeOptions($account) ?>
                                                </select>

                                            </div>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Amount: </label>  
                                              <div class='col-xs-10 col-sm-11 col-md-4'>
                                                 <input class="form-control numeric"  type="text" onkeyup="cr()" class="numeric" id='selectfield1'  >
                                                    
                                              </div>
                                            
                                          
                                       
                                    </div> 
                                </div>
       <div class="addcontain">
<?php for ($i=0; $i < 20; $i++) { 
?>
                    <?php echo '<div class="container'.$i.'" style="display:none;" id="downs"> ' ; ?>
                                    <div class='form-group '>
                                    
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Pay to: </label>
                                            <div class='col-xs-12 col-sm-12 col-md-5'>
                                                 <select class="cbo form-control" data-placeholder="Name Pay To" id='selectfield'  style="width: 100%;" >
                                                 <?php echo makeOptions($account) ?>
                                                </select>

                                            </div>
                                          <label class='col-xs-12 col-sm-12 col-md-1 control-label'> Amount: </label>  
                                              <div class='col-xs-10 col-sm-11 col-md-4'>
                                                 <input class="form-control numeric" type="text"  onkeyup="cr()" class="numeric" id='selectfield1' >
                                                    
                                              </div>
                                            
                                            <a href="#"  class="delete btn btn-danger "><i class="fa fa-times"></i></a>
                                       
                                    </div> 
                                </div>
<?php
}          

    ?>



</div>         





<hr>



                                    <div class='form-group '>
                                    
                                          <label class='col-sm-12 col-md-1 control-label'> ∑BD: </label>
                                            <div class='col-sm-12 col-md-5'>
                                                
                                                <input class="form-control"  readonly type="text"  id='DB'  >
                                                    
                                            </div>
                                          <label class='col-sm-12 col-md-1 control-label'> ∑CR: </label>  
                                              <div class='col-sm-12 col-md-5'>
                                                 <input class="form-control"  readonly type="text"  id='CR'  >
                                                    
                                              </div>
                                            
                                          
                                       
                                    </div> 
                       
                                   


                                    
                                    <div class='form-group'>

                                         <div class='col-sm-1 col-md-3  '>
                                         </div>
                                          <div class='col-sm-5 col-md-3 '>
                                            <button type='button' class='btn btn-primary btn-flat btn-block' onclick='addcv()' id='sumcv'><span class="fa fa-save"></span> Add</button>
                                          
                                        </div>


                                        <div class='col-sm-5 col-md-3  '>
                                          
                                           <button type='button' class='btn btn-flat btn-block ' onclick='cancelcv()'><span class="fa fa-times"></span> Cancel</button>
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
                            <th>CV No.</th>
                            <th>Client</th>
                            <th>Amount</th>
                            <th>Client No.</th>

                            <th>Action</th>
                       
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
                  "url":"ajax/serverside_cv.php",
                    "data":function(d)
                    {
                        // d.loan_type_id           = $("select[name='loan_type_id']").val();
                        // d.client_no              = $("input[name='client_no']").val();
                        // d.app_no                 = $("input[name='app_no']").val();
                        // d.status_id              = $("select[name='status_id']").val();
                        d.cv_id           = $("input#filtercv").val();
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

    function getallupdate() 
    {

        var valueinput = $("input#getallup").map(function() {
            return this.value
        }).get().join('|');
        console.log(valueinput);
        var payload = new FormData();
        payload.append('data', valueinput);
        $.ajax({
            url: 'backend/updatecv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
                location.reload();
            },
            success: function(data) {
                swal({
                    title: "Success!",
                    text: "Successfully Update!",
                    type: "success",
                    showConfirmButton: false
                });

            },
            cache: false,
            contentType: false,
            processData: false
        });

    }



    function generatecv() 
    {

        var x = ''
        x = "<?php  echo $maxcv[0]+200001;  ?>";
        document.getElementById('cv').value = x;

        console.log(x);
        var payload = new FormData();
        payload.append('dataa', x);
        $.ajax({
            url: 'backend/generatecv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
            },
            success: function(data) {
            },
            cache: false,
            contentType: false,
            processData: false
        });
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

        var cv = $("input#cv").val();
        console.log(cv);
        var payload = new FormData();
        payload.append('dataa', cv);
        $.ajax({
            url: 'backend/cancelcv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
 
            },
            success: function(data) {


            },
            cache: false,
            contentType: false,
            processData: false
        });
        $('#panel').css({
            'display': 'none'
        });
        $('#generatecv').css({
            'display': 'block'
        });


    }

     function validcv()
    {

      var payload = new FormData();

        var valueinput = $("input.validatee").map(function() {
            if (this.value !== '') {
                return this.value
            };
        }).get().join('|');

        var valuebank = $("select.validatee").map(function() {
            if (this.value !== '') {
                return this.value
            };
        }).get().join('|');

        // console.log(valueinput);

        x=valueinput+'|bank|'+valuebank;

        payload.append('data', x);

          $.ajax({
            url: 'backend/validcv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
                location.reload();
            },
            success: function(data) {
                swal({
                    title: "Success!",
                    text: "Successfully Validated!",
                    type: "success",
                    showConfirmButton: false
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });

    }


    function addcv() 
    {
        var payload = new FormData();

        var valueinput = $("input#selectfield1").map(function() {
            if (this.value !== '') {
                return this.value
            };
        }).get().join('|');
        var valueselect = $("select#selectfield").map(function() {
            if (this.value !== '') {
                return this.value
            };
        }).get().join('|');

        var cv = $("input#cv").val() + '|';
        var client = $("select#client").val() + '|';
        var amount = $("input#amount").val() + '|';
        var details = $("textarea#details").val();
        var first = cv + client + amount + details;

        var x = first + '|client|' + valueselect + '|amount|' + valueinput;

        console.log(x);

        payload.append('data', x);


        $.ajax({
            url: 'backend/addcv.php',
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


        //  $("#addcv select").each(function(){
        // $(this).val('').trigger('change');
        // });
        // $("#addcv input").each(function(){
        //     $(this).val('').trigger('change');
        // });
        //   $("#addcv textarea").each(function(){
        //     $(this).val('').trigger('change');
        // });
    }



   
       function conditionvalid() 
    {
       sumjq = function(selector) 
        {
            var sum = 0;
            $(selector).each(function() {
                sum += Number($(this).val());
            });
            return sum;
        }

        var credit = sumjq('input#getcredit');
        var amount =  sumjq('input#getamount');
        console.log(credit+' & '+amount);

        if (((Number(credit) === 0) || (Number(amount) === 0))) {
            $('#valid').attr("disabled", true);

        } else if (Number(credit) === Number(amount)) {

            $('#valid').attr("disabled", false);

        } else {
            $('#valid').attr("disabled", true);
        }
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
    conditionvalid();


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
