<?php
    require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    makeHead("Credit Advising Form",1);
    
    require_once("../template/header.php");
require_once("../template/sidebar.php");

if(!isset($_GET['id']) || empty($_GET['id'])){
    redirect('credit_advising.php');
    Alert('User not found','warning');
    die();
}



$auth = $con->myQuery('SELECT * FROM loan_list WHERE id = ? AND loan_status_id >= 6 AND is_deleted = 0 ',array($_GET['id']));

if($auth->rowCount() <= 0){
    redirect('credit_advising.php');
    Alert('User not found','warning');
    
}
$data = $auth->fetch(PDO::FETCH_ASSOC);
$loanType = $data['loan_type_id'];
$loanId = $data['id'];
$caf = $con->myQuery("SELECT * FROM caf_info WHERE app_no = ? AND is_deleted = 0",array($data['app_no']));
$cafCount = $caf->rowCount();
$data = $cafCount <= 0?$data:$caf->fetch(PDO::FETCH_ASSOC);
$client = $con->myQuery('SELECT * FROM client_list WHERE client_number = ? AND is_deleted = 0',array($data['client_no']))->fetch(PDO::FETCH_ASSOC);
$data['address'] = $cafCount > 0 ? $data['address'] : $client['home_no'] . !empty($client['home_brgy'] ? ', Brgy. '.$client['home_brgy']:''. ", ". $client['home_city']);
$data['pri_con'] = $cafCount > 0 ? $client['pri_con'] : $data['pri_con'];



// $data = !empty($caf)?$caf:$data;


$borName =$cafCount <= 0?$client['fname'] ." " . substr($client['mname'],0,1). ", ".$client['lname']:$data['client_name'];
$borName = strtoupper($borName);
$RAMON = "RAMON R. RAMOS";
$user = $_SESSION[WEBAPP]['user']['first_name'] . ' ' .$_SESSION[WEBAPP]['user']['middle_initial']." ". $_SESSION[WEBAPP]['user']['last_name'];

$dl=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_dealer='checked' ORDER BY lname")->fetchAll(PDO::FETCH_ASSOC);
$sm=$con->myQuery("SELECT client_number,CONCAT(lname,', ',fname,' ',mname) as name FROM client_list WHERE is_blacklisted=0 AND is_salesman='checked' ORDER BY lname")->fetchAll(PDO::FETCH_ASSOC);

$req = $con->myQuery("SELECT * FROM client_requirements_caf WHERE app_no = ? AND client_no = ? AND is_deleted = 0",array($data['app_no'],$data['client_no']));
// print_r($_SESSION[WEBAPP]);
// die();
$link = "credit_advising.php";
$btnName = "Credit Advising";
$ml = "";
if(isset($_GET['ml'])){
    $link = "credit_advising_master_list.php";
$btnName = "Credit Advising Master List";
$ml = "&ml";
}

?>


