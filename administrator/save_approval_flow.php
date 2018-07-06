<?php

	require_once('../support/config.php');

	
	var_dump($_POST);
	
	if(empty($_POST['user_id'])){
		Alert("Invalid User","danger");
		redirect("approval_flow.php");
		die;
	}
	else{
		
			$con->myQuery("INSERT INTO approval_flow(user_id) VALUES(?)",array($_POST['user_id']));
			
			Alert("User Added.","success");
			redirect("approval_flow.php");
			die;
		
	}
?>