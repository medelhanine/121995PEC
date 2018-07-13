<?php
require "dbConnect.php";
if(isset($_POST["numero"]) && isset($_POST["annee"]))
{

  $numero=$_POST["numero"];
  $annee=$_POST["annee"];
  $query="SELECT * FROM `exbirth` WHERE `numero`=? AND `annee`=?";
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
    "date_naiss_miladi_ar"=>$result["date_naiss_miladi_ar"],
    "date_naiss_miladi"=>$result["date_naiss_miladi"],
    "lieu_naiss_ar"=>$result["lieu_naiss_ar"]

  );

}

else{
  $response = array(
    "prenom_ar"=>"",
    "prenom"=>"",
    "nom_ar"=>"",
    "nom"=>"",
    "date_naiss_miladi_ar"=>"",
    "date_naiss_miladi"=>"",
    "lieu_naiss_ar"=>""
  );

}

echo json_encode($response);

}

?>
