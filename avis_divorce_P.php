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

    protected $tplId;

    function Header()
    {
        if (is_null($this->tplId)) {
            $this->setSourceFile('imprimeModels/bayane_talak.pdf');
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

$istinaf= $request["istinaf"];
$ibtidaayia= $request["ibtidaayia"];

$adad= $request["adad"];
$sahifa= $request["sahifa"];
$numero_sijil= $request["numero_sijil"];
//$date_reference= $request["date_reference"];
$categorie_avis= $request["categorie_avis"];
$date_avis= $request["date_avis"];
$annee_husband= $request["annee_husband"];
$numero_husband= $request["numero_husband"];
$prenom_nom= $request["prenom_nom"];
$prenom_nom_ar= $request["prenom_nom_ar"];
$date_naiss_num= $request["date_naiss_num"];
$date_naiss= $request["date_naiss"];
$nationalite= $request["nationalite"];
$profession= $request["profession"];
//$etat_familiale= $request["etat_familiale"];
$adress= $request["adress"];
$lieu_naiss= $request["lieu_naiss"];
$annee_wife= $request["annee_wife"];
$numero_wife= $request["numero_wife"];
$prenom_nom_wife= $request["prenom_nom_wife"];
$prenom_nom_ar_wife= $request["prenom_nom_ar_wife"];
$date_naiss_num_wife= $request["date_naiss_num_wife"];
$date_naiss_wife= $request["date_naiss_wife"];
$nationalite_wife= $request["nationalite_wife"];
$profession_wife= $request["profession_wife"];
//$etat_familiale_wife= $request["etat_familiale_wife"];
$date_divorce= $request["date_divorce"];
//$date_deces_marie= $request["date_deces_marie"];
$adress_wife= $request["adress_wife"];
$lieu_naiss_wife= $request["lieu_naiss_wife"];
$date_marriage= $request["date_marriage"];
$child_number= $request["child_number"];
$lieu_acte_marriage= $request["lieu_acte_marriage"];
$tora_ar= $request["tora_ar"];
$tora_fr= $request["tora_fr"];

if(isset($request["id_avis_divorce"]))
{
   //update values
$query = "UPDATE `avis_divorce` SET `tribunal_istinaf`=?,`tribunal_ibtidaia`=?,`adad`=?,`sahifa`=?,`date`=?,`numero_sijil`=?,`type_divorce`=?,`date_divorce`=?,`date_mariage`=?,`lieu_mariage`=?,`nombre_enfants`=?,`nom_motalak_ar`=?,`nom_motalak`=?,`numero_motalak`=?,`annee_motalak`=?,`date_naiss_motalak`=?,`date_naiss_motalak_num`=?,`lieu_naiss_motalak`=?,`profession_motalak`=?,`nationalite_motalak`=?,`adresse_motalak`=?,`nom_motalaka_ar`=?,`nom_motalaka`=?,`numero_motalaka`=?,`annee_motalaka`=?,`date_naiss_motalaka`=?,`date_naiss_motalaka_num`=?,`lieu_naiss_motalaka`=?,`profession_motalaka`=?,`nationalite_motalaka`=?,`adresse_motalaka`=? WHERE `id_avis_divorce`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($istinaf,$ibtidaayia,$adad,$sahifa,$date_avis,$numero_sijil,$categorie_avis,$date_divorce,$date_marriage,$lieu_acte_marriage,$child_number,$prenom_nom_ar,$prenom_nom,$numero_husband,$annee_husband,$date_naiss,$date_naiss_num,$lieu_naiss,$profession,$nationalite,$adress,$prenom_nom_ar_wife,$prenom_nom_wife,$numero_wife,$annee_wife,$date_naiss_wife,$date_naiss_num_wife,$lieu_naiss_wife,$profession_wife,$nationalite_wife,$adress_wife,$request["id_avis_divorce"]));

}else{
  //insert avis in database
$query = "INSERT INTO `avis_divorce`(`tribunal_istinaf`, `tribunal_ibtidaia`, `adad`, `sahifa`, `date`, `numero_sijil`, `type_divorce`, `date_divorce`, `date_mariage`, `lieu_mariage`, `nombre_enfants`, `nom_motalak_ar`, `nom_motalak`, `numero_motalak`, `annee_motalak`, `date_naiss_motalak`,`date_naiss_motalak_num`, `lieu_naiss_motalak`, `profession_motalak`, `nationalite_motalak`, `adresse_motalak`, `nom_motalaka_ar`, `nom_motalaka`, `numero_motalaka`, `annee_motalaka`, `date_naiss_motalaka`,`date_naiss_motalaka_num`, `lieu_naiss_motalaka`, `profession_motalaka`, `nationalite_motalaka`, `adresse_motalaka`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($istinaf,$ibtidaayia,$adad,$sahifa,$date_avis,$numero_sijil,$categorie_avis,$date_divorce,$date_marriage,$lieu_acte_marriage,$child_number,$prenom_nom_ar,$prenom_nom,$numero_husband,$annee_husband,$date_naiss,$date_naiss_num,$lieu_naiss,$profession,$nationalite,$adress,$prenom_nom_ar_wife,$prenom_nom_wife,$numero_wife,$annee_wife,$date_naiss_wife,$date_naiss_num_wife,$lieu_naiss_wife,$profession_wife,$nationalite_wife,$adress_wife));

}





//database insert 
if(isset($numero_husband) && isset($annee_husband))
{
  //insert in time Stamp table
  $query = "INSERT INTO `timep_stamp_table`(`numero`, `annee`, `sex`, `type`) VALUES (?,?,'masculin','talak')";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute(array($numero_husband,$annee_husband));

  //insert in torar
  $query = "INSERT INTO `torabirth`(`numero`, `annee`, `content_ar`, `content_fr`) VALUES (?,?,?,?)";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute(array($numero_husband,$annee_husband,$tora_ar,$tora_fr));
}


if(isset($numero_wife) && isset($annee_wife))
{
  $query = "INSERT INTO `timep_stamp_table`(`numero`, `annee`, `sex`, `type`) VALUES (?,?,'feminin','talak')";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute(array($numero_wife,$annee_wife));

  //insert in torar
  $query = "INSERT INTO `torabirth`(`numero`, `annee`, `content_ar`, `content_fr`) VALUES (?,?,?,?)";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute(array($numero_wife,$annee_wife,$tora_ar,$tora_fr));
}

//pour les donnees en arabe
$pdf->setRTL(true);


//prenom ar
$fontname = "aefurat";

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 31.75);
$pdf->Cell(0, 25, "تارودانت",'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 37.5);
$pdf->Cell(0, 25, "تارودانت",'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 43.25);
$pdf->Cell(0, 25, "جماعة زواية سيدي الطاهر " ,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(38, 61.25);
$pdf->Cell(0, 25, $istinaf ,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(38, 67.25);
$pdf->Cell(0, 25, $ibtidaayia ,'C');


$pdf->SetFont("helvetica", 'B', 12);
$pdf->SetXY(35, 78);
$pdf->Cell(0, 25, $adad ,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 84);
$pdf->Cell(0, 25, $sahifa ,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 89.25);
$pdf->Cell(0, 25, $date_avis ,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 94.5);
$pdf->Cell(0, 25, $numero_sijil ,'C');


if($categorie_avis=="kabl_binae")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(67.5,100.5);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

if($categorie_avis=="rijii")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(42.5,100.5);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

if($categorie_avis=="khilii")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(89.5,100.5);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

if($categorie_avis=="momlak")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(118,100.5);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

if($categorie_avis=="mokmil_talat")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(147,100.5);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}


$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(34,106);
$pdf->Cell(0, 25, $date_avis,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(34,111.5);
$pdf->Cell(0, 25, $date_marriage,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(41,116.75);
$pdf->Cell(0, 25, $lieu_acte_marriage,'C');

$pdf->SetFont("helvetica", 'B', 12);
$pdf->SetXY(36,122);
$pdf->Cell(0, 25, $child_number,'C');


$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(55,135);
$pdf->Cell(0, 25, $prenom_nom_ar,'C');

$pdf->setRTL(false);
$pdf->SetFont("helvetica", 'B', 10);
$pdf->SetXY(118,140);
$pdf->Cell(0, 25, strtoupper($prenom_nom),'C');

$pdf->setRTL(true);

$pdf->SetFont("helvetica", 'B', 12);
$pdf->SetXY(49,145);
$pdf->Cell(0, 25, $numero_husband,'C');

$pdf->SetFont("helvetica", 'B', 12);
$pdf->SetXY(105,145);
$pdf->Cell(0, 25, $annee_husband,'C');


$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(42,151);
$pdf->Cell(0, 25, $date_naiss."  ".$date_naiss_num,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(33,156.25);
$pdf->Cell(0, 25, $lieu_naiss,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(33,161.75);
$pdf->Cell(0, 25, $profession,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(33,167.5);
$pdf->Cell(0, 25, $nationalite,'C');


$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(56,186.5);
$pdf->Cell(0, 25, $prenom_nom_ar_wife,'C');

$pdf->setRTL(false);
$pdf->SetFont("helvetica", 'B', 10);
$pdf->SetXY(117,191.5);
$pdf->Cell(0, 25, strtoupper($prenom_nom_wife),'C');


$pdf->setRTL(true);
$pdf->SetFont("helvetica", 'B', 12);
$pdf->SetXY(49,196);
$pdf->Cell(0, 25, $numero_wife,'C');

$pdf->SetFont("helvetica", 'B', 12);
$pdf->SetXY(103,196);
$pdf->Cell(0, 25, $annee_wife,'C');


$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(41,202);
$pdf->Cell(0, 25, $date_naiss_wife."  ".$date_naiss_num_wife,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35,208);
$pdf->Cell(0, 25, $lieu_naiss_wife,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35,213.25);
$pdf->Cell(0, 25, $profession_wife,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35,218.5);
$pdf->Cell(0, 25, $nationalite_wife,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(34,224);
$pdf->Cell(0, 25, $adress_wife,'C');


 ob_end_clean();
$pdf->Output();
