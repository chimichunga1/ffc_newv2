<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }makeHead("Checklist Entry/Update",1);
    require_once("../template/header.php");
require_once("../template/sidebar.php");
    

    $ind_corp=$con->myQuery("SELECT id,name FROM industry_corp WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $cv=$con->myQuery("SELECT id,name FROM civil_status WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $bt=$con->myQuery("SELECT id,name FROM business_type WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $country=$con->myQuery("SELECT id,name FROM country WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $ind_code=$con->myQuery("SELECT id,name FROM industry_code WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $reg=$con->myQuery("SELECT id,name FROM region WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $ct=$con->myQuery("SELECT id,name FROM client_type WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $lt=$con->myQuery("SELECT lt.id,CONCAT(lt.code,' - ',lt.name) as lt_code FROM loan_approval_type lt WHERE lt.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $cf=$con->myQuery("SELECT cf.id,CONCAT(cf.code,' - ',cf.name) as cf_code FROM credit_facility cf WHERE cf.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $pl=$con->myQuery("SELECT pl.id,CONCAT(pl.code,' - ',pl.name) as pl_code FROM product_line pl WHERE pl.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $mt=$con->myQuery("SELECT mt.id,CONCAT(mt.code,' - ',mt.name) as mt_code FROM marketing_type mt WHERE mt.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
    $cc=$con->myQuery("SELECT cc.id,CONCAT(cc.code,' - ',cc.desc) as cc_code FROM collateral_code cc WHERE cc.is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);
if(!empty($_GET['id'])){
    $data=$con->myQuery("SELECT * FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
	$client=$con->myQuery("SELECT * FROM client_list WHERE client_number=?",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);
  }else {
	redirect("checklist_entry_update.php");
	Alert('User not found','warning');
}
$ml = "";
$link = "checklist_entry_update.php";
$btnName = "Checklist Entry/Update";
if(empty($data)){
	redirect("checklist_entry_update.php");
	Alert('User not found','warning');
	
}

if(isset($_GET['ml'])){
	$ml = "&ml";
	$link = "checklist_master_list.php";
	$btnName = "Checklist Master List";
}
$fullname = $client['fname'] . " " . $client['mname'] . " " . $client['lname'];
        $requirement = $con->myQuery("SELECT * FROM client_requirements_cf WHERE client_no=:client_no AND application_no=:app_no",array('client_no'=>$client['client_number'], 'app_no'=>$data['app_no']));

?>

<div class="content-wrapper">
	<?php Alert(); ?>
<section class="content-header">
	<div class="box">
	<div class="box-body">
	<center>
	<h3> Document Checklist Entry </h3>
	</center>
	<a href='<?php echo $link; ?>'>
	<button type='button' class="btn btn-default"><span class="fa fa-arrow-left"></span> <?php echo $btnName; ?> </button></a><br><br>

			<div class="row">
            <div class='col-md-12'>
                <form action="save_checklist.php" method="post" class="form-horizontal" id='frmclear'>
                <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                <input type="hidden" name="client_no" value="<?php echo $client['client_number'];?>">
                  <?php  if(empty($_GET['id'])){  ?>
                      <div class='' id='comment_table' style=' word-wrap: break-word;'>
                    </div>
                  <?php } else{?>

                    <div class='form-group'>
					<label class="col-md-3 control-label">Application Number: </label>
					<div class="col-md-3">
						<input type="text" class="form-control numeric" id="app_no" name='app_no' placeholder="Application Number" value='<?php echo !empty($data)?htmlspecialchars($data['app_no']) :''; ?>' readonly>
					</div>
                    <label for="" class="col-md-2 control-label">Name: </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="fullname" value="<?=$fullname;?>" readonly>
                    </div>
                  </div>
                  <div class="box-body">
		<table id='' class="table responsive-table table-bordered table-striped" >
			<thead>
				<tr >
					<th>Document Code</th>
					<th>Document Description</th>
					<th>Status</th>
					<th>Document Type</th>
				</tr>
			</thead>
			<tbody>
			<?php
                
                while($row = $requirement->fetch(PDO::FETCH_ASSOC)) :?>
                <tr >
                    <td><?php echo $row['requirement_code']; ?></td>
                    <td style="width:50%;"><?php echo $row['requirement_name']; ?></td>
                    <td>
                        <select name="status[<?php echo $row['requirement_code']; ?>]" id="" class="form-control cbo" data-placeholder="Select a status" style="width:150px" data-allow-clear="true" data-selected="<?php echo $row['status']; ?>" required>                        
                            <option value="received" >Received</option>
                            <option value="pending">Pending</option>
                            <option value="to_follow">To Follow</option>
                        </select>
                    </td>
                    <td>Credential Document</td>
                    
                </tr>
                  <?php endwhile; ?>
					
			</tbody>
		</table>
	</div>
                  
                    <?php }?>
                         <div class="form-group">
					      <div class="col-sm-11 col-md-offset-1 text-center">
                          <input type="hidden" name="submit" id="submit" value="submit">
						  <input type="hidden" name="ml" value="<?php echo $ml;?>";>
					      	<button type='submit' name="submit" class='btn btn-info'> Update </button>
					      	<a href='<?php echo $link; ?>' class='btn btn-default'>Cancel</a>
					      </div>
					    </div>
                </form>
	            </div>
</div>
</section>

 
</div>



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

<?php
Modal();
makeFoot(WEBAPP,1);
?>
