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
    $numero  = $_SESSION['numero'];
    $annee  = $_SESSION['annee'];
    $id_user = $_SESSION['id_user'];
    //$superUser = $_SESSION['superUser'];
}
use setasign\Fpdi;

require_once('vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('vendor/setasign/fpdi/src/autoload.php');
// set some language dependent data:
  $lg = Array();
  $lg['a_meta_charset'] = 'UTF-8';
  $lg['a_meta_dir'] = 'rtl';
  $lg['a_meta_language'] = 'fa';
  $lg['w_page'] = 'page';


date_default_timezone_set('UTC');
$ActualDate = date('Y/m/d');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);

$numero_mokadam_ar= $request["numero_mokadam_ar"];
$numero_certificat_ar= $request["numero_certificat_ar"];
$date_certficat_ar= $request["date_certficat_ar"];
$mokadam_cheikh_ar= $request["mokadam_cheikh_ar"];
$cine_ar= $request["cine_ar"];
$domicile_ar= $request["domicile_ar"];
$numero_certificat_fr= $request["numero_certificat_fr"];
$numero_mokadam_fr= $request["numero_mokadam_fr"];
$date_certficat_fr= $request["date_certficat_fr"];
$mokadam_cheikh_fr= $request["mokadam_cheikh_fr"];
$cine_fr= $request["cine_fr"];
$domicile_fr= $request["domicile_fr"];
$numero_certificatB= $request["numero_certificatB"];
$numero_mokadamB= $request["numero_mokadamB"];
$date_certficatB= $request["date_certficatB"];
$mokadam_cheikhB_fr= $request["mokadam_cheikhB_fr"];
$mokadam_cheikhB_ar= $request["mokadam_cheikhB_ar"];
$domicileB_fr= $request["domicileB_fr"];
$domicileB_ar= $request["domicileB_ar"];
$cineB= $request["cineB"];
$nom_epouse_ar= $request["nom_epouse_ar"];
$nom_epouse_fr= $request["nom_epouse_fr"];
$nom_epouseB_ar= $request["nom_epouseB_ar"];
$nom_epouseB_fr= $request["nom_epouseB_fr"];
$language= $request["language"];


$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);
$query="SELECT * FROM `exbirth` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
	$result=$pdoResult->fetch();

// ONLY ARABIC ///////////////////////////////////////////////////////////////////////////////
  if($language=="ar")
  {
    class Pdf extends Fpdi\TcpdfFpdi
    {
        protected $tplId;
        function Header()
        {
            if (is_null($this->tplId)) {
                $this->setSourceFile('imprimeModels/non_divorce_ar.pdf');
                $this->tplId = $this->importPage(1);
            }
            $size = $this->useImportedPage($this->tplId,  0, 0, 150);

        }
    }

    // initiate PDF
    ob_start();
    $pdf = new Pdf();
    $pdf->AddPage('P','A5');
    $pdf->SetAutoPageBreak(true, 1);
    // set some language dependent data:
      $lg = Array();
      $lg['a_meta_charset'] = 'UTF-8';
      $lg['a_meta_dir'] = 'rtl';
      $lg['a_meta_language'] = 'fa';
      $lg['w_page'] = 'page';
      $pdf->setLanguageArray($lg);

      if($pdoResult->rowCount()>0)
    {
       //trace
$pdf->setRTL(false);
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(78, 40);

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



      $pdf->setRTL(true);
    //   $pdf->SetFont('helvetica', 'B', 8);
    //   $pdf->SetXY(32, 38.5);
    //   $pdf->Cell(0, 25,$result["numero"] ,'C');

      $pdf->SetFont('helvetica', 'B', 8);
      $pdf->SetXY(32, 38.5);
      $pdf->Cell(0, 25,$numero_certificat_ar ,'C');



      $pdf->SetXY(17, 77);
      $pdf->Cell(0, 25,$numero_mokadam_ar ,'C');

      $pdf->SetXY(63, 77.5);
      $pdf->Cell(0, 25,$date_certficat_ar ,'C');

      $pdf->SetFont($fontname,'B',10);
      $pdf->SetXY(20, 68);
      $pdf->Cell(0, 25,$mokadam_cheikh_ar,'C');

      $pdf->SetXY(41, 85.25);
      $pdf->Cell(0, 25,$result["prenom_ar"]." ".$result["nom_ar"] ,'C');

      $pdf->SetXY(41, 91.5);
      $pdf->Cell(0, 25,$result["lieu_naiss_ar"] ,'C');

      $pdf->SetXY(41, 97.25);
      $pdf->Cell(0, 25,$result["date_naiss_miladi_ar"] ,'C');


      $pdf->SetXY(41, 103.25);
      $pdf->Cell(0, 25,$result["prenom_pere_ar"] ,'C');


     $pdf->SetXY(41, 110);
     $pdf->Cell(0, 25,$result["prenom_mere_ar"] ,'C');

    $pdf->SetFont($fontname,'B',10);
    $pdf->SetXY(61, 133.5);
    $pdf->Cell(0, 25,$nom_epouse_ar ,'C');

     $pdf->SetXY(41, 116);
     $pdf->Cell(0, 25,$domicile_ar ,'C');


     $pdf->SetFont('helvetica','B',9);
     $pdf->SetXY(64, 121.5);
     $pdf->Cell(0, 25,$cine_ar ,'C');

    

       $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetXY(78 , 150);
        $pdf->Cell(0, 25,$ActualDate ,'C');
    }




  }

