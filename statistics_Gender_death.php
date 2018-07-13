<?php
require 'dbConnect.php';
$request = $_REQUEST;

$tableDeath = $request["tableDeath"];
$tableBirth = $request["tableBirth"];


$query2 = "select  COUNT(*)as tot,
  COUNT(case when sdeadtable.sex='masculin' then 1 end) as maleDeath,
  COUNT(case when sdeadtable.sex='feminin' then 1 end) as femaleDeath
  from sdeadtable  WHERE annee=2000";
$pdoResult2 = $pdoConnect->prepare($query2);
$pdoResult2->execute();
$result2=$pdoResult2->fetch();


echo json_encode($result2);
 ?>
