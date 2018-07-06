
<?php
ob_start();
require_once ('../../support/config.php');

require ('../../support/PHPPdf/fpdf.php');

$jvdatequery = $_GET['jvpsdate'];
$page = 0;
$numpage = 49;
$query0 = " SELECT ";
$query0.= " j.jv_no, ";
$query0.= " CONCAT( 'A JV   ', j.jv_no,'   ', j.vldate) AS jv_no, ";
$query0.= " j.details ";
$query0.= " FROM journal_voucher j ";
$query0.= " WHERE j.isValidated='1' and vldate='" . $jvdatequery . "' ";
$fetchcv0 = $con->myQuery($query0)->fetch(PDO::FETCH_NUM);

if (empty($fetchcv0))
  {
?>
<script type="text/javascript">
                                            window.location.href='../report_gl.php';
</script>
  <?php
  }
  else
  {
  $cvdate = date_create($_GET['jvpsdate']);
  $date = date('M d, Y');
  $titledate = date_format($cvdate, "M d, Y");
  $pdf = new FPDF('L', 'mm', array(
    431.8,
    279.4
  ));
  $font = 'Courier';
  $size = '10';
  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(40, 5, 'Filipino financial Corporation', 0, 0);
  $pdf->SetFont($font, '', $size);
  $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
  $page = $page + 1;
  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(40, 5, 'Date Printed : ' . $date, 0, 1);
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(0, 5, 'JOURNAL VOUCHER PROOFSHEETS', 0, 1, 'C');
  $page = $page + 1;
  $pdf->Cell(0, 5, 'SUMMARY OF ACCOUNTS', 0, 1, 'C');
  $page = $page + 1;
  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(0, 5, $titledate, 0, 1, 'C');
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(20, 5, '', 0, 0, 'L');
  $pdf->Cell(50, 5, 'ACCOUNT CODE', 0, 0, 'L');
  $pdf->Cell(200, 5, 'ACCOUNT TITLE', 0, 0, 'L');
  $pdf->Cell(50, 5, 'Debit', 0, 0, 'C');
  $pdf->Cell(50, 5, 'Credit', 0, 1, 'C');
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $gtc = '';
  $gtd = '';
  $stc = '';
  $std = '';
  $x = 0;
  $query1 = " SELECT ";
  $query1.= " a.acc_id,a.account_name,SUM(dc.debit_amount),SUM(dc.credit_amount),dc.acc_code ";
  $query1.= " FROM `journal_voucher` j  ";
  $query1.= " INNER JOIN journal_dbcr dc ON dc.jv_no=j.jv_no ";
  $query1.= " INNER JOIN accounts a ON a.id=dc.acc_code WHERE j.isValidated='1' and j.vldate='" . $jvdatequery . "' GROUP BY dc.acc_code ORDER BY a.id ASC ";
  $fetchcv1 = $con->myQuery($query1);
  while ($row1 = $fetchcv1->fetch(PDO::FETCH_NUM))
    {
    $pdf->SetFont($font, '', $size);
    $pdf->Cell(20, 5, '', 0, 0, 'L');
    $pdf->Cell(50, 5, $row1[0], 0, 0);
    $pdf->Cell(200, 5, $row1[1], 0, 0);
    $pdf->Cell(50, 5, number_format($row1[2], 2) , 0, 0, 'R');
    $pdf->Cell(50, 5, number_format($row1[3], 2) , 0, 1, 'R');
    $page = $page + 1;
    if ($page == $numpage)
      {
      $page = 2;
      $pdf->Cell(0, 5, '', 0, 1, 'R');
      $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
      }

    $std[].= $row1[2];
    $stc[].= $row1[3];
    $x = $x + 1;
    }

  $gtc[].= array_sum($stc);
  $gtd[].= array_sum($std);
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(20, 5, '', 0, 0, 'L');
  $pdf->Cell(50, 5, '', 0, 0, 'L');
  $pdf->Cell(200, 5, '', 0, 0);
  $pdf->Cell(50, 5, '----------------------', 0, 0, 'R');
  $pdf->Cell(50, 5, '----------------------', 0, 1, 'R');
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(20, 5, '', 0, 0, 'L');
  $pdf->Cell(50, 5, '', 0, 0);
  $pdf->Cell(200, 5, '', 0, 0);
  $pdf->Cell(50, 5, number_format(array_sum($gtd) , 2) , 0, 0, 'R');
  $pdf->Cell(50, 5, number_format(array_sum($gtc) , 2) , 0, 1, 'R');
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(20, 5, '', 0, 0, 'L');
  $pdf->Cell(50, 5, '', 0, 0, 'L');
  $pdf->Cell(200, 5, '', 0, 0);
  $pdf->Cell(50, 5, '======================', 0, 0, 'R');
  $pdf->Cell(50, 5, '======================', 0, 1, 'R');
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(0, 5, '-- END OF REPORT --', 0, 1, 'C');
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(200, 5, 'Approved by _____________________________________________', 0, 0, 'C');
  $pdf->Cell(200, 5, 'Verified by _____________________________________________', 0, 1, 'C');
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->Output();
  }

ob_end_flush();
?>
