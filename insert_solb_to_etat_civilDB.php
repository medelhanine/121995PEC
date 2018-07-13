<?php
require 'dbConnect.php';
$query='';
$output = '';
$pdoResult;
$i=1;

  $numero_etat_civil = $_POST['numero_etat_civil'];
	$numero= $_POST['numero'];
  $annee= $_POST['annee'];
  $type=$_POST["type"];



if($type == 1)//if type is father
{
  $query="SELECT `numero_etat_civil`,`annee`,`numero` FROM `etat_civil` WHERE `numero`=? AND `annee`=? AND `type`=1";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute(array($numero,$annee));
  $result=$pdoResult->fetch();
  if($pdoResult->rowCount()>0 )
  {
    echo "fatherAlreadyExists";
  }else {
    $query="INSERT INTO `etat_civil`(`numero_etat_civil`,`numero`,`annee`,`type`) VALUES (?,?,?,1)";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoResult->execute(array($numero_etat_civil,$numero,$annee));
    echo "father inserted";
  }

}

if($type == 2){

  $query="SELECT `numero_etat_civil`,`annee`,`numero` FROM `etat_civil` WHERE `numero`=? AND `annee`=? AND `type`=2";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute(array($numero,$annee));
  $result=$pdoResult->fetch();
  if($pdoResult->rowCount()>0 )
  {
    echo "sonAlreadyExists";
  }else {
    $query="INSERT INTO `etat_civil`(`numero_etat_civil`,`numero`,`annee`,`type`) VALUES (?,?,?,2)";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoResult->execute(array($numero_etat_civil,$numero,$annee));
    echo "son inerted";
  }

}




?>
