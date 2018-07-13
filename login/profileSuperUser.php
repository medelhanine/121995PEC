<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 && $_SESSION['superUser'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $username = $_SESSION['username'];
    $superUser = $_SESSION['superUser'];
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= $username ?></title>
  <?php include 'css/css.html'; ?>
</head>

<body>
  <div class="form">
  

          <h1>مرحبا</h1>
          
          <p>
          
     
         SUPER USER
         
          </p>
          
         <p>
          
          <h2><?php echo $username ?></h2>
          </p>
          
         
          <p><a href="../searchSolb.php"><button class="button button-block" name="logout"/>الحساب الشخصي</button></a></p>
          <a href="createAccount.php"><button class="button button-block" name="register">إضافة حساب</button></a>
         
    </div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
