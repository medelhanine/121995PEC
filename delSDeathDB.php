<?php
require "dbConnect.php";
require "myFuntionsDB.php";
$ds = DIRECTORY_SEPARATOR;
$numero = $_POST["numero"];
$annee = $_POST["annee"];
$scanFolder = "uploads".$ds."solbDeath".$ds.$numero.".".$annee;
delete_directory($scanFolder);
$query = "DELETE FROM `sdeadtable` WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($numero,$annee));


$query2 = "DELETE FROM `acte_deces` WHERE `numero`=? AND `annee`=?";
$pdoResult2 = $pdoConnect->prepare($query2);
$pdoExec2 = $pdoResult2->execute(array($numero,$annee));


$query3 = "DELETE FROM `toradeath` WHERE `numero`=? AND `annee`=?";
$pdoResult3 = $pdoConnect->prepare($query3);
$pdoExec3 = $pdoResult3->execute(array($numero,$annee));



?>
