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

$numero= $_GET["numero"];
$annee= $_GET["annee"];

$prenom_ar= $_GET["prenom_ar"];
$prenom= $_GET["prenom"];
$nom_ar= $_GET["nom_ar"];
$nom= $_GET["nom"];
$date_naiss_hijri_ar= $_GET["date_naiss_hijri_ar"];
$date_naiss_miladi_ar= $_GET["date_naiss_miladi_ar"];

$date_naiss_hijri_fr= $_GET["date_naiss_hijri_fr"];
$date_naiss_miladi_fr= $_GET["date_naiss_miladi_fr"];
$lieu_naiss_ar= $_GET["lieu_naiss_ar"];
$lieu_naiss= $_GET["lieu_naiss"];
$nom_pere_ar= $_GET["nom_pere_ar"];
$nom_pere= $_GET["nom_pere"];

$nom_mere_ar= $_GET["nom_mere_ar"];
$nom_mere= $_GET["nom_mere"];
$domicile_ar= $_GET["domicile_ar"];
$domicile= $_GET["domicile"];
$mention_marge_ar= $_GET["mention_marge_ar"];
$mention_marge= $_GET["mention_marge"];
$language= $_GET["language"];
//if bulletin exists update it if not insert one

$query="SELECT 'numero',`annee` FROM `bulletin_individu` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
	$result=$pdoResult->fetch();
if($pdoResult->rowCount()>0)
{
  $query="UPDATE `bulletin_individu` SET `prenom_ar`=?,`prenom`=?,`nom_ar`=?,`nom`=?,
  `date_naiss_hijri_ar`=?,`date_naiss_miladi_ar`=?,`date_naiss_hijri_fr`=?,`date_naiss_miladi_fr`=?,
  `lieu_naiss_ar`=?,`lieu_naiss`=?,`nom_pere_ar`=?,`nom_pere`=?,`nom_mere_ar`=?,`nom_mere`=?,`domicile_ar`=?,
  `domicile`=?,`mention_marge_ar`=?,`mention_marge`=? WHERE `numero`=? AND `annee`=?";
  	$pdoResult = $pdoConnect->prepare($query);
  	$pdoResult->execute(array($prenom_ar,$prenom,$nom_ar,$nom,$date_naiss_hijri_ar,$date_naiss_miladi_ar
    ,$date_naiss_hijri_fr,$date_naiss_miladi_fr,$lieu_naiss_ar,$lieu_naiss,$nom_pere_ar
    ,$nom_pere,$nom_mere_ar,$nom_mere,$domicile_ar,$domicile
    ,$mention_marge_ar,$mention_marge,$numero,$annee));

}else {//if this bulletin not exist yet insert it

      $query = "INSERT INTO `bulletin_individu`(`numero`, `annee`, `prenom_ar`, `prenom`, `nom_ar`, `nom`, `date_naiss_hijri_ar`,
       `date_naiss_miladi_ar`, `date_naiss_hijri_fr`, `date_naiss_miladi_fr`, `lieu_naiss_ar`, `lieu_naiss`,
        `nom_pere_ar`, `nom_pere`, `nom_mere_ar`, `nom_mere`, `domicile_ar`,
         `domicile`, `mention_marge_ar`, `mention_marge`)
    VALUES(
    :numero,
    :annee,
    :prenom_ar,
    :prenom,
    :nom_ar,
    :nom,
    :date_naiss_hijri_ar,
    :date_naiss_miladi_ar,
    :date_naiss_hijri_fr,
    :date_naiss_miladi_fr,
    :lieu_naiss_ar,
    :lieu_naiss,
    :nom_pere_ar,
    :nom_pere,
    :nom_mere_ar,
    :nom_mere,
    :domicile_ar,
    :domicile,
    :mention_marge_ar,
    :mention_marge
    )";


    $pdoResult = $pdoConnect->prepare($query);
    $pdoExec = $pdoResult->execute(array(
                      ":numero"=>$numero,
                       ":annee"=>$annee,
                       ":prenom_ar"=>$prenom_ar,
                       ":prenom"=>$prenom,
                       ":nom_ar"=>$nom_ar,
                       ":nom"=>$nom,
                       ":date_naiss_hijri_ar"=>$date_naiss_hijri_ar,
                       ":date_naiss_miladi_ar"=>$date_naiss_miladi_ar,
                       ":date_naiss_hijri_fr"=>$date_naiss_hijri_fr,
                       ":date_naiss_miladi_fr"=>$date_naiss_miladi_fr,
                       ":lieu_naiss_ar"=>$lieu_naiss_ar,
                       ":lieu_naiss"=>$lieu_naiss,
                       ":nom_pere_ar"=>$nom_pere_ar,
                       ":nom_pere"=>$nom_pere,
                       ":nom_mere_ar"=>$nom_mere_ar,
                       ":nom_mere"=>$nom_mere,
                       ":domicile_ar"=>$domicile_ar,
                       ":domicile"=>$domicile,
                       ":mention_marge_ar"=>$mention_marge_ar,
                       ":mention_marge"=>$mention_marge
                    ));
}


