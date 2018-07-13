<?php
require "dbConnect.php";
require "myFuntionsDB.php";
$ds = DIRECTORY_SEPARATOR;
$numero = $_POST["numero"];
$annee = $_POST["annee"];
$scanFolder = "uploads".$ds."tasrihDeces".$ds.$numero.".".$annee;
delete_directory($scanFolder);
$query = "DELETE FROM `tasrih_deces` WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($numero,$annee));




?>
