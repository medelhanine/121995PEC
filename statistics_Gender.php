<?php
require 'dbConnect.php';
$request = $_REQUEST;

$tableDeath = $request["tableDeath"];
$tableBirth = $request["tableBirth"];

$query = "select  COUNT(*)as tot,
  COUNT(case when sbirth.sex='masculin' then 1 end) as male,
  COUNT(case when sbirth.sex='feminin' then 1 end) as female
  from sbirth  WHERE annee=2000";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute();
$result=$pdoResult->fetch();



echo json_encode($result);

 ?>
