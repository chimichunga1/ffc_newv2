<?php 





require_once('../../support/config.php');






  	$data=$_POST['data'];

	 $find=strpos($data,'|select|');
 	 $find1=strpos($data,'|inputs|');

 	echo $data1=substr($data, 0,$find);
 	echo "<br>";
	echo $data2=substr($data, $find+8,($find1-$find-8));	
	echo "<br>";
	echo $data3=substr($data, $find1+8);	


	$string1 = explode("|", $data1);
	$string2 = explode("|", $data2);
	$string3 = explode("|", $data3);
	echo "<br>";	
	echo "<br>";





 $con->myQuery("INSERT INTO  official_receipts(or_no,or_date,clnt_id,or_type) VALUES(?,?,?,?) ",array($string1[1],$string1[0],$string1[2],'AWP'));

	 $idor=$con->myQuery("SELECT MAX(or_id) FROM official_receipts ")->fetch(PDO::FETCH_NUM);

			for ($i=0; $i<count($string2)/2; $i++) { 



				

					$y=$i*2;
					
		


					echo $a0=$string2[$y];//acc_code
					echo "<br>";
					echo $a1=$string2[$y+1];//bank
					

					echo "<br>";
				

					$y1=$i*3;

					echo $b0=$string3[$y1];// cheque no
							echo "<br>";
					echo $b1=str_replace(",", "", $string3[$y1+1]);// credit

							echo "<br>";
					echo $b2=$string3[$y1+2];//date

						echo "<br>";

				
			
						if( !empty($a1) && !empty($a0) && ($b1!='0') && !empty($b0)  && !empty($b2) )
						// if( !empty($a1) && !empty($a2)  )
						{
						
						
					$query ='';
					$array = '';
					$value='';
					$query = ' INSERT INTO official_receipts_dbcr(or_r_id,or_no,acc_code,or_bank,or_cheque_no,credit_amount,or_date,acc_no';
					$array[] = $idor[0];
					$array[] = $string1[1];
					$array[] .= $a0;
					$array[] .= $a1;
					$array[] .= $b0;
					$array[] .= $b1;
			
					$array[] .= $b2;
					$array[] .= $string1[4];

					$value=' VALUES(?,?,?,?,?,?,?,?';

										// if($a0!='')
										// {
										// 	$query .=',acc_no';
										// 	$array[] .=$a0;
										// 	$value.=',?';


										// }
										// if($b0!='')
										// {
										// 	$query .=',cd';
										// 	$array[] .=$b0;
										// 	$value.=',?';

										// }
										

							
							
					$query.=' )';
						$value .= ' )';

						$query.= ' '.$value;
							$con->myQuery($query,$array);

				
}

   



			}





					$query ='';
					$array = '';
					$value='';
					$query = ' INSERT INTO official_receipts_dbcr(or_r_id,or_no,acc_code,debit_amount,or_date';
					$array[] = $idor[0];
					$array[] = $string1[1];
					$array[] .= '3';
				
			
					$array[] .= $string1[3];
			
					$array[] .= $string1[0];

					$value=' VALUES(?,?,?,?,?';

										// if($a0!='')
										// {
										// 	$query .=',acc_no';
										// 	$array[] .=$a0;
										// 	$value.=',?';


										// }
										// if($b0!='')
										// {
										// 	$query .=',cd';
										// 	$array[] .=$b0;
										// 	$value.=',?';

										// }
										

							
							
					$query.=' )';
						$value .= ' )';

						$query.= ' '.$value;
							$con->myQuery($query,$array);








?>