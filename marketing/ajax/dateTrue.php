<?php 
    // function dateCheck($date, $custom = null){

    //     $date = explode('/',$date);
    //     if($custom){ $date[1] = $custom;}
    //         else{if($date[1] > 28){$date[1] = 28;}}
    //     return $date = implode('/',$date);
    // }
    function dateCon($date){
        return date_format(date_create($date),'m/d/Y');
    }

    if(!empty($_POST['date'])){
        $date = $_POST['date'];
            
        $date = explode('/',$date);
            if($date[1] > 28){$date[1] = 28;}
        
        $date = implode('/',$date);


        $dates['name'] = "#start_date";
        $dates['value'] = dateCon($date);
        // $date = date_create($date);
        // $valDate = date_create($valDate);
        // // $_POST['term'] = $_POST['term'] = 1?2:$_POST['term'];
        // $term = (float)$_POST['term'] . " days";
        // date_add($date,date_interval_create_from_date_string($term));
        // date_sub($valDate,date_interval_create_from_date_string("30 days"));
        
        // $day = explode('/',$start);
    
        // $dates[0]['name'] = "start_date";
        // $dates[0]['value'] = dateCon($start);

        // $date = date_format($date,'m/d/Y');
        // $date = dateCheck($date);
        // $dates[1]['name'] = "maturity_date";
        // $dates[1]['value'] = dateCon($date);
        
        // $valDate = date_format($valDate,'m/d/Y');
        // $valDate = dateCheck($valDate,$day[1]);

        // $dates[2]['name'] = "value_date";
        // $dates[2]['value'] = dateCon($valDate);

        // $dates[3]['name'] = "term";
        // $dates[3]['value'] = str_replace(' days','',$term);
            
    echo json_encode($dates);
    }

    