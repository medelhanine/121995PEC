<?php
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>الحالة المدنية الرقمية </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="../assets/css/turbo.css" rel="stylesheet" />
     <link href="../assets/css/someCss.css" rel="stylesheet" />



  <?php include 'css/css.html'; ?>
  <style media="screen">
  #background{
    background-image: url("../assets/img/archive.jpg"); 
  
  }

  </style>
</head>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';

    }

    elseif (isset($_POST['register'])) { //user registering

        require 'register.php';

    }
}
?>
<body>
    <div id="background">
    
        <div class="wrapper wrapper-full-page">
            <div class="full-page login-page"  data-color="blue">
                <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                                <form action="index.php" method="post" autocomplete="off">
                                    <div class="card card-login card-hidden" style="margin-top: 10%;">
                                        <div class="card-header text-center">
                                        <img src="../assets/img/favicon.png" style="width:96px;hieght:96px;margin-top:5%">
                                            <h3 class="card-title droid-arabic-kufi">الحساب الشخصي</h3>
                                        </div>
                                        <div class="card-content">


                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">person</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label droid-arabic-kufi" style="font-size: 16px !important"> إسم الستخدم</label>
                                                    <input type="text" name="username" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label droid-arabic-kufi" style="font-size: 16px !important">كلمة السر </label>
                                                    <input type="password" name="password" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="login" class="btn btn-primary btn-wd btn-lg droid-arabic-kufi">تسجيل الدخول</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container">
                        <p class="copyright pull-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            SMARTGIS
                        </p>
                    </div>
                </footer>
            </div>
        </div>

    </div>
</body>

	<script src="../assets/vendors/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../assets/vendors/jquery-ui.min.js" type="text/javascript"></script>
<script src="../assets/vendors/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/vendors/material.min.js" type="text/javascript"></script>
<script src="../assets/vendors/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="../assets/vendors/jquery.bootstrap-wizard.js"></script>
<!-- Select Plugin -->
<script src="../assets/vendors/jquery.select-bootstrap.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="../assets/js/turbo.js"></script>

<script type="text/javascript">
    $().ready(function() {
        //demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>
    <script src="js/index.js"></script>
</html>
