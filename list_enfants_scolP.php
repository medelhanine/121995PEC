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
            $this->setSourceFile('imprimeModels/enfant_scolarise.pdf');
            $this->tplId = $this->importPage(1);
        }
        $size = $this->useImportedPage($this->tplId, -1 , -0,300);
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
$annee_scol = $request["annee_scol"];
//$annee_scol = 2012;
	// add a page
$pdf->AddPage('L', 'A4');
//$cin=$_POST["cin"];
date_default_timezone_set('UTC');
$ActualDate = date('d/m/Y');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);
$pdoResult;
$fontname = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
$pdf->setRTL(true);
//numero
$pdf->SetFont("helvetica", 'B', 14);
$pdf->SetXY(224, 11.5);
$pdf->Cell(0, 25, $annee_scol."/".($annee_scol+1),'C');//$annee_scol."/".($annee_scol+1)

$pdf->SetFont("helvetica", 'B', 13.5);
$pdf->SetXY(179, 17);
$pdf->Cell(0, 25, "01/04/".($annee_scol-6),'C');//$annee_scol."/".($annee_scol+1)

$pdf->SetFont("helvetica", 'B', 13.5);
$pdf->SetXY(212, 17);
$pdf->Cell(0, 25, "31/03/".($annee_scol-5),'C');//$annee_scol."/".($annee_scol+1)

$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);
$fontnameBody = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));




