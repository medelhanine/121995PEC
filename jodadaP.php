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

$dead_feminin = $request["dead_feminin"];
$dead_masculin = $request["dead_masculin"];
$notDeclare_feminin = $request["notDeclare_feminin"];
$notDeclare_masculin = $request["notDeclare_masculin"];
$ahkam_naiss_annee_actu_fem = $request["ahkam_naiss_annee_actu_fem"];
$ahkam_naiss_annee_actu_masc = $request["ahkam_naiss_annee_actu_masc"];
$naiss_legal_fem = $request["naiss_legal_fem"];
$naiss_legal_masc = $request["naiss_legal_masc"];
$som_naiss_fem = $request["som_naiss_fem"];
$som_naiss_masc = $request["som_naiss_masc"];
$ahkam_naiss_fem = $request["ahkam_naiss_fem"];
$ahkam_naiss_masc = $request["ahkam_naiss_masc"]; 
$notDeclareOrdre_masc = $request["notDeclareOrdre_masc"];

$notDeclareOrdre_fem = $request["notDeclareOrdre_fem"];
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


        

         
        
      }
      // SECOND PAGE**********************************************************************
      if($pageNo==2)
      {
        $size = $pdf->useImportedPage($templateId, -2.5 , -3.5, 215);

            $someMasculin = 0;
          
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
          //$notDeclare_masculin =0;

        //wafayat selon age

        //masculin
        $query2="SELECT * FROM sdeadtable WHERE SUBSTRING(`time_stamp`, 6, 2) = ? AND  SUBSTRING(`time_stamp`, 1, 4) =? AND sex='masculin'";
        $pdoResult2 = $pdoConnect->prepare($query2);
        $pdoResult2->execute(array($monthComplet,$year));
        $result2=$pdoResult2->fetchAll();

       
            
            foreach($result2 as $row)
            {
              //precise the age
              $date_deces = preg_match('/([0-9]{4})/', $row["date_deces_miladi"], $annee_deces);
              $date_naiss = preg_match('/([0-9]{4})/', $row["date_naiss_miladi"], $annee_naiss);

            

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

            $someMasculin = $dead_masculin+$moinsAn+$one2four+$five2nine+$ten2fourten+$fiften2ninten+$twenty2twentyfour+$twentyfive2twentynine+$tirthy2thirtyfour+$thirthyfive2thirtynine+$fourty2fourtyfour+$fourtyfive2fourtynine+$fifty2fiftyfour+$fiftyfive2fiftynine+$sixty2sixtyfour+$sixtyfive2sixtynine+$sevnty2sevntyfour+$seventyfive2seventynine+$pluseighty+$notDeclare_masculin+$dead_masculin;
            $pdf->SetFont('helvetica', 'B', 11);

            $pdf->SetXY(106, 172.5);
            $pdf->Cell(0, 25,$someMasculin,'C');//

            $pdf->SetXY(106, 167);
            $pdf->Cell(0, 25,$notDeclare_masculin,'C');//

            $pdf->SetXY(106, 161.75);
            $pdf->Cell(0, 25,$pluseighty,'C');//

            $pdf->SetXY(106, 156.75);
            $pdf->Cell(0, 25,$seventyfive2seventynine,'C');//

            $pdf->SetXY(106, 151.5);
            $pdf->Cell(0, 25,$sevnty2sevntyfour,'C');//

            $pdf->SetXY(106, 146);
            $pdf->Cell(0, 25,$sixtyfive2sixtynine,'C');//

            $pdf->SetXY(106, 140.5);
            $pdf->Cell(0, 25,$sixty2sixtyfour,'C');//

            $pdf->SetXY(106, 135.25);
            $pdf->Cell(0, 25,$fiftyfive2fiftynine,'C');//

            $pdf->SetXY(106, 130);
            $pdf->Cell(0, 25,$fifty2fiftyfour,'C');//

            $pdf->SetXY(106, 124.75);
            $pdf->Cell(0, 25,$fourtyfive2fourtynine,'C');//

            $pdf->SetXY(106, 119.75);
            $pdf->Cell(0, 25,$fourty2fourtyfour,'C');//

            $pdf->SetXY(106, 114.75);
            $pdf->Cell(0, 25,$thirthyfive2thirtynine,'C');//

            $pdf->SetXY(106, 109.75);
            $pdf->Cell(0, 25,$tirthy2thirtyfour,'C');//

            $pdf->SetXY(106, 104.5);
            $pdf->Cell(0, 25,$twentyfive2twentynine,'C');//

            $pdf->SetXY(106, 99);
            $pdf->Cell(0, 25,$twenty2twentyfour,'C');//

            $pdf->SetXY(106, 93.5);
            $pdf->Cell(0, 25,$fiften2ninten,'C'); //

            $pdf->SetXY(106, 87.75);
            $pdf->Cell(0, 25,$ten2fourten,'C'); //

            $pdf->SetXY(106, 82.75);
            $pdf->Cell(0, 25,$five2nine,'C'); //

            $pdf->SetXY(106, 82.75);
            $pdf->Cell(0, 25,$five2nine,'C'); //

            $pdf->SetXY(106, 77.75);
            $pdf->Cell(0, 25,$one2four,'C'); //

            $pdf->SetXY(106, 72.75);
            $pdf->Cell(0, 25,$moinsAn,'C'); //

            $pdf->SetXY(106, 67.75);
            $pdf->Cell(0, 25,$dead_masculin,'C'); //

            
         
       




       //feminin
       $query2="SELECT * FROM sdeadtable WHERE SUBSTRING(`time_stamp`, 6, 2) = ? AND  SUBSTRING(`time_stamp`, 1, 4) =? AND sex='feminin'";
       $pdoResult2 = $pdoConnect->prepare($query2);
       $pdoResult2->execute(array($monthComplet,$year));
       $result2=$pdoResult2->fetchAll();
       
            $someFeminin =0;
           // $notDeclare_feminin =0;
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

           $someFeminin = $dead_feminin+$moinsAn+$one2four+$five2nine+$ten2fourten+$fiften2ninten+$twenty2twentyfour+$twentyfive2twentynine+$tirthy2thirtyfour+$thirthyfive2thirtynine+$fourty2fourtyfour+$fourtyfive2fourtynine+$fifty2fiftyfour+$fiftyfive2fiftynine+$sixty2sixtyfour+$sixtyfive2sixtynine+$sevnty2sevntyfour+$seventyfive2seventynine+$pluseighty+$notDeclare_feminin+$dead_feminin;
           $pdf->SetFont('helvetica', 'B', 11);

           $pdf->SetXY(160, 172.5);
           $pdf->Cell(0, 25,$someFeminin,'C');//

           $pdf->SetXY(160, 167);
           $pdf->Cell(0, 25,$notDeclare_feminin,'C');//

           $pdf->SetXY(160, 161.75);
           $pdf->Cell(0, 25,$pluseighty,'C');//

           $pdf->SetXY(160, 156.75);
           $pdf->Cell(0, 25,$seventyfive2seventynine,'C');//

           $pdf->SetXY(160, 151.5);
           $pdf->Cell(0, 25,$sevnty2sevntyfour,'C');//

           $pdf->SetXY(160, 146);
           $pdf->Cell(0, 25,$sixtyfive2sixtynine,'C');//

           $pdf->SetXY(160, 140.5);
           $pdf->Cell(0, 25,$sixty2sixtyfour,'C');//

           $pdf->SetXY(160, 135.25);
           $pdf->Cell(0, 25,$fiftyfive2fiftynine,'C');//

           $pdf->SetXY(160, 130);
           $pdf->Cell(0, 25,$fifty2fiftyfour,'C');//

           $pdf->SetXY(160, 124.75);
           $pdf->Cell(0, 25,$fourtyfive2fourtynine,'C');//

           $pdf->SetXY(160, 119.75);
           $pdf->Cell(0, 25,$fourty2fourtyfour,'C');//

           $pdf->SetXY(160, 114.75);
           $pdf->Cell(0, 25,$thirthyfive2thirtynine,'C');//

           $pdf->SetXY(160, 109.75);
           $pdf->Cell(0, 25,$tirthy2thirtyfour,'C');//

           $pdf->SetXY(160, 104.5);
           $pdf->Cell(0, 25,$twentyfive2twentynine,'C');//

           $pdf->SetXY(160, 99);
           $pdf->Cell(0, 25,$twenty2twentyfour,'C');//

           $pdf->SetXY(160, 93.5);
           $pdf->Cell(0, 25,$fiften2ninten,'C'); //

           $pdf->SetXY(160, 87.75);
           $pdf->Cell(0, 25,$ten2fourten,'C'); //

           $pdf->SetXY(160, 82.75);
           $pdf->Cell(0, 25,$five2nine,'C'); //

           $pdf->SetXY(160, 82.75);
           $pdf->Cell(0, 25,$five2nine,'C'); //

           $pdf->SetXY(160, 77.75);
           $pdf->Cell(0, 25,$one2four,'C'); //

           $pdf->SetXY(160, 72.75);
           $pdf->Cell(0, 25,$moinsAn,'C'); //

           $pdf->SetXY(160, 67.75);
           $pdf->Cell(0, 25,$dead_feminin,'C'); //           
        
      

           //ORDRE NAISSANCE masculin
            $one = 0;
            $two = 0;
            $three = 0 ;
            $four = 0 ;
            $five = 0 ;
            $six = 0 ;
            $seven = 0 ;
            $eight = 0 ;
            $nine = 0 ;
            $plusten = 0 ;
            $som =0;

            $query2="SELECT sdeadtable.prenom,sdeadtable.nom,sbirth.ordre_naiss FROM sdeadtable INNER JOIN sbirth ON sdeadtable.nom = sbirth.nom WHERE sdeadtable.sex ='masculin' AND sbirth.dead = 1 AND SUBSTRING(sdeadtable.time_stamp, 6, 2) = ? AND  SUBSTRING(sdeadtable.time_stamp, 1, 4)=?";
            $pdoResult2 = $pdoConnect->prepare($query2);
            $pdoResult2->execute(array($monthComplet,$year));
            $result2=$pdoResult2->fetchAll();

            

            foreach($result2 as $row)
            {
                if($row["ordre_naiss"]==1)
                {
                    $one++;
                }
                if($row["ordre_naiss"]==2)
                {
                    $two++;
                }
                if($row["ordre_naiss"]==3)
                {
                    $three++;
                }
                if($row["ordre_naiss"]==4)
                {
                    $four++;
                }
                if($row["ordre_naiss"]==5)
                {
                    $five++;
                }
                if($row["ordre_naiss"]==6)
                {
                    $six++;
                }
                if($row["ordre_naiss"]==7)
                {
                    $seven++;
                }
                if($row["ordre_naiss"]==8)
                {
                    $eight++;
                }
                if($row["ordre_naiss"]==9)
                {
                    $nine++;
                }
                if($row["ordre_naiss"] >=10)
                {
                    $plusten++;
                }
            }

            $som = $one+$two+$three+$four+$five+$six+$seven+$eight+$nine+$plusten+$notDeclareOrdre_masc;
            $pdf->SetXY(106, 192.75);
            $pdf->Cell(0, 25,$one ,'C'); //

            $pdf->SetXY(106, 199);
            $pdf->Cell(0, 25,$two,'C'); // 

            $pdf->SetXY(106, 206);
            $pdf->Cell(0, 25,$three,'C'); //

            $pdf->SetXY(106, 212);
            $pdf->Cell(0, 25,$four,'C'); //

            $pdf->SetXY(106, 218.25);
            $pdf->Cell(0, 25,$five,'C'); //

            $pdf->SetXY(106, 224.5);
            $pdf->Cell(0, 25,$six,'C'); //

            $pdf->SetXY(106, 230.75);
            $pdf->Cell(0, 25,$seven,'C'); //$seven

            $pdf->SetXY(106, 237);
            $pdf->Cell(0, 25,$eight,'C'); //$eight 

            $pdf->SetXY(106, 243.5);
            $pdf->Cell(0, 25,$nine,'C'); //$nine 

            $pdf->SetXY(106, 249.5);
            $pdf->Cell(0, 25,$plusten,'C'); //$plusten

            $pdf->SetXY(106, 255.5);
            $pdf->Cell(0, 25,$notDeclareOrdre_masc,'C'); //$notDeclareOrdre_masc

            $pdf->SetXY(106, 261.5);
            $pdf->Cell(0, 25,$som,'C'); //$som



            $one = 0;
            $two = 0;
            $three = 0 ;
            $four = 0 ;
            $five = 0 ;
            $six = 0 ;
            $seven = 0 ;
            $eight = 0 ;
            $nine = 0 ;
            $plusten = 0 ;
            $som =0;
            $query2="SELECT sdeadtable.prenom,sdeadtable.nom,sbirth.ordre_naiss FROM sdeadtable INNER JOIN sbirth ON sdeadtable.nom = sbirth.nom WHERE sdeadtable.sex ='feminin' AND sbirth.dead = 1 AND SUBSTRING(sdeadtable.time_stamp, 6, 2) = ? AND  SUBSTRING(sdeadtable.time_stamp, 1, 4)=?";
            $pdoResult2 = $pdoConnect->prepare($query2);
            $pdoResult2->execute(array($monthComplet,$year));
            $result2=$pdoResult2->fetchAll();            

            foreach($result2 as $row)
            {
                if($row["ordre_naiss"]==1)
                {
                    $one++;
                }
                if($row["ordre_naiss"]==2)
                {
                    $two++;
                }
                if($row["ordre_naiss"]==3)
                {
                    $three++;
                }
                if($row["ordre_naiss"]==4)
                {
                    $four++;
                }
                if($row["ordre_naiss"]==5)
                {
                    $five++;
                }
                if($row["ordre_naiss"]==6)
                {
                    $six++;
                }
                if($row["ordre_naiss"]==7)
                {
                    $seven++;
                }
                if($row["ordre_naiss"]==8)
                {
                    $eight++;
                }
                if($row["ordre_naiss"]==9)
                {
                    $nine++;
                }
                if($row["ordre_naiss"] >=10)
                {
                    $plusten++;
                }
            }

            $som = $one+$two+$three+$four+$five+$six+$seven+$eight+$nine+$plusten+$notDeclareOrdre_fem;

            $pdf->SetXY(160, 192.75);
            $pdf->Cell(0, 25,$one,'C'); //$one 

            $pdf->SetXY(160, 199);
            $pdf->Cell(0, 25,$two,'C'); //$two 

            $pdf->SetXY(160, 206);
            $pdf->Cell(0, 25,$three,'C'); //$three

            $pdf->SetXY(160, 212);
            $pdf->Cell(0, 25,$four,'C'); //$four

            $pdf->SetXY(160, 218.25);
            $pdf->Cell(0, 25,$five,'C'); //$five

            $pdf->SetXY(160, 224.5);
            $pdf->Cell(0, 25,$six,'C'); //$six

            $pdf->SetXY(160, 230.75);
            $pdf->Cell(0, 25,$seven,'C'); //$seven

            $pdf->SetXY(160, 237);
            $pdf->Cell(0, 25,$eight,'C'); //$eight 

            $pdf->SetXY(160, 243.5);
            $pdf->Cell(0, 25,$nine,'C'); //$nine 

            $pdf->SetXY(160, 249.5);
            $pdf->Cell(0, 25,$plusten,'C'); //$plusten

            $pdf->SetXY(160, 255.5);
            $pdf->Cell(0, 25,$notDeclareOrdre_fem,'C'); //$notDeclareOrdre_masc

            $pdf->SetXY(160, 261.5);
            $pdf->Cell(0, 25,$som,'C'); //$som



  
      }


      //third page ****************************************
      if($pageNo==3)
      {
        $size = $pdf->useImportedPage($templateId, -2.5 , -3.5, 215);

        $P1 = 0;
        $P2 = 0;
        $P3 = 0;
        $P4 = 0;
        $P5 = 0;
        $P6 = 0;
        $P7 = 0;
        $P8 = 0;
        $P9 = 0;
        $P10 = 0;
        $P11 = 0;
        $som = 0;
       
        
        $query2="select numero,annee,prof_categ FROM sdeadtable WHERE sex='masculin'";
        $pdoResult2 = $pdoConnect->prepare($query2);
        $pdoResult2->execute(array($monthComplet,$year));
        $result2=$pdoResult2->fetchAll();
        
        foreach($result2 as $row)
        {
            if($row["prof_categ"]=="P1")
            {
                $P1++;
            }

            if($row["prof_categ"]=="P2")
            {
                $P2++;
            }

            if($row["prof_categ"]=="P3")
            {
                $P3++;
            }

            if($row["prof_categ"]=="P4")
            {
                $P4++;
            }

            if($row["prof_categ"]=="P5")
            {
                $P5++;
            }

            if($row["prof_categ"]=="P6")
            {
                $P6++;
            }

            if($row["prof_categ"]=="P7")
            {
                $P7++;
            }

            if($row["prof_categ"]=="P8")
            {
                $P8++;
            }

            if($row["prof_categ"]=="P9")
            {
                $P9++;
            }

            if($row["prof_categ"]=="P10")
            {
                $P10++;
            }

            if($row["prof_categ"]=="P11")
            {
                $P11++;
            }            
        }

        $som = $P1+$P2+$P3+$P4+$P5+$P6+$P7+$P8+$P9+$P10+$P11;

        $pdf->SetXY(127, 74);
        $pdf->Cell(0, 25,$P1,'C'); //$P1

        $pdf->SetXY(127, 91);
        $pdf->Cell(0, 25,$P2,'C'); //$P1

        $pdf->SetXY(127, 107);
        $pdf->Cell(0, 25,$P3,'C'); //$P1


        $pdf->SetXY(127, 124);
        $pdf->Cell(0, 25,$P4,'C'); //$P1

        $pdf->SetXY(127, 141);
        $pdf->Cell(0, 25,$P5,'C'); //$P1

        $pdf->SetXY(127, 157);
        $pdf->Cell(0, 25,$P6,'C'); //$P1

        $pdf->SetXY(127, 174);
        $pdf->Cell(0, 25,$P7,'C'); //$P1

        $pdf->SetXY(127, 191);
        $pdf->Cell(0, 25,$P8,'C'); //$P1

        $pdf->SetXY(127, 208);
        $pdf->Cell(0, 25,$P9,'C'); //$P1

        $pdf->SetXY(127, 224);
        $pdf->Cell(0, 25,$P10,'C'); //$P1

        $pdf->SetXY(127, 241);
        $pdf->Cell(0, 25,$P11,'C'); //$P1

        $pdf->SetXY(127, 253);
        $pdf->Cell(0, 25,$som,'C'); //$som



        $P1 = 0;
        $P2 = 0;
        $P3 = 0;
        $P4 = 0;
        $P5 = 0;
        $P6 = 0;
        $P7 = 0;
        $P8 = 0;
        $P9 = 0;
        $P10 = 0;
        $P11 = 0;
        $som = 0;
       
        
        $query2="select numero,annee,prof_categ FROM sdeadtable WHERE sex='feminin'";
        $pdoResult2 = $pdoConnect->prepare($query2);
        $pdoResult2->execute(array($monthComplet,$year));
        $result2=$pdoResult2->fetchAll();
        
        foreach($result2 as $row)
        {
            if($row["prof_categ"]=="P1")
            {
                $P1++;
            }

            if($row["prof_categ"]=="P2")
            {
                $P2++;
            }

            if($row["prof_categ"]=="P3")
            {
                $P3++;
            }

            if($row["prof_categ"]=="P4")
            {
                $P4++;
            }

            if($row["prof_categ"]=="P5")
            {
                $P5++;
            }

            if($row["prof_categ"]=="P6")
            {
                $P6++;
            }

            if($row["prof_categ"]=="P7")
            {
                $P7++;
            }

            if($row["prof_categ"]=="P8")
            {
                $P8++;
            }

            if($row["prof_categ"]=="P9")
            {
                $P9++;
            }

            if($row["prof_categ"]=="P10")
            {
                $P10++;
            }

            if($row["prof_categ"]=="P11")
            {
                $P11++;
            }            
        }

        $som = $P1+$P2+$P3+$P4+$P5+$P6+$P7+$P8+$P9+$P10+$P11;

        $pdf->SetXY(167, 74);
        $pdf->Cell(0, 25,$P1,'C'); //$P1

        $pdf->SetXY(167, 91);
        $pdf->Cell(0, 25,$P2,'C'); //$P1

        $pdf->SetXY(167, 107);
        $pdf->Cell(0, 25,$P3,'C'); //$P1


        $pdf->SetXY(167, 124);
        $pdf->Cell(0, 25,$P4,'C'); //$P1

        $pdf->SetXY(167, 141);
        $pdf->Cell(0, 25,$P5,'C'); //$P1

        $pdf->SetXY(167, 157);
        $pdf->Cell(0, 25,$P6,'C'); //$P1

        $pdf->SetXY(167, 174);
        $pdf->Cell(0, 25,$P7,'C'); //$P1

        $pdf->SetXY(167, 191);
        $pdf->Cell(0, 25,$P8,'C'); //$P1

        $pdf->SetXY(167, 208);
        $pdf->Cell(0, 25,$P9,'C'); //$P1

        $pdf->SetXY(167, 224);
        $pdf->Cell(0, 25,$P10,'C'); //$P1

        $pdf->SetXY(167, 241);
        $pdf->Cell(0, 25,$P11,'C'); //$P1

        $pdf->SetXY(167, 253);
        $pdf->Cell(0, 25,$som,'C'); //$som

       
  
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
