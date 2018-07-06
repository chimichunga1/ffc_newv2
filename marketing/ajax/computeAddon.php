<?php 

    if(!empty($_POST['listcp']) || !empty($_POST['appVal']) && strlen($_POST['addOn']) <= 6){

        /*
            Variables
        */
            
            $_POST['addOn'] = empty($_POST['addOn'])?0:$_POST['addOn'];
            $_POST['amtFin'] = empty($_POST['amtFin'])?0:str_replace(',','',$_POST['amtFin']);
            $_POST['rcf'] = empty($_POST['rcf'])?0:$_POST['rcf'];
            $_POST['term'] = empty($_POST['term'])?0:$_POST['term'];
            $_POST['addOn'] = ((float)$_POST['addOn'] > 100.00)?0:$_POST['addOn'];
            $_POST['less'] = ((float)$_POST['less'] > 100.00)?0:$_POST['less'];
            $pn = 0;

            

        $outputs[0]['name'] = "amount_financed";
        if(empty($_POST['downGau'])){$outputs[0]['value'] = (float)$_POST['amtFin'];}
        else{$outputs[0]['value'] = empty($_POST['appVal'])?((float)$_POST['listcp'] - (float)$_POST['downGau']):((float)$_POST['appVal'] - (float)$_POST['downGau']);}
        $amt_fin = $outputs[0]['value'];
        $outputs[0]['value'] = number_format((float)$amt_fin,2,'.',',');
        if((float)$_POST['addOn'] <= 100.00){
            $outputs[1]['name'] = "pn_amount";
            $outputs[1]['value'] = (($_POST['addOn'] / 100)+1) * $amt_fin;
            $pn = $outputs[1]['value'];
            $outputs[2]['name']  = "pn_amount_2";
            $outputs[2]['value'] = $outputs[1]['value'];
            $outputs[3]['name']  = "rcf";
            $outputs[3]['value'] = (float)$_POST['rcf'] * (float)$_POST['term'];
            $outputs[4]['name']  = "total_loan_value";
            $outputs[4]['value'] = $outputs[1]['value'] + $outputs[3]['value'];
            $outputs[5]['name']  = "second_payment";
            $outputs[5]['value'] = $outputs[4]['value'] / (float)$_POST['term'];
            $outputs[6]['name']  = "mon_first";
            $outputs[6]['value'] =  $outputs[4]['value'] - floor($outputs[5]['value']) * ((float)$_POST['term']-1);

            $outputs[1]['value'] = number_format((float)$outputs[1]['value'],2,'.',',');
            $outputs[2]['value'] = number_format((float)$outputs[2]['value'],2,'.',',');
            $outputs[3]['value'] = number_format((float)$outputs[3]['value'],2,'.',',');
            $outputs[4]['value'] = number_format((float)$outputs[4]['value'],2,'.',',');
            $outputs[5]['value'] = number_format(floor((float)$outputs[5]['value']),2,'.',',');
            $outputs[6]['value'] = number_format(ceil((float)$outputs[6]['value']),2,'.',',');
                if((float)$_POST['less'] <= 100.00){
                    $less_per = (float)$_POST['less'] / 100;
                    $outputs[7]['name'] = "less_total";
                    $outputs[7]['value'] = $less_per * (float)$pn;
                    $outputs[8]['name'] = "total_above";
                    $outputs[8]['value'] = (float)$pn - $outputs[7]['value'];
                    
                    $outputs[7]['value'] = number_format((float)$outputs[7]['value'],2,'.',',');
                    $outputs[8]['value'] = number_format((float)$outputs[8]['value'],2,'.',',');
                }
        }
    }
    $count = count($outputs);
    $outputs[$count]['name'] = 'term';
    $outputs[$count]['value'] = $_POST['term'];
        echo json_encode($outputs);

   