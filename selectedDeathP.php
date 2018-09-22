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
}
date_default_timezone_set('UTC');
$ActualDate = date('Y/m/d');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);
// initiate PDF
ob_start();
$pdf = new Pdf();
$pdf->SetAutoPageBreak(true, 0);
$pageCount = $pdf->setSourceFile('imprimeModels\copieIntegDeath.pdf');
$fontname = "aefurat";
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

$pdoResult;
$numero=$_GET["numero"];
$annee=$_GET["annee"];
$query="SELECT * FROM `sdeadtable` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
	$result=$pdoResult->fetch();
  // iterate through all pages
  for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
      // import a page
      $templateId = $pdf->importPage($pageNo);
  $pdf->setPrintHeader(false);
  $pdf->setPrintFooter(false);
      $pdf->AddPage();
      // ARABE VERSION**********************************************************************
      if($pageNo==1)
      {
        // set some language dependent data:
          $lg = Array();
          $lg['a_meta_charset'] = 'UTF-8';
          $lg['a_meta_dir'] = 'rtl';
          $lg['a_meta_language'] = 'fa';
          $lg['w_page'] = 'page';
          $pdf->setLanguageArray($lg);
          $size = $pdf->useImportedPage($templateId, -3 , 5.5, 215);
          //Search In Solb*************
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
    $pdf->SetXY(130, 234.25);
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
    $pdf->SetXY(130, 234.25);
    $pdf->Cell(0, 25, ucwords($result2["prenom_delegue_ar"]." ".$result2["nom_delegue_ar"]),'C');
}
    }

//pour les donnees arabe****************
$pdf->setRTL(true);
//date deces hijri ar
$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(70, 0);
$pdf->Cell(0, 25, $result["date_deces_hijri_ar"],'C');
//date deces miladi ar

$pdf->SetXY(75, 8);
$pdf->Cell(0, 25, $result["date_deces_miladi_ar"],'C');

//heure
$pdf->SetFont('freeserif', 'B', 10);
$pdf->SetXY(98, 15.75);
$pdf->Cell(0, 25, $result["heure"],'C');

//min
$pdf->SetFont('freeserif', 'B', 10);
$pdf->SetXY(155, 15.75);
$pdf->Cell(0, 25, $result["minute"],'C');

//lieu naiiss ar
$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(82, 24.25);
$pdf->Cell(0, 25, $result["lieu_deces_ar"],'C');
//prenom ar
$pdf->SetXY(85, 32.75);
$pdf->Cell(0, 25, $result["prenom_ar"],'C');
//nom ar
$pdf->SetXY(82, 40.75);
$pdf->Cell(0, 25, $result["nom_ar"],'C');
//nationalite
$pdf->SetXY(78, 48.75);
$pdf->Cell(0, 25, $result["nationalite_ar"],'C');
//lieu naiss
$pdf->SetXY(85, 56.75);
$pdf->Cell(0, 25, $result["lieu_naissance_ar"],'C');
//date naiss hijri
$pdf->SetXY(73, 65.25);
$pdf->Cell(0, 25, $result["date_naiss_hijri_ar"],'C');
//date naiss miladi
$pdf->SetXY(77, 73.25);
$pdf->Cell(0, 25, $result["date_naiss_miladi_ar"],'C');
//profession
$pdf->SetXY(83, 81.75);
$pdf->Cell(0, 25, $result["profession_ar"],'C');
//domicile
$pdf->SetXY(85, 89.75);
$pdf->Cell(0, 25, $result["domicile_ar"],'C');
//prenom pere
$pdf->SetXY(80, 97.75);
$pdf->Cell(0, 25, $result["nom_pere_ar"],'C');
//nationalite pere
$pdf->SetXY(80, 106.75);
$pdf->Cell(0, 25, $result["nationalite_pere_ar"],'C');
//profession pere
$pdf->SetXY(150, 106.25);
$pdf->Cell(0, 25, $result["profession_pere_ar"],'C');
//domicile pere
$pdf->SetXY(82, 113.75);
$pdf->Cell(0, 25, $result["domicile_pere_ar"],'C');
//prenom mere
$pdf->SetXY(83, 121.7);
$pdf->Cell(0, 25, $result["nom_mere_ar"],'C');
//nationalite mere
$pdf->SetXY(81, 130.25);
$pdf->Cell(0, 25, $result["nationalite_mere_ar"],'C');
//profession mere
$pdf->SetXY(150, 130.25);
$pdf->Cell(0, 25, $result["profession_mere_ar"],'C');
//domcile mere
$pdf->SetXY(82, 138.7);
$pdf->Cell(0, 25, $result["domicile_mere_ar"],'C');
//etat familiale
//etat Familiale

if($result["etat_familiale"]=="celeb")
{
$pdf->SetXY(88, 146.7);
$pdf->Cell(0, 25,"عازب" ,'C');
}
if($result["etat_familiale"]=="marie")
{
$pdf->SetXY(88, 146.7);
$pdf->Cell(0, 25,"متزوج" ,'C');
}
if($result["etat_familiale"]=="divorce")
{
$pdf->SetXY(88, 146.7);
$pdf->Cell(0, 25,"مطلق" ,'C');
}
if($result["etat_familiale"]=="veuf")
{
$pdf->SetXY(88, 146.7);
$pdf->Cell(0, 25,"أرمل" ,'C');
}

