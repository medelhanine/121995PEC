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


$months_letter= array("1" =>"يناير",
"2"=>"فبراير",
"3"=>"مارس",
"4"=>"أبريل",
"5"=>"ماي",
"6"=>"يونيو",
"7"=>"يوليوز",
"8"=>"غشت",
"9"=>"شتنبر",
"10"=>"أكتوبر",
"11"=>"نونبر",
"12"=>"دجنبر");


$type_irsal= $request["type_irsal"];
$feminin_number = 0;
$masculin_number = 0;
$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);
// general irsal ///////////////////////////////////////////////////////////////////////////////
  if($type_irsal=="general")
  {
    $month= (string)$request["month_general"];
    $monthComplet = "0".$month;
    $result_month = $months_letter[$month];
    $year= (string)$request["year_general"];
    class Pdf extends Fpdi\TcpdfFpdi
    {
        protected $tplId;
        function Header()
        {
            if (is_null($this->tplId)) {
                $this->setSourceFile('imprimeModels/irsal_chahri.pdf');
                $this->tplId = $this->importPage(1);
            }
            $size = $this->useImportedPage($this->tplId,  0, 0, 215);
        }
    }
    // initiate PDF
    ob_start();
    $pdf = new Pdf();
    $pdf->AddPage('P','A4');
    $pdf->SetAutoPageBreak(true, 1);
    // set some language dependent data:
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
        $pdf->setLanguageArray($lg);
        $pdf->setRTL(true);
        $pdf->SetFont($fontname, 'B', 15);
        $pdf->SetXY(89, 67.5);
        $pdf->Cell(0, 25,$result_month,'C');
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->SetXY(120, 67.5);
        $pdf->Cell(0, 25,$year,'C');
      //feminin
      $query=" SELECT count(numero) FROM sbirth WHERE SUBSTRING(`time_stamp`, 6, 2) = ? AND sex='feminin' AND SUBSTRING(`time_stamp`, 1, 4) =?";
      $pdoResult = $pdoConnect->prepare($query);
      $pdoResult->execute(array($monthComplet,$year));
      $result=$pdoResult->fetch();
      if($pdoResult->rowCount()>0)
        {
            $feminin_number=$result['count(numero)'];
            if($feminin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(82, 114.5);
            $pdf->Cell(0, 25,$feminin_number,'C');
            }else{
                $pdf->SetFont('helvetica', 'B', 20);
                $pdf->SetXY(87, 114.5);
                $pdf->Cell(0, 25,"-",'C');
            }        
        }
        
        //masculin

        $query2=" SELECT count(numero) FROM sbirth WHERE SUBSTRING(`time_stamp`, 6, 2) = ? AND sex='masculin' AND SUBSTRING(`time_stamp`, 1, 4) =?";
      $pdoResult2 = $pdoConnect->prepare($query2);
      $pdoResult2->execute(array($monthComplet,$year));
      $result2=$pdoResult2->fetch();
      if($pdoResult2->rowCount()>0)
        {
            $masculin_number=$result2['count(numero)'];
            if($masculin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(52, 114.5);
                $pdf->Cell(0, 25,$masculin_number,'C');
            }else {
                $pdf->SetFont('helvetica', 'B', 20);
                $pdf->SetXY(57, 114.5);
                $pdf->Cell(0, 25,"-",'C');
            }    
        } 
      
      //total Birth      
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(110, 113.5);
            $pdf->Cell(0, 25,$feminin_number+$masculin_number,'C');

            //deces*************

          //feminin
      $query=" SELECT count(numero) FROM sdeadtable WHERE SUBSTRING(`time_stamp`, 6, 2) = ? AND sex='feminin' AND SUBSTRING(`time_stamp`, 1, 4) =?";
      $pdoResult = $pdoConnect->prepare($query);
      $pdoResult->execute(array($monthComplet,$year));
      $result=$pdoResult->fetch();
      if($pdoResult->rowCount()>0)
        {
            $feminin_number=$result['count(numero)'];

            if($feminin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(82, 135.5);
                $pdf->Cell(0, 25,$feminin_number,'C');
            }else{
                $pdf->SetFont('helvetica', 'B', 20);
                $pdf->SetXY(87, 135.5);
                $pdf->Cell(0, 25,"-",'C');
            }
        } 
        
        //masculin

        $query2=" SELECT count(numero) FROM sdeadtable WHERE SUBSTRING(`time_stamp`, 6, 2) = ? AND sex='masculin' AND SUBSTRING(`time_stamp`, 1, 4) =?";
      $pdoResult2 = $pdoConnect->prepare($query2);
      $pdoResult2->execute(array($monthComplet,$year));
      $result2=$pdoResult2->fetch();
      if($pdoResult2->rowCount()>0)
        {
            $masculin_number=$result2['count(numero)'];
            if($masculin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(52, 135.5);
                $pdf->Cell(0, 25,$masculin_number,'C');
            }else{
                $pdf->SetFont('helvetica', 'B', 20);
                $pdf->SetXY(57, 135.5);
                $pdf->Cell(0, 25,"-",'C');
            }
        } 
      
            //total Birth      
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(110, 135.5);
            $pdf->Cell(0, 25,$feminin_number+$masculin_number,'C');           


            //zawajat *******************
            //feminin
      $query=" SELECT count(numero) FROM timep_stamp_table WHERE SUBSTRING(`timestamp`, 6, 2) = ? AND sex='feminin' AND SUBSTRING(`timestamp`, 1, 4) =? AND type='zawaj'";
      $pdoResult = $pdoConnect->prepare($query);
      $pdoResult->execute(array($monthComplet,$year));
      $result=$pdoResult->fetch();
      if($pdoResult->rowCount()>0)
        {
            $feminin_number=$result['count(numero)'];

            if($feminin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(82, 200.5);
                $pdf->Cell(0, 25,$feminin_number,'C');
            }else{
                $pdf->SetFont('helvetica', 'B', 20);
                $pdf->SetXY(87, 200.5);
                $pdf->Cell(0, 25,"-",'C');
            }
        } 
        
        //masculin

        $query2=" SELECT count(numero) FROM timep_stamp_table WHERE SUBSTRING(`timestamp`, 6, 2) = ? AND sex='masculin' AND SUBSTRING(`timestamp`, 1, 4) =? AND type='zawaj'";
      $pdoResult2 = $pdoConnect->prepare($query2);
      $pdoResult2->execute(array($monthComplet,$year));
      $result2=$pdoResult2->fetch();
      if($pdoResult2->rowCount()>0)
        {
            $masculin_number=$result2['count(numero)'];
            if($masculin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(52, 200.5);
                $pdf->Cell(0, 25,$masculin_number,'C');
            }else{
                $pdf->SetFont('helvetica', 'B', 20);
                $pdf->SetXY(57, 200.5);
                $pdf->Cell(0, 25,"-",'C');
            }
        } 
      
            //total zawaj      
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(110, 200.5);
            $pdf->Cell(0, 25,$feminin_number+$masculin_number,'C');            

            //tala9aat ****************************************

            //feminin
      $query=" SELECT count(numero) FROM timep_stamp_table WHERE SUBSTRING(`timestamp`, 6, 2) = ? AND sex='feminin' AND SUBSTRING(`timestamp`, 1, 4) =? AND type='talak'";
      $pdoResult = $pdoConnect->prepare($query);
      $pdoResult->execute(array($monthComplet,$year));
      $result=$pdoResult->fetch();
      if($pdoResult->rowCount()>0)
        {
            $feminin_number=$result['count(numero)'];

            if($feminin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(82, 220.5);
                $pdf->Cell(0, 25,$feminin_number,'C');
            }else{
                $pdf->SetFont('helvetica', 'B', 20);
                $pdf->SetXY(87, 220.5);
                $pdf->Cell(0, 25,"-",'C');
            }
        } 
        
        //masculin

        $query2=" SELECT count(numero) FROM timep_stamp_table WHERE SUBSTRING(`timestamp`, 6, 2) = ? AND sex='masculin' AND SUBSTRING(`timestamp`, 1, 4) =? AND type='talak'";
      $pdoResult2 = $pdoConnect->prepare($query2);
      $pdoResult2->execute(array($monthComplet,$year));
      $result2=$pdoResult2->fetch();
      if($pdoResult2->rowCount()>0)
        {
            $masculin_number=$result2['count(numero)'];
            if($masculin_number > 0)
            {
                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->SetXY(52, 220.5);
                $pdf->Cell(0, 25,$masculin_number,'C');
            }else{
                $pdf->SetFont('helvetica', 'B', 20);
                $pdf->SetXY(57, 220.5);
                $pdf->Cell(0, 25,"-",'C');
            }
        } 
      
            //total talak      
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(110, 220.5);
            $pdf->Cell(0, 25,$feminin_number+$masculin_number,'C');

//date*********
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetXY(170, 160);
$pdf->Cell(0, 25,$ActualDate,'C');

    }

