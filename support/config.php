<?php
	session_start();
	date_default_timezone_set("Asia/Manila");
	define("WEBAPP", 'Enrollment System');

	define("DATE_FORMAT_PHP", "m/d/Y");
	define("DATE_FORMAT_SQL", "%m/%d/%Y");
	define("TIME_FORMAT_SQL", "%h:%i %p");
	define("TIME_FORMAT_PHP", "h:i A");
	//$_SESSION[WEBAPP]=array();
	// function __autoload($class)
	// {
	// 	require_once 'class.'.$class.'.php';
	// }

	function redirect($url)
	{
		header("location:".$url);
	}

	function jsredirect($url)
	{
		echo "<script>window.history.back()</script>";
		echo "<a href='{$url}'>Click here if you are not redirected.</a>";
	}

	function getFileExtension($filename){
		return substr($filename, strrpos($filename,"."));
	}
	function DisplayDate($unformatted_date)
	{
		return date("m/d/Y", strtotime($unformatted_date));
	}

	function format_date($date_string)
	{
		$date=new DateTime($date_string);
		return $date->format("Y-m-d");
	}
	function inputmask_format_date($date_string){
		$date=new DateTime($date_string);
		return $date->format("m/d/Y");	
	}

	function floatConvert($num){
		return number_format((float)$num,2,'.',',');
	}

	function stripFloat($num){
		return str_replace(',','',$num);
	}

	function cStat($stat){
		return $stat = $stat==1?'Old':'New';
	 }

	 function isEmptyFloat($num = ""){
			return !empty($num) && $num != "0.0" ? number_format((float)$num,2,'.',',') : "";
	 }

	 function isFloat($num = ""){
		 return (float)$num != 0.00 ? (float)$num : "";
	 }

	 function isEmptyInt($num = ""){
		 return (int)$num != 0 ? $num : "";
	 }

	 function isEmptyDate($date){
		 $date .= "";
		 return $date == "0000-00-00" || $date == "" ? "" : date_format(date_create($date),'m/d/Y');
	 }

	 function isDate28($date, $cus = false,$cusVal = ""){
			 $val = true;
			 $date .= "";
			 $date =  explode('/',$date);
			 if($date[1] > 28){$val = false; $date[1] = 28;}
			 $date[1] = $cusVal != "" ? $date[1] = $cusVal : $date[1] = $date[1];
			 $date = implode('/',$date);
			 return $cus ? $date : $val;

	 }

	 function AddonList() {
		 global $con;
	
		$addQuery = $con->myQuery("SELECT id FROM loan_approval_type WHERE name LIKE ('%Add-on%')");
			while($row = $addQuery->fetch(PDO::FETCH_ASSOC)){
				$addOn[] = $row['id'];
			}
		return $addOn;
	 }


// ENCRYPTOR
	function encryptIt( $q ) {
	    $cryptKey  = 'JPB0rGtIn5UB1xG03efyCp';
	    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
	}
	function decryptIt( $q ) {
	    $cryptKey  = 'JPB0rGtIn5UB1xG03efyCp';
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}
//End Encryptor
	function insertAuditLog($user, $action)
{
    #user,action,date
        // if (file_exists("./audit_log.txt")) {
        //     $user=htmlspecialchars($user);
        //     $action=htmlspecialchars($action);
        //     $new_input=json_encode(array($user,$action,date('Y-m-d H:i:s')), JSON_PRETTY_PRINT);
        //     $file = fopen("./audit_log.txt", "r+");
        //     fseek($file, -4, SEEK_END);
        //     fwrite($file, ",".$new_input."\n\t]\n}");
        //     fclose($file);
        // } else {
        //     $file = fopen("./audit_log.txt", "w+");

        //     #CREATE NEW TEXT FILE
        //     $data=json_encode(array("data"=>array(array("NONE","INITIAL START UP",date('Y-m-d H:i:s')))), JSON_PRETTY_PRINT);
        //     fwrite($file, $data);

        //     $user=htmlspecialchars($user);
        //     $action=htmlspecialchars($action);
        //     $new_input=json_encode(array($user,$action,date('Y-m-d H:i:s')), JSON_PRETTY_PRINT);

        //     fseek($file, -4, SEEK_END);
        //     fwrite($file, ",".$new_input."\n\t]\n}");

        //     fclose($file);
        // }
}

function archiveAuditLog()
{
    if (file_exists("./audit_log.txt")) {
        $current=new DateTime();
        rename("./audit_log.txt", "./archive/Audit log ".$current->format("Y-m-d h-i-s").".txt");
    }
}

