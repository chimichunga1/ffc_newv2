<?php
	require_once("support/config.php");
	if(!isLoggedIn())
	{
		toLogin();
		die();
	}
	if(!AllowUser(1,2))
    {
         redirect("index.php");
     }
	// if(!AllowUserSpecific(47))
	// {
	// 	redirect("index.php");
	// }
	archiveAuditLog();
	insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Archived the audit logs.");
	//die;
	Alert("Audit log archived.","success");
	redirect("audit_logs.php");
	die;
?>