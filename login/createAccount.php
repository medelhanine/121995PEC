<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign-Up/Login Form</title>
  <?php include 'css/css.html'; ?>
</head>

<?php 
if ( $_SESSION['logged_in'] != 1 && $_SESSION['superUser'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['register'])) { //user logging in

        require 'register.php';
        
    }
    
   
}

?>
<body>
  <div class="form">
      
      <h1>CREATE ACCOUNT</h1>
      <hr>
      

         
          
        <div id="signup">   
          <h1>Sign Up </h1>
          
          <form action="index.php" method="post" >
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required  name='firstname' />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required  name='lastname' />
            </div>
          </div>

          <div class="field-wrap">
            <label>
            Username<span class="req">*</span>
            </label>
            <input type="username"required  name='username' />
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password"required  name='password'/>
          </div>
          
          <button type="submit" class="button button-block" name="register" />Register</button>
          
        </form>

        </div>  
        
    
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