//selon
$pdf->SetXY(88, 154.25);
$pdf->Cell(0, 25,$result["selon_ar"] ,'C');
//date_ ecritture hijri
$pdf->SetXY(84, 163);
$pdf->Cell(0, 25,$result["ecrite_le_hijri_ar"] ,'C');

//date ecrit miladi
$pdf->SetXY(80, 171.5);
$pdf->Cell(0, 25,$result["ecrite_le_miladi_ar"] ,'C');

//heure ecrit
$pdf->SetFont('freeserif', 'B', 11);
$pdf->SetXY(90, 179.5);
$pdf->Cell(0, 25,$result["heure_ecrit"] ,'C');
//min ecrit
$pdf->SetXY(156, 179.5);
$pdf->Cell(0, 25,$result["min_ecrit"] ,'C');

$pdf->SetFont($fontname, 'B', 11);
$pdf->SetXY(86, 187.25);
$pdf->Cell(0, 25,$result["par_nous_ar"] ,'C');

$pdf->SetXY(92, 195.25);
$pdf->Cell(0, 25,$result["officier_etat_civil_ar"] ,'C');

$pdf->SetFont("helvetica", 'B', 10);
$pdf->SetXY(142, 226.7);
$pdf->Cell(0, 25,$ActualDate ,'C');
//francais version**********************************************
$pdf->setRTL(false);
$pdf->SetFont('freeserif', 'B', 9);
//prenom
$pdf->SetXY(50, 33);
$pdf->Cell(0, 25, ucfirst($result["prenom"]),'C');
//nom
$pdf->SetXY(50, 40);
$pdf->Cell(0, 25, ucfirst($result["nom"]),'C');

}


// MENTION MARGINALES/////////////////////////////////////////////////////////////
$i=0;
$query="SELECT * FROM `toradeath` WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($numero,$annee));
$result=$pdoResult->fetchAll();

