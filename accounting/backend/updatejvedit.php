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
$query = 'UPDATE journal_dbcr SET debit_amount=?,credit_amount=?,clnt_id=?';
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

		
$query.='  WHERE jv_id=?';
	$array[] .= $a1;

		$con->myQuery($query,$array);
	
			
	}













?>