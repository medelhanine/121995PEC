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
   $id_user = $_SESSION['id_user'];
    $first_name = $_SESSION['first_name'];
    $first_name_ar = $_SESSION['first_name_ar'];
    $last_name = $_SESSION['last_name'];
    $last_name_ar = $_SESSION['last_name_ar'];
    $username = $_SESSION['username'];
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

$acte_numero_ar= $request["acte_numero_ar"];
$nom_mere_ar= $request["nom_mere_ar"];
$date_naiss_ar= $request["date_naiss_ar"];
$nom_pere_ar= $request["nom_pere_ar"];
$nomme_ar= $request["nomme_ar"];
$lieu_naiss_ar= $request["lieu_naiss_ar"];

$acte_numero_fr= $request["acte_numero_fr"];
$nom_mere_fr= $request["nom_mere_fr"];
$date_naiss_fr= $request["date_naiss_fr"];
$nom_pere_fr= $request["nom_pere_fr"];
$nomme_fr= $request["nomme_fr"];
$lieu_naiss_fr= $request["lieu_naiss_fr"];

$acte_numeroB= $request["acte_numeroB"];
$nom_mereB_ar= $request["nom_mereB_ar"];
$date_naissB_ar= $request["date_naissB_ar"];
$nom_pereB_ar= $request["nom_pereB_ar"];
$nommeB_ar= $request["nommeB_ar"];
$lieu_naissB_ar= $request["lieu_naissB_ar"];

$nom_mereB_fr= $request["nom_mereB_fr"];
$date_naissB_fr= $request["date_naissB_fr"];
$nom_pereB_fr= $request["nom_pereB_fr"];
$nommeB_fr= $request["nommeB_fr"];
$lieu_naissB_fr= $request["lieu_naissB_fr"];


$language= $request["language"];


$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);


