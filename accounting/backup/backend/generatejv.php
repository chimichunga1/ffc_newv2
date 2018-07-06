<?php




require_once('../../support/config.php');



//////////////////////////////////////////////////////////////////////////////////////////////////////


 if(!empty($_GET['value'])) 
{

  // $maxcv=mysqli_query($conn,"SELECT CONCAT(cl.fname ,' ', cl.lname ) fullname,c.clnt_id FROM `cheque_voucher` c INNER JOIN client_list cl ON c.clnt_id =cl.client_number where c.cntrct_id = '".$_GET['value']."' " );

$maxcv1=$con->myQuery("SELECT CONCAT(cl.fname ,' ', cl.lname ) fullname,c.clnt_id FROM `cheque_voucher` c INNER JOIN client_list cl ON c.clnt_id =cl.client_number where c.cntrct_id = '".$_GET['value']."' ");
 



   while ($maxfetch = $maxcv1->fetch(PDO::FETCH_NUM)) {
   		echo '
                                     <div class="form-group row">
                       
                                        <label class="col-sm-12 col-md-1 control-label"> Client No.: </label>
                                            <div class="col-sm-12 col-md-5">
                                                <input type="text" class="form-control" readonly id="jvclnt"  value="'.$maxfetch[1].'"  placeholder="Select JV No First"   >
                                            </div>

                            

                                        <label class="col-sm-12 col-md-1 control-label"> Name: </label>
                                            <div class="col-sm-12 col-md-5">
                                                    <input type="text" class="form-control" readonly id="jvclntname" value="'.$maxfetch[0].'"   placeholder="Select JV No First"  >
                                            </div>

                                    </div> ';
   }

				
}

else
{
  echo '
                                     <div class="form-group row">
                       
                                        <label class="col-sm-12 col-md-1 control-label"> Client No.: </label>
                                            <div class="col-sm-12 col-md-5">
                                                <input type="text" class="form-control" readonly id="jvclnt"   placeholder="Select JV No First"   >
                                            </div>

                            

                                        <label class="col-sm-12 col-md-1 control-label"> Name: </label>
                                            <div class="col-sm-12 col-md-5">
                                                    <input type="text" class="form-control" readonly id="jvclntname"   placeholder="Select JV No First"  >
                                            </div>

                                    </div> ';
}






 ?>