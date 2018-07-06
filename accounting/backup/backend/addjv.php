<?php 




require_once('../../support/config.php');

  	$data=$_POST['data'];


	$string = explode("|", $data);










$date=date('Y-m-d');


	 $con->myQuery("INSERT INTO journal_voucher(jv_no,clnt_id,details,jv_date) VALUES(?,?,?,?)",array($string[1],$string[2],$string[3],$date));








?>