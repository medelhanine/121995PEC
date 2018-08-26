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

date_default_timezone_set('UTC');
$ActualDate = date('Y/m/d');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);
$query='';
$pdoResult;
// set some language dependent data:
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';
//convert months number to letter

$language= $request["language"];
$numero_certificat= $request["numero_certificat"];
$numero_mokadam_cheikh= $request["numero_mokadam_cheikh"];
$date_certficat= $request["date_certficat"];
$mokadam_cheikh= $request["mokadam_cheikh"];
$mokadam_cheikh_ar= $request["mokadam_cheikh_ar"];


$prenom_pere_ar= $request["prenom_pere_ar"];
$prenom_pere= $request["prenom_pere"];

  $query = "INSERT INTO `timep_stamp_table`( `type`) VALUES ('vie_collect_individ')";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute();



//put all the text data in variable to be easy in manipulation in multi cell

$western_arabic = array('01','02','03','04','05','06','07','08','09','10','11','12');
$eastern_arabic = array('يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليوز','غشت','شتنبر','أكتوبر','نونبر','دجنبر');
if($language =="ar") //ARabic*******************************
{
  class Pdf extends Fpdi\TcpdfFpdi
  {
      protected $tplId;

      function Header()
      {
          if (is_null($this->tplId)) {
              $this->setSourceFile('imprimeModels/vie_collective_ar.pdf');
              $this->tplId = $this->importPage(1);
          }
          $size = $this->useImportedPage($this->tplId,-3 , -3, 215);
      }
  }

  // initiate PDF
  ob_start();
  $pdf = new Pdf();
  $pdf->SetAutoPageBreak(true, 1);
  // set some language-dependent strings (optional)
  $pdf->setLanguageArray($lg);
  //some queries with db
  $fontname = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
  	// add a page
  $pdf->AddPage('P', 'A4');
  //$cin=$_POST["cin"];

  //trace
$pdf->setRTL(false);
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(147, 35);

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



}else {
    $pdf->setRTL(false);
    $pdf->Cell(0,0,strtoupper(substr($result2["prenom_delegue"],0,1).substr($result2["nom_delegue"],0,1)),0,0,'L',0,'');
    $pdf->StopTransform();


}
    }

  //pour les donnees en arabe
  $pdf->setRTL(true);
  //numero
  // convert TTF font to TCPDF format and store it on the fonts folder
  $pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY(39, 37);
$pdf->Cell(0, 25, $numero_certificat,'C');

$pdf->SetFont($fontname,'B',14);
$pdf->SetXY(13, 68.5);
$pdf->Cell(0, 25, $mokadam_cheikh_ar,'C');

$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetXY(105, 68.5);
$pdf->Cell(0, 25, $numero_mokadam_cheikh,'C');

$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetXY(140, 68.5);
$pdf->Cell(0, 25, $date_certficat,'C');


$pdf->SetFont($fontname,'B',16);
$pdf->SetXY(92, 80);
$pdf->Cell(0, 25, $prenom_pere_ar,'C');



$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(110, 236);
$pdf->Cell(0, 25, $ActualDate,'C');


$j=0;
$t=0;
$i=1;


	while(isset($request["child_prenom_ar".$i]))
	{
		if($i<=16)
		{
      //si le nombre est impaire // a droite
      if($i%2==1)
      {
        $pdf->SetFont($fontname,'B',14);
        $pdf->SetXY(48,92+23*$j);
        $pdf->Cell(0, 25, $request["child_prenom_ar".$i],'C');

        $pdf->SetXY(48,96.5+23*$j);
        $pdf->Cell(0, 25,$request["child_nom_ar".$i] ,'C');

        $pdf->SetFont('helvetica','B',9);
        $pdf->SetXY(48,100.5+23*$j);
        $pdf->Cell(0, 25,$request["child_date_naiss".$i] ,'C');

        $pdf->SetFont($fontname,'B',14);
        $pdf->SetXY(48,105+23*$j);
        $pdf->Cell(0, 25,$request["child_lieu_naiss_ar".$i] ,'C');
        $j++;
      }
      //si le nombre est impaire  à gauche
      if($i%2==0)
      {
        $pdf->SetFont($fontname,'B',14);
        $pdf->SetXY(141,92+23*$t);
        $pdf->Cell(0, 25,  $request["child_prenom_ar".$i],'C');

        $pdf->SetXY(141,96.5+23*$t);
        $pdf->Cell(0, 25,  $request["child_nom_ar".$i],'C');

        $pdf->SetFont('helvetica','B',9);
        $pdf->SetXY(141,100.5+23*$t);
        $pdf->Cell(0, 25,$request["child_date_naiss".$i] ,'C');

        $pdf->SetFont($fontname,'B',14);
        $pdf->SetXY(141,105.5+23*$t);
        $pdf->Cell(0, 25,$request["child_lieu_naiss_ar".$i] ,'C');
        $t++;
      }
		}
		$i++;

	}

  //fill the rest of child with "////"

