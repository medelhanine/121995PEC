<?php
require "dbConnect.php";
if(isset($_POST["numero"]) && isset($_POST["annee"]))
{

  $numero=$_POST["numero"];
  $annee=$_POST["annee"];
  $query="SELECT * FROM `sbirth` WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($numero,$annee));
$result=$pdoResult->fetch();
if($pdoResult->rowCount()>0)
{
  $response = array(
    "prenom_ar"=>$result["prenom_ar"],
    "prenom"=>$result["prenom"],
    "nom_ar"=>$result["nom_ar"],
    "nom"=>$result["nom"],
    "lieu_naiss_ar"=>$result["lieu_naiss_ar"],
    "nationalite_ar"=>$result["nationalite_ar"],
    "date_naiss_hijri_ar"=>$result["date_naiss_hijri_ar"],
    "date_naiss_miladi_ar"=>$result["date_naiss_miladi_ar"],

    "nom_pere_ar"=>$result["nom_pere_ar"],
    "date_naiss_pere_hijri_ar"=>$result["date_naiss_pere_hijri_ar"],
    "date_naiss_pere_miladi_ar"=>$result["date_naiss_pere_miladi_ar"],
    "nationalite_pere_ar"=>$result["nationalite_pere_ar"],
    "adresse_parent_ar"=>$result["adresse_parent_ar"],
    "profession_pere_ar"=>$result["profession_pere_ar"],

    "nom_mere_ar"=>$result["nom_mere_ar"],
    "date_naiss_mere_hijri_ar"=>$result["date_naiss_mere_hijri_ar"],
    "date_naiss_mere_miladi_ar"=>$result["date_naiss_mere_miladi_ar"],
    "nationalite_mere_ar"=>$result["nationalite_mere_ar"],
    "profession_mere_ar"=>$result["profession_mere_ar"],
     
  );
}

else{
  $response = array(
    "prenom_ar"=>"",
    "prenom"=>"",
    "nom_ar"=>"",
    "nom"=>"",
    "lieu_naiss_ar"=>"",
    "nationalite_ar"=>"",
    "date_naiss_hijri_ar"=>"",
    "date_naiss_miladi_ar"=>"",
    "nom_pere_ar"=>"",
    "date_naiss_pere_hijri_ar"=>"",
    "date_naiss_pere_miladi_ar"=>"",
    "nationalite_pere_ar"=>"",
    "adresse_parent_ar"=>"",
    "profession_pere_ar"=>"",
    "nom_mere_ar"=>"",
    "date_naiss_mere_hijri_ar"=>"",
    "date_naiss_mere_miladi_ar"=>"",
    "nationalite_mere_ar"=>"",
    "profession_mere_ar"=>""
  );

}

echo json_encode($response);

}

?>
