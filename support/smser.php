<?php
require_once 'config.php';

if(!isLoggedIn()){
	toLogin();
    die();
}

$result=0;
$pay_info=$con->myQuery("SELECT *
FROM payment_information

WHERE is_paid=1 AND payment_id={$_GET['p_id']}")->fetch(PDO::FETCH_ASSOC);
$get_stud_info=$con->myQuery("SELECT *
FROM student
WHERE id={$_GET['stud_id']}")->fetch(PDO::FETCH_ASSOC);
echo $message = "Hi, {$get_stud_info['last_name']}, {$get_stud_info['first_name']} {$get_stud_info['middle_name']}. You paid {$pay_info['statement_of_account']} at amount of {$pay_info['amount']} PHP. Date: {$pay_info['date_paid']}.";

echo $stud_id=$get_stud_info['mobile_no'];

$result = itexmo("{$stud_id}","{$message}","TR-MHARV287785_7CQE6 ");
if ($result == ""){
echo "iTexMo: No response from server!!!
Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
Please CONTACT US for help. ";	
}else if ($result == 0){
// echo "Message Sent!";
redirect("../print_receipt.php?p_id={$_GET['p_id']}");
}
else{	
echo "Error Num ". $result . " was encountered!";
}

function itexmo($number,$message,$apicode){
$url = 'https://www.itexmo.com/php_api/api.php';
$itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
$param = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($itexmo),
    ),
);
$context  = stream_context_create($param);
return file_get_contents($url, false, $context);}

redirect("../print_receipt.php?p_id={$_GET['p_id']}");
?>