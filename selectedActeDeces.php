<?php
 require "dbConnect.php";
 session_start();

 // Check if user is logged in using the session variable
 if ( $_SESSION['logged_in'] != 1 ) {
   $_SESSION['message'] = "You must log in before viewing your profile page!";
   header("location: login/error.php");
 }
 else {
     // Makes it easier to read
     $first_name = $_SESSION['first_name'];
     $last_name = $_SESSION['last_name'];
     $username = $_SESSION['username'];
     //$superUser = $_SESSION['superUser'];
 }
	$query='';
	$pdoResult = '';
	/*$nomAr = $_GET["nom_ar"];
	$nom = $_GET["nom"];
	$numero = $_GET["numero"];
	$annee = $_GET["annee"];*/



?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>الحالة المدنية الرقمية</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="assets/css/turbo.css" rel="stylesheet" />
    <!--perfect Scrollbar-->
	<link href="assets/css/perfect-scrollbar.css" rel="stylesheet" />


    <!--some CSS-->
     <link href="assets/css/someCss.css" rel="stylesheet">
      <!--drop zone-->
     <link href="assets/vendors/dropzone/dropzone.min.css" rel="stylesheet">
     <link href="assets/css/jquery.datetimepicker.css" rel="stylesheet">

     <style media="screen">
       .dropzone{
         border: 2px dashed #BBB;
         border-radius: 5px;
       }
     </style>

</head>

