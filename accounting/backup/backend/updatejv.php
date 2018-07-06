<?php 

require_once('../../support/config.php');



 ////////////////////////////////////////////////////////////////////////////
  	$data=$_POST['data'];
 	$find=strpos($data,'|client|');
 	$find1=strpos($data,'|fields|');

$data1=substr($data, 0,$find);

 $data2=substr($data, $find+8,$find1);	
  $data3=substr($data, $find1+8);	


	$string = explode("|", $data1);
	$string1 = explode("|", $data2);
	$string2 = explode("|", $data3);

 
	 $x=($string2[0]*3)+(6);
	


	 $mustbe=$x/3;



	for ($i=0; $i <($mustbe) ; $i++) {  //

					$y=$i*3;


				echo '<br>'.	$a0=$string[$y];// cd
				echo '<br>'.	$a1=$string[$y+1];//debit
				echo '<br>'.	$a2=$string[$y+2];//credit

						$y1=$i*3;

				echo '<br>'.	$ac0=$string1[$y1];// accno
				echo '<br>'.	$ac1=$string1[$y1+1];// acccode
				echo '<br>'.	$ac2=$string1[$y1+2];// acc
				

				echo '<br>'.$jv=$string2[1];



if(($a0=='') &&($a1=='') &&($a2=='') && ($ac0=='') &&($ac1=='') &&($ac2=='') )
{


}

else
{
$query ='';
$array = '';
$value = '';
		$query = 'INSERT INTO journal_dbcr (jv_no, debit_amount,credit_amount,clnt_id';
		$value = ' VALUES(?,?,?,?';

		$array[] = $jv;
		$array[] .= $a1;
		$array[] .= $a2;
		$array[] .= $ac2;


					if($a0!='')
					{
						$query .=',cd';
						$value .=',?';
						$array[] .=$a0;


					}
					if($ac0!='')
					{
						$query .=',acc_no';
						$value .=',?';
						$array[] .=$ac0;

					}
					if($ac1!='')
					{
						$query .=',acc_code';
						$value .=',?';
						$array[] .=$ac1;

					}



$query.=' ) ';
	$value .=' ) ';


		$con->myQuery($query.$value,$array);

}




	
			
	}













?>