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
            $this->setSourceFile('imprimeModels/modelExtraitNaiss.pdf');
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

$numero= $request["numero"];
$annee= $request["annee"];

$query="SELECT * FROM `exbirth` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
	$result=$pdoResult->fetch();

	if($pdoResult->rowCount()>0)
{

//pour les donnees en arabe
$pdf->setRTL(true);

//numero
// convert TTF font to TCPDF format and store it on the fonts folder

	$pdf->SetFont('freeserif', 'B', 10);
$pdf->SetXY(34, 21);
$pdf->Cell(0, 25, $result["numero"],'C');

//annee
$pdf->SetXY(34, 24.75);
$pdf->Cell(0, 25, $result["annee"],'C');


//prenom ar
$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetFont($fontname, '', 9, '', false);
$pdf->SetXY(34, 44.25);
$pdf->Cell(0, 25, $result["prenom_ar"],'C');
//nom_ar
$pdf->SetXY(34, 50.25);
$pdf->Cell(0, 25, $result["nom_ar"],'C');

//date naiss hijri ar
$pdf->SetFont($fontname, '', 8, '', false);
$pdf->SetXY(34, 56.25);
$pdf->Cell(0, 25, $result["date_naiss_hijri_ar"],'C');
//date naiss miladi ara
$pdf->SetXY(34, 62.25);
$pdf->Cell(0, 25, $result["date_naiss_miladi_ar"],'C');

//lieu naisss
$pdf->SetFont($fontname, '', 9, '', false);
$pdf->SetXY(34, 68);
$pdf->Cell(0, 25, $result["lieu_naiss_ar"],'C');

//nom pere
$pdf->SetXY(34, 74);
$pdf->Cell(0, 25, $result["prenom_pere_ar"],'C');
//nom mere
$pdf->SetXY(34, 80);
$pdf->Cell(0, 25, $result["prenom_mere_ar"],'C');

//tora deces
$pdf->SetXY(53, 86);
$pdf->Cell(0, 25, $result["tora_deces_ar"],'C');



//Francais**************

$pdf->setRTL(false);
//numero
$pdf->SetFont('freeserif', 'B', 10);
$pdf->SetXY(42, 22.5);
$pdf->Cell(0, 25, $result["numero"],'C');

//annee

$pdf->SetXY(42, 26);
$pdf->Cell(0, 25, $result["annee"],'C');
$pdf->SetFont('helvetica', 'B', 9);
//prenom
$pdf->SetXY(42, 44);
$pdf->Cell(0, 25, ucfirst($result["prenom"]),'C');

//nom
$pdf->SetXY(42, 50.5);
$pdf->Cell(0, 25, ucfirst($result["nom"]),'C');

//ne le hijri
$pdf->SetFont('helvetica','B', 9);
$pdf->SetXY(42, 56.25);
$pdf->Cell(0, 25, $result["date_naiss_hijri"],'C');

//miladi
$pdf->SetXY(42, 62.25);
$pdf->Cell(0, 25, $result["date_naiss_miladi"],'C');
//lieu naisss
$pdf->SetXY(42, 68);
$pdf->Cell(0, 25, ucwords($result["lieu_naiss"]),'C');
//nom pere
$pdf->SetXY(42, 74);
$pdf->Cell(0, 25, ucwords($result["prenom_pere"]),'C');
//nom mere

$pdf->SetXY(42, 80);
$pdf->Cell(0, 25, ucwords($result["prenom_mere"]),'C');

//mention marge deces
$pdf->SetXY(53, 86);
$pdf->Cell(0, 25, ucfirst($result["tora_deces"]),'C');

/*
$pdf->SetXY(53, 121.5);
$pdf->Cell(0, 25, ucwords($first_name." ".$last_name),'C');*/

//trace
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(8.95, 33);

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


    $pdf->setRTL(true);
    $pdf->SetFont($fontname, '', 9, '', false);
    $pdf->SetXY(51, 109.5);
    $pdf->Cell(0, 25, ucwords($result2["first_name_ar"]." ".$result2["last_name_ar"]),'C');

    $pdf->setRTL(false);
    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->SetXY(133, 115.5);
    $pdf->Cell(0, 25, ucwords($result2["first_name"]." ".$result2["last_name"]),'C');


}else {
    $pdf->setRTL(false);
    $pdf->Cell(0,0,strtoupper(substr($result2["prenom_delegue"],0,1).substr($result2["nom_delegue"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();


    
    $pdf->setRTL(false);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(60, 116);
    $pdf->Cell(0, 25, ucwords($result2["prenom_delegue"]." ".$result2["nom_delegue"]),'C');
    
    $pdf->setRTL(true);
    $pdf->SetFont($fontname, '', 9, '', false);
    $pdf->SetXY(123, 109.5);
    $pdf->Cell(0, 25, ucwords($result2["prenom_delegue_ar"]." ".$result2["nom_delegue_ar"]),'C');
}
    }





$pdf->setRTL(true);
//date actuelle
$pdf->SetFont('helvetica','B' ,10);
$pdf->SetXY(93, 103.5);
$pdf->Cell(0, 25, $ActualDate,'C');
}

 ob_end_clean();
$pdf->Output();
