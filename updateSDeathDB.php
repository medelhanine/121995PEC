<?php
require 'dbConnect.php';

$numero= $request['numero'];
$annee = $request['annee'];
$prenom_ar = $request['prenom_ar'];
$prenom = $request['prenom'];
$nom_ar = $request['nom_ar'];
$nom = $request['nom'];
$prenom_tora_ar = $request['prenom_tora_ar'];
$prenom_tora = $request['prenom_tora'];
$nom_tora_ar = $request['nom_tora_ar'];
$nom_tora = $request['nom_tora'];
$cine = $request['cine'];
$lieu_deces_ar = $request['lieu_deces_ar'];
$lieu_deces = $request['lieu_deces'];
$commune_ar = $request['commune_ar'];
$commune = $request['commune'];
$date_deces_miladi = $request['date_deces_miladi'];
$date_deces_hijri = $request['date_deces_hijri'];
$date_deces_miladi_ar = $request['date_deces_miladi_ar'];
$date_deces_hijri_ar = $request['date_deces_hijri_ar'];
$date_deces_miladi_fr = $request['date_deces_miladi_fr'];
$date_deces_hijri_fr = $request['date_deces_hijri_fr'];
$heure = $request['heure'];
$minute = $request['minute'];
$sex = $request['sex'];
$lieu_naissance_ar = $request['lieu_naissance_ar'];
$lieu_naissance = $request['lieu_naissance'];
$date_naiss_miladi = $request['date_naiss_miladi'];
$date_naiss_hijri = $request['date_naiss_hijri'];
$date_naiss_miladi_ar = $request['date_naiss_miladi_ar'];
$date_naiss_hijri_ar = $request['date_naiss_hijri_ar'];
$date_naiss_miladi_fr = $request['date_naiss_miladi_fr'];
$date_naiss_hijri_fr = $request['date_naiss_hijri_fr'];
$profession_ar = $request['profession_ar'];
$profession = $request['profession'];
$nationalite_ar = $request['nationalite_ar'];
$nationalite = $request['nationalite'];
$domicile_ar = $request['domicile_ar'];
$domicile = $request['domicile'];
$etat_familiale = $request['etat_familiale'];
$mr_mme_ar = $request['mr_mme_ar'];
$mr_mme = $request['mr_mme'];
$nom_pere_ar = $request['nom_pere_ar'];
$nom_pere = $request['nom_pere'];
$dead_pere = $request['dead_pere'];
$nationalite_pere_ar = $request['nationalite_pere_ar'];
$nationalite_pere = $request['nationalite_pere'];
$domicile_pere_ar = $request['domicile_pere_ar'];
$domicile_pere = $request['domicile_pere'];
$ne_a_pere_ar = $request['ne_a_pere_ar'];
$ne_a_pere = $request['ne_a_pere'];
$date_naiss_pere_miladi = $request['date_naiss_pere_miladi'];
$date_naiss_pere_hijri = $request['date_naiss_pere_hijri'];
$date_naiss_pere_miladi_ar = $request['date_naiss_pere_miladi_ar'];
$date_naiss_pere_hijri_ar = $request['date_naiss_pere_hijri_ar'];
$date_naiss_pere_miladi_fr = $request['date_naiss_pere_miladi_fr'];
$date_naiss_pere_hijri_fr = $request['date_naiss_pere_hijri_fr'];
$lieu_naiss_pere_ar = $request['lieu_naiss_pere_ar'];
$lieu_naiss_pere = $request['lieu_naiss_pere'];
$profession_pere_ar = $request['profession_pere_ar'];
$profession_pere = $request['profession_pere'];
$nom_mere_ar = $request['nom_mere_ar'];
$nom_mere = $request['nom_mere'];
$dead_mere = $request['dead_mere'];
$nationalite_mere_ar = $request['nationalite_mere_ar'];
$nationalite_mere = $request['nationalite_mere'];
$domicile_mere_ar = $request['domicile_mere_ar'];
$domicile_mere = $request['domicile_mere'];
$ne_a_mere_ar = $request['ne_a_mere_ar'];
$ne_a_mere = $request['ne_a_mere'];
$date_naiss_mere_miladi = $request['date_naiss_mere_miladi'];
$date_naiss_mere_hijri = $request['date_naiss_mere_hijri'];
$date_naiss_mere_miladi_ar = $request['date_naiss_mere_miladi_ar'];
$date_naiss_mere_hijri_ar = $request['date_naiss_mere_hijri_ar'];
$date_naiss_mere_miladi_fr = $request['date_naiss_mere_miladi_fr'];
$date_naiss_mere_hijri_fr = $request['date_naiss_mere_hijri_fr'];
$lieu_naiss_mere_ar = $request['lieu_naiss_mere_ar'];
$lieu_naiss_mere = $request['lieu_naiss_mere'];
$profession_mere_ar = $request['profession_mere_ar'];
$profession_mere = $request['profession_mere'];
$selon_ar = $request['selon_ar'];
$selon = $request['selon'];
$age_mosarih_ar = $request['age_mosarih_ar'];
$age_mosarih = $request['age_mosarih'];
$domicile_mosarih_ar = $request['domicile_mosarih_ar'];
$domicile_mosarih = $request['domicile_mosarih'];
$ecrite_le_miladi = $request['ecrite_le_miladi'];
$ecrite_le_hijri = $request['ecrite_le_hijri'];
$ecrite_le_miladi_ar = $request['ecrite_le_miladi_ar'];
$ecrite_le_hijri_ar = $request['ecrite_le_hijri_ar'];
$ecrite_le_miladi_fr = $request['ecrite_le_miladi_fr'];
$ecrite_le_hijri_fr = $request['ecrite_le_hijri_fr'];
$heure_ecrit = $request['heure_ecrit'];
$min_ecrit = $request['min_ecrit'];

