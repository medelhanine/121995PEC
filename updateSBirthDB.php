<?php
require 'dbConnect.php';
$numero= $_POST['numero'];
$annee = $_POST['annee'] ;
$prenom_ar = $_POST['prenom_ar'];
$prenom = $_POST['prenom'];
$nom_ar = $_POST['nom_ar'];
$nom = $_POST['nom'];
$prenom_tora_ar = $_POST['prenom_tora_ar'];
$prenom_tora = $_POST['prenom_tora'];
$nom_tora_ar = $_POST['nom_tora_ar'];
$nom_tora = $_POST['nom_tora'];
$sex = $_POST['sex'];
$lieu_naiss_ar = $_POST['lieu_naiss_ar'];
$lieu_naiss = $_POST['lieu_naiss'];
$commune_ar = $_POST['commune_ar'];
$commune = $_POST['commune'];
$date_naiss_miladi = $_POST['date_naiss_miladi'];
$date_naiss_hijri = $_POST['date_naiss_hijri'];
$date_naiss_miladi_ar = $_POST['date_naiss_miladi_ar'];
$date_naiss_hijri_ar = $_POST['date_naiss_hijri_ar'];
$date_naiss_miladi_fr = $_POST['date_naiss_miladi_fr'];
$date_naiss_hijri_fr = $_POST['date_naiss_hijri_fr'];
$heure = $_POST['heure'];
$min_naiss = $_POST['min_naiss'];
$nationalite_ar = $_POST['nationalite_ar'];
$nationalite = $_POST['nationalite'];
$tora_deces_ar = $_POST['tora_deces_ar'];
$tora_deces = $_POST['tora_deces'];

$nom_pere_ar = $_POST['nom_pere_ar'];
$nom_pere = $_POST['nom_pere'];

$nom_pere_tora_ar = $_POST['nom_pere_tora_ar'];
$nom_pere_tora = $_POST['nom_pere_tora'];
$dead_pere = $_POST['dead_pere'];
$date_naiss_pere_miladi = $_POST['date_naiss_pere_miladi'];
$date_naiss_pere_hijri = $_POST['date_naiss_pere_hijri'];
$date_naiss_pere_miladi_ar = $_POST['date_naiss_pere_miladi_ar'];
$date_naiss_pere_hijri_ar = $_POST['date_naiss_pere_hijri_ar'];

$date_naiss_pere_miladi_fr = $_POST['date_naiss_pere_miladi_fr'];
$date_naiss_pere_hijri_fr = $_POST['date_naiss_pere_hijri_fr'];
$lieu_naiss_pere_ar = $_POST['lieu_naiss_pere_ar'];
$lieu_naiss_pere = $_POST['lieu_naiss_pere'];
$nationalite_pere_ar = $_POST['nationalite_pere_ar'];
$nationalite_pere = $_POST['nationalite_pere'];
$profession_pere_ar = $_POST['profession_pere_ar'];
$profession_pere = $_POST['profession_pere'];
$prof_pere_categ = $request['prof_pere_categ'];
$niveau_scol_pere_ar = $_POST['niveau_scol_pere_ar'];
$niveau_pere_scol = $_POST['niveau_pere_scol'];
$nom_mere_ar = $_POST['nom_mere_ar'];
$nom_mere = $_POST['nom_mere'];
$nom_mere_tora_ar = $_POST['nom_mere_tora_ar'];
$nom_mere_tora = $_POST['nom_mere_tora'];
$dead_mere = $_POST['dead_mere'];
$date_naiss_mere_miladi = $_POST['date_naiss_mere_miladi'];
$date_naiss_mere_hijri = $_POST['date_naiss_mere_hijri'];
$date_naiss_mere_miladi_ar = $_POST['date_naiss_mere_miladi_ar'];
$date_naiss_mere_hijri_ar = $_POST['date_naiss_mere_hijri_ar'];

