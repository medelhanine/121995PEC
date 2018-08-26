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

class Pdf extends Fpdi\TcpdfFpdi
{
    protected $tplId;

    function Header()
    {
        if (is_null($this->tplId)) {
            $this->setSourceFile('imprimeModels/copieIntegBirth.pdf');
            $this->tplId = $this->importPage(1);
        }
        $size = $this->useImportedPage($this->tplId, -4 , 5.5, 215);
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
$fontname = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
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
date_default_timezone_set('UTC');
$ActualDate = date('d/m/Y');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);
$numero= $request["numero"];
$annee= $request["annee"];
$query="SELECT * FROM `sbirth` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
	$result=$pdoResult->fetch();

  if($pdoResult->rowCount()>0)
{

//trace
$pdf->setRTL(false);
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(35.95, 233);

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
    $pdf->SetXY(115, 237.75);
    $pdf->Cell(0, 25, ucwords($result2["first_name_ar"]." ".$result2["last_name_ar"]),'C');
      /*
    $pdf->setRTL(false);
    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->SetXY(133, 115.5);
    $pdf->Cell(0, 25, ucwords($result2["first_name"]." ".$result2["last_name"]),'C');*/


}else {
    $pdf->setRTL(false);
    $pdf->Cell(0,0,strtoupper(substr($result2["prenom_delegue"],0,1).substr($result2["nom_delegue"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();


    
    /*$pdf->setRTL(false);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(60, 116);
    $pdf->Cell(0, 25, ucwords($result2["prenom_delegue"]." ".$result2["nom_delegue"]),'C');*/
    
    $pdf->setRTL(true);
    $pdf->SetFont($fontname, '', 9, '', false);
    $pdf->SetXY(115, 237.75);
    $pdf->Cell(0, 25, ucwords($result2["prenom_delegue_ar"]." ".$result2["nom_delegue_ar"]),'C');
}
    }



//pour les donnees en fraincais
$pdf->setRTL(true);
//date naisse miladi ar
$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(73,0);
$pdf->Cell(0, 25, $result["date_naiss_hijri_ar"],'C');
//date naisse hijri ar

$pdf->SetXY(73, 8);
$pdf->Cell(0, 25, $result["date_naiss_miladi_ar"],'C');
//heure
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(100, 15.5);
$pdf->Cell(0, 25, $result["heure"],'C');

//min

$pdf->SetXY(150, 15.5);
$pdf->Cell(0, 25, $result["min_naiss"],'C');

//lieu naiiss ar
$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(78, 24);
$pdf->Cell(0, 25, $result["lieu_naiss_ar"],'C');

//prenom ar

$pdf->SetXY(83, 32.5 );
$pdf->Cell(0, 25, $result["prenom_ar"],'C');

//nom ar

$pdf->SetXY(81, 40.5);
$pdf->Cell(0, 25, $result["nom_ar"],'C');

//nom pere ar

$pdf->SetXY(81, 49);
$pdf->Cell(0, 25, $result["prenom_pere_ar"],'C');

//nationalit pere ar
$pdf->SetXY(75, 57);
$pdf->Cell(0, 25, $result["nationalite_pere_ar"],'C');

//leiu naiss pere ar
$pdf->SetXY(113, 57);
$pdf->Cell(0, 25, $result["lieu_naiss_pere_ar"],'C');
//date naiss hijri ar
$pdf->SetXY(70, 65);
$pdf->Cell(0, 25, $result["date_naiss_pere_hijri_ar"],'C');
//date naiss pere ar miladi
$pdf->SetXY(75, 73);
$pdf->Cell(0, 25, $result["date_naiss_pere_miladi_ar"],'C');
//profession pere ar
$pdf->SetXY(73, 81.5);
$pdf->Cell(0, 25, $result["profession_pere_ar"],'C');

//nom mere ar
$pdf->SetXY(81, 89.5);
$pdf->Cell(0, 25, $result["nom_mere_ar"],'C');

//nationalite mere ar
$pdf->SetXY(80, 98);
$pdf->Cell(0, 25, $result["nationalite_mere_ar"],'C');

//lieu naiss mere ar
$pdf->SetXY(113, 98);
$pdf->Cell(0, 25, $result["lieu_naiss_mere_ar"],'C');
//date naiss hijri ar
$pdf->SetXY(71, 105.5);
$pdf->Cell(0, 25, $result["date_naiss_mere_hijri_ar"],'C');
//date naiss mere ar
$pdf->SetXY(73, 114);
$pdf->Cell(0, 25, $result["date_naiss_mere_miladi_ar"],'C');
//profession mere
$pdf->SetXY(74, 122);
$pdf->Cell(0, 25, $result["profession_mere_ar"],'C');

//domicile ar
$pdf->SetXY(78, 130.5);
$pdf->Cell(0, 25, $result["adresse_parent_ar"],'C');
//selon ar
$pdf->SetXY(87, 138);
$pdf->Cell(0, 25, $result["selon_ar"],'C');
//age
$pdf->SetXY(64, 146.5);
$pdf->Cell(0, 25, $result["age_num_ar"],'C');
//adresse mossarih
$pdf->SetXY(78, 154.5);
$pdf->Cell(0, 25, $result["adresse_annonceur_ar"],'C');

//ecrit le hijri
$pdf->SetXY(82, 163);
$pdf->Cell(0, 25, $result["date_annonce_hijri_ar"],'C');

//ecrit le ecrite_le_miladi
$pdf->SetXY(72, 171);
$pdf->Cell(0, 25, $result["date_annonce_miladi_ar"],'C');

//par nous
$pdf->SetXY(81, 187);
$pdf->Cell(0, 25, $result["par_nous_ar"],'C');

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(120, 229);
$pdf->Cell(0, 25, $ActualDate,'C');


//numero

$pdf->SetXY(20, -0);
$pdf->Cell(0, 25, $result["numero"],'C');


//SEARCH IN TORAR
// MENTION MARGINALE************************************
$i=0;
$query="SELECT * FROM `torabirth` WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($numero,$annee));
$result=$pdoResult->fetchAll();

if($pdoResult->rowCount()>0)
  {
foreach($result as $row)
{
  $pdf->setRTL(true);
  $pdf->SetFont($fontname, 'B', 10);
  $pdf->SetXY(0, 15.5+$i);
//  $pdf->Cell(75, 20, , 0, 2, 'R', 0, '', 1);
$pdf->setCellHeightRatio(1.6);
  $pdf->MultiCell(61, 25, trim($row["content_ar"]), 0, 'R', 0, 1, '', '', true);
  $i +=30;
}
}
}
 ob_end_clean();
$pdf->Output();
