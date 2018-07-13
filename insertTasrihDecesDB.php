<?php
require "dbConnect.php";

$numero= $_POST['numero'];
$annee = $_POST['annee'];
$rdv = $_POST['rdv'];
$date_deces_hijri = $_POST['date_deces_hijri'];
$annee_deces_hijri = $_POST['annee_deces_hijri'];
$date_deces_miladi = $_POST['date_deces_miladi'];
$annee_deces_miladi = $_POST['annee_deces_miladi'];
$heure = $_POST['heure'];
$min = $_POST['min'];
$lieu_deces = $_POST['lieu_deces'];
$prenom_deces = $_POST['prenom_deces'];
$prenom_deces_fr = $_POST['prenom_deces_fr'];
$nom_deces = $_POST['nom_deces'];
$nom_deces_fr = $_POST['nom_deces_fr'];
$sex = $_POST['sex'];
$nationalite = $_POST['nationalite'];
$adresse_deces = $_POST['adresse_deces'];
$date_naiss_hijri = $_POST['date_naiss_hijri'];
$annee_naiss_hijri = $_POST['annee_naiss_hijri'];
$date_naiss_miladi = $_POST['date_naiss_miladi'];
$annee_naiss_miladi = $_POST['annee_naiss_miladi'];
$lieu_naiss = $_POST['lieu_naiss'];
$etat_familiale = $_POST['etat_familiale'];
$niveau_scolaire = $_POST['niveau_scolaire'];
$profession = $_POST['profession'];
$nom_pere = $_POST['nom_pere'];
$date_naiss_pere_hijri = $_POST['date_naiss_pere_hijri'];
$annee_naiss_pere_hijri = $_POST['annee_naiss_pere_hijri'];
$date_naiss_pere_miladi = $_POST['date_naiss_pere_miladi'];
$annee_naiss_pere_miladi = $_POST['annee_naiss_pere_miladi'];
$adresse_pere = $_POST['adresse_pere'];
$profession_pere = $_POST['profession_pere'];
$nationalite_pere = $_POST['nationalite_pere'];
$nom_mere = $_POST['nom_mere'];
$date_naiss_mere_hijri = $_POST['date_naiss_mere_hijri'];
$annee_naiss_mere_hijri = $_POST['annee_naiss_mere_hijri'];
$date_naiss_mere_miladi = $_POST['date_naiss_mere_miladi'];
$annee_naiss_mere_miladi = $_POST['annee_naiss_mere_miladi'];
$adresse_mere = $_POST['adresse_mere'];
$profession_mere = $_POST['profession_mere'];
$nationalite_mere = $_POST['nationalite_mere'];
$date_ecrit_hijri = $_POST['date_ecrit_hijri'];
$annee_ecrit_hijri = $_POST['annee_ecrit_hijri'];
$date_ecrit_miladi = $_POST['date_ecrit_miladi'];
$annee_ecrit_miladi = $_POST['annee_ecrit_miladi'];
$selon_annonceur = $_POST['selon_annonceur'];
$age_annonceur = $_POST['age_annonceur'];
$profession_annonceur = $_POST['profession_annonceur'];
$nationalite_annonceur = $_POST['nationalite_annonceur'];
$liaison_avec_deces = $_POST['liaison_avec_deces'];
$adresse_annonceur = $_POST['adresse_annonceur'];
$officier_etat_civil = $_POST['officier_etat_civil'];
$dateInsert = $_POST['dateInsert'];



$query1 = "INSERT INTO `tasrih_deces`(`numero`, `annee`, `rdv`, `date_deces_hijri`, `annee_deces_hijri`,
`date_deces_miladi`, `annee_deces_miladi`, `heure`, `min`, `lieu_deces`, `prenom_deces`,
`prenom_deces_fr`, `nom_deces`, `nom_deces_fr`, `sex`, `nationalite`, `adresse_deces`, `date_naiss_hijri`, `annee_naiss_hijri`, `date_naiss_miladi`, `annee_naiss_miladi`,
`lieu_naiss`, `etat_familiale`, `niveau_scolaire`, `profession`, `nom_pere`, `date_naiss_pere_hijri`, `annee_naiss_pere_hijri`, `date_naiss_pere_miladi`, `annee_naiss_pere_miladi`,
`adresse_pere`, `profession_pere`, `nationalite_pere`, `nom_mere`, `date_naiss_mere_hijri`, `annee_naiss_mere_hijri`, `date_naiss_mere_miladi`, `annee_naiss_mere_miladi`, `adresse_mere`,
`profession_mere`, `nationalite_mere`, `date_ecrit_hijri`, `annee_ecrit_hijri`, `date_ecrit_miladi`, `annee_ecrit_miladi`, `selon_annonceur`, `age_annonceur`, `profession_annonceur`,
`nationalite_annonceur`, `liaison_avec_deces`, `adresse_annonceur`, `officier_etat_civil`, `dateInsert`)

