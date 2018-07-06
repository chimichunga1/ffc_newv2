<?php 
if(!empty($_POST['num']) && !empty($_POST['name'])){
    $limit = 100.00;
    $data = "";
    $auth = str_replace(',','',$_POST['num']);
    if(strpos($_POST['name'],'rate') > 0 || strpos($_POST['name'],'udi_alir') > 0){
        if(filter_var($_POST['num'],FILTER_VALIDATE_FLOAT)){
                if((float)$auth <= 0.00 || (float)$auth > $limit ){
                    $data = "";       
                }else{
                    $data = number_format($_POST['num'],2,'.',','); 
                }    
        }
    }else{
        if(filter_var($_POST['num'],FILTER_VALIDATE_FLOAT) && !empty($_POST['num'])){
            $data = number_format($_POST['num'],2,'.',',');
        }
    }
    echo $data;
}