$par_nous_ar = $request['par_nous_ar'];
$par_nous = $request['par_nous'];
$officier_etat_civil_ar = $request['officier_etat_civil_ar'];
$officier_etat_civil = $request['officier_etat_civil'];

$query="UPDATE `sdeadtable` SET
`prenom_ar`=?,
`prenom`=?,
`nom_ar`=?,
`nom`=?,
`prenom_tora_ar`=?,
`prenom_tora`=?,
`nom_tora_ar`=?,
`nom_tora`=?,
`cine`=?,
`lieu_deces_ar`=?,
`lieu_deces`=?,
`commune_ar`=?,
`commune`=?,
`date_deces_miladi`=?,
`date_deces_hijri`=?,
`date_deces_miladi_ar`=?,
`date_deces_hijri_ar`=?,
`date_deces_miladi_fr`=?,
`date_deces_hijri_fr`=?,
`heure`=?,
`minute`=?,
`sex`=?,
`lieu_naissance_ar`=?,
`lieu_naissance`=?,
`date_naiss_miladi`=?,
`date_naiss_hijri`=?,
`date_naiss_miladi_ar`=?,
`date_naiss_hijri_ar`=?,
`date_naiss_miladi_fr`=?,
`date_naiss_hijri_fr`=?,
`profession_ar`=?,
`profession`=?,
`nationalite_ar`=?,
`nationalite`=?,
`domicile_ar`=?,
`domicile`=?,
`etat_familiale`=?,
`mr_mme_ar`=?,
`mr_mme`=?,
`nom_pere_ar`=?,
`nom_pere`=?,
`dead_pere`=?,
`nationalite_pere_ar`=?,
`nationalite_pere`=?,
`domicile_pere_ar`=?,
`domicile_pere`=?,
`ne_a_pere_ar`=?,
`ne_a_pere`=?,
`date_naiss_pere_miladi`=?,
`date_naiss_pere_hijri`=?,
`date_naiss_pere_miladi_ar`=?,
`date_naiss_pere_hijri_ar`=?,
`date_naiss_pere_miladi_fr`=?,
`date_naiss_pere_hijri_fr`=?,
`profession_pere_ar`=?,
`profession_pere`=?,
`nom_mere_ar`=?,
`nom_mere`=?,
`dead_mere`=?,
`nationalite_mere_ar`=?,
`nationalite_mere`=?,
`domicile_mere_ar`=?,
`domicile_mere`=?,
`ne_a_mere_ar`=?,
`ne_a_mere`=?,
`date_naiss_mere_miladi`=?,
`date_naiss_mere_hijri`=?,
`date_naiss_mere_miladi_ar`=?,
`date_naiss_mere_hijri_ar`=?,
`date_naiss_mere_miladi_fr`=?,
`date_naiss_mere_hijri_fr`=?,
`profession_mere_ar`=?,
`profession_mere`=?,
`selon_ar`=?,
`selon`=?,
`age_mosarih_ar`=?,
`age_mosarih`=?,
`domicile_mosarih_ar`=?,
`domicile_mosarih`=?,
`ecrite_le_miladi`=?,
`ecrite_le_hijri`=?,
`ecrite_le_miladi_ar`=?,
`ecrite_le_hijri_ar`=?,
`ecrite_le_miladi_fr`=?,
`ecrite_le_hijri_fr`=?,
`heure_ecrit`=?,
`min_ecrit`=?,
`par_nous_ar`=?,
`par_nous`=?,
`officier_etat_civil_ar`=?,
`officier_etat_civil`=?
 WHERE `numero`=? AND `annee`=?";

