<?php
	require_once('../support/config.php');
	if(isLoggedIn()&&isset($_GET['id'])){
		$id = $_GET['id'];
		$table="";
		switch ($_GET['type']) {
			case 'lt':
				$table='loan_approval_type';
				$page='../administrator/loan_type.php';
			break;
			case 'req':
				$table="requirements";
				$page="../administrator/requirement.php";
			case 'cafReq':
				$table="requirements";
				$page="../administrator/frm_requirement_caf.php?id=".$_GET['loan_type_id'];
				break;
			case 'pt':
				$table='payment_type';
				$page='../administrator/payment_type.php';
			break;
			case 'cf':
				$table='credit_facility';
				$page='../administrator/credit_facility.php';
			break;
			case 'pl':
				$table='product_line';
				$page='../administrator/product_line.php';
			break;
			case 'mt':
				$table='marketing_type';
				$page='../administrator/marketing_type.php';
			break;
			case 'cc':
				$table='collateral_code';
				$page='../administrator/collateral_code.php';
			break;
			case 'loan':
				$table='loan_list';
				$page='../marketing/loan_management.php';
			break;
			case 'ind_corp':
				$table='industry_corp';
				$page='../administrator/industry_corp.php';
			break;
			case 'civ_stat':
			$table='civil_status';
			$page='../administrator/civil_status.php';
			break;
			case 'bus_type':
			$table='business_type';
			$page='../administrator/business_type.php';
			break;
			case 'ind_code':
			$table='industry_code';
			$page='../administrator/industry_code.php';
			break;
			case 'client_type':
			$table='client_type';
			$page='../administrator/client_type.php';
			break;
			case 'country':
			$table='country';
			$page='../administrator/country.php';
			break;
			case 'region':
			$table='region';
			$page='../administrator/region.php';
			break;
			case 'inquiry':
				$table='client_list';
				$page='../inquiry/inquiry.php';
			break;
			case 'trade_check':
				$table='trade_check';
				$page='../credit/ci_checking_form.php?id='.$_GET['loan'].'&tab=2';
			break;
			case 'credit_check':
				$table='credit_check';
				$page='../credit/ci_checking_form.php?id='.$_GET['loan'].'&tab=3';
			break;
			case 'cred_app_rel':
			$table='cred_app_relations';
			$page='../marketing/business_writeup.php?id='.$_GET['loan'].'#our_relations';
			break;
			case 'cred_app_vo':
			$table='cred_app_vehicles';
			$page='../marketing/business_writeup.php?id='.$_GET['loan'].'#vehicles_owned';
			break;
			case 'cred_app_cfl':
			$table='cred_app_less';
			$page='../marketing/business_writeup.php?id='.$_GET['loan'].'#cash_flow';
			break;
			case 'dealer':
			$table='dealer';
			$page='../administrator/dealer.php';
			break;
			case 'salesman':
			$table='salesman';
			$page='../administrator/salesman.php';
			case 'bwu_files':
			$table='bwu_files';
			$page='../credit/business_writeup.php?id='.$_GET['loan'];
			break;
			default:
			redirect('index.php');
			break;
	}
		if($_GET['type']=='inquiry'){
			$con->myQuery("UPDATE {$table} SET `is_blacklisted` = CASE WHEN `is_blacklisted`='1' THEN '0' WHEN `is_blacklisted`='0' THEN '1' END  WHERE `client_number` = $id");
		}elseif($_GET['type']=='cafReq'){
				$check = $con->myQuery("SELECT * FROM {$table} WHERE id=".$id)->fetch(PDO::FETCH_ASSOC);
				$newVal = str_replace($_GET['loan_type_id'].",","",$check['caf']);
				// die(''.$check['caf']);
				$error=$con->myQuery("UPDATE {$table} SET caf = :newVal WHERE id = :id",array('newVal' => $newVal, 'id'=>$id));
				// die("".$error);
					
		}elseif($_GET['type']=='cred_app_cfl'){
			$con->myQuery("UPDATE {$table} SET `is_deleted` = '1' WHERE `id` = $id");
			$inc=$con->myQuery("SELECT gross_inc FROM cred_app_bwu WHERE loan_id=?",array($_GET['loan']))->fetch(PDO::FETCH_ASSOC);
            $less_amt=$con->myQuery("SELECT SUM(amount) AS amount FROM cred_app_less WHERE is_deleted='0' AND loan_id=?",array($_GET['loan']))->fetch(PDO::FETCH_ASSOC);
            $less_per=$con->myQuery("SELECT SUM(percent) AS per FROM cred_app_less WHERE is_deleted='0' AND loan_id=?",array($_GET['loan']))->fetch(PDO::FETCH_ASSOC);
                $net_inc=$inc['gross_inc']-(($inc['gross_inc']*($less_per['per']/100)));
				$net_inc=$net_inc-$less_amt['amount'];
            $con->myQuery("UPDATE cred_app_bwu SET net_inc=?
			WHERE loan_id=?",array($net_inc,$_GET['loan']));
		}
		else{
			$con->myQuery("UPDATE {$table} SET `is_deleted` = '1' WHERE `id` = $id");
		}

		if($_GET['type']=='inquiry'){
		Alert("Update Successful.",'success');
		}else{
			Alert("Delete Successful.",'success');
		}
		redirect($page);
}else{
		redirect('../dashboard');
		Alert('Please log in to continue','danger');
	}
?>