$query="SELECT * FROM `sbirth` WHERE STR_TO_DATE(`date_naiss_miladi`,'%Y/%m/%d') > STR_TO_DATE(?,'%Y/%m/%d') AND STR_TO_DATE(`date_naiss_miladi`,'%Y/%m/%d') < STR_TO_DATE(?,'%Y/%m/%d')";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array(($annee_scol-6).'/04/01',($annee_scol-5).'/03/31'));
	$result=$pdoResult->fetchAll();

	if($pdoResult->rowCount()>0)
{
    $j=1;
    $y=66.25;
    foreach($result as $row)
    {
        

        $pdf->SetFont("helvetica", 'B', 9);
        $pdf->SetXY(11, $y);
        $pdf->MultiCell(14, 6,$j , 1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont("helvetica", 'B', 9);
        $pdf->SetXY(25, $y);
        $pdf->MultiCell(20.25, 6, $row["numero"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(45.25, $y);
        $pdf->MultiCell(22.5, 6,"ز.سيدي الطاهر",1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(67.75, $y);
        $pdf->MultiCell(17.75, 6, "ز.سيدي الطاهر",1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont("helvetica", 'B', 9);
        $pdf->SetXY(85.5, $y);
        $pdf->MultiCell(31, 6, $row["nom"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont("helvetica", 'B', 8);
        $pdf->SetXY(116.5, $y);                 
        $pdf->MultiCell(24.75, 6, $row["prenom"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont($fontnameBody, 'B', 8);
        $pdf->SetXY(141.25, $y);
        $pdf->MultiCell(22.75, 6, $row["nom_ar"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(164, $y);
        $pdf->MultiCell(22.5, 6, $row["prenom_ar"],1, 'C', 0, 0, '', '', true);

        if($row["sex"]=="feminin")
        {
            $pdf->SetFont($fontnameBody, 'B', 9);
            $pdf->SetXY(186.5, $y);
        $pdf->MultiCell(14.25, 6, "أنثى",1, 'C', 0, 0, '', '', true);
        }else{
            $pdf->SetFont($fontnameBody, 'B', 9);
            $pdf->SetXY(186.5,$y);
        $pdf->MultiCell(14.25, 6, "ذكر",1, 'C', 0, 0, '', '', true);
        }
        
        
        $pdf->SetFont("helvetica", 'B', 9);
        $pdf->SetXY(200.75, $y);
        $pdf->MultiCell(23.75, 6, $row["date_naiss_miladi"],1, 'C', 0, 0, '', '', true);

        $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(224.5, $y);
        $pdf->MultiCell(20.25, 6, $row["lieu_naiss_ar"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(244.5, $y);
        $pdf->MultiCell(23, 6, $row["adresse_parent_ar"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(267.5, $y);
        $pdf->MultiCell(25.25, 6, $row["nom_pere_ar"],1, 'C', 0, 0, '', '', true);


        $y = $y+6;
        $j++;

        if($y>190)
        {
           
            $y=66.25;
            $pdf->AddPage('L', 'A4');
           
            $pdf->SetFont("helvetica", 'B', 14);
            $pdf->SetXY(224, 11.5);
            $pdf->Cell(0, 25, $annee_scol."/".($annee_scol+1),'C');//$annee_scol."/".($annee_scol+1)

            $pdf->SetFont("helvetica", 'B', 13.5);
            $pdf->SetXY(179, 17);
            $pdf->Cell(0, 25, "01/04/".($annee_scol-6),'C');//$annee_scol."/".($annee_scol+1)

            $pdf->SetFont("helvetica", 'B', 13.5);
            $pdf->SetXY(212, 17);
            $pdf->Cell(0, 25, "31/03/".($annee_scol-5),'C');//$annee_scol."/".($annee_scol+1)

            //body
            $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(11, $y);
        $pdf->MultiCell(14, 6,$j , 1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont("helvetica", 'B', 9);
        $pdf->SetXY(25, $y);
        $pdf->MultiCell(20.25, 6, $row["numero"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(45.25, $y);
        $pdf->MultiCell(22.5, 6,"ز.سيدي الطاهر",1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(67.75, $y);
        $pdf->MultiCell(17.75, 6, "ز.سيدي الطاهر",1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont("helvetica", 'B', 8);
        $pdf->SetXY(85.5, $y);
        $pdf->MultiCell(31, 6, $row["nom"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont("helvetica", 'B', 8);
        $pdf->SetXY(116.5, $y);                 
        $pdf->MultiCell(24.75, 6, $row["prenom"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(141.25, $y);
        $pdf->MultiCell(22.75, 6, $row["nom_ar"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(164, $y);
        $pdf->MultiCell(22.5, 6, $row["prenom_ar"],1, 'C', 0, 0, '', '', true);

        if($row["sex"]=="feminin")
        {
            $pdf->SetXY(186.5, $y);
        $pdf->MultiCell(14.25, 6, "أنثى",1, 'C', 0, 0, '', '', true);
        }else{
            $pdf->SetXY(186.5,$y);
        $pdf->MultiCell(14.25, 6, "ذكر",1, 'C', 0, 0, '', '', true);
        }
        
        
        $pdf->SetFont("helvetica", 'B', 9);
        $pdf->SetXY(200.75, $y);
        $pdf->MultiCell(23.75, 6, $row["date_naiss_miladi"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetFont($fontnameBody, 'B', 9);
        $pdf->SetXY(224.5, $y);
        $pdf->MultiCell(20.25, 6, $row["lieu_naiss_ar"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetXY(244.5, $y);
        $pdf->MultiCell(23, 6, $row["adresse_parent_ar"],1, 'C', 0, 0, '', '', true);
        
        $pdf->SetXY(267.5, $y);
        $pdf->MultiCell(25.25, 6, $row["nom_pere_ar"],1, 'C', 0, 0, '', '', true);

        $y +=6;
        $j++;
        }
    }
     
}else{
    $pdf->SetFont($fontname, 'B', 11);
    $pdf->SetXY(11, 66.25);
    $pdf->MultiCell(14, 6,"//" , 1, 'C', 0, 0, '', '', true);
    
    $pdf->SetFont($fontname, 'B', 11);
    $pdf->SetXY(25, 66.25);
    $pdf->MultiCell(20.25, 6, "لا أحد",1, 'C', 0, 0, '', '', true);    
    
    $pdf->SetXY(45.25, 66.25);
    $pdf->MultiCell(22.5, 6,"لا أحد",1, 'C', 0, 0, '', '', true);
    
    $pdf->SetXY(67.75, 66.25);
    $pdf->MultiCell(17.75, 6, "لا أحد",1, 'C', 0, 0, '', '', true);
    
    $pdf->SetXY(85.5, 66.25);
    $pdf->MultiCell(31, 6, "لا أحد",1, 'C', 0, 0, '', '', true);
    
    $pdf->SetXY(116.5, 66.25);
    $pdf->MultiCell(24.75, 6, "لا أحد",1, 'C', 0, 0, '', '', true);
    
    $pdf->SetXY(141.25, 66.25);
    $pdf->MultiCell(22.75, 6, "لا أحد",1, 'C', 0, 0, '', '', true);
    
    $pdf->SetXY(164,66.25);
    $pdf->MultiCell(22.5, 6, "لا أحد",1, 'C', 0, 0, '', '', true);

    
    $pdf->SetXY(186.5, 66.25);
    $pdf->MultiCell(14.25, 6, "لا أحد",1, 'C', 0, 0, '', '', true); 
    
    
    $pdf->SetXY(200.75, 66.25);
    $pdf->MultiCell(23.75, 6, "لا أحد",1, 'C', 0, 0, '', '', true);
    
    $pdf->SetXY(224.5, 66.25);
    $pdf->MultiCell(20.25, 6, "لا أحد",1, 'C', 0, 0, '', '', true);
    
    $pdf->SetXY(244.5, 66.25);
    $pdf->MultiCell(23, 6, "لا أحد",1, 'C', 0, 0, '', '', true);
    
    $pdf->SetXY(267.5,66.25);
    $pdf->MultiCell(25.25, 6, "لا أحد",1, 'C', 0, 0, '', '', true);
}

 ob_end_clean();
$pdf->Output();
