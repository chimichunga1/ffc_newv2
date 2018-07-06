<?php 




require_once('../../support/config.php');

  	$data=$_POST['data'];


	$string = explode("|", $data);


// 0 date 1 cntrct_id 2 clntid 4 details
	


	// mysqli_query($conn,"UPDATE cheque_voucher SET `isJournal`='1' WHERE `cntrct_id`='".$string[1]."' ");

 $con->myQuery("UPDATE cheque_voucher SET isJournal=? WHERE cntrct_id=?",array('1',$string[1]));



	// $max=mysqli_fetch_array(mysqli_query($conn,"SELECT `cv_id` from `cheque_voucher` where  `cntrct_id` ='".$string[1]."' "));

$max1=$con->myQuery("SELECT cv_id from cheque_voucher where  `cntrct_id`='".$string[1]."' ");
 $max = $max1->fetch(PDO::FETCH_NUM);

$date=date('Y-m-d');
	// mysqli_query($conn,"INSERT INTO journal_voucher (`jv_id`,`clnt_id`,`details`,`jv_date`) VALUES ('".$max[0]."','".$string[2]."','".$string[4]."','".$date."') ");

	 $con->myQuery("INSERT INTO journal_voucher(jv_id,clnt_id,details,jv_date) VALUES(?,?,?,?)",array($max[0],$string[2],$string[4],$date));








?>