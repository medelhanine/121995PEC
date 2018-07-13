<?php
   require "dbConnect.php";
   session_start();
   date_default_timezone_set('UTC');
   $ActualDate = date('Y-m-d H:i:s');
   $anneActu = substr($ActualDate,0,4);
   $HourActu = substr($ActualDate,10,3);
   $MinActu = substr($ActualDate,14,2);
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
                  <li class="active">
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
                           <li class="active">
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
                     <a href="" data-toggle="modal" data-target=".irsal">
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
                           <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#getDataModal" rel="tooltip" title=" معلومات حول الأب/الأم " data-placement="bottom">
                              <img class="material-icons" style="width:40px;height:40px;display:inline;" src="svg/file-search.svg">
                              <p class="hidden-lg hidden-md">
                                 profile
                                 <b class="caret"></b>
                              </p>
                           </a>
                        </li>
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
            <!--modal for searhc data to fill the form-->
            <div class="modal fade" id="getDataModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
               <div class="modal-dialog" role="document" style="margin-top: 70px !important;">
                  <div class="modal-content" style="height : 300px">
                     <div class="modal-header" style="padding : 0 !important;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                     </div>
                     <div class="modal-body">
                        <div class="col-md-9">
                           <div class="tab-content">
                              <!--get data from solb birth-->
                              <div class="tab-pane active" id="solbData">
                                 <form action="getDataSolbBirthDB.php" method="post" class="searchSolbBirthForm">
                                    <div class="row m-search-margin">
                                       <h5 class="droid-arabic-kufi" style="margin-bottom : 0 !important"> باستخدام الرقم و السنة (الصلب) </h5>
                                       <div class="col-md-2" style="text-align: center">
                                          <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                          <i class="material-icons">search</i>
                                          </button>
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                             <input type="text" name="anneeSolb" class="form-control"  required>
                                          </div>
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                             <input type="text" name="numeroSolb" class="form-control"  required>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>

                              <!--parents data-->
                              <div class="tab-pane " id="parentsInfo">
                                 <form action="searchParentDB.php" method="post" class="searchMotherDeathForm">
                                    <div class="row m-search-margin">
                                       <h5 class="droid-arabic-kufi" style="margin-bottom : 0 !important"> معلومات الأم </h5>
                                       <div class="col-md-2" style="text-align: center">
                                          <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                          <i class="material-icons">search</i>
                                          </button>
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                             <input type="text" name="annee" class="form-control" number="true" required>
                                          </div>
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                             <input type="text" name="numero" class="form-control" number="true" required>
                                          </div>
                                       </div>
                                    </div>
                                 </form>

                                 <form action="searchParentDB.php" method="post" class="searchDadDeathForm">
                                    <div class="row m-search-margin">
                                       <h5 class="droid-arabic-kufi" style="margin-bottom : 0 !important"> معلومات الأب </h5>
                                       <div class="col-md-2" style="text-align: center">
                                          <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                          <i class="material-icons">search</i>
                                          </button>
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                             <input type="text" name="annee" class="form-control" number="true" required>
                                          </div>
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                             <input type="text" name="numero" class="form-control" number="true" required>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                              <!--end parents data-->

                              <!--end getting data from solb birth-->
                              <!--get data From Ahkam-->
                              <div class="tab-pane" id="ahkam">
                                 <form action="searchTasrihDecesInfoDB.php" method="post" class="TasrihDecesInfoForm">
                                    <div class="row m-search-margin">
                                       <h5 class="droid-arabic-kufi" style="margin-bottom : 0 !important"> باستخدام الرقم و السنة (التصريح) </h5>
                                       <div class="col-md-2" style="text-align: center">
                                          <button type="submit" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                          <i class="material-icons">search</i>
                                          </button>
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                             <input type="text" name="annee" class="form-control" number="true" required>
                                          </div>
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الرقم</label>
                                             <input type="text" name="numero" class="form-control" number="true" required>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                              <!--end get data From Ahkam-->
                           </div>
                        </div>
                        <div class="nav-center col-md-3">
                           <ul class="nav nav-pills nav-pills-rose nav-pills-icons" role="tablist">
                              <li class="active" style="width:100%;margin:4px;margin-right:0px">
                                 <a href="#solbData" role="tab" data-toggle="tab">
                                 <i class="material-icons">folder_shared</i>
                                 <strong class="droid-arabic-kufi">  صلب الولادة</strong>
                                 </a>
                              </li>
                              <li  style="width:100%;margin:4px;margin-right:0px">
                                 <a href="#parentsInfo" role="tab" data-toggle="tab">
                                 <i class="material-icons">group_add</i>
                                 <strong class="droid-arabic-kufi">  الأم و الأب </strong>
                                 </a>
                              </li>
                              <li>
                                 <a href="#ahkam" role="tab" data-toggle="tab">
                                 <i class="material-icons">gavel</i>
                                 <strong class="droid-arabic-kufi">  التصريح</strong>
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--END -->
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
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم </h4>
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
                           <!--searhc with num-->
                           <form action="searchAvisDivorceNumDB.php" method="post" class="searchAvisDivorceNum">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color">باستخدام الرقم </h4>
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

               <!--modal  irsal-->
               <div class="modal fade irsal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog  m-modal-margin" role="document">
                     <div class="modal-content" style="margin-top:30%">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h3 style="text-align: center" class="droid-arabic-kufi">  البحث في قاعدة البيانات </h3>
                        </div>
                        <div class="modal-body">
                        <ul class="nav nav-pills nav-pills-warning droid-arabic-kufi" style="margin-left : 15%"> 
                                        <li >
                                            <a href="#takarir" data-toggle="tab" style="font-size : 18px !important">التقارير</a>
                                        </li>
                                        <li>
                                            <a href="#irsal_dawri" data-toggle="tab" style="font-size : 18px !important">الإرسال الدوري</a>
                                        </li>
                                        <li class="active">
                                            <a href="#irsal_chahri" data-toggle="tab" style="font-size : 18px !important">الإرسال الشهري</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane " id="takarir"><!--takarir-->
                                          
                                        </div><!--end takarir-->
                                        <div class="tab-pane" id="irsal_dawri"><!--irsal dawri-->
                                       

                                        </div><!--end irsal dawri-->
                                        <div class="tab-pane active" id="irsal_chahri"><!--irsal chahri-->
                                        <!--searhc with num-->
                           <form action="irsal_one_monthP.php" method="post" >
                              <div class="row">
                                 <h4 class="droid-arabic-kufi" style="color:#3F51B5;margin:0;text-align: center">  الإرسال الشهري العام</h4>
                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" name="type_irsal" value="general" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">print</i>
                                    </button>
                                 </div>
                               
                                 <div class="col-md-4" >
                                    <select name="year_general" class="selectpicker m-label-form form droid-arabic-kufi" data-style="btn btn-info btn-round" title="السنة" data-size="7" required>
                                       <option value="<?php echo $anneActu ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu ?></option>
                                       <option value="<?php echo $anneActu-1 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-1 ?></option>
                                       <option value="<?php echo $anneActu-2 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-2 ?></option>
                                       <option value="<?php echo $anneActu-3 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-3 ?></option>
                                       <option value="<?php echo $anneActu-4 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-4 ?></option>
                                    </select>
                                 </div>
                                 <div class="col-md-4" style="margin-right:1%">
                                    <select name="month_general" class="selectpicker m-label-form form droid-arabic-kufi" data-style="btn btn-info btn-round" title="الشهر" data-size="7" required>
                                       <option value="1" class="m-label-form droid-arabic-kufi" style="text-align:center">يناير</option>
                                       <option value="2" class="m-label-form droid-arabic-kufi" style="text-align:center">فبراير</option>
                                       <option value="3" class="m-label-form droid-arabic-kufi" style="text-align:center">مارس</option>
                                       <option value="4" class="m-label-form droid-arabic-kufi" style="text-align:center">أبريل</option>
                                       <option value="5" class="m-label-form droid-arabic-kufi" style="text-align:center">ماي</option>
                                       <option value="6" class="m-label-form droid-arabic-kufi" style="text-align:center">يونيو</option>
                                       <option value="7" class="m-label-form droid-arabic-kufi" style="text-align:center">يوليوز</option>
                                       <option value="8" class="m-label-form droid-arabic-kufi" style="text-align:center">غشت</option>
                                       <option value="9" class="m-label-form droid-arabic-kufi" style="text-align:center">شتنبر</option>
                                       <option value="10" class="m-label-form droid-arabic-kufi" style="text-align:center">أكتوبر</option>
                                       <option value="11" class="m-label-form droid-arabic-kufi" style="text-align:center">نونبر</option>
                                       <option value="12" class="m-label-form droid-arabic-kufi" style="text-align:center">دجنبر</option>
                                    </select>
                                 </div>
                              </div>
                              </form>

                              <!--mofassal-->
                              <form action="irsal_one_monthP.php" method="post" >
                              <div class="row">
                                <h4 class="droid-arabic-kufi" style="color:#3F51B5;margin:0;text-align: center"> الإرسال الشهري المفصل</h4>
                                <div class="col-md-2" style="text-align: center">
                                   <button type="submit" name="type_irsal" value="detail" class="btn btn-primary btn-round btn-fab btn-fab-mini m-button-margin">
                                   <i class="material-icons">print</i>
                                   </button>
                                </div>
                              
                                <div class="col-md-4" >
                                   <select name="year_detail" class="selectpicker m-label-form form droid-arabic-kufi" data-style="btn btn-info btn-round" title="السنة" data-size="7" required>
                                      <option value="<?php echo $anneActu ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu ?></option>
                                      <option value="<?php echo $anneActu-1 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-1 ?></option>
                                      <option value="<?php echo $anneActu-2 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-2 ?></option>
                                      <option value="<?php echo $anneActu-3 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-3 ?></option>
                                      <option value="<?php echo $anneActu-4 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-4 ?></option>
                                   </select>
                                </div>
                                <div class="col-md-4" style="margin-right:1%">
                                   <select name="month_detail" class="selectpicker m-label-form form droid-arabic-kufi" data-style="btn btn-info btn-round" title="الشهر" data-size="7" required>
                                      <option value="1" class="m-label-form droid-arabic-kufi" style="text-align:center">يناير</option>
                                      <option value="2" class="m-label-form droid-arabic-kufi" style="text-align:center">فبراير</option>
                                      <option value="3" class="m-label-form droid-arabic-kufi" style="text-align:center">مارس</option>
                                      <option value="4" class="m-label-form droid-arabic-kufi" style="text-align:center">أبريل</option>
                                      <option value="5" class="m-label-form droid-arabic-kufi" style="text-align:center">ماي</option>
                                      <option value="6" class="m-label-form droid-arabic-kufi" style="text-align:center">يونيو</option>
                                      <option value="7" class="m-label-form droid-arabic-kufi" style="text-align:center">يوليوز</option>
                                      <option value="8" class="m-label-form droid-arabic-kufi" style="text-align:center">غشت</option>
                                      <option value="9" class="m-label-form droid-arabic-kufi" style="text-align:center">شتنبر</option>
                                      <option value="10" class="m-label-form droid-arabic-kufi" style="text-align:center">أكتوبر</option>
                                      <option value="11" class="m-label-form droid-arabic-kufi" style="text-align:center">نونبر</option>
                                      <option value="12" class="m-label-form droid-arabic-kufi" style="text-align:center">دجنبر</option>
                                   </select>
                                </div>
                             </div>
                           </form>
                           <!-- end searhc by num-->     

                                        </div><!--end irsal chahri-->
                                    </div>                   
                        </div>
                     </div>
                  </div>
               </div>
               <!--end modal one month irsal-->


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
                     <div class="card-header ">
                     </div>
                     <div class="card-content">
                        <div class="row">
                           <div class="col-md-9">
                              <form action="insertDeathDB.php" method="post" class="sDeathForm" >
                                 <div class="tab-content" >
                                    <?php
                                       $query="SELECT MAX(annee) FROM `sdeadtable`";
                                       $pdoResult = $pdoConnect->prepare($query);
                                       $pdoResult->execute();

                                       $result=$pdoResult->fetch();

                                       ?>
                                    <!--info rasm-->
                                    <div class="tab-pane active" id="infoRasm">
                                       <?php if($anneActu == $result["MAX(annee)"]){
                                          $query2="SELECT MAX(numero) FROM `sdeadtable` WHERE annee=?";
                                          $pdoResult2 = $pdoConnect->prepare($query2);
                                          $pdoResult2->execute(array( $result["MAX(annee)"]));
                                          $result2=$pdoResult2->fetch();
                                         ?>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                             <input type="text" name="annee"  value="<?php echo $result["MAX(annee)"] ?>" id="anneeVal" class="form-control"  required>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> الرقم</label>
                                             <input type="text" name="numero" value="<?php echo $result2["MAX(numero)"]+1 ?>" id="numeroVal"  class="form-control" required>
                                          </div>
                                       </div>
                                       <?php }else{ ?>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                             <input type="text" name="annee"  value="<?php echo $anneActu ?>" id="anneeVal" class="form-control"  required>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> الرقم</label>
                                             <input type="text" name="numero" value="1"  id="numeroVal" class="form-control" required>
                                          </div>
                                       </div>
                                       <?php } ?>
                                        <!--id of solb birth-->
                                        <h3 class="droid-arabic-kufi">صلب الولادة</h3>
                                        <div class="col-md-6">
                                           <div class="form-group label-floating" id="annee_sBirth">
                                              <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                              <input type="text" name="annee_sBirth"    class="form-control"  required readonly>
                                           </div>
                                        </div>
                                        <div class="col-md-6">
                                           <div class="form-group label-floating" id="numero_sBirth">
                                              <label class="control-label m-label-form droid-arabic-kufi"> الرقم</label>
                                              <input type="text" name="numero_sBirth"  class="form-control" required readonly>
                                           </div>
                                        </div>
                                        <!--end id solb birth-->

                                    </div>
                                    <!--end info rasm-->
                                    <!--  infoDeath-->
                                    <div class="tab-pane " id="infoDeath">
                                       <!--prenom-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="prenom">
                                             <label class="control-label m-label-form">Prénom</label>
                                             <input type="text" name="prenom"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="prenom_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم الشخصي</label>
                                             <input type="text" name="prenom_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end prenom-->
                                       <!--nom-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nom">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nom_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم العائلي</label>
                                             <input type="text" name="nom_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom-->
                                       <!--prenom tora-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="prenom_tora">
                                             <label class="control-label m-label-form">Prénom</label>
                                             <input type="text" name="prenom_tora" value="Néant" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="prenom_tora_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم الشخصي طرة</label>
                                             <input type="text" name="prenom_tora_ar" value="لا توجد"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end prenom tora-->
                                       <!--nom tora-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nom_tora">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom_tora" value="Néant" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nom_tora_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم العائلي طرة</label>
                                             <input type="text" name="nom_tora_ar" id="nom_tora_value" value="لا توجد" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom tora-->

                                       <!--cine-->

                                       <div class="col-md-6">
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nom_tora_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi"> رقم البطاقة الوطنية للتعريف </label>
                                             <input type="text" name="cine"  class="form-control">
                                          </div>
                                       </div>
                                       <!--END cine-->
                                       <!--lieu deces-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" >
                                             <label class="control-label m-label-form">Lieu de décès</label>
                                             <input type="text" name="lieu_deces"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="lieu_deces_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">مكان الوفاة</label>
                                             <input type="text" name="lieu_deces_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end lieu deces-->
                                       <!--commune-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Commune</label>
                                             <input type="text" name="commune" value="<?php echo $communeName_fr ?>"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">جماعة</label>
                                             <input type="text" name="commune_ar" value="<?php echo $communeName ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end commune-->
                                       <!--date deces-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
                                             <input type="text" name="date_deces_hijri" value="1439-03-18"  class="form-control ">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">تاريخ الوفاة الميلادي</label>
                                             <input type="text" name="date_deces_miladi" value="2018-03-18"  class="form-control datepicker">
                                          </div>
                                       </div>
                                       <!---end date deces-->
                                       <!--en letrre arabe-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_deces_hijri_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_deces_hijri_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_deces_miladi_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_deces_miladi_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end en letrre arabe-->
                                       <!--en letrre franciase-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_deces_hijri_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_deces_miladi_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end en letrre franciase-->
                                       <!--heure et min-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="minute">
                                             <label class="control-label m-label-form droid-arabic-kufi">و الدقيقة</label>
                                             <input type="text" name="minute"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="heure">
                                             <label class="control-label m-label-form droid-arabic-kufi">على الساعة</label>
                                             <input type="text" name="heure"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end heure et min-->
                                    </div>
                                    <!--end infoDeath -->
                                    <!-- **************** infoDead********-->
                                    <div class="tab-pane" id="infoDead">
                                       <!--sex-->
                                       <div class="row" >
                                          <div class="col-md-4 " style="margin-left: 40% " id="sex">
                                             <select name="sex" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="الجنس" data-size="7" id="sex">
                                                <option value="feminin" class="m-label-form droid-arabic-kufi">أنثى</option>
                                                <option value="masculin" class="m-label-form droid-arabic-kufi">ذكر</option>
                                             </select>
                                          </div>
                                       </div>
                                       <!---end sex-->
                                       <!--lieu naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="lieu_naissance">
                                             <label class="control-label m-label-form">Lieu de naissance</label>
                                             <input type="text" name="lieu_naissance"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="lieu_naissance_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
                                             <input type="text" name="lieu_naissance_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end lieu naiss-->
                                       <!--date naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_hijri">
                                             <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
                                             <input type="text" name="date_naiss_hijri" value="1439-03-18"  class="form-control ">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_miladi">
                                             <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
                                             <input type="text" name="date_naiss_miladi" value="2018-03-18" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <!---end date naiss-->
                                       <!--en letrre arabe-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_hijri_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_hijri_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_miladi_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_miladi_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end en letrre arabe-->
                                       <!--en letrre franciase-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_hijri_fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_hijri_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_miladi_fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_miladi_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end en letrre franciase-->
                                       <!--profession-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Profession</label>
                                             <input type="text" name="profession"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="profession_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">المهنة</label>
                                             <input type="text" name="profession_ar"  class="form-control">
                                          </div>
                                       </div>


                                       <div class="row" ><!--category profession-->
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="prof_categ" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="نوع المهنة" data-size="7" >
                                                <option value="P1" class="m-label-form droid-arabic-kufi" style = "text-align : center;font-size : 12px !important"> أعضاء الهيأة التشريعية المنتخبون المحليون. المسؤولون التسلسليون في الإدارة المحلية المديرون و أطر إدارة المقاولات</option>
                                                <option value="P2" class="m-label-form droid-arabic-kufi" style = "text-align : center">أطر العليا و أعضاء المهن الحرة</option>

                                                <option value="P3" class="m-label-form droid-arabic-kufi" style = "text-align : center">     
                                                الأطر المتوسطة
                                                </option>

                                                <option value="P4" class="m-label-form droid-arabic-kufi" style = "text-align : center">     
                                                المستخدمون
                                                </option>

                                                <option value="P5" class="m-label-form droid-arabic-kufi" style = "text-align : center">     
                                                التجار الوسطاء التجاريون و الماليون
                                                </option>

                                                <option value="P6" class="m-label-form droid-arabic-kufi" style = "text-align : center">     
                                                المستغلون الفلاحيون صيادو السمك ، الغابويون القناصون و المشتغلون الذين يشابهونهم
                                                </option>

                                                <option value="P7" class="m-label-form droid-arabic-kufi" style = "text-align : center">     
                                                الحرفيون و العمال المؤهلون في المهن الحفية باسثثناء عمال الفلاحة
                                                </option>

                                                <option value="P8" class="m-label-form droid-arabic-kufi" style = "text-align : center">     
                                                العمال و العمال اليدويون في الفلاحة و الصيد ـبما فيهم العمال المؤهلون
                                                </option>

                                                <option value="P9" class="m-label-form droid-arabic-kufi" style = "text-align : center">     
                                                مسيروا التجهيزات و الآلات و عمال التركيب و التجميع
                                                </option>

                                                
                                                <option value="P10" class="m-label-form droid-arabic-kufi" style = "text-align : center">     
                                                العمال اليدويون عمال حمل البضائع و عمال المهن الصغرى باسثثناء الفلاحة
                                                </option>

                                                <option value="P11" class="m-label-form droid-arabic-kufi" style = "text-align : center">     
                                                أشخاص لايمكن تصنيفهم حسب المهنة و مهنة غير مصرح بها                                                                                              
                                                </option>
                                             </select>
                                          </div>                                          
                                       </div><!--end category profession-->
                                       <!---profession-->
                                       <!--nationalite-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nationalite">
                                             <label class="control-label m-label-form">Nationalité</label>
                                             <input type="text" name="nationalite" value="<?php echo $nationalite ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nationalite_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                             <input type="text" name="nationalite_ar" value="<?php echo $nationalite_ar ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---nationalite-->
                                       <!--adresse-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Domcile à</label>
                                             <input type="text" name="domicile"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="domicile_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الساكن(ة)ب</label>
                                             <input type="text" name="domicile_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end adresse-->
                                       <!--etat familiale-->
                                       <div class="row" >
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="etat_familiale" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="الحالة العائلية" data-size="7" >
                                                <option value="celeb" class="m-label-form droid-arabic-kufi">عازب(ة) </option>
                                                <option value="marie" class="m-label-form droid-arabic-kufi">متزوج(ة) </option>
                                                <option value="divorce" class="m-label-form droid-arabic-kufi">مطلق(ة) </option>
                                                <option value="veuf" class="m-label-form droid-arabic-kufi">أرمل(ة) </option>
                                             </select>
                                          </div>
                                       </div>
                                       <!---end etat familial-->
                                       <!--adresse-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Mr/Mme</label>
                                             <input type="text" name="mr_mme"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">(السيد(ة</label>
                                             <input type="text" name="mr_mme_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end adresse-->
                                    </div>
                                    <!--end infoDead -->
                                    <!-- info dad-->
                                    <div class="tab-pane" id="infoDad">
                                       <!--nom dad-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nom_pere">
                                             <label class="control-label m-label-form ">Nom</label>
                                             <input type="text" name="nom_pere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nom_pere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم </label>
                                             <input type="text" name="nom_pere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom dad-->
                                       <!--dead pere-->
                                       <div class="row" >
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="dead_pere" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="متوفي / غير متوفي" data-size="7" >
                                                <option value="notDead" class="m-label-form droid-arabic-kufi">غير متوفي</option>
                                                <option value="dead" class="m-label-form droid-arabic-kufi">متوفي</option>
                                             </select>
                                          </div>
                                       </div>
                                       <!---end dead pere-->
                                       <!--nationalite-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nationalite_pere">
                                             <label class="control-label m-label-form">Nationalité</label>
                                             <input type="text" name="nationalite_pere" value="<?php echo $nationalite ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nationalite_pere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                             <input type="text" name="nationalite_pere_ar" value="<?php echo $nationalite_ar ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nationalite-->
                                       <!--domcile-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="domicile_pere">
                                             <label class="control-label m-label-form">Domicile à</label>
                                             <input type="text" name="domicile_pere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="domicile_pere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الساكن ب</label>
                                             <input type="text" name="domicile_pere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end domcile-->
                                       <!--domcile-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="ne_a_pere">
                                             <label class="control-label m-label-form">Né à</label>
                                             <input type="text" name="ne_a_pere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="ne_a_pere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">المولود ب</label>
                                             <input type="text" name="ne_a_pere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end domcile-->
                                       <!--date naiss dad-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating " id="date_naiss_pere_hijri">
                                             <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
                                             <input type="text" name="date_naiss_pere_hijri" value="1439-03-18" class="form-control ">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_pere_miladi">
                                             <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
                                             <input type="text" name="date_naiss_pere_miladi" value="2018-03-18" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <!---end date naiss dad-->
                                       <!--letrre arabe-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="date_naiss_pere_hijri_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_pere_hijri_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_pere_miladi_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_pere_miladi_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end lettre arabe-->
                                       <!--en lettre francaise-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="date_naiss_pere_hijri_fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_pere_hijri_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="date_naiss_pere_miladi_fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_pere_miladi_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end en lettre francaise-->

                                       <!--profession-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="profession_pere">
                                             <label class="control-label m-label-form">Profession</label>
                                             <input type="text" name="profession_pere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="profession_pere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
                                             <input type="text" name="profession_pere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end profession-->
                                    </div>
                                    <!--end info dad-->
                                    <!-- info mom-->
                                    <div class="tab-pane" id="infoMom">
                                       <!--nom mere-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nom_mere">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom_mere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nom_mere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم </label>
                                             <input type="text" name="nom_mere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom mere-->
                                       <!--dead mere-->
                                       <div class="row" >
                                          <div class="col-md-4 " style="margin-left: 40% " >
                                             <select name="dead_mere" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="متوفي / غير متوفي" data-size="7" >
                                                <option value="notDead" class="m-label-form droid-arabic-kufi">غير متوفي</option>
                                                <option value="dead" class="m-label-form droid-arabic-kufi">متوفي</option>
                                             </select>
                                          </div>
                                       </div>
                                       <!---end dead mere-->
                                       <!--nationalite-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nationalite_mere">
                                             <label class="control-label m-label-form">Nationalité</label>
                                             <input type="text" name="nationalite_mere" value="<?php echo $nationalite ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nationalite_mere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                             <input type="text" name="nationalite_mere_ar" value="<?php echo $nationalite_ar ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nationalite-->
                                       <!--domcile-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="domicile_mere">
                                             <label class="control-label m-label-form">Domicile à</label>
                                             <input type="text" name="domicile_mere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="domicile_mere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الساكن ب</label>
                                             <input type="text" name="domicile_mere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end domcile-->
                                       <!--lieu naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="ne_a_mere">
                                             <label class="control-label m-label-form">Né à</label>
                                             <input type="text" name="ne_a_mere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="ne_a_mere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">المولود ب</label>
                                             <input type="text" name="ne_a_mere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end lieu naiss-->
                                       <!--date naiss dad-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating " id="date_naiss_mere_hijri">
                                             <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
                                             <input type="text" name="date_naiss_mere_hijri" value="1439-03-18" class="form-control ">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_mere_miladi">
                                             <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
                                             <input type="text" name="date_naiss_mere_miladi" value="2018-03-18" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <!---end date naiss dad-->
                                       <!--letrre arabe-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="date_naiss_mere_hijri_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_mere_hijri_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_mere_miladi_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_mere_miladi_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end lettre arabe-->
                                       <!--en lettre francaise-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="date_naiss_mere_hijri_fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_mere_hijri_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="date_naiss_mere_miladi_fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_mere_miladi_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end en lettre francaise-->

                                       <!--profession-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="profession_mere">
                                             <label class="control-label m-label-form">Profession</label>
                                             <input type="text" name="profession_mere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="profession_mere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
                                             <input type="text" name="profession_mere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end profession-->
                                    </div>
                                    <!--end info mom-->
                                    <!-- info tasrih-->
                                    <div class="tab-pane" id="infoTasrih">
                                       <!--Selon-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" >
                                             <label class="control-label m-label-form">Selon</label>
                                             <input type="text" name="selon"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="selon_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بناء على </label>
                                             <input type="text" name="selon_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end Selon-->

                                       <!--age mosarih-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" >
                                             <label class="control-label m-label-form">Agé de</label>
                                             <input type="text" name="age_mosarih"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="age_mosarih_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">عمره</label>
                                             <input type="text" name="age_mosarih_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!--age mosarih-->

                                       <!--domicile mosarih-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Domicilié à</label>
                                             <input type="text" name="domicile_mosarih"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="domicile_mosarih_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi"> القاطن ب </label>
                                             <input type="text" name="domicile_mosarih_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!--end domicile mosarih-->
                                       <!--موافق-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating ">
                                             <label class="control-label m-label-form droid-arabic-kufi">موافق</label>
                                             <input type="text" name="ecrite_le_hijri" value="1439-03-18" class="form-control ">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">حرر بتاريخ </label>
                                             <input type="text" name="ecrite_le_miladi" value="<?php echo $ActualDate ?>" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <!---end موافق-->
                                       <!--بالأحرف العربية-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating " id="ecrite_le_hijri_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="ecrite_le_hijri_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="ecrite_le_miladi_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية </label>
                                             <input type="text" name="ecrite_le_miladi_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end بالأحرف العربية-->
                                       <!--الفرنسية-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="ecrite_le_hijri_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form m-input-fr droid-arabic-kufi">بالأحرف الفرنسية </label>
                                             <input type="text" name="ecrite_le_miladi_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end الفرنسية-->
                                       <!--على الساعة-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">و الدقيقة</label>
                                             <input type="text" name="min_ecrit" value="<?php echo $MinActu ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form m-input-fr droid-arabic-kufi">على الساعة </label>
                                             <input type="text" name="heure_ecrit" value="<?php echo $HourActu ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end على الساعة-->
                                    </div>
                                    <!--end info tasrih-->

                                    <!-- officeEtat-->
                                    <div class="tab-pane" id="officeEtat">
                                       <!--Par nous-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Par nous</label>
                                             <input type="text" name="par_nous"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" >
                                             <label class="control-label m-label-form m-input-fr droid-arabic-kufi">من طرفنا نحن </label>
                                             <input type="text" name="par_nous_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end Par nous-->
                                       <!--Officier de l'état civile-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Officier de l'état civile</label>
                                             <input type="text" name="officier_etat_civil"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="officier_etat_civil">
                                             <label class="control-label m-label-form m-input-fr droid-arabic-kufi droid-arabic-kufi">ضابط الحالة المدنية </label>
                                             <input type="text" name="officier_etat_civil_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end Officier de l'état civile-->
                                    </div>
                                    <!--end officeEtat-->


                                      </form>
                              <!--  image upload-->
                              <div class="tab-pane" id="image">
                                <form action="uploadSDeadDB.php" class="dropzone" id="myAwesomeDropzone">
                                <input type="hidden" name="numero" id="numeroUpload" >
                                <input type="hidden" name="annee" id="anneeUpload" >
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
                                    <a href="#infoRasm" data-toggle="tab" rel="tooltip">
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">معلومات حول الرسم</b>
                                    </a>
                                 </li>
                                 <li >
                                    <a href="#infoDeath" data-toggle="tab" >
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">معلومات حول الوفاة</b>
                                    </a>
                                 </li>
                                 <li >
                                    <a href="#infoDead" data-toggle="tab">
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">معلومات حول المتوفي</b>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#infoDad" data-toggle="tab" >
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">معلومات حول الأب</b>
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
                                 <li>
                                    <a href="#officeEtat" data-toggle="tab" >
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">ضابط الحالة المدنية</b>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#image" data-toggle="tab" >
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">الصور</b>
                                    </a>
                                 </li>
                              </ul>
                           </div>
                           <!---end vertical pills-->
                        </div>
                        <div style="text-align: center;margin-right: 17% ;">
                           <button type="submit" class="btn btn-info"  id="submitSDeathForm">
                           <span class="btn-label">
                           <i class="material-icons">save</i>
                           </span>
                           <b class="droid-arabic-kufi"> حفظ </b>
                           </button>
                           <!--<button id="submitSDeathForm" type="submit" class="btn btn-success btn-round btn-fab btn-fab-regular" rel="tooltip" title="حفظ" onclick="submitForms()">
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

      	$('#submitSDeathForm').click( function() {
          $('.sDeathForm').submit();
      });

