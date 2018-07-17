<?php
require "dbConnect.php";

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
$sex = $request['sex'];
$lieu_naiss_ar = $request['lieu_naiss_ar'];
$lieu_naiss = $request['lieu_naiss'];
$commune_ar = $request['commune_ar'];
$commune = $request['commune'];
$date_naiss_miladi = $request['date_naiss_miladi'];
$date_naiss_hijri = $request['date_naiss_hijri'];
$date_naiss_miladi_ar = $request['date_naiss_miladi_ar'];
$date_naiss_hijri_ar = $request['date_naiss_hijri_ar'];
$date_naiss_miladi_fr = $request['date_naiss_miladi_fr'];
$date_naiss_hijri_fr = $request['date_naiss_hijri_fr'];
$heure = $request['heure'];
$min_naiss = $request['min_naiss'];
$nationalite_ar = $request['nationalite_ar'];
$nationalite = $request['nationalite'];
$tora_deces_ar = $request['tora_deces_ar'];
$tora_deces = $request['tora_deces'];
$nom_pere_ar = $request['nom_pere_ar'];
$nom_pere = $request['nom_pere'];
$nom_pere_tora_ar = $request['nom_pere_tora_ar'];
$nom_pere_tora = $request['nom_pere_tora'];
$dead_pere = $request['dead_pere'];
$date_naiss_pere_miladi = $request['date_naiss_pere_miladi'];
$date_naiss_pere_hijri = $request['date_naiss_pere_hijri'];
$date_naiss_pere_miladi_ar = $request['date_naiss_pere_miladi_ar'];
$date_naiss_pere_hijri_ar = $request['date_naiss_pere_hijri_ar'];
$date_naiss_pere_miladi_fr = $request['date_naiss_pere_miladi_fr'];
$date_naiss_pere_hijri_fr = $request['date_naiss_pere_hijri_fr'];
$lieu_naiss_pere_ar = $request['lieu_naiss_pere_ar'];
$lieu_naiss_pere = $request['lieu_naiss_pere'];
$nationalite_pere_ar = $request['nationalite_pere_ar'];
$nationalite_pere = $request['nationalite_pere'];
$profession_pere_ar = $request['profession_pere_ar'];
$profession_pere = $request['profession_pere'];
$prof_pere_categ = $request['prof_pere_categ'];
$niveau_scol_pere_ar = $request['niveau_scol_pere_ar'];
$niveau_pere_scol = $request['niveau_pere_scol'];
$nom_mere_ar = $request['nom_mere_ar'];
$nom_mere = $request['nom_mere'];
$nom_mere_tora_ar = $request['nom_mere_tora_ar'];
$nom_mere_tora = $request['nom_mere_tora'];
$dead_mere = $request['dead_mere'];
$date_naiss_mere_miladi = $request['date_naiss_mere_miladi'];
$date_naiss_mere_hijri = $request['date_naiss_mere_hijri'];
$date_naiss_mere_miladi_ar = $request['date_naiss_mere_miladi_ar'];
$date_naiss_mere_hijri_ar = $request['date_naiss_mere_hijri_ar'];
$date_naiss_mere_miladi_fr = $request['date_naiss_mere_miladi_fr'];
$date_naiss_mere_hijri_fr = $request['date_naiss_mere_hijri_fr'];
$lieu_naiss_mere_ar = $request['lieu_naiss_mere_ar'];
$lieu_naiss_mere = $request['lieu_naiss_mere'];
$nationalite_mere_ar = $request['nationalite_mere_ar'];
$nationalite_mere = $request['nationalite_mere'];
$profession_mere_ar = $request['profession_mere_ar'];
$profession_mere = $request['profession_mere'];
$prof_mere_categ = $request['prof_mere_categ'];
$niveau_scol_mer_ar = $request['niveau_scol_mer_ar'];
$niveau_scol_mer = $request['niveau_scol_mere'];
$ordre_naiss = $request['ordre_naiss'];
$adresse_parent_ar = $request['adresse_parent_ar'];
$adresse_parent = $request['adresse_parent'];
$selon_ar = $request['selon_ar'];
$annonce_numero = $request['annonce_numero'];
$selon = $request['selon'];
$age_num_ar = $request['age_num_ar'];
$age_num_fr = $request['age_num_fr'];
$adresse_annonceur_ar = $request['adresse_annonceur_ar'];
$adresse_annonceur = $request['adresse_annonceur'];
$date_annonce_miladi = $request['date_annonce_miladi'];
$date_annonce_hijri = $request['date_annonce_hijri'];
$date_annonce_miladi_ar = $request['date_annonce_miladi_ar'];
$date_annonce_hijri_ar = $request['date_annonce_hijri_ar'];
$date_annonce_miladi_fr = $request['date_annonce_miladi_fr'];
$date_annonce_hijri_fr = $request['date_annonce_hijri_fr'];

