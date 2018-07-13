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

$fontname = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
date_default_timezone_set('UTC');
$ActualDate = date('d/m/Y');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);

$istinaf= $request["istinaf"];
$ibtidaayia= $request["ibtidaayia"];

$adad= $request["adad"];
$sahifa= $request["sahifa"];
$numero_sijil= $request["numero_sijil"];
$date_reference= $request["date_reference"];
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
$etat_familiale= $request["etat_familiale"];
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
$etat_familiale_wife= $request["etat_familiale_wife"];
$date_divorce= $request["date_divorce"];
$date_deces_marie= $request["date_deces_marie"];
$adress_wife= $request["adress_wife"];
$lieu_naiss_wife= $request["lieu_naiss_wife"];
$tora_ar= $request["tora_ar"];
$tora_fr= $request["tora_fr"];

/* IKHBAR ............................... */
if(isset($request["print_ikhbar"]))
{
  class Pdf extends Fpdi\TcpdfFpdi
  {  
      protected $tplId;  
      function Header()
      {
          if (is_null($this->tplId)) {
              $this->setSourceFile('imprimeModels/ikhbar_zawaj.pdf');
              $this->tplId = $this->importPage(1);
          }
          $size = $this->useImportedPage($this->tplId, -0 , 0, 215);
  
  
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

	// add a page
  $pdf->AddPage('P', 'A4');
$pdf->setRTL(true);
$pdf->SetFont($fontname, 'B', 10);
$pdf->SetXY(17, 6.25);
$pdf->Cell(0, 25, "المملكة المغربية",'C');

$pdf->SetXY(17, 10.25);
$pdf->Cell(0, 25, "وزارة الداخلية",'C');

$pdf->SetXY(17, 14.25);
$pdf->Cell(0, 25, "إقليم تارودانت",'C');

$pdf->SetXY(17, 18.25);
$pdf->Cell(0, 25, "دائرة تارودانت",'C');

$pdf->SetXY(17, 22.25);
$pdf->Cell(0, 25, "قيادة احمر",'C');

$pdf->SetXY(17, 26.25);
$pdf->Cell(0, 25, "جماعة زاوية سيدي الطاهر",'C');

$pdf->SetXY(17, 30.25);
$pdf->Cell(0, 25, "قطاع الحالة المدنية-المكتب المركزي",'C');


$pdf->SetFont($fontname, 'B', 16);
$pdf->SetXY(85, 111.5);
$pdf->Cell(0, 25, $prenom_nom_ar,'C');

$pdf->SetFont("helvetica", 'B', 14);
$pdf->SetXY(83, 120.5);
$pdf->Cell(0, 25, $numero_husband,'C');

$pdf->SetFont("helvetica", 'B', 14);
$pdf->SetXY(115, 120.5);
$pdf->Cell(0, 25, $annee_husband,'C');

$pdf->SetFont("helvetica", 'B', 11);
$pdf->SetXY(44, 127.5);
$pdf->Cell(0, 25, $date_naiss_num,'C');

$pdf->SetFont("helvetica", 'B', 11);
$pdf->SetXY(44, 127.5);
$pdf->Cell(0, 25, $date_naiss_num,'C');

$pdf->SetFont($fontname, 'B', 16);
$pdf->SetXY(88, 127.5);
$pdf->Cell(0, 25, $lieu_naiss,'C');

$pdf->SetFont($fontname, 'B', 16);
$pdf->SetXY(148, 127.5);
$pdf->Cell(0, 25, $profession,'C');

$pdf->SetFont($fontname, 'B', 16);
$pdf->SetXY(44, 137.5);
$pdf->Cell(0, 25, $nationalite,'C');

$pdf->SetFont($fontname, 'B', 16);
$pdf->SetXY(108, 137.5);
if($etat_familiale=="celeb")
{  
$pdf->Cell(0, 25, "عازب",'C');
}

if($etat_familiale=="marie")
{  
$pdf->Cell(0, 25, "متزوج",'C');
}

if($etat_familiale=="divorce")
{  
$pdf->Cell(0, 25, "مطلق",'C');
}

if($etat_familiale=="veuf")
{  
$pdf->Cell(0, 25, "أرمل",'C');
}

$pdf->SetFont($fontname, 'B', 14);
$pdf->SetXY(20, 144);
$pdf->Cell(0, 25, $adress,'C');

$pdf->SetFont($fontname, 'B', 14);
$pdf->SetXY(90, 144);
$pdf->Cell(0, 25, $prenom_nom_ar_wife,'C');


$pdf->SetFont("helvetica", 'B', 14);
$pdf->SetXY(20, 150);
$pdf->Cell(0, 25, $numero_wife,'C');

$pdf->SetFont("helvetica", 'B', 13);
$pdf->SetXY(70, 150);
$pdf->Cell(0, 25, $annee_wife,'C');


$pdf->SetFont("helvetica", 'B', 13);
$pdf->SetXY(115, 150);
$pdf->Cell(0, 25, $date_naiss_num_wife,'C');


$pdf->SetFont($fontname, 'B', 14);
$pdf->SetXY(20, 157.5);
$pdf->Cell(0, 25, $lieu_naiss_wife,'C');

$pdf->SetFont($fontname, 'B', 14);
$pdf->SetXY(85, 157.5);
$pdf->Cell(0, 25, $profession_wife,'C');


$pdf->SetFont($fontname, 'B', 15);
$pdf->SetXY(145, 157.5);
$pdf->Cell(0, 25, $nationalite_wife,'C');

$pdf->SetFont($fontname, 'B', 16);
$pdf->SetXY(55, 166.5);

if($etat_familiale_wife=="celeb_wife")
{
  $pdf->Cell(0, 25, "بكر ",'C');
}

if($etat_familiale_wife=="divorce_wife")
{
  $pdf->Cell(0, 25, "مطلقة ",'C');
}


if($etat_familiale_wife=="veuf_wife")
{
  $pdf->Cell(0, 25, "أرملة ",'C');
}

$pdf->SetFont($fontname, 'B', 16);
$pdf->SetXY(108, 166.5);
$pdf->Cell(0, 25, $adress_wife,'C');


/*$pdf->SetFont("helvetica", 'B', 14);
$pdf->SetXY(45, 175.5);
$pdf->Cell(0, 25, "rasm ",'C');*/


$pdf->SetFont("helvetica", 'B', 14);
$pdf->SetXY(110, 175.5);
$pdf->Cell(0, 25, $adad,'C');


$pdf->SetFont("helvetica", 'B', 14);
$pdf->SetXY(160, 175.5);
$pdf->Cell(0, 25, $sahifa,'C');

$pdf->SetFont("helvetica", 'B', 14);
$pdf->SetXY(35, 185);
$pdf->Cell(0, 25, $date_avis,'C');


$pdf->SetFont("helvetica", 'B', 14);
$pdf->SetXY(85, 185);
$pdf->Cell(0, 25, $numero_sijil,'C');




}


/* AVIS *********************************************************** */
if(isset($request["print_avis"]))
{
  class Pdf extends Fpdi\TcpdfFpdi
{

    protected $tplId;

    function Header()
    {
        if (is_null($this->tplId)) {
            $this->setSourceFile('imprimeModels/bayane_zawaj.pdf');
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





if(isset($request["id_avis_mariage"]))
{
  //update values

  $query = "UPDATE `avis_mariage` SET `tribunal_istinaf`=?,`tribunal_ibtidaia`=?,`adad`=?,`sahifa`=?,`date`=?,`numero_sijil`=?,`type_rasm`=?,`tarikh_rasm`=?,`nom_epoux_ar`=?,`nom_epoux`=?,`numero_epoux`=?,`annee_epoux`=?,`date_naiss_epoux`=?,`date_naiss_epoux_num`=?,`lieu_naiss_epoux`=?,`profession_epoux`=?,`nationalite_epoux`=?,`etat_familiale_epoux`=?,`adresse_epoux`=?,`nom_epouse_ar`=?,`nom_epouse`=?,`numero_epouse`=?,`annee_epouse`=?,`date_naiss_epouse`=?,`date_naiss_epouse_num`=?,`lieu_naiss_epouse`=?,`profession_epouse`=?,`nationalite_epouse`=?,`etat_familiale`=?,`date_divorce`=?,`date_deces_epoux`=?,`adress_epouse`=? WHERE `id_avis_mariage`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($istinaf,$ibtidaayia,$adad,$sahifa,$date_reference,$numero_sijil,$categorie_avis,$date_avis,$prenom_nom_ar,$prenom_nom,$numero_husband,$annee_husband,$date_naiss,$date_naiss_num,$lieu_naiss,$profession,$nationalite,$etat_familiale,$adress,$prenom_nom_ar_wife,$prenom_nom_wife,$numero_wife,$annee_wife,$date_naiss_wife,$date_naiss_num_wife,$lieu_naiss_wife,$profession_wife,$nationalite_wife,$etat_familiale_wife,$date_divorce,$date_deces_marie,$adress_wife,$request["id_avis_mariage"]));
}else
{
  //insert avis in database
$query = "INSERT INTO `avis_mariage`(`tribunal_istinaf`, `tribunal_ibtidaia`, `adad`, `sahifa`, `date`, `numero_sijil`, `type_rasm`, `tarikh_rasm`, `nom_epoux_ar`, `nom_epoux`, `numero_epoux`, `annee_epoux`, `date_naiss_epoux`,`date_naiss_epoux_num`, `lieu_naiss_epoux`, `profession_epoux`, `nationalite_epoux`, `etat_familiale_epoux`, `adresse_epoux`, `nom_epouse_ar`, `nom_epouse`, `numero_epouse`, `annee_epouse`, `date_naiss_epouse`,`date_naiss_epouse_num`, `lieu_naiss_epouse`, `profession_epouse`, `nationalite_epouse`, `etat_familiale`, `date_divorce`, `date_deces_epoux`, `adress_epouse`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($istinaf,$ibtidaayia,$adad,$sahifa,$date_reference,$numero_sijil,$categorie_avis,$date_avis,$prenom_nom_ar,$prenom_nom,$numero_husband,$annee_husband,$date_naiss,$date_naiss_num,$lieu_naiss,$profession,$nationalite,$etat_familiale,$adress,$prenom_nom_ar_wife,$prenom_nom_wife,$numero_wife,$annee_wife,$date_naiss_wife,$date_naiss_num_wife,$lieu_naiss_wife,$profession_wife,$nationalite_wife,$etat_familiale_wife,$date_divorce,$date_deces_marie,$adress_wife));
}









if(isset($numero_husband) && isset($annee_husband))
{
  //insert in time Stamp table
  $query = "INSERT INTO `timep_stamp_table`(`numero`, `annee`, `sex`, `type`) VALUES (?,?,'masculin','zawaj')";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute(array($numero_husband,$annee_husband));

  //insert in torar
  $query = "INSERT INTO `torabirth`(`numero`, `annee`, `content_ar`, `content_fr`) VALUES (?,?,?,?)";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute(array($numero_husband,$annee_husband,$tora_ar,$tora_fr));
}


if(isset($numero_wife) && isset($annee_wife))
{
  $query = "INSERT INTO `timep_stamp_table`(`numero`, `annee`, `sex`, `type`) VALUES (?,?,'feminin','zawaj')";
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


$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 16.25);
$pdf->Cell(0, 25, "تارودانت",'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 24.25);
$pdf->Cell(0, 25, "تارودانت",'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 32.25);
$pdf->Cell(0, 25, "جماعة زواية سيدي الطاهر " ,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(38, 55.25);
$pdf->Cell(0, 25, $istinaf ,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(38, 63.25);
$pdf->Cell(0, 25, $ibtidaayia ,'C');


$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 79.25);
$pdf->Cell(0, 25, $adad ,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 87.25);
$pdf->Cell(0, 25, $sahifa ,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 94.25);
$pdf->Cell(0, 25, $date_reference ,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(35, 101.25);
$pdf->Cell(0, 25, $numero_sijil ,'C');




if($categorie_avis=="marriage")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(40.5,109.5);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

if($categorie_avis=="tobout")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(79.5,109.5);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

if($categorie_avis=="morajaa")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(105.5,109.5);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

if($categorie_avis=="rijaa")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(127.5,109.5);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}


$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(34,118);
$pdf->Cell(0, 25, $date_avis,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(56,134);
$pdf->Cell(0, 25, $prenom_nom_ar,'C');

$pdf->setRTL(false);
$pdf->SetFont("helvetica", 'B', 10);
$pdf->SetXY(126,141);
$pdf->Cell(0, 25, strtoupper($prenom_nom),'C');

$pdf->setRTL(true);

$pdf->SetFont("helvetica", 'B', 12);
$pdf->SetXY(47,148);
$pdf->Cell(0, 25, $numero_husband,'C');

$pdf->SetFont("helvetica", 'B', 12);
$pdf->SetXY(97,148);
$pdf->Cell(0, 25, $annee_husband,'C');


$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(33,155.5);
$pdf->Cell(0, 25, $date_naiss."  ".$date_naiss_num,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(33,162);
$pdf->Cell(0, 25, $lieu_naiss,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(33,169);
$pdf->Cell(0, 25, $profession,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(33,176);
$pdf->Cell(0, 25, $nationalite,'C');


if($etat_familiale=="celeb")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(43,182);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}


if($etat_familiale=="divorce")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(70,182);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

if($etat_familiale=="veuf")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(102,182);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

if($etat_familiale=="marie")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(129,182);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}


$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(56,204.5);
$pdf->Cell(0, 25, $prenom_nom_ar_wife,'C');

$pdf->setRTL(false);
$pdf->SetFont("helvetica", 'B', 10);
$pdf->SetXY(126,211);
$pdf->Cell(0, 25, strtoupper($prenom_nom_wife),'C');


$pdf->setRTL(true);
$pdf->SetFont("helvetica", 'B', 12);
$pdf->SetXY(47,218);
$pdf->Cell(0, 25, $numero_wife,'C');

$pdf->SetFont("helvetica", 'B', 12);
$pdf->SetXY(97,218);
$pdf->Cell(0, 25, $annee_wife,'C');


$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(33,225.5);
$pdf->Cell(0, 25, $date_naiss_wife."  ".$date_naiss_num_wife,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(33,232);
$pdf->Cell(0, 25, $lieu_naiss_wife,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(33,239);
$pdf->Cell(0, 25, $profession_wife,'C');

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(33,246);
$pdf->Cell(0, 25, $nationalite_wife,'C');



if($etat_familiale_wife=="celeb_wife")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(67,252.25);
  $pdf->Cell(0, 25, ucwords("X"),'C');
}

if($etat_familiale_wife=="divorce_wife")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(67,257.25);
  $pdf->Cell(0, 25, ucwords("X"),'C');

  $pdf->SetFont($fontname, 'B', 11);
  $pdf->SetXY(108,257);
  $pdf->Cell(0, 25, $date_divorce,'C');
}

if($etat_familiale_wife=="veuf_wife")
{
  $pdf->SetFont("helvetica", 'B', 12);
  $pdf->SetXY(67,262.25);
  $pdf->Cell(0, 25, ucwords("X"),'C');

  $pdf->SetFont($fontname, 'B', 11);
  $pdf->SetXY(108,262.25);
  $pdf->Cell(0, 25, $date_deces_marie,'C');
}

$pdf->SetFont($fontname, 'B', 12);
$pdf->SetXY(34,268);
$pdf->Cell(0, 25, $adress_wife,'C');
}

 ob_end_clean();
$pdf->Output();
