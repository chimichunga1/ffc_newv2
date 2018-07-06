<?php
	require_once('../support/config.php');

	if(isLoggedIn()&&isset($_POST['id'])){
		$id = $_POST['id'];
		$table="";
		switch ($_POST['type']) {
			case 'loan':
				$table='loan_list';
				$page='../accounting/loan_approval.php';
			break;
			case 'dist':
				$table='loan_list';
				$page='../accounting/preparation.php';
				$status="12";
			break;
			
			default:
			redirect('../dashboard');
			break;
	}
		$con->myQuery("UPDATE {$table} SET `loan_status_id` = '{$status}' WHERE `id` = $id");
		Alert("Approved Successful.",'success');
		redirect($page);
}else{
		redirect('../dashboard');
		Alert('Please log in to continue','danger');
	}
?>