$heure_ecrit = $request['heure_ecrit'];
$min_ecrit = $request['min_ecrit'];

$par_nous_ar = $request['par_nous_ar'];
$par_nous = $request['par_nous'];
$officier_etat_civil_ar = $request['officier_etat_civil_ar'];
$officier_etat_civil = $request['officier_etat_civil'];

$sejil_categ = $request['sejil_categ'];





$query1 = "INSERT INTO `sbirth`(
`numero`,
`annee`,
`prenom_ar`,
`prenom`,
`nom_ar`,
`nom`,
`prenom_tora_ar`,
`prenom_tora`,
`nom_tora_ar`,
`nom_tora`,
`sex`,
`lieu_naiss_ar`,
`lieu_naiss`,
`commune_ar`,
`commune`,
`date_naiss_miladi`,
`date_naiss_hijri`,
`date_naiss_miladi_ar`,
`date_naiss_hijri_ar`,
`date_naiss_miladi_fr`,
`date_naiss_hijri_fr`,
`heure`,
`min_naiss`,
`nationalite_ar`,
`nationalite`,
`tora_deces_ar`,
`tora_deces`,
`nom_pere_ar`,
`nom_pere`,
`nom_pere_tora_ar`,
`nom_pere_tora`,
`dead_pere`,
`date_naiss_pere_miladi`,
`date_naiss_pere_hijri`,
`date_naiss_pere_miladi_ar`,
`date_naiss_pere_hijri_ar`,
`date_naiss_pere_miladi_fr`,
`date_naiss_pere_hijri_fr`,
`lieu_naiss_pere_ar`,
`lieu_naiss_pere`,
`nationalite_pere_ar`,
`nationalite_pere`,
`profession_pere_ar`,
`profession_pere`,
`prof_pere_categ`,
`niveau_scol_pere_ar`,
`niveau_pere_scol`,
`nom_mere_ar`,
`nom_mere`,
`nom_mere_tora_ar`,
`nom_mere_tora`,
`dead_mere`,
`date_naiss_mere_miladi`,
`date_naiss_mere_hijri`,
`date_naiss_mere_miladi_ar`,
`date_naiss_mere_hijri_ar`,
`date_naiss_mere_miladi_fr`,
`date_naiss_mere_hijri_fr`,
`lieu_naiss_mere_ar`,
`lieu_naiss_mere`,
`nationalite_mere_ar`,
`nationalite_mere`,
`profession_mere_ar`,
`profession_mere`,
`prof_mere_categ`,
`niveau_scol_mer_ar`,
`niveau_scol_mer`,
`ordre_naiss`,
`adresse_parent_ar`,
`adresse_parent`,
`selon_ar`,
`selon`,
`annonce_numero`,
`age_num_ar`,
`age_num_fr`,
`adresse_annonceur_ar`,
`adresse_annonceur`,
`date_annonce_miladi`,
`date_annonce_hijri`,
`date_annonce_miladi_ar`,
`date_annonce_hijri_ar`,
`date_annonce_miladi_fr`,
`date_annonce_hijri_fr`,
`heure_ecrit`,
`min_ecrit`,
`par_nous_ar`,
`par_nous`,
`officier_etat_civil_ar`,
`officier_etat_civil`,
`sejil_categ`
)

