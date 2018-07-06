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
			foreach ($messages as $row1):
				$row=$con->myQuery("SELECT cl.client_number AS id,CONCAT(cl.lname,', ',cl.fname,' ',cl.mname) AS client_name,
				ic.name AS ind_corp,id.name AS ind_code,bt.name AS bus_type,ct.name AS client_type,c.name AS country,r.name AS region,
				cl.birthdate,cl.gender,cs.name AS civil_status,cl.spouse,cl.tin_no,cl.sss_no,cl.acr_no,cl.pagibig_no,cl.rescert_no,
				cl.rescert_date,cl.rescert_place,cl.con_name,cl.con_rescert_no,cl.con_rescert_date,cl.con_rescert_place,
				CONCAT(cl.home_no,' ',cl.home_brgy,', ',cl.home_city,' ',cl.home_zip) AS home_add,
				CONCAT(cl.bus_no,' ',cl.bus_brgy,', ',cl.bus_city,' ',cl.bus_zip) AS bus_add,
				cl.email,cl.fax_no,cl.bus_tel,cl.home_tel,cl.pri_con,cl.sec_con
				FROM client_list cl 
                JOIN industry_corp ic ON ic.id=cl.ind_corp_id
				JOIN industry_code id ON id.id=cl.ind_code_id
				JOIN business_type bt ON bt.id=cl.bus_type_id
				JOIN client_type ct ON ct.id=cl.client_type_id
				JOIN country c ON c.id=cl.country_id
				JOIN region r ON r.id=cl.region_id
				JOIN civil_status cs ON cs.id=cl.civil_status_id
				WHERE cl.client_number=?",array($row1['client_no']))->fetch(PDO::FETCH_ASSOC);
            ?>			
				<div class='row'>
                    <!-- <b class="text-nowrap h3">FILIPINO FINANCIAL CORPORATION</b>&nbsp;
                    <p class="text-nowrap h6">Unit 1803, 88 Corporate Center Bldg., Sedeno cor. Valero Street, Salcedo Village, Makati City</p>
					<p class="text-nowrap h6">Tel. no: 856-6354   Fax no: 812-7454</p> -->
                    <table>
					<tr>
						<td>Report Date: <?php echo date('F d, Y'); ?></td>
					</tr>
					<tr>
						<td>Application Date: <?php echo date_format(date_create($row1['date_applied']),'F d, Y'); ?></td>
					</tr>
					<tr>
						<td>Borrower: <?php echo $row['client_name'];?></td>
					</tr>
					<tr>
						<td>Address: <?php echo $row['home_add']; ?></td>
					</tr>
					<tr>
						<td>Principal: <?php echo $row1['applied_by']; ?></td>
					</tr>
                    <!-- <tr><td><h3> FILIPINO FINANCIAL CORPORATION </h3></td><td><b></b></td></tr>
					<tr><td><h6>Unit 1803, 88 Corporate Center Bldg., Sedeno cor. Valero Street, Salcedo Village, Makati City</h6></td><td></td></tr>
                    <tr><td><b class="h6">Telephone no: 856-6354</b></td><td><b class="h6"> Fax no: 812-7454</b></td></tr>
                    <tr><td><b> <u>CREDIT ADVICE</u> </b></td></tr>
                    <tr><td>&nbsp;</td></tr> -->
					<!-- <tr><td><b>Application Type daw: </b> <?php if($row1['app_type']=='new'){echo "New Loan";}else{echo "Renew Loan";} ?></td><td><b> Applied By:</b> <?php echo htmlspecialchars($row1['applied_by']) ?></td></tr>
					<tr><td><b>Application Number:</b> <?php echo htmlspecialchars($row1['app_no']) ?></td></tr>
					<tr><td>&nbsp;</td></tr>
					<tr><td><b>Client Number: </b> <?php echo htmlspecialchars($row['id']) ?></td><td><b> Ind / Corp:</b> <?php echo htmlspecialchars($row['ind_corp']) ?></td></tr>
					<tr><td><b>Client Name:</b> <?php echo htmlspecialchars($row['client_name']) ?></td><td><b>Birthday:</b> <?php echo htmlspecialchars($row['birthdate']) ?></td></tr>
                    <tr><td><b>Gender:</b>  <?php echo htmlspecialchars($row['gender']) ?></td><td><b> Civil Status: </b>  <?php echo htmlspecialchars($row['civil_status']) ?></td></tr>
                    <tr><td><b> Spouse:</b> <?php echo htmlspecialchars($row['spouse']) ?></td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td><b>Loan Type:</b> <?php echo htmlspecialchars($row1['loan_code']) ?></td><td><b>Credit Facility:</b> <?php echo htmlspecialchars($row1['cf_code']) ?></td></tr>
                    <tr><td><b>Product Line:</b>  <?php echo htmlspecialchars($row1['pl_code']) ?></td><td><b> Marketing Type: </b>  <?php echo htmlspecialchars($row1['mt_code']) ?></td></tr>
                    <tr><td><b>Collateral Code:</b> <?php echo htmlspecialchars($row1['cc_code']) ?></td></tr>
                    <tr><td>&nbsp;</td></tr>
					<tr><td><b>TIN:</b> <?php echo htmlspecialchars($row['tin_no']) ?></td><td><b>SSS Number:</b> <?php echo htmlspecialchars($row['sss_no']) ?></td></tr>
                    <tr><td><b>ACR Number:</b>  <?php echo htmlspecialchars($row['acr_no']) ?></td><td><b> Pag-IBIG: </b>  <?php echo htmlspecialchars($row['pagibig_no']) ?></td></tr>
                    <tr><td><b>ResCert:</b> <?php echo htmlspecialchars($row['rescert_no']) ?></td><td><b> ResCert Date: </b>  <?php echo htmlspecialchars($row['rescert_date']) ?></td></tr>
                    <tr><td><b>ResCert Place:</b> <?php echo htmlspecialchars($row['rescert_place']) ?></td></tr>
					<tr><td>&nbsp;</td></tr>
					<tr><td><b>Business Type:</b> <?php echo htmlspecialchars($row['bus_type']) ?></td><td><b>Country:</b> <?php echo htmlspecialchars($row['country']) ?></td></tr>
                    <tr><td><b>Industry Code:</b>  <?php echo htmlspecialchars($row['ind_code']) ?></td><td><b> Region: </b>  <?php echo htmlspecialchars($row['region']) ?></td></tr>
                    <tr><td><b>Client Type:</b> <?php echo htmlspecialchars($row['client_type']) ?></td></tr>
					<tr><td>&nbsp;</td></tr> -->
                    </table>
                    <!-- <b>Business Address: </b> <?php echo htmlspecialchars($row['bus_add']) ?><br>
                    <b>Home Address: </b> <?php echo htmlspecialchars($row['home_add']) ?><br>
                    <table>
					<tr><td><b>Email:</b> <?php echo htmlspecialchars($row['email']) ?></td><td><b>FAX Number:</b> <?php echo htmlspecialchars($row['fax_no']) ?></td></tr>
					<tr><td><b>Business Telephone Number:</b> <?php echo htmlspecialchars($row['bus_tel']) ?></td><td><b>Home Telephone Number:</b> <?php echo htmlspecialchars($row['home_tel']) ?></td></tr>
                    <tr><td><b>Primary Contact Number:</b>  <?php echo htmlspecialchars($row['pri_con']) ?></td><td><b> Secondary Contact Number: </b>  <?php echo htmlspecialchars($row['sec_con']) ?></td></tr> -->
                    </table>
					<hr>
					<!-- <b><u>C
                     -->
					<table>
					<!-- <tr><td><b>Name: </b> <?php echo htmlspecialchars($row['con_name']) ?></td><td><b> ResCert:</b> <?php echo htmlspecialchars($row['con_rescert_no']) ?></td></tr>
					<tr><td><b>ResCert Date:</b> <?php echo htmlspecialchars($row['con_rescert_date']) ?></td><td><b>ResCert Place:</b> <?php echo htmlspecialchars($row['con_rescert_place']) ?></td></tr> -->
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