<?php
require "dbConnect.php";

$numero= $_POST['numero'];
$annee = $_POST['annee'];
$rdv = $_POST['rdv'];
$date_naiss_hijri = $_POST['date_naiss_hijri'];
$annee_naiss_hijri = $_POST['annee_naiss_hijri'];
$date_naiss_miladi = $_POST['date_naiss_miladi'];
$annee_naiss_miladi = $_POST['annee_naiss_miladi'];
$heure = $_POST['heure'];
$min = $_POST['min'];
$lieu_naiss = $_POST['lieu_naiss'];
$prenom_naiss = $_POST['prenom_naiss'];
$prenom_naiss_fr = $_POST['prenom_naiss_fr'];
$nom_naiss = $_POST['nom_naiss'];
$nom_naiss_fr = $_POST['nom_naiss_fr'];
$sex = $_POST['sex'];
$nom_pere = $_POST['nom_pere'];
$date_naiss_pere_hijri = $_POST['date_naiss_pere_hijri'];
$annee_naiss_pere_hijri = $_POST['annee_naiss_pere_hijri'];
$date_naiss_pere_miladi = $_POST['date_naiss_pere_miladi'];
$annee_naiss_pere_miladi = $_POST['annee_naiss_pere_miladi'];
$lieu_naiss_pere = $_POST['lieu_naiss_pere'];
$niveau_scol_pere = $_POST['niveau_scol_pere'];
$profession_pere = $_POST['profession_pere'];
$nationalite_pere = $_POST['nationalite_pere'];
$nom_mere = $_POST['nom_mere'];
$date_naiss_mere_hijri = $_POST['date_naiss_mere_hijri'];
$annee_naiss_mere_hijri = $_POST['annee_naiss_mere_hijri'];
$date_naiss_mere_miladi = $_POST['date_naiss_mere_miladi'];
$annee_naiss_mere_miladi = $_POST['annee_naiss_mere_miladi'];
$lieu_naiss_mere = $_POST['lieu_naiss_mere'];
$niveau_scol_mere = $_POST['niveau_scol_mere'];
$profession_mere = $_POST['profession_mere'];
$nationalite_mere = $_POST['nationalite_mere'];
$ordre_naiss = $_POST['ordre_naiss'];
$adresse_parent = $_POST['adresse_parent'];
$date_ecrit_hijri = $_POST['date_ecrit_hijri'];
$annee_ecrit_hijri = $_POST['annee_ecrit_hijri'];
$date_ecrit_miladi = $_POST['date_ecrit_miladi'];
$annee_ecrit_miladi = $_POST['annee_ecrit_miladi'];
$selon_annonceur = $_POST['selon_annonceur'];
$age_annonceur = $_POST['age_annonceur'];
$profession_annonceur = $_POST['profession_annonceur'];
$nationalite_annonceur = $_POST['nationalite_annonceur'];
$liason_avec_naiss = $_POST['liason_avec_naiss'];
$adresse_annonceur = $_POST['adresse_annonceur'];
$officier_etat_civil = $_POST['officier_etat_civil'];
$dateInsert = $_POST['dateInsert'];



$query1 = "INSERT INTO `tasrih_naiss`(`numero`, `annee`, `rdv`, `date_naiss_hijri`, `annee_naiss_hijri`,
`date_naiss_miladi`, `annee_naiss_miladi`, `heure`, `min`, `lieu_naiss`,
`prenom_naiss`, `prenom_naiss_fr`, `nom_naiss`, `nom_naiss_fr`,
`sex`, `nom_pere`, `date_naiss_pere_hijri`, `annee_naiss_pere_hijri`,
`date_naiss_pere_miladi`, `annee_naiss_pere_miladi`, `lieu_naiss_pere`,
`niveau_scol_pere`, `profession_pere`, `nationalite_pere`, `nom_mere`,
`date_naiss_mere_hijri`, `annee_naiss_mere_hijri`, `date_naiss_mere_miladi`,
`annee_naiss_mere_miladi`, `lieu_naiss_mere`, `niveau_scol_mere`, `profession_mere`,
`nationalite_mere`, `ordre_naiss`, `adresse_parent`, `date_ecrit_hijri`,
`annee_ecrit_hijri`, `date_ecrit_miladi`, `annee_ecrit_miladi`,
`selon_annonceur`, `age_annonceur`, `profession_annonceur`,
`nationalite_annonceur`, `liason_avec_naiss`, `adresse_annonceur`,
`officier_etat_civil`,`dateInsert`)

