<?php
	require_once('../support/config.php');
	if(!isLoggedIn()){
    toLogin();
    die();
}
$inputs=$_POST;
	if(!empty($_GET['id']))
	{
    $data=$con->myQuery("SELECT * FROM loan_list WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
		$client=$con->myQuery("SELECT * FROM client_list WHERE client_number=?",array($data['client_no']))->fetch(PDO::FETCH_ASSOC);
    $cname=$client['lname'].", ".$client['fname']." ".$client['mname'];
    $trade=$con->myQuery("SELECT * FROM trade_check WHERE is_deleted='0' AND loan_id=? AND client_no=?",array($data['id'],$client['client_number']))->fetchAll(PDO::FETCH_ASSOC);
	}else{
		redirect("../index.php");
	}

	makeHead("Trade Checking",1);
?>
<div class='page' style='background-color:white;'>
<div class='col-md-12 no-print' align='right'>
	<br>
	<a href="ci_checking_form.php?id=<?php echo $_GET['id'];?>&tab=<?php echo $_GET['tab'];?>" class='btn btn-default'><span class='glyphicon glyphicon-arrow-left'></span> Back</a>
	<button onclick='window.print()' class='btn btn-default no-print'>Print &nbsp;<span class='fa fa-print'></span></button>  
</div>
	<div class="row">
      <div align='center'>
      <h3><b>TRADE CHECKINGS</b>
      </div>
		<br>
		<div class="col-md-12" style="padding-left: 50px" >
		<p align="left"  >Date Printed: <?php echo date("m/d/Y") ?></p>
		</div>
	</div>
	<hr>
  <div class='box-body'>
  <table style='width: 60% !important;margin-left: 15%;'>
            <tr><td align='right'><b>Last Name: &nbsp;</b></td><td><?php echo $client['lname'];?></td><td align='right'><b>Client Number: &nbsp;</b></td><td><?php echo $client['client_number'];?></td></tr>
            <tr><td align='right'><b>First Name: &nbsp;</b></td><td><?php echo $client['fname'];?></td><td align='right'><b>Application Number: &nbsp;</b></td><td><?php echo $data['app_no'];?></td></tr>
  </table><br><br>
	<div class="row col-md-12"><div>
		                  <div class='col-md-12'>
                    <table border="1" style='page-break-inside:auto !important;font-size:1vw;'>
                      <thead style='display:table-header-group !important;'>
                        <th class='text-center' style='padding: 0.1cm;'>Informant</th>
                        <th class='text-center' style='padding: 0.1cm;'>Tel No.</th>
                        <th class='text-center' style='padding: 0.1cm;'>Dealings</th>
                        <th class='text-center' style='padding: 0.1cm;'>Since</th>
                        <th class='text-center' style='padding: 0.1cm;'>Ave. Bill</th>
                        <th class='text-center' style='padding: 0.1cm;'>Terms</th>
                        <th class='text-center' style='padding: 0.1cm;'>Experience</th>       
                        <th class='text-center' style='padding: 0.1cm;'>Date Checked</th>          
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($trade)){foreach ($trade as $row):
                        ?>
                          <tr class="text-center" style='page-break-inside:avoid !important; page-break-after:auto !important;'>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($row['informant']) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($row['tel_no']) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($row['dealings']) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($row['since']) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($row['ave_bill']) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($row['terms']) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($row['experience']) ?></td>
                            <td style='padding: 0.1cm;'><?php echo htmlspecialchars($row['date_checked']) ?></td>
                          </tr>
                        <?php
                          endforeach;}else{
                            echo "<tr class='text-center'><td colspan='12'>No Records Found.</td></tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div></div>
	</div>
</div>
</div>


