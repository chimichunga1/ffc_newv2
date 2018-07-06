<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
if(empty($data)){
    redirect("ci_checking.php");
}
$tab=2;

$trades=$con->myQuery("SELECT * FROM interview_sheet WHERE loan_id=?",array($data['id']))->fetch(PDO::FETCH_ASSOC);
$child=$con->myQuery("SELECT * FROM interview_child WHERE loan_id=?",array($data['id']))->fetch(PDO::FETCH_ASSOC);
$sib=$con->myQuery("SELECT * FROM interview_sibling WHERE loan_id=?",array($data['id']))->fetch(PDO::FETCH_ASSOC);
$char=$con->myQuery("SELECT * FROM interview_char WHERE loan_id=?",array($data['id']))->fetch(PDO::FETCH_ASSOC);
$ind=$con->myQuery("SELECT id,name FROM industry_code WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
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
$corpo_name=explode(",",$trades['corpo_name']);
$corpo_pos=explode(",",$trades['corpo_pos']);
$trade_comp=explode(",",$trades['trade_comp']);
$trade_tel=explode(",",$trades['trade_tel']);
$trade_con=explode(",",$trades['trade_con']);
$trade_deal=explode(",",$trades['trade_deal']);
$trade_coll=explode(",",$trades['trade_coll']);
$gas_name=explode(",",$trades['gas_name']);
$gas_tel=explode(",",$trades['gas_tel']);
$gas_con=explode(",",$trades['gas_con']);
$gas_coll=explode(",",$trades['gas_coll']);
$bank_name=explode(",",$trades['bank_name']);
$bank_branch=explode(",",$trades['bank_branch']);
$bank_acct=explode(",",$trades['bank_acct']);
$bank_date=explode(",",$trades['bank_date']);
$bank_ave=explode(",",$trades['bank_ave']);
$loan_bank_name=explode(",",$trades['loan_bank_name']);
$loan_bank_branch=explode(",",$trades['loan_bank_branch']);
$loan_bank_fac=explode(",",$trades['loan_bank_fac']);
$loan_bank_amt=explode(",",$trades['loan_bank_amt']);
$loan_bank_term=explode(",",$trades['loan_bank_term']);
$loan_bank_date=explode(",",$trades['loan_bank_date']);
$loan_bank_bal=explode(",",$trades['loan_bank_bal']);
$loan_ind_name=explode(",",$trades['loan_ind_name']);
$loan_ind_con=explode(",",$trades['loan_ind_con']);
$loan_ind_amt=explode(",",$trades['loan_ind_amt']);
$loan_ind_term=explode(",",$trades['loan_ind_term']);
$loan_ind_date=explode(",",$trades['loan_ind_date']);
$loan_ind_bal=explode(",",$trades['loan_ind_bal']);
$veh_brand=explode(",",$trades['veh_brand']);
$veh_year=explode(",",$trades['veh_year']);
$veh_bank=explode(",",$trades['veh_bank']);
$veh_amt=explode(",",$trades['veh_amt']);
$veh_term=explode(",",$trades['veh_term']);
$real_loc=explode(",",$trades['real_loc']);
$real_sq=explode(",",$trades['real_sq']);
$real_year=explode(",",$trades['real_year']);
$real_bank=explode(",",$trades['real_bank']);
$real_amt=explode(",",$trades['real_amt']);
$real_term=explode(",",$trades['real_term']);
$a = count($child_name);
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
?>
	<?php
		Alert();
		
	?>
            <center><h3><b>INTERVIEWER'S SHEET</b></h3></center>
            <div style='float:right;margin-top:-4%;'>
            <!-- <a href="interview_sheet_print.php?id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>" class='btn btn-success'> View &nbsp;<span class='fa fa-search'></span> </a> -->
            <button onclick="printExternal('interview_sheet_print.php?id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>')" class='btn btn-default no-print'>Print &nbsp;<span class='fa fa-print'></span></button>  
            </h3>
            </div>
            <form action="save_interview_sheet.php" method="post" class="form-horizontal" id='frmclear'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <input type='hidden' name='tab' id='tab' value="<?php echo !empty($_GET['tab'])?htmlspecialchars($_GET['tab']):''?>">
                <input type='hidden' name='client_no' id='client_no' value="<?php echo !empty($client['client_number'])?htmlspecialchars($client['client_number']):''?>">
                <div style='border:3px solid black;margin:0;'>
                <table style='margin-left: 15%;width:75% !important;'>
                    <tr height='50px'>
                    <td width='15%'>Proposal</td><td>:</td><td width='25%'> <input type="text" placeholder="Proposal" class="form-control" id="proposal" name='proposal' value='<?php echo !empty($trades)?htmlspecialchars($trades['proposal']):''; ?>'></td>
                    <td width='5%'></td><td  width='25%'> Dealer :</td>
                    <td ><select class='form-control cbo' name='dealer' id='dealer' data-allow-clear='true' data-placeholder="Select Dealer" data-selected='<?php echo !empty($data)?htmlspecialchars($data['dealer_id']):''; ?>'>
                                <?php echo makeOptions($dl); ?>
                            </select></td></tr>
                    <tr height='50px'><td>Terms</td><td>:</td><td> <input type="text" class="form-control" placeholder="Term" id="term" name='term' value='<?php echo !empty($trades)?htmlspecialchars($trades['term']):''; ?>' ></td><td></td>
                    <td width='15%'>Salesman :</td>
                    <td><select class='form-control cbo' name='salesman' id='salesman'  data-allow-clear='true' data-placeholder="Select Salesman" data-selected='<?php echo !empty($data)?htmlspecialchars($data['salesman_id']):''; ?>' disabled>
                                <?php echo makeOptions($sm); ?>
                            </select></td></tr>
                    <tr height='50px'><td>Purpose</td><td>:</td><td> <input type="text" class="form-control" placeholder="Purpose" id="purpose" name='purpose' value='<?php echo !empty($trades)?htmlspecialchars($trades['purpose']):''; ?>' ></td></tr>
                </table>
                </div><br>
            <div class="text-center">
            <!-- <a href="word.php?id=<?php echo $_GET['id'];?>"><button type="button" class="btn btn-success no-print">Download Template</button></a> -->
            </div><br>
                <!--Subject-->
                <div class='form-group'>
                     <label class="col-md-3 control-label">Subject : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="subj_name" name='subj_name' value='<?php echo $cname;?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Nickname : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="nname" name='nname' placeholder="Nickname" value='<?php echo !empty($trades)?htmlspecialchars($trades['nname']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Age : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="age" name='age' placeholder="Age" value='<?php echo !empty($trades)?htmlspecialchars($trades['age']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Civil Status : </label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='civil_status' id='civil_status' data-allow-clear='true' data-placeholder="Select Civil Status" data-selected='<?php echo !empty($client)?htmlspecialchars($client['civil_status_id']):''; ?>' required>
                        <?php echo makeOptions($cv); ?>
                        </select>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Date of Birth : </label>
                      <div class="col-md-3">
                      <input type="text"  value='<?php echo !empty($client)?htmlspecialchars($client['birthdate']):''; ?>' class="form-control date_picker" id="birthdate" name='birthdate'>
                      </div>
                      <label class="col-md-2 control-label">Place of Birth : </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="birthplace" name='birthplace' placeholder="Place of Birth" value='<?php echo !empty($trades)?htmlspecialchars($trades['birthplace']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Educational Attainment : </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="edu_att" name='edu_att' placeholder="Educational Attainment" value='<?php echo !empty($trades)?htmlspecialchars($trades['edu_att']):''; ?>'>
                      </div>
                      </div>
                    <div class='form-group'>
                      <label class="col-md-3 control-label">School : </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="school" name='school' placeholder="School" value='<?php echo !empty($trades)?htmlspecialchars($trades['school']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">GSIS / SSS No. : </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control sss" id="gsis_sss" name='gsis_sss' placeholder="GSIS / SSS Number" value='<?php echo !empty($client)?htmlspecialchars($client['sss_no']):''; ?>' >
                      </div>
                    </div>
                    <div class='form-group'>
                      <label class="col-md-3 control-label">Driver's License No. : </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="dri_lic" name='dri_lic' placeholder="Driver's License Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['dri_lic']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-md-3 control-label"><h4><b><u>If Employed: </u></h4></b></label>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Employer : </label>
                      <div class="col-md-4">
                          <input type="text" class="form-control" id="emp_name" name='emp_name' placeholder="Employer" value='<?php echo !empty($trades)?htmlspecialchars($trades['emp_name']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Length of Service : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="emp_leng" name='emp_leng' placeholder="Length of Service" value='<?php echo !empty($trades)?htmlspecialchars($trades['emp_leng']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Address : </label>
                      <div class="col-md-4">
                      <textarea class='form-control' name='emp_add' id='emp_add' placeholder='Employer Address'><?php echo !empty($trades)?htmlspecialchars($trades['emp_add']):''; ?></textarea>
                      </div>
                      <label class="col-md-2 control-label">Contact No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="emp_con" name='emp_con' placeholder="Employer Contact Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['emp_con']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Designation : </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="emp_des" name='emp_des' placeholder="Designation" value='<?php echo !empty($trades)?htmlspecialchars($trades['emp_des']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Monthly Salary : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="emp_sal" name='emp_sal' placeholder="Monthly Salary" value='<?php echo !empty($trades)?htmlspecialchars($trades['emp_sal']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Previous Employer: </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="emp_prev" name='emp_prev' placeholder="Previous Employer (if less than 2 years)" value='<?php echo !empty($trades)?htmlspecialchars($trades['emp_prev']):''; ?>' >
                      </div>
                  </div>
                  <!--Spouse-->
                  <div id='spouse_hide'>
                  <hr>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Spouse : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse_name" name='spouse_name' placeholder="(Last Name) (First Name) (Middle Name)" value='<?php echo !empty($client)?htmlspecialchars($client['spouse']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Nickname : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse_nname" name='spouse_nname' placeholder="Nickname" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_nname']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Age : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="spouse_age" name='spouse_age' placeholder="Age" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_age']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Civil Status : </label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='spouse_civil_status' id='spouse_civil_status' data-allow-clear='true' data-placeholder="Select Civil Status" data-selected='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_civil_status_id']):''; ?>' >
                        <?php echo makeOptions($cv); ?>
                        </select>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Date of Birth : </label>
                      <div class="col-md-3">
                      <input type="text"  value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_birthdate']):''; ?>' class="form-control date_picker" id="spouse_birthdate" name='spouse_birthdate' >
                      </div>
                      <label class="col-md-2 control-label">Place of Birth : </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="spouse_birthplace" name='spouse_birthplace' placeholder="Place of Birth" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_birthplace']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Educational Attainment : </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id=spouse_"edu_att" name='spouse_edu_att' placeholder="Educational Attainment" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_edu_att']):''; ?>' >
                      </div>
                      </div>
                    <div class='form-group'>
                      <label class="col-md-3 control-label">School : </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="spouse_school" name='spouse_school' placeholder="School" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_school']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">GSIS / SSS No. : </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control sss" id="spouse_gsis_sss" name='spouse_gsis_sss' placeholder="GSIS / SSS Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_gsis_sss']):''; ?>' >
                      </div>
                    </div>
                    <div class='form-group'>
                      <label class="col-md-3 control-label">Driver's License No. : </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="spouse_dri_lic" name='spouse_dri_lic' placeholder="Driver's License Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_dri_lic']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                      <label class="col-md-3 control-label"><h4><b><u>If Employed: </u></h4></b></label>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Employer : </label>
                      <div class="col-md-4">
                          <input type="text" class="form-control" id="spouse_emp_name" name='spouse_emp_name' placeholder="Employer" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_emp_name']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Length of Service : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse_emp_leng" name='spouse_emp_leng' placeholder="Length of Service" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_emp_leng']):''; ?>'>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Address : </label>
                      <div class="col-md-4">
                      <textarea class='form-control' name='spouse_emp_add' id='spouse_emp_add' placeholder='Employer Address'><?php echo !empty($trades)?htmlspecialchars($trades['spouse_emp_add']):''; ?></textarea>
                      </div>
                      <label class="col-md-2 control-label">Contact No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse_emp_con" name='spouse_emp_con' placeholder="Employer Contact Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_emp_con']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Designation : </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="spouse_emp_des" name='spouse_emp_des' placeholder="Designation" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_emp_des']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Monthly Salary : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="spouse_emp_sal" name='spouse_emp_sal' placeholder="Monthly Salary" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_emp_sal']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Previous Employer: </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="spouse_emp_prev" name='spouse_emp_prev' placeholder="Previous Employer (if less than 2 years)" value='<?php echo !empty($trades)?htmlspecialchars($trades['spouse_emp_prev']):''; ?>' >
                      </div>
                      </div>
                    </div>
                  <hr>
                  <!--children-->
                  <div id='child'>
                  <div class='form-group'>
                     <label class="col-md-2 control-label">Number of Children: </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control numeric" id="no_child" name='no_child' placeholder="Number of Children" value='<?php echo !empty($trades)?htmlspecialchars($trades['no_child']):''; ?>' >
                      </div>
                      <label class="col-md-6 control-label"> </label>
                      <div class="col-md-1">
                      <a href="javascript:new_link()">
                      <button type='button' class='btn btn-warning' id='add_child'><span class='fa fa-plus'/> Add </button></a>
                      </div>
                  </div>
                  <table style='margin-left:27%;'><tr><th width='17%'>Name</th><th width='13%'>Age</th><th width='14%'>Status</th><th>School / Occupation / Employer</th>
                  </tr></table>
                  <?php if(!empty($child['name'])){
                      for($i = 0; $i < $a ; $i++) {?>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"> </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="child_name[]" name='child_name[]' placeholder="Name" value='<?php echo !empty($child_name)?htmlspecialchars($child_name[$i]):''; ?>' >
                      </div>
                        <label class="col-md-0 control-label"></label>
                      <div class="col-md-1">
                        <input type="text" class="form-control numeric" id="child_age[]" name='child_age[]' placeholder="Age" value='<?php echo !empty($child_age)?htmlspecialchars($child_age[$i]):''; ?>' >
                      </div>
                      <label class="col-md-0 control-label"> </label>
                      <div class="col-md-2">
                        <input type="text" class="form-control " id="child_stat[]" name='child_stat[]' placeholder="Status" value='<?php echo !empty($child_stat)?htmlspecialchars($child_stat[$i]):''; ?>' >
                      </div>
                      <label class="col-md-0 control-label">  </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control " id="child_aff[]" name='child_aff[]' placeholder="School / Occupation / Employer" value='<?php echo !empty($child_aff)?htmlspecialchars($child_aff[$i]):''; ?>' >
                      </div>
                  </div>
                  <div style="text-align:right;margin-right:40px;margin-top:-50px;"><a href="javascript:delIt(<?php echo $i;?>)"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></div><div style="text-align:right;margin-right:40px;margin-top:0px;">&nbsp;</div>
                <?php }} ?>
                  </div>
                  <div id='new_child' style="display:none">
                  <div class='form-group'>
                  <label class="col-md-2 control-label"> </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="child_name[]" name='child_name[]' placeholder="Name"  >
                      </div>
                        <label class="col-md-0 control-label"></label>
                      <div class="col-md-1">
                        <input type="text" class="form-control numeric" id="child_age[]" name='child_age[]' placeholder="Age" >
                      </div>
                      <label class="col-md-0 control-label"> </label>
                      <div class="col-md-2">
                        <input type="text" class="form-control " id="child_stat[]" name='child_stat[]' placeholder="Status" >
                      </div>
                      <label class="col-md-0 control-label">  </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control " id="child_aff[]" name='child_aff[]' placeholder="School / Occupation / Employer" >
                      </div>
                  </div>
                  </div>
                  <hr>
                  <!--parents-->
                  <div class='form-group'>
                      <label class="col-md-3 control-label"><h4><b><u>Name of Parents </u></h4></b></label>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label">Father:</label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="fat_name" name='fat_name' placeholder="Father's Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['fat_name']):''; ?>' >
                      </div>
                        <label class="col-md-1 control-label">Age:</label>
                      <div class="col-md-1">
                        <input type="text" class="form-control" id="fat_age" name='fat_age' placeholder="Age" value='<?php echo !empty($trades)?htmlspecialchars($trades['fat_age']):''; ?>' >
                      </div>
                      <label class="col-md-1 control-label">Address</label>
                      <div class="col-md-4">
                      <textarea class='form-control' name='fat_add' id='fat_add' placeholder='Address'><?php echo !empty($trades)?htmlspecialchars($trades['fat_add']):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label">Mother:</label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="mom_name" name='mom_name' placeholder="Maiden Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['mom_name']):''; ?>' >
                      </div>
                        <label class="col-md-1 control-label">Age:</label>
                      <div class="col-md-1">
                        <input type="text" class="form-control" id="mom_age" name='mom_age' placeholder="Age" value='<?php echo !empty($trades)?htmlspecialchars($trades['mom_age']):''; ?>' >
                      </div>
                      <label class="col-md-1 control-label">Address</label>
                      <div class="col-md-4">
                      <textarea class='form-control' name='mom_add' id='mom_add' placeholder='Address'><?php echo !empty($trades)?htmlspecialchars($trades['mom_add']):''; ?></textarea>
                      </div>
                  </div><hr>
                  <!--siblings-->
                  <div id='sib'>
                  <div class='form-group'>
                     <label class="col-md-2 control-label">Number of Siblings: </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control numeric" id="no_sib" name='no_sib' placeholder="Number of Siblings" value='<?php echo !empty($trades)?htmlspecialchars($trades['no_sib']):''; ?>' >
                      </div>
                      <label class="col-md-6 control-label"> </label>
                      <div class="col-md-1">
                      <a href="javascript:new_sib()">
                      <button type='button' class='btn btn-warning' id='add_sib'><span class='fa fa-plus'/> Add </button></a>
                      </div>
                  </div>
                  <table style='margin-left:27%;'><tr><th width='20%'>Name</th><th width='27%'>Contact No.</th><th>Address</th>
                  </tr></table>
                  <?php if(!empty($sib['name'])){
                      for($i = 0; $i < $c_sib ; $i++) {?>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"> </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="sib_name[]" name='sib_name[]' placeholder="Name" value='<?php echo !empty($sib_name)?htmlspecialchars($sib_name[$i]):''; ?>' >
                      </div>
                        <label class="col-md-0 control-label"></label>
                      <div class="col-md-2">
                        <input type="text" class="form-control numeric" id="sib_con[]" name='sib_con[]' placeholder="Contact No." value='<?php echo !empty($sib_con)?htmlspecialchars($sib_con[$i]):''; ?>' >
                      </div>
                      <label class="col-md-0 control-label"> </label>
                      <div class="col-md-4">
                      <textarea class='form-control' name='sib_add[]' id='sib_add[]' placeholder='Address'><?php echo !empty($sib)?htmlspecialchars($sib_add[$i]):''; ?></textarea>
                      </div>
                  </div>
                  <div style="text-align:right;margin-right:40px;margin-top:-60px;"><a href="javascript:delIt1('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></div><div style="text-align:right;margin-right:40px;margin-top:0px;">&nbsp;</div>
                  <?php }} ?>
                  </div>
                  <div id='new_sib' style="display:none">
                  <div class='form-group'>
                  <label class="col-md-2 control-label"> </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="sib_name[]" name='sib_name[]' placeholder="Name" >
                      </div>
                        <label class="col-md-0 control-label"></label>
                      <div class="col-md-2">
                        <input type="text" class="form-control numeric" id="sib_con[]" name='sib_con[]' placeholder="Contact No.">
                      </div>
                      <label class="col-md-0 control-label"> </label>
                      <div class="col-md-4">
                      <textarea class='form-control' name='sib_add[]' id='sib_add[]' placeholder='Address'></textarea>
                      </div>
                  </div>
                  </div>
                  <hr>
                  <!--siblings end-->
                <!--char ref-->
                <div id='char'>
                  <div class='form-group'>
                     <label class="col-md-4 control-label">Character Reference (friend / not relatives) </label>
                      <div class="col-md-1">
                      </div>
                      <label class="col-md-6 control-label"> </label>
                      <div class="col-md-1">
                      <a href="javascript:new_char()">
                      <button type='button' class='btn btn-warning' id='add_char'><span class='fa fa-plus'/> Add </button></a>
                      </div>
                  </div>
                  <table style='margin-left:27%;'><tr><th width='20%'>Name</th><th width='27%'>Contact No.</th><th>Address</th>
                  </tr></table>
                  <?php if(!empty($char['name'])){
                      for($i = 0; $i < $c_char ; $i++) {?>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"> </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="char_name[]" name='char_name[]' placeholder="Name" value='<?php echo !empty($char_name)?htmlspecialchars($char_name[$i]):''; ?>' >
                      </div>
                        <label class="col-md-0 control-label"></label>
                      <div class="col-md-2">
                        <input type="text" class="form-control numeric" id="char_con[]" name='char_con[]' placeholder="Contact No." value='<?php echo !empty($char_con)?htmlspecialchars($char_con[$i]):''; ?>' >
                      </div>
                      <label class="col-md-0 control-label"> </label>
                      <div class="col-md-4">
                      <textarea class='form-control' name='char_add[]' id='char_add[]' placeholder='Address' ><?php echo !empty($char_add)?htmlspecialchars($char_add[$i]):''; ?></textarea>
                      </div>
                  </div>
                  <div style="text-align:right;margin-right:40px;margin-top:-60px;"><a href="javascript:delIt2('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></div><div style="text-align:right;margin-right:40px;margin-top:0px;">&nbsp;</div>
                      <?php }}?>
                  </div>
                  <div id='new_char' style="display:none">
                  <div class='form-group'>
                  <label class="col-md-2 control-label"> </label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="char_name[]" name='char_name[]' placeholder="Name" >
                      </div>
                        <label class="col-md-0 control-label"></label>
                      <div class="col-md-2">
                        <input type="text" class="form-control numeric" id="char_no[]" name='char_no[]' placeholder="Contact No." >
                      </div>
                      <label class="col-md-0 control-label"> </label>
                      <div class="col-md-4">
                      <textarea class='form-control' name='char_add[]' id='char_add[]' placeholder='Address'></textarea>
                      </div>
                  </div>
                  </div>
                  <hr>
                  <!--char ref end-->
                  <!-- Addresses -->
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Present Address: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='pres_add' id='pres_add' placeholder='Present Address' ><?php echo !empty($home_add)?htmlspecialchars($home_add):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Tel. No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="pres_tel_no" name='pres_tel_no' placeholder="Telephone Number" value='<?php echo !empty($client)?htmlspecialchars($client['home_tel']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Cell Phone No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="pres_cel_no" name='pres_cel_no' placeholder="Cell Phone Number" value='<?php echo !empty($client)?htmlspecialchars($client['pri_con']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Length of Stay : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="pres_leng_stay" name='pres_leng_stay' placeholder="Length of Stay" value='<?php echo !empty($trades)?htmlspecialchars($trades['pres_leng_stay']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='pres_acquire' value='Owned' <?php if($trades['pres_acquire']=='Owned'){echo "checked";}?> > Owned
                    </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='pres_acquire' value='Free' <?php if($trades['pres_acquire']=='Free'){echo "checked";}?> > Provided free by:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Name:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="pres_free_name" name='pres_free_name' placeholder="Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['pres_free_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Relationship:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="pres_free_rel" name='pres_free_rel' placeholder="Relationship" value='<?php echo !empty($trades)?htmlspecialchars($trades['pres_free_rel']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="pres_free_tel" name='pres_free_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['pres_free_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='pres_acquire' value='Rented' <?php if($trades['pres_acquire']=='Rented'){echo "checked";}?>> Rented:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Landlord:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="pres_rent_name" name='pres_rent_name' placeholder="Landlord Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['pres_rent_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Monthly Rental:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="pres_rent_pay" name='pres_rent_pay' placeholder="Monthly Rental" value='<?php echo !empty($trades)?htmlspecialchars($trades['pres_rent_pay']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="pres_rent_tel" name='pres_rent_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['pres_rent_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='pres_acquire' value='Mortgage' <?php if($trades['pres_acquire']=='Mortgage'){echo "checked";}?>> Mortgage:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Bank / Financing:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="pres_mort_name" name='pres_mort_name' placeholder="Bank / Financing" value='<?php echo !empty($trades)?htmlspecialchars($trades['pres_mort_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Monthly Payment:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="pres_mort_pay" name='pres_mort_pay' placeholder="Monthly Payment" value='<?php echo !empty($trades)?htmlspecialchars($trades['pres_mort_pay']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="pres_mort_tel" name='pres_mort_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['pres_mort_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Previous Address if less than 2 years: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='prev_add' id='prev_add' placeholder='Previous Address' ><?php echo !empty($trades)?htmlspecialchars($trades['prev_add']):''; ?></textarea>
                      </div>
                  </div>
                <!-- Addresses END -->
                <!-- Other Address-->
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Other Provincial Address: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='other_add' id='other_add' placeholder='Provincial Address'><?php echo !empty($trades)?htmlspecialchars($trades['other_add']):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Tel. No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="other_tel_no" name='other_tel_no' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_tel_no']):''; ?>' >
                      </div>
                      <label class="col-md-2 control-label">Cell Phone No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="other_cel_no" name='other_cel_no' placeholder="Cell Phone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_cel_no']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Length of Stay : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="other_leng_stay" name='other_leng_stay' placeholder="Length of Stay" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_leng_stay']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='other_acquire' value='Owned' <?php if($trades['other_acquire']=='Owned'){echo "checked";}?>>  Owned
                    </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='other_acquire' value='Free'<?php if($trades['other_acquire']=='Free'){echo "checked";}?> > Provided free by:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Name:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="other_free_name" name='other_free_name' placeholder="Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_free_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Relationship:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="other_free_rel" name='other_free_rel' placeholder="Relationship" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_free_rel']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="other_free_tel" name='other_free_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_free_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='other_acquire' value='Rented' <?php if($trades['other_acquire']=='Rented'){echo "checked";}?> > Rented:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Landlord:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="other_rent_name" name='other_rent_name' placeholder="Landlord Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_rent_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Monthly Rental:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="other_rent_pay" name='other_rent_pay' placeholder="Monthly Rental" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_rent_pay']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="other_rent_tel" name='other_rent_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_rent_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='other_acquire' value='Mortgage' <?php if($trades['other_acquire']=='Mortgage'){echo "checked";}?>> Mortgage:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Bank / Financing:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="other_mort_name" name='other_mort_name' placeholder="Bank / Financing" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_mort_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Monthly Payment:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="other_mort_pay" name='other_mort_pay' placeholder="Monthly Payment" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_mort_pay']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="other_mort_tel" name='other_mort_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['other_mort_tel']):''; ?>'>
                      </div>
                  </div><hr>
                    <!--  Other Addresses END -->
                    <!-- BUSINESS ASPECT -->
                    <center><h3><b>BUSINESS ASPECTS</b></h3></center>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Business Name :</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="bus_name" name='bus_name' placeholder="Business Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['bus_name']):''; ?>'>
                    </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Type of Organization : </label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='org_type' id='org_type' data-allow-clear='true' data-placeholder="Select Type of Organization" data-selected='<?php echo !empty($trades)?htmlspecialchars($trades['org_type']):''; ?>' >
                        <option value='S'>Single Proprietor</option>
                        <option value='P'>Partnership</option>
                        <option value='C'>Corporation</option>
                        </select>
                      </div>
                      <label class="col-md-1 control-label">Date Est:</label>
                      <div class="col-md-3">
                        <input type="text"  value='<?php echo !empty($trades)?htmlspecialchars($trades['date_est']):''; ?>' class="form-control date_picker" id="date_est" name='date_est'>
                      </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Nature of Business :</label>
                    <div class="col-md-3">
                        <select class='form-control cbo' name='bus_nat' id='bus_nat' data-allow-clear='true' data-placeholder="Select Nature of Business" data-selected='<?php echo !empty($trades)?htmlspecialchars($trades['bus_nat']):''; ?>' >
                        <?php echo makeOptions($ind); ?>
                        </select>
                    </div>
                    </div><br>
                    <div class='form-group'>
                        <label class="col-md-3 control-label"><u>If Single Proprietor (w/ Spouse)</u></label>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Who manage the business?</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="sing_name" name='sing_name' placeholder="Name of Manager" value='<?php echo !empty($trades)?htmlspecialchars($trades['sing_name']):''; ?>'>
                    </div>
                    </div><br>
                    <div class='form-group'>
                        <label class="col-md-2 control-label"><u>If Partnership</u></label>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Name of the Partner :</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="part_name" name='part_name' placeholder="Name of Partner" value='<?php echo !empty($trades)?htmlspecialchars($trades['part_name']):''; ?>'>
                    </div>
                    <label class="col-md-2 control-label">Relationship with the borrower :</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="part_rel" name='part_rel' placeholder="Relationship" value='<?php echo !empty($trades)?htmlspecialchars($trades['part_rel']):''; ?>'>
                    </div>
                    </div><br>
                    <div class='form-group'>
                        <label class="col-md-2 control-label"><u>If Corporation</u></label>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Who manage the business?</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="corp_man_name" name='corp_man_name' placeholder="Name of Manager" value='<?php echo !empty($trades)?htmlspecialchars($trades['corp_man_name']):''; ?>'>
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Major Stockholder / Corporator :</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="corp_maj_name" name='corp_maj_name' placeholder="Name of Major Stockholder / Corporator" value='<?php echo !empty($trades)?htmlspecialchars($trades['corp_maj_name']):''; ?>'>
                    </div>
                    </div>
                    <div id='corp'>
                    <div class='form-group'>
                    <label class="col-md-4 control-label">List of Corporators </label>
                    </div>
                  <div class='form-group'>
                      <label class="col-md-11 control-label"> </label>
                      <div class="col-md-1">
                      <a href="javascript:new_corp()">
                      <button type='button' class='btn btn-warning' id='add_corp'><span class='fa fa-plus'/> Add </button></a>
                      </div>
                  </div>
                  <?php if(!empty($trades['corpo_name'])){
                      for($i = 0; $i < $c_corpo ; $i++) {?>
                  <div class='form-group'>
                  <label class="col-md-4 control-label">Name :</label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="corpo_name[]" name='corpo_name[]' placeholder="Name" value='<?php echo !empty($corpo_name)?htmlspecialchars($corpo_name[$i]):''; ?>' >
                      </div>
                        <label class="col-md-1 control-label">Position :</label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="corpo_pos[]" name='corpo_pos[]' placeholder="Position" value='<?php echo !empty($corpo_pos)?htmlspecialchars($corpo_pos[$i]):''; ?>' >
                      </div>
                  </div>
                  <div style="text-align:right;margin-right:40px;margin-top:-50px;"><a href="javascript:delIt3('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></div><div style="text-align:right;margin-right:40px;margin-top:0px;">&nbsp;</div>
                      <?php }}?>
                  </div>
                  <div id='new_corp' style="display:none">
                  <div class='form-group'>
                  <label class="col-md-4 control-label">Name :</label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="corpo_name[]" name='corpo_name[]' placeholder="Name">
                      </div>
                        <label class="col-md-1 control-label">Position :</label>
                      <div class="col-md-3">
                        <input type="text" class="form-control" id="corpo_pos[]" name='corpo_pos[]' placeholder="Position">
                      </div>
                  </div>
                  </div><hr>
                    <!-- BUSINESS ASPECT END -->
                    <!-- BUSINESS Address-->
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Office Address: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='off_add' id='off_add' placeholder='Office Address' ><?php echo !empty($trades)?htmlspecialchars($trades['off_add']):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Tel. No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="off_tel_no" name='off_tel_no' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_tel_no']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Cell Phone No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="off_cel_no" name='off_cel_no' placeholder="Cell Phone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_cel_no']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Length of Stay : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="off_leng_stay" name='off_leng_stay' placeholder="Length of Stay" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_leng_stay']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='off_acquire' value='Owned' <?php if($trades['off_acquire']=='Owned'){echo "checked";}?> > Owned
                    </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='off_acquire' value='Free' <?php if($trades['off_acquire']=='Free'){echo "checked";}?> > Provided free by:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Name:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="off_free_name" name='off_free_name' placeholder="Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_free_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Relationship:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="off_free_rel" name='off_free_rel' placeholder="Relationship" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_free_rel']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="off_free_tel" name='off_free_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_free_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='off_acquire' value='Rented' <?php if($trades['off_acquire']=='Rented'){echo "checked";}?> > Rented:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Landlord:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="off_rent_name" name='off_rent_name' placeholder="Landlord Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_rent_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Monthly Rental:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="off_rent_pay" name='off_rent_pay' placeholder="Monthly Rental" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_rent_pay']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="off_rent_tel" name='off_rent_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_rent_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='off_acquire' value='Mortgage' <?php if($trades['off_acquire']=='Mortgage'){echo "checked";}?> > Mortgage:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Bank / Financing:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="off_mort_name" name='off_mort_name' placeholder="Bank / Financing" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_mort_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Monthly Payment:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="off_mort_pay" name='off_mort_pay' placeholder="Monthly Payment" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_mort_pay']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="off_mort_tel" name='off_mort_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['off_mort_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Previous Address if less than 2 years: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='off_prev_add' id='off_prev_add' placeholder='Office Previous Address' ><?php echo !empty($trades)?htmlspecialchars($trades['off_prev_add']):''; ?></textarea>
                      </div>
                  </div><hr>
                    <!-- BUSINESS Address END -->
                    <!-- Garage Address -->
                    <div class='form-group'>
                     <label class="col-md-3 control-label">Garage / Warehouse Address: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='gar_add' id='gar_add' placeholder='Garage / Warehouse Address' ><?php echo !empty($trades)?htmlspecialchars($trades['gar_add']):''; ?></textarea>
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Tel. No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="gar_tel_no" name='gar_tel_no' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_tel_no']):''; ?>'>
                      </div>
                      <label class="col-md-2 control-label">Cell Phone No. : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="gar_cel_no" name='gar_cel_no' placeholder="Cell Phone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_cel_no']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Length of Stay : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control" id="gar_leng_stay" name='gar_leng_stay' placeholder="Length of Stay" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_leng_stay']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='gar_acquire' value='Owned' <?php if($trades['gar_acquire']=='Owned'){echo "checked";}?>> Owned
                    </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='gar_acquire' value='Free' <?php if($trades['gar_acquire']=='Free'){echo "checked";}?>> Provided free by:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Name:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="gar_free_name" name='gar_free_name' placeholder="Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_free_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Relationship:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="gar_free_rel" name='gar_free_rel' placeholder="Relationship" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_free_rel']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="gar_free_tel" name='gar_free_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_free_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='gar_acquire' value='Rented' <?php if($trades['gar_acquire']=='Rented'){echo "checked";}?> > Rented:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Landlord:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="gar_rent_name" name='gar_rent_name' placeholder="Landlord Name" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_rent_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Monthly Rental:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="gar_rent_pay" name='gar_rent_pay' placeholder="Monthly Rental" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_rent_pay']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="gar_rent_tel" name='gar_rent_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_rent_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                  <label class="col-md-2 control-label"></label>
                    <div class="col-md-3">
                        <input type='radio' name='gar_acquire' value='Mortgage' <?php if($trades['gar_acquire']=='Mortgage'){echo "checked";}?> > Mortgage:
                    </div>
                    </div>
                    <div class='form-group'>
                        <label class="col-md-4 control-label">Bank / Financing:</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="gar_mort_name" name='gar_mort_name' placeholder="Bank / Financing" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_mort_name']):''; ?>'>
                    </div>
                        <label class="col-md-1 control-label">Monthly Payment:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="gar_mort_pay" name='gar_mort_pay' placeholder="Monthly Payment" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_mort_pay']):''; ?>'>
                        </div>
                    </div>
                    <div class='form-group'>
                     <label class="col-md-4 control-label">Telephone Number : </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control tel" id="gar_mort_tel" name='gar_mort_tel' placeholder="Telephone Number" value='<?php echo !empty($trades)?htmlspecialchars($trades['gar_mort_tel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Previous Address if less than 2 years: </label>
                     <div class="col-md-8">
                        <textarea class='form-control' name='gar_prev_add' id='gar_prev_add' placeholder='Garage Previous Address' ><?php echo !empty($trades)?htmlspecialchars($trades['gar_prev_add']):''; ?></textarea>
                      </div>
                  </div><hr>
                    <!-- Garage Address END -->
                    <!-- Trade References-->
                    <div class='form-group'>
                        <label class="col-md-2 control-label">TRADE REFERENCES</label>
                    </div>
                    <div class='form-group'>
                    <label class="col-md-1 control-label"></label>
                    <div class="col-md-10">
                    <table id='ResultTable' class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th class='text-center'>Company</th>
                            <th class='text-center'>Tel. No.</th>
                            <th class='text-center'>Contact Person</th>
                            <th class='text-center'>Dealings</th>
                            <th class='text-center'>Monthly/Weekly Collection</th>
                            <th class='text-center'>
                                <a href="javascript:new_trade()">
                                <button type='button' class='btn btn-warning' id='add_char'><span class='fa fa-plus'/> Add </button></a>
                            </th>
                            </tr>
                        </thead>
                        <input type='hidden' id='del_trade' name='del_trade' value='0'/>
                        <tbody id='trade'>
                        <?php 
                      for($i = 0; $i < $c_trade ; $i++) {?>
                        <tr>
                        <td>
                        <input type="text" class="form-control" id="trade_comp[]" name='trade_comp[]' placeholder="Company Name" value='<?php echo !empty($trade_comp)?htmlspecialchars($trade_comp[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control tel" id="trade_tel[]" name='trade_tel[]' placeholder="Telephone Number" value='<?php echo !empty($trade_tel)?htmlspecialchars($trade_tel[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="trade_con[]" name='trade_con[]' placeholder="Contact Person" value='<?php echo !empty($trade_con)?htmlspecialchars($trade_con[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="trade_deal[]" name='trade_deal[]' placeholder="Dealings" value='<?php echo !empty($trade_deal)?htmlspecialchars($trade_deal[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="trade_coll[]" name='trade_coll[]' placeholder="Monthly/Weekly Collection" value='<?php echo !empty($trade_coll)?htmlspecialchars($trade_coll[$i]):''; ?>'>
                        </td>
                        <td align="center"><button type="button" class="btn btn-danger btn_trade"><span class="fa fa-remove"/></button></td>
                        </tr>
                      <?php }?>
                        <tr id='new_trade'  style="display:none">
                        <td>
                        <input type="text" class="form-control" id="trade_comp[]" name='trade_comp[]' placeholder="Company Name" >
                        </td>
                        <td>
                        <input type="text" class="form-control tel" id="trade_tel[]" name='trade_tel[]' placeholder="Telephone Number" >
                        </td>
                        <td>
                        <input type="text" class="form-control" id="trade_con[]" name='trade_con[]' placeholder="Contact Person">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="trade_deal[]" name='trade_deal[]' placeholder="Dealings" >
                        </td>
                        <td>
                        <input type="text" class="form-control" id="trade_coll[]" name='trade_coll[]' placeholder="Monthly/Weekly Collection" >
                        </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
                <div class='form-group'>
                    <label class="col-md-1 control-label"></label>
                    <div class="col-md-10">
                    <table id='ResultTable' class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th class='text-center'>Gasoline Station/Branch</th>
                            <th class='text-center'>Tel. No.</th>
                            <th class='text-center'>Contact Person</th>
                            <th class='text-center'>Monthly/Weekly Collection</th>
                            <th class='text-center'>
                                <a href="javascript:new_gas()">
                                <button type='button' class='btn btn-warning' id='add_char'><span class='fa fa-plus'/> Add </button></a>
                            </th>
                            </tr>
                        </thead>
                        <input type='hidden' id='del_gas' name='del_gas' value='0'/>
                        <tbody id='gas'>
                        <?php
                      for($i = 0; $i < $c_gas ; $i++) {?>
                        <tr>
                        <td>
                        <input type="text" class="form-control" id="gas_name[]" name='gas_name[]' placeholder="Gasoline Station/Branch" value='<?php echo !empty($gas_name)?htmlspecialchars($gas_name[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control tel" id="gas_tel[]" name='gas_tel[]' placeholder="Telephone Number" value='<?php echo !empty($gas_tel)?htmlspecialchars($gas_tel[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="gas_con[]" name='gas_con[]' placeholder="Contact Person" value='<?php echo !empty($gas_con)?htmlspecialchars($gas_con[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="gas_coll[]" name='gas_coll[]' placeholder="Monthly/Weekly Collection" value='<?php echo !empty($gas_coll)?htmlspecialchars($gas_coll[$i]):''; ?>'>
                        </td>
                        <td align="center"><button type="button" class="btn btn-danger btn_gas"><span class="fa fa-remove"/></button></td>
                        </tr>
                      <?php } ?>
                        <tr id='new_gas'  style="display:none">
                        <td>
                        <input type="text" class="form-control" id="gas_name[]" name='gas_name[]' placeholder="Gasoline Station/Branch">
                        </td>
                        <td>
                        <input type="text" class="form-control tel" id="gas_tel[]" name='gas_tel[]' placeholder="Telephone Number">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="gas_con[]" name='gas_con[]' placeholder="Contact Person">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="gas_coll[]" name='gas_coll[]' placeholder="Monthly/Weekly Collection">
                        </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div><hr>
                    <!-- Trade References END-->
                    <!-- Bank References-->
                    <div class='form-group'>
                        <label class="col-md-3 control-label">BANK REFERENCES (Savings and Current Account)</label>
                    </div>
                    <div class='form-group'>
                    <label class="col-md-1 control-label"></label>
                    <div class="col-md-10">
                    <table id='ResultTable' class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th class='text-center'>Bank Name</th>
                            <th class='text-center'>Branch</th>
                            <th class='text-center'>Account Type</th>
                            <th class='text-center'>Date Opened</th>
                            <th class='text-center'>Average Balance</th>
                            <th class='text-center'>
                                <a href="javascript:new_bank()">
                                <button type='button' class='btn btn-warning' id='add_char'><span class='fa fa-plus'/> Add </button></a>
                            </th>
                            </tr>
                        </thead>
                        <input type='hidden' id='del_bank' name='del_bank' value='0'/>
                        <tbody id='bank'>
                        <?php
                      for($i = 0; $i < $c_bank ; $i++) {?>
                        <tr>
                        <td>
                        <input type="text" class="form-control" id="bank_name[]" name='bank_name[]' placeholder="Bank Name" value='<?php echo !empty($bank_name)?htmlspecialchars($bank_name[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="bank_branch[]" name='bank_branch[]' placeholder="Bank Branch" value='<?php echo !empty($bank_branch)?htmlspecialchars($bank_branch[$i]):''; ?>' >
                        </td>
                        <td>
                        <input type="text" class="form-control" id="bank_acct[]" name='bank_acct[]' placeholder="Account Type" value='<?php echo !empty($bank_acct)?htmlspecialchars($bank_acct[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text"  value='<?php echo !empty($bank_date)?htmlspecialchars($bank_date[$i]):''; ?>' class="form-control date_picker" id="bank_date[]" name='bank_date[]'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="bank_ave[]" name='bank_ave[]' placeholder="Average Balance" value='<?php echo !empty($bank_ave)?htmlspecialchars($bank_ave[$i]):''; ?>'>
                        </td>
                        <td align="center"><button type="button" class="btn btn-danger btn_bank"><span class="fa fa-remove"/></button></td>
                        </tr>
                        <?php } ?>
                        <tr id='new_bank'  style="display:none">
                        <td>
                        <input type="text" class="form-control" id="bank_name[]" name='bank_name[]' placeholder="Bank Name">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="bank_branch[]" name='bank_branch[]' placeholder="Bank Branch">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="bank_acct[]" name='bank_acct[]' placeholder="Account Type">
                        </td>
                        <td>
                        <input type="text" class="form-control date_picker" id="bank_date[]" name='bank_date[]'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="bank_ave[]" name='bank_ave[]' placeholder="Average Balance">
                        </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div><hr>
                    <!-- Bank References END-->
                <!-- Loans References-->
                <div class='form-group'>
                        <label class="col-md-3 control-label">LOANS - EXISTING / FULLY PAID</label>
                    </div>
                    <div class='form-group'>
                    <label class="col-md-1 control-label"></label>
                    <div class="col-md-10">
                    <table id='ResultTable' class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th class='text-center'>Bank/Financing</th>
                            <th class='text-center'>Branch</th>
                            <th class='text-center'>Facility</th>
                            <th class='text-center'>Amount Finance</th>
                            <th class='text-center'>Terms</th>
                            <th class='text-center'>Date Granted</th>
                            <th class='text-center'>Balance</th>
                            <th class='text-center'>
                                <a href="javascript:new_loan_bank()">
                                <button type='button' class='btn btn-warning' id='add_char'><span class='fa fa-plus'/> Add </button></a>
                            </th>
                            </tr>
                        </thead>
                        <input type='hidden' id='del_loanbank' name='del_loanbank' value='0'/>
                        <tbody id='loan_bank'>
                        <?php
                      for($i = 0; $i < $c_loanbank ; $i++) {?>
                        <tr>
                        <td>
                        <input type="text" class="form-control" id="loan_bank_name[]" name='loan_bank_name[]' placeholder="Bank / Financing" value='<?php echo !empty($loan_bank_name)?htmlspecialchars($loan_bank_name[$i]):''; ?>' >
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_bank_branch[]" name='loan_bank_branch[]' placeholder="Branch" value='<?php echo !empty($loan_bank_branch)?htmlspecialchars($loan_bank_branch[$i]):''; ?>' >
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_bank_fac[]" name='loan_bank_fac[]' placeholder="Facility" value='<?php echo !empty($loan_bank_fac)?htmlspecialchars($loan_bank_fac[$i]):''; ?>' >
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_bank_amt[]" name='loan_bank_amt[]' placeholder="Amount Finance" value='<?php echo !empty($loan_bank_amt)?htmlspecialchars($loan_bank_amt[$i]):''; ?>' >
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_bank_term[]" name='loan_bank_term[]' placeholder="Terms" value='<?php echo !empty($loan_bank_term)?htmlspecialchars($loan_bank_term[$i]):''; ?>' >
                        </td>
                        <td>
                        <input type="text"  value='<?php echo !empty($loan_bank_date)?htmlspecialchars($loan_bank_date[$i]):''; ?>' class="form-control date_picker" id="loan_bank_date[]" name='loan_bank_date[]'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_bank_bal[]" name='loan_bank_bal[]' placeholder="Balance" value='<?php echo !empty($loan_bank_bal)?htmlspecialchars($loan_bank_bal[$i]):''; ?>' >
                        </td>
                        <td align="center"><button type="button" class="btn btn-danger btn_loanbank"><span class="fa fa-remove"/></button></td>
                        </tr>
                        <?php } ?>
                        <tr id='new_loan_bank'  style="display:none">
                        <td>
                        <input type="text" class="form-control" id="loan_bank_name[]" name='loan_bank_name[]' placeholder="Bank / Financing">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_bank_branch[]" name='loan_bank_branch[]' placeholder="Branch">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_bank_fac[]" name='loan_bank_fac[]' placeholder="Facility">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_bank_amt[]" name='loan_bank_amt[]' placeholder="Amount Finance">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_bank_term[]" name='loan_bank_term[]' placeholder="Terms">
                        </td>
                        <td>
                        <input type="text" class="form-control date_picker" id="loan_bank_date[]" name='loan_bank_date[]'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_bank_bal[]" name='loan_bank_bal[]' placeholder="Balance">
                        </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
                <div class='form-group'>
                    <label class="col-md-1 control-label"></label>
                    <div class="col-md-10">
                    <table id='ResultTable' class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th class='text-center'>Individual Person</th>
                            <th class='text-center'>Contact No.</th>
                            <th class='text-center'>Amount Finance</th>
                            <th class='text-center'>Terms</th>
                            <th class='text-center'>Date Granted</th>
                            <th class='text-center'>Balance</th>
                            <th class='text-center'>
                                <a href="javascript:new_loan_ind()">
                                <button type='button' class='btn btn-warning' id='add_char'><span class='fa fa-plus'/> Add </button></a>
                            </th>
                            </tr>
                        </thead>
                        <input type='hidden' id='del_loanind' name='del_loanind' value='0'/>
                        <tbody id='loan_ind'>
                        <?php
                      for($i = 0; $i < $c_loanind ; $i++) {?>
                        <tr>
                        <td>
                        <input type="text" class="form-control" id="loan_ind_name[]" name='loan_ind_name[]' placeholder="Indvidual Person" value='<?php echo !empty($loan_ind_name)?htmlspecialchars($loan_ind_name[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_ind_con[]" name='loan_ind_con[]' placeholder="Contact Number" value='<?php echo !empty($loan_ind_con)?htmlspecialchars($loan_ind_con[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_ind_amt[]" name='loan_ind_amt[]' placeholder="Amount Finance" value='<?php echo !empty($loan_ind_amt)?htmlspecialchars($loan_ind_amt[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_ind_term[]" name='loan_ind_term[]' placeholder="Terms" value='<?php echo !empty($loan_ind_term)?htmlspecialchars($loan_ind_term[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text"  value='<?php echo !empty($loan_ind_date)?htmlspecialchars($loan_ind_date[$i]):''; ?>' class="form-control date_picker" id="loan_ind_date[]" name='loan_ind_date[]'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_ind_bal[]" name='loan_ind_bal[]' placeholder="Balance" value='<?php echo !empty($loan_ind_bal)?htmlspecialchars($loan_ind_bal[$i]):''; ?>'>
                        </td>
                        <td align="center"><button type="button" class="btn btn-danger btn_loanind"><span class="fa fa-remove"/></button></td>
                        </tr>
                        <?php } ?>
                        <tr id='new_loan_ind'  style="display:none">
                        <td>
                        <input type="text" class="form-control" id="loan_ind_name[]" name='loan_ind_name[]' placeholder="Indvidual Person">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_ind_con[]" name='loan_ind_con[]' placeholder="Contact Number">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_ind_amt[]" name='loan_ind_amt[]' placeholder="Amount Finance">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_ind_term[]" name='loan_ind_term[]' placeholder="Terms">
                        </td>
                        <td>
                        <input type="text" class="form-control date_picker" id="loan_ind_date[]" name='loan_ind_date[]'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="loan_ind_bal[]" name='loan_ind_bal[]' placeholder="Balance">
                        </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div><hr>
                    <!-- Loans References END-->
                    <!-- Vehicles Owned-->
                    <div class='form-group'>
                        <label class="col-md-2 control-label">VEHICLES OWNED</label>
                    </div>
                    <div class='form-group'>
                    <label class="col-md-1 control-label"></label>
                    <div class="col-md-10">
                    <table id='ResultTable' class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th class='text-center'>Brand/Model</th>
                            <th class='text-center'>Year Acquired</th>
                            <th class='text-center'>Bank/Financing/Branch</th>
                            <th class='text-center'>Amount Finance</th>
                            <th class='text-center'>Terms</th>
                            <th class='text-center'>
                                <a href="javascript:new_veh()">
                                <button type='button' class='btn btn-warning' id='add_char'><span class='fa fa-plus'/> Add </button></a>
                            </th>
                            </tr>
                        </thead>
                        <input type='hidden' id='del_veh' name='del_veh' value='0'/>
                        <tbody id='veh'>
                        <?php
                      for($i = 0; $i < $c_veh ; $i++) {?>
                        <tr>
                        <td>
                        <input type="text" class="form-control" id="veh_brand[]" name='veh_brand[]' placeholder="Brand/Model" value='<?php echo !empty($veh_brand)?htmlspecialchars($veh_brand[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="veh_year[]" name='veh_year[]' placeholder="Year Acquired" value='<?php echo !empty($veh_year)?htmlspecialchars($veh_year[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="veh_bank[]" name='veh_bank[]' placeholder="Bank/Financing/Branch" value='<?php echo !empty($veh_bank)?htmlspecialchars($veh_bank[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="veh_amt[]" name='veh_amt[]' placeholder="Amount Finance" value='<?php echo !empty($veh_amt)?htmlspecialchars($veh_amt[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="veh_term[]" name='veh_term[]' placeholder="Terms" value='<?php echo !empty($veh_term)?htmlspecialchars($veh_term[$i]):''; ?>'>
                        </td>
                        <td align="center"><button type="button" class="btn btn-danger btn_veh"><span class="fa fa-remove"/></button></td>
                        </tr>
                        <?php } ?>
                        <tr id='new_veh'  style="display:none">
                        <td>
                        <input type="text" class="form-control" id="veh_brand[]" name='veh_brand[]' placeholder="Brand/Model">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="veh_year[]" name='veh_year[]' placeholder="Year Acquired" >
                        </td>
                        <td>
                        <input type="text" class="form-control" id="veh_bank[]" name='veh_bank[]' placeholder="Bank/Financing/Branch">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="veh_amt[]" name='veh_amt[]' placeholder="Amount Finance">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="veh_term[]" name='veh_term[]' placeholder="Terms">
                        </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div><hr>
                    <!-- Vehicles Owned END-->
                <!-- Real Estate-->
                <div class='form-group'>
                        <label class="col-md-2 control-label">REAL ESTATE OWNED</label>
                    </div>
                    <div class='form-group'>
                    <label class="col-md-1 control-label"></label>
                    <div class="col-md-10">
                    <table id='ResultTable' class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                            <th class='text-center'>Location</th>
                            <th class='text-center'>Sq.m.</th>
                            <th class='text-center'>Year Acquired</th>
                            <th class='text-center'>Bank/Financing/Branch</th>
                            <th class='text-center'>Amount Finance</th>
                            <th class='text-center'>Terms</th>
                            <th class='text-center'>
                                <a href="javascript:new_real()">
                                <button type='button' class='btn btn-warning' id='add_char'><span class='fa fa-plus'/> Add </button></a>
                            </th>
                            </tr>
                        </thead>
                        <input type='hidden' id='del_real' name='del_real' value='0'/>
                        <tbody id='real'>
                        <?php
                      for($i = 0; $i < $c_real ; $i++) {?>
                        <tr>
                        <td>
                        <input type="text" class="form-control" id="real_loc[]" name='real_loc[]' placeholder="Location" value='<?php echo !empty($real_loc)?htmlspecialchars($real_loc[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="real_sq[]" name='real_sq[]' placeholder="Sq.m." value='<?php echo !empty($real_sq)?htmlspecialchars($real_sq[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="real_year[]" name='real_year[]' placeholder="Year Acquired" value='<?php echo !empty($real_year)?htmlspecialchars($real_year[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="real_bank[]" name='real_bank[]' placeholder="Bank/Financing/Branch" value='<?php echo !empty($real_bank)?htmlspecialchars($real_bank[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="real_amt[]" name='real_amt[]' placeholder="Amount Finance" value='<?php echo !empty($real_amt)?htmlspecialchars($real_amt[$i]):''; ?>'>
                        </td>
                        <td>
                        <input type="text" class="form-control" id="real_term[]" name='real_term[]' placeholder="Terms" value='<?php echo !empty($real_term)?htmlspecialchars($real_term[$i]):''; ?>'>
                        </td>
                        <td align="center"><button type="button" class="btn btn-danger btn_real"><span class="fa fa-remove"/></button></td>
                        </tr>
                        <?php } ?>
                        <tr id='new_real'  style="display:none">
                        <td>
                        <input type="text" class="form-control" id="real_loc[]" name='real_loc[]' placeholder="Location" >
                        </td>
                        <td>
                        <input type="text" class="form-control" id="real_sq[]" name='real_sq[]' placeholder="Sq.m.">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="real_year[]" name='real_year[]' placeholder="Year Acquired">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="real_bank[]" name='real_bank[]' placeholder="Bank/Financing/Branch">
                        </td>
                        <td>
                        <input type="text" class="form-control" id="real_amt[]" name='real_amt[]' placeholder="Amount Finance" >
                        </td>
                        <td>
                        <input type="text" class="form-control" id="real_term[]" name='real_term[]' placeholder="Terms" >
                        </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div><hr>
                    <!-- Real Estate END-->
                    <div class="col-md-4 col-md-offset-0">
                        <b>What is your other source of payment?</b>
                    </div>
                    <div class='form-group'> 
                    <div class="col-md-10 col-md-offset-1">
                        <textarea class='form-control' name='sour_pay' id='sour_pay' placeholder='Other source of payment' ><?php echo !empty($trades)?htmlspecialchars($trades['sour_pay']):''; ?></textarea>
                      </div>
                      </div>
                      <div class="col-md-11 col-md-offset-0">
                        <b>Is this loan for your own use or an accomodation to your relatives or friend?</b>
                    </div>
                    <div class='form-group'> 
                    <div class="col-md-10 col-md-offset-1">
                        <textarea class='form-control' name='loan_for' id='loan_for' placeholder='Loan Purpose' ><?php echo !empty($trades)?htmlspecialchars($trades['loan_for']):''; ?></textarea>
                      </div>
                      </div>
                      <div class="col-md-11 col-md-offset-0">
                        <b>Do you have any court cases filed by the bank or financing company? If any, for what reason?</b>
                    </div>
                    <div class='form-group'> 
                    <div class="col-md-10 col-md-offset-1">
                        <textarea class='form-control' name='court_case' id='court_case' placeholder='Court Cases' ><?php echo !empty($trades)?htmlspecialchars($trades['court_case']):''; ?></textarea>
                      </div>
                      </div>
                      <div class='form-group'>
                     <label class="col-md-3 control-label">Manner of Interview : </label>
                      <div class="col-md-4">
                      <select class='form-control cbo' name='int_type' id='int_type' data-allow-clear='true' data-placeholder="Select Manner of Interview" data-selected='<?php echo !empty($trades)?htmlspecialchars($trades['int_type']):''; ?>' >
                        <option value='Telephone'>Telephone</option>
                        <option value='Personal'>Personal</option>
                        </select>
                      </div>
                      </div>
                      <div class='form-group'>
                     <label class="col-md-3 control-label">Informant : </label>
                      <div class="col-md-4">
                          <input type="text" class="form-control" id="informant" name='informant' placeholder="(if not the borrower)" value='<?php echo !empty($trades)?htmlspecialchars($trades['informant']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Relationship to the Borrower : </label>
                      <div class="col-md-4">
                          <input type="text" class="form-control" id="bor_rel" name='bor_rel' placeholder="Relationship to the Borrower" value='<?php echo !empty($trades)?htmlspecialchars($trades['bor_rel']):''; ?>' >
                      </div>
                  </div>
                  <div class='form-group'>
                     <label class="col-md-3 control-label">Date of Interview : </label>
                      <div class="col-md-4">
                      <input type="text"  value='<?php echo !empty($trades)?htmlspecialchars($trades['int_date']):''; ?>' class="form-control date_picker" id="int_date" name='int_date' required>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-10 col-md-offset-1 text-center">
                    <button type='submit' class='btn btn-warning'>Save </button>
                    </div>
                </div>   
                </form>
<?php
    $request_type="submit_ci";
    require_once("../include/modal_trade_check.php");
?>
<?php 
  if(!empty($trades)):
?>
<script type="text/javascript">
  $(function(){
    $('#hide').collapse({
      toggle: true
    })    
  });
</script>
<?php
  endif;
?>
<script type="text/javascript">
	function redirect(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/journal_entry.php?id=" + id;
		window.location=string;
	};
	
	function archive(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/php/archive.php?id=" + id;
		window.location=string;
	}
	
	function edit(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/create_loan.php?id=" + id;
		window.location=string;
	}
	    function filter_search()
    {
            dttable.ajax.reload();
            //console.log(dttable);
    }
</script>
<script>
/*
This script is identical to the above JavaScript function.
*/
var ct = 1;
function new_link()
{
	ct++;
	var div1 = document.createElement('div');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<div style="text-align:right;margin-right:40px;margin-top:-50px;"><a href="javascript:delIt('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></div><div style="text-align:right;margin-right:40px;margin-top:0px;">&nbsp;</div>';
	div1.innerHTML = document.getElementById('new_child').innerHTML + delLink;
	document.getElementById('child').appendChild(div1);
}
// function to delete the newly added set of elements
function delIt(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('child');
	parentEle.removeChild(ele);
}
/*
SIBLING FUNCTION.
*/
var ct = 1;
function new_sib()
{
	ct++;
	var div1 = document.createElement('div');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<div style="text-align:right;margin-right:40px;margin-top:-60px;"><a href="javascript:delIt1('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></div><div style="text-align:right;margin-right:40px;margin-top:0px;">&nbsp;</div>';
	div1.innerHTML = document.getElementById('new_sib').innerHTML + delLink;
	document.getElementById('sib').appendChild(div1);
}
// function to delete the newly added set of elements
function delIt1(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('sib');
	parentEle.removeChild(ele);
}
/*
Character Reference Function.
*/
var ct = 1;
function new_char()
{
	ct++;
	var div1 = document.createElement('div');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<div style="text-align:right;margin-right:40px;margin-top:-60px;"><a href="javascript:delIt2('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></div><div style="text-align:right;margin-right:40px;margin-top:0px;">&nbsp;</div>';
	div1.innerHTML = document.getElementById('new_char').innerHTML + delLink;
	document.getElementById('char').appendChild(div1);
}
// function to delete the newly added set of elements
function delIt2(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('char');
	parentEle.removeChild(ele);
}
/*
List of Corporators Function.
*/
var ct = 1;
function new_corp()
{
	ct++;
	var div1 = document.createElement('div');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<div style="text-align:right;margin-right:40px;margin-top:-50px;"><a href="javascript:delIt3('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></div><div style="text-align:right;margin-right:40px;margin-top:0px;">&nbsp;</div>';
	div1.innerHTML = document.getElementById('new_corp').innerHTML + delLink;
	document.getElementById('corp').appendChild(div1);
}
// function to delete the newly added set of elements
function delIt3(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('corp');
	parentEle.removeChild(ele);
}
/*
List of Trade Reference Function.
*/
var ct = 1;
function new_trade()
{
	ct++;
	var div1 = document.createElement('tr');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<td align="center"><a href="javascript:delIt4('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></td>';
	div1.innerHTML = document.getElementById('new_trade').innerHTML + delLink;
	document.getElementById('trade').appendChild(div1);
    $(".tel").inputmask("999-9999", {"placeholder": "###-####"});
}
// function to delete the newly added set of elements
function delIt4(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('trade');
	parentEle.removeChild(ele);
}
/*
List of Gas Function.
*/
var ct = 1;
function new_gas()
{
	ct++;
	var div1 = document.createElement('tr');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<td align="center"><a href="javascript:delIt5('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></td>';
	div1.innerHTML = document.getElementById('new_gas').innerHTML + delLink;
	document.getElementById('gas').appendChild(div1);
    $(".tel").inputmask("999-9999", {"placeholder": "###-####"});
}
// function to delete the newly added set of elements
function delIt5(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('gas');
	parentEle.removeChild(ele);
}
/*
List of Bank Function.
*/
var ct = 1;
function new_bank()
{
	ct++;
	var div1 = document.createElement('tr');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<td align="center"><a href="javascript:delIt5('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></td>';
	div1.innerHTML = document.getElementById('new_bank').innerHTML + delLink;
	document.getElementById('bank').appendChild(div1);
    $('.date_picker').datepicker();  
        $(".date_picker").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        $(".tel").inputmask("999-9999", {"placeholder": "###-####"});
}
// function to delete the newly added set of elements
function delIt5(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('bank');
	parentEle.removeChild(ele);
}
/*
List of Loan Bank Function.
*/
var ct = 1;
function new_loan_bank()
{
	ct++;
	var div1 = document.createElement('tr');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<td align="center"><a href="javascript:delIt6('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></td>';
	div1.innerHTML = document.getElementById('new_loan_bank').innerHTML + delLink;
	document.getElementById('loan_bank').appendChild(div1);
    $('.date_picker').datepicker();  
        $(".date_picker").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        $(".tel").inputmask("999-9999", {"placeholder": "###-####"});
}
// function to delete the newly added set of elements
function delIt6(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('loan_bank');
	parentEle.removeChild(ele);
}
/*
List of Loan Individual Function.
*/
var ct = 1;
function new_loan_ind()
{
	ct++;
	var div1 = document.createElement('tr');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<td align="center"><a href="javascript:delIt7('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></td>';
	div1.innerHTML = document.getElementById('new_loan_ind').innerHTML + delLink;
	document.getElementById('loan_ind').appendChild(div1);
    $('.date_picker').datepicker();  
        $(".date_picker").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        $(".tel").inputmask("999-9999", {"placeholder": "###-####"});
}
// function to delete the newly added set of elements
function delIt7(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('loan_ind');
	parentEle.removeChild(ele);
}
/*
List of Vehicles Owned Function.
*/
var ct = 1;
function new_veh()
{
	ct++;
	var div1 = document.createElement('tr');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<td align="center"><a href="javascript:delIt8('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></td>';
	div1.innerHTML = document.getElementById('new_veh').innerHTML + delLink;
	document.getElementById('veh').appendChild(div1);
    $('.date_picker').datepicker();  
        $(".date_picker").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        $(".tel").inputmask("999-9999", {"placeholder": "###-####"});
}
// function to delete the newly added set of elements
function delIt8(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('veh');
	parentEle.removeChild(ele);
}
/*
List of Real Estate Function.
*/
var ct = 1;
function new_real()
{
	ct++;
	var div1 = document.createElement('tr');
	div1.id = ct;
	// link to delete extended form elements
	var delLink = '<td align="center"><a href="javascript:delIt9('+ ct +')"><button type="button" class="btn btn-danger"><span class="fa fa-remove"/></button></a></td>';
	div1.innerHTML = document.getElementById('new_real').innerHTML + delLink;
	document.getElementById('real').appendChild(div1);
    $('.date_picker').datepicker();  
        $(".date_picker").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        $(".tel").inputmask("999-9999", {"placeholder": "###-####"});
}
// function to delete the newly added set of elements
function delIt9(eleId)
{
	d = document;
	var ele = d.getElementById(eleId);
	var parentEle = d.getElementById('real');
	parentEle.removeChild(ele);
}
$(".btn_trade").click(function(){
    $(this).closest("tr").remove();
    var amt1 = parseInt($('input[name=del_trade]').val());
    var add=1;
    $('#del_trade').val(amt1 + add);
});
$(".btn_gas").click(function(){
    $(this).closest("tr").remove();
    var amt1 = parseInt($('input[name=del_gas]').val());
    var add=1;
    $('#del_gas').val(amt1 + add);
});
$(".btn_bank").click(function(){
    $(this).closest("tr").remove();
    var amt1 = parseInt($('input[name=del_bank]').val());
    var add=1;
    $('#del_bank').val(amt1 + add);
});
$(".btn_loanbank").click(function(){
    $(this).closest("tr").remove();
    var amt1 = parseInt($('input[name=del_loanbank]').val());
    var add=1;
    $('#del_loanbank').val(amt1 + add);
});
$(".btn_loanind").click(function(){
    $(this).closest("tr").remove();
    var amt1 = parseInt($('input[name=del_loanind]').val());
    var add=1;
    $('#del_loanind').val(amt1 + add);
});
$(".btn_veh").click(function(){
    $(this).closest("tr").remove();
    var amt1 = parseInt($('input[name=del_veh]').val());
    var add=1;
    $('#del_veh').val(amt1 + add);
});
$(".btn_real").click(function(){
    $(this).closest("tr").remove();
    var amt1 = parseInt($('input[name=del_real]').val());
    var add=1;
    $('#del_real').val(amt1 + add);
});
$("#dealer").on('change',function(){
        if(document.getElementById("dealer").selectedIndex > 0){
            $("#salesman").attr('disabled',false);
        }else{
            $("#salesman").attr('disabled',true);
        }
    });

    $("#civil_status").on('change',function(){
        if(document.getElementById("civil_status").selectedIndex > 1){
            $("#spouse_name").attr('disabled',false);
            $("#spouse_name").attr('required',true);
            $("#spouse_hide").show();
        }else{
            $("#spouse_name").attr('disabled',true);
            document.getElementById("spouse_name").value="";
            $("#spouse_name").attr('required',false);
            $("#spouse_hide").hide();
        }
    });

    function printExternal(url) {
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
        printWindow.close();
    }, true);
}
</script>
<?php
Modal();
makeFoot(WEBAPP,1);
?>