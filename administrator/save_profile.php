<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
	}


	$errors="";
    $inputs=$_POST;
    
    // var_dump($inputs);
    // die;
    if (!empty($_FILES['image']['name'])) {
       
        $filename=$inputs['user_id'].date("mdyhis").getFileExtension($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "user_image/".$filename);
        $file_sql="image=:image";
        $insert['image']=$filename;
        $insert['id']=$inputs['user_id'];
        $con->myQuery("UPDATE users SET {$file_sql} WHERE user_id=:id", $insert);
        $_SESSION[WEBAPP]['user']['image'] = $filename;
    }
    // die;

    $con->myQuery("UPDATE users SET first_name=:f_name, middle_initial=:m_name, last_name=:l_name WHERE user_id=:user_id",$inputs);
    Alert("Successfully Updated.","success");
    
    redirect("user_profile.php");
    die;
		
	
?>
