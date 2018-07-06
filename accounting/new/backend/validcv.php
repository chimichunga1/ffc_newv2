<?php 


require_once('../../support/config.php');



 ////////////////////////////////////////////////////////////////////////////

  





  	$data=$_POST['data'];

  	$find0=strpos($data,'|cheque|');

 	$find=strpos($data,'|bank|');

 	$data0=substr($data, 0,$find0);

	$data1=substr($data, $find0+8,$find);

	$data2=substr($data, $find+6);	


	$string = explode("|", $data1);
	$string1 = explode("|", $data2);

 	$x=count($string);


	 $mustbe=$x/4;


	echo $data0;
		


	for ($i=0; $i <($mustbe) ; $i++) 
				{  //

					$y=$i*4;
					echo "<br>".$a0=$string[$y];// cv_no
					echo "<br>".$a1=$string[$y+1];//cv_id
					echo "<br>".$a2=$string[$y+2];//client
			
					echo "<br>".$a4=$string[$y+3];//cheque_no

					$a5=$string1[$i];//bank
					 $con->myQuery("UPDATE cheque_dbcr SET cv_no=? WHERE cv_v_id=?",array($data0,$string[0]));

						$con->myQuery("INSERT INTO cheque_vld(cv_no,clnt_id,bank_id,cheque_no,dbcr_id) VALUES(?,?,?,?,?)",array($data0,$a2,$a5,$a4,$a1));



				}
	
			 
			 		$queryv=$con->myQuery("SELECT cl.client_number,c.cv_id FROM `cheque_dbcr` c INNER JOIN client_list cl ON cl.client_number=c.clnt_id WHERE NOT c.debit_amount='0' AND c.isDeleted='0' and `cv_no`='".$data0."' ");
                    while ($rowv=$queryv->fetch(PDO::FETCH_NUM)) 
                    {
                    		$x1=$rowv[0];
                    		$x2=$rowv[1];
                    	

                    		

                    		$con->myQuery("INSERT INTO cheque_vld(cv_no,clnt_id,dbcr_id) VALUES(?,?,?)",array($data0,$x1,$x2));
                    }



$date=date('Y-m-d');
	

	 $con->myQuery("UPDATE cheque_voucher SET isValidated=?,vldate=?,cv_no=? WHERE cv_id=?",array('1',$date,$data0,$string[0]));












?>