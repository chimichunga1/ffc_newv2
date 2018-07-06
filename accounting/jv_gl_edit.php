
 

<?php
require_once("../support/config.php");




$account=$con->myQuery("SELECT j.jv_no FROM journal_voucher j INNER JOIN journal_dbcr a ON a.jv_no= j.jv_no WHERE a.jv_no='".$_GET['id']."'")->fetchAll(PDO::FETCH_ASSOC);




if(empty($account))

{

  include 'jv_gl_edit_save.php';
}

else
{
  include 'jv_gl_edit_update.php';

}


   ?>
