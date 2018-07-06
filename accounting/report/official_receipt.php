<?php
ob_start();
require_once ('../../support/config.php');

require ('../../support/PHPPdf/fpdf.php');

function convertNumber($number)
{

  if ( empty((strpos($number, '.'))) )
  {
    $number=number_format($number,2);
  }
    list($integer,$fraction) = explode(".", (string) $number);

    $output = " ";

    if ($integer{0} == "-")
    {
        $output = "negative ";
        $integer    = ltrim($integer, "-");
    }
    else if ($integer{0} == "+")
    {
        $output = "positive ";
        $integer    = ltrim($integer, "+");
    }

    if ($integer{0} == "0")
    {
        $output .= "zero";
    }
    else
    {
        $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
        $group   = rtrim(chunk_split($integer, 3, " "), " ");
        $groups  = explode(" ", $group);

        $groups2 = array();
        foreach ($groups as $g)
        {
            $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
        }

        for ($z = 0; $z < count($groups2); $z++)
        {
            if ($groups2[$z] != "")
            {
                $output .= $groups2[$z] . convertGroup(11 - $z) . (
                        $z < 11
                        && !array_search('', array_slice($groups2, $z + 1, -1))
                        && $groups2[11] != ''
                        && $groups[11]{0} == '0'
                            ? " and "
                            : " "
                    );
            }
        }

        $output = rtrim($output, ", ");
    }

    if ($fraction > 0)
    {
        $output .= " PESOS ";
        for ($i = 0; $i < strlen($fraction); $i++)
        {
           if($fraction==01){

               $i = 1;
                while ($i <2):
                     $output .= " and one centavo only";

                 $i++;
                endwhile;
           }
           else if($fraction==02){

               $i = 1;
                while ($i <2):
                     $output .= " and two centavos only";

                 $i++;
                endwhile;
           }
           else if($fraction==03){

               $i = 1;
                while ($i <2):
                     $output .= " and three centavos only";

                 $i++;
                endwhile;
           }
           else if($fraction==04){

               $i = 1;
                while ($i <2):
                         $output .= " and four centavos only";

                 $i++;
                endwhile;
           }
           else if($fraction==05){

               $i = 1;
                while ($i <2):
                         $output .= " and five centavos only";

                 $i++;
                endwhile;
           }
           else if($fraction==06){

               $i = 1;
                while ($i <2):
                         $output .= " and six centavos only";

                 $i++;
                endwhile;
           }
           else if($fraction==07){

              $i = 1;
                while ($i <2):
                         $output .= " point seven centavos only";

                 $i++;
                endwhile;
           }
            else if($fraction==8 || $fraction==08){

               $i = 1;
                while ($i <2):
                 $output .= " and eight centavos only";

                 $i++;
                endwhile;
           }
            else if($fraction==9 || $fraction==09){

               $i = 1;
                while ($i <2):
                 $output .= " and nine centavos only";

                 $i++;
                endwhile;
           }
            else if($fraction==10){

                  $i = 1;
                while ($i <2):
                  $output .= " and ten centavos only";

                 $i++;
                endwhile;
           }
           else if($fraction==11){

              $i = 1;
                while ($i <2):
                         $output .= " and eleven centavos only";

                 $i++;
                endwhile;
           }
             else if($fraction==12){

                 $i = 1;
                while ($i <2):
                     $output .= " and twelve centavos only";

                 $i++;
                endwhile;
           }
           else if($fraction==13){

             $i = 1;
                while ($i <2):
                         $output .= " and thirteen centavos only";

                 $i++;
                endwhile;
           }
            else if($fraction==14){

               $i = 1;
                while ($i <2):
                         $output .= " and fourteen centavos only";
                 $i++;
                endwhile;
           }
           else if($fraction==15){

               $i = 1;
                while ($i <2):
                         $output .= " and fifteen centavos only";

                 $i++;
                endwhile;
           }
           else if($fraction==16){

               $i = 1;
                while ($i <2):
                         $output .= " and sixteen centavos only";
                 $i++;
                endwhile;
           }
           else if($fraction==17){


               $i = 1;
                while ($i <2):
                     $output .= " and seventeen centavos only";
                 $i++;
                endwhile;
           }
           else if($fraction==18){


               $i = 1;
                while ($i <2):
                $output .= " and eighteen centavos only";
                 $i++;
                endwhile;
           }
           else if($fraction==19){

               $i = 1;
                while ($i <2):
                         $output .= " and nineteen centavos only";
                 $i++;
                endwhile;
           }
           else if($fraction==20){

               $i = 1;
                while ($i <2):
                     $output .= " and twenty centavos only";
                 $i++;
                endwhile;
           }
            else if($fraction==21){
               $i = 1;
                while ($i <2):
                  $output .= " and twenty one centavos only";
                 $i++;
                endwhile;
           }
            else if($fraction==22){

              $i = 1;
                while ($i <2):
                         $output .= " and twenty two centavos only";
                 $i++;
                endwhile;
           }
            else if($fraction==23){
                 $i = 1;
                while ($i <2):
                         $output .= " and twenty three centavos only";
                 $i++;
                endwhile;
           }
            else if($fraction==24){

                 $i = 1;
                while ($i <2):
                     $output .= " and twenty four centavos only";
                 $i++;
                endwhile;
           }
            else if($fraction==25){

             $i = 1;
                while ($i <2):
                 $output .= " and twenty five centavos only";
                 $i++;
                endwhile;
           }
            else if($fraction==26){

                $i = 1;
                while ($i <2):
                    $output .= " and twenty six centavos only";
                 $i++;
                endwhile;
           }
            else if($fraction==27){

                $i = 1;
                while ($i <2):
                 $output .= " and twenty seven centavos only";
                 $i++;
                endwhile;
           }
            else if($fraction==28){

                $i = 1;
                while ($i <2):
                    $output .= " and twenty eight centavos only";
                 $i++;
                endwhile;
           }
            else if($fraction==29){

                $i = 1;
                while ($i <2):
                     $output .= " and twenty nine centavos only";
                    $i++;
                endwhile;
           }
             else if($fraction ==30){

                $i = 1;
                while ($i <2):
                     $output .= " and thirty centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==31){

                $i = 1;
                while ($i <2):
                     $output .= " and thirty one centavos only";
                    $i++;
                endwhile;
           }
            else if($fraction ==32){

                $i = 1;
                while ($i <2):
                     $output .= " and thirty two centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==33){

                $i = 1;
                while ($i <2):
                     $output .= " and thirty three centavos only";
                    $i++;
                endwhile;
           }
            else if($fraction ==34){

                $i = 1;
                while ($i <2):
                     $output .= " and thirty four centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==35){

                $i = 1;
                while ($i <2):
                     $output .= " and thirty five centavos only";
                    $i++;
                endwhile;
           }
             else if($fraction ==36){

                $i = 1;
                while ($i <2):
                     $output .= " and thirty six centavos only";
                    $i++;
                endwhile;
           }
            else if($fraction ==37){

                $i = 1;
                while ($i <2):
                     $output .= " and thirty seven centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==38){

                $i = 1;
                while ($i <2):
                     $output .= " and thirty eight centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==39){

                $i = 1;
                while ($i <2):
                     $output .= " and thirty nine centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==40){

                $i = 1;
                while ($i <2):
                     $output .= " and fourty centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==41){

                $i = 1;
                while ($i <2):
                     $output .= " and fourty one centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==42){

                $i = 1;
                while ($i <2):
                     $output .= " and fourty two centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==43){

                $i = 1;
                while ($i <2):
                     $output .= " and fourty three centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==44){

                $i = 1;
                while ($i <2):
                     $output .= " and fourty four centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==45){

                $i = 1;
                while ($i <2):
                     $output .= " and fourty five centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==46){

                $i = 1;
                while ($i <2):
                     $output .= " and fourty six centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==47){

                $i = 1;
                while ($i <2):
                     $output .= " and fourty seven centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==48){

                $i = 1;
                while ($i <2):
                     $output .= " and fourty eight centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==49){

                $i = 1;
                while ($i <2):
                     $output .= " and fourty nine centavos only";
                    $i++;
                endwhile;
           }
            else if($fraction ==50){

                $i = 1;
                while ($i <2):
                     $output .= " and fifty centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==51){

                $i = 1;
                while ($i <2):
                     $output .= " and fifty one centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==52){

                $i = 1;
                while ($i <2):
                     $output .= " and fifty two centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==53){

                $i = 1;
                while ($i <2):
                     $output .= " and fifty three centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==54){

                $i = 1;
                while ($i <2):
                     $output .= " and fifty four centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==55){

                $i = 1;
                while ($i <2):
                     $output .= " and fifty five centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==56){

                $i = 1;
                while ($i <2):
                     $output .= " and fifty six centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==57){

                $i = 1;
                while ($i <2):
                     $output .= " and fifty seven centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==58){

                $i = 1;
                while ($i <2):
                     $output .= " and fifty eight centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==59){

                $i = 1;
                while ($i <2):
                     $output .= " and fifty nine centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==60){

                $i = 1;
                while ($i <2):
                     $output .= " and sixty centavos only";
                    $i++;
                endwhile;
           }
          else if($fraction ==61){

                $i = 1;
                while ($i <2):
                     $output .= " and sixty one centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==62){

                $i = 1;
                while ($i <2):
                     $output .= " and sixty two centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==63){

                $i = 1;
                while ($i <2):
                     $output .= " and sixty three centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==64){

                $i = 1;
                while ($i <2):
                     $output .= " and sixty four centavos only";
                    $i++;
                endwhile;
           }
          else if($fraction ==65){

                $i = 1;
                while ($i <2):
                     $output .= " and sixty five centavos only";
                    $i++;
                endwhile;
           }
         else if($fraction ==66){

                $i = 1;
                while ($i <2):
                     $output .= " and sixty six centavos only";
                    $i++;
                endwhile;
           }

         else if($fraction ==67){

                $i = 1;
                while ($i <2):
                     $output .= " and sixty seven centavos only";
                    $i++;
                endwhile;
           }
        else if($fraction ==68){

                $i = 1;
                while ($i <2):
                     $output .= " and sixty eight centavos only";
                    $i++;
                endwhile;
           }
        else if($fraction ==69){

                $i = 1;
                while ($i <2):
                     $output .= " and sixty nine centavos only";
                    $i++;
                endwhile;
           }
       else if($fraction ==70){

                $i = 1;
                while ($i <2):
                     $output .= " and seventy centavos only";
                    $i++;
                endwhile;
           }
     else if($fraction ==71){

                $i = 1;
                while ($i <2):
                     $output .= " and seventy one centavos only";
                    $i++;
                endwhile;
           }

     else if($fraction ==72){

                $i = 1;
                while ($i <2):
                     $output .= " and seventy two centavos only";
                    $i++;
                endwhile;
           }
    else if($fraction ==73){

                $i = 1;
                while ($i <2):
                     $output .= " and seventy three centavos only";
                    $i++;
                endwhile;
           }
     else if($fraction ==74){

                $i = 1;
                while ($i <2):
                     $output .= " and seventy four centavos only";
                    $i++;
                endwhile;
           }

            else if($fraction ==75){

                $i = 1;
                while ($i <2):
                     $output .= " and seventy five centavos only";
                    $i++;
                endwhile;
           }
            else if($fraction ==76){

                $i = 1;
                while ($i <2):
                     $output .= " and seventy six centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==77){

                $i = 1;
                while ($i <2):
                     $output .= " and seventy seven centavos only";
                    $i++;
                endwhile;
           }
            else if($fraction ==78){

                $i = 1;
                while ($i <2):
                     $output .= " and seventy eight centavos only";
                    $i++;
                endwhile;
           }
            else if($fraction ==79){

                $i = 1;
                while ($i <2):
                     $output .= " and seventy nine centavos only";
                    $i++;
                endwhile;
           }
            else if($fraction ==80){

                $i = 1;
                while ($i <2):
                     $output .= " and eighty centavos only";
                    $i++;
                endwhile;
           }
         else if($fraction ==81){

                $i = 1;
                while ($i <2):
                     $output .= " and eighty one centavos only";
                    $i++;
                endwhile;
           }
        else if($fraction ==82){

                $i = 1;
                while ($i <2):
                     $output .= " and eighty two centavos only";
                    $i++;
                endwhile;
           }
       else if($fraction ==83){

                $i = 1;
                while ($i <2):
                     $output .= " and eighty three centavos only";
                    $i++;
                endwhile;
           }
      else if($fraction ==84){

                $i = 1;
                while ($i <2):
                     $output .= " and eighty four centavos only";
                    $i++;
                endwhile;
           }
        else if($fraction ==85){

                $i = 1;
                while ($i <2):
                     $output .= " and eighty five centavos only";
                    $i++;
                endwhile;
           }
         else if($fraction ==86){

                $i = 1;
                while ($i <2):
                     $output .= " and eighty six centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==87){

                $i = 1;
                while ($i <2):
                     $output .= " and eighty seven centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==88){

                $i = 1;
                while ($i <2):
                     $output .= " and eighty eight centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==89){

                $i = 1;
                while ($i <2):
                     $output .= " and eighty nine centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==90){

                $i = 1;
                while ($i <2):
                     $output .= " and ninety centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==91){

                $i = 1;
                while ($i <2):
                     $output .= " and ninety one centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==92){

                $i = 1;
                while ($i <2):
                     $output .= " and ninety two centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==93){

                $i = 1;
                while ($i <2):
                     $output .= " and ninety three centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==94){

                $i = 1;
                while ($i <2):
                     $output .= " and ninety four centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==95){

                $i = 1;
                while ($i <2):
                     $output .= " and ninety five centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==96){

                $i = 1;
                while ($i <2):
                     $output .= " and ninety six centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==97){

                $i = 1;
                while ($i <2):
                     $output .= " and ninety seven centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==98){

                $i = 1;
                while ($i <2):
                     $output .= " and ninety eight centavos only";
                    $i++;
                endwhile;
           }
           else if($fraction ==99){

                $i = 1;
                while ($i <2):
                     $output .= " and ninety nine centavos only";
                    $i++;
                endwhile;
           }

        }

    }
      else{
            $output .= " PESOS ONLY";
           }

    return $output;
}

