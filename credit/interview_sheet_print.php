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
    $home_add=$client['home_no']." ".$client['home_brgy'].", ".$client['home_city']." ".$client['home_zip'];
    $trade=$con->myQuery("SELECT * FROM interview_sheet WHERE loan_id=?",array($data['id']))->fetch(PDO::FETCH_ASSOC);
    $child=$con->myQuery("SELECT * FROM interview_child WHERE loan_id=?",array($data['id']))->fetch(PDO::FETCH_ASSOC);
    $sib=$con->myQuery("SELECT * FROM interview_sibling WHERE loan_id=?",array($data['id']))->fetch(PDO::FETCH_ASSOC);
    $char=$con->myQuery("SELECT * FROM interview_char WHERE loan_id=?",array($data['id']))->fetch(PDO::FETCH_ASSOC);
    $cv=$con->myQuery("SELECT name FROM civil_status WHERE id=?",array($client['civil_status_id']))->fetch(PDO::FETCH_ASSOC);
    $spouse_cv=$con->myQuery("SELECT name FROM civil_status WHERE id=?",array($trade['spouse_civil_status']))->fetch(PDO::FETCH_ASSOC);
    $home_add=$client['home_no']." ".$client['home_brgy'].", ".$client['home_city']." ".$client['home_zip'];
    $bus_add=$client['bus_no']." ".$client['bus_brgy'].", ".$client['bus_city']." ".$client['bus_zip'];
    $gar_add=$client['gar_no']." ".$client['gar_brgy'].", ".$client['gar_city']." ".$client['gar_zip'];
    $ind=$con->myQuery("SELECT name FROM industry_code WHERE id=?",array($trade['bus_nat']))->fetch(PDO::FETCH_ASSOC);
    $deal=$con->myQuery("SELECT CONCAT(lname,', ',fname,' ',ename,' ',mname) as name FROM client_list WHERE client_number=?",array($trade['dealer_id']))->fetch(PDO::FETCH_ASSOC);
    $sale=$con->myQuery("SELECT CONCAT(lname,', ',fname,' ',ename,' ',mname) as name FROM client_list WHERE client_number=?",array($trade['salesman_id']))->fetch(PDO::FETCH_ASSOC);
    $child_name=explode(",",$child['name']);
    $child_age=explode(",",$child['age']);
    $child_stat=explode(",",$child['status']);
    $child_aff=explode(",",$child['affiliation']);
    $sib_name=explode(",",$sib['name']);
    $sib_con=explode(",",$sib['contact']);
    $sib_add=explode(",",$sib['address']);
    $char_name=explode(",",$char['name']);
    $char_con=explode(",",$char['contact']);
    $char_add=explode(",",$char['address']);
    $corpo_name=explode(",",$trade['corpo_name']);
    $corpo_pos=explode(",",$trade['corpo_pos']);
    $trade_comp=explode(",",$trade['trade_comp']);
    $trade_tel=explode(",",$trade['trade_tel']);
    $trade_con=explode(",",$trade['trade_con']);
    $trade_deal=explode(",",$trade['trade_deal']);
    $trade_coll=explode(",",$trade['trade_coll']);
    $gas_name=explode(",",$trade['gas_name']);
    $gas_tel=explode(",",$trade['gas_tel']);
    $gas_con=explode(",",$trade['gas_con']);
    $gas_coll=explode(",",$trade['gas_coll']);
    $bank_name=explode(",",$trade['bank_name']);
    $bank_branch=explode(",",$trade['bank_branch']);
    $bank_acct=explode(",",$trade['bank_acct']);
    $bank_date=explode(",",$trade['bank_date']);
    $bank_ave=explode(",",$trade['bank_ave']);
    $loan_bank_name=explode(",",$trade['loan_bank_name']);
    $loan_bank_branch=explode(",",$trade['loan_bank_branch']);
    $loan_bank_fac=explode(",",$trade['loan_bank_fac']);
    $loan_bank_amt=explode(",",$trade['loan_bank_amt']);
    $loan_bank_term=explode(",",$trade['loan_bank_term']);
    $loan_bank_date=explode(",",$trade['loan_bank_date']);
    $loan_bank_bal=explode(",",$trade['loan_bank_bal']);
    $loan_ind_name=explode(",",$trade['loan_ind_name']);
    $loan_ind_con=explode(",",$trade['loan_ind_con']);
    $loan_ind_amt=explode(",",$trade['loan_ind_amt']);
    $loan_ind_term=explode(",",$trade['loan_ind_term']);
    $loan_ind_date=explode(",",$trade['loan_ind_date']);
    $loan_ind_bal=explode(",",$trade['loan_ind_bal']);
    $veh_brand=explode(",",$trade['veh_brand']);
    $veh_year=explode(",",$trade['veh_year']);
    $veh_bank=explode(",",$trade['veh_bank']);
    $veh_amt=explode(",",$trade['veh_amt']);
    $veh_term=explode(",",$trade['veh_term']);
    $real_loc=explode(",",$trade['real_loc']);
    $real_sq=explode(",",$trade['real_sq']);
    $real_year=explode(",",$trade['real_year']);
    $real_bank=explode(",",$trade['real_bank']);
    $real_amt=explode(",",$trade['real_amt']);
    $real_term=explode(",",$trade['real_term']);
    $c_child = count($child_name);
    $c_sib=count($sib_name);
    $c_char=count($char_name);
    $c_corpo=count($corpo_name);
    $c_trade=count($trade_comp);
    $c_gas=count($gas_name);
    $c_bank=count($bank_name);
    $c_loanbank=count($loan_bank_name);
    $c_loanind=count($loan_ind_name);
    $c_veh=count($veh_brand);
    $c_real=count($real_loc);
        if($trade['org_type']=='S'){
            $org_type='Single Proprietor';
        }elseif($trade['org_type']=='P'){
            $org_type='Partnership';
        }elseif($trade['org_type']=='C'){
            $org_type='Corporation';
        }else{
            $org_type='';
        }
	}else{
		redirect("../index.php");
	}

	makeHead("Interview Sheet",1);
