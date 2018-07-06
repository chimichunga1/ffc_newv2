<?php
  require_once('../support/config.php');
  $page = "frmlogin.php";
    if($_SESSION[WEBAPP]['user']['is_login'] == '1' && $_SESSION[WEBAPP]['user']['is_active'] == '1' && !empty($_SESSION[WEBAPP]['user']['first_name'])){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = $_GET['id'];
            $client = $con->myQuery("SELECT * FROM loan_list WHERE id = :client_id AND loan_status_id = 6 AND is_deleted = 0",array('client_id' => $id))->fetch(PDO::FETCH_ASSOC);
            if(count($client) > 0){
                $clientData = $con->myQuery("SELECT * FROM client_list WHERE client_number = :client_no AND is_deleted=0",array(
                    'client_no' => $client['client_no']
                ))->fetch(PDO::FETCH_ASSOC);
                $clientReq = $con->myQuery("SELECT * FROM client_requirements_caf WHERE client_no = :client_no AND application_no = :app_no AND is_deleted = 0",array(
                    'client_no' => $client['client_no'],
                    'app_no' => $id
                ));
                $clientLoanType = $con->myQuery("SELECT * FROM loan_approval_type WHERE id = ?",array($client['loan_type_id']))->fetch(PDO::FETCH_ASSOC);

                    while($row = $clientReq->fetch(PDO::FETCH_ASSOC)) {
                        $req_name[] = (!empty($row['requirement_name'])?$row['requirement_name']:'');
                        if($row['status'] == "pending"){
                            $row['status'] = 'X';
                        }else{
                            $row['status'] = 'O';
                        }
                        $req_status[] = '_____'.ucfirst($row['status']).'_____';
                        
                    }
                    $require_name = implode('<br />',$req_name);
                    $require_status = implode('<br />',$req_status);
                    

                $inputs['loan_type'] = $clientLoanType['code'] . " - " . $clientLoanType['name'];
                $inputs['ACCOUNTNAME'] = strtoupper($clientData['fname'] . " " . substr($clientData['mname'],0,1) . ". " . $clientData['lname']);
                $inputs['SPOUSE'] = strtoupper($clientData['spouse']);
                $inputs['pri_con'] = $clientData['pri_con'];
                $inputs['ADDRESS'] = strtoupper($clientData['home_no'] .(!empty($clientData['home_brgy'])?', Brgy. '.$clientData['home_brgy']:''). ", ". $clientData['home_city']);
                $inputs['term'] = "24 months";
                $inputs['cur_date'] = date('F d,Y');
                $inputs['name_r'] = str_replace("<br />","\par\n",$require_name);
                $inputs['status_r'] = str_replace("<br />","\par\n",$require_status);
                // print_r($inputs);
                // die("");
                $rtf=file_get_contents('credit_advise.rtf');
                $rtf=str_replace("\r\n", '',$rtf);
                foreach($inputs as $tag => $value)
    $rtf= str_replace('\{'.$tag.'\}',$value,$rtf);
    header('Content-type: application/rtf');
    header("Content-Disposition: attachment;filename=credit_advice.rtf");
    header('Pragma:no-cache');
    header('Expires:0');

    echo $rtf;
    exit;
                // die('Working');
            }
                else{
                    $page = "credit_advising.php";
                    redirect($page);
                    Alert("Client Unknown","warning");
                }
        }else{
            $page = "credit_advising.php";
            redirect($page);
            Alert("Client Unknown","warning");
        }
    }else{
        session_destroy();
        redirect($page);
    }