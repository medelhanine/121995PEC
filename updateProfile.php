<?php
require 'dbConnect.php';



$id_user= $request['id'];
$username= $request['username'];
$first_name= $request['first_name'];
$first_name_ar= $request['first_name_ar'];
$last_name_ar= $request['last_name_ar'];
$last_name= $request['last_name'];
$deleguer  = $request['deleguer'];
$prenom_delegue  = $request['prenom_delegue'];
$nom_delegue  = $request['nom_delegue'];
$prenom_delegue_ar  = $request['prenom_delegue_ar'];
$nom_delegue_ar  = $request['nom_delegue_ar'];


$query="UPDATE `users` SET
`username`=?,`first_name`=?,`first_name_ar`=?,`last_name_ar`=?,`last_name`=?,`deleguer`=?,`prenom_delegue`=?,`nom_delegue`=?,`prenom_delegue_ar`=?,`nom_delegue_ar`=? WHERE `id_user`=?";

$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array(
						$username,
						$first_name,
						$first_name_ar,
						$last_name_ar,
						$last_name,						
						$deleguer,						
						$prenom_delegue,
						$nom_delegue,
						$prenom_delegue_ar,
						$nom_delegue_ar,
            			$id_user
));
if($pdoExec)
{
    echo "success";
}else{
	echo 'error';
}


?>