VALUES(
:numero,
:annee,
:rdv,
:date_naiss_hijri,
:annee_naiss_hijri,
:date_naiss_miladi,
:annee_naiss_miladi,
:heure,
:min,
:lieu_naiss,
:prenom_naiss,
:prenom_naiss_fr,
:nom_naiss,
:nom_naiss_fr,
:sex,
:nom_pere,
:date_naiss_pere_hijri,
:annee_naiss_pere_hijri,
:date_naiss_pere_miladi,
:annee_naiss_pere_miladi,
:lieu_naiss_pere,
:niveau_scol_pere,
:profession_pere,
:nationalite_pere,
:nom_mere,
:date_naiss_mere_hijri,
:annee_naiss_mere_hijri,
:date_naiss_mere_miladi,
:annee_naiss_mere_miladi,
:lieu_naiss_mere,
:niveau_scol_mere,
:profession_mere,
:nationalite_mere,
:ordre_naiss,
:adresse_parent,
:date_ecrit_hijri,
:annee_ecrit_hijri,
:date_ecrit_miladi,
:annee_ecrit_miladi,
:selon_annonceur,
:age_annonceur,
:profession_annonceur,
:nationalite_annonceur,
:liason_avec_naiss,
:adresse_annonceur,
:officier_etat_civil,
:dateInsert
)";


$pdoResult1 = $pdoConnect->prepare($query1);
$pdoExec1 = $pdoResult1->execute(array(
									":numero"=>$numero,
									 ":annee"=>$annee,
									 ":rdv"=>$rdv,
									 ":date_naiss_hijri"=>$date_naiss_hijri,
									 ":annee_naiss_hijri"=>$annee_naiss_hijri,
									 ":date_naiss_miladi"=>$date_naiss_miladi,
									 ":annee_naiss_miladi"=>$annee_naiss_miladi,
									 ":heure"=>$heure,
									 ":min"=>$min,
									 ":lieu_naiss"=>$lieu_naiss,
									 ":prenom_naiss"=>$prenom_naiss,
									 ":prenom_naiss_fr"=>$prenom_naiss_fr,
									 ":nom_naiss"=>$nom_naiss,
									 ":nom_naiss_fr"=>$nom_naiss_fr,
									 ":sex"=>$sex,
									 ":nom_pere"=>$nom_pere,
									 ":date_naiss_pere_hijri"=>$date_naiss_pere_hijri,
									 ":annee_naiss_pere_hijri"=>$annee_naiss_pere_hijri,
									 ":date_naiss_pere_miladi"=>$date_naiss_pere_miladi,
									 ":annee_naiss_pere_miladi"=>$annee_naiss_pere_miladi,
									 ":lieu_naiss_pere"=>$lieu_naiss_pere,
									 ":niveau_scol_pere"=>$niveau_scol_pere,
									":profession_pere"=>$profession_pere,
									":nationalite_pere"=>$nationalite_pere,
									":nom_mere"=>$nom_mere,
									":date_naiss_mere_hijri"=>$date_naiss_mere_hijri,
									":annee_naiss_mere_hijri"=>$annee_naiss_mere_hijri,
									":date_naiss_mere_miladi"=>$date_naiss_mere_miladi,
									":annee_naiss_mere_miladi"=>$annee_naiss_mere_miladi,
									":lieu_naiss_mere"=>$lieu_naiss_mere,
									":niveau_scol_mere"=>$niveau_scol_mere,
									":profession_mere"=>$profession_mere,
									":nationalite_mere"=>$nationalite_mere,
									":ordre_naiss"=>$ordre_naiss,
									":adresse_parent"=>$adresse_parent,
									":date_ecrit_hijri"=>$date_ecrit_hijri,
									":annee_ecrit_hijri"=>$annee_ecrit_hijri,
									":date_ecrit_miladi"=>$date_ecrit_miladi,
									":annee_ecrit_miladi"=>$annee_ecrit_miladi,
									":selon_annonceur"=>$selon_annonceur,
									":age_annonceur"=>$age_annonceur,
									":profession_annonceur"=>$profession_annonceur,
									":nationalite_annonceur"=>$nationalite_annonceur,
									":liason_avec_naiss"=>$liason_avec_naiss,
									":adresse_annonceur"=>$adresse_annonceur,
									":officier_etat_civil"=>$officier_etat_civil,
									":dateInsert"=>$dateInsert,
									 ));

if($pdoExec1)
{
    echo 'successTasrih';
}else{
    echo 'errorTasrih';
}





?>
