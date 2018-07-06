<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
    makeHead("Update Loan",1);
    if (empty($_GET['tab'])) {
          
        redirect("ci_checking.php");
    
    } elseif($_GET['tab'] < 1 || $_GET['tab'] > 6) {
        redirect("ci_checking.php");
    }
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
	$dl=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_dealer='checked'")->fetchAll(PDO::FETCH_ASSOC);
    $sm=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_salesman='checked'")->fetchAll(PDO::FETCH_ASSOC);
if(!empty($_GET['id'])){
    $data=$con->myQuery("SELECT * FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
		$client=$con->myQuery("SELECT * FROM client_list WHERE client_number=?",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);
		$cname=$client['lname'].", ".$client['fname']." ".$client['mname'];
		$home_add=$client['home_no']." ".$client['home_brgy'].", ".$client['home_city']." ".$client['home_zip'];
		$deal=$con->myQuery("SELECT CONCAT(lname,', ',fname,' ',ename,' ',mname) as name FROM client_list WHERE client_number=?",array($data['dealer_id']))->fetch(PDO::FETCH_ASSOC);
		$sale=$con->myQuery("SELECT CONCAT(lname,', ',fname,' ',ename,' ',mname) as name FROM client_list WHERE client_number=?",array($data['salesman_id']))->fetch(PDO::FETCH_ASSOC);
  }else {
    redirect("ci_checking.php");
}
if(empty($data)){
    redirect("ci_checking.php");
}
require_once("../template/header.php");
require_once("../template/sidebar.php");
?>

<div class="content-wrapper">
	
<section class="content-header">
	<?php
		Alert();
		
	?>
	<div class="box">
	<div class="box-body">
	<center>
	<h3> CI Checking Form </h3>
	</center>
	<a href='ci_checking.php'>
	<button type='button' class="btn btn-default"><span class="fa fa-arrow-left"></span> Employee Loan</button></a><br><br>
			<div class="row">
            <div class='col-md-12'>
		              <div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
		                	<li <?php if ($_GET['tab'] == 1) {echo "class='active'";} echo "><a href='ci_checking_form.php?id=".$_GET['id']."&tab=1'"; ?> >CI Checking</a>
		                    </li>
		                    <li <?php if ($_GET['tab'] == 2) {echo "class='active'";} echo "><a href='ci_checking_form.php?id=".$_GET['id']."&tab=2'"; ?> >Trade Checking</a>
		                    </li>
							<li <?php if ($_GET['tab'] == 3) {echo "class='active'";} echo "><a href='ci_checking_form.php?id=".$_GET['id']."&tab=3'"; ?> >Credit Checking   </a>
							</li>
							<li <?php if ($_GET['tab'] == 4) {echo "class='active'";} echo "><a href='ci_checking_form.php?id=".$_GET['id']."&tab=4'"; ?> >Neighborhood Checking</a>
		                    </li>
							<li <?php if ($_GET['tab'] == 5) {echo "class='active'";} echo "><a href='ci_checking_form.php?id=".$_GET['id']."&tab=5'"; ?> >Interviewer's Sheet</a>
		                    </li>
		                </ul>
		              </div>
		            </div>
				<div class="tab-content">
	            <div class="active tab-pane" >
	                    <?php
	                        switch ($_GET['tab']) {
							
	                        	case '1':
	                                #Project Details
	                               
	                                $form='create_loan.php';
								break;
								
	                            case '2':
	                                #Project Details
	                                $form='trade_checking.php';
								break;
								
	                            case '3':
	                                #Project Details
	                                $form='credit_checking.php';
								break;
								
								case '4':
								$form = 'neighbor_checking.php';
								break;

								case '5':
								$form = 'interview_sheet.php';
								break;

	                        }
	                        require_once($form);
	                    ?>
	            </div>
</div>
            </div>		
		</div>
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
