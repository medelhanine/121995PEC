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



// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);





// set default monospaced font
$pdf->SetDefaultMonospacedFont(false);

// set margins
$pdf->SetMargins(false, false, false);
$pdf->SetHeaderMargin(false);
$pdf->SetFooterMargin(false);

$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// -------------------------------------------------------------------

// add a page
$pdf->AddPage();

// set JPEG quality
$pdf->setJPEGQuality(75);

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
$request = $_REQUEST;
$numero = $request["numero"];
$annee = $request["annee"];
$j=1;
 $folder = "uploads/solbBirth/".$numero.".".$annee."/";

   $images = glob($folder."*.*");

   foreach($images as $image)
   {
     // Image example with resizing
     $pdf->Image($image, 0, 0, 220, 300, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
     $pdf->addPage();
     $j++;

   }

   // Delete page 6
$pdf->deletePage($j);



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -




 ob_end_clean();
$pdf->Output('print.pdf', 'I');
