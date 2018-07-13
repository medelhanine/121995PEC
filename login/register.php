<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['username'] = $_POST['username'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$username = $mysqli->escape_string($_POST['username']);
$pwd = $mysqli->escape_string(sha1($_POST['password']));
//$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
//$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
      
// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM users WHERE username='$username'") or die($mysqli->error());

// We know username exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'Username already exists!';
    header("location: error.php");
    
}
else { // username doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (first_name, last_name, username, password) ". "VALUES ('$first_name','$last_name','$username','$pwd')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 1; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        /*$_SESSION['message'] =
                
                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Account Verification ( clevertechie.com )';*/
        
        echo "success";

        header("location: profile.php"); 

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}
