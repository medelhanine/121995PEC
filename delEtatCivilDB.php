<?php
require "dbConnect.php";

$numero_etat_civil = $_POST["numero_etat_civil_del"];


$query2 = "DELETE FROM `etat_civil` WHERE `numero_etat_civil`=?";
$pdoResult2 = $pdoConnect->prepare($query2);
$pdoExec2 = $pdoResult2->execute(array($numero_etat_civil));
?>
