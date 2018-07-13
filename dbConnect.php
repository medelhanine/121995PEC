<?php
   try{
    $pdoConnect = new PDO("mysql:host=localhost;dbname=etat_civil_db","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
	   $pdoConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	   $pdoConnect->exec("SET CHARACTER SET UTF8");

}catch(PDOException $exc)
{
    echo $exc->getMessage();
    exit();
}


$communeName = " زاوية سيدي الطاهر ";
$communeName_fr = "ZAOUIAT SIDI TAHAR";
$nationalite = "marocaine";
$nationalite_ar = "مغربية";


$ActualDate = date('d/m/Y');
$anneActu = substr($ActualDate,6,4);
$monthActu = substr($ActualDate,3,2);
$request = $_REQUEST;
?>
