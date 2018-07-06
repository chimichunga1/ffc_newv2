
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
  $pdf->Cell(30, 5, 'JV Number.', 0, 0, 'L');
  $pdf->Cell(150, 5, 'Date', 0, 0, 'L');
  $pdf->Cell(25, 5, 'GL CODE', 0, 0, 'C');
  $pdf->Cell(130, 5, 'Account Title', 0, 0, 'C');
  $pdf->Cell(35, 5, 'Debit', 0, 0, 'C');
  $pdf->Cell(35, 5, 'Credit', 0, 1, 'C');
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $query = " SELECT ";
  $query.= " j.jv_no, ";
  $query.= " CONCAT( 'A JV  ', j.jv_no , '  ',j.vldate) AS jv_no,  ";
  $query.= " j.details ";
  $query.= " FROM journal_voucher j ";
  $query.= " WHERE j.isValidated='1' and vldate='" . $jvdatequery . "' ";
  $stc = '';
  $std = '';
  $gtc = '';
  $gtd = '';
  $fetchcv = $con->myQuery($query);
  while ($row = $fetchcv->fetch(PDO::FETCH_NUM))
    {
    $pdf->SetFont($font, '', $size);
    $pdf->Cell(30, 5, $row[1], 0, 0);
    $pdf->Cell(-30, 15, $row[2], 0, 0, 'L');
    $stc = '';
    $std = '';
    $x = 0;
    $query1 = " SELECT ";
    $query1.= " dc.acc_no,dc.acc_code,dc.debit_amount,dc.credit_amount,a.acc_id,a.account_name ";
    $query1.= " FROM journal_dbcr dc     ";

    $query1.= " INNER JOIN accounts a ON a.id=dc.acc_code ";
    $query1.= " WHERE dc.jv_no='" . $row[0] . "' ORDER BY acc_code ASC ";
    $fetchcv1 = $con->myQuery($query1);
    while ($row1 = $fetchcv1->fetch(PDO::FETCH_NUM))
      {
      $pdf->SetFont($font, '', $size);
      if ($x != 0)
        {
        $pdf->Cell(30, 5, '', 0, 0);
        $pdf->Cell(150, 5, '', 0, 0);
        }
        else
        {
        $pdf->Cell(30, 5, '', 0, 0);
        $pdf->Cell(150, 5, '', 0, 0);
        }

      $pdf->Cell(25, 5, $row1[4], 0, 0);
      $pdf->Cell(130, 5, $row1[5], 0, 0);
      $pdf->Cell(35, 5, number_format($row1[2], 2) , 0, 0, 'R');
      $pdf->Cell(35, 5, number_format($row1[3], 2) , 0, 1, 'R');
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
  $pdf->Cell(335, 5, '', 0, 0);
  $pdf->Cell(35, 5, '----------------', 0, 0);
  $pdf->Cell(35, 5, '----------------', 0, 1);
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(30, 5, '', 0, 0);
  $pdf->Cell(150, 5, 'Grand Total', 0, 0);
  $pdf->Cell(25, 5, '', 0, 0);
  $pdf->Cell(130, 5, '', 0, 0);
  $pdf->Cell(35, 5, number_format(array_sum($gtd) , 2) , 0, 0, 'R');
  $pdf->Cell(35, 5, number_format(array_sum($gtc) , 2) , 0, 1, 'R');
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(335, 5, '', 0, 0);
  $pdf->Cell(35, 5, '================', 0, 0);
  $pdf->Cell(35, 5, '================', 0, 1);
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
