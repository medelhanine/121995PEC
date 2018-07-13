<?php
require "dbConnect.php";
require "myFuntionsDB.php";
$ds = DIRECTORY_SEPARATOR;
$numero = $_POST["numero"];
$annee = $_POST["annee"];
$scanFolder = "uploads".$ds."tasrihNaiss".$ds.$numero.".".$annee;
delete_directory($scanFolder);
$query = "DELETE FROM `tasrih_naiss` WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($numero,$annee));




?>
