<?php 





require_once('../../support/config.php');



 ////////////////////////////////////////////////////////////////////////////
  	$data=$_POST['data'];
 	$find=strpos($data,'|client|');

$data1=substr($data, 0,$find);

 $data2=substr($data, $find+8);	


	$string = explode("|", $data1);
	$string1 = explode("|", $data2);

	 $x=count($string);
	 $x1=count($string1);


	 $mustbe=$x/5;



	for ($i=0; $i <($mustbe) ; $i++) {  //

					$y=$i*5;
					$a0=$string[$y];// cv_no
					$a1=$string[$y+1];//cv_id
					$a2=$string[$y+2];//cd
					$a3=$string[$y+3];//debit
					$a4=$string[$y+4];//credit

						$y1=$i*3;

					$ac0=$string1[$y1];// accno
					$ac1=$string1[$y1+1];//acccode
					$ac2=$string1[$y1+2];//acc

	
				// echo "<br>".	
$query ='';
$array = '';
$query = 'UPDATE cheque_dbcr SET debit_amount=?,credit_amount=?,clnt_id=?';
$array[] = $a3;
$array[] .= $a4;
$array[] .= $ac2;
					if($a2!='')
					{
						$query .=',cd=?';
						$array[] .=$a2;


					}
					if($ac0!='')
					{
						$query .=',acc_no=?';
						$array[] .=$ac0;

					}
					if($ac1!='')
					{
						$query .=',acc_code=?';
						$array[] .=$ac1;

					}

		
			// if (($a2=='') && ($ac0!='') && ($ac0!=''))
			// {
				
			// 			$con->myQuery("UPDATE cheque_dbcr SET acc_no=?,acc_code=?,debit_amount=?,credit_amount=?,clnt_id=? WHERE cv_id=? ",array($ac0,$ac1,$a3,$a4,$ac2,$a1));
			// }
			// else
			// {
					

			// 			$con->myQuery("UPDATE cheque_dbcr SET acc_no=?,cd=?,acc_code=?,debit_amount=?,credit_amount=?,clnt_id=? WHERE cv_id=? ",array($ac0,$a2,$ac1,$a3,$a4,$ac2,$a1));
			// }

		
$query.='  WHERE cv_id=?';
	$array[] .= $a1;

		$con->myQuery($query,$array);
	
			
	}













?>