$pdoResult = $pdoConnect->prepare($query);
$pdoExec1 = $pdoResult->execute(array(
$prenom_ar,
$prenom,
$nom_ar,
$nom,
$prenom_tora_ar,
$prenom_tora,
$nom_tora_ar,
$nom_tora,
$cine,
$lieu_deces_ar,
$lieu_deces,
$commune_ar,
$commune,
$date_deces_miladi,
$date_deces_hijri,
$date_deces_miladi_ar,
$date_deces_hijri_ar,
$date_deces_miladi_fr,
$date_deces_hijri_fr,
$heure,
$minute,
$sex,
$lieu_naissance_ar,
$lieu_naissance,
$date_naiss_miladi,
$date_naiss_hijri,
$date_naiss_miladi_ar,
$date_naiss_hijri_ar,
$date_naiss_miladi_fr,
$date_naiss_hijri_fr,
$profession_ar,
$profession,
$nationalite_ar,
$nationalite,
$domicile_ar,
$domicile,
$etat_familiale,
$mr_mme_ar,
$mr_mme,
$nom_pere_ar,
$nom_pere,
$dead_pere,
$nationalite_pere_ar,
$nationalite_pere,
$domicile_pere_ar,
$domicile_pere,
$ne_a_pere_ar,
$ne_a_pere,
$date_naiss_pere_miladi,
$date_naiss_pere_hijri,
$date_naiss_pere_miladi_ar,
$date_naiss_pere_hijri_ar,
$date_naiss_pere_miladi_fr,
$date_naiss_pere_hijri_fr,
$profession_pere_ar,
$profession_pere,
$nom_mere_ar,
$nom_mere,
$dead_mere,
$nationalite_mere_ar,
$nationalite_mere,
$domicile_mere_ar,
$domicile_mere,
$ne_a_mere_ar,
$ne_a_mere,
$date_naiss_mere_miladi,
$date_naiss_mere_hijri,
$date_naiss_mere_miladi_ar,
$date_naiss_mere_hijri_ar,
$date_naiss_mere_miladi_fr,
$date_naiss_mere_hijri_fr,
$profession_mere_ar,
$profession_mere,
$selon_ar,
$selon,
$age_mosarih_ar,
$age_mosarih,
$domicile_mosarih_ar,
$domicile_mosarih,
$ecrite_le_miladi,
$ecrite_le_hijri,
$ecrite_le_miladi_ar,
$ecrite_le_hijri_ar,
$ecrite_le_miladi_fr,
$ecrite_le_hijri_fr,
$heure_ecrit,
$min_ecrit,
$par_nous_ar,
$par_nous,
$officier_etat_civil_ar,
$officier_etat_civil,
$numero,$annee
	));


//update acte deces
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
$pdoExec2 = $pdoResult->execute(array(
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
$lieu_naissance_ar,
$lieu_naissance,
$profession_ar,
$profession,
$etat_familiale,
$mr_mme_ar,
$mr_mme,
$domicile_ar,
$domicile,
$nom_pere_ar,
$nom_pere,
$nom_mere_ar,
$nom_mere,
$numero,$annee
	));


if($pdoExec1 && $pdoExec2)
{

   echo "success";
}else{

	echo 'error';
}


?>