function convertGroup($index)
{
    switch ($index)
    {
        case 11:
            return " decillion";
        case 10:
            return " nonillion";
        case 9:
            return " octillion";
        case 8:
            return " septillion";
        case 7:
            return " sextillion";
        case 6:
            return " quintrillion";
        case 5:
            return " quadrillion";
        case 4:
            return " trillion";
        case 3:
            return " billion";
        case 2:
            return " million";
        case 1:
            return " thousand";
        case 0:
            return "";
    }
}

function convertThreeDigit($digit1, $digit2, $digit3)
{
    $buffer = " ";

    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
    {
        return "";
    }

    if ($digit1 != "0")
    {
        $buffer .= convertDigit($digit1) . " hundred";
        if ($digit2 != "0" || $digit3 != "0")
        {
            $buffer .= " ";
        }
    }

    if ($digit2 != "0")
    {
        $buffer .= convertTwoDigit($digit2, $digit3);
    }
    else if ($digit3 != "0")
    {
        $buffer .= convertDigit($digit3);
    }

    return $buffer;
}

function convertTwoDigit($digit1, $digit2)
{
    if ($digit2 == "0")
    {
        switch ($digit1)
        {
            case "1":
                return "ten";
            case "2":
                return "twenty";
            case "3":
                return "thirty";
            case "4":
                return "forty";
            case "5":
                return "fifty";
            case "6":
                return "sixty";
            case "7":
                return "seventy";
            case "8":
                return "eighty";
            case "9":
                return "ninety";
        }
    } else if ($digit1 == "1")
    {
        switch ($digit2)
        {
            case "1":
                return "eleven";
            case "2":
                return "twelve";
            case "3":
                return "thirteen";
            case "4":
                return "fourteen";
            case "5":
                return "fifteen";
            case "6":
                return "sixteen";
            case "7":
                return "seventeen";
            case "8":
                return "eighteen";
            case "9":
                return "nineteen";
        }
    } else
    {
        $temp = convertDigit($digit2);
        switch ($digit1)
        {
            case "2":
                return "twenty $temp";
            case "3":
                return "thirty $temp";
            case "4":
                return "forty $temp";
            case "5":
                return "fifty $temp";
            case "6":
                return "sixty $temp";
            case "7":
                return "seventy $temp";
            case "8":
                return "eighty $temp";
            case "9":
                return "ninety $temp";
        }
    }
}