var numero = $('#numeroVal').attr('value');
var annee = $('#anneeVal').attr('value');
$('#numeroUpload').attr('value', numero);
$('#anneeUpload').attr('value', annee);




//get data from solb birth**********************************************************************
$('form.searchSolbBirthForm').on('submit',function(){

  //console.log("text teststst");
	var that = $(this),
	url = that.attr('action'),
	type=that.attr('method'),
	data = {};
	that.find('[name]').each(function(index,value){
		var that = $(this),
		name= that.attr('name'),
		value = that.val();

		data[name] = value;
	});

	$.ajax({
		url :url,
		type:type,
		data:data,
		dataType: 'json',
		success: function(data){
 		//console.log(data);
     $('#annee_sBirth').replaceWith(`<div class="form-group label-floating" id="annee_sBirth">
        <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
        <input type="text" name="annee_sBirth"  value="`+data["annee"]+`"  class="form-control"  required>
      </div>`);

      $('#numero_sBirth').replaceWith(`<div class="form-group label-floating" id="numero_sBirth">
        <label class="control-label m-label-form droid-arabic-kufi"> الرقم</label>
        <input type="text" name="numero_sBirth" value="`+data["numero"]+`" class="form-control" required>
      </div>`);

    $('#prenom').replaceWith(`<div class="form-group label-floating m-input-fr" id="prenom">
    				 <label class="control-label m-label-form">Prénom</label>
    				 <input type="text" name="prenom" value="`+data["prenom"]+`" class="form-control">
    			</div>`);


    			$('#prenom_ar').replaceWith(`<div class="form-group label-floating" id="prenom_ar">
     <label class="control-label m-label-form droid-arabic-kufi">الاسم الشخصي</label>
     <input type="text" name="prenom_ar" value="`+data["prenom_ar"]+`" class="form-control">
    </div>`);

    			$('#nom').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom">
                                                 <label class="control-label m-label-form">Nom</label>
                                                 <input type="text" name="nom" value="`+data["nom"]+`" class="form-control">
                                              </div>`);

    			$('#nom_ar').replaceWith(`<div class="form-group label-floating" id="nom_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الاسم العائلي</label>
                                                 <input type="text" name="nom_ar" value="`+data["nom_ar"]+`" class="form-control">
                                              </div>`);

    			$('#prenom_tora').replaceWith(`<div class="form-group label-floating m-input-fr" id="prenom_tora">
                                                 <label class="control-label m-label-form">Prénom</label>
                                                 <input type="text" name="prenom_tora" value="`+data["prenom_tora"]+`" class="form-control">
                                              </div>`);

    			$('#prenom_tora_ar').replaceWith(`<div class="form-group label-floating" id="prenom_tora_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الاسم الشخصي طرة</label>
                                                 <input type="text" name="prenom_tora_ar" value="`+data["prenom_tora_ar"]+`"  class="form-control">
                                              </div>`);

    			$('#nom_tora').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom_tora">
                                                 <label class="control-label m-label-form">Nom</label>
                                                 <input type="text" name="nom_tora" value="`+data["nom_tora"]+`" class="form-control">
                                              </div>`);

    			$('#nom_tora_ar').replaceWith(`<div class="form-group label-floating" id="nom_tora_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الاسم العائلي طرة</label>
                                                 <input type="text" name="nom_tora_ar" value="`+data["nom_tora_ar"]+`" class="form-control">
                                              </div>`);




    			$('#lieu_naissance').replaceWith(`<div class="form-group label-floating m-input-fr" id="lieu_naissance">
                                                 <label class="control-label m-label-form">Lieu de naissance</label>
                                                 <input type="text" name="lieu_naissance" value="`+data["lieu_naiss"]+`" class="form-control">
                                              </div>`);

    			$('#lieu_naissance_ar').replaceWith(`<div class="form-group label-floating" id="lieu_naissance_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
                                                 <input type="text" name="lieu_naissance_ar" value="`+data["lieu_naiss_ar"]+`" class="form-control">
                                              </div>`);

    			$('#date_naiss_hijri').replaceWith(`<div class="form-group label-floating" id="date_naiss_hijri">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
                                                 <input type="text" name="date_naiss_hijri" value="`+data["date_naiss_hijri"]+`"  class="form-control ">
                                              </div>`);

    			$('#date_naiss_miladi').replaceWith(` <div class="form-group label-floating" id="date_naiss_miladi">
                                                 <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
                                                 <input type="text" name="date_naiss_miladi" value="`+data["date_naiss_miladi"]+`" class="form-control datepicker">
                                              </div>`);

    			$('#date_naiss_hijri_ar').replaceWith(`<div class="form-group label-floating" id="date_naiss_hijri_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                                 <input type="text" name="date_naiss_hijri_ar" value="`+data["date_naiss_hijri_ar"]+`" class="form-control">
                                              </div>`);

    			$('#date_naiss_miladi_ar').replaceWith(`<div class="form-group label-floating" id="date_naiss_miladi_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                                 <input type="text" name="date_naiss_miladi_ar" value="`+data["date_naiss_miladi_ar"]+`" class="form-control">
                                              </div>`);

    			$('#date_naiss_hijri_fr').replaceWith(`<div class="form-group label-floating" id="date_naiss_hijri_fr">
                                                 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                                 <input type="text" name="date_naiss_hijri_fr" value="`+data["date_naiss_hijri_fr"]+`" class="form-control">
                                              </div>`);

    			$('#date_naiss_miladi_fr').replaceWith(`<div class="form-group label-floating" id="date_naiss_miladi_fr">
                                                 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                                 <input type="text" name="date_naiss_miladi_fr" value="`+data["date_naiss_miladi_fr"]+`" class="form-control">
                                              </div>`);

    			$('#nationalite').replaceWith(`<div class="form-group label-floating m-input-fr" id="nationalite">
                                                 <label class="control-label m-label-form">Nationalité</label>
                                                 <input type="text" name="nationalite" value="`+data["nationalite"]+`" class="form-control">
                                              </div>`);

    			$('#nationalite_ar').replaceWith(`<div class="form-group label-floating" id="nationalite_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                                 <input type="text" name="nationalite_ar" value="`+data["nationalite_ar"]+`" class="form-control">
                                              </div>`);

    			$('#nom_pere').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom_pere">
                                                 <label class="control-label m-label-form">Nom</label>
                                                 <input type="text" name="nom_pere" value="`+data["nom_pere"]+`" class="form-control">
                                              </div>`);

    			$('#nom_pere_ar').replaceWith(`<div class="form-group label-floating" id="nom_pere_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الاسم </label>
                                                 <input type="text" name="nom_pere_ar" value="`+data["nom_pere_ar"]+`" class="form-control">
                                              </div>`);

    			$('#nationalite_pere').replaceWith(`<div class="form-group label-floating m-input-fr" id="nationalite_pere">
                                                 <label class="control-label m-label-form">Nationalité</label>
                                                 <input type="text" name="nationalite_pere" value="`+data["nationalite_pere"]+`" class="form-control">
                                              </div>`);

    			$('#nationalite_pere_ar').replaceWith(`<div class="form-group label-floating" id="nationalite_pere_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                                 <input type="text" name="nationalite_pere_ar" value="`+data["nationalite_pere_ar"]+`" class="form-control">
                                              </div>`);

    			$('#domicile_pere').replaceWith(`<div class="form-group label-floating m-input-fr" id="domicile_pere">
                                                 <label class="control-label m-label-form">Domicile à</label>
                                                 <input type="text" name="domicile_pere" value="`+data["adresse_parent"]+`" class="form-control">
                                              </div>`);

    			$('#domicile_pere_ar').replaceWith(`<div class="form-group label-floating" id="domicile_pere_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الساكن ب</label>
                                                 <input type="text" name="domicile_pere_ar" value="`+data["adresse_parent_ar"]+`" class="form-control">
                                              </div>`);

    			$('#ne_a_pere').replaceWith(`<div class="form-group label-floating m-input-fr" id="ne_a_pere">
                                                 <label class="control-label m-label-form">Né à</label>
                                                 <input type="text" name="ne_a_pere" value="`+data["lieu_naiss_pere"]+`" class="form-control">
                                              </div>`);

    			$('#ne_a_pere_ar').replaceWith(`<div class="form-group label-floating" id="ne_a_pere_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">المولود ب</label>
                                                 <input type="text" name="ne_a_pere_ar" value="`+data["lieu_naiss_pere_ar"]+`" class="form-control">
                                              </div>`);

    			$('#date_naiss_pere_hijri').replaceWith(`<div class="form-group label-floating " id="date_naiss_pere_hijri">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
                                                 <input type="text" name="date_naiss_pere_hijri" value="`+data["date_naiss_pere_hijri"]+`" class="form-control ">
                                              </div>`);

    			$('#date_naiss_pere_miladi').replaceWith(`<div class="form-group label-floating" id="date_naiss_pere_miladi">
                                                 <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
                                                 <input type="text" name="date_naiss_pere_miladi" value="`+data["date_naiss_pere_miladi"]+`" class="form-control datepicker">
                                              </div>`);

    			$('#date_naiss_pere_hijri_ar').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_pere_hijri_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                                 <input type="text" name="date_naiss_pere_hijri_ar" value="`+data["date_naiss_pere_hijri_ar"]+`" class="form-control">
                                              </div>`);

    			$('#date_naiss_pere_miladi_ar').replaceWith(`<div class="form-group label-floating" id="date_naiss_pere_miladi_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                                 <input type="text" name="date_naiss_pere_miladi_ar" value="`+data["date_naiss_pere_miladi_ar"]+`" class="form-control">
                                              </div>`);

    			$('#date_naiss_pere_hijri_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_pere_hijri_fr">
                                                 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                                 <input type="text" name="date_naiss_pere_hijri_fr" value="`+data["date_naiss_pere_hijri_fr"]+`" class="form-control">
                                              </div>`);

    			$('#date_naiss_pere_miladi_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_pere_miladi_fr">
                                                 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                                 <input type="text" name="date_naiss_pere_miladi_fr" value="`+data["date_naiss_pere_miladi_fr"]+`" class="form-control">
                                              </div>`);

    			$('#profession_pere').replaceWith(`<div class="form-group label-floating m-input-fr" id="profession_pere">
                                                 <label class="control-label m-label-form">Profession</label>
                                                 <input type="text" name="profession_pere" value="`+data["profession_pere"]+`" class="form-control">
                                              </div>`);

    			$('#profession_pere_ar').replaceWith(`<div class="form-group label-floating" id="profession_pere_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
                                                 <input type="text" name="profession_pere_ar" value="`+data["profession_pere_ar"]+`" class="form-control">
                                              </div>`);

    			$('#nom_mere').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom_mere">
                                                 <label class="control-label m-label-form">Nom</label>
                                                 <input type="text" name="nom_mere" value="`+data["nom_mere"]+`" class="form-control">
                                              </div>`);

    			$('#nom_mere_ar').replaceWith(` <div class="form-group label-floating" id="nom_mere_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الاسم </label>
                                                 <input type="text" name="nom_mere_ar" value="`+data["nom_mere_ar"]+`" class="form-control">
                                              </div>`);


    $('#nationalite_mere').replaceWith(`<div class="form-group label-floating m-input-fr" id="nationalite_mere">
                                                 <label class="control-label m-label-form">Nationalité</label>
                                                 <input type="text" name="nationalite_mere" value="`+data["nationalite_mere"]+`" class="form-control">
                                              </div>`);



    $('#nationalite_mere_ar').replaceWith(`<div class="form-group label-floating" id="nationalite_mere_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                                 <input type="text" name="nationalite_mere_ar" value="`+data["nationalite_mere_ar"]+`" class="form-control">
                                              </div>`);




    $('#domicile_mere').replaceWith(`<div class="form-group label-floating m-input-fr" id="domicile_mere">
                                                 <label class="control-label m-label-form">Domicile à</label>
                                                 <input type="text" name="domicile_mere" value="`+data["adresse_parent"]+`" class="form-control">
                                              </div>`);


    $('#domicile_mere_ar').replaceWith(`<div class="form-group label-floating" id="domicile_mere_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الساكن ب</label>
                                                 <input type="text" name="domicile_mere_ar" value="`+data["adresse_parent_ar"]+`" class="form-control">
                                              </div>`);



    $('#ne_a_mere').replaceWith(`<div class="form-group label-floating m-input-fr" id="ne_a_mere">
                                                 <label class="control-label m-label-form">Né à</label>
                                                 <input type="text" name="ne_a_mere" value="`+data["lieu_naiss_mere"]+`" class="form-control">
                                              </div>`);




    $('#ne_a_mere_ar').replaceWith(`<div class="form-group label-floating" id="ne_a_mere_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">المولود ب</label>
                                                 <input type="text" name="ne_a_mere_ar" value="`+data["lieu_naiss_mere_ar"]+`" class="form-control">
                                              </div>`);



    $('#date_naiss_mere_hijri').replaceWith(`<div class="form-group label-floating " id="date_naiss_mere_hijri">
                                                 <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
                                                 <input type="text" name="date_naiss_mere_hijri" value="`+data["date_naiss_mere_hijri"]+`" class="form-control ">
                                              </div>`);


    $('#date_naiss_mere_miladi').replaceWith(`<div class="form-group label-floating" id="date_naiss_mere_miladi">
                                                 <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
                                                 <input type="text" name="date_naiss_mere_miladi" value="`+data["date_naiss_mere_miladi"]+`" class="form-control datepicker">
                                              </div>`);


    $('#date_naiss_mere_hijri_ar').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_mere_hijri_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                                 <input type="text" name="date_naiss_mere_hijri_ar" value="`+data["date_naiss_mere_hijri_ar"]+`" class="form-control">
                                              </div>`);


    $('#date_naiss_mere_miladi_ar').replaceWith(`<div class="form-group label-floating" id="date_naiss_mere_miladi_ar">
         <label class="control-label m-label-form">بالأحرف العربية</label>
         <input type="text" name="date_naiss_mere_miladi_ar" value="`+data["date_naiss_mere_miladi_ar"]+`" class="form-control">
      </div>`);


    $('#date_naiss_mere_hijri_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_mere_hijri_fr">
                                                 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                                 <input type="text" name="date_naiss_mere_hijri_fr" value="`+data["date_naiss_mere_hijri_fr"]+`" class="form-control">
                                              </div>`);


    $('#date_naiss_mere_miladi_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_mere_miladi_fr">
                                                 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                                 <input type="text" name="date_naiss_mere_miladi_fr" value="`+data["date_naiss_mere_miladi_fr"]+`" class="form-control">
                                              </div>`);


    $('#profession_mere').replaceWith(`<div class="form-group label-floating m-input-fr" id="profession_mere">
                                                 <label class="control-label m-label-form">Profession</label>
                                                 <input type="text" name="profession_mere" value="`+data["profession_mere"]+`" class="form-control">
                                              </div>`);


    $('#profession_mere_ar').replaceWith(`<div class="form-group label-floating" id="profession_mere_ar">
                                                 <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
                                                 <input type="text" name="profession_mere_ar" value="`+data["profession_mere_ar"]+`" class="form-control">
                                              </div>`);



    if(data["prenom"] != "" || data["nom"] != "")
      {
        $.notify({
        icon: "notifications",
        message: ' تم إضافة البيانات '

            },
         {
      type: 'success',
      timer: 3000,
      placement: {
        from: 'top',
        align: 'left'
      }
    });
      $("#getDataModal").modal('hide');
      }
    else
      {

          $.notify({
        icon: "notifications",
        message: 'فشل البحث '

            },
         {
      type: 'danger',
      timer: 3000,
      placement: {
        from: 'top',
        align: 'left'
      }
    });

      }
		}

	});

	return false;
});





