<?php 





require_once('../../support/config.php');






  	$data=$_POST['data'];

	

 	

	$string = explode("|", $data);

	$x=count($string);

 $con->myQuery("INSERT INTO  official_receipts(or_no,or_date,clnt_id,details,or_type) VALUES(?,?,?,?,?) ",array($string[1],$string[0],$string[3],$string[4],'CP'));


  $idor=$con->myQuery("SELECT MAX(or_id) FROM official_receipts ")->fetch(PDO::FETCH_NUM);

	if ($x==6)
	{

					$query ='';
					$array = '';
					$value='';
					$query = ' INSERT INTO official_receipts_dbcr(or_r_id,or_no,acc_no,acc_code,credit_amount,or_date';
					$array[] = $idor[0];
					$array[] = $string[1];
							$array[] = $string[2];
				
					$array[] .= '22';
					$array[] .= str_replace(",", "",$string[5]);
			
					$array[] .= $string[0];

					$value=' VALUES(?,?,?,?,?,?';


							
							
					$query.=' )';
						$value .= ' )';

						$query.= ' '.$value;
							$con->myQuery($query,$array);


	}
	else
	{
					$query ='';
					$array = '';
					$value='';
					$query = ' INSERT INTO official_receipts_dbcr(or_r_id,or_no,acc_no,acc_code,or_bank,or_cheque_no,credit_amount,or_date';
					$array[] = $idor[0];
			
					$array[] = $string[1];
					$array[] = $string[2];
					$array[] .= '22';
					$array[] .= $string[6];
					$array[] .= $string[7];
					$array[] .= str_replace(",", "",$string[5]);
			
					$array[] .= $string[8];

					$value=' VALUES(?,?,?,?,?,?,?,?';

								
							
					$query.=' )';
						$value .= ' )';

						$query.= ' '.$value;
							$con->myQuery($query,$array);

	}






					$query ='';
					$array = '';
					$value='';
					$query = ' INSERT INTO official_receipts_dbcr(or_r_id,or_no,acc_code,debit_amount,or_date';
					$array[] = $idor[0];
					$array[] = $string[1];
					$array[] .= '3';
				
			
					$array[] .= str_replace(",", "",$string[5]);
			
					$array[] .= $string[0];

					$value=' VALUES(?,?,?,?,?';

					

							
							
					$query.=' )';
						$value .= ' )';

						$query.= ' '.$value;
							$con->myQuery($query,$array);








?>