function convertDigit($digit)
{
    switch ($digit)
    {
        case "0":
            return "zero";
        case "1":
            return "one";
        case "2":
            return "two";
        case "3":
            return "three";
        case "4":
            return "four";
        case "5":
            return "five";
        case "6":
            return "six";
        case "7":
            return "seven";
        case "8":
            return "eight";
        case "9":
            return "nine";
    }

}

$query0 = " SELECT ";
$query0.= " CONCAT(  cl.fname ,'  ',cl.mname,'  ',cl.lname ) as wi , CONCAT(  cl.home_no ,'  ',cl.home_brgy,',  ',cl.home_city ) as  we ,cl.tin_no,ic.name,acn.acc_no FROM client_list cl INNER JOIN industry_corp ic ON ic.id=cl.ind_corp_id  INNER JOIN account_no acn on acn.id=cl.client_number ";
$query0.= " WHERE cl.is_deleted='0' and cl.client_number='".$_POST['orclnt']."'  ";

$fetchcv0 = $con->myQuery($query0)->fetch(PDO::FETCH_NUM);




  $date = $_POST['ordate'];
  if(!empty( $_POST['cr1']))
  {
       $value=str_replace(",", "",$_POST['cr1']);
  }
   if(!empty( $_POST['cr2']))
  {
         $value=str_replace(",", "",$_POST['cr2']);
     $bank1=$_POST['bank'];

     $bank=$con->myQuery("SELECT  name FROM bank where is_deleted = 0 and id='".$bank1."' ")->fetch(PDO::FETCH_NUM);


     $cheque=$_POST['cheque'];  
     $chequedate=$_POST['chequedate']; 
  }
  else
  {
          

  }


 $orno=$_POST['orno'];



