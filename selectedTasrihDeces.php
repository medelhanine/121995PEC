<?php
   require "dbConnect.php";
   header('Cache-Control: no cache'); //no cache
  session_cache_limiter('private_no_expire'); // works
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


   $_SESSION["numero"] = $request['numero'];
   $_SESSION["annee"] = $request['annee'];
   $ActualDate = date('Y/m/d');
   $anneActu = substr($ActualDate,0,4);

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
      <style>
         .dropzone{
         border: 2px dashed #BBB;
         border-radius: 5px;
         }
         .nav-pills > li i
         {
         padding: 0 !important;
         }
      </style>
   </head>
   <body class="rtl-layout"  style="overflow: hidden !important">
      <div class="wrapper">
      <div class="sidebar" data-background-color="gray">
            <div class="profile-header-container">   
    		          <div class="profile-header-img">
                    <img class="img-circle" src="assets/img/user.svg" />
                    <!-- badge -->
                    <div class="rank-label-container">
                        <span class="label label-default rank-label"> <b class="profile-label"><?php echo $username?></b> </span>
                    </div>
                  </div>    
                  <hr class="styling">              
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
                  <li class="active">
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
                           <li style="margin-bottom: 10%;" class="active">
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
                  <li>
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
                           <li style="margin-bottom: 10%;">
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
                  <div class="card">
                     <div class="card-content">
                        <div class="row">
                           <div class="col-md-9">
                              <form action="updateTasrihDecesDB.php" method="post"   class="tasrihDecesFormUpdate">
                                 <div class="tab-content">
                                   <?php
                                   
                                      $query="SELECT * FROM `tasrih_deces` WHERE `numero`=? AND `annee`=?";
                                      $pdoResult = $pdoConnect->prepare($query);
                                      $pdoResult->execute(array($_SESSION["numero"],$_SESSION["annee"]));
                                      $result=$pdoResult->fetch();
                                      ?>
                                    <!--info rasm-->
                                    <div class="tab-pane active" id="infoRasm">
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form">السنة </label>
                                             <input type="text" name="annee"  value="<?php echo $result["annee"] ?>" id="anneeVal" class="form-control"  required>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form"> الرقم</label>
                                             <input type="text" name="numero" value="<?php echo $result["numero"] ?>" id="numeroVal" class="form-control" required>
                                          </div>
                                       </div>


                                       <div class="col-md-6">

                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> الموعد</label>
                                             <input type="text" name="rdv" value="<?php echo $result["rdv"] ?>" class="form-control">
                                          </div>
                                       </div>

                                    </div>
                                    <!--end info rasm-->
                                    <!-- info child-->
                                    <div class="tab-pane" id="infoDeces">

                                      <!--date naiss-->
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi"> عام </label>
                                            <input type="text" name="annee_deces_hijri" value="<?php echo $result["annee_deces_hijri"] ?>" class="form-control" >
                                         </div>
                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form"> تاريخ الوفاة </label>
                                            <input type="text" name="date_deces_hijri" value="<?php echo $result["date_deces_hijri"] ?>" class="form-control " >
                                         </div>
                                      </div>
                                      <!---end date naiss-->
                                      <!--en miladi-->
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi"> سنة </label>
                                            <input type="text" name="annee_deces_miladi" value="<?php echo $result["annee_deces_miladi"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi"> موافق ل </label>
                                            <input type="text" name="date_deces_miladi" value="<?php echo $result["date_deces_miladi"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <!---end miladi-->

                                      <!--heure et min-->
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi">و الدقيقة</label>
                                            <input type="text" name="min" value="<?php echo $result["min"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi">على الساعة</label>
                                            <input type="text" name="heure" value="<?php echo $result["heure"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <!---end heure et min-->

                                      <!--lieu naiss-->
                                      <div class="col-md-6">
                                        <div class="form-group label-floating">
                                           <label class="control-label m-label-form droid-arabic-kufi"> مكان الولادة </label>
                                           <input type="text" name="lieu_naiss" value="<?php echo $result["lieu_naiss"] ?>" class="form-control">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi">مكان الوفاة</label>
                                            <input type="text" name="lieu_deces" value="<?php echo $result["lieu_deces"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <!---end lieu naiss-->

                                      <!--sex-->
                                      <div class="row" >
                                         <div class="col-md-4 " style="margin-left: 40% ">
                                            <select name="sex" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="الجنس" data-size="7" >
                                               <option value="feminin" <?php echo ($result["sex"]=='feminin')?'selected':'' ?> class="m-label-form droid-arabic-kufi">أنثى</option>
                                               <option value="masculin" <?php echo ($result["sex"]=='masculin')?'selected':'' ?>  class="m-label-form droid-arabic-kufi">ذكر</option>
                                            </select>
                                         </div>
                                      </div>
                                      <!---end sex-->

                                      <!--nom-->
                                      <div class="col-md-6">
                                         <div class="form-group label-floating m-input-fr">
                                            <label class="control-label m-label-form">Prénom</label>
                                            <input type="text" name="prenom_deces_fr" value="<?php echo $result["prenom_deces_fr"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi"> الإسم الشخصي </label>
                                            <input type="text" name="prenom_deces" value="<?php echo $result["prenom_deces"] ?>"  class="form-control">
                                         </div>
                                      </div>
                                      <!---end nom-->

                                       <!--nom-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom_deces_fr" value="<?php echo $result["nom_deces_fr"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> الإسم العائلي </label>
                                             <input type="text" name="nom_deces" value="<?php echo $result["nom_deces"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom-->

                                       <!--nom-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">الساكن ب</label>
                                             <input type="text" name="adresse_deces" value="<?php echo $result["adresse_deces"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> جنسيته </label>
                                             <input type="text" name="nationalite" value="<?php echo $result["nationalite"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom-->


                                       <!--nom-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form"> عام </label>
                                             <input type="text" name="annee_naiss_hijri" value="<?php echo $result["annee_naiss_hijri"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> المولود بتاريخ </label>
                                             <input type="text" name="date_naiss_hijri" value="<?php echo $result["date_naiss_hijri"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom-->

                                       <!--en miladi-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> سنة </label>
                                             <input type="text" name="annee_naiss_miladi" value="<?php echo $result["annee_naiss_miladi"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> موافق ل </label>
                                             <input type="text" name="date_naiss_miladi" value="<?php echo $result["date_naiss_miladi"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end miladi-->
                                       <div class="col-md-4 " style="margin-left: 40% ">
                                          <select name="etat_familiale" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="الحالة العائلية" data-size="7" >
                                             <option value="celeb" <?php echo ($result["etat_familiale"]=='celeb')?'selected':'' ?> class="m-label-form">عازب(ة) </option>
                                             <option value="marie" <?php echo ($result["etat_familiale"]=='marie')?'selected':'' ?> class="m-label-form">متزوج(ة) </option>
                                             <option value="divorce" <?php echo ($result["etat_familiale"]=='divorce')?'selected':'' ?> class="m-label-form">مطلق(ة) </option>
                                             <option value="veuf" <?php echo ($result["etat_familiale"]=='veuf')?'selected':'' ?>  class="m-label-form">أرمل(ة) </option>
                                          </select>
                                       </div>



                                       <!--en -->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> مهنته </label>
                                             <input type="text" name="profession" value="<?php echo $result["profession"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> المستوى الدراسي </label>
                                             <input type="text" name="niveau_scolaire" value="<?php echo $result["niveau_scolaire"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end -->

                                    </div>
                                    <!--end info child-->
                                    <!-- info dad-->
                                    <div class="tab-pane" id="infoDad">
                                       <!--prenom dad-->
                                       <div class="col-md-6">

                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الإسم </label>
                                             <input type="text" name="nom_pere"  value="<?php echo $result["nom_pere"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end prenom dad-->

                                       <!--date naiss dad-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating ">
                                            <label class="control-label m-label-form droid-arabic-kufi">عام </label>
                                             <input type="text" name="annee_naiss_pere_hijri" value="<?php echo $result["annee_naiss_pere_hijri"] ?>" class="form-control " >
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">

                                             <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادة الأب </label>
                                             <input type="text" name="date_naiss_pere_hijri" value="<?php echo $result["date_naiss_pere_hijri"] ?>" class="form-control " >
                                          </div>
                                       </div>
                                       <!---end date naiss dad-->
                                       <!--letrre arabe-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating ">
                                             <label class="control-label m-label-form droid-arabic-kufi"> سنة </label>
                                             <input type="text" name="annee_naiss_pere_miladi" value="<?php echo $result["annee_naiss_pere_miladi"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">

                                             <label class="control-label m-label-form droid-arabic-kufi"> الموافق ل </label>
                                             <input type="text" name="date_naiss_pere_miladi" value="<?php echo $result["date_naiss_pere_miladi"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end lettre arabe-->

                                       <!--lieu naiss-->
                                       <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                            <input type="text" name="nationalite_pere" value="<?php echo $result["nationalite_pere"] ?>" class="form-control">
                                         </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> الساكن ب </label>
                                             <input type="text" name="adresse_pere" value="<?php echo $result["adresse_pere"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end lieu naiss-->

                                       <!--profession-->
                                       <div class="col-md-6">

                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
                                             <input type="text" name="profession_pere" value="<?php echo $result["profession_pere"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end profession-->

                                    </div>
                                    <!--end info dad-->
                                    <!-- info mom-->
                                    <div class="tab-pane" id="infoMom">
                                      <!--prenom mom-->
                                      <div class="col-md-6">

                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi">الإسم </label>
                                            <input type="text" name="nom_mere"  value="<?php echo $result["nom_mere"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <!---end prenom dad-->

                                      <!--date naiss dad-->
                                      <div class="col-md-6">
                                         <div class="form-group label-floating ">
                                           <label class="control-label m-label-form droid-arabic-kufi">عام </label>
                                            <input type="text" name="annee_naiss_mere_hijri" value="<?php echo $result["annee_naiss_mere_hijri"] ?>" class="form-control " >
                                         </div>
                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">

                                            <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادة الأم </label>
                                            <input type="text" name="date_naiss_mere_hijri" value="<?php echo $result["date_naiss_mere_hijri"] ?>" class="form-control " >
                                         </div>
                                      </div>
                                      <!---end date naiss dad-->
                                      <!--letrre arabe-->
                                      <div class="col-md-6">
                                         <div class="form-group label-floating ">
                                            <label class="control-label m-label-form droid-arabic-kufi"> سنة </label>
                                            <input type="text" name="annee_naiss_mere_miladi" value="<?php echo $result["annee_naiss_mere_miladi"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">

                                            <label class="control-label m-label-form droid-arabic-kufi"> الموافق ل </label>
                                            <input type="text" name="date_naiss_mere_miladi" value="<?php echo $result["date_naiss_mere_miladi"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <!---end lettre arabe-->

                                      <!--lieu naiss-->
                                      <div class="col-md-6">
                                        <div class="form-group label-floating">
                                           <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                           <input type="text" name="nationalite_mere" value="<?php echo $result["nationalite_mere"] ?>" class="form-control">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi"> الساكنة ب </label>
                                            <input type="text" name="adresse_mere" value="<?php echo $result["adresse_mere"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <!---end lieu naiss-->

                                      <!--profession-->
                                      <div class="col-md-6">

                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
                                            <input type="text" name="profession_mere" value="<?php echo $result["profession_mere"] ?>" class="form-control">
                                         </div>
                                      </div>


                                    </div><!--end info mom-->


                                    <!-- info tasrih-->
                                    <div class="tab-pane" id="infoTasrih">

                                      <!--موافق-->
                                      <div class="col-md-6">
                                         <div class="form-group label-floating ">
                                            <label class="control-label m-label-form droid-arabic-kufi"> عام </label>
                                            <input type="text" name="annee_ecrit_hijri" value="<?php echo $result["annee_ecrit_hijri"] ?>" class="form-control " value="1439-02-25">
                                         </div>
                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi"> تاريخ التحرير </label>
                                            <input type="text" name="date_ecrit_hijri" value="<?php echo $result["date_ecrit_hijri"] ?>" class="form-control " >
                                         </div>
                                      </div>
                                      <!---end موافق-->
                                      <!--بالأحرف العربية-->
                                      <div class="col-md-6">
                                         <div class="form-group label-floating ">
                                            <label class="control-label m-label-form droid-arabic-kufi">سنة </label>
                                            <input type="text" name="annee_ecrit_miladi" value="<?php echo $result["annee_ecrit_miladi"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi"> الموافق ل </label>
                                            <input type="text" name="date_ecrit_miladi" value="<?php echo $result["date_ecrit_miladi"] ?>" class="form-control">
                                         </div>
                                      </div>
                                      <!---end بالأحرف العربية-->
                                       <!--Selon-->
                                       <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi">عمره </label>
                                            <input type="text" name="age_annonceur" value="<?php echo $result["age_annonceur"] ?>" class="form-control">
                                         </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> حسبما صرح به </label>
                                             <input type="text" name="selon_annonceur" value="<?php echo $result["selon_annonceur"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Selon-->

                                       <!--Adresse-->
                                       <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi"> جنسيته </label>
                                            <input type="text" name="nationalite_annonceur" value="<?php echo $result["nationalite_annonceur"] ?>" class="form-control">
                                         </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> مهنته </label>
                                             <input type="text" name="profession_annonceur" value="<?php echo $result["profession_annonceur"] ?>"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end Adresse-->


                                       <!--Adresse-->
                                       <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi"> عنوانه </label>
                                            <input type="text" name="adresse_annonceur" value="<?php echo $result["adresse_annonceur"] ?>" class="form-control">
                                         </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> صلته بالمتوفي </label>
                                             <input type="text" name="liaison_avec_deces" value="<?php echo $result["liaison_avec_deces"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Adresse-->

                                       <!--Officier de l'état civile-->
                                       <div class="col-md-6">

                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form m-input-fr droid-arabic-kufi">ضابط الحالة المدنية </label>
                                             <input type="text" name="officier_etat_civil" value="<?php echo $result["officier_etat_civil"] ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Officier de l'état civile-->

                                    </div>
                                    <!--end info tasrih-->

                              </form>
                              <!--  image upload-->
                              <div class="tab-pane" id="image">

                              <!--show the slected images-->
        <div class="row" style="margin-left: 5% !important; ">
          <?php
        $i=1;
        $folder = "uploads/tasrihDeces/".$result["numero"].".".$result["annee"]."/";
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
        $folder = "uploads/tasrihDeces/".$result["numero"].".".$result["annee"]."/";
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
        $folder = "uploads/tasrihDeces/".$result["numero"].".".$result["annee"]."/";
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
                              <form action="uploadTasrihDecesDB.php" class="dropzone" id="myAwesomeDropzone">
                              <input type="hidden" name="numero" value="<?php echo $result["numero"]?>">
                              <input type="hidden" name="annee" value="<?php echo $result["annee"]?>">
                                <div class="dz-message needsclick">
                                <h3> أنقر لتحميل الملفات </h3>
                                  </div>
                              </form>
                              </div>
                              <!-- end image upload-->
                              </div>
                           </div>
                           <!--pills vertical-->
                           <!--<div class="col-md-1"></div>-->
                           <div class="col-md-3 ">
                              <ul class="nav nav-pills nav-pills-rose nav-stacked">
                                 <li class="active">
                                    <a href="#infoRasm" data-toggle="tab" rel="tooltip">
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">معلومات حول الرسم</b>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#infoDeces" data-toggle="tab" >
                                    <b class="droid-arabic-kufi"> معلومات حول المتوفي </b>
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#infoDad" data-toggle="tab">
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi"> معلومات حول الأب </b>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#infoMom" data-toggle="tab" >
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">معلومات حول الام</b>
                                    </a>
                                 </li>

                                 <li>
                                    <a href="#infoTasrih" data-toggle="tab" >
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">معلومات حول التصريح</b>
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
                        <form  action="selectedTasrihDecesP.php" method="post">
                        <div style="text-align: center;margin-right: 17%;">
                          <input type="hidden" name="numero" value="<?php echo $_SESSION["numero"] ?>">
                          <input type="hidden" name="annee" value="<?php echo $_SESSION["annee"] ?>">
                            <button type="submit" class="btn btn-info m-margin-left" >
                                  <span class="btn-label">
                                      <i class="material-icons">print</i>
                                  </span>
                                  <b class="droid-arabic-kufi"> طباعة التصريح </b>
                              </button>
                          </form>


                           <button type="button" class="btn btn-info m-margin-left" id="submitTasrihDecesForm">
                           <span class="btn-label">
                           <i class="material-icons">save</i>
                           </span>
                           <b class="droid-arabic-kufi"> حفظ </b>
                           </button>


                           <button class="btn btn-info m-margin-left" data-numero="<?php echo $result["numero"]?>" data-annee="<?php echo $result["annee"] ?>" id="delTasrihDeces">
                                 <span class="btn-label">
                                     <i class="material-icons">close</i>
                                 </span>
                                 <b class="droid-arabic-kufi"> حذف </b>
                             </button>



                           <!--<button id="submitSbirthForm" type="submit" class="btn btn-success btn-round btn-fab btn-fab-regular" rel="tooltip" title="حفظ" onclick="submitForms()">
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
   <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
   <script src="assets/js/moment-with-locales.min.js"></script>
   <!-- DateTimePicker Plugin -->
   <script src="assets/vendors/bootstrap-datetimepicker.js"></script>
   <!--Some js-->
   <script src="assets/js/generalSearch.js"></script>
   <script src="assets/js/avis_mngmnt.js"></script>
   <script src="assets/js/etatCivil.js"></script>
   <script src="assets/js/someJS.js"></script>
   <script src="assets/js/tasrihMngmnt.js"></script>
   <script src="assets/js/solbMngmt.js"></script>
   <script src="assets/js/extraitMngmnt.js"></script>
   <script src="assets/js/toraMangmnt.js"></script>
   <script>
      $('#submitTasrihDecesForm').click( function() {
         $('.tasrihDecesFormUpdate').submit();
      });

      var numero = $('#numeroVal').attr('value');
      var annee = $('#anneeVal').attr('value');
      $('#numeroUpload').attr('value', numero);
      $('#anneeUpload').attr('value', annee);


      //DELETE **********
      $(document).ready(function(){

          $(document).on('click', '#delTasrihDeces', function(e){

      	var numero = $(this).data('numero');
      	var annee = $(this).data('annee');
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
      			   		url: 'delTasrihDecesDB.php',
      			    	type: 'POST',
      			       	data: {'numero' : numero,'annee' : annee},
      			       	dataType: 'html'
      			     })
      			     .done(function(response){
      			     	swal( 'تمت العملية بنجاح ', response.message, response.status);
      					$('#listTora').html(response);
      					window.setTimeout(function(){window.location.replace("index.php");},2000);
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
