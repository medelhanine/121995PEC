<?php
require 'dbConnect.php';
$query='';
$output = '';
$pdoResult;
$i=1;

  $numero_etat_civil = $_POST['numero_etat_civil'];
	$numero= $_POST['numero'];
  $annee= $_POST['annee'];
//verify existance of all elements etat civil
//first verify if that numero and annee exists in resultExtBirth
$query="SELECT `numero`,`annee` FROM `exbirth` WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($numero,$annee));
$result=$pdoResult->fetch();
if($pdoResult->rowCount()>0)
{
  //verify if this child exists in other etat civil "AS" a child
  $query="SELECT `numero_etat_civil`,`numero`,`annee` FROM `etat_civil` WHERE `numero_etat_civil`=? AND `numero`=? AND `annee`=? AND type=2";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute(array($numero_etat_civil,$numero,$annee));
  $result=$pdoResult->fetch();
  if($pdoResult->rowCount()>0)
  {
    echo "this child already exist in other etat civil";
  }else {
    $query="INSERT INTO `etat_civil`(`numero_etat_civil`,`numero`,`annee`,`type`) VALUES (?,?,?,2)";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoResult->execute(array($numero_etat_civil,$numero,$annee));
    echo "inserted";
  }
}else {
  echo "child does not extist in database";
}


?>
