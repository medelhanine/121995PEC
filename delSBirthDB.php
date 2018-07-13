<?php
require "dbConnect.php";
require "myFuntionsDB.php";
$ds = DIRECTORY_SEPARATOR;
$numero = $_POST["numero"];
$annee = $_POST["annee"];
$scanFolder = "uploads".$ds."solbBirth".$ds.$numero.".".$annee;
delete_directory($scanFolder);
$query = "DELETE FROM `sbirth` WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($numero,$annee));


$query2 = "DELETE FROM `exbirth` WHERE `numero`=? AND `annee`=?";
$pdoResult2 = $pdoConnect->prepare($query2);
$pdoExec2 = $pdoResult2->execute(array($numero,$annee));


$query3 = "DELETE FROM `torabirth` WHERE `numero`=? AND `annee`=?";
$pdoResult3 = $pdoConnect->prepare($query3);
$pdoExec3 = $pdoResult3->execute(array($numero,$annee));

$query4 = "DELETE FROM `etat_civil` WHERE `numero`=? AND `annee`=?";
$pdoResult4 = $pdoConnect->prepare($query4);
$pdoExec4 = $pdoResult4->execute(array($numero,$annee));

?>
