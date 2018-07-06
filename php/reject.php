<?php
	require_once('../support/config.php');
	if(isLoggedIn()&&isset($_GET['id'])){
		$id = $_GET['id'];
		$table="";
		switch ($_GET['type']) {
			case 'loan':
				$table='loan_list';
				$page='../accounting/loan_approval.php';
			break;
			case 'dist':
				$table='loan_list';
				$page='../accounting/preparation.php';
			break;
			
			default:
			redirect('../dashboard');
			break;
	}
		$con->myQuery("UPDATE {$table} SET `loan_status_id` = '2' WHERE `id` = $id");
		Alert("Reject Successful.",'success');
		redirect($page);
}else{
		redirect('../dashboard');
		Alert('Please log in to continue','danger');
	}
?>