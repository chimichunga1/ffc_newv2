    <?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    if (empty($_GET['tab'])) {
          
        redirect("instruction_sheet_prep.php");
    
    } elseif($_GET['tab'] < 1 || $_GET['tab'] > 2) {
        redirect("instruction_sheet_prep.php");
    }
 
    if(empty($_GET['id']) || !isset($_GET['id'])){
        redirect("instruction_sheet_prep.php");
    }
        $auth = $con->myQuery("SELECT * FROM loan_list WHERE id=".$_GET['id']." AND is_deleted=0")->fetchColumn();
            if($auth <= 0){
                redirect("instruction_sheet_prep.php");
            }
    
    makeHead("Instruction Sheet Preparation",1);

    function dateCon($date){
        return date_format(date_create($date),'m/d/Y');
    }

    require_once("../template/header.php");
    require_once("../template/sidebar.php");
    $data=$con->myQuery("SELECT * FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
    $print = $con->myQuery('SELECT * FROM td_sched WHERE app_no = ?',array($data['app_no']))->rowCount();
if($print > 0){
        require_once('computeTrue.php');
}
    $client = $con->myQuery("SELECT * FROM client_list WHERE client_number=? AND is_deleted=0",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);
    $dataIn = array(
        'app_no' => $data['app_no'],
        'client_no' => $data['client_no']
    );
    $dl=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_dealer='checked' ORDER BY lname")->fetchAll(PDO::FETCH_ASSOC);
    $sm=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_salesman='checked' ORDER BY lname")->fetchAll(PDO::FETCH_ASSOC);
    $mp = $con->myQuery("SELECT id,CONCAT(code,' - ',name) AS paymentName FROM manner_of_payment WHERE is_deleted = 0")->fetchAll(PDO::FETCH_ASSOC);
    $printISType = $con->myQuery("SELECT * FROM loan_approval_type WHERE id = :loan_id",array('loan_id' => $data['loan_type_id']))->fetch(PDO::FETCH_ASSOC);
    $clientLoan = $con->myQuery("SELECT B.code AS loan_type_code , 
                                        C.code AS credit_facility_code, 
                                        D.code AS prod_line_code, 
                                        E.code AS marketing_type_code
FROM loan_list A
JOIN loan_approval_type B ON A.loan_type_id = B.id
JOIN credit_facility C ON A.credit_fac_id = C.id 
JOIN product_line D ON A.prod_line_id = D.id
JOIN marketing_type E ON A.mark_type_id = E.id
WHERE A.id=? AND A.client_no=?
",array($_GET['id'],$data['client_no']))->fetch(PDO::FETCH_ASSOC);
$clientOtherLoan = $con->myQuery("SELECT B.name AS bus_code, C.name AS ind_code
FROM client_list A
JOIN business_type B ON A.bus_type_id = B.id
JOIN industry_code C ON A.ind_code_id = C.id
WHERE A.client_number = :client_num",array('client_num'=>$data['client_no']))->fetch(PDO::FETCH_ASSOC);

$bank = $con->myQuery("SELECT * FROM bank WHERE is_deleted=0")->fetchAll(PDO::FETCH_ASSOC);

$clientAddon = $con->myQuery("SELECT * FROM instruction_sheet_td WHERE app_no = :app_no AND client_no = :client_no AND is_deleted = 0",$dataIn)->fetch(PDO::FETCH_ASSOC);
$countAddon = $con->myQuery("SELECT * FROM instruction_sheet_td WHERE app_no = :app_no AND client_no = :client_no AND is_deleted= 0",$dataIn)->fetchColumn();
    $bor_name = (empty($client['lname'])?'':$client['lname'].',') . " ".$client['fname'] ." " . substr($client['mname'],0,1);

    $clientStatus = !empty($clientAddon['client_stat'])?$clientAddon['client_stat']:cStat($client['status_id']);

?>
<div class="content-wrapper">
	
    <section class="content-header">
        <?php
            Alert();
            
        ?>
        <div class="box">
        <div class="box-body">
        <center>
        <h3> Instruction Sheet Preparation (<?php echo $printISType['name'] ?>) </h3>
        </center>
        <a href='instruction_sheet_prep.php'>
        <button type='button' class="btn btn-default"><span class="fa fa-arrow-left"></span> Instruction Sheet Lists</button></a><br><br>
                <div class="row">
                <div class='col-md-12'>
                          <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li <?php if ($_GET['tab'] == 1) {echo "class='active'";} echo "><a href='instruction_sheet_td.php?id=".$_GET['id']."&tab=1'"; ?> >Instruction Sheet Information</a>
                                </li>

                                <li <?php if ($_GET['tab'] == 2) {echo "class='active'";} echo "><a href='instruction_sheet_td.php?id=".$_GET['id']."&tab=2'"; ?> >True Discounting Schedule</a>
                                </li>
                              
                            </ul>
                          </div>
                        </div>
                    <div class="tab-content">
                    <div class="active tab-pane" >
                            <?php
                                switch ($_GET['tab']) {
                                
                                    case '1':
                                        #Project Details
                                       
                                        $form='main_is_td.php';
                                    break;
                                    
                                    case '2':
                                        #Project Details
                                        $form='td_schedule.php';
                                    break;
                                    
                                }
                                require_once($form);
                            ?>
                    </div>
                    </div>
                </div>		
            </div>
        </div>
        </div>
    </section>
    
     
    </div>

<script>
    $('#start_date').blur(function() {
    var startDate = $(this).val();
        $.ajax({
            url: "ajax/dateTrue.php",
            method: "POST",
            data: {date: startDate},
            dataType: "json",
            success: function(data) {
                const date = data;
                $(''+date.name).val(date.value);
            }, 
            error: function(msg){console.log(msg.responseText);}
        });
    });
function forceCompute(netSum){
    var sumAll = 0,
        subTotal = $('input[name="net_proceeds"]').val(),
        subTotal = parseFloat(subTotal.split(',').join(''));
        subTotal = !subTotal?"0.00":subTotal;

        
        netSum = parseFloat(netSum.split(',').join(''));
    $('input[name$="_total_above"]').each(function(){
        var val = $(this).val();
        if(val){
            val = parseFloat(val.split(',').join(''));
            sumAll += val;
        }
    });
    lockValue(sumAll,"sum_all_fee");
    lockValue(netSum - sumAll,"amount_due");
}

function orAble() {
    $('input[name$="_fee"]').each(function(){
        if($(this).attr('name') != "sum_all_fee"){
            if($(this).val()){
                var next = $(this).attr('name'),
                    next = next.replace('_fee','_total');
                    $('input[name="'+next+'"]').attr('readonly',false);
            }
        }
    });
}
orAble();

$(document).ready(function() {

function dsFee() {
    $('#sm_fee, #dealer_fee').each(function(){
        if($(this).attr('id') == "sm_fee"){
            if($(this).val()){
                $('#salesman_id').attr('disabled',false).attr('required',true);
            }else{
                $('#salesman_id').attr('disabled',true).attr('required',false);
                $('#salesman_id').val(null).trigger('change');
            }
        }
        if($(this).attr('id') == "dealer_fee"){
            if($(this).val()){
                $('#dealer_id').attr('disabled',false).attr('required',true);
            }else{
                $('#dealer_id').attr('disabled',true).attr('required',false);
                $('#dealer_id').val(null).trigger('change');
            }
        }
        $(this).blur(function() {
        if($(this).attr('id') == "sm_fee"){
            if($(this).val()){
                $('#salesman_id').attr('disabled',false).attr('required',true);
            }else{
                $('#salesman_id').attr('disabled',true).attr('required',false);
                $('#salesman_id').val(null).trigger('change');
            }
        }
        if($(this).attr('id') == "dealer_fee"){
            if($(this).val()){
                $('#dealer_id').attr('disabled',false).attr('required',true);
            }else{
                $('#dealer_id').attr('disabled',true).attr('required',false);
                $('#dealer_id').val(null).trigger('change');
            }
        }
        });
    });
}
dsFee();



$('#frmclear').submit(function(){
    var button = $(this).find('input#SaveInstruction');
    button.attr('disabled','disabled').val('Saving data...');
});
$('.ls-lock').each(function() {
    var val = $(this).val(),
        valName = $(this).attr('name');
    if(!isNaN(parseFloat(val)) && val != "" && val != null){
            lockValue(val,valName);
    }
});
$('.ls-type').each(function() {
        $(this).on('click',function() {$(this).select();});
        $(this).focus(function() {
            var val = $(this).val();
            if(val != "" && !isNaN(parseFloat(val))){
                $(this).val(val.split(',').join(''));
            }else{
                $(this).val('');
            }
        })
        .blur(function() {
            var val = $(this).val(),
            valName = $(this).attr('name');
            if(!isNaN(parseFloat(val)) && val != ""){
                typeValue(val,valName);
            }else{
                $(this).val('');
            }
        });
    });
});

function typeValue(v,n){
    $.ajax({
        url: "ajax/typeConvert.php",
        method: "POST",
        data: {num: v, name:n},
        dataType:"html",
        success: function(data) {
            $('input[name="'+n+'"').val(data);
        },
        error: function(msg) {
            console.log(msg.responseText);
        }
    });
}

function lockValue(v,n) {
    $.ajax({
        url: "ajax/lockConvert.php",
        method: "POST",
        data: {num: v},
        dataType:"html",
        success: function(data) {
            $('input[name="'+n+'"]').val((data)?data:'');      
        },
        error: function(msg) {
            console.log(msg.responseText);
        }
    });
}



$('input[name$="_fee"]').each(function() {
        var name = $(this).attr('name'),
            disTotal = name.replace('fee','total'),
            disTotal = $('input[name="'+disTotal+'"]');
    if(name != "sum_all_fee"){
        $(this).click(function(){$(this).select();});
        disTotal.on('focus',function() {$(this).select();});
        $(this).change(function() {
            var val = $(this).val(),
                disVal = "";
                computeFee(name, val, disVal);
            if(!isNaN(parseFloat(val.split(',').join('')))){
                disTotal.on('click',function() {$(this).select();});
                disTotal.attr('readonly',false);
                disTotal.change(function(){
                    disVal = $(this).val();
                    computeFee(name, val, disVal);
                    $(this).val((parseFloat(disVal) > parseFloat(val))?'':disVal);
                    });
                }
            else{
                disTotal.val('');
                disTotal.attr('readonly',true);
                }
        });
      
        $(disTotal).on('change',function() {
            var val = $('input[name="'+name+'"]').val(),
                val = val.split(',').join(''),
                orVal = $(this).val(),
                orVal = orVal.split(',').join('');
                if(!isNaN(parseFloat(orVal))){
                    computeFee(name,val,orVal);
                }
        });

    }
});

function computeFee(name, val, disVal){
     $.ajax({
        url: "ajax/computeFees.php",
        method: "POST",
        dataType:"json",
        data:{name: name, amt: val, amtOr: disVal},
        success: function(data) {
            var sumAll = 0;
            const fee = data;
            fee.forEach(function(fee){
                $('input[name="'+fee.name+'"]').val(fee.value);
            });
            computeAll();
            computeOr();
        },
        error: function(msg){console.log(msg.responseText);}
    });
}

function computeAll(){
    var sumAll = 0,
        subTotal = $('input[name="net_proceeds"]').val(),
        subTotal = parseFloat(subTotal.split(',').join(''));
        subTotal = !subTotal?"0.00":subTotal;
    $('input[name$="_total_above"]').each(function(){
        var val = $(this).val();
        if(val){
            val = parseFloat(val.split(',').join(''));
            sumAll += val;
        }
    });

    lockValue(sumAll,"sum_all_fee");
    lockValue(subTotal-sumAll,"amount_due");
}

function computeOr(){
    var sumOr = 0;
    $('input[name$="_total"]').each(function() {
        var val = $(this).val(),
            val = val.split(',').join('');
        if(!isNaN(parseFloat(val)) && $(this).attr('name') != "less_total"){
            sumOr += parseFloat(val);
        }

    });
    lockValue(sumOr,"or_amount");

}

  function edit(id,idEE){
  
  var href = window.location.href;
  var string = href.substr(0,href.lastIndexOf('/'))+"/instruction_sheet_td.php?id=" + id + "&tab=2&ee="+idEE;
  window.location=string;
}

</script>





<?php
Modal();
makeFoot(WEBAPP,1);
?>
