
 

<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1,2))){
  redirect("../index.php");
}





makeHead("Distribution/Preparation",1);


$account=$con->myQuery("SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);


// $accountno=$con->myQuery("SELECT acc_types_id, name FROM account_types ")->fetchAll(PDO::FETCH_ASSOC);
$accountno=$con->myQuery("SELECT id,  acc_id FROM accounts where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);

$accountcode=$con->myQuery("SELECT id,  acc_id FROM accounts where is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);



require_once("../template/header.php");
require_once("../template/sidebar.php");


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
         
        <h1 class="text-primary">Account Distribution</h1>                
           
          <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#" ><i class="fa fa-file"></i> Accounting</a></li>
            <li ><a href="#" >   <i class="fa fa-file-text"></i>General Ledger Entries </a> </li>
             <li class="active">Cheque Voucher  </li>
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
                                          <h4>CV No. <?php echo $_GET['id']; ?> </h4>      

<?php ////////////////////////////////////////////////////////////////////////////////////////////////  ?>

<?php 


if(!empty($_GET['id']))
{
  $d=$_GET['id'];



?>




  <div class="box-body">
                <table id='dataTables' class="table responsive-table table-bordered table-striped"  id='tbl'>
                    <thead>
                        <tr >
                            <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Account No.</th>
                            <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> CD</th>
                            <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Account Code</th>
                            <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;"> Debit</th>
                            <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Credit</th>
                             <th style="text-align:center;border: none transparent;background-color: #3c8dbc;color:white;">  Client</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                                       

<?php

$x=0;

 
$masterquery="SELECT c.`cv_id`,c.`acc_no`,c.`cd`,c.`acc_code`,c.`debit_amount`,c.`credit_amount`,c.`clnt_id`,CONCAT(cl.fname,' ',cl.lname ) fullname FROM `cheque_dbcr` c INNER JOIN client_list cl ON c.clnt_id=cl.client_number WHERE `cv_no`='".$d."' and isDeleted='0' ";

$query1=$con->myQuery($masterquery);
                    while ($row1=$query1->fetch(PDO::FETCH_NUM)) 
                    {
 ?>
 <tr>
                            
                           
                                          <td>
                                            <input class="form-control"  style="width: 100%; text-align: center;background-color: white; border: none transparent;" type="hidden" id="getallup" readonly value="<?php echo $_GET['id']; ?>"> 
                                            <input class="form-control"  style="width: 100%; text-align: center;background-color: white; border: none transparent;" type="hidden" id="getallup" readonly value="<?php echo $row1[0]; ?>"> 

                                              <select class="form-control cbo" data-placeholder=""   id="getallup">
                                                      <option value="0">&nbsp;</option>

                                              <?php

                                              if (!empty($row1[1]))

                                              {
                                              $masterqueryno="SELECT acc_types_id, name FROM account_types where acc_types_id='".$row1[1]."' ";

                                              $queryno=$con->myQuery($masterqueryno);

                                              $rowno=$queryno->fetch(PDO::FETCH_NUM);
                                  
                                              echo '<option selected value="'.$rowno[0].'">'.$rowno[1].'</option>';
                                              
                                              }


                                              ?>

                                                            
                                              <?php echo  makeOptions($accountno); ?>

                                              </select>
                                               

                                          </td>
                                            <td>
                                            <input class="form-control"  style="border: none transparent;width: 100%; text-align: center;" type="text" id="getallup" value="<?php echo $row1[2]; ?>">


                                          </td>
                                            <td>
                                              <select class="form-control cbo" data-placeholder=""   id="getallup">
                                                      <option value="0">&nbsp;</option>
                                                <?php

                                                if (!empty($row1[3]))

                                                {
                                                $masterquerycode="SELECT id,  acc_id FROM accounts where  id='".$row1[3]."' ";

                                                $querycode=$con->myQuery($masterquerycode);

                                                $rowcode=$querycode->fetch(PDO::FETCH_NUM);
                                           
                                                echo '<option selected value="'.$rowcode[0].'">'.$rowcode[1].'</option>';
                                                

                                                }


                                                ?>

   
                                 
                                              <?php echo  makeOptions($accountcode); ?>

                                           
                                              </select>


                                            <td>
                                                   <input class="form-control debit numeric"  style="border: none transparent;width: 100%; text-align: center;" type="text" id="getallup" onkeyup="conditionedit();" value="<?php echo $row1[4]; ?>"> 
                                             </td>
                                            <td>
                                                 <input class="form-control credit numeric"  style="border: none transparent;width: 100%; text-align: center;" type="text" id="getallup"  onkeyup="conditionedit();" value="<?php echo $row1[5]; ?>"> 
                                             </td>
                                            <td>
                                           
                                            <select class="form-control cbo" data-placeholder="Select a client"   id="getallup">
                                         
                                              <?php

                                              if (!empty($row1[6]))

                                              {
                                              $masterqueryacc="SELECT client_number,  CONCAT(fname,' ',lname) as `acc_name` FROM client_list where client_number='".$row1[6]."' ";

                                              $queryacc=$con->myQuery($masterqueryacc);

                                              $rowacc=$queryacc->fetch(PDO::FETCH_NUM);

                                              echo '<option selected value="'.$rowacc[0].'">'.$rowacc[1].'</option>';
                                              

                                              }


                                              ?>

                                              <?php echo  makeOptions($account); ?>
                                              </select>
                                           
                                            </td>
                               
          
       

                   </tr>         
            
                             
 
                                    

<?php
$x+=1;

                    }

echo '       
        </tbody>
                </table>
            </div>



 <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <button type="button" class="btn btn-default btn-block pull-left" onclick="back();" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-xs-12 col-md-6">
                    </div>
              
                    <div class="col-xs-12 col-md-3">
                         <button type="button" class="btn btn-primary btn-block" id="updateget"  onclick="getallupdate();">Save changes</button>
                    </div>
                       
                             
</div>  ';
}
else
{

}



?>




        </section>



   
<script>
 

  function back() 
    {

        
              window.location.href='cv_gl_entries.php';
          

    }

  
    
        $('.clr').on("click", function(e) {
            e.preventDefault();
         $(this).parent('td').each(function() {
                 $('select').val(null).trigger('change');
            });
         console.log('1');
        })
   



    function getallupdate() 
    {

        var valueinput = $("input#getallup").map(function() {
            return this.value
        }).get().join('|');

          var valueselect = $("select#getallup").map(function() {
            return this.value
        }).get().join('|');

        var x = valueinput+"|client|"+valueselect;
        console.log(x);
        var payload = new FormData();
        payload.append('data', x);
        $.ajax({
            url: 'backend/updatecv.php',
            type: 'POST',
            data: payload,
            beforeSend: function() {
               window.location.href='cv_gl_entries.php';
               // location.reload();
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

    var dttable="";
      $(document).ready(function() {
        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",
                "scrollX":"100%",
                "searching": false,
       
               "lengthChange": false,
               "bPaginate": false,
                "info": false,
                "bSort" : false,
    

   
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
    

  
conditionedit();
  function conditionedit() 
    {
       sumjq = function(selector) 
        {
            var sum = 0;
            $(selector).each(function() {
         sum += Number($(this).val())  ;
            });
            return sum;
        }

        var credit = sumjq('input.credit');
        var debit =  sumjq('input.debit');
        console.log(credit+' & '+debit);


        if (((Number(credit) === 0) || (Number(debit) === 0))) {
            $('#updateget').attr("disabled", true);

        } else if (Number(credit) === Number(debit)) {

            $('#updateget').attr("disabled", false);

        } else {
            $('#updateget').attr("disabled", true);
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
<?php



   ?>