/* User FUNCTIONS */
	function isLoggedIn()
	{
		if(empty($_SESSION[WEBAPP]['user']))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function toLogin($url=NULL)
	{
		if(empty($url))
		{
			Alert('Please Log in to Continue',"danger");
			header("location: ../frmlogin.php");
		}
		else{
			header("location: ".$url);
		}
	}
	function Login($user)
	{
		$_SESSION[WEBAPP]['user']=$user;
	}
/* End User FUnctions */
//HTML Helpers
	function makeHead($pageTitle=WEBAPP, $level=0)
	{
		require_once str_repeat('../', $level).'template/head.php';
		unset($pageTitle);
	}
	function makeFoot($pageTitle=WEBAPP,$level=0)
	{
		global $request_type;
		require_once str_repeat('../', $level).'template/foot.php';
		unset($pageTitle);
	
	}
	

	function makeOptions($array,$placeholder="",$checked_value=NULL){
		$options="";
		// if(!empty($placeholder)){
			$options.="<option value=''>{$placeholder}</option>";
		// }
		foreach ($array as $row) {
			list($value,$display) = array_values($row);
				if($checked_value!=NULL && $checked_value==$value){

					$options.="<option value='".htmlspecialchars($value)."' checked>".htmlspecialchars($display)."</option>";
				}
				else
				{
					$options.="<option value='".htmlspecialchars($value)."'>".htmlspecialchars($display)."</option>";
				}
		}
		return $options;
	}
//END HTML Helpers
/* BOOTSTRAP Helpers */
	function Modal($content=NULL,$title="Alert")
	{
		if(!empty($content))
		{
			$_SESSION[WEBAPP]['Modal']=array("Content"=>$content,"Title"=>$title);
		}
		else
		{
			if(!empty($_SESSION[WEBAPP]['Modal']))
			{
				include_once '../template/modal.php';
				unset($_SESSION[WEBAPP]['Modal']);
			}
		}
	}


	function Alert($content=NULL,$type="info")
	{
		if(!empty($content))
		{
			$_SESSION[WEBAPP]['Alert']=array("Content"=>$content,"Type"=>$type);
		}
		else
		{
			
			if(!empty($_SESSION[WEBAPP]['Alert']))
			{
			
					// include_once "template/alert.php";
					$alertcontent = $_SESSION[WEBAPP]['Alert']['Content'];

					$alerttype = $_SESSION[WEBAPP]['Alert']['Type'];

					if ($alerttype == "danger") {
						$alerttype="warning";
					}

					echo "<script>swal('{$alertcontent}','','{$alerttype}');</script>";
					
			
				
			}
			unset($_SESSION[WEBAPP]['Alert']);
		}
	}
	function createAlert($content='',$type='info')
	{
		echo "<div class='alert alert-{$type}' role='alert'>{$content}</div>";
	}
/* End BOOTSTRAP Helpers */


function AllowUser($user_type_id){
	if(array_search($_SESSION[WEBAPP]['user']['user_type_id'], $user_type_id)!==FALSE){
		return true;
	}
	return false;
}

function refresh_activity($user_id)
{
	global $con;
	$con->myQuery("UPDATE users SET last_activity=NOW() WHERE user_id=?",array($user_id));
}
function is_active($user_id)
{
	return true;
	global $con;
	$last_activity=$con->myQuery("SELECT last_activity FROM users  WHERE user_id=?",array($user_id))->fetchColumn();
	$inactive_time=60*5;
	// echo strtotime($last_activity)."<br/>";
	// echo time();
	if(time()-strtotime($last_activity) > $inactive_time){
		return false;
	}

	return true;
}

function getUserDetails($emp_id)
{
    global $con;

    return $con->myQuery("SELECT * FROM users WHERE user_id=? LIMIT 1", array($emp_id))->fetch(PDO::FETCH_ASSOC);
}
function user_is_active($user_id)
{
	global $con;
	$last_activity=$con->myQuery("SELECT is_active FROM users  WHERE user_id=?",array($user_id))->fetchColumn();
	if(!empty($last_activity)){
		return true;
	}
	else{
		return false;
	}
}

/* END SPECIFIC TO WEBAPP */
	require_once('class.myPDO.php');
	$con=new myPDO('fccl_system','root','');

	if(isLoggedIn()){
		if(!user_is_active($_SESSION[WEBAPP]['user']['user_id'])){
			refresh_activity($_SESSION[WEBAPP]['user']['user_id']);
			session_destroy();
			session_start();
			Alert("Your account has been deactivated.","danger");
			redirect('frmlogin.php');
			die;
		}
		if(is_active($_SESSION[WEBAPP]['user']['user_id'])){

			refresh_activity($_SESSION[WEBAPP]['user']['user_id']);
		}
		else{
			//echo 'You have been inactive.';
			// die;
			// refresh_activity($_SESSION[WEBAPP]['user']['user_id']);
			// // die;
			// $con->myQuery("UPDATE users SET is_login=0 WHERE user_id=?",array($_SESSION[WEBAPP]['user']['user_id']));
			// session_destroy();
			// session_start();
			// Alert("You have been inactive for 5 minutes and have been logged out.","danger");
			// redirect('frmlogin.php');
			// die;
		}
	}
	

	
?>