?>
<div class='page' style='background-color:white;'>
<div class='col-md-12 no-print' align='right'>
	<br>
	<a href="ci_checking_form.php?id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>" class='btn btn-default'><span class='glyphicon glyphicon-arrow-left'></span> Back</a>
	<button onclick='window.print()' class='btn btn-default no-print'>Print &nbsp;<span class='fa fa-print'></span></button>  
</div>
<div class='page'>
	<div class="row">
      <div align='center'>
      <h3><b>Interview Sheet</b>
      </div>
		<br>
		<div class="col-md-12" style="padding-left: 50px" >
		<p align="left"  >Date Printed: <?php echo date("m/d/Y") ?></p>
		</div>
	</div>
	<hr>
  <div class='box-body'>
  <div style='border:3px solid black;margin:0;'>
                <table>
                    <tr><td width='15%'>&nbsp;Proposal</td><td>: </td><td width='25%'> <?php echo $trade['proposal'];?></td><td width='5%'></td><td  width='25%'> Dealer </td><td >: <?php echo $deal['name'];?></td></tr>
                    <tr ><td>&nbsp;Terms</td><td>: </td><td> <?php echo $trade['term'];?></td><td></td><td width='15%'>Salesman </td><td>: <?php echo $sale['name'];?></td></tr>
                    <tr><td>&nbsp;Purpose</td><td>: </td><td> <?php echo $trade['purpose'];?></td></tr>
                </table>
                </div><br><br>
                <table >
            <tr><td width='20%'><b>Subject</b></td><td>: <?php echo $cname;?></td><td width='22%'><b>Nickname</b></td><td width='25%'>: <?php echo ucwords($trade['nname']);?></td></tr>
            <tr><td><b>Age</b></td><td>: <?php echo $trade['age'];?></td><td ><b>Civil Status</b></td><td>: <?php echo $cv['name'];?></td></tr>
            <tr><td><b>Date of Birth</b></td><td>: <?php echo $client['birthdate'];?></td><td ><b>Place of Birth</b></td><td>: <?php echo $trade['birthplace'];?></td></tr>
            <tr><td><b>Educational Attainment</b></td><td colspan='3'>: <?php echo $trade['edu_att'];?></td></tr>
            <tr><td><b>School</b></td><td colspan='3'>: <?php echo $trade['school'];?></td></tr>
            <tr><td><b>GSIS/SSS</b></td><td colspan='3'>: <?php echo $client['sss_no'];?></td></tr>
            <tr><td><b>Driver's License No.</b></td><td colspan='3'>: <?php echo $trade['dri_lic'];?></td></tr>
            <?php if(!empty($trade['emp_name'])){ ?>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Employer</b></td><td>: <?php echo $trade['emp_name'];?></td><td ><b>Length of Service</b></td><td>: <?php echo $trade['emp_leng'];?></td></tr>
            <tr><td><b>Address</b></td><td>: <?php echo $trade['emp_add'];?></td><td ><b>Contact No.</b></td><td>: <?php echo $trade['emp_con'];?></td></tr>
            <tr><td><b>Designation</b></td><td>: <?php echo $trade['emp_des'];?></td><td ><b>Monthly Salary</b></td><td>: <?php echo $trade['emp_sal'];?></td></tr>
            <?php } ?>
            <tr><td><b>Previous Employer</b></td><td colspan='3'>: <?php echo $trade['emp_prev'];?></td></tr>
            <?php if(!empty($trade['spouse_name'])){ ?>
            <tr><td colspan='4'><hr></td></tr>
            <tr><td><b>Spouse</b></td><td>: <?php echo $client['spouse'];?></td><td width='22%'><b>Nickname</b></td><td width='25%'>: <?php echo ucwords($trade['spouse_nname']);?></td></tr>
            <tr><td><b>Age</b></td><td>: <?php echo $trade['spouse_age'];?></td><td ><b>Civil Status</b></td><td>: <?php echo $spouse_cv['name'];?></td></tr>
            <tr><td><b>Date of Birth</b></td><td>: <?php echo $trade['spouse_birthdate'];?></td><td ><b>Place of Birth</b></td><td>: <?php echo $trade['spouse_birthplace'];?></td></tr>
            <tr><td><b>Educational Attainment</b></td><td colspan='3'>: <?php echo $trade['spouse_edu_att'];?></td></tr>
            <tr><td><b>School</b></td><td colspan='3'>: <?php echo $trade['spouse_school'];?></td></tr>
            <tr><td><b>GSIS/SSS</b></td><td colspan='3'>: <?php echo $trade['spouse_gsis_sss'];?></td></tr>
            <tr><td><b>Driver's License No.</b></td><td colspan='3'>: <?php echo $trade['spouse_dri_lic'];?></td></tr>
            <?php if(!empty($trade['spouse_emp_name'])){ ?>
            <tr><td>&nbsp;</td></tr>
            <tr><td><b>Employer</b></td><td>: <?php echo $trade['spouse_emp_name'];?></td><td ><b>Length of Service</b></td><td>: <?php echo $trade['spouse_emp_leng'];?></td></tr>
            <tr><td><b>Address</b></td><td>: <?php echo $trade['spouse_emp_add'];?></td><td ><b>Contact No.</b></td><td>: <?php echo $trade['spouse_emp_con'];?></td></tr>
            <tr><td><b>Designation</b></td><td>: <?php echo $trade['spouse_emp_des'];?></td><td ><b>Monthly Salary</b></td><td>: <?php echo $trade['spouse_emp_sal'];?></td></tr>
            <?php } ?>
            <tr><td><b>Previous Employer</b></td><td colspan='3'>: <?php echo $trade['spouse_emp_prev'];?></td></tr>
            <?php } ?>
            <tr><td colspan='4'><hr></td></tr>
            <?php if($trade['no_child']>0){ ?>
            <tr><td><b>Number of Children</b></td><td colspan='3'>: <?php echo $trade['no_child'];?></td></tr>
  </table>
	<div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Name</th>
                        <th class='text-center' style='padding: 0.1cm;'>Age</th>
                        <th class='text-center' style='padding: 0.1cm;'>Status</th>
                        <th class='text-center' style='padding: 0.1cm;'>School/Occupation/Employer</th>             
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($child)){for($i = 0; $i < $c_child ; $i++) :
                        ?>
                        
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($child_name[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($child_age[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($child_stat[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($child_aff[$i]) ?></td>
                          </tr>
                        <?php
                          endfor;}else{
                            echo "<tr class='text-center'><td colspan='4'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div><br>
                  <?php }else{ echo "</table>";} ?>
            <table>
                  <tr><td width='20%' colspan='4'><b>Name of Parents</b></td></tr>
            </table>
            <div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;'>
                      <thead style='display:table-header-group !important;'>
                      <th></th>
                        <th class='text-center' style='padding: 0.1cm;'>Name</th>
                        <th class='text-center' style='padding: 0.1cm;'>Age</th>
                        <th class='text-center' style='padding: 0.1cm;'>Address</th>            
                      </thead>
                      <tbody>              
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td width='20%'><b> Father</td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($trade['fat_name']) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($trade['fat_age']) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($trade['fat_add']) ?></td>
                          </tr>
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td width='20%'><b> Mother</td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($trade['mom_name']) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($trade['mom_age']) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($trade['mom_add']) ?></td>
                          </tr>
                      </tbody>
                    </table>
                  </div></div><br>
                  <?php if($trade['no_sib']>0){ ?>
            <table>
                <tr><td width='20%'><b>Number of Siblings</b></td><td colspan='3'>: <?php echo $trade['no_sib'];?></td></tr>
            </table>
            <div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Name</th>
                        <th class='text-center' style='padding: 0.1cm;'>Contact No.</th>
                        <th class='text-center' style='padding: 0.1cm;'>Address</th>            
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($sib)){for($i = 0; $i < $c_sib ; $i++) :
                        ?>
                        
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($sib_name[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($sib_con[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($sib_add[$i]) ?></td>
                          </tr>
                        <?php
                          endfor;}else{
                            echo "<tr class='text-center'><td colspan='4'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div><br>
                <?php } ?>
            <table>
                  <tr><td width='20%' colspan='4'><b>Character Reference (friend / not relatives)</b></td></tr>
            </table>
            <div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Name</th>
                        <th class='text-center' style='padding: 0.1cm;'>Contact No.</th>
                        <th class='text-center' style='padding: 0.1cm;'>Address</th>            
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($char)){for($i = 0; $i < $c_char ; $i++) :
                        ?>
                        
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($char_name[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($char_con[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($char_add[$i]) ?></td>
                          </tr>
                        <?php
                          endfor;}else{
                            echo "<tr class='text-center'><td colspan='4'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div><br>
            <table>
                <tr><td colspan='4'><hr></td></tr>
                <tr><td ><b>Present Address</b></td><td colspan='3'>: <?php echo $home_add;?></td></tr>
                <tr><td width='20%'><b>Tel. No.</b></td><td>: <?php echo $client['home_tel'];?></td><td width='22%'><b>Cell Phone No.</b></td><td width='25%'>: <?php echo $client['pri_con'];?></td></tr>
                <tr><td ><b>Acquisition</b></td><td>: <?php echo $trade['pres_acquire'];?></td><td><b>Length of Stay</b></td><td>: <?php echo $trade['pres_leng_stay'];?></td></tr>
            <?php if($trade['pres_acquire']=='Free'){ ?>
                <tr><td colspan='4'><b>Provided Free by</b></td></tr>
                <tr><td ><b>Name</b></td><td>: <?php echo $trade['pres_free_name'];?></td><td><b>Relationship</b></td><td colspan='3'>: <?php echo $trade['pres_free_rel'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['pres_free_tel'];?></td></tr>
            <?php }elseif($trade['pres_acquire']=='Rented'){?>
                <tr><td ><b>Landlord</b></td><td>: <?php echo $trade['pres_rent_name'];?></td><td><b>Monthly Rental</b></td><td colspan='3'>: <?php echo $trade['pres_rent_pay'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['pres_rent_tel'];?></td></tr>
            <?php }elseif($trade['pres_acquire']=='Mortgage'){ ?>
                <tr><td ><b>Bank/Financing</b></td><td>: <?php echo $trade['pres_mort_name'];?></td><td><b>Monthly Payment</b></td><td colspan='3'>: <?php echo $trade['pres_mort_pay'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['pres_mort_tel'];?></td></tr>
            <?php } ?>
                <tr><td><b>Previous Address</b></td><td colspan='3'>: <?php echo $trade['prev_add'];?></td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td ><b>Other Provincial Address</b></td><td colspan='3'>: <?php echo $trade['other_add'];?></td></tr>
                <tr><td width='20%'><b>Tel. No.</b></td><td>: <?php echo $trade['other_tel_no'];?></td><td width='22%'><b>Cell Phone No.</b></td><td width='25%'>: <?php echo $trade['other_cel_no'];?></td></tr>
                <tr><td ><b>Acquisition</b></td><td>: <?php echo $trade['other_acquire'];?></td><td><b>Length of Stay</b></td><td>: <?php echo $trade['other_leng_stay'];?></td></tr>
            <?php if($trade['other_acquire']=='Free'){ ?>
                <tr><td colspan='4'><b>Provided Free by</b></td></tr>
                <tr><td ><b>Name</b></td><td>: <?php echo $trade['other_free_name'];?></td><td><b>Relationship</b></td><td colspan='3'>: <?php echo $trade['other_free_rel'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['other_free_tel'];?></td></tr>
            <?php }elseif($trade['other_acquire']=='Rented'){?>
                <tr><td ><b>Landlord</b></td><td>: <?php echo $trade['other_rent_name'];?></td><td><b>Monthly Rental</b></td><td colspan='3'>: <?php echo $trade['other_rent_pay'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['other_rent_tel'];?></td></tr>
            <?php }elseif($trade['other_acquire']=='Mortgage'){ ?>
                <tr><td ><b>Bank/Financing</b></td><td>: <?php echo $trade['other_mort_name'];?></td><td><b>Monthly Payment</b></td><td colspan='3'>: <?php echo $trade['other_mort_pay'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['other_mort_tel'];?></td></tr>
            <?php } ?>
            <tr><td colspan='4'><hr></td></tr>
            </table>
            <div align='center'>
            <h4><b><u>Business Aspects</u></b>
            </div>
            <table>
                <tr><td ><b>Business Name</b></td><td colspan='3'>: <?php echo $trade['bus_name'];?></td></tr>
                <tr><td width='20%'><b>Type of Org.</b></td><td>: <?php echo $org_type;?></td><td width='22%'><b>Date Est.</b></td><td width='25%'>: <?php echo $trade['date_est'];?></td></tr>
                <tr><td ><b>Nature of Business</b></td><td colspan='3'>: <?php echo $ind['name'];?></td></tr>
            <?php if($trade['org_type']=='S'){ ?>
                <tr><td ><b>Who manage the business?</b></td><td colspan='3'>: <?php echo $trade['sing_name'];?></td></tr>
            <?php } elseif($trade['org_type']=='P'){ ?>
                <tr><td><b>Name of Partner</b></td><td>: <?php echo $trade['part_name'];?></td><td><b>Relationship with the borrower</b></td><td>: <?php echo $trade['part_rel'];?></td></tr>
            <?php } elseif($trade['org_type']=='C'){ ?>
                <tr><td ><b>Who manage the business?</b></td><td colspan='3'>: <?php echo $trade['corp_man_name'];?></td></tr>
                <tr><td ><b>Major Stockholder / Corporator</b></td><td colspan='3'>: <?php echo $trade['corp_maj_name'];?></td></tr>
                <tr><td width='20%' colspan='4'><b>List of Corporators</b></td></tr>
                <tr><td colspan='4'>
                <div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Name</th>
                        <th class='text-center' style='padding: 0.1cm;'>Position</th>          
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($trade['corpo_name'])){for($i = 0; $i < $c_corpo ; $i++) :
                        ?>
                        
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($corpo_name[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($corpo_pos[$i]) ?></td>
                          </tr>
                        <?php
                          endfor;}else{
                            echo "<tr class='text-center'><td colspan='4'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div>
                </td></tr>
            <?php } ?>
            <tr><td colspan='4'><hr></td></tr>
            </table>
            <table>
                <tr><td ><b>Office Address</b></td><td colspan='3'>: <?php echo $trade['off_add'];?></td></tr>
                <tr><td width='20%'><b>Tel. No.</b></td><td>: <?php echo $trade['off_tel_no'];?></td><td width='22%'><b>Cell Phone No.</b></td><td width='25%'>: <?php echo $trade['off_cel_no'];?></td></tr>
                <tr><td ><b>Acquisition</b></td><td>: <?php echo $trade['off_acquire'];?></td><td><b>Length of Stay</b></td><td>: <?php echo $trade['off_leng_stay'];?></td></tr>
            <?php if($trade['off_acquire']=='Free'){ ?>
                <tr><td colspan='4'><b>Provided Free by</b></td></tr>
                <tr><td ><b>Name</b></td><td>: <?php echo $trade['off_free_name'];?></td><td><b>Relationship</b></td><td colspan='3'>: <?php echo $trade['off_free_rel'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['off_free_tel'];?></td></tr>
            <?php }elseif($trade['off_acquire']=='Rented'){?>
                <tr><td ><b>Landlord</b></td><td>: <?php echo $trade['off_rent_name'];?></td><td><b>Monthly Rental</b></td><td colspan='3'>: <?php echo $trade['off_rent_pay'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['off_rent_tel'];?></td></tr>
            <?php }elseif($trade['off_acquire']=='Mortgage'){ ?>
                <tr><td ><b>Bank/Financing</b></td><td>: <?php echo $trade['off_mort_name'];?></td><td><b>Monthly Payment</b></td><td colspan='3'>: <?php echo $trade['off_mort_pay'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['off_mort_tel'];?></td></tr>
            <?php } ?>
                <tr><td><b>Previous Address</b></td><td colspan='3'>: <?php echo $trade['off_prev_add'];?></td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td ><b>Garage/Warehouse Address</b></td><td colspan='3'>: <?php echo $trade['gar_add'];?></td></tr>
                <tr><td width='20%'><b>Tel. No.</b></td><td>: <?php echo $trade['gar_tel_no'];?></td><td width='22%'><b>Cell Phone No.</b></td><td width='25%'>: <?php echo $trade['gar_cel_no'];?></td></tr>
                <tr><td ><b>Acquisition</b></td><td>: <?php echo $trade['gar_acquire'];?></td><td><b>Length of Stay</b></td><td>: <?php echo $trade['gar_leng_stay'];?></td></tr>
            <?php if($trade['gar_acquire']=='Free'){ ?>
                <tr><td colspan='4'><b>Provided Free by</b></td></tr>
                <tr><td ><b>Name</b></td><td>: <?php echo $trade['gar_free_name'];?></td><td><b>Relationship</b></td><td colspan='3'>: <?php echo $trade['gar_free_rel'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['gar_free_tel'];?></td></tr>
            <?php }elseif($trade['gar_acquire']=='Rented'){?>
                <tr><td ><b>Landlord</b></td><td>: <?php echo $trade['gar_rent_name'];?></td><td><b>Monthly Rental</b></td><td colspan='3'>: <?php echo $trade['gar_rent_pay'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['gar_rent_tel'];?></td></tr>
            <?php }elseif($trade['gar_acquire']=='Mortgage'){ ?>
                <tr><td ><b>Bank/Financing</b></td><td>: <?php echo $trade['gar_mort_name'];?></td><td><b>Monthly Payment</b></td><td colspan='3'>: <?php echo $trade['gar_mort_pay'];?></td></tr>
                <tr><td ><b>Tel. No.</b></td><td colspan='3'>: <?php echo $trade['gar_mort_tel'];?></td></tr>
            <?php } ?>
            <tr><td><b>Previous Address</b></td><td colspan='3'>: <?php echo $trade['gar_prev_add'];?></td></tr>
            <tr><td colspan='4'><hr></td></tr>
                  <tr><td width='20%' colspan='4'><b>Trade References</b></td></tr>
                  <tr><td colspan='4'>
                  <div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Company</th>
                        <th class='text-center' style='padding: 0.1cm;'>Tel. No.</th>
                        <th class='text-center' style='padding: 0.1cm;'>Contact Person</th>
                        <th class='text-center' style='padding: 0.1cm;'>Dealings</th>
                        <th class='text-center' style='padding: 0.1cm;'>Monthly/Weekly Collection</th>         
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($trade['trade_comp'])){for($i = 0; $i < $c_trade ; $i++){
                        ?>
                        
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($trade_comp[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($trade_tel[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($trade_con[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($trade_deal[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($trade_coll[$i]) ?></td>
                          </tr>
                        <?php
                          }}else{
                            echo "<tr class='text-center'><td colspan='5'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div>
                  </td></tr>
                  <tr><td>&nbsp;</td></tr>
                  <tr><td colspan='4'>
                  <div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Gasoling Station/Branch</th>
                        <th class='text-center' style='padding: 0.1cm;'>Tel. No.</th>
                        <th class='text-center' style='padding: 0.1cm;'>Contact Person</th>
                        <th class='text-center' style='padding: 0.1cm;'>Monthly/Weekly Collection</th>         
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($trade['gas_comp'])){for($i = 0; $i < $c_gas ; $i++){
                        ?>
                        
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($gas_name[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($gas_tel[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($gas_con[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($gas_coll[$i]) ?></td>
                          </tr>
                        <?php
                          }}else{
                            echo "<tr class='text-center'><td colspan='4'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div>
                  </td></tr>
                  <tr><td>&nbsp;</td></tr>
                  <tr><td width='20%' colspan='4'><b>Bank References</b></td></tr>
                  <tr><td colspan='4'>
                  <div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Bank Name</th>
                        <th class='text-center' style='padding: 0.1cm;'>Branch</th>
                        <th class='text-center' style='padding: 0.1cm;'>Account Type</th>
                        <th class='text-center' style='padding: 0.1cm;'>Date Opened</th>
                        <th class='text-center' style='padding: 0.1cm;'>Average Balance</th>              
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($trade['bank_name'])){for($i = 0; $i < $c_bank ; $i++){
                        ?>
                        
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($bank_name[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($bank_branch[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($bank_acct[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($bank_date[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($bank_ave[$i]) ?></td>
                          </tr>
                        <?php
                          }}else{
                            echo "<tr class='text-center'><td colspan='5'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div>
                  </td></tr>
                  <tr><td>&nbsp;</td></tr>
                  <tr><td width='20%' colspan='4'><b>Loans - Existing/Fully Paid</b></td></tr>
                  <tr><td colspan='4'>
                  <div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Bank/Financing</th>
                        <th class='text-center' style='padding: 0.1cm;'>Branch</th>
                        <th class='text-center' style='padding: 0.1cm;'>Facility</th>
                        <th class='text-center' style='padding: 0.1cm;'>Amount Finance</th>
                        <th class='text-center' style='padding: 0.1cm;'>Terms</th>
                        <th class='text-center' style='padding: 0.1cm;'>Date Granted</th>    
                        <th class='text-center' style='padding: 0.1cm;'>Balance</th>             
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($trade['loan_bank_name'])){for($i = 0; $i < $c_loanbank ; $i++){
                        ?>
                        
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_bank_name[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_bank_branch[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_bank_fac[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_bank_amt[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_bank_term[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_bank_date[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_bank_bal[$i]) ?></td>
                          </tr>
                        <?php
                          }}else{
                            echo "<tr class='text-center'><td colspan='7'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div>
                  </td></tr>
                  <tr><td>&nbsp;</td></tr>
                  <tr><td colspan='4'>
                  <div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Individual Person</th>
                        <th class='text-center' style='padding: 0.1cm;'>Contact</th>
                        <th class='text-center' style='padding: 0.1cm;'>Amount Finance</th>
                        <th class='text-center' style='padding: 0.1cm;'>Terms</th>
                        <th class='text-center' style='padding: 0.1cm;'>Date Granted</th>    
                        <th class='text-center' style='padding: 0.1cm;'>Balance</th>             
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($trade['loan_ind_name'])){for($i = 0; $i < $c_loanind ; $i++){
                        ?>
                        
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_ind_name[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_ind_con[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_ind_amt[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_ind_term[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_ind_date[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($loan_ind_bal[$i]) ?></td>
                          </tr>
                        <?php
                          }}else{
                            echo "<tr class='text-center'><td colspan='6'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div>
                  </td></tr>
                  <tr><td>&nbsp;</td></tr>
                  <tr><td width='20%' colspan='4'><b>Vehicles Owned</b></td></tr>
                  <tr><td colspan='4'>
                  <div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Brand/Model</th>
                        <th class='text-center' style='padding: 0.1cm;'>Year Acquired</th>
                        <th class='text-center' style='padding: 0.1cm;'>Bank/Financing/Branch</th>
                        <th class='text-center' style='padding: 0.1cm;'>Amount Finance</th>
                        <th class='text-center' style='padding: 0.1cm;'>Terms</th>                
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($trade['veh_brand'])){for($i = 0; $i < $c_veh ; $i++){
                        ?>
                        
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($veh_brand[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($veh_year[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($veh_bank[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($veh_amt[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($veh_term[$i]) ?></td>
                          </tr>
                        <?php
                          }}else{
                            echo "<tr class='text-center'><td colspan='5'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div>
                  </td></tr>
                  <tr><td>&nbsp;</td></tr>
                  <tr><td width='20%' colspan='4'><b>Real Estate Owned</b></td></tr>
                  <tr><td colspan='4'>
                  <div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Location</th>
                        <th class='text-center' style='padding: 0.1cm;'>Sq.m.</th>
                        <th class='text-center' style='padding: 0.1cm;'>Year Acquired</th>
                        <th class='text-center' style='padding: 0.1cm;'>Bank/Financing/Branch</th>
                        <th class='text-center' style='padding: 0.1cm;'>Amount Finance</th>
                        <th class='text-center' style='padding: 0.1cm;'>Terms</th>                
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($trade['real_loc'])){for($i = 0; $i < $c_real ; $i++){
                        ?>
                        
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($real_loc[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($real_sq[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($real_year[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($real_bank[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($real_amt[$i]) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($real_term[$i]) ?></td>
                          </tr>
                        <?php
                          }}else{
                            echo "<tr class='text-center'><td colspan='6'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div>
                  </td></tr>
                  <tr><td><hr></td></tr>
                  <tr><td colspan='4'><b>What is your other source of payment?</b></td></tr>
                  <tr><td colspan='4' style='text-indent:50px;'><p><?php echo $trade['sour_pay'];?></p></td></tr>
                  <tr><td colspan='4'><b>Is this loan for your own use or an accomodation to your relatives or friend?</b></td></tr>
                  <tr><td colspan='4' style='text-indent:50px;'><p><?php echo $trade['loan_for'];?></p></td></tr>
                  <tr><td colspan='4'><b>Do you have any court cases filed by the bank or financing company? If any, for what reason?</b></td></tr>
                  <tr><td colspan='4' style='text-indent:50px;'><p><?php echo $trade['court_case'];?></p></td></tr>
                  <tr><td><b>Manner of Interview</b></td><td colspan='3'>: <?php echo $trade['int_type'];?></td></tr>
                  <tr><td><b>Informant</b></td><td colspan='3'>: <?php echo $trade['informant'];?></td></tr>
                  <tr><td><b>Relationship to the borrower</b></td><td colspan='3'>: <?php echo $trade['bor_rel'];?></td></tr>
                  <tr><td><b>Date of Interview</b></td><td colspan='3'>: <?php echo $trade['int_date'];?></td></tr>
            </table>
	</div>
</div>
</div>
</div>