/*  while($i<11)
	{
      //si le nombre est impaire // a droite
      if($i%2==1)
      {
        $pdf->SetFont('helvetica','B',10);
        $pdf->SetXY(48,92.5+23*$j);
        $pdf->Cell(0, 25, "///////",'C');


        $pdf->SetXY(48,97.5+23*$j);
        $pdf->Cell(0, 25,"///////" ,'C');


        $pdf->SetXY(48,102+23*$j);
        $pdf->Cell(0, 25,"///////",'C');


        $pdf->SetXY(48,106.5+23*$j);
        $pdf->Cell(0, 25,"///////" ,'C');
        $j++;
      }
      //si le nombre est impaire  à gauche
      if($i%2==0)
      {
        $pdf->SetFont('helvetica','B',10);
        $pdf->SetXY(141,92+23*$t);
        $pdf->Cell(0, 25, "///////",'C');

        $pdf->SetXY(141,96.5+23*$t);
        $pdf->Cell(0, 25, "///////",'C');


        $pdf->SetXY(141,100.5+23*$t);
        $pdf->Cell(0, 25,"///////" ,'C');


        $pdf->SetXY(141,105+23*$t);
        $pdf->Cell(0, 25,"///////" ,'C');
        $t++;
      }


		$i++;

	}*/



}

if($language=="fr") { //francais*******************************/////////////////////////////////
  class Pdf extends Fpdi\TcpdfFpdi
  {
      protected $tplId;

      function Header()
      {
          if (is_null($this->tplId)) {
              $this->setSourceFile('imprimeModels/vie_collective_fr.pdf');
              $this->tplId = $this->importPage(1);
          }
          $size = $this->useImportedPage($this->tplId,-3 , -3, 215);
      }
  }

  // initiate PDF
  ob_start();
  $pdf = new Pdf();
  $pdf->SetAutoPageBreak(true, 1);
  // set some language-dependent strings (optional)
  $pdf->setLanguageArray($lg);
  //some queries with db
  $fontname = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
  	// add a page
  $pdf->AddPage('P', 'A4');
  //$cin=$_POST["cin"];

  //pour les donnees en arabe
  $pdf->setRTL(false);


  $pdf->SetFont('helvetica', 'B', 11);
$pdf->SetXY(63, 41);
$pdf->Cell(0, 25, $numero_certificat,'C');

$pdf->SetFont('helvetica','B',12);
$pdf->SetXY(68, 69);
$pdf->Cell(0, 25, ucwords($mokadam_cheikh),'C');

$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetXY(167, 69);
$pdf->Cell(0, 25, $numero_mokadam_cheikh,'C');

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(50, 74);
$pdf->Cell(0, 25, $date_certficat,'C');


$pdf->SetFont('helvetica','B',15);
$pdf->SetXY(84, 90.25);
$pdf->Cell(0, 25, ucwords($prenom_pere),'C');



$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(75, 260);
$pdf->Cell(0, 25, $ActualDate,'C');


$j=0;
$t=0;
$i=1;

	while(isset($request["child_prenom_ar".$i]))
	{
		if($i<=16)
		{

      //si le nombre est impaire // a droite
      if($i%2==1)
      {
        $pdf->SetFont('helvetica','B',11);
        $pdf->SetXY(43,99+26*$j);
        $pdf->Cell(0, 25, ucwords($request["child_prenom".$i]),'C');


        $pdf->SetXY(43,104.5+26*$j);
        $pdf->Cell(0, 25,ucwords($request["child_nom".$i]) ,'C');

        $pdf->SetFont('helvetica','B',10);
        $pdf->SetXY(43,110+26*$j);
        $pdf->Cell(0, 25,$request["date_naiss".$i] ,'C');

        $pdf->SetFont('helvetica','B',11);
        $pdf->SetXY(43,115+26*$j);
        $pdf->Cell(0, 25,ucwords($request["child_lieu_naiss".$i]) ,'C');
        $j++;
      }
      //si le nombre est impaire  à gauche
      if($i%2==0)
      {
        $pdf->SetFont('helvetica','B',11);
        $pdf->SetXY(137,99+26*$t);
        $pdf->Cell(0, 25, ucwords($request["child_prenom".$i]),'C');


        $pdf->SetXY(137,104.5+26*$t);
        $pdf->Cell(0, 25,ucwords($request["child_nom".$i]) ,'C');

        $pdf->SetFont('helvetica','B',10);
        $pdf->SetXY(137,110+26*$t);
        $pdf->Cell(0, 25,$request["date_naiss".$i] ,'C');

        $pdf->SetFont('helvetica','B',11);
        $pdf->SetXY(137,115.5+26*$t);
        $pdf->Cell(0, 25,ucwords($request["child_lieu_naiss".$i]) ,'C');
        $t++;
      }
		}
		$i++;

	}

}

