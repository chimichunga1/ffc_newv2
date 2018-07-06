<?php 





require_once('../../support/config.php');



 ////////////////////////////////////////////////////////////////////////////
  	$data=$_POST['data'];
 	$find=strpos($data,'|client|');

  	echo $data1=substr($data, 0,$find);
 echo '<br>';
	echo $data2=substr($data, $find+8);	


	$string = explode("|", $data1);
	$string1 = explode("|", $data2);

	echo $x=count($string);
	 $mustbe=$x/5;
	for ($i=0; $i <($mustbe) ; $i++) {  //

			$y=$i*5;
			$a0=$string[$y];// cv

			$a1=$string[$y+1];// cntrct
	
			$a2=$string[$y+2];// cd
		
		 	$a3=$string[$y+3];//debit
		 	$a4=$string[$y+4];//credit
			$a5=$string1[$i];//client


			if($i==0)
			{
				// mysqli_query($conn,"UPDATE `cheque_voucher` SET `amount`='".$a3."' WHERE `cv_id`='".$a0."' ");

				$con->myQuery("UPDATE cheque_voucher SET amount=? WHERE cv_id=?",array($a3,$a0));
			}
		
	
			if ($a2=='')
			{
					// mysqli_query($conn,"UPDATE `cheque_dbcr` SET `debit_amount`='".$a3."',`credit_amount`='".$a4."',`clnt_id`='".$a5."' WHERE `cntrct_id`='".$a1."' ");

						$con->myQuery("UPDATE cheque_dbcr SET debit_amount=?,credit_amount=?,clnt_id=? WHERE cntrct_id=?",array($a3,$a4,$a5,$a1));
			}
			else
			{
					// mysqli_query($conn,"UPDATE `cheque_dbcr` SET `cd`='".$a2."',`debit_amount`='".$a3."',`credit_amount`='".$a4."',`clnt_id`='".$a5."' WHERE `cntrct_id`='".$a1."' ");

						$con->myQuery("UPDATE cheque_dbcr SET cd=?,debit_amount=?,credit_amount=?,clnt_id=? WHERE cntrct_id=?",array($a2,$a3,$a4,$a5,$a1));
			}
		
	
			
	}













?>