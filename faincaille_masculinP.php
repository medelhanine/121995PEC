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
    $numero  = $_SESSION['numero'];
    $annee  = $_SESSION['annee'];
    //$superUser = $_SESSION['superUser'];
}
use setasign\Fpdi;

require_once('vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('vendor/setasign/fpdi/src/autoload.php');
// set some language dependent data:
  $lg = Array();
  $lg['a_meta_charset'] = 'UTF-8';
  $lg['a_meta_dir'] = 'rtl';
  $lg['a_meta_language'] = 'fa';
  $lg['w_page'] = 'page';


date_default_timezone_set('UTC');
$ActualDate = date('Y/m/d');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);





$numero_mokadam_ar= $request["numero_mokadam_ar"];
$numero_certificat_ar= $request["numero_certificat_ar"];
$date_certficat_ar= $request["date_certficat_ar"];
$mokadam_cheikh_ar= $request["mokadam_cheikh_ar"];

$domicile_ar= $request["domicile_ar"];

$numero_certificat_fr= $request["numero_certificat_fr"];
$numero_mokadam_fr= $request["numero_mokadam_fr"];
$date_certficat_fr= $request["date_certficat_fr"];
$mokadam_cheikh_fr= $request["mokadam_cheikh_fr"];

$domicile_fr= $request["domicile_fr"];

$numero_certificatB= $request["numero_certificatB"];
$numero_mokadamB= $request["numero_mokadamB"];
$date_certficatB= $request["date_certficatB"];
$mokadam_cheikhB_fr= $request["mokadam_cheikhB_fr"];
$mokadam_cheikhB_ar= $request["mokadam_cheikhB_ar"];
$domicileB_fr= $request["domicileB_fr"];
$domicileB_ar= $request["domicileB_ar"];
$etat_fammiliale_ar= $request["etat_fammiliale_ar"];
$profession_ar= $request["profession_ar"];
$language= $request["language"];


$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);
$query="SELECT * FROM `exbirth` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
	$result=$pdoResult->fetch();

// ONLY ARABIC ///////////////////////////////////////////////////////////////////////////////
  if($language=="ar_masculin")
  {
    class Pdf extends Fpdi\TcpdfFpdi
    {
        protected $tplId;
        function Header()
        {
            if (is_null($this->tplId)) {
                $this->setSourceFile('imprimeModels/fiancaille_masculin_ar.pdf');
                $this->tplId = $this->importPage(1);
            }
            $size = $this->useImportedPage($this->tplId,  0, 0, 150);

        }
    }

    // initiate PDF
    ob_start();
    $pdf = new Pdf();
    $pdf->AddPage('P','A5');
    $pdf->SetAutoPageBreak(true, 1);
    // set some language dependent data:
      $lg = Array();
      $lg['a_meta_charset'] = 'UTF-8';
      $lg['a_meta_dir'] = 'rtl';
      $lg['a_meta_language'] = 'fa';
      $lg['w_page'] = 'page';
      $pdf->setLanguageArray($lg);

      if($pdoResult->rowCount()>0)
    {
      $pdf->setRTL(true);
      $pdf->SetFont('helvetica', 'B', 9);
      $pdf->SetXY(36, 25);
      $pdf->Cell(0, 25,$result["numero"] ,'C');

      $pdf->SetFont('helvetica', 'B', 9);
      $pdf->SetXY(36, 31);
      $pdf->Cell(0, 25,$numero_certificat_ar ,'C');

      $pdf->SetXY(76, 63);
      $pdf->Cell(0, 25,$numero_mokadam_ar ,'C');

      $pdf->SetXY(95, 63);
      $pdf->Cell(0, 25,$date_certficat_ar ,'C');

      $pdf->SetFont($fontname,'B',10);
      $pdf->SetXY(12, 63);
      $pdf->Cell(0, 25,$mokadam_cheikh_ar,'C');

      $pdf->SetXY(40, 70.75);
      $pdf->Cell(0, 25,$result["prenom_ar"]." ".$result["nom_ar"] ,'C');

      $pdf->SetXY(40, 75.5);
      $pdf->Cell(0, 25,$result["lieu_naiss_ar"] ,'C');

      $pdf->SetXY(40, 81);
      $pdf->Cell(0, 25,$result["prenom_pere_ar"] ,'C');

     $pdf->SetXY(40, 86.5);
     $pdf->Cell(0, 25,$result["prenom_mere_ar"] ,'C');

     $pdf->SetXY(40, 91.5);
     $pdf->Cell(0, 25,$domicile_ar ,'C');

     $pdf->SetXY(40, 96.75);
     $pdf->Cell(0, 25,$profession_ar ,'C');

     $pdf->SetFont('helvetica', 'B', 10);
     $pdf->SetXY(40, 102);
     $pdf->Cell(0, 25,$result["numero"] ,'C');

     $pdf->SetXY(92, 102);
     $pdf->Cell(0, 25,$result["annee"] ,'C');


     $pdf->SetFont($fontname, 'B', 10);
     $pdf->SetXY(40, 107);
     $pdf->Cell(0, 25,"جماعة زاوية سيدي الطاهر" ,'C');

     if($etat_fammiliale_ar=="celeb")
     {
       $pdf->SetFont($fontname, 'B', 10);
       $pdf->SetXY(40, 113);
       $pdf->Cell(0, 25,"عازب" ,'C');
     }


     if($etat_fammiliale_ar=="marie")
     {
       $pdf->SetFont($fontname, 'B', 10);
       $pdf->SetXY(40, 113);
       $pdf->Cell(0, 25,"عازب" ,'C');
     }

     if($etat_fammiliale_ar=="divorce")
     {
       $pdf->SetFont($fontname, 'B', 10);
       $pdf->SetXY(40, 113);
       $pdf->Cell(0, 25,"مطلق" ,'C');
     }

     if($etat_fammiliale_ar=="veuf")
     {
       $pdf->SetFont($fontname, 'B', 10);
       $pdf->SetXY(40, 113);
       $pdf->Cell(0, 25,"أرمل" ,'C');
     }


$pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetXY(82 , 139);
        $pdf->Cell(0, 25,$ActualDate ,'C');
    }

  }

