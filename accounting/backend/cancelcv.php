<?php 


require_once('../../support/config.php');





  $maxcv=$_POST['dataa'];
  // mysqli_query($conn,'DELETE FROM cheque_voucher WHERE cv_id="'.$maxcv.'"') ;  
  $con->myQuery("DELETE FROM cheque_voucher WHERE cv_id=?",array($maxcv));







?>