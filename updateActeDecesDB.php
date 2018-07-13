<?php
require 'dbConnect.php';



$numero= $_POST['numero'];
$annee = $_POST['annee'];
$prenom_ar = $_POST['prenom_ar'];
$prenom = $_POST['prenom'];
$nom_ar = $_POST['nom_ar'];
$nom = $_POST['nom'];
$lieu_deces_ar = $_POST['lieu_deces_ar'];
$lieu_deces = $_POST['lieu_deces'];
$date_deces_miladi_ar = $_POST['date_deces_miladi_ar'];
$date_deces_miladi_fr = $_POST['date_deces_miladi_fr'];
$date_deces_hijri_ar = $_POST['date_deces_hijri_ar'];
$date_deces_hijri_fr = $_POST['date_deces_hijri_fr'];
$date_naiss_miladi_ar = $_POST['date_naiss_miladi_ar'];
$date_naiss_miladi_fr = $_POST['date_naiss_miladi_fr'];
$date_naiss_hijri_ar = $_POST['date_naiss_hijri_ar'];
$date_naiss_hijri_fr = $_POST['date_naiss_hijri_fr'];
$lieu_naiss_ar = $_POST['lieu_naiss_ar'];
$lieu_naiss = $_POST['lieu_naiss'];
$profession_ar = $_POST['profession_ar'];
$profession = $_POST['profession'];
$etat_famillial = $_POST['etat_famillial'];
$mr_mme_ar = $_POST['mr_mme_ar'];
$mr_mme = $_POST['mr_mme'];
$domicile_ar = $_POST['domicile_ar'];
$domicile = $_POST['domicile'];
$prenom_pere_ar = $_POST['prenom_pere_ar'];
$prenom_pere = $_POST['prenom_pere'];
$prenom_mere_ar = $_POST['prenom_mere_ar'];
$prenom_mere = $_POST['prenom_mere'];

$query="UPDATE `acte_deces` SET
`prenom_ar`=?,
`prenom`=?,
`nom_ar`=?,
`nom`=?,
`lieu_deces_ar`=?,
`lieu_deces`=?,
`date_deces_miladi_ar`=?,
`date_deces_miladi_fr`=?,
`date_deces_hijri_ar`=?,
`date_deces_hijri_fr`=?,
`date_naiss_miladi_ar`=?,
`date_naiss_miladi_fr`=?,
`date_naiss_hijri_ar`=?,
`date_naiss_hijri_fr`=?,
`lieu_naiss_ar`=?,
`lieu_naiss`=?,
`profession_ar`=?,
`profession`=?,
`etat_famillial`=?,
`mr_mme_ar`=?,
`mr_mme`=?,
`domicile_ar`=?,
`domicile`=?,
`prenom_pere_ar`=?,
`prenom_pere`=?,
`prenom_mere_ar`=?,
`prenom_mere`=?
 WHERE `numero`=? AND `annee`=?";

$pdoResult = $pdoConnect->prepare($query);

$pdoExec = $pdoResult->execute(array(
						$prenom_ar,
						$prenom,
						$nom_ar,
						$nom,
						$lieu_deces_ar,
						$lieu_deces,
						$date_deces_miladi_ar,
						$date_deces_miladi_fr,
						$date_deces_hijri_ar,
						$date_deces_hijri_fr,
						$date_naiss_miladi_ar,
						$date_naiss_miladi_fr,
						$date_naiss_hijri_ar,
						$date_naiss_hijri_fr,
						$lieu_naiss_ar,
						$lieu_naiss,
						$profession_ar,
						$profession,
						$etat_famillial,
						$mr_mme_ar,
						$mr_mme,
						$domicile_ar,
						$domicile,
						$prenom_pere_ar,
						$prenom_pere,
						$prenom_mere_ar,
						$prenom_mere,
						$numero,
						$annee
));
if($pdoExec)
{

    echo "success";
}else{

	echo 'error';
}


?>
