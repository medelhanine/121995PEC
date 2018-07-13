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
    $numero = $_SESSION['numero'];
    $annee = $_SESSION['annee'];
    //$superUser = $_SESSION['superUser'];
}
use setasign\Fpdi;

require_once('vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('vendor/setasign/fpdi/src/autoload.php');

class Pdf extends Fpdi\TcpdfFpdi
{

    protected $tplId;

    function Header()
    {
        if (is_null($this->tplId)) {
            $this->setSourceFile('imprimeModels/tasrih_naissance.pdf');
            $this->tplId = $this->importPage(1);
        }
        $size = $this->useImportedPage($this->tplId, 0 , 5, 215);


    }


}

// initiate PDF
ob_start();
$pdf = new Pdf();
$pdf->SetAutoPageBreak(true, 1);


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

	// add a page
$pdf->AddPage('P', 'A4');
//$cin=$_POST["cin"];
date_default_timezone_set('UTC');
$ActualDate = date('d/m/Y');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);
$pdoResult;


$query="SELECT * FROM `tasrih_naiss` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($_SESSION['numero'],$_SESSION['annee']));
	$result=$pdoResult->fetch();

	if($pdoResult->rowCount()>0)
{
//pour les donnees en arabe
$pdf->setRTL(true);


//prenom ar
$fontname = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetFont($fontname, 'B', 11);

$pdf->SetXY(105, 8.5);
$pdf->Cell(0, 25, "تارودانت",'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(105, 21.5);
$pdf->Cell(0, 25, $result["selon_annonceur"],'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(175, 8.5);
$pdf->Cell(0, 25, "جماعة زواية سيدي الطاهر " ,'C');

$pdf->SetFont("helvetica", 'B', 10);
$pdf->SetXY(175, 14.5);
$pdf->Cell(0, 25, $result["numero"] ,'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(175, 21.5);
$pdf->Cell(0, 25, $result["rdv"] ,'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(30, 33);
$pdf->Cell(0, 25, "تارودانت",'C');


$pdf->SetXY(30, 37.75);
$pdf->Cell(0, 25, "تارودانت",'C');

$pdf->SetXY(30, 42.5);
$pdf->Cell(0, 25, "زاوية سيدي الطاهر",'C');

$pdf->SetFont("helvetica", 'B', 10);
$pdf->SetXY(30, 53);
$pdf->Cell(0, 25, $result["numero"],'C');

$pdf->SetFont("helvetica", 'B', 10);
$pdf->SetXY(30, 58);
$pdf->Cell(0, 25, $result["annee"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(28, 64);
$pdf->Cell(0, 25, $result["date_naiss_hijri"],'C');


$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(122, 64);
$pdf->Cell(0, 25, $result["annee_naiss_hijri"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(28, 69);
$pdf->Cell(0, 25, $result["date_naiss_miladi"],'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(122, 69);
$pdf->Cell(0, 25, $result["annee_naiss_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(28, 75);
$pdf->Cell(0, 25, $result["heure"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(128, 75);
$pdf->Cell(0, 25, $result["min"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(28, 80);
$pdf->Cell(0, 25, $result["lieu_naiss"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(40, 85);
$pdf->Cell(0, 25, $result["prenom_naiss"],'C');

$pdf->SetFont("helvetica", 'B', 10);
$pdf->setRTL(false);
$pdf->SetXY(60, 84);
$pdf->Cell(0, 25, ucwords($result["prenom_naiss_fr"]),'C');


$pdf->setRTL(true);

if($result["sex"]=="masculin")
{
  $pdf->SetFont("helvetica", 'B', 10);
  $pdf->SetXY(72.5, 90);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}
else{
  $pdf->SetFont("helvetica", 'B', 10);
  $pdf->SetXY(104.5, 90);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(30, 95.25);
$pdf->Cell(0, 25, $result["nom_pere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(35,100.25);
$pdf->Cell(0, 25, $result["date_naiss_pere_hijri"],'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(123,100.25);
$pdf->Cell(0, 25, $result["annee_naiss_pere_hijri"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(35,105.25);
$pdf->Cell(0, 25, $result["date_naiss_pere_miladi"],'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(123,105.25);
$pdf->Cell(0, 25, $result["annee_naiss_pere_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(35,110.25);
$pdf->Cell(0, 25, $result["lieu_naiss_pere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(35,115.25);
$pdf->Cell(0, 25, $result["niveau_scol_pere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(35,120.25);
$pdf->Cell(0, 25, $result["profession_pere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(35,125.25);
$pdf->Cell(0, 25, $result["nationalite_pere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(49,130.25);
$pdf->Cell(0, 25, $result["nom_naiss"],'C');


$pdf->setRTL(false);
$pdf->SetFont("helvetica", 'B', 9);
$pdf->SetXY(79,129.5);
$pdf->Cell(0, 25, strtoupper($result["nom_naiss_fr"]),'C');


$pdf->setRTL(true);
$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(30,135.5);
$pdf->Cell(0, 25, $result["nom_mere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,140.5);
$pdf->Cell(0, 25, $result["date_naiss_mere_hijri"],'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(123,140.5);
$pdf->Cell(0, 25, $result["annee_naiss_mere_hijri"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,145.5);
$pdf->Cell(0, 25, $result["date_naiss_mere_miladi"],'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(123,145.5);
$pdf->Cell(0, 25, $result["annee_naiss_mere_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,150.5);
$pdf->Cell(0, 25, $result["lieu_naiss_mere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,155.5);
$pdf->Cell(0, 25, $result["niveau_scol_mere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,160.5);
$pdf->Cell(0, 25, $result["profession_mere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,165.5);
$pdf->Cell(0, 25, $result["nationalite_mere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(105,170.5);
$pdf->Cell(0, 25, $result["ordre_naiss"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,175.75);
$pdf->Cell(0, 25, $result["adresse_parent"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,180.75);
$pdf->Cell(0, 25, $result["date_ecrit_hijri"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(123,180.75);
$pdf->Cell(0, 25, $result["annee_ecrit_hijri"],'C');


$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,185.75);
$pdf->Cell(0, 25, $result["date_ecrit_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(123,185.75);
$pdf->Cell(0, 25, $result["annee_ecrit_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,190.75);
$pdf->Cell(0, 25, $result["selon_annonceur"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,195.75);
$pdf->Cell(0, 25, $result["age_annonceur"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,200.75);
$pdf->Cell(0, 25, $result["profession_annonceur"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,205.75);
$pdf->Cell(0, 25, $result["nationalite_annonceur"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,210.75);
$pdf->Cell(0, 25, $result["liason_avec_naiss"],'C');


$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,215.5);
$pdf->Cell(0, 25, $result["adresse_annonceur"],'C');


}

 ob_end_clean();
$pdf->Output();
