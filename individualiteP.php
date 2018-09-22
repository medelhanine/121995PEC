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


$domicile_ar= $request["domicile_ar"];
$domicile= $request["domicile"];
$mokadam_cheikh_ar= $request["mokadam_cheikh_ar"];
$mokadam_cheikh= $request["mokadam_cheikh"];
$date_certficat= $request["date_certficat"];
$numero_mokadam= $request["numero_mokadam"];
$numero_certificat= $request["numero_certificat"];
$nom_prenom= $request["nom_prenom"];
$nom_prenom_ar= $request["nom_prenom_ar"];

$query = "INSERT INTO `timep_stamp_table`( `type`) VALUES ('individualite')";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute();


$language= $request["language"];
$fontname = "aefurat";
$query="SELECT * FROM `exbirth` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
	$result=$pdoResult->fetch();

// ONLY ARABIC ///////////////////////////////////////////////////////////////////////////////
  if($language=="ar")
  {
    class Pdf extends Fpdi\TcpdfFpdi
    {
        protected $tplId;
        function Header()
        {
            if (is_null($this->tplId)) {
                $this->setSourceFile('imprimeModels/monogamie_ar.pdf');
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
      $pdf->SetFont('helvetica', 'B', 10);
      $pdf->SetXY(34, 47);
      $pdf->Cell(0, 25,$result["numero"] ,'C');

      $pdf->SetFont('helvetica', 'B', 10);
      $pdf->SetXY(34, 52);
      $pdf->Cell(0, 25,$numero_certificat_ar ,'C');



      $pdf->SetXY(17, 90);
      $pdf->Cell(0, 25,$numero_mokadam_ar ,'C');

      $pdf->SetXY(65, 90);
      $pdf->Cell(0, 25,$date_certficat_ar ,'C');

      $pdf->SetFont($fontname,'B',10);
      $pdf->SetXY(20, 82);
      $pdf->Cell(0, 25,$mokadam_cheikh_ar,'C');

      $pdf->SetXY(42, 97.75);
      $pdf->Cell(0, 25,$result["prenom_ar"]." ".$result["nom_ar"] ,'C');

      $pdf->SetXY(42, 103.25);
      $pdf->Cell(0, 25,$result["lieu_naiss_ar"] ,'C');

      $pdf->SetXY(42, 109);
      $pdf->Cell(0, 25,$result["date_naiss_miladi_ar"] ,'C');


      $pdf->SetXY(42, 115);
      $pdf->Cell(0, 25,$result["prenom_pere_ar"] ,'C');


     $pdf->SetXY(42, 121);
     $pdf->Cell(0, 25,$result["prenom_mere_ar"] ,'C');



     $pdf->SetXY(42, 126);
     $pdf->Cell(0, 25,$domicile_ar ,'C');


     $pdf->SetFont('helvetica','B',9);
     $pdf->SetXY(64, 132);
     $pdf->Cell(0, 25,$cine_ar ,'C');

       $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetXY(78 , 164);
        $pdf->Cell(0, 25,$ActualDate ,'C');
    }




  }

//Only Frensh/////////////////////////////////////////////////////////////////////
if($language=="fr")
{
  class Pdf extends Fpdi\TcpdfFpdi
  {
      protected $tplId;
      function Header()
      {
          if (is_null($this->tplId)) {
              $this->setSourceFile('imprimeModels/monogamie_fr.pdf');
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
  $pdf->SetFont('helvetica', 'B', 10);


  //commune and date


  $pdf->SetXY(38, 39);
  $pdf->Cell(0, 25,$result["numero"] ,'C');

  $pdf->SetXY(38, 43.5);
  $pdf->Cell(0, 25,$numero_certificat_fr ,'C');
  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(16, 73.5);
  $pdf->Cell(0, 25,$numero_mokadam_fr ,'C');

  $pdf->SetXY(73, 66);
  $pdf->Cell(0, 25,ucwords($mokadam_cheikh_fr) ,'C');

  $pdf->SetXY(66, 73.5);
  $pdf->Cell(0, 25,$date_certficat_fr ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(47, 89);
  $pdf->Cell(0, 25,ucwords($result["prenom"])." ".ucfirst($result["nom"]) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(47, 94);
  $pdf->Cell(0, 25,$result["date_naiss_miladi"] ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(47, 98.5);
  $pdf->Cell(0, 25,ucwords($result["lieu_naiss"]) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(47, 104);
  $pdf->Cell(0, 25,ucwords($result["prenom_pere"]) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
 $pdf->SetXY(47, 108);
 $pdf->Cell(0, 25,ucwords($result["prenom_mere"]) ,'C');



 $pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(47, 113);
$pdf->Cell(0, 25,ucwords($domicile_fr) ,'C');

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(67, 118);
$pdf->Cell(0, 25,ucwords($cine_fr) ,'C');

   $pdf->SetFont('helvetica', 'B', 9);
    $pdf->SetXY(67 , 150.5);
    $pdf->Cell(0, 25,$ActualDate ,'C');

}

}
  //Billingue /////////////////////////////////////////////////////////////////////////////////
// iterate through all pages
if($language =="ar_fr")
{
  class Pdf extends Fpdi\TcpdfFpdi
  {
      protected $tplId;
  }
  ob_start();
  // initiate PDF
  $pdf = new Pdf();
  $pageCount = $pdf->setSourceFile('imprimeModels\monogamie_bilingue.pdf');
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
          $pdf->setRTL(false);
          $pdf->SetFont('helvetica', 'B', 10);


          //commune and date


          $pdf->SetXY(38, 39);
          $pdf->Cell(0, 25,$result["numero"] ,'C');

          $pdf->SetXY(38, 43.5);
          $pdf->Cell(0, 25,$numero_certificatB ,'C');
          $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(16, 73.5);
          $pdf->Cell(0, 25,$numero_mokadamB ,'C');

          $pdf->SetXY(73, 66);
          $pdf->Cell(0, 25,ucwords($mokadam_cheikhB_fr) ,'C');

          $pdf->SetXY(66, 73.5);
          $pdf->Cell(0, 25,$date_certficatB ,'C');

          $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(47, 89);
          $pdf->Cell(0, 25,ucwords($result["prenom"])." ".ucfirst($result["nom"]) ,'C');

          $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(47, 94);
          $pdf->Cell(0, 25,$result["date_naiss_miladi"] ,'C');

          $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(47, 98.5);
          $pdf->Cell(0, 25,ucwords($result["lieu_naiss"]) ,'C');

          $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(47, 104);
          $pdf->Cell(0, 25,ucwords($result["prenom_pere"]) ,'C');

          $pdf->SetFont('helvetica', 'B', 10);
         $pdf->SetXY(47, 108);
         $pdf->Cell(0, 25,ucwords($result["prenom_mere"]) ,'C');



         $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(47, 113);
        $pdf->Cell(0, 25,ucwords($domicileB_fr) ,'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(67, 118);
        $pdf->Cell(0, 25,ucwords($cineB) ,'C');

           $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetXY(67 , 150.5);
            $pdf->Cell(0, 25,$ActualDate ,'C');

        }


      }
      // FRANCAIS VERSION**********************************************************************
      if($pageNo==2)
      {

        $size = $pdf->useImportedPage($templateId, 0 , 0, 150);
        if($pdoResult->rowCount()>0)
      {
        $pdf->setRTL(true);
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(34, 47);
        $pdf->Cell(0, 25,$result["numero"] ,'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(34, 52);
        $pdf->Cell(0, 25,$numero_certificatB ,'C');

        $pdf->SetXY(17, 90);
        $pdf->Cell(0, 25,$numero_mokadamB ,'C');

        $pdf->SetXY(65, 90);
        $pdf->Cell(0, 25,$date_certficatB ,'C');

        $pdf->SetFont($fontname,'B',10);
        $pdf->SetXY(20, 82);
        $pdf->Cell(0, 25,$mokadam_cheikhB_ar,'C');

        $pdf->SetXY(42, 97.75);
        $pdf->Cell(0, 25,$result["prenom_ar"]." ".$result["nom_ar"] ,'C');

        $pdf->SetXY(42, 103.25);
        $pdf->Cell(0, 25,$result["lieu_naiss_ar"] ,'C');

        $pdf->SetXY(42, 109);
        $pdf->Cell(0, 25,$result["date_naiss_miladi_ar"] ,'C');

        $pdf->SetXY(42, 115);
        $pdf->Cell(0, 25,$result["prenom_pere_ar"] ,'C');

       $pdf->SetXY(42, 121);
       $pdf->Cell(0, 25,$result["prenom_mere_ar"] ,'C');

       $pdf->SetXY(42, 126);
       $pdf->Cell(0, 25,$domicileB_ar ,'C');

       $pdf->SetFont('helvetica','B',9);
       $pdf->SetXY(64, 132);
       $pdf->Cell(0, 25,$cineB ,'C');

         $pdf->SetFont('helvetica', 'B', 9);
          $pdf->SetXY(78 , 164);
          $pdf->Cell(0, 25,$ActualDate ,'C');
      }

      }
  }

}
 ob_end_clean();
$pdf->Output();
