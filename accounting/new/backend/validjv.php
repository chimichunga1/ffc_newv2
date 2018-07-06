<?php 


require_once('../../support/config.php');



 ////////////////////////////////////////////////////////////////////////////

  





  	$data=$_POST['data'];

 

	$string = explode("|", $data);





	



				
					 $con->myQuery("UPDATE journal_dbcr SET jv_no=? WHERE jv_v_id=?",array($string[0],$string[1]));

			

			 
			



$date=date('Y-m-d');
	

	 $con->myQuery("UPDATE journal_voucher SET isValidated=?,vldate=?,jv_no=? WHERE jv_id=?",array('1',$date,$string[0],$string[1]));












?>