//Only Frensh/////////////////////////////////////////////////////////////////////
if($language=="fr_masculin")
{
  class Pdf extends Fpdi\TcpdfFpdi
  {
      protected $tplId;
      function Header()
      {
          if (is_null($this->tplId)) {
              $this->setSourceFile('imprimeModels/non_inscription_naissance_fr.pdf');
              $this->tplId = $this->importPage(1);
          }
          $size = $this->useImportedPage($this->tplId,  0, 0, 150);

      }
  }

  // initiate PDF
  ob_start();
  $pdf = new Pdf();
  $pdf->AddPage('P','A5');
  $pdf->SetAutoPageBreak(true, 1);

  if($pdoResult->rowCount()>0)
{
  $pdf->setRTL(false);
  $pdf->SetFont('helvetica', 'B', 9);

  $pdf->SetXY(38, 34);
  $pdf->Cell(0, 25,$result["numero"] ,'C');

  $pdf->SetXY(38, 38.25);
  $pdf->Cell(0, 25,$numero_certificat_fr ,'C');
  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(16, 75.25);
  $pdf->Cell(0, 25,$numero_mokadam_fr ,'C');

  $pdf->SetXY(73, 68);
  $pdf->Cell(0, 25,ucwords($mokadam_cheikh_fr) ,'C');

  $pdf->SetXY(70, 75.25);
  $pdf->Cell(0, 25,$date_certficat_fr ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(49, 91);
  $pdf->Cell(0, 25,ucwords($result["prenom"])." ".ucfirst($result["nom"]) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(49, 96);
  $pdf->Cell(0, 25,$result["date_naiss_miladi"] ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(49, 101.5);
  $pdf->Cell(0, 25,ucwords($result["lieu_naiss"]) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(49, 107);
  $pdf->Cell(0, 25,ucwords($result["prenom_pere"]) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
 $pdf->SetXY(49, 113);
 $pdf->Cell(0, 25,ucwords($result["prenom_mere"]) ,'C');



 $pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(49, 118.5);
$pdf->Cell(0, 25,ucwords($domicile_fr) ,'C');





   $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(67 , 153);
    $pdf->Cell(0, 25,$ActualDate ,'C');

}

}
  //Billingue /////////////////////////////////////////////////////////////////////////////////
// iterate through all pages
if($language =="ar_fr_masculin")
{
  class Pdf extends Fpdi\TcpdfFpdi
  {
      protected $tplId;
  }
  ob_start();
  // initiate PDF
  $pdf = new Pdf();
  $pageCount = $pdf->setSourceFile('imprimeModels\non_inscription_naissance_bilingue.pdf');
  $pdf->SetAutoPageBreak(true, 1);
  for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
      // import a page
      $templateId = $pdf->importPage($pageNo);
  $pdf->setPrintHeader(false);
  $pdf->setPrintFooter(false);
      $pdf->AddPage('P', 'A5');
      // Arabic VERSION**********************************************************************
      if($pageNo==1)
      {
          $pdf->setLanguageArray($lg);
          $size = $pdf->useImportedPage($templateId, 0 , 0, 150);
          if($pdoResult->rowCount()>0)
        {
          $pdf->setRTL(true);
          $pdf->SetFont('helvetica', 'B', 8);
          $pdf->SetXY(32, 42.5);
          $pdf->Cell(0, 25,$result["numero"] ,'C');

          $pdf->SetFont('helvetica', 'B', 9);
          $pdf->SetXY(32, 47);
          $pdf->Cell(0, 25,$numero_certificatB ,'C');



          $pdf->SetXY(17, 82);
          $pdf->Cell(0, 25,$numero_mokadamB ,'C');

          $pdf->SetXY(69, 82);
          $pdf->Cell(0, 25,$date_certficatB ,'C');

          $pdf->SetFont($fontname,'B',10);
          $pdf->SetXY(20, 74);
          $pdf->Cell(0, 25,$mokadam_cheikhB_ar,'C');

          $pdf->SetXY(41, 90);
          $pdf->Cell(0, 25,$result["prenom_ar"]." ".$result["nom_ar"] ,'C');

          $pdf->SetXY(41, 96);
          $pdf->Cell(0, 25,$result["lieu_naiss_ar"] ,'C');

          $pdf->SetXY(41, 102);
          $pdf->Cell(0, 25,$result["date_naiss_miladi_ar"] ,'C');

          $pdf->SetXY(41, 107.5);
          $pdf->Cell(0, 25,$result["prenom_pere_ar"] ,'C');

         $pdf->SetXY(41, 113);
         $pdf->Cell(0, 25,$result["prenom_mere_ar"] ,'C');

         $pdf->SetXY(41, 118);
         $pdf->Cell(0, 25,$domicileB_ar ,'C');

           $pdf->SetFont('helvetica', 'B', 10);
            $pdf->SetXY(78 , 158);
            $pdf->Cell(0, 25,$ActualDate ,'C');
        }


      }
      // FRANCAIS VERSION**********************************************************************
      if($pageNo==2)
      {

        $size = $pdf->useImportedPage($templateId, 0 , 0, 150);
        if($pdoResult->rowCount()>0)
      {
        $pdf->setRTL(false);
        $pdf->SetFont('helvetica', 'B', 9);

        $pdf->SetXY(38, 39);
        $pdf->Cell(0, 25,$result["numero"] ,'C');

        $pdf->SetXY(38, 43);
        $pdf->Cell(0, 25,$numero_certificatB ,'C');
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(16, 80.25);
        $pdf->Cell(0, 25,$numero_mokadamB ,'C');

        $pdf->SetXY(73, 73);
        $pdf->Cell(0, 25,ucwords($mokadam_cheikhB_fr) ,'C');

        $pdf->SetXY(70, 80.25);
        $pdf->Cell(0, 25,$date_certficatB ,'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(49, 96);
        $pdf->Cell(0, 25,ucwords($result["prenom"])." ".ucfirst($result["nom"]) ,'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(49, 101.25);
        $pdf->Cell(0, 25,$result["date_naiss_miladi"] ,'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(49, 106.75);
        $pdf->Cell(0, 25,ucwords($result["lieu_naiss"]) ,'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(49, 112.5 );
        $pdf->Cell(0, 25,ucwords($result["prenom_pere"]) ,'C');

        $pdf->SetFont('helvetica', 'B', 10);
       $pdf->SetXY(49, 118);
       $pdf->Cell(0, 25,ucwords($result["prenom_mere"]) ,'C');



       $pdf->SetFont('helvetica', 'B', 10);
      $pdf->SetXY(49, 123.25);
      $pdf->Cell(0, 25,ucwords($domicileB_fr) ,'C');





         $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(67 , 158);
          $pdf->Cell(0, 25,$ActualDate ,'C');

      }


      }

  }

}


 ob_end_clean();
$pdf->Output();
