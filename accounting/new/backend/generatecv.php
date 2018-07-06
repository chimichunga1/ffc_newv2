<?php 


require_once('../../support/config.php');


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




  $maxcv=$_POST['dataa'];
  // mysqli_query($conn,'INSERT INTO cheque_voucher (cv_id) VALUES ("'.$maxcv.'")') ; 
   $con->myQuery("INSERT INTO  cheque_voucher (cv_id)  VALUES(?)",array($maxcv)); 






?>