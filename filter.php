<?php
   require "dbConnect.php";
   session_start();

   // Check if user is logged in using the session variable
   if ( $_SESSION['logged_in'] != 1 ) {
   	$_SESSION[ 'message' ] = "You must log in before viewing your profile page!";
   	header( "location: login/error.php" );
   } else {
   	// Makes it easier to read
   	$first_name = $_SESSION['first_name'];
   	$last_name = $_SESSION['last_name'];
   	$username = $_SESSION['username'];
   	//$superUser = $_SESSION['superUser'];
   }

   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8"/>
      <link rel="apple-touch-icon" sizes="assets/img/apple-icon.png"/>
      <link rel="icon" type="image/png" href="assets/img/favicon.png"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
      <title>الحالة المدنية الرقمية</title>
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
      <meta name="viewport" content="width=device-width"/>
      <!-- Bootstrap core CSS     -->
      <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
      <!--  Material Dashboard CSS    -->
      <link href="assets/css/turbo.css" rel="stylesheet"/>
      <!--     Fonts and icons     -->
  

      <link href="assets/vendors/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
      <!--some CSS-->
      <link href="assets/css/someCss.css" rel="stylesheet">
      <style>
    

      .waiting
      {
        color:green;

        margin-top: 20%
      }


      /*gallery styling*/
      .container {
        max-width: 470px;
        margin: auto;
        border: #253340 solid 0px;
        background: #BDBDBD;
        margin-bottom: 20px;
      }

      .main-img img,
      .imgs img {
        width: 100%;
      }
      
      .navbar
      {
        width : 2400px;
      }

      .imgs {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 5px;
        margin-bottom : 5px;
        margin-top: 5px;
      }

      /* Fade in animation */
      @keyframes fadeIn {
        to {
          opacity: 1;
        }
      }

      .fade-in {
        opacity: 0;
        animation: fadeIn 0.5s ease-in 1 forwards;
      }

        .card
        {
          margin : 10px 0 !important;
          
          overflow-x: scroll;
          min-width : 1600px;
          width: auto;
          white-space: nowrap;
          
          min-height : 600px;
        
        }

        .btn-group, .btn-group-vertical
        {
          margin:0 !important;
        }

        .btn.btn-info, .btn.btn-info:hover
        {
          
        }

        .btn.btn-info
        {
          
        }
      </style>
   </head>
   <body class="rtl-layout" style="overflow: hidden !important">
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
                  <li class="active">
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
            <!--content class-->
            <div class="content" style="margin-top: 70px;">

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

               <div class="col-md-12">
                   <div class="card">
                       <div class="card-content">

                           <div class="toolbar">
                               <!--        Here you can write extra buttons/actions for the toolbar              -->
                           </div>
                           <ul class="nav nav-pills nav-pills-warning" style="margin-top:0px !important;margin-left:40% !important">
                             <!--<li >
                                 <a href="#tasrih_deces" data-toggle="tab" class="droid-arabic-kufi" style="font-size:18px !important"> تصريح الوفاة </a>
                             </li>
                               <li>
                                   <a href="#tasrih_birth" data-toggle="tab" class="droid-arabic-kufi" style="font-size:18px !important">تصريح الولادة</a>
                               </li>-->
                               <li>
                                   <a href="#solb_death" data-toggle="tab" class="droid-arabic-kufi" style="font-size:35px !important"> الوفيات </a>
                               </li>
                               <li  class="active">
                                   <a href="#solb_birth" data-toggle="tab" class="droid-arabic-kufi" style="font-size:35px !important;margin-left : 100px !important"> الولادات</a>
                               </li>
                           </ul>

                           <div class="tab-content">
                               <div class="tab-pane active" id="solb_birth">
                                 <div class="material-datatables col-md-12" > <!--datatables result-->
                                   <form class="" action="exportData.php" method="post"> 
                                      <button type="submit"  id="more_data_btn" class="btn btn-success btn-round btn-fab btn-fab-mini droid-arabic-kufi"  rel="tooltip" title=""> <i class="material-icons">publish</i></button>                               

                                     <table id="datatables_sBirth" class="table table-striped table-no-bordered table-hover droid-arabic-kufi" cellspacing="0" width="100%" style="width:100%">
                                         <thead>
                                             <tr>
                                               <th style="text-align : center">
                                                 <select name="numero" id="numero" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="الرقم" >
                                                   <option value="all" >الكل </option>
                                                   <option value="0-300">0-300</option>
                                                   <option value="300-600">300-600</option>
                                                   <option value="600-900">600-900</option>
                                                   <option value="900-1200">900-1200</option>
                                                   <option value="1200-1500">1200-1500</option>
                                                   <option value="1500-1800">1500-1800</option>
                                                   <option value="1800-2100">1800-2100</option>
                                                   <option value="2100-2400">2100-2400</option>
                                                   <option value="2400-2700">2400-2700</option>
                                                   <option value="2700-3000">2700-3000</option>
                                                   <option value=">3000">أكثر من 3000</option>
                                                 </select>
                                                </th>
                                               <th style="text-align : center">
                                                 <select name="annee" id="annee" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="السنة (10 سنوات)">
                                                   <option value="all" >جميع السنوات </option>
                                                   <option value="1960">1960</option>
                                                   <option value="1970">1970</option>
                                                   <option value="1980">1980</option>
                                                   <option value="1990">1990</option>
                                                   <option value="2000">2000</option>
                                                   <option value="2010">2010</option>
                                                 </select>
                                               </th>
                                               

                                                <th style="text-align : center"> 
                                                <select  name="prenom_ar" id="prenom_ar" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title=" الإسم الشخصي" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_prenom";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['prenom_ar'] ?>" style="text-align: right"><?php echo $row['prenom_ar'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                </th>
                                                <th style="text-align : center">
                                                <select  name="nom_ar" id="nom_ar" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title=" الإسم العائلي" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_nom";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['nom_ar'] ?>" style="text-align: right"><?php echo $row['nom_ar'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                </th>

                                                <th style="text-align : center">
                                                  <select name="sex" id="gender" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="الجنس">
                                                  <option value="all" >ذكور و إناث</option>
                                                    <option value="feminin">أنثى</option>
                                                    <option value="masculin">ذكر</option>
                                                  
                                                  </select>
                                                 </th>

                                                 <!--age depuis -->
                                                 <th style="text-align : center">
                                                  <select name="age_start" id="age_start" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="العمر (من)">
                                                  <option value="all" style="text-align: right">الكل</option>
                                                  <?php 
                                                  $i=0;
                                                  for($i=0;$i<101;$i++)
                                                  {                                                  
                                                   ?>
                                                    <option value="<?php echo $i ?>" ><?php echo $i ?></option>                                                    
                                                    <?php } ?>
                                                  </select>
                                                 </th>
                                                 <!--age -->

                                                 <!--age jusque -->
                                                 <th style="text-align : center">
                                                  <select name="age_end" id="age_end" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="العمر (إلى)">
                                                  <option value="all" style="text-align: right">الكل</option>
                                                  <?php 
                                                  $i=0;
                                                  for($i=0;$i<101;$i++)
                                                  {                                                  
                                                   ?>
                                                    <option value="<?php echo $i ?>" ><?php echo $i ?></option>                                                    
                                                    <?php } ?>
                                                  </select>
                                                 </th>
                                                 <!--age -->


                                                 <!--Lieu naiss-->
                                                <th style="text-align : center">
                                                <select  name="lieu_naiss" id="lieu_naiss" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="مكان الإزدياد" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
      
                                                  </select>
                                                 </th>

                                                 <!--nom mere-->
                                                <th style="text-align : center">
                                                <select  name="nom_mere" id="nom_mere" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="  اسم الأم" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_nom_mere";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['nom_mere'] ?>" style="text-align: right"><?php echo $row['nom_mere'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                </th>

                                                <!--nom pere-->
                                                <th style="text-align : center">
                                                <select  name="nom_pere" id="nom_pere" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="  اسم الأب" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_nom_pere";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['nom_pere'] ?>" style="text-align: right"><?php echo $row['nom_pere'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                </th>

                                                <!--profession mere-->
                                                <th style="text-align : center">
                                                <select  name="profession_mere" id="profession_mere" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="مهنة الأم" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_prof_mere";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['prof_mere'] ?>" style="text-align: right"><?php echo $row['prof_mere'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                 </th>

                                                 <!--niveau scol mere-->
                                                <th style="text-align : center">
                                                <select  name="niveau_scol_mer" id="niveau_scol_mer" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title=" المستوى الدراسي للأم" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_niveau_scol_mere";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['niveau_scol_mere'] ?>" style="text-align: right"><?php echo $row['niveau_scol_mere'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                 </th>
                                                  
                                                 <!--profession pere-->
                                                <th style="text-align : center">
                                                <select  name="profession_pere" id="profession_pere" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="مهنة الأب" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_prof_pere";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['prof_pere'] ?>" style="text-align: right"><?php echo $row['prof_pere'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                 </th>

                                                 <!--niveau scol pere-->
                                                <th style="text-align : center">
                                                <select  name="niveau_scol_pere" id="niveau_scol_pere" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title=" المستوى الدراسي للأب" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_niveau_scol_pere";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['niveau_scol_pere'] ?>" style="text-align: right"><?php echo $row['niveau_scol_pere'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                 </th>
                                                  
                                                  <!--ordre naiss-->
                                                <th style="text-align : center">
                                                <select  name="ordre_naiss" id="ordre_naiss" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title=" رتبة الولادة" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>                                                     
                                                  </select>
                                                 </th>


                                                  <!--officier etat civil-->
                                                <th style="text-align : center">
                                                <select  name="officier_etat_civil" id="officier_etat_civil" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="  ضابط الحالة المدنية" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_officier_etat_civil";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['officier_etat_civil'] ?>" style="text-align: right"><?php echo $row['officier_etat_civil'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                 </th>

                                             </tr>
                                         </thead>
                                         <tfoot>
                                             <tr>
                                               <th style="text-align : center"> الرقم </th>
                                               <th style="text-align : center">السنة</th>
                                                <th style="text-align : center">الإسم الشخصي</th>
                                                <th style="text-align : center">الإسم العائلي</th>
                                                <th style="text-align : center"> الجنس  </th>
                                                <th style="text-align : center"> العمر (من)  </th>
                                                <th style="text-align : center"> العمر (إلى)  </th>
                                                <th style="text-align : center"> مكان الإزدياد  </th>
                                                <th style="text-align : center">  اسم الأم  </th>
                                                <th style="text-align : center">  اسم الأب  </th>
                                                <th style="text-align : center">  مهنة الأم  </th>
                                                <th style="text-align : center">   المستوى الدراسي للأم  </th>   
                                                <th style="text-align : center">  مهنة الأب  </th> 
                                                <th style="text-align : center">   المستوى الدراسي للأب  </th>
                                                <th style="text-align : center">   رتبة الولادة  </th>
                                                <th style="text-align : center">   ضابط الحالة المدنية  </th>
                                                
                                             </tr>
                                         </tfoot>

                                     </table>
                                   </form>

                                 </div><!--end datatables result-->

                               </div>
                               <div class="tab-pane" id="solb_death">
                               <div class="material-datatables col-md-12" > <!--datatables result death-->
                                   <form class="" action="exportDataDeath.php" method="post"> 
                                      <button type="submit"  id="export_death" class="btn btn-success btn-round btn-fab btn-fab-mini droid-arabic-kufi"  rel="tooltip" title=""> <i class="material-icons">publish</i></button>                               

                                     <table id="datatables_sDeath" class="table table-striped table-no-bordered table-hover droid-arabic-kufi" cellspacing="0" width="100%" style="width:100%">
                                         <thead>
                                             <tr>
                                               <th style="text-align : center">
                                                 <select name="numero" id="numero_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="الرقم" >
                                                   <option value="all" >الكل </option>
                                                   <option value="0-300">0-300</option>
                                                   <option value="300-600">300-600</option>
                                                   <option value="600-900">600-900</option>
                                                   <option value="900-1200">900-1200</option>
                                                   <option value="1200-1500">1200-1500</option>
                                                   <option value="1500-1800">1500-1800</option>
                                                   <option value="1800-2100">1800-2100</option>
                                                   <option value="2100-2400">2100-2400</option>
                                                   <option value="2400-2700">2400-2700</option>
                                                   <option value="2700-3000">2700-3000</option>
                                                   <option value=">3000">أكثر من 3000</option>
                                                 </select>
                                                </th>
                                               <th style="text-align : center">
                                                 <select name="annee" id="annee_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="السنة (10 سنوات)">
                                                   <option value="all" >جميع السنوات </option>
                                                   <option value="1960">1960</option>
                                                   <option value="1970">1970</option>
                                                   <option value="1980">1980</option>
                                                   <option value="1990">1990</option>
                                                   <option value="2000">2000</option>
                                                   <option value="2010">2010</option>
                                                 </select>
                                               </th>
                                               

                                                <th style="text-align : center"> 
                                                <select  name="prenom_ar" id="prenom_ar_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title=" الإسم الشخصي" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_prenom_death";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['prenom'] ?>" style="text-align: right"><?php echo $row['prenom'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                </th>
                                                <th style="text-align : center">
                                                <select  name="nom_ar" id="nom_ar_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title=" الإسم العائلي" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_nom_death";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['nom_death'] ?>" style="text-align: right"><?php echo $row['nom_death'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                </th>

                                                <th style="text-align : center">
                                                  <select name="sex" id="gender_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="الجنس">
                                                  <option value="all" >ذكور و إناث</option>
                                                    <option value="feminin">أنثى</option>
                                                    <option value="masculin">ذكر</option>
                                                  
                                                  </select>
                                                 </th>

                                                 <!--age depuis -->
                                                 <th style="text-align : center">
                                                  <select name="age_start" id="age_start_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="العمر (من)">
                                                  <option value="all" style="text-align: right">الكل</option>
                                                  <?php 
                                                  $i=0;
                                                  for($i=0;$i<101;$i++)
                                                  {                                                  
                                                   ?>
                                                    <option value="<?php echo $i ?>" ><?php echo $i ?></option>                                                    
                                                    <?php } ?>
                                                  </select>
                                                 </th>
                                                 <!--age -->

                                                 <!--age jusque -->
                                                 <th style="text-align : center">
                                                  <select name="age_end" id="age_end_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="العمر (إلى)">
                                                  <option value="all" style="text-align: right">الكل</option>
                                                  <?php 
                                                  $i=0;
                                                  for($i=0;$i<101;$i++)
                                                  {                                                  
                                                   ?>
                                                    <option value="<?php echo $i ?>" ><?php echo $i ?></option>                                                    
                                                    <?php } ?>
                                                  </select>
                                                 </th>
                                                 <!--age -->


                                                 <!--Lieu naiss-->
                                                <th style="text-align : center">
                                                <select  name="lieu_naiss" id="lieu_naiss_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="مكان الإزدياد" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                    <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_lieu_naiss_death";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['lieu_naiss_death'] ?>" style="text-align: right"><?php echo $row['lieu_naiss_death'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>   
                                                  </select>
                                                 </th>

                                                 <!--nom mere-->
                                                <th style="text-align : center">
                                                <select  name="nom_mere" id="nom_mere_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="  اسم الأم" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_nom_mere_death";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['nom_mere_death'] ?>" style="text-align: right"><?php echo $row['nom_mere_death'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                </th>

                                                <!--nom pere-->
                                                <th style="text-align : center">
                                                <select  name="nom_pere" id="nom_pere_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="  اسم الأب" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_nom_pere_death";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['nom_pere_death'] ?>" style="text-align: right"><?php echo $row['nom_pere_death'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                </th>

                                                <!--profession mere-->
                                                <th style="text-align : center">
                                                <select  name="profession_mere" id="profession_mere_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="مهنة الأم" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_prof_mere_death";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['prof_mere_death'] ?>" style="text-align: right"><?php echo $row['prof_mere_death'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                 </th>
                                            
                                                  
                                                 <!--profession pere-->
                                                <th style="text-align : center">
                                                <select  name="profession_pere" id="profession_pere_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="مهنة الأب" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_prof_pere_death";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['prof_pere_death'] ?>" style="text-align: right"><?php echo $row['prof_pere_death'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                 </th>


                                                  <!--officier etat civil-->
                                                <th style="text-align : center">
                                                <select  name="officier_etat_civil" id="officier_etat_civil_death" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="  ضابط الحالة المدنية" data-size="7">
                                                    <option value="all" style="text-align: right">الكل</option>
                                                  <!--select distinct lieu naisss from database-->
                                                  <?php 
                                                  $query= "select * from filter_officier_etat_civil_death";
                                                  $pdoResult = $pdoConnect->prepare($query);
                                                  $pdoResult->execute();
                                                  $result = $pdoResult->fetchAll();
                                                  if($pdoResult->RowCount()>0)
                                                  {
                                                    foreach ($result as $row) 
                                                    {
                                                      ?>
                                                        <option value="<?php echo $row['officier_etat_civil_death'] ?>" style="text-align: right"><?php echo $row['officier_etat_civil_death'] ?></option>
                                                      <?php                                                      
                                                    }
                                                  }
                                                  ?>    
                                                  </select>
                                                 </th>
                                             </tr>
                                         </thead>
                                         <tfoot>
                                             <tr>
                                               <th style="text-align : center"> الرقم </th>
                                               <th style="text-align : center">السنة</th>
                                                <th style="text-align : center">الإسم الشخصي</th>
                                                <th style="text-align : center">الإسم العائلي</th>
                                                <th style="text-align : center"> الجنس  </th>
                                                <th style="text-align : center"> العمر (من)  </th>
                                                <th style="text-align : center"> العمر (إلى)  </th>
                                                <th style="text-align : center"> مكان الإزدياد  </th>
                                                <th style="text-align : center">  اسم الأم  </th>
                                                <th style="text-align : center">  اسم الأب  </th>
                                                <th style="text-align : center">  مهنة الأم  </th>                                                
                                                <th style="text-align : center">  مهنة الأب  </th>                                             
                                               
                                                <th style="text-align : center">   ضابط الحالة المدنية  </th>
                                                
                                             </tr>
                                         </tfoot>

                                     </table>
                                   </form>

                                 </div><!--end datatables result-->


                               </div><!--end tab sdeath -->
                               
                           </div>
                       </div>
                       <!-- end content-->
                   </div>
                   <!--  end card  -->
               </div>
               <!-- end col-md-12 -->


            </div>
            <!--end content class-->
            <footer class="footer">
               <div class="container-fluid">
                  <p class="copyright pull-right">
                     &copy;
                     <script>
                        document.write( new Date().getFullYear() )
                     </script>
                     SMARTGIS
                  </p>
               </div>
            </footer>
         </div>
      </div>
   </body>
   <!--   Core JS Files   -->
   <!--   Core JS Files   -->
   <script src="assets/vendors/jquery-3.1.1.min.js" type="text/javascript"></script>
   <script src="assets/vendors/jquery-ui.min.js" type="text/javascript"></script>
   <script src="assets/vendors/bootstrap.min.js" type="text/javascript"></script>
   <script src="assets/vendors/material.min.js" type="text/javascript"></script>
   <script src="assets/vendors/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>


   <!-- Sliders Plugin -->
   <script src="assets/vendors/nouislider.min.js"></script>
   <!-- Select Plugin -->
   <script src="assets/vendors/jquery.select-bootstrap.js"></script>
   <!--notification-->
   <script src="assets/vendors/bootstrap-notify.js"></script>
   <!-- Material Dashboard javascript methods -->
   <script src="assets/js/turbo.js"></script>

   <!-- Sweet Alert 2 plugin -->
   <script src="assets/vendors/sweetalert2.js"></script>


   <!--Some js-->
   <script src="assets/js/generalSearch.js"></script>
   <script src="assets/js/avis_mngmnt.js"></script>
   <script src="assets/js/etatCivil.js"></script>
   <script src="assets/js/someJS.js"></script>
   <script src="assets/js/tasrihMngmnt.js"></script>
   <script src="assets/js/solbMngmt.js"></script>
   <script src="assets/js/extraitMngmnt.js"></script>
   <script src="assets/js/toraMangmnt.js"></script>
<!--  DataTables.net Plugin    -->
<script src="assets/vendors/jquery.datatables.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
      load_data();
      load_data_death();
      //SBirth datatables
      function load_data(is_gender,is_age_start,is_age_end,is_valid,is_annee,is_numero,is_prenom_ar,is_nom_ar,is_lieu_naiss,is_nom_mere,is_nom_pere,is_profession_pere,is_niveau_scol_pere,is_profession_mere,is_niveau_scol_mer,is_ordre_naiss,is_officier_etat_civil) //function to filter data
      {
        var datatable=$('#datatables_sBirth').DataTable({
          lengthChange: false,
           bPaginate: true,
           bFilter: true,
           bInfo: false,
           ordering : false,
           pageLength: 10,
           pagingType: "simple_numbers",
           language: {
             processing: "<img style='width:100px; height:100px;' src='assets/img/loader.gif' />",
               search: "_INPUT_",
               searchPlaceholder: "بحث",
               lengthMenu: "Aficher &nbsp&nbsp_MENU_ &nbsp linges par page",
               info: "page _PAGE_ sur _PAGES_ - _MAX_ lignes",
               emptyTable: "لا توجد نتائج",
               paginate: {
                   previous: "<div class='droid-arabic-kufi'> السابقة </div>",
                   next: "<div class='droid-arabic-kufi'> التالية </div>",
                   first: "<div class='droid-arabic-kufi'> الأولى </div>",
                   last: "<div class='droid-arabic-kufi'> الأخيرة </div> "
               }

           },


           processing: true,
               serverSide: true,
               ajax:{
                   url :"filterDB.php",
                   type: "post",
                   crossDomain: true,
                   data:
                   {
                      "is_gender" : is_gender,
                      "is_age_start" : is_age_start,
                      "is_age_end" : is_age_end,
                      "is_valid"  : is_valid,
                      "is_annee"  : is_annee,                      
                      "is_numero"  : is_numero,
                      "is_prenom_ar"  : is_prenom_ar,
                      "is_nom_ar"  : is_nom_ar,
                      "is_lieu_naiss" : is_lieu_naiss,
                      "is_nom_mere" : is_nom_mere,
                      "is_nom_pere" : is_nom_pere,
                      "is_profession_pere" : is_profession_pere,
                      "is_niveau_scol_pere" : is_niveau_scol_pere,
                      "is_profession_mere" : is_profession_mere,
                      "is_niveau_scol_mer" : is_niveau_scol_mer,
                      "is_ordre_naiss" : is_ordre_naiss,
                      "is_officier_etat_civil" : is_officier_etat_civil                      
                   },
                   dataFilter: function(response){
                    // console.log(response+"////////////////////////////////////////////////////////////////////////////");
            // this to see what exactly is being sent back
            $('#datatables_sBirth tbody').on('click', 'tr', function () {
            var data = datatable.row( this ).data();
            var numero = data[0].substring(data[0].lastIndexOf("em")+5,data[0].lastIndexOf("</"));
            var annee = data[1].substring(data[1].lastIndexOf("em")+5,data[1].lastIndexOf("</"));
            window.location.href = "selectedBirth.php?numero=" +numero+ "&annee=" + annee;
            //var folder  = "solbBirth";
            //var table = "sbirth";
            //send data for search scans of the clicked row
          /*  $.ajax({
          		url :"filterInfoDB.php",
          		type:"POST",
          		data:{"numero":numero,"annee":annee,"table":table,"folder":folder},
          		success: function(data){
          			//console.log(data);
                $("#scans").html(data);
          		}
          	});*/
      } );
                  return response;
              },
               }
        });
      }//end filter function
      var gender = $("#gender").val("all");
      var age_start = $("#age_start").val("all");
      var age_end = $("#age_end").val("all");
      var validate = $("#validate").val("all");
      var annee = $("#annee").val("all");
      
      var numero = $("#numero").val("all");
      var prenom_ar = $("#prenom_ar").val("all");
      var nom_ar = $("#nom_ar").val("all");
      var lieu_naiss = $("#lieu_naiss").val("all");
      var nom_mere = $("#nom_mere").val("all");
      var nom_pere = $("#nom_pere").val("all");
      var profession_pere = $("#profession_pere").val("all");
      var niveau_scol_pere = $("#niveau_scol_pere").val("all");
      var profession_mere = $("#profession_mere").val("all");
      var niveau_scol_mer = $("#niveau_scol_mer").val("all");
      var ordre_naiss = $("#ordre_naiss").val("all");
      var officier_etat_civil = $("#officier_etat_civil").val("all");
      $(document).on('change',"#gender,#age_start,#age_end,#validate,#annee,#numero,#prenom_ar,#nom_ar,#lieu_naiss,#nom_pere,#profession_pere,#niveau_scol_pere,#profession_mere,#niveau_scol_mer,#nom_mere,#ordre_naiss,#officier_etat_civil",function(){
         gender = $("#gender").val();
         age_start = $("#age_start").val();
         age_end = $("#age_end").val();
         validate = $("#validate").val();
         annee = $("#annee").val();
        
         numero = $("#numero").val();
         prenom_ar = $("#prenom_ar").val();
         nom_ar = $("#nom_ar").val();
         lieu_naiss = $("#lieu_naiss").val();
         nom_mere = $("#nom_mere").val();
         nom_pere = $("#nom_pere").val();
         profession_pere = $("#profession_pere").val();
         niveau_scol_pere = $("#niveau_scol_pere").val();
         profession_mere = $("#profession_mere").val();
         niveau_scol_mer = $("#niveau_scol_mer").val();
         ordre_naiss = $("#ordre_naiss").val();
         officier_etat_civil = $("#officier_etat_civil").val();
        $("#datatables_sBirth").DataTable().destroy();
        if(gender != '' && age_start != '' && age_end != '' && validate != '' && annee !='' && numero !='' && prenom_ar !='' && nom_ar !='' && lieu_naiss !=''  && nom_pere!='' && profession_pere !='' && niveau_scol_pere !='' && profession_mere !='' && niveau_scol_mer !='' && nom_mere!='' && ordre_naiss !='' && officier_etat_civil !='')
        {
          load_data(gender,age_start,age_end,validate,annee,numero,prenom_ar,nom_ar,lieu_naiss,nom_mere,nom_pere,profession_pere,niveau_scol_pere,profession_mere,niveau_scol_mer,ordre_naiss,officier_etat_civil)
        }else{
          load_data();
        }

      });


      //SDEATH DATATABLES**********************************************************************************************
      function load_data_death(is_gender,is_age_start,is_age_end,is_annee,is_numero,is_prenom_ar,is_nom_ar,is_lieu_naiss,is_nom_mere,is_nom_pere,is_profession_pere,is_profession_mere,is_officier_etat_civil) //function to filter data
      {
        var datatable=$('#datatables_sDeath').DataTable({
          lengthChange: false,
           bPaginate: true,
           bFilter: true,
           bInfo: false,
           ordering : false,
           pageLength: 10,
           pagingType: "simple_numbers",
           language: {
             processing: "<img style='width:100px; height:100px;' src='assets/img/loader.gif' />",
               search: "_INPUT_",
               searchPlaceholder: "بحث",
               lengthMenu: "Aficher &nbsp&nbsp_MENU_ &nbsp linges par page",
               info: "page _PAGE_ sur _PAGES_ - _MAX_ lignes",
               emptyTable: "لا توجد نتائج",
               paginate: {
                   previous: "<div class='droid-arabic-kufi'> السابقة </div>",
                   next: "<div class='droid-arabic-kufi'> التالية </div>",
                   first: "<div class='droid-arabic-kufi'> الأولى </div>",
                   last: "<div class='droid-arabic-kufi'> الأخيرة </div> "
               }
           },


           processing: true,
               serverSide: true,
               ajax:{
                   url :"filterDB_death.php",
                   type: "post",
                   crossDomain: true,
                   data:
                   {
                      "is_gender" : is_gender,
                      "is_age_start" : is_age_start,
                      "is_age_end" : is_age_end,
                      
                      "is_annee"  : is_annee,                      
                      "is_numero"  : is_numero,
                      "is_prenom_ar"  : is_prenom_ar,
                      "is_nom_ar"  : is_nom_ar,
                      "is_lieu_naiss" : is_lieu_naiss,
                      "is_nom_mere" : is_nom_mere,
                      "is_nom_pere" : is_nom_pere,
                      "is_profession_pere" : is_profession_pere,                     
                      "is_profession_mere" : is_profession_mere,                    
                      
                      "is_officier_etat_civil" : is_officier_etat_civil                      
                   },
                   dataFilter: function(response){
                    // console.log(response+"////////////////////////////////////////////////////////////////////////////");
            // this to see what exactly is being sent back
            $('#datatables_sDeath tbody').on('click', 'tr', function () {
            var data = datatable.row( this ).data();
            var numero = data[0].substring(data[0].lastIndexOf("em")+5,data[0].lastIndexOf("</"));
            var annee = data[1].substring(data[1].lastIndexOf("em")+5,data[1].lastIndexOf("</"));
            window.location.href = "selectedDeath.php?numero=" +numero+ "&annee=" + annee;
            //var folder  = "solbBirth";
            //var table = "sbirth";
            //send data for search scans of the clicked row
          /*  $.ajax({
          		url :"filterInfoDB.php",
          		type:"POST",
          		data:{"numero":numero,"annee":annee,"table":table,"folder":folder},
          		success: function(data){
          			//console.log(data);
                $("#scans").html(data);
          		}
          	});*/
      } );
                  return response;
              },
               }
        });
      }//end filter function
      var gender = $("#gender_death").val("all");
      var age_start = $("#age_start_death").val("all");
      var age_end = $("#age_end_death").val("all");
   
      var annee = $("#annee_death").val("all");      
      var numero = $("#numero_death").val("all");
      var prenom_ar = $("#prenom_ar_death").val("all");
      var nom_ar = $("#nom_ar_death").val("all");
      var lieu_naiss = $("#lieu_naiss_death").val("all");
      var nom_mere = $("#nom_mere_death").val("all");
      var nom_pere = $("#nom_pere_death").val("all");
      var profession_pere = $("#profession_pere_death").val("all");
     
      var profession_mere = $("#profession_mere_death").val("all");
        
      var officier_etat_civil = $("#officier_etat_civil_death").val("all");

      $(document).on('change',"#gender_death,#age_start_death,#age_end_death,#validate_death,#annee_death,#numero_death,#prenom_ar_death,#nom_ar_death,#lieu_naiss_death,#nom_pere_death,#profession_pere_death,#niveau_scol_pere_death,#profession_mere_death,#niveau_scol_mer_death,#nom_mere_death,#officier_etat_civil_death",function(){
         gender = $("#gender_death").val();
         age_start = $("#age_start_death").val();
         age_end = $("#age_end_death").val();
         validate = $("#validate_death").val();
         annee = $("#annee_death").val();
        
         numero = $("#numero_death").val();
         prenom_ar = $("#prenom_ar_death").val();
         nom_ar = $("#nom_ar_death").val();
         lieu_naiss = $("#lieu_naiss_death").val();
         nom_mere = $("#nom_mere_death").val();
         nom_pere = $("#nom_pere_death").val();
         profession_pere = $("#profession_pere_death").val();
         
         profession_mere = $("#profession_mere_death").val();
    
         
         officier_etat_civil = $("#officier_etat_civil_death").val();
        $("#datatables_sBirth").DataTable().destroy();
        if(gender != '' && age_start != '' && age_end != ''  && annee !='' && numero !='' && prenom_ar !='' && nom_ar !='' && lieu_naiss !=''  && nom_pere!='' && profession_pere !='' &&  profession_mere !='' &&  nom_mere!=''  && officier_etat_civil !='')
        {
          load_data(gender,age_start,age_end,annee,numero,prenom_ar,nom_ar,lieu_naiss,nom_mere,nom_pere,profession_pere,profession_mere,officier_etat_civil)
        }else{
          load_data();
        }

      });

        
        $('.card .material-datatables label').addClass('form-group');

    });
</script>
</html>