if($pdoResult->rowCount()>0)
  {
foreach($result as $row)
{
  $pdf->setRTL(true);
  $pdf->SetFont($fontname, 'B', 8);
  $pdf->SetXY(3, 19+$i);
//  $pdf->Cell(75, 20, , 0, 2, 'R', 0, '', 1);
  $pdf->MultiCell(60, 25, $row["content_ar"], 0, 'R', 0, 1, '', '', true);
  $i +=10;
}
}
      }
      // FRANCAIS VERSION**********************************************************************
      if($pageNo==2)
      {
        $query="SELECT * FROM `sdeadtable` WHERE `numero`=? AND `annee`=?";
      	$pdoResult = $pdoConnect->prepare($query);
      	$pdoResult->execute(array($numero,$annee));
      	$result=$pdoResult->fetch();
        $size = $pdf->useImportedPage($templateId, -3 , 10, 220);
        if($pdoResult->rowCount()>0)
        {


          //trace
$pdf->setRTL(false);
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(95.95, 233);

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

 /*
    $pdf->setRTL(true);
    $pdf->SetFont($fontname, '', 9, '', false);
    $pdf->SetXY(130, 234.25);
    $pdf->Cell(0, 25, ucwords($result2["first_name_ar"]." ".$result2["last_name_ar"]),'C');*/
     
    $pdf->setRTL(false);
    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->SetXY(127, 250);
    $pdf->Cell(0, 25, ucwords($result2["first_name"]." ".$result2["last_name"]),'C');


}else {
    $pdf->setRTL(false);
    $pdf->Cell(0,0,strtoupper(substr($result2["prenom_delegue"],0,1).substr($result2["nom_delegue"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();

    $pdf->setRTL(false);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(127, 250);
    $pdf->Cell(0, 25, ucwords($result2["prenom_delegue"]." ".$result2["nom_delegue"]),'C');
    
   /* $pdf->setRTL(true);
    $pdf->SetFont($fontname, '', 9, '', false);
    $pdf->SetXY(130, 234.25);
    $pdf->Cell(0, 25, ucwords($result2["prenom_delegue_ar"]." ".$result2["nom_delegue_ar"]),'C');*/
}
    }

          $pdf->setRTL(false);
          $pdf->SetFont('helvetica', 'B', 10);

          $pdf->SetXY(35, 5.25);
          $pdf->Cell(0, 25, ucfirst($result["numero"]),'C');

          $pdf->SetXY(73, 5.25);
          $pdf->Cell(0, 25, ucfirst($result["date_deces_hijri_fr"]),'C');//ucfirst($result["date_deces_hijri_fr"])

          $pdf->SetXY(95, 13.5);
          $pdf->Cell(0, 25, ucfirst($result["date_deces_miladi_fr"]),'C');//ucfirst($result["date_deces_miladi_fr"])

          $pdf->SetXY(90, 22);
          $pdf->Cell(0, 25, $result["heure"],'C');//$result["heure"]

          $pdf->SetXY(155, 22);
          $pdf->Cell(0, 25, $result["minute"],'C');//$result["minute"]

          $pdf->SetXY(93, 31);
          $pdf->Cell(0, 25, ucfirst($result["lieu_deces"]),'C');//ucfirst($result["lieu_deces"])

          $pdf->SetXY(65, 39);
          $pdf->Cell(0, 25, ucfirst($result["prenom"]." ".ucfirst($result["nom"])),'C');

          $pdf->SetXY(80, 47.5);
          $pdf->Cell(0, 25,ucfirst($result["lieu_naissance"]) ,'C');//ucfirst($result["lieu_naissance"])

          $pdf->SetXY(75, 56);
          $pdf->Cell(0, 25,ucfirst($result["date_naiss_hijri_fr"]) ,'C');//ucfirst($result["date_naiss_hijri_fr"])

          $pdf->SetXY(96, 64.25);
          $pdf->Cell(0, 25, ucfirst($result["date_naiss_miladi_fr"]),'C');//ucfirst($result["date_naiss_miladi_fr"])

          $pdf->SetXY(85, 72.5);
          $pdf->Cell(0, 25,ucfirst($result["profession"]) ,'C');//ucfirst($result["profession"])

          $pdf->SetXY(90, 81);
          $pdf->Cell(0, 25, ucfirst($result["domicile"]),'C');//ucfirst($result["domicile"])

          $pdf->SetXY(90, 90);
          $pdf->Cell(0, 25, ucfirst($result["nom_pere"]),'C');//ucfirst($result["nom_pere"])

          $pdf->SetXY(90, 98.5);
          $pdf->Cell(0, 25, ucfirst($result["nationalite_pere"]),'C');//ucfirst($result["nationalite_pere"])

          $pdf->SetXY(160, 98.5);
          $pdf->Cell(0, 25, ucfirst($result["profession_pere"]),'C');//ucfirst($result["profession_pere"])

          $pdf->SetXY(87, 107);
          $pdf->Cell(0, 25, ucfirst($result["domicile_pere"]),'C');//ucfirst($result["domicile_pere"])

          $pdf->SetXY(80, 115.25);
          $pdf->Cell(0, 25, ucfirst($result["nom_mere"]),'C');//ucfirst($result["nom_mere"])

          $pdf->SetXY(90, 123.75);
          $pdf->Cell(0, 25, ucfirst($result["nationalite_mere"]),'C');//ucfirst($result["nationalite_mere"])

          $pdf->SetXY(155, 123.75);
          $pdf->Cell(0, 25, ucfirst($result["profession_mere"]),'C');//ucfirst($result["profession_mere"])

          $pdf->SetXY(90, 132.5);
          $pdf->Cell(0, 25, ucfirst($result["domicile_mere"]),'C');//ucfirst($result["domicile_mere"])

          $pdf->SetXY(80, 140.75);
          $pdf->Cell(0, 25, ucfirst($result["ecrite_le_hijri_fr"]),'C');//ucfirst($result["ecrite_le_hijri_fr"])


          $pdf->SetXY(95, 149);
          $pdf->Cell(0, 25, ucfirst($result["ecrite_le_miladi_fr"]),'C');//ucfirst($result["ecrite_le_miladi_fr"])

          $pdf->SetFont('helvetica', 'B', 9);
          $pdf->SetXY(120, 158);
          $pdf->Cell(0, 25, ucfirst($result["selon"]),'C');//ucfirst($result["selon"])

          $pdf->SetFont('helvetica', 'B', 9);
          $pdf->SetXY(75, 166.5);
          $pdf->Cell(0, 25, ucfirst($result["age_mosarih"]) ,'C');// ucfirst($result["age_mosarih"]) 

          $pdf->SetFont('helvetica', 'B', 9);
          $pdf->SetXY(65, 183.5);
          $pdf->Cell(0, 25, ucfirst($result["domicile_mosarih"]),'C');// ucfirst($result["domicile_mosarih"])

          $pdf->SetFont('helvetica', 'B', 9);
          $pdf->SetXY(100, 200.5);
          $pdf->Cell(0, 25, ucfirst($result["officier_etat_civil"]),'C');// ucfirst($result["officier_etat_civil"])

          

          $pdf->SetXY(105, 236);
          $pdf->Cell(0, 25, $ActualDate,'C');



        }


        // MENTION MARGINALE************************************
      $i=0;
      $query="SELECT * FROM `toradeath` WHERE `numero`=? AND `annee`=?";
      	$pdoResult = $pdoConnect->prepare($query);
      	$pdoResult->execute(array($numero,$annee));
      	$result=$pdoResult->fetchAll();

      	if($pdoResult->rowCount()>0)
          {
        foreach($result as $row)
        {
          $pdf->setRTL(false);
          $pdf->SetFont('helvetica', 'B', 8);
          $pdf->SetXY(3, 22+$i);
          $pdf->MultiCell(60, 25, $row["content_fr"], 0, 'L', 0, 1, '', '', true);
          $i +=10;
      }
      }

      }

  }

 ob_end_clean();
$pdf->Output();
