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
	echo "<br>";	
	echo "<br>";





 $con->myQuery("INSERT INTO  journal_voucher(jv_no,jv_date,clnt_id,details) VALUES(?,?,?,?) ",array($string1[0],$string1[1],$string1[2],$string1[3]));

	 $idjv=$con->myQuery("SELECT MAX(jv_id) FROM journal_voucher ")->fetch(PDO::FETCH_NUM);

			for ($i=0; $i<count($string2)/3; $i++) { 



				

					$y=$i*3;
					
					echo $a0=$string2[$y];// acc_no
					echo "<br>";
					echo $a1=$string2[$y+1];//acc_code
					echo "<br>";
					echo$a2=$string2[$y+2];//clnt

					echo "<br>";
				

					$y1=$i*3;

					echo $b0=$string3[$y1];// cd
							echo "<br>";
					echo $b1=str_replace(",", "", $string3[$y1+1]);// debit

							echo "<br>";
					echo $b2=str_replace(",", "", $string3[$y1+2]);//credit

						echo "<br>";

				
			
						
					$query ='';
					$array = '';
					$value='';
					$query = ' INSERT INTO journal_dbcr(jv_v_id,jv_no,acc_code,debit_amount,credit_amount,clnt_id';
					$array[] = $idjv[0];
					$array[] = $string1[0];
					$array[] .= $a1;
					$array[] .= $b1;
					$array[] .= $b2;
					$array[] .= $a2;

					$value=' VALUES(?,?,?,?,?,?';

										if($a0!='')
										{
											$query .=',acc_no';
											$array[] .=$a0;
											$value.=',?';


										}
										if($b0!='')
										{
											$query .=',cd';
											$array[] .=$b0;
											$value.=',?';

										}
										

							
							
					$query.=' )';
						$value .= ' )';

						$query.= ' '.$value;
echo $query;
							$con->myQuery($query,$array);



				

   



			}










?>