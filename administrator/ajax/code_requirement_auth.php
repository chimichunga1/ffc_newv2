<?php
	require_once('../../support/config.php');

    if(isset($_POST['val']) && !empty($_POST['val'])){
        if(isset($_POST['req_id']) && !empty($_POST['req_id'])){
            $ret = $con->myQuery("SELECT * FROM requirements WHERE requirement_code = :code AND id != :req_id ",array('code'=>$_POST['val'], 'req_id' => $_POST['req_id']))->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $ret = $con->myQuery("SELECT * FROM requirements WHERE requirement_code = :code ",array('code'=>$_POST['val']))->fetchAll(PDO::FETCH_ASSOC);
        }
    
        if(count($ret) > 0 ){
            echo "<p class='text-danger h5' id='false'><strong> Requirement Code is taken. </strong></p>";
        }else{
            echo "<p class='text-success h5' id='true'><strong> Requirement Code is available. </strong></p>";
        }
    }