//Details/////////////////////////////////////////////////////////////////////

if($type_irsal=="detail")
{
    $month= (string)$request["month_detail"];
    $monthComplet = "0".$month;
    $result_month = $months_letter[$month];
    $year= (string)$request["year_detail"];
    class Pdf extends Fpdi\TcpdfFpdi
    {
        protected $tplId;
    }
    ob_start();
    // initiate PDF
    $pdf = new Pdf();
    $pageCount = $pdf->setSourceFile('imprimeModels\irsal_one_month.pdf');
    $pdf->SetAutoPageBreak(true, 1);
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        // import a page
        $templateId = $pdf->importPage($pageNo);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
        $pdf->AddPage('L', 'A4');
        // wafayate rachidine **********************************************************************
        if($pageNo==1)
        {
            $pdf->setRTL(true);  
            $pdf->setLanguageArray($lg);
            $size = $pdf->useImportedPage($templateId, 0 , 0, 300);

            $query2="SELECT numero,annee,prenom_ar,nom_ar,lieu_deces_ar FROM sdeadtable WHERE SUBSTRING(`time_stamp`, 6, 2) = ? AND  SUBSTRING(`time_stamp`, 1, 4) =? ORDER BY numero ASC";
            $pdoResult2 = $pdoConnect->prepare($query2);
            $pdoResult2->execute(array($monthComplet,$year));
            $result2=$pdoResult2->fetchAll();

            $pdf->SetFont('helvetica', 'B', 13);
                $pdf->SetXY(213, 0);
                $pdf->Cell(0, 25,$ActualDate,'C');

                $pdf->SetFont($fontname, 'B', 13);
                $pdf->SetXY(177, 53);
                $pdf->Cell(0, 25,$result_month,'C');

                $pdf->SetFont('helvetica', 'B', 13);
                $pdf->SetXY(199, 53);
                $pdf->Cell(0, 25,$year,'C');

                $pdf->SetFont($fontname, 'B', 13);
                $pdf->SetXY(177, 180);
                $pdf->Cell(0, 25,"ضابط الحالة المدنية",'C');
                
            if($pdoResult2->rowCount()>0)
            {
                

                $j=85.5;
                foreach($result2 as $row)
                {
                    $pdf->SetFont($fontname, 'B', 10);
                    $pdf->SetXY(9.5, $j);
                    $pdf->MultiCell(67.5, 5, $row["prenom_ar"]." ".$row['nom_ar'], 1, 'C', 0, 0, '', '', true);

                    $pdf->SetFont("helvetica", 'B', 10);
                    $pdf->SetXY(77, $j);
                    $pdf->MultiCell(48.25, 5, $row["numero"], 1, 'C', 0, 0, '', '', true);


                    if($row["cine"] != "")
                    {
                        $pdf->SetFont("helvetica", 'B', 10);
                    $pdf->SetXY(125.25, $j);
                    $pdf->MultiCell(62.25, 5, $row["cine"], 1, 'C', 0, 0, '', '', true);
                    }else {
                        $pdf->SetFont("helvetica", 'B', 10);
                    $pdf->SetXY(125.25, $j);
                    $pdf->MultiCell(62.25, 5, "------", 1, 'C', 0, 0, '', '', true);
                    }
                    

                    $pdf->SetFont($fontname, 'B', 8);
                    $pdf->SetXY(187.75, $j);
                    $pdf->MultiCell(96, 5, $row['lieu_deces_ar'], 1, 'C', 0, 0, '', '', true);

                    if($j > 180)
                    {
                    $pdf->AddPage('L', 'A4');
                    $j= 16.5;
                    $fontname2 = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
                    $pdf->SetFont($fontname2, 'B', 17);
                    $pdf->SetXY(36.5, $j);
                    $pdf->MultiCell(200, 65, " لائحة الأشخاص المتوفين الراشدين المصرح بهم خلال شهر".$result_month." سنة  ".$year, 0, 'C', 0, 0, '', '', true);
                    //$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);
                    $pdf->SetFont($fontname, 'B', 11);
                    $pdf->SetXY(9.5, $j+10);
                    $pdf->MultiCell(67.5, 25, "الإسم الشخصي و العائلي للمتوفي", 1, 'C', 0, 0, '', '', true);

                    $pdf->SetFont($fontname, 'B', 11);
                    $pdf->SetXY(77, $j+10);
                    $pdf->MultiCell(48.25, 25, "رقم رسم الوفاة", 1, 'C', 0, 0, '', '', true);

                    $pdf->SetFont($fontname, 'B', 11);
                    $pdf->SetXY(125.25, $j+10);
                    $pdf->MultiCell(62.25, 25, "رقم البطاقة الوطنية للتعريف", 1, 'C', 0, 0, '', '', true);

                    $pdf->SetFont($fontname, 'B', 11);
                    $pdf->SetXY(187.75, $j+10);
                    $pdf->MultiCell(96, 25, "آخر محل سكناه", 1, 'C', 0, 0, '', '', true);

                    $j= 36.5;
                    }
                    else{
                    $j +=5;
                    }
                }
            }else{ // no results              

                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetFont($fontname, 'B', 12);
                    $pdf->SetXY(9.5, 85.5);
                    $pdf->MultiCell(67.5, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);
                  
                    $pdf->SetXY(77, 85.5);
                    $pdf->MultiCell(48.25, 5,"لا أحد", 1, 'C', 0, 0, '', '', true);
             
                    $pdf->SetXY(125.25, 85.5);
                    $pdf->MultiCell(62.25, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);
                   
                    $pdf->SetXY(187.75, 85.5);
                    $pdf->MultiCell(96, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);
            }  
  
  
        }
        // nissa2 between 15 and 45****************************************************************
        if($pageNo==2)
        {  
          $size = $pdf->useImportedPage($templateId, 0 , 0, 300);  
          $query2="SELECT numero,annee,prenom_ar,nom_ar,lieu_deces_ar,date_deces_miladi,date_naiss_miladi FROM sdeadtable WHERE SUBSTRING(`time_stamp`, 6, 2) = ? AND  SUBSTRING(`time_stamp`, 1, 4) =? AND sex='feminin' ORDER BY numero ASC";
          $pdoResult2 = $pdoConnect->prepare($query2);
          $pdoResult2->execute(array($monthComplet,$year));
          $result2=$pdoResult2->fetchAll();

          $pdf->SetFont('helvetica', 'B', 13);
          $pdf->SetXY(213, 0);
          $pdf->Cell(0, 25,$ActualDate,'C');

          $pdf->SetFont($fontname, 'B', 13);
          $pdf->SetXY(232, 51.75);
          $pdf->Cell(0, 25,$result_month,'C');

          $pdf->SetFont('helvetica', 'B', 13);
          $pdf->SetXY(251, 51.75);
          $pdf->Cell(0, 25,$year,'C');

          $pdf->SetFont($fontname, 'B', 13);
                $pdf->SetXY(177, 180);
                $pdf->Cell(0, 25,"ضابط الحالة المدنية",'C');

          if($pdoResult2->rowCount()>0)
          {
             

              $j=83.25;
              $i = 0;
              foreach($result2 as $row)
              {

                    //precise the age
                    $date_deces = preg_match('/([0-9]{4})/', $row["date_deces_miladi"], $annee_deces);
                    $date_naiss = preg_match('/([0-9]{4})/', $row["date_naiss_miladi"], $annee_naiss);
                    if($annee_deces[0]-$annee_naiss[0] >= 15 &&  $annee_deces[0]-$annee_naiss[0] <= 45)
                    {
                        $pdf->SetFont($fontname, 'B', 10);
                  $pdf->SetXY(8, $j);
                  $pdf->MultiCell(66, 5, $row["prenom_ar"]." ".$row['nom_ar'], 1, 'C', 0, 0, '', '', true);

                  $pdf->SetFont("helvetica", 'B', 10);
                  $pdf->SetXY(73.75, $j);
                  $pdf->MultiCell(40, 5, $annee_deces[0], 1, 'C', 0, 0, '', '', true);


                  if($row["cine"] != "")
                  {
                    $pdf->SetFont("helvetica", 'B', 10);
                    $pdf->SetXY(113.75, $j);
                    $pdf->MultiCell(56.25, 5, $row["cine"], 1, 'C', 0, 0, '', '', true);
                  }else{
                    $pdf->SetFont("helvetica", 'B', 10);
                    $pdf->SetXY(113.75, $j);
                    $pdf->MultiCell(56.25, 5, "-----", 1, 'C', 0, 0, '', '', true);
                  }

                 

                  $pdf->SetFont($fontname, 'B', 8);
                  $pdf->SetXY(170, $j);
                  $pdf->MultiCell(115.5, 5, $row['lieu_deces_ar'], 1, 'C', 0, 0, '', '', true);

                  if($j > 180)
                  {
                  $pdf->AddPage('L', 'A4');
                  $j= 36.5;
                  $fontname2 = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
                  $pdf->SetFont($fontname2, 'B', 17);
                  $pdf->SetXY(36.5, $j);
                  $pdf->MultiCell(200, 65, " قائمة النساء المغربيات المتوفيات اللاتي تتراوح أعمارهن ما بين 15 و 45 سنة والمصرح بهن لدى مكتب الحالة المدنية خلال شهر".$result_month." سنة  ".$year, 0, 'C', 0, 0, '', '', true);
                  //$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);
                  $pdf->SetFont($fontname, 'B', 11);
                  $pdf->SetXY(8, $j+10);
                  $pdf->MultiCell(66, 25, "الإسم الشخصي و العائلي للمتوفي", 1, 'C', 0, 0, '', '', true);

                  $pdf->SetFont($fontname, 'B', 11);
                  $pdf->SetXY(73.75, $j+10);
                  $pdf->MultiCell(40, 25, "رقم رسم الوفاة", 1, 'C', 0, 0, '', '', true);

                  $pdf->SetFont($fontname, 'B', 11);
                  $pdf->SetXY(113.75, $j+10);
                  $pdf->MultiCell(56.25, 25, "رقم البطاقة الوطنية للتعريف", 1, 'C', 0, 0, '', '', true);

                  $pdf->SetFont($fontname, 'B', 11);
                  $pdf->SetXY(170, $j+10);
                  $pdf->MultiCell(115.5, 25, "آخر محل سكناه", 1, 'C', 0, 0, '', '', true);

                  $j= 36.5;
                  }
                  else{
                  $j +=5;
                  }                    
                  $i++;
                }
                  
              }

              if($i == 0)
              {
                $pdf->SetFont($fontname, 'B', 12);
                  $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                  $pdf->SetXY(8, 83.25);
                  $pdf->MultiCell(66, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);

                  
                  $pdf->SetXY(73.75, 83.25);
                  $pdf->MultiCell(40, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);

                  
                  $pdf->SetXY(113.75, 83.25);
                  $pdf->MultiCell(56.25, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);

                  
                  $pdf->SetXY(170,83.25);
                  $pdf->MultiCell(115.5, 5,  "لا أحد", 1, 'C', 0, 0, '', '', true);
              }
          }else{//no results in the month          
            $pdf->SetFont($fontname, 'B', 12);
            $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
            $pdf->SetXY(8, 83.25);
            $pdf->MultiCell(66, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);

            
            $pdf->SetXY(73.75, 83.25);
            $pdf->MultiCell(40, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);

            
            $pdf->SetXY(113.75, 83.25);
            $pdf->MultiCell(56.25, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);

            
            $pdf->SetXY(170,83.25);
            $pdf->MultiCell(115.5, 5,  "لا أحد", 1, 'C', 0, 0, '', '', true);
                

          }     
        }

        //wiladate*********

        if($pageNo==3)
        {
  
          $size = $pdf->useImportedPage($templateId, 0 , 0, 300);
  
          $query2="SELECT numero,annee,prenom_ar,nom_ar,date_naiss_miladi,nom_mere_ar,adresse_parent_ar FROM sbirth WHERE SUBSTRING(`time_stamp`, 6, 2) = ? AND  SUBSTRING(`time_stamp`, 1, 4) =?  ORDER BY numero ASC";
          $pdoResult2 = $pdoConnect->prepare($query2);
          $pdoResult2->execute(array($monthComplet,$year));
          $result2=$pdoResult2->fetchAll();
              $pdf->SetFont('helvetica', 'B', 13);
              $pdf->SetXY(213, 0);
              $pdf->Cell(0, 25,$ActualDate,'C');

              $pdf->SetFont($fontname, 'B', 13);
              $pdf->SetXY(162, 53.5);
              $pdf->Cell(0, 25,$result_month,'C');

              $pdf->SetFont('helvetica', 'B', 13);
              $pdf->SetXY(184, 53.5);
              $pdf->Cell(0, 25,$year,'C');

              $pdf->SetFont($fontname, 'B', 13);
              $pdf->SetXY(177, 180);
              $pdf->Cell(0, 25,"ضابط الحالة المدنية",'C');
          if($pdoResult2->rowCount()>0)
          {           

              $j=86.25;
              foreach($result2 as $row)
              {
                  $pdf->SetFont("helvetica", 'B', 10);
                  $pdf->SetXY(8.75, $j);
                  $pdf->MultiCell(24.75, 5, $row["numero"], 1, 'C', 0, 0, '', '', true);

                  $pdf->SetFont($fontname, 'B', 10);
                  $pdf->SetXY(33.75, $j);
                  $pdf->MultiCell(59, 5, $row["prenom_ar"]." ".$row['nom_ar'], 1, 'C', 0, 0, '', '', true);                  

                  $pdf->SetFont("helvetica", 'B', 10);
                  $pdf->SetXY(93, $j);
                  $pdf->MultiCell(45, 5, $row['date_naiss_miladi'], 1, 'C', 0, 0, '', '', true);

                  $pdf->SetFont($fontname, 'B', 7);
                  $pdf->SetXY(138, $j);
                  $pdf->MultiCell(67.25, 5, $row['nom_mere_ar'], 1, 'C', 0, 0, '', '', true);

                  $pdf->SetFont($fontname, 'B', 7);
                  $pdf->SetXY(205, $j);
                  $pdf->MultiCell(80.25, 5, $row['adresse_parent_ar'], 1, 'C', 0, 0, '', '', true);                  

                  if($j > 180)
                  {
                  $pdf->AddPage('L', 'A4');
                  $j= 16.5;
                  $fontname2 = TCPDF_FONTS::addTTFfont('assets\css\Generator_Black.ttf', 'TrueTypeUnicode', '', 96);
                  $pdf->SetFont($fontname2, 'B', 17);
                  $pdf->SetXY(36.5, $j);
                  $pdf->MultiCell(200, 65, "الولادات الجدد المصرح بها خلال شهر ".$result_month." سنة  ".$year." ميلادية ", 0, 'C', 0, 0, '', '', true);
                  //$fontname = TCPDF_FONTS::addTTFfont('assets\css\DroidKufi-Regular.ttf', 'TrueTypeUnicode', '', 96);
                  $pdf->SetFont($fontname, 'B', 11);
                  $pdf->SetXY(8.75, $j+10);
                  $pdf->MultiCell(24.75, 25, "رقم الرسم", 1, 'C', 0, 0, '', '', true);

                  $pdf->SetFont($fontname, 'B', 11);
                  $pdf->SetXY(33.75, $j+10);
                  $pdf->MultiCell(59, 25, "الإسم الشخصي و العائلي", 1, 'C', 0, 0, '', '', true);

                  $pdf->SetFont($fontname, 'B', 11);
                  $pdf->SetXY(93, $j+10);
                  $pdf->MultiCell(45, 25, "تاريخ الولادة ", 1, 'C', 0, 0, '', '', true);

                  $pdf->SetFont($fontname, 'B', 11);
                  $pdf->SetXY(138, $j+10); 
                  $pdf->MultiCell(67.25, 25, "اسم الأم", 1, 'C', 0, 0, '', '', true);

                  $pdf->SetFont($fontname, 'B', 11);
                  $pdf->SetXY(205, $j+10); 
                  $pdf->MultiCell(80.25, 25, "العنوان بالكامل", 1, 'C', 0, 0, '', '', true);

                  $j= 36.5;
                  }
                  else{
                  $j +=5;
                  }
              }
          }

          else{ // no results      
            
                  $pdf->SetFont($fontname, 'B', 12);
                  $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                  $pdf->SetXY(8.75, 86.25);
                  $pdf->MultiCell(24.75, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);
                  
                  $pdf->SetXY(33.75, 86.25);
                  $pdf->MultiCell(59, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);               

                 
                  $pdf->SetXY(93, 86.25);
                  $pdf->MultiCell(45, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);
                  
                  $pdf->SetXY(138, 86.25);
                  $pdf->MultiCell(67.25, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);
                  
                  $pdf->SetXY(205, 86.25);
                  $pdf->MultiCell(80.25, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);

          }         
        }

        //nachat
        if($pageNo==4)
        {
  
          $size = $pdf->useImportedPage($templateId, 0 , 0, 300);
         

          $pdf->SetFont('helvetica', 'B', 13);
              $pdf->SetXY(213, 0);
              $pdf->Cell(0, 25,$ActualDate,'C');

              $pdf->SetFont($fontname, 'B', 13);
              $pdf->SetXY(168, 55);
              $pdf->Cell(0, 25,$result_month,'C');

              $pdf->SetFont('helvetica', 'B', 13);
              $pdf->SetXY(189.5, 55);
              $pdf->Cell(0, 25,$year,'C');

              $pdf->SetFont($fontname, 'B', 13);
              $pdf->SetXY(177, 110);
              $pdf->Cell(0, 25,"ضابط الحالة المدنية",'C');
              $pdf->setFont('helvetica','B',13);
            //vie collect and vie individu
          $query2="SELECT count(timestamp) FROM timep_stamp_table WHERE type='vie_collect_individ'";
          $pdoResult2 = $pdoConnect->prepare($query2);
          $pdoResult2->execute();
          $result2=$pdoResult2->fetch();          

            if($result2['count(timestamp)'])
            {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(7.5, 102);
                $pdf->MultiCell(36.75, 15, $result2['count(timestamp)'], 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
                //$pdf->MultiCell(36.75, 15, $result2['count(timestamp)'], 1, 'C', 0, 0, '', '', true, 40, 'M');
            }else   {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(7.5, 102);
                $pdf->MultiCell(36.75, 15, "00", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
            }  
          //deces 
          $query2="SELECT count(timestamp) FROM timep_stamp_table WHERE type='celebat'";
          $pdoResult2 = $pdoConnect->prepare($query2);
          $pdoResult2->execute();
          $result2=$pdoResult2->fetch();          

            if($result2['count(timestamp)'])
            {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(44.25, 102);
                $pdf->MultiCell(35.75, 15, "///", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
                //$pdf->MultiCell(36.75, 15, $result2['count(timestamp)'], 1, 'C', 0, 0, '', '', true, 40, 'M');
            }else   {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(44.25, 102);
                $pdf->MultiCell(35.75, 15, "///", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
            }   

            //celibat
            $query2="SELECT count(timestamp) FROM timep_stamp_table WHERE type='celebat'";
          $pdoResult2 = $pdoConnect->prepare($query2);
          $pdoResult2->execute();
          $result2=$pdoResult2->fetch();          

            if($result2['count(timestamp)'])
            {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(80, 102);
                $pdf->MultiCell(35.5, 15, $result2['count(timestamp)'], 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
                //$pdf->MultiCell(36.75, 15, $result2['count(timestamp)'], 1, 'C', 0, 0, '', '', true, 40, 'M');
            }else   {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(80, 102);
                $pdf->MultiCell(35.5, 15, "00", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
            }   

            //zawaj
            $query2="SELECT count(timestamp) FROM timep_stamp_table WHERE type='celebat'";
            $pdoResult2 = $pdoConnect->prepare($query2);
            $pdoResult2->execute();
            $result2=$pdoResult2->fetch();          

            if($result2['count(timestamp)'])
            {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(115.75, 102);
                $pdf->MultiCell(35.75, 15,"//", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
                //$pdf->MultiCell(36.75, 15, $result2['count(timestamp)'], 1, 'C', 0, 0, '', '', true, 40, 'M');
            }else   {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(115.75, 102);
                $pdf->MultiCell(35.75, 15, "//", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
            }  

            //individualite

            $query2="SELECT count(timestamp) FROM timep_stamp_table WHERE type='individualite'";
            $pdoResult2 = $pdoConnect->prepare($query2);
            $pdoResult2->execute();
            $result2=$pdoResult2->fetch();          

            if($result2['count(timestamp)'])
            {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(151.5, 102);
                $pdf->MultiCell(35.75, 15,$result2['count(timestamp)'], 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
                //$pdf->MultiCell(36.75, 15, $result2['count(timestamp)'], 1, 'C', 0, 0, '', '', true, 40, 'M');
            }else   {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(151.5, 102);
                $pdf->MultiCell(35.75, 15, "//", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
            }  

            //dafatire mtlouba

            $query2="SELECT count(timestamp) FROM timep_stamp_table WHERE type='individualite'";
            $pdoResult2 = $pdoConnect->prepare($query2);
            $pdoResult2->execute();
            $result2=$pdoResult2->fetch();          

            if($result2['count(timestamp)'])
            {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(187.25, 102);
                $pdf->MultiCell(30.25, 15,"//", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
                //$pdf->MultiCell(36.75, 15, $result2['count(timestamp)'], 1, 'C', 0, 0, '', '', true, 40, 'M');
            }else   {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(187.25, 102);
                $pdf->MultiCell(35.5, 15, "//", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
            }  

            //dafatire mosalama

            $query2="SELECT count(timestamp) FROM timep_stamp_table WHERE type='individualite'";
            $pdoResult2 = $pdoConnect->prepare($query2);
            $pdoResult2->execute();
            $result2=$pdoResult2->fetch();          

            if($result2['count(timestamp)'])
            {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(217.75, 102);
                $pdf->MultiCell(30.5, 15,"//", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
                //$pdf->MultiCell(36.75, 15, $result2['count(timestamp)'], 1, 'C', 0, 0, '', '', true, 40, 'M');
            }else   {
                $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
                $pdf->SetXY(218.25, 102);
                $pdf->MultiCell(30.5, 15, "//", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
            } 

            //molahadate
            $pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
            $pdf->SetXY(248.5, 102);
            $pdf->MultiCell(36.75, 15,"//", 1, 'C', 0, 0, '', '', true, 0, false, true, 15, 'M');
        }  
    }
}

 ob_end_clean();
$pdf->Output();