$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);
//$fontname = "aealarabiya";
$query="SELECT * FROM `bulletin_individu` WHERE `numero`=? AND `annee`=?";
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
                $this->setSourceFile('imprimeModels/bulletin_individu_ar.pdf');
                $this->tplId = $this->importPage(1);
            }
            $size = $this->useImportedPage($this->tplId,  0, 0, 215);

        }
    }

    // initiate PDF
    ob_start();
    $pdf = new Pdf();
    $pdf->AddPage('L','A5');
    $pdf->SetAutoPageBreak(true, 1);
    // set some language dependent data:
      $lg = Array();
      $lg['a_meta_charset'] = 'UTF-8';
      $lg['a_meta_dir'] = 'rtl';
      $lg['a_meta_language'] = 'fa';
      $lg['w_page'] = 'page';
      $pdf->setLanguageArray($lg);

      $pdf->setRTL(false);
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(140, 130);

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
      $pdf->SetFont($fontname, 'B', 10);
      $pdf->SetXY(26, 33);
      $pdf->Cell(0, 25,$prenom_ar ,'C');



      $pdf->SetFont($fontname, 'B', 10);
      $pdf->SetXY(26, 38);
      $pdf->Cell(0, 25,$nom_ar ,'C');

      $pdf->SetXY(26, 43.25);
      $pdf->Cell(0, 25,$date_naiss_hijri_ar ,'C');

      $pdf->SetXY(26, 48.5);
      $pdf->Cell(0, 25,$date_naiss_miladi_ar ,'C');

      $pdf->SetXY(26, 53.75);
      $pdf->Cell(0, 25,$lieu_naiss_ar ,'C');

      $pdf->SetXY(26, 59);
      $pdf->Cell(0, 25,$nom_pere_ar ,'C');

      $pdf->SetXY(26, 64.25);
      $pdf->Cell(0, 25,$nom_mere_ar ,'C');

      $pdf->SetXY(26, 69.5);
      $pdf->Cell(0, 25,$domicile_ar ,'C');

      $pdf->SetXY(26, 74.75);
      $pdf->Cell(0, 25,$mention_marge_ar,'C');

      $pdf->SetFont('helvetica','B',10);
      $pdf->SetXY(24, 97);
      $pdf->Cell(0, 25,$numero,'C');

      $pdf->SetFont('helvetica','B',10);
      $pdf->SetXY(63, 97);
      $pdf->Cell(0, 25,$annee,'C');

      $pdf->SetFont($fontname,'B',10);
      $pdf->SetXY(109, 86.25);
      $pdf->Cell(0, 25,$prenom_ar." ".$nom_ar,'C');

      $pdf->SetFont($fontname,'B',10);
      $pdf->SetXY(115, 91.5);
      $pdf->Cell(0, 25,$domicile_ar,'C');


      $pdf->SetFont("helvetica",'B',9);
      $pdf->SetXY(15, 107.5);
      $pdf->Cell(0, 25,$ActualDate,'C');

      $pdf->setRTL(false);
      $pdf->SetFont("helvetica", 'B', 9);
      $pdf->SetXY(21, 33);
      $pdf->Cell(0, 25,ucwords($prenom) ,'C');

      $pdf->SetFont("helvetica", 'B', 9);
      $pdf->SetXY(21, 38);
      $pdf->Cell(0, 25,ucwords($nom) ,'C');
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
              $this->setSourceFile('imprimeModels/bulletin_individu_fr.pdf');
              $this->tplId = $this->importPage(1);
          }
          $size = $this->useImportedPage($this->tplId,  0 , 0, 215);

      }
  }

  // initiate PDF
  ob_start();
  $pdf = new Pdf();
  $pdf->AddPage('L','A5');
  $pdf->SetAutoPageBreak(true, 1);

  if($pdoResult->rowCount()>0)
{
  $pdf->setRTL(false);
  $pdf->SetFont('helvetica', 'B', 9.5);

  $pdf->SetXY(59, 28);
  $pdf->Cell(0, 25,ucwords($prenom) ,'C');

  $pdf->SetXY(59, 33);
  $pdf->Cell(0, 25,ucwords($nom) ,'C');

  $pdf->SetXY(59, 38);
  $pdf->Cell(0, 25,ucwords($date_naiss_hijri_fr) ,'C');

  $pdf->SetXY(59, 43);
  $pdf->Cell(0, 25,ucwords($date_naiss_miladi_fr) ,'C');

  $pdf->SetXY(59, 48);
  $pdf->Cell(0, 25,ucwords($lieu_naiss) ,'C');

  $pdf->SetXY(59, 53.25);
  $pdf->Cell(0, 25,ucwords($nom_pere) ,'C');

  $pdf->SetXY(139, 53.25);
  $pdf->Cell(0, 25,ucwords($nom_mere) ,'C');

  $pdf->SetXY(59, 58.25);
  $pdf->Cell(0, 25,ucwords($domicile) ,'C');

  $pdf->SetXY(59, 63.25);
  $pdf->Cell(0, 25,ucwords($mention_marge) ,'C');

  $pdf->SetXY(130, 74.25);
  $pdf->Cell(0, 25,ucwords($prenom." ".$nom) ,'C');

  $pdf->SetXY(130, 78.25);
  $pdf->Cell(0, 25,ucwords($domicile) ,'C');

  $pdf->SetFont('helvetica','B',9);
  $pdf->SetXY(51, 94.25);
  $pdf->Cell(0, 25,$numero ,'C');


  $pdf->SetXY(71, 94.25);
  $pdf->Cell(0, 25,$annee ,'C');

  $pdf->SetXY(50, 107);
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
  $pageCount = $pdf->setSourceFile('imprimeModels\bulletin_individu_bilingue.pdf');
  $pdf->SetAutoPageBreak(true, 1);
  for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
      // import a page
      $templateId = $pdf->importPage($pageNo);
  $pdf->setPrintHeader(false);
  $pdf->setPrintFooter(false);
      $pdf->AddPage('L', 'A5');
      // Arabic VERSION**********************************************************************
      if($pageNo==1)
      {
          $pdf->setLanguageArray($lg);
          $size = $pdf->useImportedPage($templateId, 0 , 0, 215);

          $pdf->setRTL(true);
          $pdf->SetFont($fontname, 'B', 10);
          $pdf->SetXY(26, 33);
          $pdf->Cell(0, 25,$prenom_ar ,'C');



          $pdf->SetFont($fontname, 'B', 10);
          $pdf->SetXY(26, 38);
          $pdf->Cell(0, 25,$nom_ar ,'C');

          $pdf->SetXY(26, 43.25);
          $pdf->Cell(0, 25,$date_naiss_hijri_ar ,'C');

          $pdf->SetXY(26, 48.5);
          $pdf->Cell(0, 25,$date_naiss_miladi_ar ,'C');

          $pdf->SetXY(26, 53.75);
          $pdf->Cell(0, 25,$lieu_naiss_ar ,'C');

          $pdf->SetXY(26, 59);
          $pdf->Cell(0, 25,$nom_pere_ar ,'C');

          $pdf->SetXY(26, 64.25);
          $pdf->Cell(0, 25,$nom_mere_ar ,'C');

          $pdf->SetXY(26, 69.5);
          $pdf->Cell(0, 25,$domicile_ar ,'C');

          $pdf->SetXY(26, 74.75);
          $pdf->Cell(0, 25,$mention_marge_ar,'C');

          $pdf->SetFont('helvetica','B',10);
          $pdf->SetXY(24, 97);
          $pdf->Cell(0, 25,$numero,'C');

          $pdf->SetFont('helvetica','B',10);
          $pdf->SetXY(63, 97);
          $pdf->Cell(0, 25,$annee,'C');

          $pdf->SetFont($fontname,'B',10);
          $pdf->SetXY(109, 86.25);
          $pdf->Cell(0, 25,$prenom_ar." ".$nom_ar,'C');

          $pdf->SetFont($fontname,'B',10);
          $pdf->SetXY(115, 91.5);
          $pdf->Cell(0, 25,$domicile_ar,'C');


          $pdf->SetFont("helvetica",'B',9);
          $pdf->SetXY(15, 107.5);
          $pdf->Cell(0, 25,$ActualDate,'C');

          $pdf->setRTL(false);
          $pdf->SetFont("helvetica", 'B', 9);
          $pdf->SetXY(21, 33);
          $pdf->Cell(0, 25,ucwords($prenom) ,'C');

          $pdf->SetFont("helvetica", 'B', 9);
          $pdf->SetXY(21, 38);
          $pdf->Cell(0, 25,ucwords($nom) ,'C');

      }
      // FRANCAIS VERSION**********************************************************************
      if($pageNo==2)
      {
        $size = $pdf->useImportedPage($templateId, 0 , 0, 215);
        $pdf->setRTL(false);
        $pdf->SetFont('helvetica', 'B', 9.5);

        $pdf->SetXY(59, 28);
        $pdf->Cell(0, 25,ucwords($prenom) ,'C');

        $pdf->SetXY(59, 33);
        $pdf->Cell(0, 25,ucwords($nom) ,'C');

        $pdf->SetXY(59, 38);
        $pdf->Cell(0, 25,ucwords($date_naiss_hijri_fr) ,'C');

        $pdf->SetXY(59, 43);
        $pdf->Cell(0, 25,ucwords($date_naiss_miladi_fr) ,'C');

        $pdf->SetXY(59, 48);
        $pdf->Cell(0, 25,ucwords($lieu_naiss) ,'C');

        $pdf->SetXY(59, 53.25);
        $pdf->Cell(0, 25,ucwords($nom_pere) ,'C');

        $pdf->SetXY(139, 53.25);
        $pdf->Cell(0, 25,ucwords($nom_mere) ,'C');

        $pdf->SetXY(59, 58.25);
        $pdf->Cell(0, 25,ucwords($domicile) ,'C');

        $pdf->SetXY(59, 63.25);
        $pdf->Cell(0, 25,ucwords($mention_marge) ,'C');

        $pdf->SetXY(130, 74.25);
        $pdf->Cell(0, 25,ucwords($prenom." ".$nom) ,'C');

        $pdf->SetXY(130, 78.25);
        $pdf->Cell(0, 25,ucwords($domicile) ,'C');

        $pdf->SetFont('helvetica','B',9);
        $pdf->SetXY(51, 94.25);
        $pdf->Cell(0, 25,$numero ,'C');


        $pdf->SetXY(71, 94.25);
        $pdf->Cell(0, 25,$annee ,'C');

        $pdf->SetXY(50, 107);
        $pdf->Cell(0, 25,$ActualDate ,'C');

      }
  }

}


 ob_end_clean();
$pdf->Output();