//search data from tasrih
$('form.TasrihDecesInfoForm').on('submit',function(){

	//console.log("teststststs");
	var that = $(this),
	url = that.attr('action'),
	type=that.attr('method'),
	data = {};
	that.find('[name]').each(function(index,value){
		var that = $(this),
		name= that.attr('name'),
		value = that.val();

		data[name] = value;
	});

	$.ajax({
		url :url,
		type:type,
		data:data,
		dataType: 'json',
		success: function(data){
 		//console.log(data);

    $('#prenom').replaceWith(`<div class="form-group label-floating m-input-fr" id="prenom">
 <label class="control-label m-label-form">Prénom</label>
 <input type="text" name="prenom" value="`+data["prenom_deces_fr"]+`" class="form-control">
</div>`);



$('#prenom_ar').replaceWith(`<div class="form-group label-floating" id="prenom_ar">
 <label class="control-label m-label-form droid-arabic-kufi">الاسم الشخصي</label>
 <input type="text" name="prenom_ar" value="`+data["prenom_deces"]+`" class="form-control">
</div>`);

$('#nom').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom">
 <label class="control-label m-label-form">Nom</label>
 <input type="text" name="nom" value="`+data["nom_deces_fr"]+`" class="form-control">
</div>`);

$('#nom_ar').replaceWith(`<div class="form-group label-floating" id="nom_ar">
 <label class="control-label m-label-form droid-arabic-kufi">الاسم العائلي</label>
 <input type="text" name="nom_ar" value="`+data["nom_deces"]+`" class="form-control">
</div>`);

$('#lieu_deces_ar').replaceWith(`<div class="form-group label-floating" id="lieu_deces_ar">
 <label class="control-label m-label-form droid-arabic-kufi">مكان الوفاة</label>
 <input type="text" name="lieu_deces_ar" value="`+data["lieu_deces"]+`" class="form-control">
</div>`);

$('#date_deces_hijri_ar').replaceWith(`<div class="form-group label-floating" id="date_deces_hijri_ar">
 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
 <input type="text" name="date_deces_hijri_ar" value="`+data["date_deces_hijri"]+" "+data["annee_deces_hijri"]+`" class="form-control">
</div>`);

$('#date_deces_miladi_ar').replaceWith(`<div class="form-group label-floating" id="date_deces_miladi_ar">
 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
 <input type="text" name="date_deces_miladi_ar" value="`+data["date_deces_miladi"]+" "+data["annee_deces_miladi"]+`" class="form-control">
</div>`);

$('#minute').replaceWith(`<div class="form-group label-floating" id="minute">
 <label class="control-label m-label-form droid-arabic-kufi">و الدقيقة</label>
 <input type="text" name="minute" value="`+data["min"]+`" class="form-control">
</div>`);

$('#heure').replaceWith(`<div class="form-group label-floating" id="heure">
 <label class="control-label m-label-form droid-arabic-kufi">على الساعة</label>
 <input type="text" name="heure" value="`+data["heure"]+`" class="form-control">
</div>`);

$('#lieu_naissance_ar').replaceWith(`<div class="form-group label-floating" id="lieu_naissance_ar">
 <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
 <input type="text" name="lieu_naissance_ar" value="`+data["lieu_naiss"]+`" class="form-control">
</div>`);

$('#date_naiss_hijri_ar').replaceWith(`<div class="form-group label-floating" id="date_naiss_hijri_ar">
 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
 <input type="text" name="date_naiss_hijri_ar" value="`+data["date_naiss_hijri"]+" "+data["annee_naiss_hijri"]+`" class="form-control">
</div>`);

$('#date_naiss_miladi_ar').replaceWith(`<div class="form-group label-floating" id="date_naiss_miladi_ar">
 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
 <input type="text" name="date_naiss_miladi_ar" value="`+data["date_naiss_miladi"]+" "+data["annee_naiss_miladi"]+`" class="form-control">
</div>`);

$('#profession_ar').replaceWith(`<div class="form-group label-floating" id="profession_ar">
 <label class="control-label m-label-form droid-arabic-kufi">المهنة</label>
 <input type="text" name="profession_ar" value="`+data["profession"]+`" class="form-control">
</div>`);

$('#nationalite_ar').replaceWith(`<div class="form-group label-floating" id="nationalite_ar">
 <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
 <input type="text" name="nationalite_ar" value="`+data["nationalite"]+`" class="form-control">
</div>`);

$('#domicile_ar').replaceWith(`<div class="form-group label-floating" id="domicile_ar">
 <label class="control-label m-label-form droid-arabic-kufi">الساكن(ة)ب</label>
 <input type="text" name="domicile_ar" value="`+data["adresse_deces"]+`" class="form-control">
</div>`);

$('#nom_pere_ar').replaceWith(`<div class="form-group label-floating" id="nom_pere_ar">
 <label class="control-label m-label-form droid-arabic-kufi">الاسم </label>
 <input type="text" name="nom_pere_ar" value="`+data["nom_pere"]+`" class="form-control">
</div>`);

$('#nationalite_pere_ar').replaceWith(`<div class="form-group label-floating" id="nationalite_pere_ar">
 <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
 <input type="text" name="nationalite_pere_ar" value="`+data["nationalite_pere"]+`" class="form-control">
</div>`);

$('#domicile_pere_ar').replaceWith(`<div class="form-group label-floating" id="domicile_pere_ar">
 <label class="control-label m-label-form droid-arabic-kufi">الساكن ب</label>
 <input type="text" name="domicile_pere_ar" value="`+data["adresse_pere"]+`" class="form-control">
</div>`);

$('#profession_pere_ar').replaceWith(`<div class="form-group label-floating" id="profession_pere_ar">
 <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
 <input type="text" name="profession_pere_ar" value="`+data["profession_pere"]+`" class="form-control">
</div>`);

$('#nom_mere_ar').replaceWith(`<div class="form-group label-floating" id="nom_mere_ar">
 <label class="control-label m-label-form droid-arabic-kufi">الاسم </label>
 <input type="text" name="nom_mere_ar" value="`+data["nom_mere"]+`" class="form-control">
</div>`);

$('#nationalite_mere_ar').replaceWith(`<div class="form-group label-floating" id="nationalite_mere_ar">
 <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
 <input type="text" name="nationalite_mere_ar" value="`+data["nationalite_mere"]+`" class="form-control">
</div>`);


$('#domicile_mere_ar').replaceWith(`<div class="form-group label-floating" id="domicile_mere_ar">
 <label class="control-label m-label-form droid-arabic-kufi">الساكن ب</label>
 <input type="text" name="domicile_mere_ar" value="`+data["adresse_mere"]+`" class="form-control">
</div>`);

$('#profession_mere_ar').replaceWith(`<div class="form-group label-floating" id="profession_mere_ar">
 <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
 <input type="text" name="profession_mere_ar" value="`+data["profession_mere"]+`" class="form-control">
</div>`);



$('#selon_ar').replaceWith(`<div class="form-group label-floating" id="selon_ar">
 <label class="control-label m-label-form droid-arabic-kufi">بناء على </label>
 <input type="text" name="selon_ar" value="`+data["selon_annonceur"]+`" class="form-control">
</div>`);


$('#age_mosarih_ar').replaceWith(`<div class="form-group label-floating" id="age_mosarih_ar">
 <label class="control-label m-label-form droid-arabic-kufi">عمره</label>
 <input type="text" name="age_mosarih_ar" value="`+data["age_annonceur"]+`" class="form-control">
</div>`);


$('#domicile_mosarih_ar').replaceWith(`<div class="form-group label-floating" id="domicile_mosarih_ar">
 <label class="control-label m-label-form droid-arabic-kufi"> القاطن ب </label>
 <input type="text" name="domicile_mosarih_ar" value="`+data["adresse_annonceur"]+`" class="form-control">
</div>`);



$('#ecrite_le_hijri_ar').replaceWith(`<div class="form-group label-floating " id="ecrite_le_hijri_ar">
 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
 <input type="text" name="ecrite_le_hijri_ar" value="`+data["date_ecrit_hijri"]+" "+data["annee_ecrit_hijri"]+`" class="form-control">
</div>`);



$('#ecrite_le_miladi_ar').replaceWith(`<div class="form-group label-floating" id="ecrite_le_miladi_ar">
 <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية </label>
 <input type="text" name="ecrite_le_miladi_ar" value="`+data["date_ecrit_miladi"]+" "+data["annee_ecrit_miladi"]+`" class="form-control">
</div>`);

	//	$('#parentsModal').modal('hide');
			if(data["prenom_deces"] != "" || data["nom_deces"] != "")
				{
					$.notify({
        	icon: "notifications",
        	message: ' تم إضافة البيانات '

        			},
					 {
				type: 'success',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}
			else
				{

						$.notify({
        	icon: "notifications",
        	message: 'فشل البحث '

        			},
					 {
				type: 'danger',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}

		}

	});

	return false;
});



// MOM INFO**************
$('form.searchMotherDeathForm').on('submit',function(){
	//console.log("teststststs");
	var that = $(this),
	url = that.attr('action'),
	type=that.attr('method'),
	data = {};
	that.find('[name]').each(function(index,value){
		var that = $(this),
		name= that.attr('name'),
		value = that.val();

		data[name] = value;
	});

	$.ajax({
		url :url,
		type:type,
		data:data,
		dataType: 'json',
		success: function(data){
 //console.log(data);
 $('#nom_mere').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom_mere">
		<label class="control-label m-label-form">Nom</label>
		<input type="text" name="nom_mere" value="`+data["prenom"]+" "+data["nom"]+`" class="form-control">
 </div>`);

 $('#nom_mere_ar').replaceWith(`<div class="form-group label-floating" id="nom_mere_ar">
		<label class="control-label m-label-form droid-arabic-kufi">الاسم </label>
		<input type="text" name="nom_mere_ar" value="`+data["prenom_ar"]+" "+data["nom_ar"]+`" class="form-control">
 </div>`);

 $('#nationalite_mere').replaceWith(`<div class="form-group label-floating m-input-fr" id="nationalite_mere">
		<label class="control-label m-label-form">Nationalité</label>
		<input type="text" name="nationalite_mere" value="`+data["nationalite"]+`" class="form-control">
 </div>`);

 $('#nationalite_mere_ar').replaceWith(`<div class="form-group label-floating" id="nationalite_mere_ar">
		<label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
		<input type="text" name="nationalite_mere_ar" value="`+data["nationalite_ar"]+`" class="form-control">
 </div>`);

 $('#ne_a_mere').replaceWith(`<div class="form-group label-floating m-input-fr" id="ne_a_mere">
		<label class="control-label m-label-form">Né à</label>
		<input type="text" name="ne_a_mere" value="`+data["lieu_naiss"]+`" class="form-control">
 </div>`);

 $('#ne_a_mere_ar').replaceWith(`<div class="form-group label-floating" id="ne_a_mere_ar">
		<label class="control-label m-label-form droid-arabic-kufi">المولود ب</label>
		<input type="text" name="ne_a_mere_ar" value="`+data["lieu_naiss_ar"]+`" class="form-control">
 </div>`);

 $('#date_naiss_mere_hijri').replaceWith(`<div class="form-group label-floating " id="date_naiss_mere_hijri">
		<label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
		<input type="text" name="date_naiss_mere_hijri" value="`+data["date_naiss_hijri"]+`" class="form-control ">
 </div>`);

 $('#date_naiss_mere_miladi').replaceWith(`<div class="form-group label-floating" id="date_naiss_mere_miladi">
		<label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
		<input type="text" name="date_naiss_mere_miladi" value="`+data["date_naiss_miladi"]+`" class="form-control datepicker">
 </div>`);

 $('#date_naiss_mere_hijri_ar').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_mere_hijri_ar">
		<label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
		<input type="text" name="date_naiss_mere_hijri_ar" value="`+data["date_naiss_hijri_ar"]+`" class="form-control">
 </div>`);

 $('#date_naiss_mere_miladi_ar').replaceWith(`<div class="form-group label-floating" id="date_naiss_mere_miladi_ar">
		<label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
		<input type="text" name="date_naiss_mere_miladi_ar" value="`+data["date_naiss_miladi_ar"]+`" class="form-control">
 </div>`);

 $('#date_naiss_mere_hijri_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_mere_hijri_fr">
		<label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
		<input type="text" name="date_naiss_mere_hijri_fr" value="`+data["date_naiss_hijri_fr"]+`" class="form-control">
 </div>`);

 $('#date_naiss_mere_miladi_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_mere_miladi_fr">
		<label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
		<input type="text" name="date_naiss_mere_miladi_fr" value="`+data["date_naiss_miladi_fr"]+`" class="form-control">
 </div>`);



			$('#getDataModal').modal('hide');
			if(data["prenom_ar"] != "" ||  data["nom_ar"] != "")
				{


					$.notify({
        	icon: "notifications",
        	message: 'تم إضافة بيانات الأم '

        			},
					 {
				type: 'success',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}
			else
				{

						$.notify({
        	icon: "notifications",
        	message: 'فشل البحث '

        			},
					 {
				type: 'danger',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}

		}

	});

	return false;
});



//DAD Info **************
$('form.searchDadDeathForm').on('submit',function(){

	//console.log("teststststs");
	var that = $(this),
	url = that.attr('action'),
	type=that.attr('method'),
	data = {};
	that.find('[name]').each(function(index,value){
		var that = $(this),
		name= that.attr('name'),
		value = that.val();

		data[name] = value;
	});

	$.ajax({
		url :url,
		type:type,
		data:data,
		dataType: 'json',
		success: function(data){
 //console.log(data);
$('#nom_pere').replaceWith(`<div class="form-group label-floating m-input-fr" id="nom_pere">
	 <label class="control-label m-label-form">Nom</label>
	 <input type="text" name="nom_pere" value="`+data["prenom"]+" "+data["nom"]+`" class="form-control">
</div>`);

$('#nom_pere_ar').replaceWith(`<div class="form-group label-floating" id="nom_pere_ar">
	 <label class="control-label m-label-form">الاسم </label>
	 <input type="text" name="nom_pere_ar" value="`+data["prenom_ar"]+" "+data["nom_ar"]+`" class="form-control">
</div>`);

$('#nationalite_pere').replaceWith(`<div class="form-group label-floating m-input-fr" id="nationalite_pere">
	 <label class="control-label m-label-form">Nationalité</label>
	 <input type="text" name="nationalite_pere" value="`+data["nationalite"]+`" class="form-control">
</div>`);

$('#nationalite_pere_ar').replaceWith(`<div class="form-group label-floating" id="nationalite_pere_ar">
	 <label class="control-label m-label-form">الجنسية</label>
	 <input type="text" name="nationalite_pere_ar" value="`+data["nationalite_ar"]+`" class="form-control">
</div>`);

$('#ne_a_pere').replaceWith(`<div class="form-group label-floating m-input-fr" id="ne_a_pere">
	 <label class="control-label m-label-form">Né à</label>
	 <input type="text" name="ne_a_pere" value="`+data["lieu_naiss"]+`" class="form-control">
</div>`);

$('#ne_a_pere_ar').replaceWith(`<div class="form-group label-floating" id="ne_a_pere_ar">
	 <label class="control-label m-label-form">المولود ب</label>
	 <input type="text" name="ne_a_pere_ar" value="`+data["lieu_naiss_ar"]+`" class="form-control">
</div>`);

$('#date_naiss_pere_hijri').replaceWith(`<div class="form-group label-floating " id="date_naiss_pere_hijri">
	 <label class="control-label m-label-form">الهجري</label>
	 <input type="text" name="date_naiss_pere_hijri" value="`+data["date_naiss_hijri"]+`" class="form-control ">
</div>`);

$('#date_naiss_pere_miladi').replaceWith(`<div class="form-group label-floating" id="date_naiss_pere_miladi">
	 <label class="control-label m-label-form">تاريخ الازدياد الميلادي</label>
	 <input type="text" name="date_naiss_pere_miladi" value="`+data["date_naiss_miladi"]+`" class="form-control datepicker">
</div>`);

$('#date_naiss_pere_hijri_ar').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_pere_hijri_ar">
	 <label class="control-label m-label-form">بالأحرف العربية</label>
	 <input type="text" name="date_naiss_pere_hijri_ar" value="`+data["date_naiss_hijri_ar"]+`" class="form-control">
</div>`);

$('#date_naiss_pere_miladi_ar').replaceWith(`<div class="form-group label-floating" id="date_naiss_pere_miladi_ar">
	 <label class="control-label m-label-form">بالأحرف العربية</label>
	 <input type="text" name="date_naiss_pere_miladi_ar" value="`+data["date_naiss_miladi_ar"]+`" class="form-control">
</div>`);

$('#date_naiss_pere_hijri_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_pere_hijri_fr">
	 <label class="control-label m-label-form">بالأحرف الفرنسية</label>
	 <input type="text" name="date_naiss_pere_hijri_fr" value="`+data["date_naiss_hijri_fr"]+`" class="form-control">
</div>`);

$('#date_naiss_pere_miladi_fr').replaceWith(`<div class="form-group label-floating m-input-fr" id="date_naiss_pere_miladi_fr">
	 <label class="control-label m-label-form">بالأحرف الفرنسية</label>
	 <input type="text" name="date_naiss_pere_miladi_fr" value="`+data["date_naiss_miladi_fr"]+`" class="form-control">
</div>`);



			$('#getDataModal').modal('hide');
			if(data["prenom_ar"] != "" || data["nom_ar"] != "")
				{
					$.notify({
        	icon: "notifications",
        	message: ' تمت إضافة بيانات الأب '

        			},
					 {
				type: 'success',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}
			else
				{

						$.notify({
        	icon: "notifications",
        	message: 'فشل البحث '

        			},
					 {
				type: 'danger',
				timer: 3000,
				placement: {
					from: 'top',
					align: 'left'
				}
			});

				}

		}

	});

	return false;
});


   </script>
</html>
