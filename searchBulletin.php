<?php
require "dbConnect.php";
if(isset($_POST["numero"]) && isset($_POST["annee"]))
{

  $numero=$_POST["numero"];
  $annee=$_POST["annee"];
  $query="SELECT * FROM `bulletin_individu` WHERE `numero`=? AND `annee`=?";
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
    "date_naiss_hijri_ar"=>$result["date_naiss_hijri_ar"],
    "date_naiss_miladi_ar"=>$result["date_naiss_miladi_ar"],
    "date_naiss_hijri_fr"=>$result["date_naiss_hijri_fr"],
    "date_naiss_miladi_fr"=>$result["date_naiss_miladi_fr"],
    "lieu_naiss_ar"=>$result["lieu_naiss_ar"],
    "lieu_naiss"=>$result["lieu_naiss"],
    "nom_pere_ar"=>$result["nom_pere_ar"],
    "nom_pere"=>$result["nom_pere"],
    "nom_mere_ar"=>$result["nom_mere_ar"],
    "nom_mere"=>$result["nom_mere"],
    "domicile_ar"=>$result["domicile_ar"],
    "domicile"=>$result["domicile"],
    "mention_marge_ar"=>$result["mention_marge_ar"],
    "mention_marge"=>$result["mention_marge"]
  );

}

else{

  $response = array(
    "prenom_ar"=>"",
    "prenom"=>"",
    "nom_ar"=>"",
    "nom"=>"",
    "date_naiss_hijri_ar"=>"",
    "date_naiss_miladi_ar"=>"",
    "date_naiss_hijri_fr"=>"",
    "date_naiss_miladi_fr"=>"",
    "lieu_naiss_ar"=>"",
    "lieu_naiss"=>"",
    "nom_pere_ar"=>"",
    "nom_pere"=>"",
    "nom_mere_ar"=>"",
    "nom_mere"=>"",
    "domicile_ar"=>"",
    "domicile"=>"",
    "mention_marge_ar"=>"",
    "mention_marge"=>""
  );

}

echo json_encode($response);

}

?>
