<?php 
	function floatConvert($num){
		return number_format((float)$num,2,'.',',');
	}



    if(!empty($_POST['pnAmt']) && !empty($_POST['disc'])){
        $pn = str_replace(',','',$_POST['pnAmt']);
        $disc = str_replace(',','',$_POST['disc']);
        $disc = $disc>$pn?0.00:$disc;

        $true[0]['name'] = "discount";
        $true[0]['value'] = floatConvert($disc);

        $true[1]['name'] = "net_proceeds";
        $true[1]['value'] = floatConvert((float)$pn-(float)$disc);

        $true[2]['name'] = "pn_amount";
        $true[2]['value'] = floatConvert($pn);
    }

    echo json_encode($true);