$tag='';
$totalcredit='';
$totalcredit1='';
$totaldebit='';
$price='';
 if(!empty($_POST['cr1'] ))
 {
          $cr1=str_replace(",", "",$_POST['cr1']);
              $totaldebit[].=  $cr1;
 }
  if(!empty($_POST['cr2'] ))
 {
          $cr2=str_replace(",", "",$_POST['cr2']);
          $totaldebit[].= $cr2;
 }



  if(!empty($_POST['crs1'] ))
 {
          $crs1=str_replace(",", "",$_POST['crs1']);
       $totalcredit[].=  $crs1;
 }
  if(!empty($_POST['crs2'] ))
 {
          $crs2=str_replace(",", "",$_POST['crs2']);
             $totalcredit[].=  $crs2;
 }
  if(!empty($_POST['crs3'] ))
 {
          $crs3=str_replace(",", "",$_POST['crs3']);
            $totalcredit[].=  $crs3;
 }
  if(!empty($_POST['crs4'] ))
 {
          $crs4=str_replace(",", "",$_POST['crs4']);
            $totalcredit[].=  $crs4;
 }
  if(!empty($_POST['crs5'] ))
 {
          $crs5=str_replace(",", "",$_POST['crs5']);
            $totalcredit[].=  $crs5;
 }
  if(!empty($_POST['crs6'] ))
 {
          $crs6=str_replace(",", "",$_POST['crs6']);
            $totalcredit1[].=  $crs6;
 }
  if(!empty($_POST['crs7'] ))
 {
          $crs7=str_replace(",", "",$_POST['crs7']);
            $totalcredit1[].=  $crs7;
 }
  if(!empty($_POST['crs8'] ))
 {
          $crs8=str_replace(",", "",$_POST['crs8']);
            $totalcredit1[].=  $crs8;
 }


