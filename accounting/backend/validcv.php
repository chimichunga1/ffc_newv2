<?php 


require_once('../../support/config.php');



require_once('../../support/config.php');

$acr1=$con->myQuery("SELECT acr_no from client_list where  `client_number`='".$string1[1]."' ");
 $acr = $acr1->fetch(PDO::FETCH_NUM);

 $con->myQuery("UPDATE cheque_voucher SET clnt_id=? , amount=?, details=? WHERE cv_id=?",array($string1[1],$string1[2],$string1[3],$string1[0]));
 $con->myQuery("INSERT INTO cheque_dbcr(cv_id,acc_code,debit_amount,clnt_id) VALUES(?,?,?,?)",array($string1[0],$acr[0],$string1[2],$string1[1]));

 ////////////////////////////////////////////////////////////////////////////



  	$data=$_POST['data'];


	$string = explode("|", $data);



	// $clnt=mysqli_fetch_array(mysqli_query($conn,"SELECT clnt_id from `cheque_voucher` where  `cv_id`='".$string[0]."' "));
	

		$clnt1=$con->myQuery("SELECT clnt_id from `cheque_voucher` where  `cv_id`='".$string[0]."' ");
 $clnt = $clnt1->fetch(PDO::FETCH_NUM);
		
			// mysqli_query($conn,"INSERT INTO `cheque_vld` (`cv_id`,`clnt_id`,`bank_id`,`amount`) VALUES ('".$string[0]."','".$clnt[0]."','".$string[1]."','".$string[2]."')  ");
	
			 $con->myQuery("INSERT INTO cheque_vld(cv_id,clnt_id,bank_id,amount) VALUES(?,?,?,?)",array($string[0],$clnt[0],$string[1],$string[2]));

	
	echo $string[0];
	// mysqli_query($conn,"UPDATE `cheque_voucher` SET isValidated='1' where `cv_id`='".$string[0]."' ");

	 $con->myQuery("UPDATE cheque_voucher SET isValidated=? WHERE cv_id=?",array('1',$string[0]));












?>