$date_naiss_mere_miladi_fr = $_POST['date_naiss_mere_miladi_fr'];
$date_naiss_mere_hijri_fr = $_POST['date_naiss_mere_hijri_fr'];
$lieu_naiss_mere_ar = $_POST['lieu_naiss_mere_ar'];
$lieu_naiss_mere = $_POST['lieu_naiss_mere'];
$nationalite_mere_ar = $_POST['nationalite_mere_ar'];
$nationalite_mere = $_POST['nationalite_mere'];
$profession_mere_ar = $_POST['profession_mere_ar'];
$profession_mere = $_POST['profession_mere'];
$prof_mere_categ = $request['prof_mere_categ'];
$niveau_scol_mer_ar = $_POST['niveau_scol_mer_ar'];
$niveau_scol_mer = $_POST['niveau_scol_mer'];
$ordre_naiss = $_POST['ordre_naiss'];
$adresse_parent_ar = $_POST['adresse_parent_ar'];
$adresse_parent = $_POST['adresse_parent'];
$selon_ar = $_POST['selon_ar'];
$selon = $_POST['selon'];
$annonce_numero = $_POST['annonce_numero'];
$age_num_ar = $_POST['age_num_ar'];
$age_num_fr = $_POST['age_num_fr'];
$adresse_annonceur_ar = $_POST['adresse_annonceur_ar'];
$adresse_annonceur = $_POST['adresse_annonceur'];

$date_annonce_miladi = $_POST['date_annonce_miladi'];
$date_annonce_hijri = $_POST['date_annonce_hijri'];
$date_annonce_miladi_ar = $_POST['date_annonce_miladi_ar'];
$date_annonce_hijri_ar = $_POST['date_annonce_hijri_ar'];
$date_annonce_miladi_fr = $_POST['date_annonce_miladi_fr'];
$date_annonce_hijri_fr = $_POST['date_annonce_hijri_fr'];
$heure_ecrit = $_POST['heure_ecrit'];
$min_ecrit = $_POST['min_ecrit'];
$par_nous_ar = $_POST['par_nous_ar'];
$par_nous = $_POST['par_nous'];
$officier_etat_civil_ar = $_POST['officier_etat_civil_ar'];
$officier_etat_civil = $_POST['officier_etat_civil'];
$sejil_categ = $request['sejil_categ'];

