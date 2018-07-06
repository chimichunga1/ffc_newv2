<?php
require_once("support/config.php");
echo "wew";
if(!isLoggedIn()){
  
  redirect("frmlogin.php");
  die();
}
else {
  redirect("dashboard");
  die();

}

if($_SESSION[WEBAPP]['user']['question_id']==null){
  redirect("logout.php");
  die();
}



?>
