<?php
  require_once('../support/config.php');
  try {
  $user_id=$_SESSION[WEBAPP]['user']['user_id'];
        $user=$con->myQuery("SELECT CONCAT(first_name,' ',middle_initial,' ',last_name) as prepared_by FROM users
        WHERE user_id=?",array($user_id))->fetch(PDO::FETCH_ASSOC);
		$loan=$con->myQuery("SELECT ll.id,ll.app_type,ll.app_no,ll.client_no,ll.last_name,
        ll.first_name,ll.spouse,ll.bus_add,ll.home_add,ll.email_add,ll.bus_tel,
        ll.home_tel,ll.pri_con,ll.sec_con,ll.date_applied,ll.date_modified,
        CONCAT(lat.code,' - ',lat.name) AS loan_code,
        CONCAT(cf.code,' - ',cf.name) AS cf_code,
        CONCAT(pl.code,' - ',pl.name) AS pl_code,
        CONCAT(mt.code,' - ',mt.name) AS mt_code,
        CONCAT(cc.code,' - ',cc.desc) AS cc_code,
        (SELECT CONCAT(u.last_name,', ',u.first_name,' ',u.middle_initial) FROM users u WHERE u.user_id=ll.applied_by)  AS applied_by 
         FROM loan_list ll INNER JOIN loan_approval_type lat ON lat.id=ll.loan_type_id
         INNER JOIN credit_facility cf ON cf.id=ll.credit_fac_id
         INNER JOIN product_line pl ON pl.id=ll.prod_line_id
         INNER JOIN marketing_type mt ON mt.id=ll.mark_type_id
         INNER JOIN collateral_code cc ON cc.id=ll.coll_code_id
         WHERE ll.id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);

        $client=$con->myQuery("SELECT cl.client_number AS id,CONCAT(cl.lname,', ',cl.fname,' ',cl.mname) AS client_name,
        ic.name AS ind_corp,id.name AS ind_code,bt.name AS bus_type,c.name AS country,r.name AS region,
        cl.birthdate,cl.gender,cs.name AS civil_status,cl.spouse,cl.tin_no,cl.sss_no,cl.acr_no,cl.pagibig_no,cl.rescert_no,
        cl.rescert_date,cl.rescert_place,cl.con_name,cl.con_rescert_no,cl.con_rescert_date,cl.con_rescert_place,
        CONCAT(cl.home_no,' ',cl.home_brgy,', ',cl.home_city,' ',cl.home_zip) AS home_add,
        CONCAT(cl.bus_no,' ',cl.bus_brgy,', ',cl.bus_city,' ',cl.bus_zip) AS bus_add,
        cl.email,cl.fax_no,cl.bus_tel,cl.home_tel,cl.pri_con,cl.sec_con
        FROM client_list cl 
        JOIN industry_corp ic ON ic.id=cl.ind_corp_id
        JOIN industry_code id ON id.id=cl.ind_code_id
        JOIN business_type bt ON bt.id=cl.bus_type_id
        JOIN country c ON c.id=cl.country_id
        JOIN region r ON r.id=cl.region_id
        JOIN civil_status cs ON cs.id=cl.civil_status_id
        WHERE cl.client_number=?",array($loan['client_no']))->fetch(PDO::FETCH_ASSOC);

        $caf=$con->myQuery("SELECT * FROM caf_info
        WHERE app_no=?",array($loan['id']))->fetch(PDO::FETCH_ASSOC);

        $cred_app_rel=$con->myQuery("SELECT * FROM cred_app_relations
            WHERE is_deleted=0 AND loan_id=?",array($loan['id']));
            while($rows=$cred_app_rel->fetch(PDO::FETCH_ASSOC)){
                $acct_no[]=$rows['acct_no'];
                $fac[]=$rows['facility'];
                $unit[]=$rows['unit'];
                $plate[]=$rows['plate_no'];
                $af[]=$rows['af'];
                $tlv[]=$rows['tlv'];
                $granted[]=$rows['granted'];
                $terms[]=$rows['terms'];
                $ma[]=$rows['ma'];
                $balance[]=$rows['balance'];
                $rule78[]=$rows['rule78'];
                $exp[]=$rows['exp'];
            }
            // $acct=implode('<br />',$acct_no);
            // $fac=implode('<br />',$fac);
            // $unit=implode('<br />',$unit);
            // $plate=implode('<br />',$plate);
            // $af=implode('<br />',$af);
            // $tlv=implode('<br />',$tlv);
            // $granted=implode('<br />',$granted);
            // $terms=implode('<br />',$terms);
            // $ma=implode('<br />',$ma);
            // $balance=implode('<br />',$balance);
            // $rule78=implode('<br />',$rule78);
            // $exp=implode('<br />',$exp);
            // var_dump($acct);die;
        $bwu=$con->myQuery("SELECT * FROM cred_app_bwu
            WHERE loan_id=?",array($loan['id']))->fetch(PDO::FETCH_ASSOC);

        $cred_app_vo=$con->myQuery("SELECT * FROM cred_app_vehicles
            WHERE is_deleted=0 AND loan_id=?",array($loan['id']));
                    while($rows=$cred_app_vo->fetch(PDO::FETCH_ASSOC)){
                        $veh_unit[]="(".$rows['unit'].") Units ".$rows['name']." - ".$rows['description'];
                    }
                    // $veh_unit=implode('<br />',$veh_unit);
        $less_amount=$con->myQuery("SELECT * FROM cred_app_less
            WHERE is_deleted=0 AND loan_id=? AND amount!='' ",array($loan['id']));
                    while($rows=$less_amount->fetch(PDO::FETCH_ASSOC)){
                        $less_amt[]=$rows['name'];
                        $amt[]="P ".$rows['amount'];
                    }
        $less_percent=$con->myQuery("SELECT * FROM cred_app_less
            WHERE is_deleted=0 AND loan_id=? AND percent!='' ",array($loan['id']));
                    while($rows=$less_percent->fetch(PDO::FETCH_ASSOC)){
                        $less_per[]=$rows['name'];
                        $per[]=$rows['percent']."%";
                    }
                    // $less_amt=implode('<br />',$less_amt);
                    // $amt=implode('<br />',$amt);
                    // $less_per=implode('<br />',$less_per);
                    // $per=implode('<br />',$per);
$inputs['appno']=$loan['app_no'];
$inputs['curdate']=date('F d, Y');
$inputs['loan_id']=$loan['id'];
$inputs['appdate']=date_format(date_create($loan['date_applied']),'F d, Y');
$inputs['borrower']=$client['client_name'];
$inputs['address']=$client['home_add'];
// $inputs["applied_by"]=$loan["applied_by"];
// $inputs['contact']=$client['home_tel']."/".$client['pri_con'];
// $inputs["term"]=$caf["term"]." months";
// $inputs["agent"]=$caf['prepared_by'];
// $inputs['acct']=str_replace("<br />", "\par\n", $acct);
// $inputs['facility']=str_replace("<br />", "\par\n", $fac);
// $inputs['unit']=str_replace("<br />", "\par\n", $unit);
// $inputs['plate']=str_replace("<br />", "\par\n", $plate);
// $inputs['af']=str_replace("<br />", "\par\n", $af);
// $inputs['tlv']=str_replace("<br />", "\par\n", $tlv);
// $inputs['granted']=str_replace("<br />", "\par\n", $granted);
// $inputs['terms']=str_replace("<br />", "\par\n", $terms);
// $inputs['ma']=str_replace("<br />", "\par\n", $ma);
// $inputs['balance']=str_replace("<br />", "\par\n", $balance);
// $inputs['rule78']=str_replace("<br />", "\par\n", $rule78);
// $inputs['exp']=str_replace("<br />", "\par\n", $exp);
// $inputs['note']=str_replace("\n", "\par\n", $bwu['note']);
// $inputs['statement']=str_replace("\n", "\par\n", $bwu['statement']);
// $inputs['veh_unit']=str_replace("<br />", "\par\n", $veh_unit);
// $inputs['gross_inc']=$bwu['gross_inc'];
// $inputs['net_inc']=$bwu['net_inc'];
// $inputs['less_per']=str_replace("<br />", "\par\n", $less_per);
// $inputs['per']=str_replace("<br />", "\par\n", $per);
// $inputs['less_amt']=str_replace("<br />", "\par\n", $less_amt);
// $inputs['amt']=str_replace("<br />", "\par\n", $amt);
// $inputs['strength']=str_replace("\n", "\par\n", $bwu['strength']);
// $inputs['weak']=str_replace("\n", "\par\n", $bwu['weak']);
// $inputs['reco']=str_replace("\n", "\par\n", $bwu['reco']);
// $inputs["prepared_by"]=$user["prepared_by"];
// $inputs['veh_name']=str_replace(" ", "\par\n", $veh_name);
// $inputs['veh_desc']=str_replace(" ", "\par\n", $veh_desc);
// var_dump($inputs);die;
// $inputs['address1']=str_replace("\n", "\par\n", $inputs['address1']);
$rtf=file_get_contents('bwu.rtf');
// $rtf=str_replace('$$COPY$$', str_replace('\r\n', "\par\n", $inputs['address1']), $rtf);
$rtf=str_replace("\r\n", '',$rtf);
foreach($inputs as $tag => $value)
    $rtf= str_replace('\{'.$tag.'\}',$value,$rtf);
    header('Content-type: application/rtf');
    header("Content-Disposition: attachment;filename=business-writup.rtf");
    header('Pragma:no-cache');
    header('Expires:0');

    echo $rtf;
    exit;
                }catch (Exception $e) {
                    $db->rollBack();
                    Alert('Error Occurred!.',"danger");
                    redirect("credit_approval.php");
                    die;
                }
?>