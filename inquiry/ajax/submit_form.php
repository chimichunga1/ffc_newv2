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
        ll.home_tel,ll.pri_con,ll.sec_con,ll.date_applied,ll.date_modified,
        CONCAT(lat.code,' - ',lat.name) AS loan_code,
        CONCAT(cf.code,' - ',cf.name) AS cf_code,
        CONCAT(pl.code,' - ',pl.name) AS pl_code,
        CONCAT(mt.code,' - ',mt.name) AS mt_code,
        CONCAT(cc.code,' - ',cc.desc) AS cc_code,
        (SELECT CONCAT(u.last_name,', ',u.first_name,' ',u.middle_initial) FROM users u WHERE u.user_id=ll.applied_by)  AS applied_by 
         FROM loan_list ll INNER JOIN loan_approval_type lat ON lat.id=ll.loan_type_id
         INNER JOIN credit_facility cf ON cf.id=ll.credit_fac_id
         INNER JOIN product_line pl ON pl.id=ll.prod_line_id
         INNER JOIN marketing_type mt ON mt.id=ll.mark_type_id
         INNER JOIN collateral_code cc ON cc.id=ll.coll_code_id
         WHERE ll.id=?",array($_GET['id']))->fetchAll(PDO::FETCH_ASSOC);
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
					<tr><td><b>Application Type: </b> <?php if($row['app_type']=='new'){echo "New Loan";}else{echo "Renew Loan";} ?></td><td><b> Applied By:</b> <?php echo htmlspecialchars($row['applied_by']) ?></td></tr>
					<tr><td><b>Application Number:</b> <?php echo htmlspecialchars($row['app_no']) ?></td><td><b>Client Number:</b> <?php echo htmlspecialchars($row['client_no']) ?></td></tr>
                    <tr><td><b>Last Name:</b>  <?php echo htmlspecialchars($row['last_name']) ?></td><td><b> First Name: </b>  <?php echo htmlspecialchars($row['first_name']) ?></td></tr>
                    <tr><td><b> Spouse:</b> <?php echo htmlspecialchars($row['spouse']) ?></td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td><b>Loan Type:</b> <?php echo htmlspecialchars($row['loan_code']) ?></td><td><b>Credit Facility:</b> <?php echo htmlspecialchars($row['cf_code']) ?></td></tr>
                    <tr><td><b>Product Line:</b>  <?php echo htmlspecialchars($row['pl_code']) ?></td><td><b> Marketing Type: </b>  <?php echo htmlspecialchars($row['mt_code']) ?></td></tr>
                    <tr><td><b>Collateral Code:</b> <?php echo htmlspecialchars($row['cc_code']) ?></td></tr>
                    <tr><td>&nbsp;</td></tr>
                    </table>
                    <b>Business Address: </b> <?php echo htmlspecialchars($row['bus_add']) ?><br>
                    <b>Home Address: </b> <?php echo htmlspecialchars($row['home_add']) ?><br>
                    <b>Email Address: </b> <?php echo htmlspecialchars($row['email_add']) ?><br>
                    <table>
					<tr><td><b>Business Telephone Number:</b> <?php echo htmlspecialchars($row['bus_tel']) ?></td><td><b>Home Telephone Number:</b> <?php echo htmlspecialchars($row['home_tel']) ?></td></tr>
                    <tr><td><b>Primary Contact Number:</b>  <?php echo htmlspecialchars($row['pri_con']) ?></td><td><b> Secondary Contact Number: </b>  <?php echo htmlspecialchars($row['sec_con']) ?></td></tr>
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