VALUES(
:numero,
:annee,
:prenom_ar,
:prenom,
:nom_ar,
:nom,
:prenom_tora_ar,
:prenom_tora,
:nom_tora_ar,
:nom_tora,
:sex,
:lieu_naiss_ar,
:lieu_naiss,
:commune_ar,
:commune,
:date_naiss_miladi,
:date_naiss_hijri,
:date_naiss_miladi_ar,
:date_naiss_hijri_ar,
:date_naiss_miladi_fr,
:date_naiss_hijri_fr,
:heure,
:min_naiss,
:nationalite_ar,
:nationalite,
:tora_deces_ar,
:tora_deces,

:nom_pere_ar,
:nom_pere,

:nom_pere_tora_ar,
:nom_pere_tora,
:dead_pere,
:date_naiss_pere_miladi,
:date_naiss_pere_hijri,
:date_naiss_pere_miladi_ar,
:date_naiss_pere_hijri_ar,
:date_naiss_pere_miladi_fr,
:date_naiss_pere_hijri_fr,
:lieu_naiss_pere_ar,
:lieu_naiss_pere,
:nationalite_pere_ar,
:nationalite_pere,
:profession_pere_ar,
:profession_pere,
:prof_pere_categ,
:niveau_scol_pere_ar,
:niveau_pere_scol,
:nom_mere_ar,
:nom_mere,
:nom_mere_tora_ar,
:nom_mere_tora,
:dead_mere,
:date_naiss_mere_miladi,
:date_naiss_mere_hijri,
:date_naiss_mere_miladi_ar,
:date_naiss_mere_hijri_ar,
:date_naiss_mere_miladi_fr,
:date_naiss_mere_hijri_fr,
:lieu_naiss_mere_ar,
:lieu_naiss_mere,
:nationalite_mere_ar,
:nationalite_mere,
:profession_mere_ar,
:profession_mere,
:prof_mere_categ,
:niveau_scol_mer_ar,
:niveau_scol_mer,
:ordre_naiss,
:adresse_parent_ar,
:adresse_parent,
:selon_ar,
:selon,
:annonce_numero,
:age_num_ar,
:age_num_fr,
:adresse_annonceur_ar,
:adresse_annonceur,
:date_annonce_miladi,
:date_annonce_hijri,
:date_annonce_miladi_ar,
:date_annonce_hijri_ar,
:date_annonce_miladi_fr,
:date_annonce_hijri_fr,
:heure_ecrit,
:min_ecrit,
:par_nous_ar,
:par_nous,
:officier_etat_civil_ar,
:officier_etat_civil,
:sejil_categ
)";


