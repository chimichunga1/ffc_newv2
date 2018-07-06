
<?php
ob_start();
require_once ('../../support/config.php');

require ('../../support/PHPPdf/fpdf.php');

$page = 0;
$numpage = 49;
$jvdatequery = $_GET['jvpsdate'];
$query0 = " SELECT ";
$query0.= " a.acc_id,j.jv_no,j.vldate,dc.debit_amount,dc.credit_amount,j.clnt_id,CONCAT(cl.fname,' ',cl.lname)";
$query0.= " FROM journal_dbcr dc";
$query0.= " INNER JOIN journal_voucher j ON dc.jv_no=j.jv_no ";
$query0.= " INNER JOIN accounts a ON a.id=dc.acc_code ";
$query0.= " INNER JOIN client_list cl ON cl.client_number=dc.clnt_id  ";
$query0.= " WHERE j.isValidated='1' and j.vldate='" . $jvdatequery . "' ";
$query0.= " ORDER BY a.id ";
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
  $pdf->AddPage();
  $pdf->SetFont($font, 'B', $size);
  $pdf->AliasNbPages();
  $pdf->Cell(40, 5, 'Filipino financial Corporation', 0, 0);
  $pdf->SetFont($font, '', $size);
  $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
  $page = $page + 1;
  $pdf->SetFont($font, 'B', $size);
  $pdf->Cell(40, 5, 'Date Printed : ' . $date, 0, 1);
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $pdf->SetFont($font, 'B', $size);
  $pdf->Cell(0, 5, 'Details of Subsidiary of Ledger', 0, 1, 'C');
  $page = $page + 1;
  $pdf->SetFont($font, 'B', $size);
  $pdf->Cell(0, 5, 'GL Distribution for JV', 0, 1, 'C');
  $page = $page + 1;
  $pdf->SetFont($font, 'B', $size);
  $pdf->Cell(0, 5, 'as of ' . $titledate, 0, 1, 'C');
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $pdf->SetFont($font, 'B', $size);
  $pdf->Cell(50, 5, 'GL CODE', 0, 0, 'C');
  $pdf->Cell(50, 5, 'JV Number', 0, 0, 'C');
  $pdf->Cell(50, 5, 'JV DATE', 0, 0, 'C');
  $pdf->Cell(50, 5, 'Debit', 0, 0, 'L');
  $pdf->Cell(50, 5, 'Credit ', 0, 0, 'L');
  $pdf->Cell(50, 5, 'Client No.', 0, 0, 'L');
  $pdf->Cell(100, 5, 'Name', 0, 1, 'L');
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $gtd = '';
  $gtc = '';
  $query = " SELECT ";
  $query.= " a.acc_id,j.jv_no,j.vldate,dc.debit_amount,dc.credit_amount,j.clnt_id,CONCAT(cl.fname,' ',cl.lname)";
  $query.= " FROM journal_dbcr dc";
  $query.= " INNER JOIN journal_voucher j ON dc.jv_no=j.jv_no ";
  $query.= " INNER JOIN accounts a ON a.id=dc.acc_code ";
  $query.= " INNER JOIN client_list cl ON cl.client_number=dc.clnt_id  ";
  $query.= " WHERE j.isValidated='1' and j.vldate='" . $jvdatequery . "' ";
  $query.= " ORDER BY a.id ASC ";
  $fetchcv = $con->myQuery($query);
  while ($row = $fetchcv->fetch(PDO::FETCH_NUM))
    {
    $pdf->SetFont($font, '', $size);
    $pdf->Cell(50, 5, $row[0], 0, 0, 'C');
    $pdf->Cell(50, 5, 'JV ' . $row[1], 0, 0, 'C');
    $pdf->Cell(50, 5, $row[2], 0, 0, 'C');
    $pdf->Cell(50, 5, number_format($row[3], 2) , 0, 0, 'R');
    $pdf->Cell(50, 5, number_format($row[4], 2) , 0, 0, 'R');
    $pdf->Cell(50, 5, $row[5], 0, 0, 'C');
    $pdf->Cell(100, 5, $row[6], 0, 1, 'L');
    $page = $page + 1;
    if ($page == $numpage)
      {
      $page = 2;
      $pdf->Cell(0, 5, '', 0, 1, 'R');
      $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
      }

    $gtd[].= $row[3];
    $gtc[].= $row[4];
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(50, 5, '', 0, 0, 'C');
  $pdf->Cell(50, 5, '', 0, 0, 'C');
  $pdf->Cell(50, 5, '', 0, 0, 'C');
  $pdf->Cell(50, 5, '----------------------', 0, 0, 'R');
  $pdf->Cell(50, 5, '----------------------', 0, 0, 'R');
  $pdf->Cell(50, 5, '', 0, 0, 'C');
  $pdf->Cell(100, 5, '', 0, 1, 'L');
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(50, 5, 'GRAND TOTAL', 0, 0, 'C');
  $pdf->Cell(50, 5, '', 0, 0, 'C');
  $pdf->Cell(50, 5, '', 0, 0, 'C');
  $pdf->Cell(50, 5, number_format(array_sum($gtd) , 2) , 0, 0, 'R');
  $pdf->Cell(50, 5, number_format(array_sum($gtc) , 2) , 0, 0, 'R');
  $pdf->Cell(50, 5, '', 0, 0, 'C');
  $pdf->Cell(100, 5, '', 0, 1, 'L');
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(50, 5, '', 0, 0, 'C');
  $pdf->Cell(50, 5, '', 0, 0, 'C');
  $pdf->Cell(50, 5, '', 0, 0, 'C');
  $pdf->Cell(50, 5, '======================', 0, 0, 'R');
  $pdf->Cell(50, 5, '======================', 0, 0, 'R');
  $pdf->Cell(50, 5, '', 0, 0, 'C');
  $pdf->Cell(100, 5, '', 0, 1, 'L');
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

  $pdf->Output();
  }

ob_end_flush();
?>

