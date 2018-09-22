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
            $this->setSourceFile('imprimeModels/tasrih_deces.pdf');
            $this->tplId = $this->importPage(1);
        }
        $size = $this->useImportedPage($this->tplId, -2 , 5, 215);
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

$numero= $request["numero"];
$annee= $request["annee"];

$query="SELECT * FROM `tasrih_deces` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
	$result=$pdoResult->fetch();

	if($pdoResult->rowCount()>0)
{
//pour les donnees en arabe
$pdf->setRTL(true);


//prenom ar
$fontname = "aefurat";

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(89, 6.25);
$pdf->Cell(0, 25, "تارودانت",'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(89, 23.5);
$pdf->Cell(0, 25, $result["selon_annonceur"],'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(173, 6);
$pdf->Cell(0, 25, "جماعة زواية سيدي الطاهر " ,'C');

$pdf->SetFont("helvetica", 'B', 10);
$pdf->SetXY(173, 14.25);
$pdf->Cell(0, 25, $result["numero"] ,'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(173, 23.25);
$pdf->Cell(0, 25, $result["rdv"] ,'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(30, 38);
$pdf->Cell(0, 25, "تارودانت",'C');


$pdf->SetXY(30, 43.75);
$pdf->Cell(0, 25, "تارودانت",'C');

$pdf->SetXY(30, 48);
$pdf->Cell(0, 25, "زاوية سيدي الطاهر",'C');

$pdf->SetXY(30, 53);
$pdf->Cell(0, 25, "زاوية سيدي الطاهر",'C');

$pdf->SetFont("helvetica", 'B', 10);
$pdf->SetXY(30, 58.25);
$pdf->Cell(0, 25, $result["numero"],'C');

$pdf->SetFont("helvetica", 'B', 10);
$pdf->SetXY(30, 63.25);
$pdf->Cell(0, 25, $result["annee"],'C');


$pdf->setRTL(true);

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,69.25);
$pdf->Cell(0, 25, $result["date_deces_hijri"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(111,69.25);
$pdf->Cell(0, 25, $result["annee_deces_hijri"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(28,74.25);
$pdf->Cell(0, 25, $result["date_deces_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(111,74.25);
$pdf->Cell(0, 25, $result["annee_deces_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(28,79.25);
$pdf->Cell(0, 25, $result["heure"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(117,79.25);
$pdf->Cell(0, 25, $result["min"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(28,84.25);
$pdf->Cell(0, 25, $result["lieu_deces"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(42,89.25);
$pdf->Cell(0, 25, $result["prenom_deces"]." ".$result["nom_deces"],'C');

$pdf->setRTL(flase);
$pdf->SetFont("helvetica", 'B', 9);
$pdf->SetXY(92,89);
$pdf->Cell(0, 25, strtoupper($result["prenom_deces_fr"]." ".$result["nom_deces_fr"]),'C');

$pdf->setRTL(flase);

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(28,99.25);
$pdf->Cell(0, 25, $result["nationalite"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(28,104.25);
$pdf->Cell(0, 25, $result["adresse_deces"],'C');





if($result["sex"]=="masculin")
{
  $pdf->SetFont("helvetica", 'B', 10);
  $pdf->SetXY(50.5,94.5);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}
else{
  $pdf->SetFont("helvetica", 'B', 10);
  $pdf->SetXY(97.5, 94.5);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,109.25);
$pdf->Cell(0, 25, $result["date_naiss_hijri"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(111,109.25);
$pdf->Cell(0, 25, $result["annee_naiss_hijri"],'C');


$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,114.25);
$pdf->Cell(0, 25, $result["date_naiss_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(111,114.25);
$pdf->Cell(0, 25, $result["annee_naiss_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(30,118.5);
$pdf->Cell(0, 25, $result["lieu_naiss"],'C');


if($result["etat_familiale"]=="marie")
{
  $pdf->SetFont($fontname, 'B', 11);
  $pdf->SetXY(38,123.5);
  $pdf->Cell(0, 25, " متزوج (ة) ",'C');
}

if($result["etat_familiale"]=="celeb")
{
  $pdf->SetFont($fontname, 'B', 11);
  $pdf->SetXY(38,123.5);
  $pdf->Cell(0, 25, "عازب (ة) ",'C');
}

if($result["etat_familiale"]=="divorce")
{
  $pdf->SetFont($fontname, 'B', 11);
  $pdf->SetXY(38,123.5);
  $pdf->Cell(0, 25, "مطلق(ة) ",'C');
}


if($result["etat_familiale"]=="veuf")
{
  $pdf->SetFont($fontname, 'B', 11);
  $pdf->SetXY(38,123.5);
  $pdf->Cell(0, 25, "أرمل (ة) ",'C');
}


$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(38,128.75);
$pdf->Cell(0, 25, $result["niveau_scolaire"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(28,133.75);
$pdf->Cell(0, 25, $result["profession"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(27,138.75);
$pdf->Cell(0, 25, $result["nom_pere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(36,143.75);
$pdf->Cell(0, 25, $result["date_naiss_pere_hijri"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(111,143.75);
$pdf->Cell(0, 25, $result["annee_naiss_pere_hijri"],'C');


$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(36,148.75);
$pdf->Cell(0, 25, $result["date_naiss_pere_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(111,148.75);
$pdf->Cell(0, 25, $result["annee_naiss_pere_miladi"],'C');


$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(26,153.75);
$pdf->Cell(0, 25, $result["adresse_pere"],'C');


$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(26,158.75);
$pdf->Cell(0, 25, $result["profession_pere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(26,163.75);
$pdf->Cell(0, 25, $result["nationalite_pere"],'C');


$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(26,168.75);
$pdf->Cell(0, 25, $result["nom_mere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(34,173.75);
$pdf->Cell(0, 25, $result["date_naiss_mere_hijri"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(111,173.75);
$pdf->Cell(0, 25, $result["annee_naiss_mere_hijri"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(34,178.75);
$pdf->Cell(0, 25, $result["date_naiss_mere_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(111,178.75);
$pdf->Cell(0, 25, $result["annee_naiss_mere_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(25,183.75);
$pdf->Cell(0, 25, $result["adresse_mere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(25,188.75);
$pdf->Cell(0, 25, $result["profession_mere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(25,193.75);
$pdf->Cell(0, 25, $result["nationalite_mere"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(32,198.75);
$pdf->Cell(0, 25, $result["date_ecrit_hijri"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(111,198.75);
$pdf->Cell(0, 25, $result["annee_ecrit_hijri"],'C');


$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(25,203);
$pdf->Cell(0, 25, $result["date_ecrit_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(111,203);
$pdf->Cell(0, 25, $result["annee_ecrit_miladi"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(30,208);
$pdf->Cell(0, 25, $result["selon_annonceur"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(25,213);
$pdf->Cell(0, 25, $result["age_annonceur"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(25,218);
$pdf->Cell(0, 25, $result["profession_annonceur"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(25,223);
$pdf->Cell(0, 25, $result["nationalite_annonceur"],'C');


$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(30,228);
$pdf->Cell(0, 25, $result["liaison_avec_deces"],'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(25,233);
$pdf->Cell(0, 25, $result["adresse_annonceur"],'C');




}

 ob_end_clean();
$pdf->Output();
