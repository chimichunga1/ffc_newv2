<?php 
 if(!empty($_POST['name'])){
     $total = str_replace('fee','total',$_POST['name']);
     $amtOr =!empty($_POST['amtOr'])?$_POST['amtOr']:0.00;
     $fee[0]['name'] = $total;
     $fee[0]['value'] = ((float)$_POST['amtOr'] > (float)$_POST['amt'])?"0.00":(float)$_POST['amtOr'];

     $fee[1]['name'] = $total . "_above";
     $fee[1]['value']= abs((float)$_POST['amt'] - (float)$amtOr);

     $fee[0]['value'] = number_format((float)$fee[0]['value'],2,'.',',');
     $fee[1]['value'] = number_format((float)$fee[1]['value'],2,'.',',');
 }   
echo json_encode($fee);