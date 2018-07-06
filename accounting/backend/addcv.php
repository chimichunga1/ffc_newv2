<?php 





require_once('../../support/config.php');






  	$data=$_POST['data'];

	 $find=strpos($data,'|client|');
 	 $find1=strpos($data,'|amount|');

 	echo $data1=substr($data, 0,$find);
 	echo "<br>";
	echo $data2=substr($data, $find+8,($find1-$find-8));	
	echo "<br>";
	echo $data3=substr($data, $find1+8);	


	$string1 = explode("|", $data1);
	$string2 = explode("|", $data2);
	$string3 = explode("|", $data3);


$acr1=$con->myQuery("SELECT acr_no from client_list where  `client_number`='".$string1[1]."' ");

	// $acr=mysqli_fetch_array(mysqli_query($conn,"SELECT acr_no from client_list where  `client_number`='".$string1[1]."' "));

    $acr = $acr1->fetch(PDO::FETCH_NUM);


 $con->myQuery("UPDATE cheque_voucher SET clnt_id=? , amount=?, details=? WHERE cv_id=?",array($string1[1],$string1[2],$string1[3],$string1[0]));

	// mysqli_query($conn,"UPDATE cheque_voucher SET `clnt_id`='".$string1[1]."',`amount`='".$string1[2]."',`details`='".$string1[3]."' WHERE `cv_id`='".$string1[0]."' ");



   $con->myQuery("INSERT INTO cheque_dbcr(cv_id,acc_code,debit_amount,clnt_id) VALUES(?,?,?,?)",array($string1[0],$acr[0],$string1[2],$string1[1]));


			// mysqli_query($conn,"INSERT INTO cheque_dbcr (`cv_id`,`acc_code`,`debit_amount`,`clnt_id`) VALUES ('".$string1[0]."','".$acr[0]."','".$string1[2]."','".$string1[1]."') ");
			// echo $string2[0].$string2[1];


			for ($i=0; $i<count($string2); $i++) { 
				echo '<br>'.$string2[$i];
				if(empty($string3[$i]))
				{
					$string3[$i]=0;
				}
				if(empty($string2[$i]))
				{
					$string2[$i]='';
				}

				
					// $clid1=mysqli_fetch_array( mysqli_query($conn,'SELECT acr_no FROM client_list WHERE client_number="'.$string2[$i].'" '));
	
			// mysqli_query($conn,"INSERT INTO cheque_dbcr (`cv_id`,`acc_code`,`credit_amount`,`clnt_id`) VALUES ('".$string1[0]."','".$acr[0]."','".$string3[$i]."', '".$string2[$i]."') ");



   $con->myQuery("INSERT INTO cheque_dbcr(cv_id,acc_code,credit_amount,clnt_id) VALUES(?,?,?,?)",array($string1[0],$acr[0],$string3[$i],$string2[$i]));



			}










?>