$x111=$value;


if(!empty($totalcredit) &&  !empty($totalcredit1))
{
  $x222=array_sum($totalcredit);
$x333=array_sum($totalcredit1);
$tc=$x111-($x222 - $x333) ;
}

elseif(empty($totalcredit) &&  !empty($totalcredit1))
{

$x333=array_sum($totalcredit1);
$tc=$x111-$x333;
}
elseif(!empty($totalcredit) &&  empty($totalcredit1))
{
  $x222=array_sum($totalcredit);

$tc=$x111-$x222;
}
else
{
$tc=$x111;
}






  if ($tc>0 && $tc<=$x111)
  {
    $tag[].='Receivables Financed';
    $price[].=number_format( $tc,2 );
  }
  elseif($tc>0 && $tc>=$x111)
    {
        $tag[].='Receivables Financed';
    $price[].=number_format( $x111,2 );
    }
    else
    {

    }
if(!empty($crs1 ) && ($crs1!=0))
 {
    $tag[].='HFC';
    $price[].=number_format( $crs1,2 );
 }
  if(!empty($crs2 ) && ($crs2!=0))
 {
    $tag[].='PBC';
    $price[].=number_format( $crs2,2 );
 }
  if(!empty($cs3 )  && ($cs3!=0))
 {
            $tag[].='Miscellaneous Income / ( Loss ) LPC';
    $price[].=number_format( $cs3,2 ); }

 if(!empty($crs4 ) && empty($crs7 )  && ($crs4!=0) && ($crs7==0) )
 {
          $tag[].='HFC';
    $price[].=number_format( $crs4,2 );
 }

 if(!empty($crs5 ) && empty($crs8 ) && ($crs5!=0) && ($crs8==0))
 {
          $tag[].='Other';
    $price[].=number_format( $crs5,2 );
 }


  if(!empty($crs6 ) && ($crs6!=0) )
 {
           $tag[].='RCF';
    $price[].='-'.number_format( $crs6,2 );
 }

 
  if(!empty($crs7 ) && ($crs7!=0) )
 {
             $tag[].='Discount';
    $price[].='-'.number_format( $crs7,2 );
 }
  if(!empty($crs8 )  && ($crs8!=0))
 {
               $tag[].='Other Discounts';
    $price[].='-'.number_format( $crs8,2 );
 }



  $client=' '.$fetchcv0[0] ;
  $address=' '.$fetchcv0[1] ;

    
    $tin=' '.$fetchcv0[2];;
    $bsn=' '.$fetchcv0[3];


  if(!empty( $_POST['cr1']))
  {
    
         $sum = strtoupper(convertNumber(str_replace(",", "",$_POST['cr1'])));
  }
   if(!empty( $_POST['cr2']))
  {
        $sum = strtoupper(convertNumber(str_replace(",", "",$_POST['cr2'])));
  }


  $sum1= substr($sum, 0,60);
   $sum2= substr($sum, 60,200);

  $pdf = new FPDF('P','mm','LETTER');
  $font = 'Helvetica';
  $size18 ='14';
  $size10 = '10';
  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->SetFont($font, 'b', $size18);
  $pdf->Cell(0, 5, 'FILIPINO FINANCIAL CORPORATION', 0,1,'C');
  $pdf->SetFont($font, '', $size10);
  $pdf->Cell(0, 5, 'Unit 1803, 88 Corporate Center, Sedeno St.', 0,1,'C');
  $pdf->Cell(0, 5, 'Salcedo Village, Makati City', 0,1,'C');
  $pdf->Cell(0, 5, 'Tel.Nos.:892-9021 | Fax No.: 812-7454', 0,1,'C');
  $pdf->Cell(0, 5, 'NON-VAT Reg. TIN: 000-456-048-00000', 0,0,'C');
  $pdf->Cell(0, 5, 'OR '.$orno, 0,1,'R');                                                  ///or
 

  $pdf->Cell(0, 10, '', 0,1);   
  $pdf->SetFont($font, 'b', $size18);
  $pdf->Cell(0, 5, 'OFFICIAL RECEIPT', 0,1,'C');
  $pdf->Cell(0, 10, 'NO. '.$orno, 0,1,'R');      
  $pdf->SetFont($font, 'b', $size10);   
  $pdf->Cell(130, 5, '', 0,0); 
  $pdf->Cell(11, 5, 'Date : ', 0,0); 

  $pdf->SetFont($font, '', $size10);
  $pdf->Cell(54, 5,  date('M d, Y',strtotime($date)) , 'B',1,'C');   

  $pdf->SetFont($font, 'b', $size10);
  $pdf->Cell(30, 5, 'RECEIVED from  ' , 0,0);   
  $pdf->SetFont($font, '', $size10);
  $pdf->Cell(165, 5,' '. $client , 'B',1,'L');  

   $pdf->SetFont($font, 'b', $size10);
  $pdf->Cell(17, 5, 'Address  ' , 0,0,'L');    
  $pdf->SetFont($font, '', $size10);
  $pdf->Cell(178, 5, ' '.' '.' '.' '.' '.' '.' '.' '.' '.' '.' '.' '.' '.' '.$address , 'B',1,'L'); 

   $pdf->SetFont($font, 'b', $size10);
  $pdf->Cell(21, 5, 'the sum of  ' , 0,0,'L');    
  $pdf->SetFont($font, '', $size10);
  $pdf->Cell(174, 5, ' '.' '.' '.' '.' '.' '.' '.' '.' '.' '.$sum1 , 'B',1,'L'); 
   $pdf->SetFont($font, '', $size10);
   $pdf->Cell(21, 5, "" , 'B',0); 
  $pdf->Cell(174, 5, ' '.' '.' '.' '.' '.' '.' '.' '.' '.' '.' '.$sum2 , 'B',1); 


 $pdf->Cell(195, 5,'( P '.' '.' '.' ' .number_format($value,2) .' )', 'B',1,'R');
  $pdf->SetFont($font, 'b', $size10);        
 $pdf->Cell(10, 5, 'TIN  ' , 0,0);  
   $pdf->SetFont($font, '', $size10);  
 $pdf->Cell(30, 5, $tin , 'B',0); 

  $pdf->SetFont($font, 'b', $size10);
  $pdf->Cell(42, 5, 'Business Style/Name  ' , 0,0); 
    $pdf->SetFont($font, '', $size10);
  $pdf->Cell(113, 5, $bsn , 'B',1); 


