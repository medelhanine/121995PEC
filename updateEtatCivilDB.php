<?php
require 'dbConnect.php';
$query='';
$output = '';
$pdoResult;


  $numero_etat_civil = $_POST['numero_etat_civil'];
	$numero_pere= $_POST['numero_pere'];
  $annee_pere= $_POST['annee_pere'];

//insert pere
$query="SELECT `annee`,`numero` FROM `exbirth` WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($numero_pere,$annee_pere));
$result=$pdoResult->fetch();
if($pdoResult->rowCount()>0)/// check if this exist
{
  $query="SELECT * FROM `etat_civil` WHERE `numero`=? AND `annee`=? AND `numero_etat_civil`=? AND `type`=1";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute(array($numero_pere,$annee_pere,$numero_etat_civil));
  $result=$pdoResult->fetch();
  if($pdoResult->rowCount()>0)
  {
    echo "already exists";
  }else {
    $query="UPDATE `etat_civil` SET `numero`=?,`annee`=? WHERE `numero_etat_civil`=? AND `type`=1";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoResult->execute(array($numero_pere,$annee_pere,$numero_etat_civil));
    echo "updated father";
  }

}
else
{
echo "no data found";
}

?>