<body class="rtl-layout"  style="overflow: hidden !important;">
    <div class="wrapper">
    <div class="sidebar" data-background-color="gray">
            <div class="logo">
               <div style="text-align: center;" class="picture">
                  <a href="profile.php">
                  <img src="assets/img/faces/avatar.png" class="img-circle picture-src" width="100px" height="100px" style="max-height: 150px;border: 4px solid #CCCCCC;">
                  </a>
               </div>
               <h4 style="text-align: center;" class="droid-arabic-kufi">
                  <?php echo $username ?>
               </h4>
            </div>
            <div class="sidebar-wrapper">
               <ul class="nav m-padding">
                  <li >
                     <a href="index.php">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/home.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;">الرئيسية </p>
                     </a>
                  </li>

                  <li>
                     <a href="#" data-toggle="modal" data-target=".general_search">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/search_general.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;">    بحث عام </p>
                     </a>
                  </li>
                  <li>
                     <a href="#" data-toggle="modal" data-target=".etatCivil">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/open-book.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;">  كناش الحالة المدنية </p>
                     </a>
                  </li>
                  <li>
                     <a data-toggle="collapse" href="#dbBayane" class="collapsed" aria-expanded="false">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/contract.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;"> بيان الزواج و الطلاق
                           <b class="caret"></b>
                        </p>
                     </a>
                     <div class="collapse" id="dbBayane" aria-expanded="false" style="height: 0px;">
                        <ul class="nav">
                           <li>
                              <a href="#" class="sous-page droid-arabic-kufi"  data-toggle="modal" data-target=".avis_mariage">
                                 <img class="material-icons" style="width:20px;height:20px;display:inline;" src="svg/auction.svg">
                                 <p class="m-pages droid-arabic-kufi" style="display:inline;"> الزواج</p>
                              </a>
                           </li>
                           <li style="margin-bottom: 10%;">
                              <a href="#" class="sous-page droid-arabic-kufi" data-toggle="modal" data-target=".avis_divorce">
                                 <img class="material-icons" style="width:20px;height:20px;display:inline;" src="svg/auction.svg">
                                 <p class="m-pages droid-arabic-kufi" style="display:inline;"> الطلاق  </p>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </li>
                  <!--Ahkam and Tasarih-->
                  <li>
                     <a data-toggle="collapse" href="#dbAhkamTasarih" class="collapsed" aria-expanded="false">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/auction.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;"> الأحكام و التصاريح
                           <b class="caret"></b>
                        </p>
                     </a>
                     <div class="collapse" id="dbAhkamTasarih" aria-expanded="false" style="height: 0px;">
                        <ul class="nav">
                           <li>
                              <a href="#" class="sous-page droid-arabic-kufi" data-toggle="modal" data-target=".tasrihNaiss">
                                 <img class="material-icons" style="width:20px;height:20px;display:inline;" src="svg/search-document.svg">
                                 <p class="m-pages droid-arabic-kufi" style="display:inline;"> التصريح بالولادة </p>
                              </a>
                           </li>
                           <li style="margin-bottom: 10%;">
                              <a href="#" class="sous-page droid-arabic-kufi" data-toggle="modal" data-target=".tasrihDeces">
                                 <img class="material-icons" style="width:20px;height:20px;display:inline;" src="svg/search-document-red.svg">
                                 <p class="m-pages droid-arabic-kufi" style="display:inline;"> التصريح بالوفاة  </p>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </li>
                  <!--End Ahkam Tasarih-->
                  <!--db management-->
                  <li >
                     <a data-toggle="collapse" href="#dbSolb" class="collapsed" aria-expanded="false">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/notebook.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;"> قاعدة بيانات الصلب
                           <b class="caret"></b>
                        </p>
                     </a>
                     <div class="collapse" id="dbSolb" aria-expanded="false" style="height: 0px;">
                        <ul class="nav">
                           <li style="line-height: 0 !important">
                              <a href="#" class="sous-page droid-arabic-kufi" data-toggle="modal" data-target=".solbNaiss">
                                 <img class="material-icons" style="width:20px;height:20px;display:inline;" src="svg/search-document.svg">
                                 <p class="m-pages droid-arabic-kufi" style="display:inline;"> صلب الولادات</p>
                              </a>
                           </li>
                           <li>
                              <a href="#" class="sous-page droid-arabic-kufi" data-toggle="modal" data-target=".solbDeath">
                                 <img class="material-icons" style="width:20px;height:20px;display:inline;" src="svg/search-document-red.svg">
                                 <p class="m-pages droid-arabic-kufi" style="display:inline;">  صلب الوفيات </p>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </li>
                  <li>
                     <a data-toggle="collapse" href="#dbTorar" class="collapsed" aria-expanded="false">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/message-on-a-sticky-note.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;">قاعدة بيانات الطرر
                           <b class="caret"></b>
                        </p>
                     </a>
                     <div class="collapse" id="dbTorar" aria-expanded="false" style="height: 0px;">
                        <ul class="nav">
                           <li>
                              <a href="#" class="sous-page droid-arabic-kufi" data-toggle="modal" data-target=".torarBirth">
                                 <img class="material-icons" style="width:20px;height:20px;display:inline;" src="svg/search-document.svg">
                                 <p class="m-pages droid-arabic-kufi" style="display:inline;">  طرر الولادات  </p>
                              </a>
                           </li>
                           <li>
                              <a href="#" class="sous-page droid-arabic-kufi" data-toggle="modal" data-target=".torarDeath">
                                 <img class="material-icons" style="width:20px;height:20px;display:inline;" src="svg/search-document-red.svg">
                                 <p class="m-pages droid-arabic-kufi" style="display:inline;">  طرر الوفيات </p>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </li>
                  <li class="active">
                     <a data-toggle="collapse" href="#dbExtrait" class="collapsed" aria-expanded="false">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/file.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;">قاعدة بيانات العقود
                           <b class="caret"></b>
                        </p>
                     </a>
                     <div class="collapse" id="dbExtrait" aria-expanded="false" style="height: 0px;">
                        <ul class="nav">
                           <li>
                              <a href="#" class="sous-page droid-arabic-kufi" data-toggle="modal" data-target=".extraitNaiss">
                                 <img class="material-icons" style="width:20px;height:20px;display:inline;" src="svg/search-document.svg">
                                 <p class="m-pages droid-arabic-kufi" style="display:inline;">  عقود الإزدياد </p>
                              </a>
                           </li>
                           <li style="margin-bottom: 10%;" class="active">
                              <a href="#" class="sous-page droid-arabic-kufi" data-toggle="modal" data-target=".acteDeces">
                                 <img class="material-icons" style="width:20px;height:20px;display:inline;" src="svg/search-document-red.svg">
                                 <p class="m-pages droid-arabic-kufi" style="display:inline;">  رسوم الوفيات </p>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </li>
                  <li>
                     <a href="filter.php">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/filtering-data.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;"> انتقاء البيانات</p>
                     </a>
                  </li>
                  <!--irsal-->
                  <li>
                     <a href="irsal.php" >
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/send-file.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;">   الإرسالات و التقارير </p>
                     </a>
                  </li>
                  <!--end irsal-->
                  <!--Archive Numeriques-->
                  <li>
                     <a href="archive_numerique.php">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/archive.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;"> الأرشيف الرقمي </p>
                     </a>
                  </li>
                  <li>
                     <a href="statistiques.php">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/graph.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;">إحصائيات</p>
                     </a>
                  </li>
                  <!-- end db management-->
               </ul>
            </div>
         </div>
        <div class="main-panel">
          <nav class="navbar navbar-default navbar-absolute" data-topbar-color="blue">
             <div class="container-fluid">
                <div class="collapse navbar-collapse">
                   <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img class="material-icons" style="width:40px;height:40px;display:inline;" src="svg/user.svg">
                            <p class="hidden-lg hidden-md">
                               profile
                               <b class="caret"></b>
                            </p>
                         </a>
                         <ul class="dropdown-menu">
                            <li>
                               <a href="profile.php" class="droid-arabic-kufi">الحساب الشخصي</a>
                            </li>
                            <li>
                               <a href="login/logout.php" class="droid-arabic-kufi">خروج</a>
                            </li>
                         </ul>
                      </li>
                      <li class="separator hidden-lg hidden-md"></li>
                   </ul>
                   <h2 class="droid-arabic-kufi" style="text-align: center;margin: 0;margin-left: 7%">جماعة <?php echo $communeName ?></h2>
                </div>
             </div>
          </nav>
            <!--content div-->
            <div class="content">

              <!--etat civil modal-->
               <div class="modal fade etatCivil" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog  m-modal-margin" role="document" style="margin-top: 100px !important;">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="searchEtatCivilDB.php" method="post" class="searchEtatCivil">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم</h4>
                                 <div class="col-md-5">
                                 </div>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                       <input type="text" name="numero_etat_civil" id="numero_etat_civil" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc by num-->
                        </div>
                        <div class="modal-footer">
                           <div style="text-align: center">
                              <a href="insertEtatCivil.php">
                              <button type="button"  class="btn btn-info m-margin-left">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/rounded-add-button.svg">
                              </span>
                              <b class="droid-arabic-kufi">إضافة</b>
                              </button>
                              </a>
                              <button class="btn btn-info"  data-dismiss="modal">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/delete-button.svg">
                              </span>
                              <b class="droid-arabic-kufi">إلغاء</b>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end etat civil modal-->

                <!--modal search genral-->
               <div class="modal fade general_search" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg m-modal-margin" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="gereralSearchNumDB.php" method="post" class="gereralSearchNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee"  class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                       <input type="text" name="numero"  class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc   by num-->
                           <!--searhc by name-->
                           <form action="gereralSearchNameDB.php" method="post" class="gereralSearchName">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الإسم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم الفرنسي</label>
                                       <input type="text" name="nameFr" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم العربي</label>
                                       <input type="text" name="nameAr" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!--end searhc by name-->
                           <!--table result-->
                           <div class="row">
                              <div class="table-responsive m-scroll" id="divResultgereralSearch">
                              </div>
                           </div>
                           <!---end table result-->
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal search general-->


               <!--modal avis marriage-->
               <div class="modal fade avis_mariage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg m-modal-margin" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="searchAvisMariageNumDB.php" method="post" class="searchAvisMariageNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام رقم البيان  </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">العدد</label>
                                       <input type="text" name="adad"  class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">رقم السجل</label>
                                       <input type="text" name="numero_sijil"  class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc by num-->
                           <!--searhc with num epoux-->
                           <form action="searchEpouxNumDB.php" method="post" class="searchEpouxNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام رقم الزوج </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee_epoux"  class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi"> الرقم</label>
                                       <input type="text" name="numero_epoux"  class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc by epoux-->
                           <!--searhc with num epouse-->
                           <form action="searchEpouseNumDB.php" method="post" class="searchEpouseNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام رقم الزوجة </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee_epouse"  class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi"> الرقم</label>
                                       <input type="text" name="numero_epouse"  class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc by epouse-->
                           <!--table result-->
                           <div class="row" >
                              <div class="table-responsive m-scroll" id="divResultAvisMariage">
                              </div>
                           </div>
                           <!---end table result-->
                        </div>
                        <div class="modal-footer">
                           <div style="text-align: center">
                              <a href="avis_marriage_info.php">
                              <button class="btn btn-info m-margin-left">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/rounded-add-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إضافة</b>
                              </button>
                              </a>
                              <button class="btn btn-info"  data-dismiss="modal">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/delete-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إلغاء</b>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal avis marriage-->
               <!--modal avis divorce-->
               <div class="modal fade avis_divorce" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg m-modal-margin" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num avis-->
                           <form action="searchAvisDivorceNumDB.php" method="post" class="searchAvisDivorceNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام رقم البيان </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">العدد</label>
                                       <input type="text" name="adad"  class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">رقم السجل</label>
                                       <input type="text" name="numero_sijil"  class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc by num avis-->
                           <!--searhc with num epoux-->
                           <form action="searchEpouxDivorceNumDB.php" method="post" class="searchEpouxDivorceNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام رقم المطلق </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee_epouxDivorce"  class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi"> الرقم</label>
                                       <input type="text" name="numero_epouxDivorce"  class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc by epoux-->
                           <!--searhc with num epouse-->
                           <form action="searchEpouseDivorceNumDB.php" method="post" class="searchEpouseDivorceNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام رقم المطلقة </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee_epouseDivorce"  class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi"> الرقم</label>
                                       <input type="text" name="numero_epouseDivorce"  class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc by epouse-->
                           <!--table result-->
                           <div class="row" >
                              <div class="table-responsive m-scroll" id="divResultAvisDivorce">
                              </div>
                           </div>
                           <!---end table result-->
                        </div>
                        <div class="modal-footer">
                           <div style="text-align: center">
                              <a href="avis_divorce_info.php">
                              <button class="btn btn-info m-margin-left">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/rounded-add-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إضافة</b>
                              </button>
                              </a>
                              <button class="btn btn-info"  data-dismiss="modal">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/delete-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إلغاء</b>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal avis divorce-->
      
               <!--modal tasrih naiss-->
               <div class="modal fade tasrihNaiss" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg m-modal-margin" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="searchTasrihBNumDB.php" method="post" class="searchTasrihBNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee"  class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                       <input type="text" name="numero"  class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc by num-->
                           <!--searhc by name-->
                           <form action="searchTasrihBNameDB.php" method="post" class="searchTasrihBName">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color"> باستخدام الإسم </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم الفرنسي</label>
                                       <input type="text" name="nameFr" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم العربي</label>
                                       <input type="text" name="nameAr" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!--end searhc by name-->
                           <!--table result-->
                           <div class="row" >
                              <div class="table-responsive m-scroll" id="divResultTasrihBrith">
                              </div>
                           </div>
                           <!---end table result-->
                        </div>
                        <div class="modal-footer">
                           <div style="text-align: center">
                              <a href="insertTasrihBirth.php">
                              <button class="btn btn-info m-margin-left">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/rounded-add-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إضافة</b>
                              </button>
                              </a>
                              <button class="btn btn-info"  data-dismiss="modal">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/delete-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إلغاء</b>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal tasrih naiss-->


               <!--modal tasrih deces-->
               <div class="modal fade tasrihDeces" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg m-modal-margin" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="searchTasrihDNumDB.php" method="post" class="searchTasrihDNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee"  class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                       <input type="text" name="numero"  class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc by num-->
                           <!--searhc by name-->
                           <form action="searchTasrihDNameDB.php" method="post" class="searchTasrihDName">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color"> باستخدام الإسم </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم الفرنسي</label>
                                       <input type="text" name="nameFr" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم العربي</label>
                                       <input type="text" name="nameAr" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!--end searhc by name-->
                           <!--table result-->
                           <div class="row" >
                              <div class="table-responsive m-scroll" id="divResultTasrihDeces">
                              </div>
                           </div>
                           <!---end table result-->
                        </div>
                        <div class="modal-footer">
                           <div style="text-align: center">
                              <a href="insertTasrihDeces.php">
                              <button class="btn btn-info m-margin-left">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/rounded-add-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إضافة</b>
                              </button>
                              </a>
                              <button class="btn btn-info"  data-dismiss="modal">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/delete-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إلغاء</b>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal tasrih deces-->


               <!--modal solb naisss-->
               <div class="modal fade solbNaiss" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg m-modal-margin" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="searchSBNumDB.php" method="post" class="searchSBNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee" id="anneeSBirth" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                       <input type="text" name="numero" id="numeroSBirth" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc by num-->
                           <!--searhc by name-->
                           <form action="searchSBNameDB.php" method="post" class="searchSBName">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color"> باستخدام الإسم </h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم الفرنسي</label>
                                       <input type="text" name="nameFr" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم العربي</label>
                                       <input type="text" name="nameAr" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!--end searhc by name-->
                           <!--table result-->
                           <div class="row" >
                              <div class="table-responsive m-scroll" id="divResultSBrith">
                              </div>
                           </div>
                           <!---end table result-->
                        </div>
                        <div class="modal-footer">
                           <div style="text-align: center">
                              <a href="insertSBirth.php">
                              <button class="btn btn-info m-margin-left">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/rounded-add-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إضافة</b>
                              </button>
                              </a>
                              <button class="btn btn-info"  data-dismiss="modal">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/delete-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إلغاء</b>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal solb naiss-->


               <!--modal solb death-->
               <div class="modal fade solbDeath" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg m-modal-margin" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="searchSDNumDB.php" method="post" class="searchSDNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee" id="anneeSDeath" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                       <input type="text" name="numero" id="numeroSDeath" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc  solb death by num-->
                           <!--searhc by name-->
                           <form action="searchSDNameDB.php" method="post" class="searchSDName">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الإسم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم الفرنسي</label>
                                       <input type="text" name="nameFr" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم العربي</label>
                                       <input type="text" name="nameAr" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!--end searhc by name-->
                           <!--table result-->
                           <div class="row">
                              <div class="table-responsive m-scroll" id="divResultSDeath">
                              </div>
                           </div>
                           <!---end table result-->
                        </div>
                        <div class="modal-footer">
                           <div style="text-align: center">
                              <a href="insertSDeath.php">
                              <button class="btn btn-info m-margin-left">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/rounded-add-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إضافة</b>
                              </button>
                              </a>
                              <button class="btn btn-info"  data-dismiss="modal">
                              <span class="btn-label">
                              <img  style="width:18px;height:18px" src="svg/delete-button.svg">
                              </span>
                              <b class="droid-arabic-kufi m-button-text">إلغاء</b>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal solb death-->


               <!--modal torar birth-->
               <div class="modal fade torarBirth" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg m-modal-margin" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات</h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="searchSBNumDB.php" method="post" class="searchTBNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee" id="anneeTBirth" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                       <input type="text" name="numero" id="numeroTBirth" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc  solb death by num-->
                           <!--searhc by name-->
                           <form action="searchSBNameDB.php" method="post" class="searchTBName">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الإسم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم الفرنسي</label>
                                       <input type="text" name="nameFr" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم العربي</label>
                                       <input type="text" name="nameAr" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!--end searhc by name-->
                           <!--table result-->
                           <div class="row">
                              <div class="table-responsive m-scroll" id="divResultTBirth">
                              </div>
                           </div>
                           <!---end table result-->
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal torar birth-->


               <!--modal torar death-->
               <div class="modal fade torarDeath" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg m-modal-margin" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="searchSDNumDB.php" method="post" class="searchTDNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi" >الرقم</label>
                                       <input type="text" name="numero"  class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc  solb death by num-->
                           <!--searhc by name-->
                           <form action="searchSDNameDB.php" method="post" class="searchTDName">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الإسم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم الفرنسي</label>
                                       <input type="text" name="nameFr" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم العربي</label>
                                       <input type="text" name="nameAr" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!--end searhc by name-->
                           <!--table result-->
                           <div class="row">
                              <div class="table-responsive m-scroll" id="divResultTDeath">
                              </div>
                           </div>
                           <!---end table result-->
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal torar death-->


               <!--modal extrait naiss-->
               <div class="modal fade extraitNaiss" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg m-modal-margin" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="searchExtraitNaissNumDB.php" method="post" class="searchExtraitNaissNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee" id="anneeExtNaiss" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                       <input type="text" name="numero" id="numeroExtNaiss" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc   by num-->
                           <!--searhc by name-->
                           <form action="searchExtraitNaissNameDB.php" method="post" class="searchExtraitNaissName">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الإسم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم الفرنسي</label>
                                       <input type="text" name="nameFr" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم العربي</label>
                                       <input type="text" name="nameAr" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!--end searhc by name-->
                           <!--table result-->
                           <div class="row">
                              <div class="table-responsive m-scroll" id="divResultExtBirth">
                              </div>
                           </div>
                           <!---end table result-->
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal extrait naiss-->


               <!--modal acte dece-->
               <div class="modal fade acteDeces" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg m-modal-margin" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="searchActeDecesNumDB.php" method="post" class="searchActeDecesNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                       <input type="text" name="annee" id="anneeActeDeces" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                       <input type="text" name="numero" id="numeroActeDeces" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!-- end searhc  solb death by num-->
                           <!--searhc by name-->
                           <form action="searchActeDecesNameDB.php" method="post" class="searchActeDecesName">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الإسم</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">search</i>
                                    </button>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم الفرنسي</label>
                                       <input type="text" name="nameFr" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="form-group label-floating">
                                       <label class="control-label m-label-form droid-arabic-kufi">الإسم العربي</label>
                                       <input type="text" name="nameAr" class="form-control">
                                    </div>
                                 </div>
                              </div>
                           </form>
                           <!--end searhc by name-->
                           <!--table result-->
                           <div class="row">
                              <div class="table-responsive m-scroll" id="divResultActeDeces">
                              </div>
                           </div>
                           <!---end table result-->
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal acte deces-->
               <div class="">
               <?php
               	if(isset($request["numero"])!="" && isset($request["annee"])!="" )
                 {
                   $query="SELECT * FROM `acte_deces` WHERE `numero`=? AND `annee`=?";
                 $pdoResult = $pdoConnect->prepare($query);
                 $pdoResult->execute(array($request["numero"],$request["annee"]));
               
                 }
               
                 if(isset($request["nom_ar"])!="" && isset($request["nom"])!="")
                 {
                   $query="SELECT * FROM `acte_deces` WHERE `nom_ar`=? AND `nom`=?";
                 $pdoResult = $pdoConnect->prepare($query);
                 $pdoResult->execute(array($request["nom_ar"],$request["nom"]));
               
                 }
               
               
                 $result=$pdoResult->fetch();
               if($pdoResult->rowCount()>0)
               {
               ?>
                            <div class="card">
                                <div class="card-header ">


                                </div>
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-9">
                                             <form action="updateActeDecesDB.php" method="post" class="acteDecesFormUpdate">
                                            <div class="tab-content">
                                                <!--info rasm-->
                                                <div class="tab-pane active" id="infoRasm">
                                                  <div class="col-md-6">
                                            <div class="form-group label-floating">
												<label class="control-label m-label-form droid-arabic-kufi">السنة</label>
												<input type="text" name="annee"  value="<?php echo $result["annee"]?>" class="form-control" readonly>
											  </div>
                                            </div>
                                                 <div class="col-md-6">
                                            <div class="form-group label-floating">
											<label class="control-label m-label-form droid-arabic-kufi"> الرقم</label>
											<input type="text" name="numero" value="<?php echo $result["numero"]?>"  class="form-control" readonly>
										  </div>
                                            </div>

                                                </div>
                                                <!--end info rasm-->

                                                <!-- info child-->
                                                <div class="tab-pane" id="infoDeath">
                                                  <!--prenom-->

                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating m-input-fr">
													<label class="control-label m-label-form">Prénom</label>
													<input type="text" name="prenom"  value="<?php echo $result["prenom"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">الاسم الشخصي</label>
													<input type="text" name="prenom_ar" value="<?php echo $result["prenom_ar"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <!---end prenom-->

                                                   <!--nom-->

                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating m-input-fr">
													<label class="control-label m-label-form">Nom</label>
													<input type="text" name="nom" value="<?php echo $result["nom"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">الاسم العائلي</label>
													<input type="text" name="nom_ar" value="<?php echo $result["nom_ar"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <!---end nom-->


                                                   <!--lieu deces-->

                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating m-input-fr">
													<label class="control-label m-label-form">Lieu de décès</label>
													<input type="text" name="lieu_deces" value="<?php echo $result["lieu_deces"]?>" class="form-control">
												</div>
                                            	</div>
                                                  <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">مكان الوفاة</label>
													<input type="text" name="lieu_deces_ar" value="<?php echo $result["lieu_deces_ar"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <!---end lieu deces-->

                                                   <!--date deces-->

                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">بالفرنسية</label>
													<input type="text" name="date_deces_miladi_fr" value="<?php echo $result["date_deces_miladi_fr"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">تاريخ الوفاة بالعربية</label>
													<input type="text" name="date_deces_miladi_ar" value="<?php echo $result["date_deces_miladi_ar"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <!---end date deces-->

                                                   <!--en letrre franciase-->

                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">بالفرنسية</label>
													<input type="text" name="date_deces_hijri_fr" value="<?php echo $result["date_deces_hijri_fr"]?>" class="form-control">
												</div>
                                            	</div>
                                                  <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">موافق بالعربية</label>
													<input type="text" name="date_deces_hijri_ar" value="<?php echo $result["date_deces_hijri_ar"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <!---end en letrre franciase-->

                                                    <!--date naiss-->

                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">بالفرنسية</label>
													<input type="text" name="date_naiss_miladi_fr" value="<?php echo $result["date_naiss_miladi_fr"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">تاريخ الولادة  بالعربية</label>
													<input type="text" name="date_naiss_miladi_ar" value="<?php echo $result["date_naiss_miladi_ar"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <!---end date naiss-->

                                                   <!--en letrre franciase-->

                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">بالفرنسية</label>
													<input type="text" name="date_naiss_hijri_fr" value="<?php echo $result["date_naiss_hijri_fr"]?>" class="form-control">
												</div>
                                            	</div>
                                                  <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">موافق بالعربية</label>
													<input type="text" name="date_naiss_hijri_ar" value="<?php echo $result["date_naiss_hijri_ar"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <!---end en letrre franciase-->

                                                   <!--lieu naiss-->

                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating m-input-fr">
													<label class="control-label m-label-form">Lieu de naissance</label>
													<input type="text" name="lieu_naiss" value="<?php echo $result["lieu_naiss"]?>" class="form-control">
												</div>
                                            	</div>
                                                  <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
													<input type="text" name="lieu_naiss_ar" value="<?php echo $result["lieu_naiss_ar"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <!---end lieu naiss-->

                                                   <!--profession-->

                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating m-input-fr">
													<label class="control-label m-label-form">Profession</label>
													<input type="text" name="profession" value="<?php echo $result["profession"]?>"  class="form-control">
												</div>
                                            	</div>
                                                  <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">المهنة</label>
													<input type="text" name="profession_ar" value="<?php echo $result["profession_ar"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <!---profession-->

                                                   <!--etat familiale-->
                                                    <div class="row" >
                                          				<div class="col-md-4 " style="margin-left: 40% ">
                                          					<select name="etat_famillial" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="الحالة العائلية" data-size="7" >

																<option value="celeb"  <?php echo ($result["etat_famillial"]=='celeb')?'selected':'' ?> class="m-label-form">عازب(ة)</option>
																<option value="marie" <?php echo ($result["etat_famillial"]=='marie')?'selected':'' ?> class="m-label-form">متزوج(ة)</option>
																<option value="divorce" <?php echo ($result["etat_famillial"]=='divorce')?'selected':'' ?> class="m-label-form">مطلق(ة)</option>
																<option value="veuf"  <?php echo ($result["etat_famillial"]=='veuf')?'selected':'' ?> class="m-label-form">أرمل(ة)</option>
															</select>
                                          				</div>

                                            	</div>

                                                   <!---end etat familial-->

                                                     <!--Mr/Mme-->
                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating m-input-fr">
													<label class="control-label m-label-form">Mr/Mme</label>
													<input type="text" name="mr_mme" value="<?php echo $result["mr_mme"]?>" class="form-control">
												</div>
                                            	</div>
                                                  <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">(السيد(ة</label>
													<input type="text" name="mr_mme_ar" value="<?php echo $result["mr_mme_ar"]?>"  class="form-control">
												</div>
                                            	</div>
                                                   <!---end Mr/Mme-->

                                                   <!--adresse-->
                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating m-input-fr">
													<label class="control-label m-label-form">Domcile à</label>
													<input type="text" name="domicile" value="<?php echo $result["domicile"]?>" class="form-control">
												</div>
                                            	</div>
                                                  <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">الساكن(ة)ب</label>
													<input type="text" name="domicile_ar" value="<?php echo $result["domicile_ar"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <!---end adresse-->


                                                    </div>
                                                    <!--end info child-->

                                                    <!-- info dad-->
                                                <div class="tab-pane" id="infoDad">

                                                   	<!--prenom dad-->
                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating m-input-fr">
													<label class="control-label m-label-form">Prénom </label>
													<input type="text" name="prenom_pere" value="<?php echo $result["prenom_pere"]?>" class="form-control">
												</div>
                                            	</div>
                                                  <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">الاسم الشخصي</label>
													<input type="text" name="prenom_pere_ar" value="<?php echo $result["prenom_pere_ar"]?>" value="" class="form-control">
												</div>
                                            	</div>
                                                   <!---end prenom dad-->

                                                    </div>
                                                    <!--end info dad-->

                                                     <!-- info mom-->
                                                <div class="tab-pane" id="infoMom">
                                                    <!--nom mere-->
                                                    <div class="col-md-6">
                                            	<div class="form-group label-floating m-input-fr">
													<label class="control-label m-label-form">Nom</label>
													<input type="text" name="prenom_mere" value="<?php echo $result["prenom_mere"]?>" class="form-control">
												</div>
                                            	</div>
                                                  <div class="col-md-6">
                                            	<div class="form-group label-floating">
													<label class="control-label m-label-form droid-arabic-kufi">الاسم </label>
													<input type="text" name="prenom_mere_ar" value="<?php echo $result["prenom_mere_ar"]?>" class="form-control">
												</div>
                                            	</div>
                                                   <!---end nom mere-->
                                                    </div>
                                                    <!--end info mom-->

                                               </form>
                                                   <!--  image upload-->

                                                <div class="tab-pane" id="image">
                                                 <!--show the slected images-->
													<div class="row" style="margin-left: 5% !important; ">


														<?php
													$i=1;
													$folder = "uploads/acteDeces/".$result["numero"].".".$result["annee"]."/";
 													$images = glob($folder."*.*");
													foreach($images as $image)
													{

														?>
														<div class="column">
														<img src="<?php echo $image ?>" class="thumbnail hover-shadow" style="height : 200px !important; width : 200px !important" onclick="openModal();currentSlide(<?php echo $i ?>)">
														 </div>
														<?php
															$i++;
													}
													?>


													</div>
                                               <!-- show image en modale-->
                                               		<div id="myModal" class="m-modal">
													  <span class="close cursor" onclick="closeModal()">&times;</span>
													  <div class="m-modal-content">
													  <?php
													$j=1;
													$folder = "uploads/acteDeces/".$result["numero"].".".$result["annee"]."/";
 													$images = glob($folder."*.*");
													foreach($images as $image)
													{

														?>
															<div class="mySlides">
														  <div class="numbertext"><?php echo ($j)."/".($i-1) ?></div>
														  <img src="<?php echo $image ?>" style="width:100%">
															</div>
														<?php
															$j++;
													}
													?>




														<!-- Next/previous controls -->
														<a class="next" onclick="plusSlides(1)">&#10095;</a>
														<a class="prev" onclick="plusSlides(-1)">&#10094;</a>


														<!-- Caption text -->
														<div class="caption-container">
														  <p id="caption"></p>
														</div>

														<!-- Thumbnail image controls -->
														<?php
													$y=1;
													$folder = "uploads/acteDeces/".$result["numero"].".".$result["annee"]."/";
 													$images = glob($folder."*.*");
													foreach($images as $image)
													{

														?>
														<div class="column">
														<img src="<?php echo $image ?>" class="demo thumbnail"  onclick="currentSlide(<?php echo $y ?>)" style=" height : 150px !important; margin:20px 0 20px 0 !important; ">
														 </div>
														<?php
															$y++;
													}
													?>

													  </div>
													</div>
												<!--show the slected images-->

                                                <form action="uploadActeDecesDB.php" class="dropzone" id="myAwesomeDropzone">
                                                <input type="hidden" name="numero" value="<?php echo $request["numero"]?>">
                                                <input type="hidden" name="annee" value="<?php echo $request["annee"]?>">
                                                	<div class="dz-message needsclick">
														<h3> أنقر لتحميل الملفات </h3>
                                                    </div>
                                                </form>
                                                </div>
                                                <!-- end image upload-->
                                            </div>

                                        </div>

                                        <!--pills vertical-->
                                        <div class="col-md-3 ">
                                            <ul class="nav nav-pills nav-pills-rose nav-stacked">
                                                <li class="active">
                                                  <a href="#infoRasm" data-toggle="tab" rel="tooltip" title=" معلومات حول الرسم" data-placement="left" >
                                                  <i class="material-icons myPills">keyboard_arrow_left</i>
                                                    <b class="droid-arabic-kufi">معلومات حول الرسم</b>
                                                  </a>
                                              </li>

                                                <li >
                                                    <a href="#infoDeath" data-toggle="tab" rel="tooltip" title="معلومات حول الوفاة" data-placement="left" >
                                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                                    <b class="droid-arabic-kufi">معلومات حول الوفاة</b>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#infoDad" data-toggle="tab">
                                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                                    <b class="droid-arabic-kufi">معلومات حول الأب</b>
                                                    </a>
                                                </li>
                                                 <li>
                                                    <a href="#infoMom" data-toggle="tab">
                                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                                    <b class="droid-arabic-kufi">معلومات حول الام</b>
                                                    </a>
                                                </li>

                                               <li >
                                                    <a href="#image" data-toggle="tab" >
                                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                                    <b class="droid-arabic-kufi">الصور</b>

                                                    </a>
                                                </li>

                                            </ul>


                                        </div>
                                        <!---end vertical pills-->



                                    </div>

                                    <div style="text-align: center;margin-right: 17%;">

                                    <button class="btn btn-info m-margin-left" id="submitActeDecesForm" type="submit">
                                            <span class="btn-label">
                                                <i class="material-icons">save</i>
                                            </span>
                                            <b class="droid-arabic-kufi"> حفظ </b>
                                        </button>

                                    <!--<button class="btn btn-info m-margin-left" data-numero="<?php echo $request["numero"]?>" data-annee="<?php echo $request["annee"]?>" id="delActeDeces">
                                          <span class="btn-label">
                                              <i class="material-icons">close</i>
                                          </span>
                                          <b class="droid-arabic-kufi"> حذف </b>
                                      </button>-->
                                    	<!--<button id="submitActeDecesForm" type="submit" class="btn btn-success btn-round btn-fab btn-fab-regular" rel="tooltip" title="حفظ" >
														<i class="material-icons">save</i>
											</button>-->
                                    </div>
                                </div>
                            </div>
                        </div>

            </div>
            <!--end content div-->
            <footer class="footer">
                <div class="container-fluid">

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
</body>
<!--   Core JS Files   -->
<script src="assets/vendors/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="assets/vendors/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/vendors/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/vendors/material.min.js" type="text/javascript"></script>
<script src="assets/vendors/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="assets/vendors/jquery.validate.min.js"></script>
<!--  Plugin for the Wizard -->
<script src="assets/vendors/jquery.bootstrap-wizard.js"></script>
<!-- Sliders Plugin -->
<script src="assets/vendors/nouislider.min.js"></script>
<!-- Select Plugin -->
<script src="assets/vendors/jquery.select-bootstrap.js"></script>
<!--notification-->
<script src="assets/vendors/bootstrap-notify.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="assets/js/turbo.js"></script>
<!-- drop zone-->
<script src="assets/vendors/dropzone/dropzone.min.js"></script>
<!-- Sweet Alert 2 plugin -->
<script src="assets/vendors/sweetalert2.js"></script>
<!--upload verification-->
<script src="assets/js/verifyUpload.js"></script>
<script src="assets/js/lightbox.js"></script>
<!--managmnt js-->
<script src="assets/js/generalSearch.js"></script>
   <script src="assets/js/avis_mngmnt.js"></script>
<script src="assets/js/etatCivil.js"></script>
<script src="assets/js/someJS.js"></script>
<script src="assets/js/tasrihMngmnt.js"></script>
<script src="assets/js/solbMngmt.js"></script>
<script src="assets/js/extraitMngmnt.js"></script>
<script src="assets/js/toraMangmnt.js"></script>

<script>
	$('#submitActeDecesForm').click( function() {
    $('.acteDecesFormUpdate').submit();
});



//DELETE **********
$(document).ready(function(){

    $(document).on('click', '#delActeDeces', function(e){

	var numero = $(this).data('numero');
	var annee = $(this).data('annee');
  console.log(numero);
	swalDelete(numero,annee);

 		e.preventDefault();

    });

});

function swalDelete(numero,annee)
{

			swal({
			title: 'متأكد من هذه العملية؟',
			text: "سيتم حذف جميع الوثائق المتعلقة به ",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'نعم،متأكد',
			cancelButtonText:'إلغاء',
			showLoaderOnConfirm: true,

			preConfirm: function() {
			  return new Promise(function(resolve) {

			     $.ajax({
			   		url: 'delActeDecesDB.php',
			    	type: 'POST',
			       	data: {'numero' : numero,'annee' : annee},
			       	dataType: 'html'
			     })
			     .done(function(response){
			     	swal( 'تمت العملية بنجاح ', response.message, response.status);
					$('#listTora').html(response);
					window.setTimeout(function(){window.location.replace("index.php");},3000);
			     })
			     .fail(function(){
			     	swal('Oops...', 'quelque chose ca marche pas!', 'error');
			     });
			  });
		    },
			allowOutsideClick: false
		});

}

</script>

</html>
<?php } ?>
