<?php
require 'dbConnect.php';



$id_user= $request['id'];

$password= $request['password'];
$new_password= $request['new_password'];

$query="SELECT * FROM `users` WHERE password=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array(sha1($password)));

$result=$pdoResult->fetch();
   if($pdoResult->rowCount()>0)
   {
        $query="UPDATE `users` SET `password`=? WHERE `id_user`=?";
        $pdoResult = $pdoConnect->prepare($query);
        $pdoExec = $pdoResult->execute(array(sha1($new_password),$id_user));
        if($pdoExec)
        {
            echo "success";
        }else
        {           
         echo 'error';            
        }
   }else {
       echo "passwordNotExist";
   }



?>