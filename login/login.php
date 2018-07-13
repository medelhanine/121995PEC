<?php

$username = $mysqli->escape_string($_REQUEST['username']);
$pwd = $mysqli->escape_string($_REQUEST['password']);
$password = sha1($pwd);
$result = $mysqli->query("SELECT * FROM users WHERE username='$username' AND password=sha1('$pwd')");


if($result->num_rows > 0) { // User exists
    $user = $result->fetch_assoc();
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['first_name_ar'] = $user['first_name_ar'];
    $_SESSION['last_name_ar'] = $user['last_name_ar'];
    $_SESSION['last_name'] = $user['last_name'];    
    $_SESSION['superUser'] = $user['superUser'];
    $_SESSION['deleguer'] = $user['deleguer'];
    $_SESSION['prenom_delegue'] = $user['prenom_delegue'];
    $_SESSION['nom_delegue'] = $user['nom_delegue'];
    $_SESSION['prenom_delegue_ar'] = $user['prenom_delegue_ar'];
    $_SESSION['nom_delegue_ar'] = $user['nom_delegue_ar'];

    $_SESSION['logged_in'] = true;

    if($_SESSION['superUser'] == 1)
    {


        header("location: profileSuperUser.php");
    }
    else
    {

        header("location: ../index.php");
    }

} else {
    $_SESSION['message'] = "المعلومات خاطئة";
   
    header("location: error.php");
}
