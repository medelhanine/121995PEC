<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>وقع خطأ</title>
  <?php include 'css/css.html'; ?>
<link rel="stylesheet" href="../assets/css/someCss.css">
</head>
<body>
<div class="form">
    <h1>حدث خطأ</h1>
    <p>
    <?php
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        echo $_SESSION['message'];
    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>
    <a href="index.php"><button class="button button-block droid-arabic-kufi"/> حاول من جديد</button></a>
</div>
</body>
</html>