VALUES(
:numero,
:annee,
:rdv,
:date_deces_hijri,
:annee_deces_hijri,
:date_deces_miladi,
:annee_deces_miladi,
:heure,
:min,
:lieu_deces,
:prenom_deces,
:prenom_deces_fr,
:nom_deces,
:nom_deces_fr,
:sex,
:nationalite,
:adresse_deces,
:date_naiss_hijri,
:annee_naiss_hijri,
:date_naiss_miladi,
:annee_naiss_miladi,
:lieu_naiss,
:etat_familiale,
:niveau_scolaire,
:profession,
:nom_pere,
:date_naiss_pere_hijri,
:annee_naiss_pere_hijri,
:date_naiss_pere_miladi,
:annee_naiss_pere_miladi,
:adresse_pere,
:profession_pere,
:nationalite_pere,
:nom_mere,
:date_naiss_mere_hijri,
:annee_naiss_mere_hijri,
:date_naiss_mere_miladi,
:annee_naiss_mere_miladi,
:adresse_mere,
:profession_mere,
:nationalite_mere,
:date_ecrit_hijri,
:annee_ecrit_hijri,
:date_ecrit_miladi,
:annee_ecrit_miladi,
:selon_annonceur,
:age_annonceur,
:profession_annonceur,
:nationalite_annonceur,
:liaison_avec_deces,
:adresse_annonceur,
:officier_etat_civil,
:dateInsert
)";


$pdoResult1 = $pdoConnect->prepare($query1);
$pdoExec1 = $pdoResult1->execute(array(
									":numero"=>$numero,
									 ":annee"=>$annee,
									 ":rdv"=>$rdv,
                   ":date_deces_hijri"=>$date_deces_hijri,
                   ":annee_deces_hijri"=>$annee_deces_hijri,
                   ":date_deces_miladi"=>$date_deces_miladi,
                   ":annee_deces_miladi"=>$annee_deces_miladi,
                   ":heure"=>$heure,
                   ":min"=>$min,
                   ":lieu_deces"=>$lieu_deces,
                   ":prenom_deces"=>$prenom_deces,
                   ":prenom_deces_fr"=>$prenom_deces_fr,
                   ":nom_deces"=>$nom_deces,
                   ":nom_deces_fr"=>$nom_deces_fr,
                   ":sex"=>$sex,
                   ":nationalite"=>$nationalite,
                   ":adresse_deces"=>$adresse_deces,
                   ":date_naiss_hijri"=>$date_naiss_hijri,
                   ":annee_naiss_hijri"=>$annee_naiss_hijri,
                   ":date_naiss_miladi"=>$date_naiss_miladi,
                   ":annee_naiss_miladi"=>$annee_naiss_miladi,
                   ":lieu_naiss"=>$lieu_naiss,
                   ":etat_familiale"=>$etat_familiale,
                   ":niveau_scolaire"=>$niveau_scolaire,
                   ":profession"=>$profession,
                   ":nom_pere"=>$nom_pere,
                   ":date_naiss_pere_hijri"=>$date_naiss_pere_hijri,
                   ":annee_naiss_pere_hijri"=>$annee_naiss_pere_hijri,
                   ":date_naiss_pere_miladi"=>$date_naiss_pere_miladi,
                   ":annee_naiss_pere_miladi"=>$annee_naiss_pere_miladi,
                   ":adresse_pere"=>$adresse_pere,
                   ":profession_pere"=>$profession_pere,
                   ":nationalite_pere"=>$nationalite_pere,
                   ":nom_mere"=>$nom_mere,
                   ":date_naiss_mere_hijri"=>$date_naiss_mere_hijri,
                   ":annee_naiss_mere_hijri"=>$annee_naiss_mere_hijri,
                   ":date_naiss_mere_miladi"=>$date_naiss_mere_miladi,
                   ":annee_naiss_mere_miladi"=>$annee_naiss_mere_miladi,
                   ":adresse_mere"=>$adresse_mere,
                   ":profession_mere"=>$profession_mere,
                   ":nationalite_mere"=>$nationalite_mere,
									":date_ecrit_hijri"=>$date_ecrit_hijri,
									":annee_ecrit_hijri"=>$annee_ecrit_hijri,
									":date_ecrit_miladi"=>$date_ecrit_miladi,
									":annee_ecrit_miladi"=>$annee_ecrit_miladi,
									":selon_annonceur"=>$selon_annonceur,
									":age_annonceur"=>$age_annonceur,
									":profession_annonceur"=>$profession_annonceur,
                  ":nationalite_annonceur"=>$nationalite_annonceur,
									":liaison_avec_deces"=>$liaison_avec_deces,
									":adresse_annonceur"=>$adresse_annonceur,
									":officier_etat_civil"=>$officier_etat_civil,
									":dateInsert"=>$dateInsert
									 ));

if($pdoExec1)
{
    echo 'successTasrih';
}else{
    echo 'errorTasrih';
}





?>
