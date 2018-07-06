<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
    toLogin();
    die();
}
$inputs=$_POST;
	if(!empty($_GET['id']))
	{
    $data=$con->myQuery("SELECT * FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
		$client=$con->myQuery("SELECT * FROM client_list WHERE client_number=?",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);
    $cname=$client['lname'].", ".$client['fname']." ".$client['mname'];
    $trade=$con->myQuery("SELECT * FROM credit_check WHERE is_deleted='0' AND loan_id=? AND client_no=?",array($data['id'],$client['client_number']))->fetchAll(PDO::FETCH_ASSOC);
    $ind=$con->myQuery("SELECT name FROM industry_corp WHERE id=?",array($client['ind_corp_id']))->fetch(PDO::FETCH_ASSOC);
    $cv=$con->myQuery("SELECT name FROM civil_status WHERE id=?",array($client['civil_status_id']))->fetch(PDO::FETCH_ASSOC);
    $bt=$con->myQuery("SELECT name FROM business_type WHERE id=?",array($client['bus_type_id']))->fetch(PDO::FETCH_ASSOC);
    $country=$con->myQuery("SELECT name FROM country WHERE id=?",array($client['country_id']))->fetch(PDO::FETCH_ASSOC);
    $ind_code=$con->myQuery("SELECT name FROM industry_code WHERE id=?",array($client['ind_code_id']))->fetch(PDO::FETCH_ASSOC);
    $reg=$con->myQuery("SELECT name FROM region WHERE id=?",array($client['region_id']))->fetch(PDO::FETCH_ASSOC);
    $lt=$con->myQuery("SELECT CONCAT(lt.code,' - ',lt.name) as code FROM loan_approval_type lt WHERE id=?",array($data['loan_type_id']))->fetch(PDO::FETCH_ASSOC);
    $cf=$con->myQuery("SELECT CONCAT(cf.code,' - ',cf.name) as code FROM credit_facility cf WHERE id=?",array($data['credit_fac_id']))->fetch(PDO::FETCH_ASSOC);
    $pl=$con->myQuery("SELECT CONCAT(pl.code,' - ',pl.name) as code FROM product_line pl WHERE id=?",array($data['prod_line_id']))->fetch(PDO::FETCH_ASSOC);
    $mt=$con->myQuery("SELECT CONCAT(mt.code,' - ',mt.name) as code FROM marketing_type mt WHERE id=?",array($data['mark_type_id']))->fetch(PDO::FETCH_ASSOC);
	$cc=$con->myQuery("SELECT CONCAT(cc.code,' - ',cc.desc) as code FROM collateral_code cc WHERE id=?",array($data['coll_code_id']))->fetch(PDO::FETCH_ASSOC);
    $home_add=$client['home_no']." ".$client['home_brgy'].", ".$client['home_city']." ".$client['home_zip'];
    $bus_add=$client['bus_no']." ".$client['bus_brgy'].", ".$client['bus_city']." ".$client['bus_zip'];
    $gar_add=$client['gar_no']." ".$client['gar_brgy'].", ".$client['gar_city']." ".$client['gar_zip'];
    $deal=$con->myQuery("SELECT CONCAT(lname,', ',fname,' ',ename,' ',mname) as name FROM client_list WHERE client_number=?",array($data['dealer_id']))->fetch(PDO::FETCH_ASSOC);
    $sale=$con->myQuery("SELECT CONCAT(lname,', ',fname,' ',ename,' ',mname) as name FROM client_list WHERE client_number=?",array($data['salesman_id']))->fetch(PDO::FETCH_ASSOC);
    $ct=array();
        if($client['is_borrower']=='checked'){
            array_push($ct,"Borrower");
        }
        if($client['is_dealer']=='checked'){
            array_push($ct,"Dealer");
        }
        if($client['is_salesman']=='checked'){
            array_push($ct,"Salesman");
        }
        $ct=implode($ct," / ");
    }else{
		redirect("../index.php");
	}

	makeHead("CI Checking",1);
?>
<div class='page' style='background-color:white;'>
<div class='col-md-12 no-print' align='right'>
	<br>
	<a href="ci_checking_form.php?id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>" class='btn btn-default'><span class='glyphicon glyphicon-arrow-left'></span> Back</a>
	<button onclick='window.print()' class='btn btn-default no-print'>Print &nbsp;<span class='fa fa-print'></span></button>  
</div>
	<div class="row">
      <div align='center'>
      <h3><b>CI CHECKING</b>
      </div>
		<br>
		<div class="col-md-12" style="padding-left: 50px" >
		<p align="left"  >Date Printed: <?php echo date("m/d/Y") ?></p>
		</div>
	</div>
	<hr>
  <div class='box-body'>
  <table >
            <tr><td width='20%'><b>Application Number</b></td><td>: <?php echo $data['app_no'];?></td><td width='22%'><b>Application Type</b></td><td width='25%'>: <?php echo ucwords($data['app_type']);?></td></tr>
            <tr><td><b>Client Number</b></td><td>: <?php echo $client['client_number'];?></td><td ><b>Ind/Corp</b></td><td>: <?php echo $ind['name'];?></td></tr>
            <tr><td><b>Name</b></td><td>: <?php echo $cname;?></td><td ><b>Birthdate</b></td><td>: <?php echo $client['birthdate'];?></td></tr>
            <tr><td><b>Civil Status</b></td><td>: <?php echo $cv['name'];?></td><td ><b>Gender</b></td><td>: <?php echo $client['gender'];?></td></tr>
            <tr><td ><b>Spouse</b></td><td>: <?php echo $client['spouse'];?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Dealer</b></td><td>: <?php echo $deal['name'];?></td><td><b>Salesman</b></td><td>: <?php echo $sale['name'];?></td></tr>
            <tr><td><b>Loan Type</b></td><td>: <?php echo $lt['code'];?></td><td ><b>Credit Facility</b></td><td>: <?php echo $cf['code'];?></td></tr>
            <tr><td><b>Product Line</b></td><td>: <?php echo $pl['code'];?></td><td ><b>Marketing Type</b></td><td>: <?php echo $mt['code'];?></td></tr>
            <tr><td ><b>Collateral Code</b></td><td>: <?php echo $cc['code'];?></td><td><b>Unit Description</b></td><td>: <?php echo $data['unit_desc'];?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Amount Financed</b></td><td>: <?php echo $data['amt_fin'];?></td><td><b>Residual Value</b></td><td>: <?php echo $data['res_val'];?></td></tr>
            <tr><td><b>Down Payment</b></td><td>: <?php echo $data['down_pay'];?></td><td><b>List Price</b></td><td>: <?php echo $data['list_pri'];?></td></tr>
            <tr><td><b>Term</b></td><td>: <?php echo $data['term'];?></td><td ><b>Interest Rate</b></td><td>: <?php echo $data['int_rate'];?></td></tr>
            <tr><td><b>Monthly Amortization</b></td><td>: <?php echo $data['mon_amor'];?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>TIN</b></td><td>: <?php echo $client['tin_no'];?></td><td><b>SSS Number</b></td><td>: <?php echo $client['sss_no'];?></td></tr>
            <tr><td><b>ACR Number</b></td><td>: <?php echo $client['acr_no'];?></td><td ><b>Pagibig</b></td><td>: <?php echo $client['pagibig_no'];?></td></tr>
            <tr><td><b>ResCert</b></td><td>: <?php echo $client['rescert_no'];?></td><td><b>ResCert Date</b></td><td>: <?php echo $client['rescert_date'];?></td></tr>
            <tr><td><b>ResCert Place</b></td><td>: <?php echo $client['rescert_place'];?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Business Type</b></td><td>: <?php echo $bt['name'];?></td><td><b>Country</b></td><td>: <?php echo $country['name'];?></td></tr>
            <tr><td><b>Industry Code</b></td><td>: <?php echo $ind_code['name'];?></td><td ><b>Region</b></td><td>: <?php echo $reg['name'];?></td></tr>
            <tr><td><b>Client Type</b></td><td colspan='3'>: <?php echo $ct;?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Contact Person</td></tr>
            <tr><td><b>Name</b></td><td>: <?php echo $client['con_name'];?></td><td ><b>ResCert</b></td><td>: <?php echo $client['con_rescert_no'];?></td></tr>
            <tr><td><b>ResCert Place</b></td><td>: <?php echo $client['con_rescert_place'];?></td><td ><b>ResCert Date</b></td><td>: <?php echo $client['con_rescert_date'];?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Home Address</b></td><td colspan='3'>: <?php echo $home_add;?></td></tr>
            <tr><td><b>Business Address</b></td><td colspan='3'>: <?php echo $bus_add;?></td></tr>
            <tr><td><b>Garage Address</b></td><td colspan='3'>: <?php echo $gar_add;?></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Email Address</b></td><td>: <?php echo $client['email'];?></td><td ><b>FAX No</b></td><td>: <?php echo $client['fax_no'];?></td></tr>
            <tr><td><b>Business Tel. No</b></td><td>: <?php echo $client['bus_tel'];?></td><td ><b>Home Tel. No</b></td><td>: <?php echo $client['home_tel'];?></td></tr>
            <tr><td><b>Primary Contact No</b></td><td>: <?php echo $client['pri_con'];?></td><td ><b>Secondary Contact No</b></td><td>: <?php echo $client['sec_con'];?></td></tr>

  </table><br><br>  
	</div>
</div>
</div>


