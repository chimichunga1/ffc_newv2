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


	 $mustbe=$x/4;



	for ($i=0; $i <($mustbe) ; $i++) {  //

					$y=$i*4;
					$a0=$string[$y];// jv_no
					$a1=$string[$y+1];//jv_id
					$a2=$string[$y+2];//client
		
	

					$a4=$string1[$i];//bank

						$con->myQuery("INSERT INTO journal_vld(jv_no,clnt_id,bank_id,dbcr_id) VALUES(?,?,?,?)",array($a0,$a2,$a4,$a1));



				}
	
				


	
			 
			 		$queryv=$con->myQuery("SELECT cl.client_number,j.jv_id FROM `journal_dbcr` j INNER JOIN client_list cl ON cl.client_number=j.clnt_id WHERE NOT j.debit_amount='0' AND j.isDeleted='0' and `jv_no`='".$string[0]."' ");
                    while ($rowv=$queryv->fetch(PDO::FETCH_NUM)) 
                    {
                    		$x1=$rowv[0];
                    		$x2=$rowv[1];
                    	

                    		$x0=$string[0];

                    		$con->myQuery("INSERT INTO journal_vld(jv_no,clnt_id,bank_id,dbcr_id) VALUES(?,?,?,?)",array($x0,$x1,$a4,$x2));
                    }
			 




	$date=date('Y-m-d');

	 $con->myQuery("UPDATE journal_voucher SET isValidated=?,vldate=? WHERE jv_no=?",array('1',$date,$string[0]));












?>