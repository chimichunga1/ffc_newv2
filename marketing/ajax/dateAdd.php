<?php 

    if(!empty($_POST['date']) && !empty($_POST['term'])){
        $date = $_POST['date'];
        $validate =  explode('/',$date);
        $dayStart = $validate[1];
            if($validate[1] > 28){
                $dayStart = $validate[1] = 28;
            }
            
        $start = $valDate = $date = implode('/',$validate);

        $date = date_create($date);
        $valDate = date_create($valDate);
        // $_POST['term'] = $_POST['term'] = 1?2:$_POST['term'];
        $term = (float)$_POST['term'] - 1  . " months";
        date_add($date,date_interval_create_from_date_string($term));
        date_sub($valDate,date_interval_create_from_date_string("30 days"));
        
        $valDate = date_format($valDate,'m/d/Y');
        $valValidate = explode('/',$valDate);
        $valValidate[1] = $dayStart;
        $valDate = implode('/',$valValidate);
        
        $dates[0]['name']  = "maturity_date";
        $dates[0]['value'] = date_format($date,"m/d/Y");

        $dates[1]['name']  = "duedate";
        $dates[1]['value'] = date_format($date,"d");

        $dates[2]['name']  = "value_date";
        $dates[2]['value'] = $valDate;

        $dates[3]['name'] = "start_date";
        $dates[3]['value'] = date_format(date_create($start),"m/d/Y");
    echo json_encode($dates);
    }

    