$pdf->Cell(0, 5, '', 0,1); 


   $pdf->Cell(100, 5, 'Sr. Citizen TIN : ',1,1);
     $pdf->Cell(50, 5, '' , 'L,R',0);   
 
       $pdf->Cell(50, 5, '' , 'R',0);   
     $pdf->Cell(0, 5, '_____________________________' , 0,1,'R');      

    $pdf->Cell(50, 5, 'OSCA/PWD ID No.' , 'L,R,B',0);    
 
    $pdf->Cell(50, 5, 'Signature', 'R,B',0);  
    $pdf->SetFont($font, 'b', $size10); 
     $pdf->Cell(0, 5, 'Authorized Signature'.' '.' '.' '.' ' ,0,1,'R'); 

$pdf->SetFont($font, '', $size10); 
   if(!empty( $_POST['oraccno'] )  )
{

  $oraccno=' '.$fetchcv0[4] ;
    $pdf->Cell(0, 5, 'Account No. '.  $oraccno, 0,1);  
}
else
{
    $pdf->Cell(0, 5, '', 0,1);  
}

   
$pdf->SetFont($font, 'b', $size10); 
   $pdf->Cell(195, 5, 'IN PAYMENT OF : ', 'B',1,'L'); 

$ctag=count($tag);
for ($i=0; $i <$ctag ; $i++) { 

if($i==0)
{
    $pdf->SetFont($font, '', $size10); 
    $pdf->Cell(145, 5,$tag[$i], 'B',0,'L');

$pdf->SetFont($font, 'b', $size10); 
 $pdf->Cell(5, 5, ' P ', 'B,R',0,'R');
 $pdf->SetFont($font, '', $size10); 
  $pdf->Cell(45, 5,  $price[$i], 'B',1,'R');
}
else
{
   $pdf->Cell(150, 5, $tag[$i], 'B,R',0,'L');
  $pdf->Cell(45, 5, $price[$i] , 'B',1,'R');
}


}

