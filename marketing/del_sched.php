<?php
require_once("../support/config.php");
if(!isLoggedIn()){
    toLogin();
    die();
  }
  $con->beginTransaction();
  if(!empty($_POST['type'])){
    $id = $con->myQuery("SELECT * FROM loan_list WHERE app_no = ? AND is_deleted = 0",array($_POST['idLL']))->fetch(PDO::FETCH_ASSOC);
    $del = $con->myQuery("UPDATE td_sched SET is_deleted = 1 WHERE id = ?",array($_POST['id']));
    redirect("instruction_sheet_td.php?id=".$id['id']."&tab=2");
    Alert('Successfully Deleted','success');
  }
$con->commit();
  