$pdoResult1 = $pdoConnect->prepare($query1);
$pdoExec1 = $pdoResult1->execute(array(
									":numero"=>$numero,
									 ":annee"=>$annee,
									 ":prenom_ar"=>$prenom_ar,
									 ":prenom"=>$prenom,
									 ":nom_ar"=>$nom_ar,
									 ":nom"=>$nom,
									 ":prenom_tora_ar"=>$prenom_tora_ar,
									 ":prenom_tora"=>$prenom_tora,
									 ":nom_tora_ar"=>$nom_tora_ar,
									 ":nom_tora"=>$nom_tora,
									 ":sex"=>$sex,
									 ":lieu_naiss_ar"=>$lieu_naiss_ar,
									 ":lieu_naiss"=>$lieu_naiss,
									 ":commune_ar"=>$commune_ar,
									 ":commune"=>$commune,
									 ":date_naiss_miladi"=>$date_naiss_miladi,
									 ":date_naiss_hijri"=>$date_naiss_hijri,
									 ":date_naiss_miladi_ar"=>$date_naiss_miladi_ar,
									 ":date_naiss_hijri_ar"=>$date_naiss_hijri_ar,
									 ":date_naiss_miladi_fr"=>$date_naiss_miladi_fr,
									 ":date_naiss_hijri_fr"=>$date_naiss_hijri_fr,
									 ":heure"=>$heure,
									":min_naiss"=>$min_naiss,
									":nationalite_ar"=>$nationalite_ar,
									":nationalite"=>$nationalite,
									":tora_deces_ar"=>$tora_deces_ar,
									":tora_deces"=>$tora_deces,

									":nom_pere_ar"=>$nom_pere_ar,
									":nom_pere"=>$nom_pere,

									":nom_pere_tora_ar"=>$nom_pere_tora_ar,
									":nom_pere_tora"=>$nom_pere_tora,
									":dead_pere"=>$dead_pere,
									":date_naiss_pere_miladi"=>$date_naiss_pere_miladi,
									":date_naiss_pere_hijri"=>$date_naiss_pere_hijri,
									":date_naiss_pere_miladi_ar"=>$date_naiss_pere_miladi_ar,
									":date_naiss_pere_hijri_ar"=>$date_naiss_pere_hijri_ar,
									":date_naiss_pere_miladi_fr"=>$date_naiss_pere_miladi_fr,
									":date_naiss_pere_hijri_fr"=>$date_naiss_pere_hijri_fr,
									":lieu_naiss_pere_ar"=>$lieu_naiss_pere_ar,
									":lieu_naiss_pere"=>$lieu_naiss_pere,
									":nationalite_pere_ar"=>$nationalite_pere_ar,
									":nationalite_pere"=>$nationalite_pere,
									":profession_pere_ar"=>$profession_pere_ar,
									":profession_pere"=>$profession_pere,
									":prof_pere_categ"=>$prof_pere_categ,
									":niveau_scol_pere_ar"=>$niveau_scol_pere_ar,
									":niveau_pere_scol"=>$niveau_pere_scol,
									":nom_mere_ar"=>$nom_mere_ar,
									":nom_mere"=>$nom_mere,
									":nom_mere_tora_ar"=>$nom_mere_tora_ar,
									":nom_mere_tora"=>$nom_mere_tora,
									":dead_mere"=>$dead_mere,
									":date_naiss_mere_miladi"=>$date_naiss_mere_miladi,
									":date_naiss_mere_hijri"=>$date_naiss_mere_hijri,
									":date_naiss_mere_miladi_ar"=>$date_naiss_mere_miladi_ar,
									":date_naiss_mere_hijri_ar"=>$date_naiss_mere_hijri_ar,
									":date_naiss_mere_miladi_fr"=>$date_naiss_mere_miladi_fr,
									":date_naiss_mere_hijri_fr"=>$date_naiss_mere_hijri_fr,
									":lieu_naiss_mere_ar"=>$lieu_naiss_mere_ar,
									":lieu_naiss_mere"=>$lieu_naiss_mere,
									":nationalite_mere_ar"=>$nationalite_mere_ar,
									":nationalite_mere"=>$nationalite_mere,
									":profession_mere_ar"=>$profession_mere_ar,
									":profession_mere"=>$profession_mere,
									":prof_mere_categ"=>$prof_mere_categ,
									":niveau_scol_mer_ar"=>$niveau_scol_mer_ar,
									":niveau_scol_mer"=>$niveau_scol_mer,
									":ordre_naiss"=>$ordre_naiss,
									":adresse_parent_ar"=>$adresse_parent_ar,
									":adresse_parent"=>$adresse_parent,
									":selon_ar"=>$selon_ar,
									":selon"=>$selon,
									":annonce_numero"=>$annonce_numero,
									":age_num_ar"=>$age_num_ar,
									":age_num_fr"=>$age_num_fr,
									":adresse_annonceur_ar"=>$adresse_annonceur_ar,
									":adresse_annonceur"=>$adresse_annonceur,
									":date_annonce_miladi"=>$date_annonce_miladi,
									":date_annonce_hijri"=>$date_annonce_hijri,
									":date_annonce_miladi_ar"=>$date_annonce_miladi_ar,
									":date_annonce_hijri_ar"=>$date_annonce_hijri_ar,
									":date_annonce_miladi_fr"=>$date_annonce_miladi_fr,
									":date_annonce_hijri_fr"=>$date_annonce_hijri_fr,
									":heure_ecrit"=>$heure_ecrit,
									":min_ecrit"=>$min_ecrit,
									":par_nous_ar"=>$par_nous_ar,
									":par_nous"=>$par_nous,
									":officier_etat_civil_ar"=>$officier_etat_civil_ar,
									":officier_etat_civil"=>$officier_etat_civil,
									":sejil_categ"=>$sejil_categ
									 ));

