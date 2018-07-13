<?php
require "dbConnect.php";
if(isset($_POST["numero"]) && isset($_POST["annee"]))
{

  $numero=$_POST["numero"];
  $annee=$_POST["annee"];
  $query="SELECT * FROM `tasrih_naiss` WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($numero,$annee));
$result=$pdoResult->fetch();
if($pdoResult->rowCount()>0)
{
  $response = array(
    "numero"=>$result["numero"],
    "date_naiss_hijri"=>$result["date_naiss_hijri"],
    "annee_naiss_hijri"=>$result["annee_naiss_hijri"],
    "date_naiss_miladi"=>$result["date_naiss_miladi"],
    "annee_naiss_miladi"=>$result["annee_naiss_miladi"],
    "heure"=>$result["heure"],
    "min"=>$result["min"],
    "lieu_naiss"=>$result["lieu_naiss"],
    "prenom_naiss"=>$result["prenom_naiss"],
    "prenom_naiss_fr"=>$result["prenom_naiss_fr"],
    "nom_naiss"=>$result["nom_naiss"],
    "nom_naiss_fr"=>$result["nom_naiss_fr"],
    "sex"=>$result["sex"],
    "nom_pere"=>$result["nom_pere"],
    "date_naiss_pere_hijri"=>$result["date_naiss_pere_hijri"],
    "annee_naiss_pere_hijri"=>$result["annee_naiss_pere_hijri"],
    "date_naiss_pere_miladi"=>$result["date_naiss_pere_miladi"],
    "annee_naiss_pere_miladi"=>$result["annee_naiss_pere_miladi"],
    "lieu_naiss_pere"=>$result["lieu_naiss_pere"],
    "niveau_scol_pere"=>$result["niveau_scol_pere"],
    "profession_pere"=>$result["profession_pere"],
    "nationalite_pere"=>$result["nationalite_pere"],
    "nom_mere"=>$result["nom_mere"],
    "date_naiss_mere_hijri"=>$result["date_naiss_mere_hijri"],
    "annee_naiss_mere_hijri"=>$result["annee_naiss_mere_hijri"],
    "date_naiss_mere_miladi"=>$result["date_naiss_mere_miladi"],
    "annee_naiss_mere_miladi"=>$result["annee_naiss_mere_miladi"],
    "lieu_naiss_mere"=>$result["lieu_naiss_mere"],
    "niveau_scol_mere"=>$result["niveau_scol_mere"],
    "profession_mere"=>$result["profession_mere"],
    "nationalite_mere"=>$result["nationalite_mere"],
    "ordre_naiss"=>$result["ordre_naiss"],
    "adresse_parent"=>$result["adresse_parent"],
    "date_ecrit_hijri"=>$result["date_ecrit_hijri"],
    "annee_ecrit_hijri"=>$result["annee_ecrit_hijri"],
    "date_ecrit_miladi"=>$result["date_ecrit_miladi"],
    "annee_ecrit_miladi"=>$result["annee_ecrit_miladi"],
    "selon_annonceur"=>$result["selon_annonceur"],
    "age_annonceur"=>$result["age_annonceur"],
    "adresse_annonceur"=>$result["adresse_annonceur"],
    "officier_etat_civil"=>$result["officier_etat_civil"]
  );

}else{

  $response = array(
    "numero"=>"",
    "date_naiss_hijri"=>"",
    "annee_naiss_hijri"=>"",
    "date_naiss_miladi"=>"",
    "annee_naiss_miladi"=>"",
    "heure"=>"",
    "min"=>"",
    "lieu_naiss"=>"",
    "prenom_naiss"=>"",
    "prenom_naiss_fr"=>"",
    "nom_naiss"=>"",
    "nom_naiss_fr"=>"",
    "sex"=>"",
    "nom_pere"=>"",
    "date_naiss_pere_hijri"=>"",
    "annee_naiss_pere_hijri"=>"",
    "date_naiss_pere_miladi"=>"",
    "annee_naiss_pere_miladi"=>"",
    "lieu_naiss_pere"=>"",
    "niveau_scol_pere"=>"",
    "profession_pere"=>"",
    "nationalite_pere"=>"",
    "nom_mere"=>"",
    "date_naiss_mere_hijri"=>"",
    "annee_naiss_mere_hijri"=>"",
    "date_naiss_mere_miladi"=>"",
    "annee_naiss_mere_miladi"=>"",
    "lieu_naiss_mere"=>"",
    "niveau_scol_mere"=>"",
    "profession_mere"=>"",
    "nationalite_mere"=>"",
    "ordre_naiss"=>"",
    "adresse_parent"=>"",
    "date_ecrit_hijri"=>"",
    "annee_ecrit_hijri"=>"",
    "date_ecrit_miladi"=>"",
    "annee_ecrit_miladi"=>"",
    "selon_annonceur"=>"",
    "age_annonceur"=>"",
    "adresse_annonceur"=>"",
    "officier_etat_civil"=>""
  );
}
echo json_encode($response);
}

?>
