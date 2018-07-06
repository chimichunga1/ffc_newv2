<?php
ob_start();
require_once ('../../support/config.php');

require ('../../support/PHPPdf/fpdf.php');

$cvdatequery = $_GET['cvpsdate'];
$page = 0;
$numpage = 49;
$query0 = " SELECT ";
$query0.= " c.cv_no, c.clnt_id, ";
$query0.= " CONCAT( 'A CV', c.cv_no) AS cv_no, ";
$query0.= " CONCAT('FAO : ',cl.fname,' ',cl.lname) AS fullname ";
$query0.= " FROM cheque_voucher c ";
$query0.= " INNER JOIN client_list cl ON cl.client_number=c.clnt_id  ";
$query0.= " WHERE c.isValidated='1' and vldate='" . $cvdatequery . "' ";
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
  $cvdate = date_create($_GET['cvpsdate']);
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
  $pdf->Cell(0, 5, 'CHEQUE VOUCHER PROOFSHEETS', 0, 1, 'C');
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
  $pdf->Cell(30, 5, 'CV NO.', 0, 0, 'C');
  $pdf->Cell(80, 5, 'PAYEE', 0, 0, 'C');
  $pdf->Cell(25, 5, 'BANK CODE', 0, 0, 'C');
  $pdf->Cell(25, 5, 'CHEQUE No.', 0, 0, 'C');
  $pdf->Cell(25, 5, 'CONTRACT #', 0, 0, 'C');
  $pdf->Cell(25, 5, 'GL CODE', 0, 0, 'C');
  $pdf->Cell(120, 5, 'GL DESC', 0, 0, 'C');
  $pdf->Cell(25, 5, 'DEBIT', 0, 0, 'C');
  $pdf->Cell(25, 5, 'CREDIT', 0, 0, 'C');
  $pdf->Cell(25, 5, 'STATUS', 0, 1, 'C');
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $query = " SELECT ";
  $query.= " c.cv_no, c.clnt_id, ";
  $query.= " CONCAT( 'A CV', c.cv_no) AS cv_no, ";
  $query.= " CONCAT('FAO : ',cl.fname,' ',cl.lname) AS fullname ";
  $query.= " FROM cheque_voucher c ";
  $query.= " INNER JOIN client_list cl ON cl.client_number=c.clnt_id  ";
  $query.= " WHERE c.isValidated='1' and vldate='" . $cvdatequery . "' ";
  $stc = '';
  $std = '';
  $gtc = '';
  $gtd = '';
  $fetchcv = $con->myQuery($query);
  while ($row = $fetchcv->fetch(PDO::FETCH_NUM))
    {
    $pdf->SetFont($font, '', $size);
    $pdf->Cell(30, 5, $row[2], 0, 0);
    $pdf->Cell(80, 5, $row[3], 0, 0);
    $stc = '';
    $std = '';
    $x = 0;
    $query1 = " SELECT ";
    $query1.= " v.bank_id,v.cheque_no,dc.acc_no,dc.acc_code,dc.debit_amount,dc.credit_amount,a.acc_id,a.account_name,b.name,v.cheque_no ";
    $query1.= " FROM cheque_dbcr dc    ";
    $query1.= " INNER JOIN cheque_vld v ON dc.cv_id=v.dbcr_id ";
    $query1.= " INNER JOIN accounts a ON a.id=dc.acc_code ";
    $query1.= " LEFT JOIN bank b ON b.id=v.bank_id ";
    $query1.= " WHERE dc.cv_no='" . $row[0] . "' ORDER BY acc_code ASC ";
    $fetchcv1 = $con->myQuery($query1);
    while ($row1 = $fetchcv1->fetch(PDO::FETCH_NUM))
      {
      $pdf->SetFont($font, '', $size);
      if ($x != 0)
        {
        $pdf->Cell(30, 5, '', 0, 0);
        $pdf->Cell(80, 5, '', 0, 0);
        }

      $pdf->Cell(25, 5, $row1[8], 0, 0);
      $pdf->Cell(25, 5, $row1[9], 0, 0);
      if ($row1[2] == 0)
        {
        $pdf->Cell(25, 5, '', 0, 0);
        }
        else
        {
        $pdf->Cell(25, 5, $row1[2], 0, 0);
        }

      $pdf->Cell(25, 5, $row1[6], 0, 0);
      $pdf->Cell(120, 5, $row1[7], 0, 0);
      $pdf->Cell(25, 5, number_format($row1[4], 2) , 0, 0, 'R');
      $pdf->Cell(25, 5, number_format($row1[5], 2) , 0, 0, 'R');
      $pdf->Cell(25, 5, 'A', 0, 1, 'R');
      $page = $page + 1;
      if ($page == $numpage)
        {
        $page = 2;
        $pdf->Cell(0, 5, '', 0, 1, 'R');
        $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
        }

      $std[].= $row1[4];
      $stc[].= $row1[5];
      $x = $x + 1;
      }

    $pdf->SetFont($font, '', $size);
    $pdf->Cell(330, 5, '', 0, 0);
    $pdf->Cell(25, 5, '-----------', 0, 0);
    $pdf->Cell(25, 5, '-----------', 0, 0);
    $pdf->Cell(25, 5, '', 0, 1);
    $page = $page + 1;
    if ($page == $numpage)
      {
      $page = 2;
      $pdf->Cell(0, 5, '', 0, 1, 'R');
      $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
      }

    $pdf->SetFont($font, '', $size);
    $pdf->Cell(185, 5, '', 0, 0);
    $pdf->Cell(130, 5, 'Sub Total', 0, 0);
    $pdf->Cell(15, 5, '', 0, 0);
    $pdf->Cell(25, 5, number_format(array_sum($std) , 2) , 0, 0, 'R');
    $pdf->Cell(25, 5, number_format(array_sum($stc) , 2) , 0, 0, 'R');
    $pdf->Cell(25, 5, '', 0, 1);
    $page = $page + 1;
    if ($page == $numpage)
      {
      $page = 2;
      $pdf->Cell(0, 5, '', 0, 1, 'R');
      $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
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
  $pdf->Cell(330, 5, '', 0, 0);
  $pdf->Cell(25, 5, '-----------', 0, 0);
  $pdf->Cell(25, 5, '-----------', 0, 0);
  $pdf->Cell(25, 5, '', 0, 1);
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(30, 5, '', 0, 0);
  $pdf->Cell(80, 5, 'Grand Total', 0, 0);
  $pdf->Cell(210, 5, '', 0, 0);
  $pdf->Cell(10, 5, '', 0, 0);
  $pdf->Cell(25, 5, number_format(array_sum($gtd) , 2) , 0, 0, 'R');
  $pdf->Cell(25, 5, number_format(array_sum($gtc) , 2) , 0, 0, 'R');
  $pdf->Cell(25, 5, '', 0, 1);
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(330, 5, '', 0, 0);
  $pdf->Cell(25, 5, '===========', 0, 0);
  $pdf->Cell(25, 5, '===========', 0, 0);
  $pdf->Cell(25, 5, '', 0, 1);
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