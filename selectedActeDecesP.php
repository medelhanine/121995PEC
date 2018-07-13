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
    $first_name_ar = $_SESSION['first_name_ar'];
    $last_name = $_SESSION['last_name'];
    $last_name_ar = $_SESSION['last_name_ar'];
    $username = $_SESSION['username'];
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
            $this->setSourceFile('imprimeModels/modelActeDeces.pdf');
            $this->tplId = $this->importPage(1);
        }
        $size = $this->useImportedPage($this->tplId, -1 , -0, 215);
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
$pdf->AddPage('L', 'A5');
//$cin=$_POST["cin"];
date_default_timezone_set('UTC');
$ActualDate = date('d/m/Y');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);
$pdoResult;

$numero= $_GET["numero"];
$annee= $_GET["annee"];

$query="SELECT * FROM `acte_deces` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
	$result=$pdoResult->fetch();

	if($pdoResult->rowCount()>0)
{
//pour les donnees en arabe
$pdf->setRTL(true);

//numero
// convert TTF font to TCPDF format and store it on the fonts folder

	$pdf->SetFont('freeserif', 'B', 9);
$pdf->SetXY(38, 23);
$pdf->Cell(0, 25, $result["numero"],'C');

//annee
$pdf->SetXY(38, 26.75);
$pdf->Cell(0, 25, $result["annee"],'C');


//prenom ar
$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetFont($fontname, '', 9, '', false);
$pdf->SetXY(34, 54);
$pdf->Cell(0, 25,$result["prenom_ar"] ,'C');//
//nom_ar
$pdf->SetXY(34, 58.5);
$pdf->Cell(0, 25,$result["nom_ar"],'C');//

//date naiss hijri ar
$pdf->SetFont($fontname, '', 8, '', false);
$pdf->SetXY(34, 38.5);
$pdf->Cell(0, 25, $result["date_deces_hijri_ar"],'C');//
//date naiss miladi ara
$pdf->SetXY(34, 44);
$pdf->Cell(0, 25,$result["date_deces_miladi_ar"] ,'C');//

//lieu naisss
$pdf->SetFont($fontname, '', 9, '', false);
$pdf->SetXY(34, 49);
$pdf->Cell(0, 25,$result["lieu_deces_ar"],'C');//

$pdf->SetXY(34, 64);
$pdf->Cell(0, 25,$result["date_naiss_hijri_ar"] ,'C');//

$pdf->SetXY(34, 68.5);
$pdf->Cell(0, 25,$result["date_naiss_miladi_ar"] ,'C');//

$pdf->SetXY(34, 73);
$pdf->Cell(0, 25,result["lieu_naiss_ar"] ,'C');//$

$pdf->SetXY(34, 78);
$pdf->Cell(0, 25,$result["profession_ar"] ,'C');//

$pdf->SetXY(34, 83);
$pdf->Cell(0, 25,$result["domicile_ar"] ,'C');//

$pdf->SetXY(34, 88);
$pdf->Cell(0, 25,$result["prenom_pere_ar"],'C');//

$pdf->SetXY(34, 93);
$pdf->Cell(0, 25,$result["prenom_mere_ar"],'C');//



//Francais**************

$pdf->setRTL(false);
$pdf->SetFont("helvetica", '', 9, '', false);
$pdf->SetXY(46, 54);
$pdf->Cell(0, 25,$result["prenom"] ,'C');//
//nom_ar
$pdf->SetXY(46, 58.5);
$pdf->Cell(0, 25,$result["nom"],'C');//

//date naiss hijri ar
$pdf->SetFont(helvetica, '', 8, '', false);
$pdf->SetXY(46, 38.5);
$pdf->Cell(0, 25, $result["date_deces_hijri"],'C');//
//date naiss miladi ara
$pdf->SetXY(46, 44);
$pdf->Cell(0, 25,$result["date_deces_miladi"] ,'C');//

//lieu naisss
$pdf->SetFont(helvetica, '', 9, '', false);
$pdf->SetXY(46, 49);
$pdf->Cell(0, 25,$result["lieu_deces"],'C');//

$pdf->SetXY(46, 64);
$pdf->Cell(0, 25,$result["date_naiss_hijri"] ,'C');//

$pdf->SetXY(46, 68.5);
$pdf->Cell(0, 25,$result["date_naiss_miladi"] ,'C');//

$pdf->SetXY(46, 73);
$pdf->Cell(0, 25,result["lieu_naiss"] ,'C');//$

$pdf->SetXY(46, 78);
$pdf->Cell(0, 25,$result["profession"] ,'C');//

$pdf->SetXY(46, 83);
$pdf->Cell(0, 25,$result["domicile"] ,'C');//

$pdf->SetXY(46, 88);
$pdf->Cell(0, 25,$result["prenom_pere"],'C');//

$pdf->SetXY(46, 93);
$pdf->Cell(0, 25,$result["prenom_mere"],'C');//

/*
$pdf->SetXY(53, 121.5);
$pdf->Cell(0, 25, ucwords($first_name." ".$last_name),'C');*/

//trace
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(8.95, 33);


$pdf->Cell(0,0,strtoupper(substr($first_name,0,1).substr($first_name,-1)),0,0,'L',0,'');
$pdf->StopTransform();


$pdf->setRTL(true);
//date actuelle
$pdf->SetFont('helvetica','B' ,10);
$pdf->SetXY(93, 110);
$pdf->Cell(0, 25, $ActualDate,'C');
}

 ob_end_clean();
$pdf->Output();