for ($i=0; $i <(8-$ctag) ; $i++) { 
    $pdf->Cell(150, 5, '', 'B,R',0,'L');
  $pdf->Cell(45, 5,'', 'B',1,'L');
}


  
$pdf->SetFont($font, 'b', $size10); 
   $pdf->Cell(150, 5, 'TOTAL '.' '.' '.' P ', 'B,R',0,'R');
       $pdf->SetFont($font, '', $size10); 
  $pdf->Cell(45, 5, number_format( $value,2 ) , 'B',1,'R');


  $pdf->Cell(0, 5, '', 0,1);
  
$pdf->SetFont($font, 'b', $size10); 
   $pdf->Cell(195, 5, 'MODE OF PAYMENT', 'B',1,'L'); 

 if(!empty( $_POST['cr1']))
  {
       $value=str_replace(",", "",$_POST['cr1']);

    $pdf->Cell(150, 5, 'Cash', 'B,R',0,'L');
    $pdf->SetFont($font, '', $size10); 
    $pdf->Cell(45, 5, number_format( $value ,2), 'B',1,'R');
    $pdf->SetFont($font, 'b', $size10); 
    $pdf->Cell(150, 5, 'Cheque', 'B,R',0,'L');
    $pdf->SetFont($font, '', $size10); 
    $pdf->Cell(45, 5, '0.00', 'B',1,'R');

    $pdf->SetFont($font, 'b', $size10); 
   $pdf->Cell(150, 5, 'TOTAL '.' '.' '.' P ', 'B,R',0,'R');
       $pdf->SetFont($font, '', $size10); 
  $pdf->Cell(45, 5,  number_format( $value ,2), 'B',1,'R');

  }

    if(!empty( $_POST['cr2']))
  {
       $value=str_replace(",", "",$_POST['cr2']);

    $pdf->Cell(150, 5, 'Cash', 'B,R',0,'L');
    $pdf->SetFont($font, '', $size10); 
    $pdf->Cell(45, 5, '0.00', 'B',1,'R');
    $pdf->SetFont($font, 'b', $size10); 
    $pdf->Cell(150, 5, 'Cheque '.' '.$bank[0].' '.$cheque.' '.$chequedate , 'B,R',0,'L');
    $pdf->SetFont($font,'', $size10); 
    $pdf->Cell(45, 5,  number_format( $value ,2) , 'B',1,'R');

    $pdf->SetFont($font, 'b', $size10); 
   $pdf->Cell(150, 5, 'TOTAL '.' '.' '.' P ', 'B,R',0,'R');
       $pdf->SetFont($font, '', $size10); 
  $pdf->Cell(45, 5,number_format( $value ,2) , 'B',1,'R');

  }





