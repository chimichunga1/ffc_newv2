<?php
require_once("support/config.php");
 if(!isLoggedIn()){
 	toLogin();
 	die();
 }
$inputs=$_POST;

 if($inputs['type']=='bwu'){
    if(!empty($_FILES['file']['name'])){
                        $con->myQuery("UPDATE bwu_files SET is_deleted='1' WHERE loan_id=?",array($inputs['loan_id']));
                        try {  
                            $con->beginTransaction();
                            $file_name=$_FILES['file']['name'];
                            $loan_id=$inputs['loan_id'];
                            $con->myQuery("INSERT INTO bwu_files(file_name,date_modified,loan_id) VALUES('$file_name',NOW(),'$loan_id')");
                            $file_id=$con->lastInsertId();

                            $filename=$file_id.getFileExtension($_FILES['file']['name']);
                            move_uploaded_file($_FILES['file']['tmp_name'],"bwu_files/".$filename);
                            $con->myQuery("UPDATE bwu_files SET file_location=? WHERE id=?",array($filename,$file_id));
                            $con->commit();           
                            } catch (Exception $e) {
                        $con->rollBack();
                //        echo "Failed: " . $e->getMessage();
                        Alert("Upload failed. Please try again.","danger");
                        redirect("credit/business_writeup.php?id=".$inputs['loan_id']);
                        die;
                        }
                        Alert("Upload Successful.","success");
                        redirect("credit/business_writeup.php?id=".$inputs['loan_id']);
                }
}
?>