// ONLY ARABIC ///////////////////////////////////////////////////////////////////////////////
  if($language=="ar")
  {
    class Pdf extends Fpdi\TcpdfFpdi
    {
        protected $tplId;
        function Header()
        {
            if (is_null($this->tplId)) {
                $this->setSourceFile('imprimeModels/non_inscription_naissance_ar.pdf');
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


      //trace
$pdf->setRTL(false);
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(78, 40);

$query2="SELECT * FROM `users` WHERE `id_user`=?";
	$pdoResult2 = $pdoConnect->prepare($query2);
	$pdoResult2->execute(array($id_user));
	$result2=$pdoResult2->fetch();

    if($pdoResult2->rowCount()>0)
    {
        if($result2["deleguer"] == "false")
    {
    
    $pdf->Cell(0,0,strtoupper(substr($result2["first_name"],0,1).substr($result2["last_name"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();


}else {
    $pdf->setRTL(false);
    $pdf->Cell(0,0,strtoupper(substr($result2["prenom_delegue"],0,1).substr($result2["nom_delegue"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();

}
    }

      $pdf->setRTL(true);
      $pdf->SetFont('helvetica', 'B', 8);
      $pdf->SetXY(32, 42.5);
      $pdf->Cell(0, 25,$acte_numero_ar,'C');

      $pdf->SetFont('helvetica', 'B', 9);
      $pdf->SetXY(32, 47);
      $pdf->Cell(0, 25,$numero_certificat_ar ,'C');



      $pdf->SetXY(17, 82);
      $pdf->Cell(0, 25,$numero_mokadam_ar ,'C');

      $pdf->SetXY(69, 82);
      $pdf->Cell(0, 25,$date_certficat_ar ,'C');

      $pdf->SetFont($fontname,'B',10);
      $pdf->SetXY(20, 74);
      $pdf->Cell(0, 25,$mokadam_cheikh_ar,'C');

      $pdf->SetXY(41, 90);
      $pdf->Cell(0, 25,$nomme_ar ,'C');

      $pdf->SetXY(41, 96);
      $pdf->Cell(0, 25,$lieu_naiss_ar ,'C');

      $pdf->SetXY(41, 102);
      $pdf->Cell(0, 25,$date_naiss_ar ,'C');


      $pdf->SetXY(41, 107.5);
      $pdf->Cell(0, 25,$nom_pere_ar ,'C');


     $pdf->SetXY(41, 113);
     $pdf->Cell(0, 25,$nom_mere_ar ,'C');



     $pdf->SetXY(41, 118.5);
     $pdf->Cell(0, 25,$domicile_ar ,'C');


       $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(78 , 158);
        $pdf->Cell(0, 25,$ActualDate ,'C');

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


  //trace
$pdf->setRTL(false);
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(98, 38);

$query2="SELECT * FROM `users` WHERE `id_user`=?";
	$pdoResult2 = $pdoConnect->prepare($query2);
	$pdoResult2->execute(array($id_user));
	$result2=$pdoResult2->fetch();

    if($pdoResult2->rowCount()>0)
    {
        if($result2["deleguer"] == "false")
    {
    
    $pdf->Cell(0,0,strtoupper(substr($result2["first_name"],0,1).substr($result2["last_name"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();


}else {
    $pdf->setRTL(false);
    $pdf->Cell(0,0,strtoupper(substr($result2["prenom_delegue"],0,1).substr($result2["nom_delegue"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();

}
    }

  $pdf->setRTL(false);
  $pdf->SetFont('helvetica', 'B', 9);

  $pdf->SetXY(38, 34);
  $pdf->Cell(0, 25,$acte_numero_fr,'C');

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
  $pdf->Cell(0, 25,ucwords($nomme_fr) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(49, 96);
  $pdf->Cell(0, 25,ucwords($date_naiss_fr) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(49, 101.5);
  $pdf->Cell(0, 25,ucwords($lieu_naiss_fr) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(49, 107);
  $pdf->Cell(0, 25,ucwords($nom_pere_fr) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
 $pdf->SetXY(49, 113);
 $pdf->Cell(0, 25,ucwords($nom_mere_fr ),'C');



 $pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(49, 118.5);
$pdf->Cell(0, 25,ucwords($domicile_fr) ,'C');


   $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(67 , 153);
    $pdf->Cell(0, 25,$ActualDate ,'C');


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
          //trace
$pdf->setRTL(false);
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(98, 43);

$query2="SELECT * FROM `users` WHERE `id_user`=?";
	$pdoResult2 = $pdoConnect->prepare($query2);
	$pdoResult2->execute(array($id_user));
	$result2=$pdoResult2->fetch();

    if($pdoResult2->rowCount()>0)
    {
        if($result2["deleguer"] == "false")
    {
    
    $pdf->Cell(0,0,strtoupper(substr($result2["first_name"],0,1).substr($result2["last_name"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();


}else {
    $pdf->setRTL(false);
    $pdf->Cell(0,0,strtoupper(substr($result2["prenom_delegue"],0,1).substr($result2["nom_delegue"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();

}
    }
          $pdf->setLanguageArray($lg);
          $size = $pdf->useImportedPage($templateId, 0 , 0, 150);

          $pdf->setRTL(true);
          $pdf->SetFont('helvetica', 'B', 8);
          $pdf->SetXY(32, 42.5);
          $pdf->Cell(0, 25,$acte_numeroB ,'C');

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
          $pdf->Cell(0, 25,$nommeB_ar ,'C');

          $pdf->SetXY(41, 96);
          $pdf->Cell(0, 25,$lieu_naissB_ar,'C');

          $pdf->SetXY(41, 102);
          $pdf->Cell(0, 25,$date_naissB_ar ,'C');

          $pdf->SetXY(41, 107.5);
          $pdf->Cell(0, 25,$nom_pereB_ar ,'C');

         $pdf->SetXY(41, 113);
         $pdf->Cell(0, 25,$nom_mereB_ar ,'C');

         $pdf->SetXY(41, 118);
         $pdf->Cell(0, 25,$domicileB_ar ,'C');

           $pdf->SetFont('helvetica', 'B', 10);
            $pdf->SetXY(78 , 158);
            $pdf->Cell(0, 25,$ActualDate ,'C');



      }
      // FRANCAIS VERSION**********************************************************************
      if($pageNo==2)
      {

        $size = $pdf->useImportedPage($templateId, 0 , 0, 150);

        //trace
$pdf->setRTL(false);
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(98, 43);

$query2="SELECT * FROM `users` WHERE `id_user`=?";
	$pdoResult2 = $pdoConnect->prepare($query2);
	$pdoResult2->execute(array($id_user));
	$result2=$pdoResult2->fetch();

    if($pdoResult2->rowCount()>0)
    {
        if($result2["deleguer"] == "false")
    {
    
    $pdf->Cell(0,0,strtoupper(substr($result2["first_name"],0,1).substr($result2["last_name"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();


}else {
    $pdf->setRTL(false);
    $pdf->Cell(0,0,strtoupper(substr($result2["prenom_delegue"],0,1).substr($result2["nom_delegue"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();

}
    }

        $pdf->setRTL(false);
        $pdf->SetFont('helvetica', 'B', 9);

        $pdf->SetXY(38, 39);
        $pdf->Cell(0, 25,$acte_numeroB ,'C');

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
        $pdf->Cell(0, 25,ucwords($nommeB_fr) ,'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(49, 101.25);
        $pdf->Cell(0, 25,ucwords($date_naissB_fr),'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(49, 106.75);
        $pdf->Cell(0, 25,ucwords($lieu_naissB_fr),'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(49, 112.5 );
        $pdf->Cell(0, 25,ucwords($nom_pereB_fr) ,'C');

        $pdf->SetFont('helvetica', 'B', 10);
       $pdf->SetXY(49, 118);
       $pdf->Cell(0, 25,ucwords($nom_mereB_fr) ,'C');



       $pdf->SetFont('helvetica', 'B', 10);
      $pdf->SetXY(49, 123.25);
      $pdf->Cell(0, 25,ucwords($domicileB_fr) ,'C');





         $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(67 , 158);
          $pdf->Cell(0, 25,$ActualDate ,'C');




      }

  }

}


 ob_end_clean();
$pdf->Output();
