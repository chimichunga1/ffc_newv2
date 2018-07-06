
<?php
ob_start();
require_once ('../../support/config.php');

require ('../../support/PHPPdf/fpdf.php');

$cvdatequery = $_GET['cvpsdate'];
$page = 0;
$numpage = 49;
$query0 = " SELECT ";
$query0.= " a.acc_id,a.account_name,dc.debit_amount,dc.credit_amount ";
$query0.= " FROM cheque_voucher c ";
$query0.= " INNER JOIN cheque_dbcr dc ON dc.cv_no=c.cv_no ";
$query0.= " INNER JOIN accounts a ON a.id=dc.acc_code ";
$query0.= " WHERE c.isValidated='1' and vldate='" . $cvdatequery . "' ";
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
  $pdf->Cell(40, 5, 'Date Printed : ' . $date, 0, 0);
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(0, 5, 'CHEQUE VOUCHER PROOFSHEETS', 0, 1, 'C');
  $page = $page + 1;
  $pdf->SetFont($font, 'b', $size);
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
  $pdf->Cell(40, 5, 'ACCOUNT CODE', 0, 0, 'L');
  $pdf->Cell(120, 5, 'ACCOUNT TITLE', 0, 0, 'L');
  $pdf->Cell(40, 5, 'DEBIT', 0, 0, 'C');
  $pdf->Cell(40, 5, 'CREDIT', 0, 0, 'C');
  $pdf->Cell(5, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, 'DEBIT', 0, 0, 'C');
  $pdf->Cell(40, 5, 'CREDIT', 0, 0, 'C');
  $pdf->Cell(5, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, 'DEBIT', 0, 0, 'C');
  $pdf->Cell(40, 5, 'CREDIT', 0, 1, 'C');
  $page = $page + 1;
  $pdf->Cell(0, 5, '', 0, 1);
  $page = $page + 1;
  $data = '';
  $dataacc = '';
  $query = " SELECT ";
  $query.= " a.acc_id,a.account_name,SUM(dc.debit_amount),SUM(dc.credit_amount),dc.acc_code ";
  $query.= " FROM cheque_voucher c ";
  $query.= " INNER JOIN cheque_dbcr dc ON dc.cv_no=c.cv_no ";
  $query.= " INNER JOIN accounts a ON a.id=dc.acc_code ";
  $query.= " WHERE c.isValidated='1' and vldate='" . $cvdatequery . "' ";
  $query.= " GROUP BY dc.acc_code ORDER BY a.id ASC ";
  $fetchcv = $con->myQuery($query);
  while ($row = $fetchcv->fetch(PDO::FETCH_NUM))
    {
    $data[] = array(
      $row[0],
      $row[1],
      $row[2],
      $row[3]
    );
    }

  // print_r($data);

  for ($i = 0; $i < count($data); $i++)
    {
    $string = explode("-", $data[$i][0]); //102-01-01
    if ($string[2] == '00' && $string[1] != '00')
      {
      $dataacc[].= $string[0] . '-00-00';
      $dataacc[].= $string[0] . '-' . $string[1] . '-00';
      }
    elseif ($string[2] != '00' && $string[1] != '00')
      {
      $dataacc[].= $string[0] . '-00-00';
      $dataacc[].= $string[0] . '-' . $string[1] . '-00';
      $dataacc[].= $string[0] . '-' . $string[1] . '-' . $string[2];
      }
      else
      {
      $dataacc[].= $string[0] . '-00-00';
      }
    }

  // $query1 =" SELECT ";
  // $query1.=" a.acc_id ";
  // $query1.=" FROM accounts a  ";
  // $query1.=" WHERE a.acc_id LIKE '%".$string[0]."%' ";
  // $fetchcv=$con->myQuery($query1);
  // $row1=$fetchcv->fetch(PDO::FETCH_NUM);
  // $dataacc[]=array($row1[0]);

  $unique = array_unique($dataacc);
  $reindexed_array = array_values($unique);

  // print_r(array_unique($reindexed_array ));
  // print_r( count($reindexed_array));

  $gtc = '';
  $gtd = '';
  for ($i = 0; $i < count($reindexed_array); $i++)
    {
    $string = explode("-", $reindexed_array[$i]); //102-01-01
    if ($string[2] == '00' && $string[1] != '00' && $string[0] != '000')
      {
      $datastore = $string[0] . '-' . $string[1];
      $datastore1 = $string[0] . '-' . $string[1] . '-00';
      $query1 = " SELECT ";
      $query1.= " a.acc_id,a.account_name,SUM(dc.debit_amount),SUM(dc.credit_amount),dc.acc_code ";
      $query1.= " FROM `cheque_voucher` c ";
      $query1.= " INNER JOIN cheque_dbcr dc ON dc.cv_no=c.cv_no  ";
      $query1.= " INNER JOIN accounts a ON a.id=dc.acc_code WHERE a.acc_id LIKE '%" . $datastore . "%' AND c.isValidated='1' AND c.vldate='".$cvdatequery."' ";
      $fetchcv = $con->myQuery($query1);
      $row1 = $fetchcv->fetch(PDO::FETCH_NUM);
      $query2 = " SELECT ";
      $query2.= " CONCAT(' ',' ',' ',a.acc_id,' ', a.account_name) AS ones ";
      $query2.= " FROM accounts a WHERE a.acc_id LIKE '%" . $reindexed_array[$i] . "%' ";
      $fetchcv2 = $con->myQuery($query2);
      $row2 = $fetchcv2->fetch(PDO::FETCH_NUM);
      $pdf->SetFont($font, '', $size);
      $pdf->Cell(160, 5, $row2[0], 0, 0, 'L');
      $pdf->Cell(40, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, '', 0, 0, 'C');
      $pdf->Cell(5, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, number_format($row1[2], 2) , 0, 0, 'R');
      $pdf->Cell(40, 5, number_format($row1[3], 2) , 0, 0, 'R');
      $pdf->Cell(5, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, '', 0, 1, 'C');
      $page = $page + 1;
      if ($page == $numpage)
        {
        $page = 2;
        $pdf->Cell(0, 5, '', 0, 1, 'R');
        $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
        }
      }
    elseif ($string[2] != '00' && $string[1] != '00' && $string[0] != '000')
      {
      $datastore = $string[0] . '-' . $string[1] . '-' . $string[2];
      $query1 = " SELECT ";
      $query1.= " CONCAT(' ',' ',' ',' ',' ',' ',a.acc_id,' ', a.account_name) AS ones,SUM(dc.debit_amount),SUM(dc.credit_amount),dc.acc_code";
      $query1.= " FROM `cheque_voucher` c ";
      $query1.= " INNER JOIN cheque_dbcr dc ON dc.cv_no=c.cv_no  ";
      $query1.= " INNER JOIN accounts a ON a.id=dc.acc_code WHERE a.acc_id LIKE '%" . $datastore . "%' AND c.isValidated='1' AND c.vldate='".$cvdatequery."'";
      $fetchcv = $con->myQuery($query1);
      $row1 = $fetchcv->fetch(PDO::FETCH_NUM);
      $pdf->SetFont($font, '', $size);
      $pdf->Cell(160, 5, $row1[0], 0, 0, 'L');
      $pdf->Cell(40, 5, number_format($row1[1], 2) , 0, 0, 'R');
      $pdf->Cell(40, 5, number_format($row1[2], 2) , 0, 0, 'R');
      $pdf->Cell(5, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, '', 0, 0, 'C');
      $pdf->Cell(5, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, '', 0, 1, 'C');
      $page = $page + 1;
      if ($page == $numpage)
        {
        $page = 2;
        $pdf->Cell(0, 5, '', 0, 1, 'R');
        $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
        }
      }
      else
      {
      $datastore = $string[0];
      $datastore1 = $string[0] . '-00-00';
      $query1 = " SELECT ";
      $query1.= " a.acc_id,a.account_name,SUM(dc.debit_amount),SUM(dc.credit_amount),dc.acc_code ";
      $query1.= " FROM `cheque_voucher` c ";
      $query1.= " INNER JOIN cheque_dbcr dc ON dc.cv_no=c.cv_no  ";
      $query1.= " INNER JOIN accounts a ON a.id=dc.acc_code WHERE a.acc_id LIKE '%" . $datastore . "%' AND c.isValidated='1' AND c.vldate='".$cvdatequery."' ";
      $fetchcv = $con->myQuery($query1);
      $row1 = $fetchcv->fetch(PDO::FETCH_NUM);
      $query2 = " SELECT ";
      $query2.= " CONCAT(a.acc_id,' ', a.account_name) AS ones ";
      $query2.= " FROM accounts a WHERE a.acc_id LIKE '%" . $reindexed_array[$i] . "%' ";
      $fetchcv2 = $con->myQuery($query2);
      $row2 = $fetchcv2->fetch(PDO::FETCH_NUM);
      $pdf->SetFont($font, '', $size);
      $pdf->Cell(160, 5, $row2[0], 0, 0, 'L');
      $pdf->Cell(40, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, '', 0, 0, 'C');
      $pdf->Cell(5, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, '', 0, 0, 'C');
      $pdf->Cell(5, 5, '', 0, 0, 'C');
      $pdf->Cell(40, 5, number_format($row1[2], 2) , 0, 0, 'R');
      $pdf->Cell(40, 5, number_format($row1[3], 2) , 0, 1, 'R');
      $page = $page + 1;
      if ($page == $numpage)
        {
        $page = 2;
        $pdf->Cell(0, 5, '', 0, 1, 'R');
        $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
        }

      $gtd[].= $row1[2];
      $gtc[].= $row1[3];
      }
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(40, 5, '', 0, 0, 'L');
  $pdf->Cell(120, 5, '', 0, 0, 'L');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(5, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(5, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, '-------------', 0, 0, 'R');
  $pdf->Cell(40, 5, '-------------', 0, 1, 'R');
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(40, 5, '', 0, 0, 'L');
  $pdf->Cell(120, 5, '', 0, 0, 'L');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(5, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(5, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, number_format(array_sum($gtd) , 2) , 0, 0, 'R');
  $pdf->Cell(40, 5, number_format(array_sum($gtc) , 2) , 0, 1, 'R');
  $page = $page + 1;
  if ($page == $numpage)
    {
    $page = 2;
    $pdf->Cell(0, 5, '', 0, 1, 'R');
    $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/{nb}', 0, 1, 'R');
    }

  $pdf->SetFont($font, 'b', $size);
  $pdf->Cell(40, 5, '', 0, 0, 'L');
  $pdf->Cell(120, 5, '', 0, 0, 'L');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(5, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(5, 5, '', 0, 0, 'C');
  $pdf->Cell(40, 5, '=============', 0, 0, 'R');
  $pdf->Cell(40, 5, '=============', 0, 1, 'R');
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