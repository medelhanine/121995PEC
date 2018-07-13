<?php
require 'dbConnect.php';
$request = $_REQUEST;

$tableDeath = $request["tableDeath"];
$tableBirth = $request["tableBirth"];

$query="SELECT `annee`, COUNT(*) FROM sdeadtable WHERE annee > 1999 GROUP BY annee ORDER BY annee";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute();
$result=$pdoResult->fetchAll();
echo json_encode($result);
 ?>
