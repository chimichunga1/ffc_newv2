<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
        toLogin();
        die();
    }
    
    if(!AllowUser(array(1,2))){
        redirect("index.php");
    }
    
if(empty($data)){
    redirect("ci_checking.php");
}
?>
	<?php
        Alert();
        // $data = array(
        //     'BRSC' => 'Board Resolution or Secretary Certificate (If Corpoartion)',
        //     'LCTC' => 'Latest CTC(Residence Certificate)',
        //     'TID'  => 'TIN ID',
        //     '2x2'  => '2x2 Picture',
        //     '2val' => 'Two (2) Valid I.D',
        //     'LD'   => 'LOAN DOCUMENTS (Application Form / Chattel Mortgage / Promissory Note / Disclosure Statement / Accesptance of Unit / Authority to make Payment)',
        //     'AFD'  => 'Affidavit of Full Disclosure',
        //     'OLTO' => 'Original LTO OR / CR',
        //     'SLTO' => 'Stencil in LTO Form / Onion Skin',
        //     'DDR'  => "Dealer's Delivery Receipt",
        //     'DDI'  => "Dealer's Sales Invoice",
        //     'DORD' => "Dealer's O.R of Downpayment",
        //     'CCP'  => 'Custom Certificate of Payment',
        //     'PC'   => 'PNP Clearance',
        //     'ME'   => 'Micro - Etching',
        //     'IP'   => 'Insurance Policy',
        //     'IOR'  => 'Insurance O.R',
        //     'OF'   => 'Other Fees (Processing Fee / Chattel Mortgage Fee / Doc.Stamp)',
        //     'O'    => 'Others:'
        // ) ;

        //for restricting fields later enchancement
        $loan = $con->myQuery("SELECT * FROM loan_approval_type WHERE id=:id",array('id'=>$data['loan_type_id']))->fetch(PDO::FETCH_ASSOC);
        $requirement = $con->myQuery("SELECT * FROM client_requirements_caf WHERE client_no=:client_no AND application_no=:app_no AND is_deleted=0",array('client_no'=>$data['client_no'],'app_no'=>$data['id']));
        $fullname = $client['fname'] . " " . $client['mname']. " " . $client['lname'];
        $fulladd = $client['home_no'] . ((empty($client['home_brgy'])) ? '' : ' Brgy. '.$client['home_brgy'].' ') . $client['home_city']; 
        $user = $_SESSION[WEBAPP]['user']['first_name'] . " " . $_SESSION[WEBAPP]['user']['middle_initial']  ." ".  $_SESSION[WEBAPP]['user']['last_name'];
        $RAMON = "RAMON R. RAMOS";
        $caf_user = $con->myQuery("SELECT * FROM caf_info WHERE client_no =:client_no AND application_no = :app_no",array('client_no'=>$data['client_no'], 'app_no'=>$data['id']))->fetch(PDO::FETCH_ASSOC);
       
    ?>

                                    <hr>
                                    <form action="save_credit_advising.php" method="post" class="form-horizontal"> 
                                        <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
                                        <input type="hidden" name="tbl_id" value="<?php echo (empty($caf_user['id'])?"":$caf_user['id']) ?>">
                                        <input type="hidden" name="client_no" value="<?=$data['client_no']?>">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Client Name: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="client_name" value="<?php echo $fullname;?>" readonly>
                                            </div>
                                            <label class="col-md-2 control-label">Spouse: </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="spouse" value="<?php echo $client['spouse'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Co-maker:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="co_maker" value="<?php echo (empty($caf_user['co_maker'])?"":$caf_user['co_maker']) ?>" required>
                                            </div>
                                            <label class="col-md-2 control-label">Primary Contact No:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="contact_no" value="<?php echo $client['pri_con'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-md-3 control-label">Address:* </label>                                    
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="address" value="<?php echo $fulladd;?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Dealer:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="dealer" value="<?php echo (empty($caf_user['dealer'])?"":$caf_user['dealer']) ?>" required>
                                            </div>
                                            <label class="col-md-2 control-label">Salesman:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="salesman" value="<?php echo (empty($caf_user['salesman'])?"":$caf_user['salesman']) ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Unit:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="unit" value="<?php echo (empty($caf_user['unit'])?"":$caf_user['unit']) ?>" required>
                                            </div>
                                            <label class="col-md-2 control-label">List Cash Price:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control numeric" name="list_cash_price" value="<?php echo (empty($caf_user['list_cash_price'])?"":$caf_user['list_cash_price']) ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                            </div>
                                            <label class="col-md-2 control-label">Appraised Value:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control numeric" name="appraised" value="<?php echo (empty($caf_user['appraised_value'])?"":$caf_user['appraised_value']) ?>" required>
                                            </div>
                                        </div>
                                    <hr>
                                        <center> <strong>For Financing Utility</strong> </center>
                                        <br><br>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Downpayment:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control numeric" name="downpayment" value="<?php echo (empty($caf_user['downpayment'])?"":$caf_user['downpayment']) ?>" required>
                                            </div>
                                            <label class="col-md-2 control-label">Amount Financed:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control numeric" name="amount_financed" value="<?php echo (empty($caf_user['amount_financed'])?"":$caf_user['amount_financed']) ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Term:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control numeric" name="term" value="<?php echo (empty($caf_user['term'])?"":$caf_user['term']) ?>" required>
                                            </div>
                                            <label class="col-md-2 control-label">Interest Rate:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control numeric" name="interest_rate" value="<?php echo (empty($caf_user['interest_rate'])?"":$caf_user['interest_rate']) ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-md-3 control-label">Monthly Payment:* </label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="monthly_payment" value="<?php echo (empty($caf_user['monthly_payment'])?"":$caf_user['monthly_payment']) ?>" required>
                                            </div>
                                            <label for="" class="col-md-2">&larr; 1st Payment</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-md-3 text-right">*</label>
                                            <div class="col-md-3">
                                            <input type="text" class="form-control" name="second_payment" value="<?php echo (empty($caf_user['second_payment'])?"":$caf_user['second_payment']) ?>" required>
                                            </div>
                                            <label for="" class="col-md-2">&larr; 2nd Payment</label>
                                        </div>
                                        <hr>
                                    <center><strong>Requirement: <?php echo $loan['name'];?></strong></center>
                                    <br><br>
                                    <center>
                                        <strong>
                                            <h6>Check the box if submitted.</h6>
                                        </strong>
                                    </center>
                                    
                                    <?php while($row = $requirement->fetch(PDO::FETCH_ASSOC)) : ?>
                                        <div class="form-group">
                                            <label for="" class="col-md-5 control-label"><?=$row['requirement_name']?>: </label>
                                            
                                            <div class="col-md-3 checkbox">
                                            <center>
                                                <input type="checkbox" name="req[]" value="<?=$row['requirement_code']?>" <?php echo ($row['status']==="received")?'checked':'' ?>>
                                                </center>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                    
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
                                    <div class="form-group">
					                    <div class="col-sm-11 col-md-offset-1 text-center">
                                        <?php if($caf_user['client_no']) : ?>
                                        <button type='submit' name="update" class='btn btn-info'>Update </button>
                                        <?php else:?>           
					      	                <button type='submit' name="submit" class='btn btn-primary' data-submit-title="Saving...">Save </button>
                                        <?php endif;?>
					                    	<!-- <a href='#' class='btn btn-default'>Cancel</a> -->
					                     </div>
					                 </div>
                                    </form>
<?php 
require_once('../include/modal_credit_advising.php');
?>                                    

<script type="text/javascript">
$('.form-horizontal').on('submit',function() {
    var self = $(this),
        button = self.find('button[type="submit"], button'),
        submitVal = button.data('submit-title');
    button.attr('disabled','disabled').html((submitVal)?submitVal:'');

});


function openModal(){
    $('#submit_modal').modal('show');
}

	function redirect(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/journal_entry.php?id=" + id;
		window.location=string;
	};
	
	function archive(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/php/archive.php?id=" + id;
		window.location=string;
	}
	
	function edit(id){
	
		//window.location ="/journal_entry.php?id=" + id;
		var href = window.location.href;
		var string = href.substr(0,href.lastIndexOf('/'))+"/create_loan.php?id=" + id;
		window.location=string;
	}
	    function filter_search()
    {
            dttable.ajax.reload();
            //console.log(dttable);
    }
    
</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>
