<?php
require 'dbConnect.php';
$query='';
$output = '';
$pdoResult;

	$numero_etat_civil= $_POST['numero_etat_civil'];


	$query="SELECT `numero_etat_civil`, `numero`, `annee`, `type` FROM `etat_civil` WHERE `numero_etat_civil`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero_etat_civil));
  $result=$pdoResult->fetch();

if($pdoResult->rowCount()>0)
{
 echo $result["numero_etat_civil"];
}
else
{
	echo "noDataFound";
}


?>
