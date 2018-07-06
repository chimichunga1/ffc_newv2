<?php
  require_once('../support/config.php');
  if(!isLoggedIn()){
        toLogin();
        die();
    }
        
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Business Write-up Form",1);
    
    
    require_once("../template/header.php");
    require_once("../template/sidebar.php");
    $user_id=$_SESSION[WEBAPP]['user']['user_id'];
    if(!empty($_GET['id'])){
        $user=$con->myQuery("SELECT CONCAT(first_name,' ',middle_initial,' ',last_name) as prepared_by FROM users
        WHERE user_id=?",array($user_id))->fetch(PDO::FETCH_ASSOC);
		$loan=$con->myQuery("SELECT ll.id,ll.app_type,ll.app_no,ll.client_no,ll.last_name,
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
         WHERE ll.id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);

        $client=$con->myQuery("SELECT cl.client_number AS id,CONCAT(cl.lname,', ',cl.fname,' ',cl.mname) AS client_name,
        ic.name AS ind_corp,id.name AS ind_code,bt.name AS bus_type,c.name AS country,r.name AS region,
        cl.birthdate,cl.gender,cs.name AS civil_status,cl.spouse,cl.tin_no,cl.sss_no,cl.acr_no,cl.pagibig_no,cl.rescert_no,
        cl.rescert_date,cl.rescert_place,cl.con_name,cl.con_rescert_no,cl.con_rescert_date,cl.con_rescert_place,
        CONCAT(cl.home_no,' ',cl.home_brgy,', ',cl.home_city,' ',cl.home_zip) AS home_add,
        CONCAT(cl.bus_no,' ',cl.bus_brgy,', ',cl.bus_city,' ',cl.bus_zip) AS bus_add,
        cl.email,cl.fax_no,cl.bus_tel,cl.home_tel,cl.pri_con,cl.sec_con
        FROM client_list cl 
        JOIN industry_corp ic ON ic.id=cl.ind_corp_id
        JOIN industry_code id ON id.id=cl.ind_code_id
        JOIN business_type bt ON bt.id=cl.bus_type_id
        JOIN country c ON c.id=cl.country_id
        JOIN region r ON r.id=cl.region_id
        JOIN civil_status cs ON cs.id=cl.civil_status_id
        WHERE cl.client_number=?",array($loan['client_no']))->fetch(PDO::FETCH_ASSOC);

        $caf=$con->myQuery("SELECT * FROM caf_info
        WHERE app_no=?",array($loan['id']))->fetch(PDO::FETCH_ASSOC);

        $bwu=$con->myQuery("SELECT * FROM cred_app_bwu
        WHERE loan_id=?",array($loan['id']))->fetch(PDO::FETCH_ASSOC);
    
    $bwu_files=$con->myQuery("SELECT * FROM bwu_files WHERE is_deleted='0' AND loan_id=?",array($_GET['id']))->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<div class="content-wrapper">
  
<section class="content-header">
  <?php
    Alert();
    
  ?>
  <div class="box">
  <div class="box-body">
  <center>
  <h3> Business Write-up Form </h3>
  </center>
  <hr>
  <a href='reco_app.php'>
  <button type='button' class="btn btn-default"><span class="fa fa-arrow-left"></span> Back</button></a><br><br>
      <div class="row" id='div1'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <table style='margin-left: 10%;'>
					<tr><td width='15%'>REPORT DATE </td><td>:</td><td> <?php echo date('F d, Y'); ?></td></tr>
					<tr><td>APPLICATION DATE </td><td>:</td><td><?php echo date_format(date_create($loan['date_applied']),'F d, Y'); ?></td></tr>
                    <tr><td>APPLICATION NO. </td><td>:</td><td><?php echo $loan['app_no']; ?></td></tr>
					<tr><td>BORROWER</td><td>:</td><td> <b><?php echo $client['client_name'];?></b></td></tr>
					<tr><td>ADDRESS</td><td>:</td><td> <?php echo $client['home_add']; ?></td></tr>
					<!-- <tr><td><b>PRINCIPAL</td><td>:</td><td><b><?php echo $loan['applied_by']; ?></td></tr>
                    <tr><td>ADDRESS</td><td>:</td><td>      </td></tr>
                    <tr><td>CONTACT NUMBER</td><td>:</td><td><?php echo $client['home_tel']."/".$client['pri_con']; ?>      </td></tr> -->
                </table><br>
                <div class="text-center">
            <a href="word.php?id=<?php echo $_GET['id'];?>"><button type="button" class="btn btn-success no-print">Download</button></a>
            </div><br>
            <form method="POST" action='../upload_file.php' enctype="multipart/form-data">
          <input type='hidden' name='loan_id' id='loan_id' value='<?php echo $_GET['id'];?>'>
          <input type='hidden' name='action' value='submit'>
          <input type='hidden' name='type' value='bwu'>
             <div class="form-group">
            <label for="purpose" class="col-sm-3 control-label text-right">Upload File: <br/> <small>Upload Limit: <?php echo ini_get('upload_max_filesize')."B";?> </small></label>
                <div class="col-sm-5">
                  <input type='file' name='file' class="filestyle" data-classButton=""  data-buttonName="btn btn-flat btn-default" data-input="true" data-classIcon="icon-plus" data-buttonText=" &nbsp;Select File" data-buttonBefore='true' required>
                </div>
                <button type="submit" class="btn btn-warning">Upload</button>
            </div>
        </form>
        	<div class="box-body" style='width: 70% !important; margin-left:10%;'>
		<table id='dataTables' class="table responsive-table table-bordered table-striped" >
			<thead>
				<tr >
					<th class='text-center'>File Name</th>
					<th class='text-center'>Action</th>
				</tr>
			</thead>
			<tbody style=' word-break: break-all;'>
                        <?php
                        if(!empty($bwu_files)){
                        foreach($bwu_files as $row):
                        ?>
                        <tr>
                            <td class='text-center'><?php echo htmlspecialchars($row['file_name'])?></td>
                            <td class='text-center'>
                            <a href='../php/delete.php?type=bwu_files&loan=<?php echo $_GET['id']?>&id=<?php echo $row['id']?>' onclick="return confirm('This file will be deleted.')" class='btn btn-danger'><span class='fa fa-trash'></span></a>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                        }
                        else{
                        ?>
                        <tr>
                            <td colspan='2'>No Records Found.</td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
		</table>
	</div>
                <!-- <div style='width:100%;border:3px solid black;margin:0;'>
                <table style='margin-left: 10%;'>
					<tr><td width='15%'>PROPOSAL</td><td>:</td><td>   </td></tr>
					<tr><td>TERMS</td><td>:</td><td><?php echo $caf['term']." months"; ?></td></tr>
					<tr><td>PURPOSE</td><td>:</td><td> <b> </b></td></tr>
					<tr><td>AGENT</td><td>:</td><td> <?php echo $caf['prepared_by']; ?></td></tr>
                </table>
                </div><br> -->
                <table style='margin-left: 10%;'><tr><td  width='15%'><h4><b>A. BUSINESS WRITE-UP</td></tr></table>
                <table><tr><td class='text-center'><b>OUR RELATIONS</td></tr>
                <tr><td>
                <div class='' id='our_relations' style=' word-wrap: break-word;'></div>
                </td></tr>
                </table><br>
                <div class='form-group'>
                     <label class="col-md-3 control-label">Client Number: </label>
                      <div class="col-md-3">
                          <input type="text" class="form-control numeric" id="client_no" name='client_no' placeholder="Client Number" value='<?php echo !empty($data)?htmlspecialchars($data['client_number']):''; ?>' readonly>
                      </div>
                      <label class="col-md-2 control-label">Ind / Corp: *</label>
                      <div class="col-md-3">
                      <select class='form-control cbo' name='ind_corp' id='ind_corp' data-placeholder="Select Ind / Corp" data-selected='<?php echo !empty($data)?htmlspecialchars($data['ind_corp_id']):''; ?>' required>
                                <?php echo makeOptions($ind_corp); ?>
                            </select>
                    </div>
                </div>
                <div id='statement'>
                <form method="POST" action='save_bwu.php' class="form-horizontal">
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <input type='hidden' name='bwu_id' id='bwu_id' value="<?php echo !empty($bwu['id'])?htmlspecialchars($bwu['id']):''?>">
                <input type='hidden' name='type' id='type' value="statement">
                <div class="form-group">
                <label for="address1" class="col-md-2 control-label">Note: </label>
                <div class="col-md-9">
                    <textarea class='form-control' name='note' id='note'  required><?php echo !empty($bwu)?htmlspecialchars($bwu['note']):''; ?></textarea>
                </div>
                </div>
                <div class="form-group">
                <label for="address1" class="col-md-2 control-label">Statement: </label>
                <div class="col-md-9">
                    <textarea class='form-control' name='statement' id='statement' rows='15' required><?php echo !empty($bwu)?htmlspecialchars($bwu['statement']):''; ?></textarea>
                </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-warning no-print">Save</button>
                </div>
            </form>
            </div>
            <hr>
            <table><tr><td class='text-center'><b>VEHICLES OWNED</td></tr>
                <tr><td>    
                <div class='' id='vehicles_owned' style=' word-wrap: break-word;'></div>
                </td></tr>
                </table><br>
            </div>
            <table style='margin-left: 10%;'><tr><td  width='15%'><h4><b>B. CASH FLOW ANALYSIS </td></tr></table><br>
            <div id='cash_flow'>
                <form method="POST" action='save_bwu.php' class="form-horizontal">
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <input type='hidden' name='bwu_id' id='bwu_id' value="<?php echo !empty($bwu['id'])?htmlspecialchars($bwu['id']):''?>">
                <input type='hidden' name='type' id='type' value="cash_flow">
                <div class="form-group">
                <label for="gross_inc" class="col-md-2 control-label">Aggregate Monthly Gross Income: *</label>
                <div class="col-md-3">
                    <input type="text" class="form-control numeric" id="gross_inc" name='gross_inc' placeholder="Gross Income" value='<?php echo !empty($bwu)?htmlspecialchars($bwu['gross_inc']):''; ?>' required>
                </div>
                <label for="net_inc" class="col-md-2 control-label">Net Income: </label>
                <div class="col-md-3">
                    <input type="text" class="form-control numeric" id="net_inc" name='net_inc' placeholder="Net Income" value='<?php echo !empty($bwu)?htmlspecialchars($bwu['net_inc']):''; ?>' readonly>
                </div>
                <button type="submit" class="btn btn-warning no-print">Save</button>
                </div>
            </form>
            </div>
            <!-- Cash Flow Div -->
            <div class='' id='cash_flow_less' style=' word-wrap: break-word;'></div><br>
            <!-- Cash flow Div End -->
            <hr>
            <table style='margin-left: 10%;'><tr><td  width='15%'><h4><b>C. STRENGTHS AND WEAKNESSES </td></tr></table><br>
            <div id='strengths'>
                <form method="POST" action='save_bwu.php' class="form-horizontal">
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <input type='hidden' name='bwu_id' id='bwu_id' value="<?php echo !empty($bwu['id'])?htmlspecialchars($bwu['id']):''?>">
                <input type='hidden' name='type' id='type' value="strengths">
                <div class="form-group">
                <label for="gross_inc" class="col-md-2 control-label">Strengths: *</label>
                <div class="col-md-9">
                    <textarea class='form-control' name='strength' id='strength' rows='5' required><?php echo !empty($bwu)?htmlspecialchars($bwu['strength']):''; ?></textarea>
                </div>
                </div>
                <div class="form-group">
                <label for="net_inc" class="col-md-2 control-label">Weakness: * </label>
                <div class="col-md-9">
                    <textarea class='form-control' name='weak' id='weak' rows='5' required><?php echo !empty($bwu)?htmlspecialchars($bwu['weak']):'';?></textarea>
                </div>
                </div>
            <table style='margin-left: 10%;'><tr><td  width='15%'><h4><b>D. RECOMMENDATION</td></tr></table>
                <div class="form-group">
                <label for="net_inc" class="col-md-2 control-label"> </label>
                <div class="col-md-9">
                    <textarea class='form-control' name='reco' id='reco' rows='3' required><?php echo !empty($bwu)?htmlspecialchars($bwu['reco']):'';?></textarea>
                </div>
                </div><br>
                <table style='margin-left: 10%;'>
                <tr><td  width='50%'>Prepared by:</td><td>Noted by:</td></tr>
                <tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
                <tr><td  width='15%'><b><?php echo $user['prepared_by'];?></td><td><b>Ramon R. Ramos</td></tr>
                </table><br><br>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-warning no-print">Save</button>
                </div>
            </form>
            </div>
  </div>
  </div>
</section>

 
</div>
<?php 
  if(!empty($_GET['tc'])):
?>
<script type="text/javascript">
  $(function(){
    $('#hide').collapse({
      toggle: true
    })    
  });
  $(document).ready(function() {
        $("#our_relations").load("../marketing/our_relations.php?id="+id+"&tc="+<?php echo $_GET['tc'];?>);
    });
</script>
<?php
  else:
?>
<script type="text/javascript">
  $(document).ready(function() {
        $("#our_relations").load("../marketing/our_relations.php?id="+id);
    });
</script>
<?php
  endif;
?>
<?php 
  if(!empty($_GET['vo'])):
?>
<script type="text/javascript">
  $(function(){
    $('#hide1').collapse({
      toggle: true
    })    
  });
  $(document).ready(function() {
        $("#vehicles_owned").load("../marketing/vehicles_owned.php?id="+id+"&vo="+<?php echo $_GET['vo'];?>);
    });
</script>
<?php
  else:
?>
<script type="text/javascript">
  $(document).ready(function() {
        $("#vehicles_owned").load("../marketing/vehicles_owned.php?id="+id);
    });
</script>
<?php
  endif;
?>
<?php 
  if(!empty($_GET['cfl'])):
?>
<script type="text/javascript">
  $(function(){
    $('#hide2').collapse({
      toggle: true
    })    
  });
  $(document).ready(function() {
        $("#cash_flow_less").load("../marketing/cash_flow_less.php?id="+id+"&cfl="+<?php echo $_GET['cfl'];?>);
    });
</script>
<?php
  else:
?>
<script type="text/javascript">
  $(document).ready(function() {
        $("#cash_flow_less").load("../marketing/cash_flow_less.php?id="+id);
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

    var id= document.getElementsByName("id")[0].value;
    $("#client_no").change(function(){
        $("#comment_table").html("<span class='fa fa-refresh fa-pulse'></span>")
            $("#comment_table").load("../marketing/ajax/autofill_form.php?id="+$("#client_no").val());
    });
    $("#lname").change(function(){
        $("#comment_table").html("<span class='fa fa-refresh fa-pulse'></span>")
            $("#comment_table").load("../marketing/ajax/autofill_form.php?id="+$("#client_no").val());
    });
</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>
