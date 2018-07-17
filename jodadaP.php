<?php
require 'dbConnect.php';
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: login/error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $username = $_SESSION['username'];
    //$superUser = $_SESSION['superUser'];
}
use setasign\Fpdi;
require_once('vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('vendor/setasign/fpdi/src/autoload.php');
class Pdf extends Fpdi\TcpdfFpdi
{
    protected $tplId;
}
date_default_timezone_set('UTC');
$ActualDate = date('Y/m/d');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);
// initiate PDF
ob_start();
$pdf = new Pdf();
$pdf->SetAutoPageBreak(true, 0);
$pageCount = $pdf->setSourceFile('imprimeModels\jodada.pdf');
$fontname = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
// set some language dependent data:
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';
// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);
//some queries with db
$query='';

$pdoResult;

$month= (string)$request["month_jodada"];
$monthComplet = "0".$month;
$result_month = $months_letter[$month];
$year= (string)$request["year_jodada"];

  // iterate through all pages
  for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
      // import a page
      $templateId = $pdf->importPage($pageNo);
  $pdf->setPrintHeader(false);
  $pdf->setPrintFooter(false);
      $pdf->AddPage();
      // FIRST PAGE**********************************************************************
      if($pageNo==1)
      {   
          $size = $pdf->useImportedPage($templateId, -2.5 , -3.5, 215);


          $pdf->setRTL(true);
        
          $pdf->SetFont($fontname, 'B', 11);
          $pdf->SetXY(147.5, 2.5);
          $pdf->Cell(0, 25,$result_month,'C'); //
  
          $pdf->SetFont('helvetica', 'B', 11);
          $pdf->SetXY(167, 2.5);
          $pdf->Cell(0, 25,$year,'C'); // 

          //zawajat *******************
            //feminin
      $query=" SELECT count(numero) FROM timep_stamp_table WHERE SUBSTRING(`timestamp`, 6, 2) = ? AND sex='feminin' AND SUBSTRING(`timestamp`, 1, 4) =? AND type='zawaj'";
      $pdoResult = $pdoConnect->prepare($query);
      $pdoResult->execute(array($monthComplet,$year));
      $result=$pdoResult->fetch();
      if($pdoResult->rowCount()>0)
        {
            $feminin_number=$result['count(numero)'];

            if($feminin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(156, 150);
                $pdf->Cell(0, 25,$feminin_number,'C');
            }else{
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(156, 150);
                $pdf->Cell(0, 25,"00",'C');
            }
        } 
        
        //masculin

        $query2=" SELECT count(numero) FROM timep_stamp_table WHERE SUBSTRING(`timestamp`, 6, 2) = ? AND sex='masculin' AND SUBSTRING(`timestamp`, 1, 4) =? AND type='zawaj'";
      $pdoResult2 = $pdoConnect->prepare($query2);
      $pdoResult2->execute(array($monthComplet,$year));
      $result2=$pdoResult2->fetch();
      if($pdoResult2->rowCount()>0)
        {
            $masculin_number=$result2['count(numero)'];
            if($masculin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(100, 150);
                $pdf->Cell(0, 25,$masculin_number,'C');
            }else{
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(100, 150);
                $pdf->Cell(0, 25,"00",'C');
            }
        } 
             

            //tala9aat ****************************************
            //feminin
      $query=" SELECT count(numero) FROM timep_stamp_table WHERE SUBSTRING(`timestamp`, 6, 2) = ? AND sex='feminin' AND SUBSTRING(`timestamp`, 1, 4) =? AND type='talak'";
      $pdoResult = $pdoConnect->prepare($query);
      $pdoResult->execute(array($monthComplet,$year));
      $result=$pdoResult->fetch();
      if($pdoResult->rowCount()>0)
        {
            $feminin_number=$result['count(numero)'];

            if($feminin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(156, 156);
                $pdf->Cell(0, 25,$feminin_number,'C');
            }else{
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(156, 157);
                $pdf->Cell(0, 25,"00",'C');
            }
        } 
        
        //masculin

        $query2=" SELECT count(numero) FROM timep_stamp_table WHERE SUBSTRING(`timestamp`, 6, 2) = ? AND sex='masculin' AND SUBSTRING(`timestamp`, 1, 4) =? AND type='talak'";
      $pdoResult2 = $pdoConnect->prepare($query2);
      $pdoResult2->execute(array($monthComplet,$year));
      $result2=$pdoResult2->fetch();
      if($pdoResult2->rowCount()>0)
        {
            $masculin_number=$result2['count(numero)'];
            if($masculin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(100, 157);
                $pdf->Cell(0, 25,$masculin_number,'C');
            }else{
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(100, 157);
                $pdf->Cell(0, 25,"00",'C');
            }
        } 


        //wafayat selon age

        //masculin
          $query2="SELECT * FROM sdeadtable WHERE SUBSTRING(`time_stamp`, 6, 2) = ? AND sex='masculin' AND  SUBSTRING(`time_stamp`, 1, 4) =?";
          $pdoResult2 = $pdoConnect->prepare($query2);
          $pdoResult2->execute(array($monthComplet,$year));
          $result2=$pdoResult2->fetchAll();

          if($pdoResult2->rowCount()>0)
          {
             $moinsAn = 0;
             $one2four = 0;
             $five2nine =0;
             $ten2fourten =0;
             $fiften2ninten = 0;
             $twenty2twentyfour =0;
             $twentyfive2twentynine = 0;
             $tirthy2thirtyfour = 0;
             $thirthyfive2thirtynine =0;
             $fourty2fourtyfour = 0;
             $fourtyfive2fourtynine = 0;
             $fifty2fiftyfour = 0;
             $fiftyfive2fiftynine = 0;
             $sixty2sixtyfour = 0;
             $sixtyfive2sixtynine = 0;
                $sevnty2sevntyfour = 0;
                $seventyfive2seventynine = 0;
                $pluseighty = 0;

              
              foreach($result2 as $row)
              {
                //precise the age
                $date_deces = preg_match('/([0-9]{4})/', $row["date_deces_miladi"], $annee_deces);
                $date_naiss = preg_match('/([0-9]{4})/', $row["date_naiss_miladi"], $annee_naiss);

                $pdf->SetFont('helvetica', 'B', 62);
                $pdf->SetXY(100, 157);
                $pdf->Cell(0, 25,$date_naiss,'C');

                //calculate the number of every marge of age
                if($annee_deces[0]-$annee_naiss[0] < 1)
                {
                    $moinsAn++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=1 && $annee_deces[0]-$annee_naiss[0] <= 4)
                {
                    $one2four++;
                }


                if($annee_deces[0]-$annee_naiss[0] >=5 && $annee_deces[0]-$annee_naiss[0] <= 9)
                {
                    $five2nine++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=10 && $annee_deces[0]-$annee_naiss[0] <= 14)
                {
                    $ten2fourten++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=15 && $annee_deces[0]-$annee_naiss[0] <= 19)
                {
                    $fiften2ninten++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=20 && $annee_deces[0]-$annee_naiss[0] <= 24)
                {
                    $twenty2twentyfour++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=25 && $annee_deces[0]-$annee_naiss[0] <= 29)
                {
                    $twentyfive2twentynine++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=30 && $annee_deces[0]-$annee_naiss[0] <= 34)
                {
                    $tirthy2thirtyfour++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=35 && $annee_deces[0]-$annee_naiss[0] <= 39)
                {
                    $thirthyfive2thirtynine++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=40 && $annee_deces[0]-$annee_naiss[0] <= 44)
                {
                    $fourty2fourtyfour++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=45 && $annee_deces[0]-$annee_naiss[0] <= 49)
                {
                    $fourtyfive2fourtynine++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=50 && $annee_deces[0]-$annee_naiss[0] <= 54)
                {
                    $fifty2fiftyfour++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=55 && $annee_deces[0]-$annee_naiss[0] <= 59)
                {
                    $fiftyfive2fiftynine++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=60 && $annee_deces[0]-$annee_naiss[0] <= 64)
                {
                    $sixty2sixtyfour++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=60 && $annee_deces[0]-$annee_naiss[0] <= 64)
                {
                    $sixty2sixtyfour++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=65 && $annee_deces[0]-$annee_naiss[0] <= 69)
                {
                    $sixtyfive2sixtynine++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=70 && $annee_deces[0]-$annee_naiss[0] <= 74)
                {
                    $sevnty2sevntyfour++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=75 && $annee_deces[0]-$annee_naiss[0] <= 79)
                {
                    $seventyfive2seventynine++;
                }

                if($annee_deces[0]-$annee_naiss[0] >=80)
                {
                    $pluseighty++;
                }

              
              }

             
           
         }

         
        
      }
      // SECOND PAGE**********************************************************************
      if($pageNo==2)
      {
        $size = $pdf->useImportedPage($templateId, -2.5 , -3.5, 215);
        


  
      }


      //third page ****************************************
      if($pageNo==3)
      {
        $size = $pdf->useImportedPage($templateId, -2.5 , -3.5, 215);
        


  
      }


      // fourth page ************************************
      if($pageNo==4)
      {
        $size = $pdf->useImportedPage($templateId, -2.5 , -3.5, 215);
        


  
      }
      // fiveth page ************************************
      if($pageNo==5) 
      {
        $size = $pdf->useImportedPage($templateId, -2.5 , -3.5, 215);
        


  
      }

  }

 ob_end_clean();
$pdf->Output();
