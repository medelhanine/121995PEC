<?php
require "dbConnect.php";
require "myFuntionsDB.php";
$ds = DIRECTORY_SEPARATOR;
$numero = $_POST["numero"];
$annee = $_POST["annee"];

echo $numero;
$scanFolder = "uploads".$ds."acteDeces".$ds.$numero.".".$annee;
delete_directory($scanFolder);



$query2 = "DELETE FROM `acte_deces` WHERE `numero`=? AND `annee`=?";
$pdoResult2 = $pdoConnect->prepare($query2);
$pdoExec2 = $pdoResult2->execute(array($numero,$annee));


?>
