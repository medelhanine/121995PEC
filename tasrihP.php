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
    /**
     * "Remembers" the template id of the imported page
     */
    protected $tplId;

    /**
     * Draw an imported PDF logo on every page
     */
    function Header()
    {
        if (is_null($this->tplId)) {
            $this->setSourceFile('imprimeModels/tasrihBirth.pdf');
            $this->tplId = $this->importPage(1);
        }
        $size = $this->useImportedPage($this->tplId, -5 , -0, 220);


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
$pdf->AddPage();
//$cin=$_POST["cin"];
date_default_timezone_set('UTC');
$ActualDate = date('Y/m/d');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);
$pdoResult;

$numero= $_GET["numero"];
$annee= $_GET["annee"];
$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);
$query="SELECT * FROM `sbirth` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
	$result=$pdoResult->fetch();

	if($pdoResult->rowCount()>0)
{
//pour les donnees en arabe
$pdf->setRTL(true);

$pdf->SetFont('freeserif', 'B', 10);
$pdf->SetXY(67, 10.5);
$pdf->Cell(0, 25, $result["numero"],'C');

$pdf->SetFont($fontname, 'B', 9);
$pdf->SetXY(27, 25);
$pdf->Cell(0, 25, "تارودانت",'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(24, 42);
$pdf->Cell(0, 25, $communeName,'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(24, 50);
$pdf->Cell(0, 25, $communeName,'C');

$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(40, 86);
$pdf->Cell(0, 25, $result["prenom_ar"]." ".$result["nom_ar"],'C');
if($result["sex"]=="masculin")
{
  $pdf->SetFont($fontname, 'B', 10);
  $pdf->SetXY(25, 94);
  $pdf->Cell(0, 25, "ذكر",'C');
}else{
  $pdf->SetFont($fontname, 'B', 10);
  $pdf->SetXY(25, 94);
  $pdf->Cell(0, 25, " أنثى",'C');
}

$pdf->SetFont($fontname, 'B', 9);
$pdf->SetXY(28, 102.5);
$pdf->Cell(0, 25, $result["date_naiss_hijri_ar"],'C');


$pdf->SetXY(24, 110.5);
$pdf->Cell(0, 25, $result["date_naiss_miladi_ar"],'C');


$pdf->SetXY(28, 119);
$pdf->Cell(0, 25, $result["lieu_naiss_ar"],'C');


$pdf->SetXY(47, 127);
$pdf->Cell(0, 25, $result["prenom_pere_ar"]." ".$result["nom_pere_ar"],'C');


$pdf->SetXY(30, 135.5);
$pdf->Cell(0, 25, $result["date_naiss_pere_hijri_ar"],'C');


$pdf->SetXY(24, 144);
$pdf->Cell(0, 25, $result["date_naiss_pere_miladi_ar"],'C');

$pdf->SetXY(30, 152);
$pdf->Cell(0, 25, $result["lieu_naiss_pere_ar"],'C');

$pdf->SetXY(30, 160.5);
$pdf->Cell(0, 25, $result["niveau_scol_pere_ar"],'C');

$pdf->SetXY(24, 169);
$pdf->Cell(0, 25, $result["profession_pere_ar"],'C');

$pdf->SetXY(24, 177.5);
$pdf->Cell(0, 25, $result["nationalite_pere_ar"],'C');

$pdf->SetXY(47, 185.5);
$pdf->Cell(0, 25, $result["nom_mere_ar"],'C');

$pdf->SetXY(30, 193.5);
$pdf->Cell(0, 25, $result["date_naiss_mere_hijri_ar"],'C');

$pdf->SetXY(30, 202);
$pdf->Cell(0, 25, $result["date_naiss_mere_miladi_ar"],'C');

$pdf->SetXY(30, 210);
$pdf->Cell(0, 25, $result["lieu_naiss_mere_ar"],'C');

$pdf->SetXY(30, 218);
$pdf->Cell(0, 25, $result["niveau_scol_mer_ar"],'C');

$pdf->SetXY(26, 226.5);
$pdf->Cell(0, 25, $result["profession_mere_ar"],'C');

$pdf->SetXY(26, 235);
$pdf->Cell(0, 25, $result["nationalite_mere_ar"],'C');

$pdf->SetFont('freeserif', 'B', 10);
$pdf->SetXY(106, 243);
$pdf->Cell(0, 25, $result["ordre_naiss"],'C');

$pdf->SetFont($fontname, 'B', 9);
$pdf->SetXY(30, 251);
$pdf->Cell(0, 25, $result["adresse_parent_ar"],'C');

}

 ob_end_clean();
$pdf->Output();
