<?php
require "dbConnect.php";

 $numero =$_POST["numero"];
  $annee =$_POST["annee"];


$query= "UPDATE `sdeadtable` SET `validate`=1 WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($numero,$annee));

if($pdoExec)
{
  echo "success";
}
else {
  echo "error";
}
?>
