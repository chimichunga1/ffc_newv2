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
		$messages=$con->myQuery("SELECT ll.id,ll.app_type,ll.app_no,ll.client_no,ll.last_name,
        ll.first_name,ll.spouse,ll.bus_add,ll.home_add,ll.email_add,ll.bus_tel,
        ll.home_tel,ll.pri_con,ll.sec_con,ll.date_applied,ll.date_modified,ll.loan_type_id,ll.int_rate,ll.amt_fin,
        (SELECT CONCAT(u.last_name,', ',u.first_name,' ',u.middle_initial) FROM users u WHERE u.user_id=ll.applied_by)  AS applied_by 
         FROM loan_list ll
		 WHERE ll.id=?",array($_GET['id']))->fetchAll(PDO::FETCH_ASSOC);
		//echo $_GET['request_type']."<br>".$_GET['id'];
		// var_dump($messages);
		// die();

		if(empty($messages)){
			echo $empty_message;
		}
		else{
			//echo "<ul class='timeline'>";
			echo "<div class='box-body'>";
			foreach ($messages as $row1):
				$row=$con->myQuery("SELECT cl.client_number AS id,CONCAT(cl.lname,', ',cl.fname,' ',cl.mname) AS client_name,
				cl.birthdate,cl.gender,cl.spouse,cl.tin_no,cl.sss_no,cl.acr_no,cl.pagibig_no,cl.rescert_no,
				cl.rescert_date,cl.rescert_place,cl.con_name,cl.con_rescert_no,cl.con_rescert_date,cl.con_rescert_place,
				CONCAT(cl.home_no,' ',cl.home_brgy,', ',cl.home_city,' ',cl.home_zip) AS home_add,
				CONCAT(cl.bus_no,' ',cl.bus_brgy,', ',cl.bus_city,' ',cl.bus_zip) AS bus_add,
				CONCAT(cl.gar_no,' ',cl.gar_brgy,', ',cl.gar_city,' ',cl.gar_zip) AS gar_add,
				cl.email,cl.fax_no,cl.bus_tel,cl.home_tel,cl.pri_con,cl.sec_con
				FROM client_list cl
				WHERE cl.client_number=?",array($row1['client_no']))->fetch(PDO::FETCH_ASSOC);
				$trans=$con->myQuery("SELECT name FROM loan_approval_type WHERE id=?",array($row1['loan_type_id']))->fetch(PDO::FETCH_ASSOC);
            ?>			
                    <table>
					<tr><td></td><td><b>Application Number:</b> <?php echo htmlspecialchars($row1['app_no']) ?></td></tr>
					<tr><td><b>Client Number: </b> <?php echo htmlspecialchars($row['id']) ?></td></tr>
					<tr><td><b>Name:</b> <?php echo htmlspecialchars($row['client_name']) ?></td></tr>
                    <tr><td><b>Spouse:</b> <?php echo htmlspecialchars($row['spouse']) ?></td></tr>
                    <tr><td>&nbsp;</td></tr>
					<tr><td><b>Address:</td><td><b>Tel. No:</td></tr>
					<tr><td style='padding-left:5%'> <?php echo htmlspecialchars($row['home_add']) ?></td><td style='padding-left:5%'> <?php echo htmlspecialchars($row['home_tel']) ?></td></tr>
					<tr><td>&nbsp;</td></tr>
					<tr><td><b>Transaction:</b> <?php echo htmlspecialchars($trans['name']) ?></td><td><b>Interest Rate:</b> <?php echo htmlspecialchars($row1['int_rate']) ?></td></tr>
					<tr><td><b>Amount:</b> <?php echo htmlspecialchars($row1['amt_fin']) ?></td></tr>
                    <tr><td><b>Security:</b>  </td></tr>
					<tr><td><b>Remarks:</b>  </td></tr>
					<tr><td>&nbsp;</td></tr>
					<tr><td><b>Date Forwareded to Credit:</b> <?php echo date('m/d/Y'); ?> </td><td><b> Received</b> _____________________________</tr>
                    </table>
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