<?php
require 'dbConnect.php';

$numero= $request['numero'];
$annee= $request['annee'];
$prenom_ar= $request['prenom_ar'];
$prenom= $request['prenom'];
$nom_ar= $request['nom_ar'];
$nom= $request['nom'];
$lieu_naiss_ar= $request['lieu_naiss_ar'];
$lieu_naiss= $request['lieu_naiss'];
$date_naiss_hijri_ar= $request['date_naiss_hijri_ar'];
$date_naiss_hijri= $request['date_naiss_hijri'];
$date_naiss_miladi_ar= $request['date_naiss_miladi_ar'];
$date_naiss_miladi= $request['date_naiss_miladi'];
$tora_deces_ar= $request['tora_deces_ar'];
$tora_deces= $request['tora_deces'];
$prenom_pere_ar= $request['prenom_pere_ar'];
$prenom_pere= $request['prenom_pere'];
$prenom_mere_ar= $request['prenom_mere_ar'];
$prenom_mere= $request['prenom_mere'];



$query="UPDATE `exbirth` SET
`prenom_ar`=?,
`prenom`=?,
`nom_ar`=?,
`nom`=?,
`lieu_naiss_ar`=?,
`lieu_naiss`=?,
`date_naiss_hijri_ar`=?,
`date_naiss_hijri`=?,
`date_naiss_miladi_ar`=?,
`date_naiss_miladi`=?,
`tora_deces_ar`=?,
`tora_deces`=?,
`prenom_pere_ar`=?,
`prenom_pere`=?,
`prenom_mere_ar`=?,
`prenom_mere`=?
 WHERE `numero`=? AND `annee`=?";

$pdoResult = $pdoConnect->prepare($query);

$pdoExec = $pdoResult->execute(array(
						$prenom_ar,
						$prenom,
						$nom_ar,
						$nom,
						$lieu_naiss_ar,
						$lieu_naiss,
						$date_naiss_miladi,
						$date_naiss_hijri,
						$date_naiss_miladi_ar,
						$date_naiss_hijri_ar,
						$tora_deces_ar,
						$tora_deces,
						$prenom_pere_ar,
						$prenom_pere,
						$prenom_mere_ar,
						$prenom_mere,
						$numero,
						$annee
));
if($pdoExec)
{

    echo "success";
}else{

	echo 'error';
}


?>
