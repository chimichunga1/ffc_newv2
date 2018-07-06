<?php

	require_once("../support/config.php");
	if(!isLoggedIn()){
		toLogin();
		die();
	  }
	$errors="";
	$inputs=$_POST;
	// $check=$con->myQuery("SELECT id FROM loan_list WHERE app_no=? AND id!=? AND is_deleted=0",array($_POST['app_no'],$_POST['id']))->fetch(PDO::FETCH_ASSOC);
	// 	if(!empty($check)){
	// 		$errors.="Application Number already exist.";
	// 	}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("create_loan.php");}
				else{
				redirect("create_loan.php?id=".$_POST['id']);}
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
			$inputs['ci_check_by']=$_SESSION[WEBAPP]['user']['user_id'];
		$con->beginTransaction();
		try {
			if(empty($_POST['id'])){
				    // $inputs['applied_by']=$_SESSION[WEBAPP]['user']['user_id'];
					// $params1=array(
					// "applied_by"=>$inputs['applied_by'],
					// "app_type"=>$inputs['app_type'],
					// "app_no"=>$inputs['app_no'],
					// "client_no"=>$inputs['client_no'],
					// "last_name"=>$inputs['lname'],
					// "first_name"=>$inputs['fname'],
					// "spouse"=>$inputs['spouse'],
					// "loan_type"=>$inputs['loan_type'],
					// "cre_fac"=>$inputs['cre_fac'],
					// "pro_line"=>$inputs['pro_line'],
					// "mar_type"=>$inputs['mar_type'],
					// "col_code"=>$inputs['col_code'],
					// "bus_add"=>$inputs['bus_add'],
					// "home_add"=>$inputs['home_add'],
					// "email"=>$inputs['email'],
					// "bus_tel"=>$inputs['bus_tel'],
					// "home_tel"=>$inputs['home_tel'],
					// "pri_con"=>$inputs['pri_con'],
					// "sec_con"=>$inputs['sec_con']
					// );
					// $con->myQuery("INSERT INTO
					// 			loan_list(
					// 				app_type,
					// 				app_no,
					// 				client_no,
					// 				last_name,
					// 				first_name,
					// 				spouse,
					// 				loan_type_id,
					// 				credit_fac_id,
					// 				prod_line_id,
					// 				mark_type_id,
					// 				coll_code_id,
					// 				bus_add,
					// 				home_add,
					// 				email_add,
					// 				bus_tel,
					// 				home_tel,
					// 				pri_con,
					// 				sec_con,
					// 				applied_by,
					// 				date_applied
					// 			) VALUES(
					// 				:app_type,
					// 				:app_no,
					// 				:client_no,
					// 				:last_name,
					// 				:first_name,
					// 				:spouse,
					// 				:loan_type,
					// 				:cre_fac,
					// 				:pro_line,
					// 				:mar_type,
					// 				:col_code,
					// 				:bus_add,
					// 				:home_add,
					// 				:email,
					// 				:bus_tel,
					// 				:home_tel,
					// 				:pri_con,
					// 				:sec_con,
					// 				:applied_by,
					// 				CURDATE()
					// 			)",$params1);
			Alert("Successfully Added.","success");}
			else{
					$params1=array(
					"id"=>$inputs['id'],
					"app_type"=>$inputs['app_type'],
					"app_no"=>$inputs['app_no'],
					"client_no"=>$inputs['client_no'],
					"last_name"=>$inputs['lname'],
					"first_name"=>$inputs['fname'],
					"loan_type"=>$inputs['loan_type'],
					"cre_fac"=>$inputs['cre_fac'],
					"pro_line"=>$inputs['pro_line'],
					"mar_type"=>$inputs['mar_type'],
					"col_code"=>$inputs['col_code'],
					"ci_check_by"=>$inputs['ci_check_by'],
					"dealer"=>$inputs['dealer'],
					"salesman"=>$inputs['salesman'],
					"unit_desc"=>$inputs['unit_desc'],
					"amt_fin"=>$inputs['amt_fin'],
					"res_val"=>$inputs['res_val'],
					"down_pay"=>$inputs['down_pay'],
					"list_pri"=>$inputs['list_pri'],
					"term"=>$inputs['term'],
					"int_rate"=>$inputs['int_rate'],
					"mon_amor"=>$inputs['mon_amor']
					);
					$params2=array(
						"client_no"=>$inputs['client_no'],
						"last_name"=>$inputs['lname'],
						"first_name"=>$inputs['fname'],
						"middle_name"=>$inputs['mname'],
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
								loan_list SET
									app_type=:app_type,
									app_no=:app_no,
									client_no=:client_no,
									last_name=:last_name,
									first_name=:first_name,
									loan_type_id=:loan_type,
									credit_fac_id=:cre_fac,
									prod_line_id=:pro_line,
									mark_type_id=:mar_type,
									coll_code_id=:col_code,
									date_modified=CURDATE(),
									ci_check_by=:ci_check_by,
									dealer_id=:dealer,
									salesman_id=:salesman,
									unit_desc=:unit_desc,
									amt_fin=:amt_fin,
									res_val=:res_val,
									down_pay=:down_pay,
									list_pri=:list_pri,
									term=:term,
									int_rate=:int_rate,
									mon_amor=:mon_amor
									WHERE id=:id
								",$params1);
					$con->myQuery("UPDATE
					client_list SET
						lname=:last_name,
						fname=:first_name,
						mname=:middle_name,
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
						WHERE client_number=:client_no
					",$params2);
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("ci_checking.php");
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
			redirect("create_loan.php");
			die;
		}
	}
?>