//Billingue /////////////////////////////////////////////////////////////////////////////////
// iterate through all pages
if($language =="ar_fr")
{
class Pdf extends Fpdi\TcpdfFpdi
{
    protected $tplId;
}
ob_start();
// initiate PDF
$pdf = new Pdf();
$pageCount = $pdf->setSourceFile('imprimeModels\vie_collective_billingue.pdf');
  $fontname = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetAutoPageBreak(true, 1);
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    // import a page
    $templateId = $pdf->importPage($pageNo);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
    $pdf->AddPage('P', 'A4');
    // arabe VERSION**********************************************************************
    if($pageNo==1)
    {
      $lg = Array();
      $lg['a_meta_charset'] = 'UTF-8';
      $lg['a_meta_dir'] = 'rtl';
      $lg['a_meta_language'] = 'fa';
      $lg['w_page'] = 'page';
      $pdf->setLanguageArray($lg);
      $size = $pdf->useImportedPage($templateId, -3 , -3, 215);
      //pour les donnees en arabe
      $pdf->setRTL(true);
      //numero
      // convert TTF font to TCPDF format and store it on the fonts folder
      $pdf->SetFont('helvetica', 'B', 9);
    $pdf->SetXY(39, 37);
    $pdf->Cell(0, 25, $numero_certificat,'C');

    $pdf->SetFont($fontname,'B',14);
    $pdf->SetXY(13, 68.5);
    $pdf->Cell(0, 25, $mokadam_cheikh_ar,'C');

    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->SetXY(105, 68.5);
    $pdf->Cell(0, 25, $numero_mokadam_cheikh,'C');

    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->SetXY(140, 68.5);
    $pdf->Cell(0, 25, $date_certficat,'C');


    $pdf->SetFont($fontname,'B',16);
    $pdf->SetXY(92, 80);
    $pdf->Cell(0, 25, $prenom_pere_ar,'C');



    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(110, 236);
    $pdf->Cell(0, 25, $ActualDate,'C');


    $j=0;
    $t=0;
    $i=1;

    	while(isset($request["child_prenom_ar".$i]))
    	{
    		if($i<=16)
    		{

          //si le nombre est impaire // a droite
          if($i%2==1)
          {
            $pdf->SetFont($fontname,'B',14);
            $pdf->SetXY(48,92+23*$j);
            $pdf->Cell(0, 25, $request["child_prenom_ar".$i],'C');


            $pdf->SetXY(48,96.5+23*$j);
            $pdf->Cell(0, 25,$request["child_nom_ar".$i] ,'C');

            $pdf->SetFont('helvetica','B',9);
            $pdf->SetXY(48,100.5+23*$j);
            $pdf->Cell(0, 25,$request["date_naiss".$i] ,'C');

            $pdf->SetFont($fontname,'B',14);
            $pdf->SetXY(48,105+23*$j);
            $pdf->Cell(0, 25,$request["child_lieu_naiss_ar".$i] ,'C');
            $j++;
          }
          //si le nombre est impaire  à gauche
          if($i%2==0)
          {
            $pdf->SetFont($fontname,'B',14);
            $pdf->SetXY(141,92+23*$t);
            $pdf->Cell(0, 25,  $request["child_prenom_ar".$i],'C');

            $pdf->SetXY(141,96.5+23*$t);
            $pdf->Cell(0, 25,  $request["child_nom_ar".$i],'C');

            $pdf->SetFont('helvetica','B',9);
            $pdf->SetXY(141,100.5+23*$t);
            $pdf->Cell(0, 25,$request["date_naiss".$i] ,'C');

            $pdf->SetFont($fontname,'B',14);
            $pdf->SetXY(141,105.5+23*$t);
            $pdf->Cell(0, 25,$request["child_lieu_naiss_ar".$i] ,'C');
            $t++;
          }
    		}
    		$i++;

    	}

    }

    // FRANCAIS VERSION**********************************************************************
    if($pageNo==2)
    {
      // set some language dependent data:

        $size = $pdf->useImportedPage($templateId, -3 , -3, 215);

        $pdf->setRTL(false);
        $pdf->SetFont('helvetica', 'B', 11);
      $pdf->SetXY(63, 41);
      $pdf->Cell(0, 25, $numero_certificat,'C');

      $pdf->SetFont('helvetica','B',12);
      $pdf->SetXY(68, 69);
      $pdf->Cell(0, 25, ucwords($mokadam_cheikh),'C');

      $pdf->SetFont('helvetica', 'B', 11);
      $pdf->SetXY(167, 69);
      $pdf->Cell(0, 25, $numero_mokadam_cheikh,'C');

      $pdf->SetFont('helvetica', 'B', 10);
      $pdf->SetXY(50, 74);
      $pdf->Cell(0, 25, $date_certficat,'C');


      $pdf->SetFont('helvetica','B',15);
      $pdf->SetXY(84, 90.25);
      $pdf->Cell(0, 25, ucwords($prenom_pere),'C');



      $pdf->SetFont('helvetica', 'B', 10);
      $pdf->SetXY(75, 260);
      $pdf->Cell(0, 25, $ActualDate,'C');


      $j=0;
      $t=0;
      $i=1;

      while(isset($request["child_prenom_ar".$i]))
      {
        if($i<=16)
        {

          //si le nombre est impaire // a droite
          if($i%2==1)
          {
            $pdf->SetFont('helvetica','B',11);
            $pdf->SetXY(43,99+26*$j);
            $pdf->Cell(0, 25, ucwords($request["child_prenom".$i]),'C');


            $pdf->SetXY(43,104.5+26*$j);
            $pdf->Cell(0, 25,ucwords($request["child_nom".$i]) ,'C');

            $pdf->SetFont('helvetica','B',10);
            $pdf->SetXY(43,110+26*$j);
            $pdf->Cell(0, 25,$request["date_naiss".$i] ,'C');

            $pdf->SetFont('helvetica','B',11);
            $pdf->SetXY(43,115+26*$j);
            $pdf->Cell(0, 25,ucwords($request["child_lieu_naiss".$i]) ,'C');
            $j++;
          }
          //si le nombre est impaire  à gauche
          if($i%2==0)
          {
            $pdf->SetFont('helvetica','B',11);
            $pdf->SetXY(137,99+26*$t);
            $pdf->Cell(0, 25, ucwords($request["child_prenom".$i]),'C');


            $pdf->SetXY(137,104.5+26*$t);
            $pdf->Cell(0, 25,ucwords($request["child_nom".$i]) ,'C');

            $pdf->SetFont('helvetica','B',10);
            $pdf->SetXY(137,110+26*$t);
            $pdf->Cell(0, 25,$request["date_naiss".$i] ,'C');

            $pdf->SetFont('helvetica','B',11);
            $pdf->SetXY(137,115.5+26*$t);
            $pdf->Cell(0, 25,ucwords($request["child_lieu_naiss".$i]) ,'C');
            $t++;
          }
        }
        $i++;

      }


    }

    }


}



ob_end_clean();
$pdf->Output();
