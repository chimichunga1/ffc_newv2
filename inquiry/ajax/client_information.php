<?php
require_once("../../support/config.php");
//$con->myQuery("SELECT FROM comments c WHERE ");
$empty_message="No data available in table.";


// $a = substr($_GET['id'], 0, 1);
// if ($a == "o")
// {
// 	$_GET['request_type'] = "overtime";
// 	$_GET['id'] = ltrim($_GET['id'],'o');
// }
// if ($a == "p")
// {
// 	$_GET['request_type'] = "pre_overtime";
// 	$_GET['id'] = ltrim($_GET['id'],'p');
// }

if(!empty($_GET['id'])){
		$messages=$con->myQuery("SELECT cl.client_number AS id,CONCAT(cl.lname,', ',cl.fname,' ',cl.mname) AS client_name,
		ic.name AS ind_corp,id.name AS ind_code,bt.name AS bus_type,c.name AS country,r.name AS region,
		cl.birthdate,cl.gender,cs.name AS civil_status,cl.spouse,cl.tin_no,cl.sss_no,cl.acr_no,cl.pagibig_no,cl.rescert_no,
		cl.rescert_date,cl.rescert_place,cl.con_name,cl.con_rescert_no,cl.con_rescert_date,cl.con_rescert_place,
		CONCAT(cl.home_no,' ',cl.home_brgy,', ',cl.home_city,' ',cl.home_zip) AS home_add,
		CONCAT(cl.bus_no,' ',cl.bus_brgy,', ',cl.bus_city,' ',cl.bus_zip) AS bus_add,
		CONCAT(cl.gar_no,' ',cl.gar_brgy,', ',cl.gar_city,' ',cl.gar_zip) AS gar_add,
		cl.email,cl.fax_no,cl.bus_tel,cl.home_tel,cl.pri_con,cl.sec_con,cl.is_borrower,cl.is_dealer,cl.is_salesman
		FROM client_list cl JOIN industry_corp ic ON ic.id=cl.ind_corp_id
		JOIN industry_code id ON id.id=cl.ind_code_id
		JOIN business_type bt ON bt.id=cl.bus_type_id
		JOIN country c ON c.id=cl.country_id
		JOIN region r ON r.id=cl.region_id
		JOIN civil_status cs ON cs.id=cl.civil_status_id
		WHERE cl.client_number=?",array($_GET['id']))->fetchAll(PDO::FETCH_ASSOC);
		//echo $_GET['request_type']."<br>".$_GET['id'];
		// var_dump($messages);
		// die();
		if(empty($messages)){
			echo $empty_message;
		}
		else{
			//echo "<ul class='timeline'>";
			echo "<div?";
            foreach ($messages as $row):
            ?>			
				<div class='row'>
                    <table>
					<tr><td><b>Client Number: </b> <?php echo htmlspecialchars($row['id']) ?></td><td><b> Ind / Corp:</b> <?php echo htmlspecialchars($row['ind_corp']) ?></td></tr>
					<tr><td><b>Client Name:</b> <?php echo htmlspecialchars($row['client_name']) ?></td><td><b>Birthday:</b> <?php echo htmlspecialchars($row['birthdate']) ?></td></tr>
                    <tr><td><b>Gender:</b>  <?php echo htmlspecialchars($row['gender']) ?></td><td><b> Civil Status: </b>  <?php echo htmlspecialchars($row['civil_status']) ?></td></tr>
                    <tr><td><b> Spouse:</b> <?php echo htmlspecialchars($row['spouse']) ?></td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td><b>TIN:</b> <?php echo htmlspecialchars($row['tin_no']) ?></td><td><b>SSS Number:</b> <?php echo htmlspecialchars($row['sss_no']) ?></td></tr>
                    <tr><td><b>ACR Number:</b>  <?php echo htmlspecialchars($row['acr_no']) ?></td><td><b> Pag-IBIG: </b>  <?php echo htmlspecialchars($row['pagibig_no']) ?></td></tr>
                    <tr><td><b>ResCert:</b> <?php echo htmlspecialchars($row['rescert_no']) ?></td><td><b> ResCert Date: </b>  <?php echo htmlspecialchars($row['rescert_date']) ?></td></tr>
                    <tr><td><b>ResCert Place:</b> <?php echo htmlspecialchars($row['rescert_place']) ?></td></tr>
					<tr><td>&nbsp;</td></tr>
					<tr><td><b>Business Type:</b> <?php echo htmlspecialchars($row['bus_type']) ?></td><td><b>Country:</b> <?php echo htmlspecialchars($row['country']) ?></td></tr>
                    <tr><td><b>Industry Code:</b>  <?php echo htmlspecialchars($row['ind_code']) ?></td><td><b> Region: </b>  <?php echo htmlspecialchars($row['region']) ?></td></tr>
                    <tr><td><b>Client Type:</b> 
					<?php 			$ct=array();
							if($row['is_borrower']=='checked'){
								array_push($ct,"Borrower");
							}
							if($row['is_dealer']=='checked'){
								array_push($ct,"Dealer");
							}
							if($row['is_salesman']=='checked'){
								array_push($ct,"Salesman");
							}
							$ct=implode($ct," / "); echo htmlspecialchars($ct) ?>
					</td></tr>
					<tr><td>&nbsp;</td></tr>
                    </table>
					<b>Home Address: </b> <?php echo htmlspecialchars($row['home_add']) ?><br>
                    <b>Business Address: </b> <?php echo htmlspecialchars($row['bus_add']) ?><br>
					<b>Garage Address: </b> <?php echo htmlspecialchars($row['gar_add']) ?><br>
                    <table>
					<tr><td><b>Email:</b> <?php echo htmlspecialchars($row['email']) ?></td><td><b>FAX Number:</b> <?php echo htmlspecialchars($row['fax_no']) ?></td></tr>
					<tr><td><b>Business Telephone Number:</b> <?php echo htmlspecialchars($row['bus_tel']) ?></td><td><b>Home Telephone Number:</b> <?php echo htmlspecialchars($row['home_tel']) ?></td></tr>
                    <tr><td><b>Primary Contact Number:</b>  <?php echo htmlspecialchars($row['pri_con']) ?></td><td><b> Secondary Contact Number: </b>  <?php echo htmlspecialchars($row['sec_con']) ?></td></tr>
                    </table>
					<hr>
					<b><u>Contact Person</u></b>
					<table>
					<tr><td><b>Name: </b> <?php echo htmlspecialchars($row['con_name']) ?></td><td><b> ResCert:</b> <?php echo htmlspecialchars($row['con_rescert_no']) ?></td></tr>
					<tr><td><b>ResCert Date:</b> <?php echo htmlspecialchars($row['con_rescert_date']) ?></td><td><b>ResCert Place:</b> <?php echo htmlspecialchars($row['con_rescert_place']) ?></td></tr>
					</table>
				</div>
			<!-- <li>
			<div class='timeline-item'>
				<span class='time'>
					<i class='fa fa-clock-o'></i>
					<?php //echo htmlspecialchars($row['date_sent'])?>
				</span>
				<div class='timeline-header'>
					<a><?php //echo htmlspecialchars($row['sender'])?></a>
				</div>
				<div class='timeline-body'>
					<?php //echo htmlspecialchars($row['message'])?>
				</div>
			</div>
			</li> -->
			<?php

			endforeach;
			echo "</div>";
			//echo "</ul>";
		}
}
else{
	echo $empty_message;
}
?>