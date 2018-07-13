<?php
require 'dbConnect.php';
$query='';
$pdoResult;

$numero = $_POST["numero"];
$annee = $_POST["annee"];

if(trim($numero)!="" && trim($annee)!="")
{
  $query="SELECT  * FROM `sbirth` WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($numero,$annee));
}
$result=$pdoResult->fetch();
if($pdoResult->rowCount()>0)
{
  $dataArray = array(
    "prenom_ar"=>$result["prenom_ar"],
    "prenom"=>$result["prenom"],
    "nom_ar"=>$result["nom_ar"],
    "nom"=>$result["nom"],
    "nom_tora_ar"=>$result["nom_tora_ar"],
    "nom_tora"=>$result["nom_tora"],
    "lieu_naiss_ar"=>$result["lieu_naiss_ar"],
    "lieu_naiss"=>$result["lieu_naiss"],
    "date_naiss_miladi"=>$result["date_naiss_miladi"],
    "date_naiss_hijri"=>$result["date_naiss_hijri"],
    "date_naiss_miladi_ar"=>$result["date_naiss_miladi_ar"],
    "date_naiss_hijri_ar"=>$result["date_naiss_hijri_ar"],
    "date_naiss_miladi_fr"=>$result["date_naiss_miladi_fr"],
    "date_naiss_hijri_fr"=>$result["date_naiss_hijri_fr"],
    "nationalite_ar"=>$result["nationalite_ar"],
    "nationalite"=>$result["nationalite"]
  );


}else {
  $dataArray = array(
    "prenom_ar"=>"",
    "prenom"=>"",
    "nom_ar"=>"",
    "nom"=>"",
    "nom_tora_ar"=>"",
    "nom_tora"=>"",
    "lieu_naiss_ar"=>"",
    "lieu_naiss"=>"",
    "date_naiss_miladi"=>"",
    "date_naiss_hijri"=>"",
    "date_naiss_miladi_ar"=>"",
    "date_naiss_hijri_ar"=>"",
    "date_naiss_miladi_fr"=>"",
    "date_naiss_hijri_fr"=>"",
    "nationalite_ar"=>"",
    "nationalite"=>""
  );
}
echo json_encode($dataArray);
?>
