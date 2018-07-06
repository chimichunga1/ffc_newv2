<?php 





require_once('../../support/config.php');



 ////////////////////////////////////////////////////////////////////////////
  	$data=$_POST['data'];
 	$find=strpos($data,'|select|');

$data1=substr($data, 0,$find);

 $data2=substr($data, $find+8);	


	$string = explode("|", $data1);
	$string1 = explode("|", $data2);

	 $x=count($string);
	 $x1=count($string1);


	 $mustbe=$x/4;



	for ($i=0; $i <($mustbe) ; $i++) {  //

					$y=$i*4;
					$a0=$string[$y];// jv_id
					$a1=$string[$y+1];//cd
					$a2=str_replace(",", "", $string[$y+2]);//debit_amount 
					$a3=str_replace(",", "", $string[$y+3]);//credit_amount
	

					$y1=$i*3;

					$ac0=$string1[$y1];// accno
					$ac1=$string1[$y1+1];//acccode
					$ac2=$string1[$y1+2];//acc

	
				// echo "<br>".	
$query ='';
$array = '';
$query = 'UPDATE journal_dbcr SET debit_amount=?,credit_amount=?,clnt_id=?';
$array[] = $a2;
$array[] .= $a3;
$array[] .= $ac2;
					if($a1!='')
					{
						$query .=',cd=?';
						$array[] .=$a1;


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
	$array[] .= $a0;

		$con->myQuery($query,$array);
	
			
	}













?>

