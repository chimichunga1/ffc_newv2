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




$acc_code='4';

$con->myQuery("INSERT INTO  cheque_voucher(cv_no,clnt_id,details) VALUES(?,?,?) ",array($string1[0],$string1[1],$string1[3]));

   $con->myQuery("INSERT INTO cheque_dbcr(cv_no,debit_amount,clnt_id) VALUES(?,?,?)",array($string1[0],$string1[2],$string1[1]));

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

				

   $con->myQuery("INSERT INTO cheque_dbcr(cv_no,acc_code,credit_amount,clnt_id) VALUES(?,?,?,?)",array($string1[0],$acc_code,$string3[$i],$string2[$i]));



			}










?>