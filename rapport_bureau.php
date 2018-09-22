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
}
date_default_timezone_set('UTC');
$ActualDate = date('Y/m/d');
$anneActu = substr($ActualDate,0,4);
$moisActu = substr($ActualDate,5,2);
// initiate PDF
ob_start();
$pdf = new Pdf();
$pdf->SetAutoPageBreak(true, 0);
$pageCount = $pdf->setSourceFile('imprimeModels\rapport_bureau.pdf');
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

  // iterate through all pages
  for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
      // import a page
      $templateId = $pdf->importPage($pageNo);
  $pdf->setPrintHeader(false);
  $pdf->setPrintFooter(false);
      $pdf->AddPage();
      // FIRST PAGE**********************************************************************
      if($pageNo==1)
      {
        // set some language dependent data:
          $lg = Array();
          $lg['a_meta_charset'] = 'UTF-8';
          $lg['a_meta_dir'] = 'rtl';
          $lg['a_meta_language'] = 'fa';
          $lg['w_page'] = 'page';
          $pdf->setLanguageArray($lg);
          $size = $pdf->useImportedPage($templateId, -2 , -4, 215);




$nisbat_tsjil = $request["nisbat_tsjil"];
$adad_sokan = $request["adad_sokan"];
$tarikh_ihdat_maktab = $request["tarikh_ihdat_maktab"];
$dabit_asli = $request["dabit_asli"];
$sifa = $request["sifa"];
$nom_dabit = $request["nom_dabit"];
$ahkam_tsrih_naiss = $request["ahkam_tsrih_naiss"];
$wiladat_hadita = $request["wiladat_hadita"];
$extrait_naiss = $request["extrait_naiss"];
$ahkam_tsrihia_deces = $request["ahkam_tsrihia_deces"];
$deces_hadita = $request["deces_hadita"];
$acte_deces = $request["acte_deces"];
$ahkam_tnkihia = $request["ahkam_tnkihia"];
$dafatir_familiale = $request["dafatir_familiale"];
$somme_kotab_etat = $request["somme_kotab_etat"];
$date_debut_travail = $request["date_debut_travail"];
$echelle = $request["echelle"];
$nom_katib = $request["nom_katib"];
$adad_nadawat = $request["adad_nadawat"];
$takwin = $request["takwin"];
$niveau_scol = $request["niveau_scol"];
$molahadat_imkanyat_maktab = $request["molahadat_imkanyat_maktab"];
$etat_hojorat = $request["etat_hojorat"];
$odifat_hojorat_jadida = $request["odifat_hojorat_jadida"];
$adad_hojorat = $request["adad_hojorat"];
$adad_khizanat = $request["adad_khizanat"];
$adad_karassi = $request["adad_karassi"];
$adad_tawilat = $request["adad_tawilat"];
$matbo3at = $request["matbo3at"];
$adad_alat_kitaba = $request["adad_alat_kitaba"];
$adad_rofof = $request["adad_rofof"];
$thizat_maktabia = $request["thizat_maktabia"];
$maraji3 = $request["maraji3"];
$adad_tftichiat = $request["adad_tftichiat"];
$molahadat_imkanat_madia = $request["molahadat_imkanat_madia"];
$mokhalafat_kanonia = $request["mokhalafat_kanonia"];
$mokhalaft_mistaria = $request["mokhalaft_mistaria"];
$kholassa_wadiat_maktab = $request["kholassa_wadiat_maktab"];
$ijraat_isla7_lmktab = $request["ijraat_isla7_lmktab"];




//insert avis in database

$query = "SELECT `id_rapport_bureau` FROM `rapport_bureau`";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute();

$result=$pdoResult->fetch();
if($pdoResult->rowCount()>0)
{

    $query = "UPDATE `rapport_bureau` SET `adad_sokan`=?,`nisbat_tsjil`=?,`tarikh_ihdat_maktab`=?,`dabit_asli`=?,`somme_kotab_etat`=?,`molahadat_imkanyat_maktab`=?,`adad_hojorat`=?,`odifat_hojorat_jadida`=?,`etat_hojorat`=?,`adad_tawilat`=?,`adad_karassi`=?,`adad_khizanat`=?,`adad_rofof`=?,`adad_alat_kitaba`=?,`matbo3at`=?,`maraji3`=?,`thizat_maktabia`=?,`molahadat_imkanat_madia`=?,`adad_tftichiat`=?,`mokhalaft_mistaria`=?,`mokhalafat_kanonia`=?,`ijraat_isla7_lmktab`=?,`kholassa_wadiat_maktab`=? WHERE `id_rapport_bureau`=?";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoResult->execute(array($adad_sokan,$nisbat_tsjil,$tarikh_ihdat_maktab,$dabit_asli,$somme_kotab_etat,$molahadat_imkanyat_maktab,$adad_hojorat,$odifat_hojorat_jadida,$etat_hojorat,$adad_tawilat,$adad_karassi,$adad_khizanat,$adad_rofof,$adad_alat_kitaba,$matbo3at,$maraji3,$thizat_maktabia,$molahadat_imkanat_madia,$adad_tftichiat,$mokhalaft_mistaria,$mokhalafat_kanonia,$ijraat_isla7_lmktab,$kholassa_wadiat_maktab,$result["id_rapport_bureau"]));

}else
{
$query = "INSERT INTO `rapport_bureau`(`adad_sokan`, `nisbat_tsjil`, `tarikh_ihdat_maktab`, `dabit_asli`, `somme_kotab_etat`, `molahadat_imkanyat_maktab`, `adad_hojorat`, `odifat_hojorat_jadida`, `etat_hojorat`,`adad_tawilat`, `adad_karassi`, `adad_khizanat`, `adad_rofof`, `adad_alat_kitaba`, `matbo3at`, `maraji3`, `thizat_maktabia`, `molahadat_imkanat_madia`, `adad_tftichiat`, `mokhalaft_mistaria`, `mokhalafat_kanonia`, `ijraat_isla7_lmktab`, `kholassa_wadiat_maktab`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($adad_sokan,$nisbat_tsjil,$tarikh_ihdat_maktab,$dabit_asli,$somme_kotab_etat,$molahadat_imkanyat_maktab,$adad_hojorat,$odifat_hojorat_jadida,$etat_hojorat,$adad_tawilat,$adad_karassi,$adad_khizanat,$adad_rofof,$adad_alat_kitaba,$matbo3at,$maraji3,$thizat_maktabia,$molahadat_imkanat_madia,$adad_tftichiat,$mokhalaft_mistaria,$mokhalafat_kanonia,$ijraat_isla7_lmktab,$kholassa_wadiat_maktab));

}


//insert katib
if(isset($nom_katib))
{    
    $query = "TRUNCATE `imkaniat_bacharia`;INSERT INTO `imkaniat_bacharia`(`nom`, `echelle`, `date_debut_travail`, `niveau_scol`, `takwin`, `adad_nadawat`) VALUES (?,?,?,?,?,?)";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoResult->execute(array($nom_katib,$echelle,$date_debut_travail,$niveau_scol,$takwin,$adad_nadawat));

    $j=1;
while($j<5 && isset($request['nom_katib'.$j]))
{
    $query = "INSERT INTO `imkaniat_bacharia`(`nom`, `echelle`, `date_debut_travail`, `niveau_scol`, `takwin`, `adad_nadawat`) VALUES (?,?,?,?,?,?)";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoResult->execute(array($request["nom_katib".$j],$request["echelle".$j],$request["date_debut_travail".$j],$request["niveau_scol".$j],$request["takwin".$j],$request["adad_nadawat".$j]));
    $j++;
}
}



//insert dobat
if(isset($nom_dabit))
{
    $query = "TRUNCATE `dobat_hala_madania`;INSERT INTO `dobat_hala_madania`(`nom`, `sifa`) VALUES (?,?)";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoResult->execute(array($nom_dabit,$sifa));

    //add dabit 
$i=1;
while($i<5 && isset($request['nom_dabit'.$i]))
{
    $query = "INSERT INTO `dobat_hala_madania`(`nom`, `sifa`) VALUES (?,?)";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoResult->execute(array($request["nom_dabit".$i],$request["sifa".$i]));
    $i++;
}

}



//pour les donnees en arabe
$pdf->setRTL(true);


//prenom ar
$fontname = "aefurat";



$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(40,54.75);
$pdf->Cell(0, 25,$adad_sokan,'C');//$adad_sokan

$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(75,62.75);
$pdf->Cell(0, 25,$nisbat_tsjil,'C');//$nisbat_tsjil


$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(72,70.75);
$pdf->Cell(0, 25,$dabit_asli,'C');//$dabit_asli


$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(58,78.75);
$pdf->Cell(0, 25,$tarikh_ihdat_maktab,'C');//$tarikh_ihdat_maktab



//dobat tfwid list
$query = "SELECT * FROM `dobat_hala_madania`";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute();

$result=$pdoResult->fetchAll();
if($pdoResult->rowCount()>0)
{
    $y = 5.40;
    foreach($result as $row)
    {
    $pdf->SetFont($fontname, 'B', 12);
    $pdf->SetLineStyle(array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
    $pdf->SetXY(25.75, 107.25+$y);
    $pdf->MultiCell(75, 5, $row["nom"], 1, 'C', 0, 0, '', '', true);


    $pdf->SetXY(100.5,107.25+$y);
    $pdf->MultiCell(75, 5,$row["sifa"], 1, 'C', 0, 0, '', '', true);
     
    $y += 5.40;

    }
    
}else
{
    
$pdf->SetFont($fontname, 'B', 12);
$pdf->SetLineStyle(array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->SetXY(25.75, 112.75);
$pdf->MultiCell(75, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);


$pdf->SetXY(100.5,112.75);
$pdf->MultiCell(75, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);
}





$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(80,141.5);
$pdf->Cell(0, 25,$extrait_naiss,'C');//$extrait_naiss


$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(145,141.5);
$pdf->Cell(0, 25,$wiladat_hadita,'C');//$wiladat_hadita

$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(155,152.5);
$pdf->Cell(0, 25,$wiladat_hadita,'C');//$wiladat_hadita


$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(140,164.5);
$pdf->Cell(0, 25, $deces_hadita,'C');//$deces_hadita

$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(80,164.5);
$pdf->Cell(0, 25,$acte_deces,'C');//$acte_deces

$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(156,177);
$pdf->Cell(0, 25, $ahkam_tsrihia_deces,'C');//$ahkam_tsrihia_deces

$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(84,188);
$pdf->Cell(0, 25, $ahkam_tnkihia,'C');//$ahkam_tnkihia


$pdf->SetFont($fontname, 'B', 13);
$pdf->SetXY(98,199);
$pdf->Cell(0, 25, $dafatir_familiale,'C');//$dafatir_familiale


/// kotab list 
$query = "SELECT * FROM `imkaniat_bacharia`";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute();

$result=$pdoResult->fetchAll();
if($pdoResult->rowCount()>0)
{  
    $z = 5.3;
    foreach($result as $row)
    {
        $pdf->SetFont($fontname, 'B', 12);
        $pdf->SetLineStyle(array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetXY(19, 258.45+ $z);
        $pdf->MultiCell(29, 5, $row["nom"], 1, 'C', 0, 0, '', '', true);
        
        
        $pdf->SetXY(48.25,258.45+ $z);
        $pdf->MultiCell(30, 5, $row["echelle"], 1, 'C', 0, 0, '', '', true);  


        $pdf->SetXY(78.25,258.45+ $z);
        $pdf->MultiCell(31, 5, $row["date_debut_travail"], 1, 'C', 0, 0, '', '', true);
        
        $pdf->SetXY(109.25,258.45+ $z);
        $pdf->MultiCell(30.6, 5, $row["niveau_scol"], 1, 'C', 0, 0, '', '', true); 

        $pdf->SetXY(139.6,258.45+ $z);
        $pdf->MultiCell(29, 5, $row["takwin"], 1, 'C', 0, 0, '', '', true); 

        $pdf->SetXY(168.6,258.45+ $z);
        $pdf->MultiCell(32.2, 5, $row["adad_nadawat"], 1, 'C', 0, 0, '', '', true); 

        $z += 5.3;
    }
    
        
    
}else
{

        $pdf->SetFont($fontname, 'B', 12);
        $pdf->SetLineStyle(array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetXY(19, 263.75);
        $pdf->MultiCell(29, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);
        
        
        $pdf->SetXY(48.25,263.75);
        $pdf->MultiCell(30, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);  


        $pdf->SetXY(78.25,263.75);
        $pdf->MultiCell(31, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);
        
        $pdf->SetXY(109.25,263.75);
        $pdf->MultiCell(30.6, 5, "لا أحد", 1, 'C', 0, 0, '', '', true); 

        $pdf->SetXY(139.6,263.75);
        $pdf->MultiCell(29, 5, "لا أحد", 1, 'C', 0, 0, '', '', true); 

        $pdf->SetXY(168.6,263.75);
        $pdf->MultiCell(32.2, 5, "لا أحد", 1, 'C', 0, 0, '', '', true);     

}
         
        
      }
      // SECOND PAGE**********************************************************************
      if($pageNo==2)
      {
        $size = $pdf->useImportedPage($templateId, -2 , -3.5, 215);
        $pdf->setRTL(true);
        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(148,0);
        $pdf->Cell(0, 25,$molahadat_imkanyat_maktab ,'C');//$molahadat_imkanyat_maktab


        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(50,15);
        $pdf->Cell(0, 25,$adad_hojorat,'C');//$adad_hojorat

        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(105,22);
        $pdf->Cell(0, 25,$odifat_hojorat_jadida ,'C');//$odifat_hojorat_jadida


        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(43,30);
        $pdf->Cell(0, 25,$etat_hojorat ,'C'); //$etat_hojorat

        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(125,55);
        $pdf->Cell(0, 25,$adad_tawilat,'C'); //$adad_tawilat


        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(125,63);
        $pdf->Cell(0, 25,$adad_karassi ,'C'); //$adad_karassi


        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(125,71);
        $pdf->Cell(0, 25,$adad_khizanat,'C'); //$adad_khizanat

        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(125,79);
        $pdf->Cell(0, 25,$adad_rofof,'C'); //$adad_rofof


        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(125,87);
        $pdf->Cell(0, 25,$adad_alat_kitaba,'C'); //$adad_alat_kitaba

        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(120,103);
        $pdf->Cell(0, 25,$matbo3at ,'C'); //$matbo3at


        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(120,111);
        $pdf->Cell(0, 25,$maraji3 ,'C'); //$maraji3

        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(120,119.5);
        $pdf->Cell(0, 25,$thizat_maktabia ,'C'); //$thizat_maktabia

        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(130,132);
        $pdf->Cell(0, 25,$molahadat_imkanat_madia,'C'); //$molahadat_imkanat_madia


        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(96,140);
        $pdf->Cell(0, 25,$adad_tftichiat,'C'); //$adad_tftichiat


        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(76,169.5);
        $pdf->Cell(0, 25,$mokhalaft_mistaria ,'C'); //$mokhalaft_mistaria

        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(72,178.5);
        $pdf->Cell(0, 25,$mokhalafat_kanonia ,'C'); //$mokhalafat_kanonia


        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(108,187.5);
        $pdf->Cell(0, 25,$ijraat_isla7_lmktab ,'C'); //$ijraat_isla7_lmktab


        $pdf->SetFont($fontname, 'B', 13);
        $pdf->SetXY(88,196.5);
        $pdf->Cell(0, 25,$kholassa_wadiat_maktab ,'C'); //$kholassa_wadiat_maktab


        $pdf->SetFont("helvetica", 'B', 10);
        $pdf->SetXY(160,213);
        $pdf->Cell(0, 25,$ActualDate ,'C'); 


  
      }

  }

 ob_end_clean();
$pdf->Output();
