<html>
<?php

	require_once('../support/config.php');
	if(!isLoggedIn()){
		toLogin();
		die();
	  }
	$errors="";
	$inputs=$_POST;
	$check="";

	// $check=$con->myQuery("SELECT id FROM loan_list WHERE app_no=? AND id!=?",array($_POST['app_no'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
		if(!empty($check)){
			$errors.="Application Number already exist.";
		}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("inquiry_form.php");}
				else{
				redirect("inquiry_form.php?id=".$_POST['id']);}
			die;
		}else{

			if($inputs['same_add']=='on'){
				$inputs['bus_no']=$inputs['home_no'];
				$inputs['bus_brgy']=$inputs['home_brgy'];
				$inputs['bus_city']=$inputs['home_city'];
				$inputs['bus_zip']=$inputs['home_zip'];
				$inputs['same_add']='checked';
			}else{
				$inputs['same_add']='';
			}
			if($inputs['same_add1']=='on'){
				$inputs['gar_no']=$inputs['home_no'];
				$inputs['gar_brgy']=$inputs['home_brgy'];
				$inputs['gar_city']=$inputs['home_city'];
				$inputs['gar_zip']=$inputs['home_zip'];
				$inputs['same_add1']='checked';
			}else{
				$inputs['same_add1']='';
			}
			if($inputs['is_borrower']=='on'){
				$inputs['is_borrower']='checked';
			}
			if($inputs['is_dealer']=='on'){
				$inputs['is_dealer']='checked';
			}
			if($inputs['is_salesman']=='on'){
				$inputs['is_salesman']='checked';
			}

			if(empty($_POST['id'])){
					
				    $inputs['applied_by']=$_SESSION[WEBAPP]['user']['user_id'];
					$params1=array(
						"applied_by"=>$inputs['applied_by'],
						"last_name"=>$inputs['lname'],
						"first_name"=>$inputs['fname'],
						"middle_name"=>$inputs['mname'],
						"ext_name"=>$inputs['ename'],
						"spouse"=>$inputs['spouse'],
						"email"=>$inputs['email'],
						"bus_tel"=>$inputs['bus_tel'],
						"home_tel"=>$inputs['home_tel'],
						"pri_con"=>$inputs['pri_con'],
						"sec_con"=>$inputs['sec_con'],
						"ind_corp"=>$inputs['ind_corp'],
						"birthdate"=>$inputs['birth_date'],
						"gender"=>$inputs['gender'],
						"civil_status"=>$inputs['civil_status'],
						"tin"=>$inputs['tin'],
						"sss_no"=>$inputs['sss_no'],
						"acr_no"=>$inputs['acr_no'],
						"pag_ibig"=>$inputs['pag_ibig'],
						"rc_no"=>$inputs['rc_no'],
						"rc_date"=>$inputs['rc_date'],
						"rc_place"=>$inputs['rc_place'],
						"bus_type"=>$inputs['bus_type'],
						"country"=>$inputs['country'],
						"ind_code"=>$inputs['ind_code'],
						"region"=>$inputs['region'],
						"client_type"=>$inputs['client_type'],
						"con_name"=>$inputs['con_name'],
						"con_rc_no"=>$inputs['con_rc_no'],
						"con_rc_date"=>$inputs['con_rc_date'],
						"con_rc_place"=>$inputs['con_rc_place'],
						"home_no"=>$inputs['home_no'],
						"home_brgy"=>$inputs['home_brgy'],
						"home_city"=>$inputs['home_city'],
						"home_zip"=>$inputs['home_zip'],
						"bus_no"=>$inputs['bus_no'],
						"bus_brgy"=>$inputs['bus_brgy'],
						"bus_city"=>$inputs['bus_city'],
						"bus_zip"=>$inputs['bus_zip'],
						"gar_no"=>$inputs['gar_no'],
						"gar_brgy"=>$inputs['gar_brgy'],
						"gar_city"=>$inputs['gar_city'],
						"gar_zip"=>$inputs['gar_zip'],
						"fax_no"=>$inputs['fax_no'],
						"same_add"=>$inputs['same_add'],
						"same_add1"=>$inputs['same_add1'],
						"is_borrower"=>$inputs['is_borrower'],
						"is_dealer"=>$inputs['is_dealer'],
						"is_salesman"=>$inputs['is_salesman']
					);

					$try = $con->myQuery("INSERT INTO
								client_list(
									lname,
									fname,
									mname,
									ename,
									spouse,
									email,
									bus_tel,
									home_tel,
									pri_con,
									sec_con,
									applied_by,
									applied_date,
									ind_corp_id,
									birthdate,
									gender,
									civil_status_id,
									tin_no,
									sss_no,
									acr_no,
									pagibig_no,
									rescert_no,
									rescert_date,
									rescert_place,
									bus_type_id,
									country_id,
									ind_code_id,
									region_id,
									client_type_id,
									con_name,
									con_rescert_no,
									con_rescert_date,
									con_rescert_place,
									home_no,
									home_brgy,
									home_city,
									home_zip,
									bus_no,
									bus_brgy,
									bus_city,
									bus_zip,
									gar_no,
									gar_brgy,
									gar_city,
									gar_zip,
									fax_no,
									same_add,
									same_add1,
									is_borrower,
									is_dealer,
									is_salesman
								) VALUES(
									:last_name,
									:first_name,
									:middle_name,
									:ext_name,
									:spouse,
									:email,
									:bus_tel,
									:home_tel,
									:pri_con,
									:sec_con,
									:applied_by,
									CURDATE(),
									:ind_corp,
									:birthdate,
									:gender,
									:civil_status,
									:tin,
									:sss_no,
									:acr_no,
									:pag_ibig,
									:rc_no,
									:rc_date,
									:rc_place,
									:bus_type,
									:country,
									:ind_code,
									:region,
									:client_type,
									:con_name,
									:con_rc_no,
									:con_rc_date,
									:con_rc_place,
									:home_no,
									:home_brgy,
									:home_city,
									:home_zip,
									:bus_no,
									:bus_brgy,
									:bus_city,
									:bus_zip,
									:gar_no,
									:gar_brgy,
									:gar_city,
									:gar_zip,
									:fax_no,
									:same_add,
									:same_add1,
									:is_borrower,
									:is_dealer,
									:is_salesman
					)",$params1);
					Alert("Successfully Added.","success");
					insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Added New Client.");
			}
			
			else{
					$params1=array(
						"id"=>$inputs['id'],
						"last_name"=>$inputs['lname'],
						"first_name"=>$inputs['fname'],
						"middle_name"=>$inputs['mname'],
						"ext_name"=>$inputs['ename'],
						"spouse"=>$inputs['spouse'],
						"email"=>$inputs['email'],
						"bus_tel"=>$inputs['bus_tel'],
						"home_tel"=>$inputs['home_tel'],
						"pri_con"=>$inputs['pri_con'],
						"sec_con"=>$inputs['sec_con'],
						"ind_corp"=>$inputs['ind_corp'],
						"birthdate"=>$inputs['birth_date'],
						"gender"=>$inputs['gender'],
						"civil_status"=>$inputs['civil_status'],
						"tin"=>$inputs['tin'],
						"sss_no"=>$inputs['sss_no'],
						"acr_no"=>$inputs['acr_no'],
						"pag_ibig"=>$inputs['pag_ibig'],
						"rc_no"=>$inputs['rc_no'],
						"rc_date"=>$inputs['rc_date'],
						"rc_place"=>$inputs['rc_place'],
						"bus_type"=>$inputs['bus_type'],
						"country"=>$inputs['country'],
						"ind_code"=>$inputs['ind_code'],
						"region"=>$inputs['region'],
						"client_type"=>$inputs['client_type'],
						"con_name"=>$inputs['con_name'],
						"con_rc_no"=>$inputs['con_rc_no'],
						"con_rc_date"=>$inputs['con_rc_date'],
						"con_rc_place"=>$inputs['con_rc_place'],
						"home_no"=>$inputs['home_no'],
						"home_brgy"=>$inputs['home_brgy'],
						"home_city"=>$inputs['home_city'],
						"home_zip"=>$inputs['home_zip'],
						"bus_no"=>$inputs['bus_no'],
						"bus_brgy"=>$inputs['bus_brgy'],
						"bus_city"=>$inputs['bus_city'],
						"bus_zip"=>$inputs['bus_zip'],
						"gar_no"=>$inputs['gar_no'],
						"gar_brgy"=>$inputs['gar_brgy'],
						"gar_city"=>$inputs['gar_city'],
						"gar_zip"=>$inputs['gar_zip'],
						"fax_no"=>$inputs['fax_no'],
						"same_add"=>$inputs['same_add'],
						"same_add1"=>$inputs['same_add1'],
						"is_borrower"=>$inputs['is_borrower'],
						"is_dealer"=>$inputs['is_dealer'],
						"is_salesman"=>$inputs['is_salesman']
					);
					$con->myQuery("UPDATE
								client_list SET
									lname=:last_name,
									fname=:first_name,
									mname=:middle_name,
									ename=:ext_name,
									spouse=:spouse,
									email=:email,
									bus_tel=:bus_tel,
									home_tel=:home_tel,
									pri_con=:pri_con,
									sec_con=:sec_con,
									date_modified=CURDATE(),
									ind_corp_id=:ind_corp,
									birthdate=:birthdate,
									gender=:gender,
									civil_status_id=:civil_status,
									tin_no=:tin,
									sss_no=:sss_no,
									acr_no=:acr_no,
									pagibig_no=:pag_ibig,
									rescert_no=:rc_no,
									rescert_date=:rc_date,
									rescert_place=:rc_place,
									bus_type_id=:bus_type,
									country_id=:country,
									ind_code_id=:ind_code,
									region_id=:region,
									client_type_id=:client_type,
									con_name=:con_name,
									con_rescert_no=:con_rc_no,
									con_rescert_date=:con_rc_date,
									con_rescert_place=:con_rc_place,
									home_no=:home_no,
									home_brgy=:home_brgy,
									home_city=:home_city,
									home_zip=:home_zip,
									bus_no=:bus_no,
									bus_brgy=:bus_brgy,
									bus_city=:bus_city,
									bus_zip=:bus_zip,
									gar_no=:gar_no,
									gar_brgy=:gar_brgy,
									gar_city=:gar_city,
									gar_zip=:gar_zip,
									fax_no=:fax_no,
									same_add=:same_add,
									same_add1=:same_add1,
									is_borrower=:is_borrower,
									is_dealer=:is_dealer,
									is_salesman=:is_salesman
									WHERE client_number=:id
					",$params1);
					insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Update Client Information.");
					Alert("Successfully Updated.","success");
				}
			
			redirect("inquiry.php");
			die;
		
		}
?>
</html>