<div class="content-wrapper">
	<?php Alert(); ?>
    <section class="content-header">
        <div class="box">
        <div class="box-body">
        <center>
        <h3>  Credit Adivising Form </h3>
        </center>
        <a href='<?php echo $link; ?>'>
        <button type='button' class="btn btn-default"><span class="fa fa-arrow-left"></span> <?php echo $btnName; ?> </button></a><br><br>
    
                <div class="row">
                <hr>
                <form action="save_credit_advising.php" method="post" class="form-horizontal" id="creditAd"> 
                                        <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                                        <input type="hidden" name="client_no" value="<?=$data['client_no']?>">
                                        <input type="hidden" name="ml" value="<?php echo $ml; ?>">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Client Name: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="client_name" value="<?php echo $borName;?>" readonly>
                                            </div>
                                            <label class="col-md-2 control-label">Spouse: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="Spouse" name="spouse" value="<?php echo $data['spouse'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Co-maker: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="co_maker" value="<?php echo $cafCount > 0 ?$data['co_maker']:'' ?>" placeholder="Co-maker" >
                                            </div>
                                            <label class="col-md-2 control-label">Primary Contact No: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="contact_no" placeholder="Primary Contact No." value="<?php echo $data['pri_con'] ?>"  readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-md-3 control-label">Address: </label>                                    
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $data['address'] ?>"; readonly>
                                            </div>
                                        </div>
                                        <div class='form-group'>
                                            <label class="col-sm-3 control-label">Dealer: </label>
                                            <div class='col-sm-3'>
                                                <select class='form-control cbo' name='dealer' id='dealer' data-allow-clear='true' data-placeholder="Select Dealer" data-selected='<?php echo !empty($data)?htmlspecialchars($data['dealer_id']):''; ?>' style="width:100%;">
                                                    <?php echo makeOptions($dl); ?>
                                                </select>
                                            </div>
                                        <label class="col-sm-2 control-label">Salesman: </label>
                                            <div class='col-sm-3'>
                                                <select class='form-control cbo' name='salesman' id='salesman'  data-allow-clear='true' data-placeholder="Select Salesman" data-selected='<?php echo !empty($data)?htmlspecialchars($data['salesman_id']):''; ?>' style="width:100%;">
                                                    <?php echo makeOptions($sm); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Unit: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="unit" value="<?php echo $cafCount >0?$data['unit']:'' ?>" placeholder="Unit" >
                                            </div>
                                            <label class="col-md-2 control-label">List Cash Price: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control ls-type" name="list_cash_price" value="<?php echo $cafCount >0?isEmptyFloat($data['lcp']):'' ?>" placeholder="List Cash Price" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                            </div>
                                            <label class="col-md-2 control-label">Appraised Value: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control ls-type" name="appraised" value="<?php echo $cafCount >0?isEmptyFloat($data['av']):'' ?>" placeholder="Appraised Value" >
                                            </div>
                                        </div>
                                    <hr>
                                        <h3><center> For Financing Utility </center></h3>
                                        <br><br>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Downpayment: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control ls-type" name="downpayment" value="<?php echo $cafCount >0?isEmptyFloat($data['downpayment']):'' ?>" placeholder="Downpayment">
                                            </div>
                                            <label class="col-md-2 control-label">Amount Financed: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control ls-type" name="amount_financed" value="<?php echo $cafCount >0?isEmptyFloat($data['amount_fin']):'' ?>" placeholder="Amount Financed">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Term: </label>
                                            <div class="col-md-3">
                                            <div class="input-group">
                                            <input type="text" class="form-control numeric" name="term" value="<?php echo $cafCount >0?isEmptyInt($data['term']):'' ?>" placeholder="Term">
                                            <span class="input-group-addon bg-blue">months</span>
                                            </div>
                                            </div>
                                            <label class="col-md-2 control-label">Interest Rate: </label>
                                            <div class="col-md-3">
                                            <div class="input-group">
                                            <input type="text" class="form-control ls-type" name="interest_rate" value="<?php echo $cafCount >0?isEmptyFloat($data['int_rate']):'' ?>" placeholder="Interest Rate">
                                            <span class="input-group-addon bg-blue">%</span>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-md-3 control-label">Monthly Payment: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control ls-type" name="monthly_payment" value="<?php echo $cafCount >0?isEmptyFloat($data['mon_first']):'' ?>" placeholder="1st Payment">
                                            </div>
                                            <label for="" class="col-md-2">&larr; 1st Payment</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-md-3 text-right">Monthly Payment: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control ls-type" name="second_payment" value="<?php echo $cafCount >0?isEmptyFloat($data['mon_second']):'' ?>" placeholder="2nd Payment">
                                            </div>
                                            <label for="" class="col-md-2">&larr; 2nd Payment</label>
                                        </div>
                                      
                                    <hr>
                                    <center><h3>Requirements</h3></center>
                                    <center>
                                    <div class="form-group">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                        <select name="reqSel[]" id="reqSel" class="form-control cbo" style="width:100%;"  data-placeholder="Select a requirement" multiple>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <button class="btn btn-primary" type="button" id="addReq"> Add Requirement </button>
                                    </div>
                                    </center>
                                    <div class="box-body">
                                    <table id='dataTables' class="table responsive-table table-bordered table-striped" >
                                        <thead>
                                            <tr >
                                                <th>Requirement No.</th>
                                                <th>Requirement Code</th>
                                                <th>Requirement Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <?php if($req->rowCount() > 0 ) :?>
                                                <?php while($row = $req->fetch(PDO::FETCH_ASSOC)) : ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['requirement_code']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['requirement_name']); ?></td>
                                                        <td>
                                                        <select name="status[<?php echo $row['requirement_code']; ?>]" id="" class="form-control cbo" data-placeholder="Select a status" style="width:100%;" data-allow-clear="true" data-selected="<?php echo $row['status']; ?>">                        
                                                            <option value="received" >Received</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="to_follow">To Follow</option>
                                                        </select>
                                                        </td>
                                                        <td class="text-center"><a href="delReq.php<?php echo "?tblid=".$row['id']."&id=".$_GET['id'] ?>" class="btn btn-danger"><span class="fa fa-trash"></span> </a></td>
                                                    </tr>
                                                <?php endwhile;?>
                                            <?php else: ?>
                                            <tr>
                                                <td colspan="5">No Record Found.</td>
                                            </tr>
                                            <?php endif;?>
                                                
                                        </tbody>
                                    </table>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="" class="col-md-3 control-label">Prepared By: </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="prepared_by" value="<?php echo $user;?>" readonly>
                                        </div>
                                        <label for="" class="col-md-2 control-label">Noted By: </label>
                                        <div class="col-md-3">
                                        
                                        <input type="text" class="form-control" name="noted_by" value="<?php echo $RAMON;?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                    <?php if($cafCount <= 0) :?>
                                    <input type="hidden" name="create" id="create" value="create">
                                    <button type="submit" class="btn btn-primary" name="submit" id="submit"> Save </button>
                                    <?php else: ?>
                                    <input type="hidden" name="tblCaf" id="tblCaf" value="<?php echo $cafCount > 0 ? $data['id'] : '';?>">
                                    <input type="hidden" name="edit" id="edit" value="edit">
                                    <button type="submit" class="btn btn-info" name="submit" id="submit"> <span class="fa fa-edit"></span> Update </button>
                                    </form>
                                    <form action="printCAF.php" method="POST" target="_blank" style="display:inline;">
                                    <input type="hidden" name="tblid" value="<?php echo $cafCount > 0 ? $data['id'] : '';?>">
                                    <input type="hidden" name="app_no" value="<?php echo $cafCount > 0 ? $data['app_no'] : '';?>">
                                    <input type="hidden" name="client_no" value="<?php echo $cafCount > 0 ? $data['client_no'] : '';?>">
                                    <button type="submit" class="btn btn-default bg-grey"> <span class="fa fa-print"></span> Print </button>
                                    </form>
                                    <?php endif;?>
                                    <a href="credit_advising.php" class="btn btn-default" name="cancel"> Cancel </a>
                                    </div>
                                    
                </div>
        </div>
        </div>
    </section>
    </div>

    <script>

        $(document).ready(function() {

            $('.ls-type').each(function() {
            $(this).click(function() {$(this).select();});
                $(this).focus(function() {
                    $(this).select();
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


            $('form#creditAd').submit(function(){
                $('#submit').attr('disabled',true).html('Saving data...');
                
            });
            
        $('#addReq').click(function() {
            var reqSel = [];
            $('#reqSel').select2('data').forEach(function(data) {
                reqSel.push(data['element']['value']);
            });
            
            
            if(reqSel.length){
                $.ajax({
                    url: "ajax/AddReq.php",
                    method: "POST",
                    data: {code: reqSel, appNo: <?php echo $data['app_no']; ?> , clientNo: <?php echo $data['client_no']; ?>},
                    success: function() {
                        reqOption();
                        edit(<?php echo $_GET['id']; ?>);
                    },error: function(msg) {console.log(msg.responseText);}
                });
            }
            else{
                alert("Please choose a requirement to add.");
                
            }
            return false;
        });
            function reqOption(){
            $.ajax({
                url: "ajax/cafReq.php",
                method: "POST",
                data: {loanCode: <?php echo $loanType; ?>,id: <?php echo $loanId; ?>},
                dataType: "json",
                success: function(data) {
                    if(data != null){
                        const option = data;
                        option.forEach(function(obj) {
                        $('#'+obj.name).html(obj.value);
                        $('#reqSel').attr('disabled',false);
                        $('#addReq').attr('disabled',false);
                    });
                    }else{
                        $('#reqSel').attr('disabled',true);
                        $('#addReq').attr('disabled',true);
                    }
                },error: function(msg) {console.log(msg.responseText)}
            });
        }
        reqOption();
        
        function edit(id){
    var href = window.location.href;
    var string = href.substr(0,href.lastIndexOf('/'))+"/credit_advising_form.php?id="+ id;
    window.location=string;
}

        });
        
    </script>
    <?php
Modal();
makeFoot(WEBAPP,1);
?>