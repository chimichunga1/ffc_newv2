<?php
require_once("../support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}

if(!AllowUser(array(1))){
  redirect("../index.php");
}

makeHead("Manner of Payment",1);

require_once("../template/header.php");
require_once("../template/sidebar.php");
if (!empty($_GET['id'])) {
		$data=$con->myQuery("SELECT * FROM manner_of_payment WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="content-wrapper">

<section class="content-header">
	<?php
		Alert();
		
	?>
	<div class="box">
	<div class="box-body">
	<center>
	<h3> Manner of Payment Form </h3>
	</center>
	<hr>
			<div class="row">
                <form action="save_manner_of_payment.php" method="post" class="form-horizontal" id='frmclear'>
                	 <input type='hidden' name='id' id='id' value="<?php echo !empty($_GET['id'])?htmlspecialchars($_GET['id']):''?>">
					 <div class='form-group'>
                     <label class="col-md-4 control-label">Payment Type Code: </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="payment_code" name='payment_code' placeholder="Payment Type Code" value='<?php echo !empty($data)?htmlspecialchars($data['code']):''; ?>' required>
                      </div>
                  </div>
                   <div class='form-group'>
                     <label class="col-md-4 control-label">Payment Name: </label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" id="payment_name" name='payment_name' placeholder="Payment Name" value='<?php echo !empty($data)?htmlspecialchars($data['name']):''; ?>' required>
                      </div>
                  </div> 
                  <div class="col-sm-11 col-md-offset-1 text-center">
                    <button type='submit' class='btn btn-primary'>Save </button>
                    <a href='manner_of_payment.php' class='btn btn-default'>Cancel</a><br>
                </div>
                </form>
            </div>		
		</div>
	</div>
	</div>
</section>

 
</div>



<script type="text/javascript">

	// function redirect(id){
	
	// 	//window.location ="/journal_entry.php?id=" + id;
	// 	var href = window.location.href;
	// 	var string = href.substr(0,href.lastIndexOf('/'))+"/journal_entry.php?id=" + id;
	// 	window.location=string;
	// };
	
	// function archive(id){
	
	// 	//window.location ="/journal_entry.php?id=" + id;
	// 	var href = window.location.href;
	// 	var string = href.substr(0,href.lastIndexOf('/'))+"/php/archive.php?id=" + id;
	// 	window.location=string;
	// }
	
	// function edit(id){
	
	// 	//window.location ="/journal_entry.php?id=" + id;
	// 	var href = window.location.href;
	// 	var string = href.substr(0,href.lastIndexOf('/'))+"/edit_journal_form.php?id=" + id;
	// 	window.location=string;
	// }
	//     function filter_search()
 //    {
 //            dttable.ajax.reload();
 //            //console.log(dttable);
 //    }
</script>

<?php
Modal();
makeFoot(WEBAPP,1);
?>