<?php

	require_once("../support/config.php");
	if(!isLoggedIn()){
		toLogin();
		die();
	  }
	$errors="";
	$inputs=$_POST;
	$check=$con->myQuery("SELECT id FROM neighbor_check WHERE loan_id=".$inputs['id'])->fetch(PDO::FETCH_ASSOC);
	// 	if($check['id']>='2'){
	// 		$status_id='1';
	// 	}else{
	// 		$status_id='0';
	// 	}
		if($errors!="")
		{
			Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($_POST['id'])){
				redirect("ci_checking_form.php");}
				else{
				redirect("ci_checking_form.php?id=".$_POST['id']."&tab=".$_POST['tab']);}
			die;
		}else{

		$con->beginTransaction();
		try {
			if(empty($check)){
					$inputs['applied_by']=$_SESSION[WEBAPP]['user']['user_id'];
					$params1=array(
                    "loan_id"=>$inputs['id'],
					"applied_by"=>$inputs['applied_by'],
					"client_no"=>$inputs['client_no'],
					"tel_no"=>$inputs['tel_no'],
					"cel_no"=>$inputs['cel_no'],
					"leng_stay"=>$inputs['leng_stay'],
					"acquire"=>$inputs['acquire'],
					"free_name"=>$inputs['free_name'],
					"free_rel"=>$inputs['free_rel'],
					"free_tel"=>$inputs['free_tel'],
					"rent_name"=>$inputs['rent_name'],
					"rent_pay"=>$inputs['rent_pay'],
					"rent_tel"=>$inputs['rent_tel'],
					"mort_name"=>$inputs['mort_name'],
					"mort_pay"=>$inputs['mort_pay'],
					"mort_tel"=>$inputs['mort_tel'],
					"prev_add"=>$inputs['prev_add'],
					"other_add"=>$inputs['other_add'],
					"other_tel"=>$inputs['other_tel'],
					"desc_imp"=>$inputs['desc_imp'],
					"equip_with"=>$inputs['equip_with'],
					"liv_con"=>$inputs['liv_con'],
					"neigh_spec"=>$inputs['neigh_spec'],
					"access_to"=>$inputs['access_to'],
					"subj_rep"=>$inputs['subj_rep'],
					"direction"=>$inputs['direction'],
					"date_applied"=>$inputs['date_applied']
					);
					$con->myQuery("INSERT INTO
								neighbor_check(
									loan_id,client_no,tel_no,cel_no,leng_stay,acquire,free_name,free_rel,free_tel,rent_name,rent_pay,rent_tel,mort_name,mort_pay,
                                    mort_tel,prev_add,other_add,other_tel,desc_imp,equip_with,liv_con,neigh_spec,access_to,subj_rep,direction,date_applied,applied_by
								) VALUES(
									:loan_id,:client_no,:tel_no,:cel_no,:leng_stay,:acquire,:free_name,:free_rel,:free_tel,:rent_name,:rent_pay,:rent_tel,:mort_name,:mort_pay,
                                    :mort_tel,:prev_add,:other_add,:other_tel,:desc_imp,:equip_with,:liv_con,:neigh_spec,:access_to,:subj_rep,:direction,:date_applied,:applied_by
								)",$params1);
								// $con->myQuery("UPDATE client_list SET status_id=?
								// WHERE client_number=?",array($status_id,$inputs['client_no']));

			Alert("Successfully Added.","success");}
			else{
					$params1=array(
                        "loan_id"=>$inputs['id'],
                        "applied_by"=>$inputs['applied_by'],
                        "tel_no"=>$inputs['tel_no'],
                        "cel_no"=>$inputs['cel_no'],
                        "leng_stay"=>$inputs['leng_stay'],
                        "acquire"=>$inputs['acquire'],
                        "free_name"=>$inputs['free_name'],
                        "free_rel"=>$inputs['free_rel'],
                        "free_tel"=>$inputs['free_tel'],
                        "rent_name"=>$inputs['rent_name'],
                        "rent_pay"=>$inputs['rent_pay'],
                        "rent_tel"=>$inputs['rent_tel'],
                        "mort_name"=>$inputs['mort_name'],
                        "mort_pay"=>$inputs['mort_pay'],
                        "mort_tel"=>$inputs['mort_tel'],
                        "prev_add"=>$inputs['prev_add'],
                        "other_add"=>$inputs['other_add'],
                        "other_tel"=>$inputs['other_tel'],
                        "desc_imp"=>$inputs['desc_imp'],
                        "equip_with"=>$inputs['equip_with'],
                        "liv_con"=>$inputs['liv_con'],
                        "neigh_spec"=>$inputs['neigh_spec'],
                        "access_to"=>$inputs['access_to'],
                        "subj_rep"=>$inputs['subj_rep'],
						"direction"=>$inputs['direction'],
						"date_applied"=>$inputs['date_applied']
					);
					$con->myQuery("UPDATE
								neighbor_check SET
                                tel_no=:tel_no,cel_no=:cel_no,leng_stay=:leng_stay,acquire=:acquire,free_name=:free_name,free_rel=:free_rel,free_tel=:free_tel,
                                rent_name=:rent_name,rent_pay=:rent_pay,rent_tel=:rent_tel,mort_name=:mort_name,mort_pay=:mort_pay,mort_tel=:mort_pay,prev_add=:prev_add,
                                other_add=:other_add,other_tel=:other_tel,desc_imp=:desc_imp,equip_with=:equip_with,liv_con=:liv_con,neigh_spec=:neigh_spec,access_to=:access_to,
                                subj_rep=:subj_rep,direction=:direction,date_applied=:date_applied,applied_by=:applied_by
								WHERE loan_id=:loan_id
								",$params1);
			Alert("Successfully Updated.","success");}
			$con->commit();
			redirect("ci_checking_form.php?id=".$inputs['id']."&tab=".$inputs['tab']);
			die;
		} catch (Exception $e) {
			$db->rollBack();
			Alert('Please try again.',"danger");
            redirect("ci_checking_form.php?id=".$inputs['id']."&tab=".$inputs['tab']);
			die;
		}
	}
?>