//Only Frensh/////////////////////////////////////////////////////////////////////
if($language=="fr")
{
  class Pdf extends Fpdi\TcpdfFpdi
  {
      protected $tplId;
      function Header()
      {
          if (is_null($this->tplId)) {
              $this->setSourceFile('imprimeModels/non_divorce_fr.pdf');
              $this->tplId = $this->importPage(1);
          }
          $size = $this->useImportedPage($this->tplId,  0, 0, 150);

      }
  }

  // initiate PDF
  ob_start();
  $pdf = new Pdf();
  $pdf->AddPage('P','A5');
  $pdf->SetAutoPageBreak(true, 1);

  if($pdoResult->rowCount()>0)
{
   //trace
$pdf->setRTL(false);
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(101, 40);

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


  $pdf->setRTL(false);
  $pdf->SetFont('helvetica', 'B', 8);


  //commune and date


//   $pdf->SetXY(38, 39);
//   $pdf->Cell(0, 25,$result["numero"] ,'C');

  $pdf->SetXY(38, 38.5);
  $pdf->Cell(0, 25,$numero_certificat_fr ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(16, 75);
  $pdf->Cell(0, 25,$numero_mokadam_fr ,'C');

  $pdf->SetXY(73, 67);
  $pdf->Cell(0, 25,ucwords($mokadam_cheikh_fr) ,'C');

  $pdf->SetXY(66, 75);
  $pdf->Cell(0, 25,$date_certficat_fr ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(47, 90.5);
  $pdf->Cell(0, 25,ucwords($result["prenom"])." ".ucfirst($result["nom"]) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(47, 95.5);
  $pdf->Cell(0, 25,$result["date_naiss_miladi"] ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(47, 101.5);
  $pdf->Cell(0, 25,ucwords($result["lieu_naiss"]) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
  $pdf->SetXY(47, 106.5);
  $pdf->Cell(0, 25,ucwords($result["prenom_pere"]) ,'C');

  $pdf->SetFont('helvetica', 'B', 10);
 $pdf->SetXY(47, 111.5);
 $pdf->Cell(0, 25,ucwords($result["prenom_mere"]) ,'C');



 $pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(47, 116.75);
$pdf->Cell(0, 25,ucwords($domicile_fr) ,'C');

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(70, 122);
$pdf->Cell(0, 25,ucwords($cine_fr) ,'C');


$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetXY(67, 135);
$pdf->Cell(0, 25,ucwords($nom_epouse_fr) ,'C');

   $pdf->SetFont('helvetica', 'B', 9);
    $pdf->SetXY(67 , 156);
    $pdf->Cell(0, 25,$ActualDate ,'C');

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
  $pageCount = $pdf->setSourceFile('imprimeModels\non_divorce_biling.pdf');
  $pdf->SetAutoPageBreak(true, 1);
  for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
      // import a page
      $templateId = $pdf->importPage($pageNo);
  $pdf->setPrintHeader(false);
  $pdf->setPrintFooter(false);
      $pdf->AddPage('P', 'A5');
      // Arabic VERSION**********************************************************************
      if($pageNo==2)
      {

          $size = $pdf->useImportedPage($templateId, 0 , 0, 150);
          if($pdoResult->rowCount()>0)
        {
           //trace
$pdf->setRTL(false);
$pdf->SetFont('helvetica','B',5);
$pdf->SetXY(100, 40);

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

          $pdf->setRTL(false);
          $pdf->SetFont('helvetica', 'B', 8);


          //commune and date


        //   $pdf->SetXY(38, 39);
        //   $pdf->Cell(0, 25,$result["numero"] ,'C');

          $pdf->SetXY(35, 38.5);
          $pdf->Cell(0, 25,$numero_certificatB ,'C');


          $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(16, 74.75);
          $pdf->Cell(0, 25,$numero_mokadamB ,'C');

          $pdf->SetXY(73, 67);
          $pdf->Cell(0, 25,ucwords($mokadam_cheikhB_fr) ,'C');

          $pdf->SetXY(66, 75);
          $pdf->Cell(0, 25,$date_certficatB ,'C');

          $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(47, 90.25);
          $pdf->Cell(0, 25,ucwords($result["prenom"])." ".ucfirst($result["nom"]) ,'C');

          $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(47, 95.25);
          $pdf->Cell(0, 25,$result["date_naiss_miladi"] ,'C');

          $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(47, 101.25);
          $pdf->Cell(0, 25,ucwords($result["lieu_naiss"]) ,'C');

          $pdf->SetFont('helvetica', 'B', 10);
          $pdf->SetXY(47, 106.5);
          $pdf->Cell(0, 25,ucwords($result["prenom_pere"]) ,'C');

          $pdf->SetFont('helvetica', 'B', 10);
         $pdf->SetXY(47, 111.5);
         $pdf->Cell(0, 25,ucwords($result["prenom_mere"]) ,'C');


         $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(47, 117);
        $pdf->Cell(0, 25,ucwords($domicileB_fr) ,'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(69, 122.5);
        $pdf->Cell(0, 25,ucwords($cineB) ,'C');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(67, 135);
        $pdf->Cell(0, 25,ucwords($nom_epouseB_fr) ,'C');

           $pdf->SetFont('helvetica', 'B', 9);
            $pdf->SetXY(67 , 155.5);
            $pdf->Cell(0, 25,$ActualDate ,'C');

        }


      }
      // FRANCAIS VERSION**********************************************************************
      if($pageNo==1)
      {
        $pdf->setLanguageArray($lg);
        $size = $pdf->useImportedPage($templateId, 0 , 0, 150);
        if($pdoResult->rowCount()>0)
      {
        //trace
        $pdf->setRTL(false);
        $pdf->SetFont('helvetica','B',5);
        $pdf->SetXY(78, 40);

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



        $pdf->setRTL(true);
        // $pdf->SetFont('helvetica', 'B', 8);
        // $pdf->SetXY(32, 42.5);
        // $pdf->Cell(0, 25,$result["numero"] ,'C');

        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetXY(32, 37.75);
        $pdf->Cell(0, 25,$numero_certificatB ,'C');

        $pdf->SetXY(17, 77.5);
        $pdf->Cell(0, 25,$numero_mokadamB ,'C');

        $pdf->SetXY(63, 77.5);
        $pdf->Cell(0, 25,$date_certficatB ,'C');

        $pdf->SetFont($fontname,'B',10);
        $pdf->SetXY(20, 68.25);
        $pdf->Cell(0, 25,$mokadam_cheikhB_ar,'C');

        $pdf->SetXY(41, 85.25);
        $pdf->Cell(0, 25,$result["prenom_ar"]." ".$result["nom_ar"] ,'C');

        $pdf->SetXY(41, 91.5);
        $pdf->Cell(0, 25,$result["lieu_naiss_ar"] ,'C');

        $pdf->SetXY(41, 97.5);
        $pdf->Cell(0, 25,$result["date_naiss_miladi_ar"] ,'C');


        $pdf->SetXY(41, 103.5);
        $pdf->Cell(0, 25,$result["prenom_pere_ar"] ,'C');


       $pdf->SetXY(41, 109.5);
       $pdf->Cell(0, 25,$result["prenom_mere_ar"] ,'C');


       $pdf->SetXY(41, 115.5);
       $pdf->Cell(0, 25,$domicileB_ar ,'C');

       $pdf->SetXY(61, 134);
       $pdf->Cell(0, 25,$nom_epouseB_ar ,'C');


       $pdf->SetFont('helvetica','B',9);
       $pdf->SetXY(65, 121.75);
       $pdf->Cell(0, 25,$cineB ,'C');

         $pdf->SetFont('helvetica', 'B', 9);
          $pdf->SetXY(78 , 150.25);
          $pdf->Cell(0, 25,$ActualDate ,'C');
      }

      }

  }

}


 ob_end_clean();
$pdf->Output();