$pdf->Cell(0, 5, '', 0,1); 


$pdf->Cell(50, 5, '200 bklts | 50 x 4 | 0240501 - 0250500 ', 0,1,'L');
$pdf->Cell(98, 5, 'BIR Authority to Print No. OCN9AU0001009407E ', 0,0,'L');
$pdf->Cell(98, 5, 'Through Counter Payment ', 0,1,'L');
$pdf->Cell(98, 5, 'Date Issued: 05-25-2017 Valid until 05-24-2022', 0,0,'L');
$pdf->Cell(98, 5, "Printer's Accreditation No. 034MP20130000000001", 0,1,'L');
 $pdf->Cell(98, 5, 'IMAGE TEXT & FONTS, INC.', 0,0,'L');
  $pdf->Cell(98, 5, 'Date of Accreditation : Dec. 27, 2013 ', 0,1,'L');
  $pdf->Cell(50, 5, '2164 Zafiro St., San Andres Bukid, Manila', 0,1,'L');
 $pdf->Cell(50, 5, 'VAT REG TIN : 004-484-699-00000', 0,1,'L');
  $pdf->Cell(50, 5, 'APP/000000000038290/2017', 0,1,'L');

  $pdf->Cell(0, 5, '', 0,1);
$pdf->SetFont($font, 'b', $size10); 
    $pdf->Cell(0, 5, '"THIS DOCUMENT IS NOT VALID FOR CLAIMING INPUT TAXES"', 0,1,'C');
    $pdf->SetFont($font, 'i', $size10); 
    $pdf->Cell(0, 5, '"THIS OFFICIAL RECEIPT SHALL BE VALID FOR FIVE (5) TEARS FROM THE DATE OF ATP"', 0,1,'C');


  $pdf->Output();


  

ob_end_flush();
?>