if($pdoExec1)
{
    echo 'successSBirth';
}else{
    echo 'errorSBirth';
}


//insert in extrait table
$query2 = "INSERT INTO `exbirth`(
`numero`,
`annee`,
`prenom_ar`,
`prenom`,
`nom_ar`,
`nom`,
`lieu_naiss_ar`,
`lieu_naiss`,
`date_naiss_hijri_ar`,
`date_naiss_hijri`,
`date_naiss_miladi_ar`,
`date_naiss_miladi`,
`tora_deces_ar`,
`tora_deces`,
`prenom_pere_ar`,
`prenom_pere`,
`prenom_mere_ar`,
`prenom_mere`
)
VALUES(
:numero,
:annee,
:prenom_ar,
:prenom,
:nom_ar,
:nom,
:lieu_naiss_ar,
:lieu_naiss,
:date_naiss_hijri_ar,
:date_naiss_hijri,
:date_naiss_miladi_ar,
:date_naiss_miladi,
:tora_deces_ar,
:tora_deces,
:prenom_pere_ar,
:prenom_pere,
:prenom_mere_ar,
:prenom_mere
)";


$pdoResult2 = $pdoConnect->prepare($query2);
$pdoExec2 = $pdoResult2->execute(array(":numero"=>$numero,
									 ":annee"=>$annee,
									 ":prenom_ar"=>$prenom_ar,
									 ":prenom"=>$prenom,
									 ":nom_ar"=>$nom_ar,
									 ":nom"=>$nom,
									 ":lieu_naiss_ar"=>$lieu_naiss_ar,
									 ":lieu_naiss"=>$lieu_naiss,
									 ":date_naiss_hijri_ar"=>$date_naiss_hijri_ar,
									 ":date_naiss_hijri"=>$date_naiss_hijri,
									 ":date_naiss_miladi_ar"=>$date_naiss_miladi_ar,
									 ":date_naiss_miladi"=>$date_naiss_miladi,
									 ":tora_deces_ar"=>$tora_deces_ar,
									 ":tora_deces"=>$tora_deces,
									 ":prenom_pere_ar"=>$nom_pere_ar,
									 ":prenom_pere"=>$nom_pere,
									 ":prenom_mere_ar"=>$nom_mere_ar,
									 ":prenom_mere"=>$nom_mere
									 
									 ));

if($pdoExec2)
{
    echo 'successExtrait';
}else{
    echo 'errorExtrait';
}


//Filters***********
//truncate table 
/*$query="
TRUNCATE filter_prenom;
TRUNCATE filter_nom;
TRUNCATE filter_nom_mere;
TRUNCATE filter_nom_pere;
TRUNCATE filter_niveau_scol_mere;
TRUNCATE filter_niveau_scol_pere;
TRUNCATE filter_officier_etat_civil;
TRUNCATE filter_prof_mere;
TRUNCATE filter_prof_pere";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute();*/


$query="INSERT INTO filter_prenom(prenom_ar)  VALUES (?);";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($prenom_ar));


$query="INSERT INTO filter_nom  VALUES (?);";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($nom_ar));


$query="INSERT INTO filter_lieu_naiss  VALUES (?);";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($lieu_naiss_ar));


$query="INSERT INTO filter_nom_mere  VALUES (?);";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($nom_mere_ar));


$query="INSERT INTO filter_nom_pere  VALUES (?);";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($nom_pere_ar));

$query="INSERT INTO filter_prof_mere  VALUES (?);";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($profession_mere_ar));

$query="INSERT INTO filter_prof_pere  VALUES (?);";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($profession_pere_ar));

$query="INSERT INTO filter_niveau_scol_mere  VALUES (?);";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($niveau_scol_mer_ar));


$query="INSERT INTO filter_niveau_scol_pere  VALUES (?);";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($niveau_scol_pere_ar));


$query="INSERT INTO filter_officier_etat_civil  VALUES (?);";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($officier_etat_civil_ar));


?>
