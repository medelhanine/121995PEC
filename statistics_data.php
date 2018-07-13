<?php
require 'dbConnect.php';
$request = $_REQUEST;
$tableDeath = $request["tableDeath"];
$tableBirth = $request["tableBirth"];


$query="SELECT `annee`, COUNT(*) FROM sbirth WHERE annee > 2018-21 GROUP BY annee ORDER BY annee";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute();
$result=$pdoResult->fetchAll();
echo json_encode($result);
 ?>
