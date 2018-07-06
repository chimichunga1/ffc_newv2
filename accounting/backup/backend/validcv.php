<?php 


require_once('../../support/config.php');



 ////////////////////////////////////////////////////////////////////////////

  





  	$data=$_POST['data'];
 	$find=strpos($data,'|bank|');

	$data1=substr($data, 0,$find);

	$data2=substr($data, $find+6);	


	$string = explode("|", $data1);
	$string1 = explode("|", $data2);

 	$x=count($string);


	 $mustbe=$x/5;



		


	for ($i=0; $i <($mustbe) ; $i++) 
				{  //

					$y=$i*5;
					$a0=$string[$y];// cv_no
					$a1=$string[$y+1];//cv_id
					$a2=$string[$y+2];//client
					$a3=$string[$y+3];//credit
					$a4=$string[$y+4];//cheque_no

					$a5=$string1[$i];//bank

						$con->myQuery("INSERT INTO cheque_vld(cv_no,clnt_id,bank_id,cheque_no,dbcr_id) VALUES(?,?,?,?,?)",array($a0,$a2,$a5,$a4,$a1));



				}
	
			 
			 		$queryv=$con->myQuery("SELECT cl.client_number,c.cv_id FROM `cheque_dbcr` c INNER JOIN client_list cl ON cl.client_number=c.clnt_id WHERE NOT c.debit_amount='0' AND c.isDeleted='0' and `cv_no`='".$string[0]."' ");
                    while ($rowv=$queryv->fetch(PDO::FETCH_NUM)) 
                    {
                    		$x1=$rowv[0];
                    		$x2=$rowv[1];
                    	

                    		$x0=$string[0];

                    		$con->myQuery("INSERT INTO cheque_vld(cv_no,clnt_id,dbcr_id) VALUES(?,?,?)",array($x0,$x1,$x2));
                    }



$date=date('Y-m-d');
	

	 $con->myQuery("UPDATE cheque_voucher SET isValidated=?,vldate=? WHERE cv_no=?",array('1',$date,$string[0]));












?>