$query="UPDATE `sbirth` SET
`prenom_ar`=?,
`prenom`=?,
`nom_ar`=?,
`nom`=?,
`prenom_tora_ar`=?,
`prenom_tora`=?,
`nom_tora_ar`=?,
`nom_tora`=?,
`sex`=?,
`lieu_naiss_ar`=?,
`lieu_naiss`=?,
`commune_ar`=?,
`commune`=?,
`date_naiss_miladi`=?,
`date_naiss_hijri`=?,
`date_naiss_miladi_ar`=?,
`date_naiss_hijri_ar`=?,
`date_naiss_miladi_fr`=?,
`date_naiss_hijri_fr`=?,
`heure`=?,
`min_naiss`=?,
`nationalite_ar`=?,
`nationalite`=?,
`tora_deces_ar`=?,
`tora_deces`=?,
`nom_pere_ar`=?,
`nom_pere`=?,
`nom_pere_tora_ar`=?,
`nom_pere_tora`=?,
`dead_pere`=?,
`date_naiss_pere_miladi`=?,
`date_naiss_pere_hijri`=?,
`date_naiss_pere_miladi_ar`=?,
`date_naiss_pere_hijri_ar`=?,
`date_naiss_pere_miladi_fr`=?,
`date_naiss_pere_hijri_fr`=?,
`lieu_naiss_pere_ar`=?,
`lieu_naiss_pere`=?,
`nationalite_pere_ar`=?,
`nationalite_pere`=?,
`profession_pere_ar`=?,
`profession_pere`=?,
`prof_pere_categ`=?,
`niveau_scol_pere_ar`=?,
`niveau_pere_scol`=?,
`nom_mere_ar`=?,
`nom_mere`=?,
`nom_mere_tora_ar`=?,
`nom_mere_tora`=?,
`dead_mere`=?,
`date_naiss_mere_miladi`=?,
`date_naiss_mere_hijri`=?,
`date_naiss_mere_miladi_ar`=?,
`date_naiss_mere_hijri_ar`=?,
`date_naiss_mere_miladi_fr`=?,
`date_naiss_mere_hijri_fr`=?,
`lieu_naiss_mere_ar`=?,
`lieu_naiss_mere`=?,
`nationalite_mere_ar`=?,
`nationalite_mere`=?,
`profession_mere_ar`=?,
`profession_mere`=?,
`prof_mere_categ`=?,
`niveau_scol_mer_ar`=?,
`niveau_scol_mer`=?,
`ordre_naiss`=?,
`adresse_parent_ar`=?,
`adresse_parent`=?,
`selon_ar`=?,
`selon`=?,
`annonce_numero`=?,
`age_num_ar`=?,
`age_num_fr`=?,
`adresse_annonceur_ar`=?,
`adresse_annonceur`=?,
`date_annonce_miladi`=?,
`date_annonce_hijri`=?,
`date_annonce_miladi_ar`=?,
`date_annonce_hijri_ar`=?,
`date_annonce_miladi_fr`=?,
`date_annonce_hijri_fr`=?,
`heure_ecrit`=?,
`min_ecrit`=?,
`par_nous_ar`=?,
`par_nous`=?,
`officier_etat_civil_ar`=?,
`officier_etat_civil`=?,
`sejil_categ` =?
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
									$sex,
								    $lieu_naiss_ar,
									$lieu_naiss,
									$commune_ar,
									$commune,
									$date_naiss_miladi,
									$date_naiss_hijri,
									$date_naiss_miladi_ar,
									$date_naiss_hijri_ar,
									$date_naiss_miladi_fr,
									$date_naiss_hijri_fr,
									$heure,
									$min_naiss,
									$nationalite_ar,
									$nationalite,
									$tora_deces_ar,
									$tora_deces,
									$nom_pere_ar,
									$nom_pere,
									$nom_pere_tora_ar,
									$nom_pere_tora,
									$dead_pere,
									$date_naiss_pere_miladi,
									$date_naiss_pere_hijri,
									$date_naiss_pere_miladi_ar,
									$date_naiss_pere_hijri_ar,
									$date_naiss_pere_miladi_fr,
									$date_naiss_pere_hijri_fr,
									$lieu_naiss_pere_ar,
									$lieu_naiss_pere,
									$nationalite_pere_ar,
									$nationalite_pere,
									$profession_pere_ar,
									$profession_pere,
									$prof_pere_categ,
									$niveau_scol_pere_ar,
									$niveau_pere_scol,
									$nom_mere_ar,
									$nom_mere,
									$nom_mere_tora_ar,
									$nom_mere_tora,
									$dead_mere,
									$date_naiss_mere_miladi,
									$date_naiss_mere_hijri,
									$date_naiss_mere_miladi_ar,
									$date_naiss_mere_hijri_ar,
									$date_naiss_mere_miladi_fr,
									$date_naiss_mere_hijri_fr,
									$lieu_naiss_mere_ar,
									$lieu_naiss_mere,
									$nationalite_mere_ar,
									$nationalite_mere,
								    $profession_mere_ar,
									$profession_mere,
									$prof_mere_categ,
									$niveau_scol_mer_ar,
									$niveau_scol_mer,
									$ordre_naiss,
									$adresse_parent_ar,
									$adresse_parent,
									$selon_ar,
									$selon,
                  					$annonce_numero,
									$age_num_ar,
									$age_num_fr,
									$adresse_annonceur_ar,
									$adresse_annonceur,
									$date_annonce_miladi,
									$date_annonce_hijri,
									$date_annonce_miladi_ar,
									$date_annonce_hijri_ar,
									$date_annonce_miladi_fr,
									$date_annonce_hijri_fr,
                  					$heure_ecrit,
                  					$min_ecrit,
									$par_nous_ar,
									$par_nous,
									$officier_etat_civil_ar,
									$officier_etat_civil,
									$sejil_categ,
	$numero,$annee
));


$query="UPDATE `exbirth` SET
`prenom_ar`=?,
`prenom`=?,
`nom_ar`=?,
`nom`=?,
`lieu_naiss_ar`=?,
`lieu_naiss`=?,
`date_naiss_hijri_ar`=?,
`date_naiss_hijri`=?,
`date_naiss_miladi_ar`=?,
`date_naiss_miladi`=?,
`tora_deces_ar`=?,
`tora_deces`=?,
`prenom_pere_ar`=?,
`prenom_pere`=?,
`prenom_mere_ar`=?,
`prenom_mere`=?
WHERE `numero`=? AND `annee`=?";


$pdoResult = $pdoConnect->prepare($query);

$pdoExec2 = $pdoResult->execute(array($prenom_ar,$prenom,$nom_ar,$nom,$lieu_naiss_ar,$lieu_naiss,$date_naiss_hijri_ar,$date_naiss_hijri,
$date_naiss_miladi_ar,$date_naiss_miladi,$tora_deces_ar,$tora_deces,$nom_pere_ar,$nom_pere,$nom_mere_ar,
$nom_mere,$numero,$annee));

if($pdoExec1 && $pdoExec2)
{

    echo "success";
}else{

	echo 'error';
}


?>
