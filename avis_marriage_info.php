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
   date_default_timezone_set('UTC');
   $ActualDate = date('d/m/Y');
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
      <style>
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
                    <li class="active">
                       <a data-toggle="collapse" href="#dbBayane" class="collapsed" aria-expanded="false">
                          <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/contract.svg">
                          <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;"> بيان الزواج و الطلاق
                             <b class="caret"></b>
                          </p>
                       </a>
                       <div class="collapse" id="dbBayane" aria-expanded="false" style="height: 0px;">
                          <ul class="nav">
                             <li class="active">
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
               <!--modal  irsal-->
               <div class="modal fade irsal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg  m-modal-margin" role="document">
                     <div class="modal-content" style="margin-top:10%">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h3 style="text-align: center" class="droid-arabic-kufi">  البحث في قاعدة البيانات </h3>
                        </div>
                        <div class="modal-body">
                           <ul class="nav nav-pills nav-pills-warning droid-arabic-kufi" style="margin-left : 24%">
                              <li >
                                 <a href="#takarir" data-toggle="tab" style="font-size : 18px !important">التقرير حول المكتب</a>
                              </li>
                              <li>
                                 <a href="#jodada" data-toggle="tab" style="font-size : 18px !important"> جدادة الفرز</a>
                              </li>
                              <li class="active">
                                 <a href="#irsal_chahri" data-toggle="tab" style="font-size : 18px !important">الإرسال الشهري</a>
                              </li>
                           </ul>
                           <div class="tab-content">
                              <div class="tab-pane " id="takarir">
                                 <!--takarir///////////*********************-->
                                 <?php
                                    $query = "SELECT * FROM `rapport_bureau`";
                                    $pdoResult = $pdoConnect->prepare($query);
                                    $pdoResult->execute();
                                    
                                    $result=$pdoResult->fetch();
                                    
                                    ?>
                                 <form action="rapport_bureau.php" method="post">
                                    <h3 class="droid-arabic-kufi" style="text-align : center;color:#3F51B5">تقرير حول وضعية المكتب خلال الثلاث الأشهر 
                                       <?php 
                                          if((int)$monthActu <= 3)
                                          {
                                            echo "الأولى";
                                          }
                                          
                                          if((int)$monthActu >= 4 && (int)$monthActu <= 6)
                                          {
                                            echo "الثانية";
                                          }
                                          
                                          if((int)$monthActu >= 7 && (int)$monthActu <= 9)
                                          {
                                            echo "الثالثة";
                                          }
                                          
                                          if((int)$monthActu >= 10 && (int)$monthActu <= 12)
                                          {
                                            echo "الرابعة";
                                          }
                                          ?>
                                       لسنة <?php echo $anneActu ?>
                                    </h3>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> نسبة التسجيل بالحالة المدنية</label>
                                          <input type="text" name="nisbat_tsjil" value="<?php echo $result["nisbat_tsjil"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> عدد السكان</label>
                                          <input type="text" name="adad_sokan" value="<?php echo $result["adad_sokan"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> تاريخ إحداث المكتب</label>
                                          <input type="text" name="tarikh_ihdat_maktab" value="<?php echo $result["tarikh_ihdat_maktab"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> ضابط الحالة المدنية الأصلي</label>
                                          <input type="text" name="dabit_asli" value="<?php echo $result["dabit_asli"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <h4 class="droid-arabic-kufi" style="color : rgb(38, 50, 56)">ضباط الحالة المدنية بالتفويض
                                       <button type="button"  class="btn btn-success btn-round btn-fab btn-fab-mini m-button-mini" rel="tooltip" title=" إضافة ضابط" id="addDabit">
                                       <i class="material-icons">add</i>
                                       </button>
                                    </h4>
                                    <?php
                                       $query = "SELECT * FROM `dobat_hala_madania`";
                                       $pdoResult = $pdoConnect->prepare($query);
                                       $pdoResult->execute();
                                       
                                       $result=$pdoResult->fetchAll();
                                       if($pdoResult->rowCount()>0)
                                       {
                                         foreach($result as $row)
                                         {                                             
                                       ?>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">   الصفة</label>
                                          <input type="text" name="sifa" value="<?php echo $row["sifa"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  الإسم</label>
                                          <input type="text" name="nom_dabit" value="<?php echo $row["nom"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <?php  
                                       } 
                                       } else{ // if there is no dabit
                                         ?>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">   الصفة</label>
                                          <input type="text" name="sifa" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  الإسم</label>
                                          <input type="text" name="nom_dabit" value="" class="form-control">
                                       </div>
                                    </div>
                                    <?php
                                       }
                                       ?>
                                    <div class="row" style="margin-right : 0.35%">
                                       <!--add dabit-->
                                       <div class="addedDabit">
                                       </div>
                                    </div>
                                    <!--end add dabit-->
                                    <h4 class="droid-arabic-kufi" style="color : rgb(38, 50, 56)">   نشاط المكتب</h4>
                                    <?php  ///// ********* number of new birth
                                       //$monthComplet = "0".$month;
                                       //$result_month = $months_letter[$month];
                                       
                                       if((int)$monthActu <= 3)
                                       {
                                         $queryBirth = "SELECT count(numero) FROM sbirth WHERE SUBSTRING(`time_stamp`, 6, 2) = 01 OR SUBSTRING(`time_stamp`, 6, 2) = 02  OR SUBSTRING(`time_stamp`, 6, 2) = 03 AND SUBSTRING(`time_stamp`, 1, 4) =? ";
                                       }
                                       
                                       if((int)$monthActu >= 4 && (int)$monthActu <= 6)
                                       {
                                         $queryBirth = "SELECT count(numero) FROM sbirth WHERE SUBSTRING(`time_stamp`, 6, 2) = 04 OR SUBSTRING(`time_stamp`, 6, 2) = 05  OR SUBSTRING(`time_stamp`, 6, 2) = 06 AND SUBSTRING(`time_stamp`, 1, 4) =? ";
                                       }
                                       
                                       if((int)$monthActu >= 7 && (int)$monthActu <= 9)
                                       {
                                         $queryBirth = "SELECT count(numero) FROM sbirth WHERE SUBSTRING(`time_stamp`, 6, 2) = 07 OR SUBSTRING(`time_stamp`, 6, 2) = 08  OR SUBSTRING(`time_stamp`, 6, 2) = 09 AND SUBSTRING(`time_stamp`, 1, 4) =? ";
                                       }
                                       
                                       if((int)$monthActu >= 10 && (int)$monthActu <= 12)
                                       {
                                         $queryBirth = "SELECT count(numero) FROM sbirth WHERE SUBSTRING(`time_stamp`, 6, 2) = 10 OR SUBSTRING(`time_stamp`, 6, 2) = 11  OR SUBSTRING(`time_stamp`, 6, 2) = 12 AND SUBSTRING(`time_stamp`, 1, 4) =? ";
                                       }
                                       
                                       $pdoResultBirth = $pdoConnect->prepare($queryBirth);
                                            $pdoResultBirth->execute(array($anneActu));
                                            
                                            $resultBirth=$pdoResultBirth->fetch();
                                            
                                       ?>
                                    <?php  ///// ********* number of new death
                                       //$monthComplet = "0".$month;
                                       //$result_month = $months_letter[$month];
                                       
                                       if((int)$monthActu <= 3)
                                       {
                                         $queryDeath = "SELECT count(numero) FROM sdeadtable WHERE SUBSTRING(`time_stamp`, 6, 2) = 01 OR SUBSTRING(`time_stamp`, 6, 2) = 02  OR SUBSTRING(`time_stamp`, 6, 2) = 03 AND SUBSTRING(`time_stamp`, 1, 4) =? ";
                                       }
                                       
                                       if((int)$monthActu >= 4 && (int)$monthActu <= 6)
                                       {
                                         $queryDeath = "SELECT count(numero) FROM sdeadtable WHERE SUBSTRING(`time_stamp`, 6, 2) = 04 OR SUBSTRING(`time_stamp`, 6, 2) = 05  OR SUBSTRING(`time_stamp`, 6, 2) = 06 AND SUBSTRING(`time_stamp`, 1, 4) =? ";
                                       }
                                       
                                       if((int)$monthActu >= 7 && (int)$monthActu <= 9)
                                       {
                                         $queryDeath = "SELECT count(numero) FROM sdeadtable WHERE SUBSTRING(`time_stamp`, 6, 2) = 07 OR SUBSTRING(`time_stamp`, 6, 2) = 08  OR SUBSTRING(`time_stamp`, 6, 2) = 09 AND SUBSTRING(`time_stamp`, 1, 4) =? ";
                                       }
                                       
                                       if((int)$monthActu >= 10 && (int)$monthActu <= 12)
                                       {
                                         $queryDeath = "SELECT count(numero) FROM sdeadtable WHERE SUBSTRING(`time_stamp`, 6, 2) = 10 OR SUBSTRING(`time_stamp`, 6, 2) = 11  OR SUBSTRING(`time_stamp`, 6, 2) = 12 AND SUBSTRING(`time_stamp`, 1, 4) =? ";
                                       }
                                       
                                       $pdoResultDeath = $pdoConnect->prepare($queryDeath);
                                            $pdoResultDeath->execute(array($anneActu));
                                            
                                            $resultDeath=$pdoResultDeath->fetch();
                                            
                                       ?>
                                    <?php  // calcule extrait
                                       if((int)$monthActu <= 3)
                                       {
                                       $queryExtBirth = "SELECT count(numero) FROM `timep_stamp_table` WHERE type='exbirth' AND SUBSTR(timestamp, 1, 4) =?";
                                       }
                                       
                                       if((int)$monthActu >= 4 && (int)$monthActu <= 6)
                                       {
                                        $queryExtBirth = "SELECT count(numero) FROM `timep_stamp_table` WHERE type='exbirth' AND SUBSTR(timestamp, 1, 4) =?";
                                       }
                                       
                                       if((int)$monthActu >= 7 && (int)$monthActu <= 9)
                                       {
                                        $queryExtBirth = "SELECT count(numero) FROM `timep_stamp_table` WHERE type='exbirth' AND SUBSTR(timestamp, 1, 4) =?";
                                       }
                                       
                                       if((int)$monthActu >= 10 && (int)$monthActu <= 12)
                                       {
                                        $queryExtBirth = "SELECT count(numero) FROM `timep_stamp_table` WHERE type='exbirth' AND SUBSTR(timestamp, 1, 4) =?";
                                       }
                                       
                                       $pdoResultExtBirth  = $pdoConnect->prepare($queryExtBirth);
                                        $pdoResultExtBirth ->execute(array($anneActu));                                            
                                        $resultExtBirth =$pdoResultExtBirth ->fetch();
                                       
                                        if((int)$monthActu <= 3)
                                       {
                                        $queryActeDeces = "SELECT count(numero) FROM `timep_stamp_table` WHERE type='acteDeces' AND SUBSTR(timestamp, 1, 4) =?";
                                       }
                                       
                                       if((int)$monthActu >= 4 && (int)$monthActu <= 6)
                                       {
                                        $queryActeDeces = "SELECT count(numero) FROM `timep_stamp_table` WHERE type='acteDeces' AND SUBSTR(timestamp, 1, 4) =?";
                                       }
                                       
                                       if((int)$monthActu >= 7 && (int)$monthActu <= 9)
                                       {
                                        $queryActeDeces = "SELECT count(numero) FROM `timep_stamp_table` WHERE type='acteDeces' AND SUBSTR(timestamp, 1, 4) =?";
                                       }
                                       
                                       if((int)$monthActu >= 10 && (int)$monthActu <= 12)
                                       {
                                        $queryActeDeces = "SELECT count(numero) FROM `timep_stamp_table` WHERE type='acteDeces' AND SUBSTR(timestamp, 1, 4) =?";
                                       }
                                       
                                        $pdoResultActeDeces  = $pdoConnect->prepare($queryActeDeces);
                                         $pdoResultActeDeces ->execute(array($anneActu));                                            
                                         $resultActeDeces =$pdoResultActeDeces ->fetch();
                                       
                                       ?>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">   أحكام تصريحية بالولادة</label>
                                          <input type="text" name="ahkam_tsrih_naiss" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">   ولادات حديثة</label>
                                          <input type="text" name="wiladat_hadita" value="<?php echo $resultBirth["count(numero)"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  عدد رسوم الولادات</label>
                                          <input type="text" name="extrait_naiss" value="<?php echo $resultExtBirth["count(numero)"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">   أحكام تصريحية بالوفاة</label>
                                          <input type="text" name="ahkam_tsrihia_deces" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">   وفيات حديثة</label>
                                          <input type="text" name="deces_hadita" value="<?php echo $resultDeath["count(numero)"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  عدد رسوم الوفاة</label>
                                          <input type="text" name="acte_deces" value="<?php echo $resultActeDeces["count(numero)"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">    عدد الأحكام التنقيحية</label>
                                          <input type="text" name="ahkam_tnkihia" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  عدد  الدفاتر العائلية المسلمة</label>
                                          <input type="text" name="dafatir_familiale" value="" class="form-control">
                                       </div>
                                    </div>
                                    <h4 class="droid-arabic-kufi" style="color : rgb(38, 50, 56)">    الإمكانيات البشرية
                                       <button type="button"  class="btn btn-success btn-round btn-fab btn-fab-mini m-button-mini" rel="tooltip" title=" إضافة كاتب" id="addKatib">
                                       <i class="material-icons">add</i>
                                       </button>
                                    </h4>
                                    <?php
                                       $query = "SELECT COUNT(id_imkaniat_bacharia),nom,echelle,date_debut_travail,niveau_scol,takwin,adad_nadawat  FROM `imkaniat_bacharia` WHERE 1";
                                       $pdoResult = $pdoConnect->prepare($query);
                                       $pdoResult->execute();
                                       
                                       $result=$pdoResult->fetchAll();
                                       if($pdoResult->rowCount()>0)
                                       {
                                         foreach($result as $row)
                                         {                                             
                                       ?>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">     مجموع عدد كتاب الحالة المدنية </label>
                                          <input type="text" name="somme_kotab_etat" value="<?php echo $row["COUNT(id_imkaniat_bacharia)"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">تاريخ بدأ العمل</label>
                                          <input type="text" name="date_debut_travail" value="<?php echo $row["date_debut_travail"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">الرتبة</label>
                                          <input type="text" name="echelle" value="<?php echo $row["echelle"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> الإسم الكامل</label>
                                          <input type="text" name="nom_katib" value="<?php echo $row["nom"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  عدد الندوات المستفيد منها</label>
                                          <input type="text" name="adad_nadawat" value="<?php echo $row["adad_nadawat"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">هل خضع للتكوين</label>
                                          <input type="text" name="takwin" value="<?php echo $row["takwin"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  المستوى الدراسي</label>
                                          <input type="text" name="niveau_scol" value="<?php echo $row["niveau_scol"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <?php
                                       }
                                       }else
                                       {
                                         ?>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">     مجموع عدد كتاب الحالة المدنية </label>
                                          <input type="text" name="somme_kotab_etat" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">تاريخ بدأ العمل</label>
                                          <input type="text" name="date_debut_travail" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">الرتبة</label>
                                          <input type="text" name="echelle" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> الإسم الكامل</label>
                                          <input type="text" name="nom_katib" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  عدد الندوات المستفيد منها</label>
                                          <input type="text" name="adad_nadawat" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">هل خضع للتكوين</label>
                                          <input type="text" name="takwin" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  المستوى الدراسي</label>
                                          <input type="text" name="niveau_scol" value="" class="form-control">
                                       </div>
                                    </div>
                                    <?php
                                       } ?>
                                    <div class="row" style="margin-right : 0.35%">
                                       <!--add katib-->
                                       <div class="addedKatib">
                                       </div>
                                    </div>
                                    <!--end add katib-->
                                    <?php
                                       $query = "SELECT * FROM `rapport_bureau`";
                                       $pdoResult = $pdoConnect->prepare($query);
                                       $pdoResult->execute();
                                       
                                       $result=$pdoResult->fetch();
                                       
                                       ?>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> ملاحظات حول الإمكانيات البشرية للمكتب</label>
                                          <input type="text" name="molahadat_imkanyat_maktab" value="<?php echo $result["molahadat_imkanyat_maktab"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <h4 class="droid-arabic-kufi" style="color : rgb(38, 50, 56)">    الإمكانيات المادية</h4>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> وضعيتها</label>
                                          <input type="text" name="etat_hojorat" value="<?php echo $result["molahadat_imkanyat_maktab"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">     هل أضيفت للمكتب حجرات جديدة</label>
                                          <input type="text" name="odifat_hojorat_jadida" value="<?php echo $result["molahadat_imkanyat_maktab"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> عدد الحجرات</label>
                                          <input type="text" name="adad_hojorat" value="<?php echo $result["molahadat_imkanyat_maktab"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> عدد الخزانات</label>
                                          <input type="text" name="adad_khizanat" value="<?php echo $result["adad_khizanat"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> عدد الكراسي</label>
                                          <input type="text" name="adad_karassi" value="<?php echo $result["adad_karassi"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> عدد الطاولات</label>
                                          <input type="text" name="adad_tawilat" value="<?php echo $result["adad_tawilat"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  المطبوعات</label>
                                          <input type="text" name="matbo3at" value="<?php echo $result["matbo3at"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> عدد الات الكتابة</label>
                                          <input type="text" name="adad_alat_kitaba" value="<?php echo $result["adad_alat_kitaba"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> عدد الرفوف</label>
                                          <input type="text" name="adad_rofof" value="<?php echo $result["adad_rofof"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">   التجهيزات المكتبية</label>
                                          <input type="text" name="thizat_maktabia" value="<?php echo $result["thizat_maktabia"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  المراجع</label>
                                          <input type="text" name="maraji3" value="<?php echo $result["maraji3"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  عدد التفتيشيات خلال الثلاث أشهر</label>
                                          <input type="text" name="adad_tftichiat" value="<?php echo $result["adad_tftichiat"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  ملاحظات حول الإمكانيات المادية للمكتب</label>
                                          <input type="text" name="molahadat_imkanat_madia" value="<?php echo $result["molahadat_imkanat_madia"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <h4 class="droid-arabic-kufi" style="color : rgb(38, 50, 56)">     سير أعمال المكتب</h4>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">المخالفات القانونية </label>
                                          <input type="text" name="mokhalafat_kanonia" value="<?php echo $result["mokhalafat_kanonia"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  المخالفات المسطرية </label>
                                          <input type="text" name="mokhalaft_mistaria" value="<?php echo $result["mokhalaft_mistaria"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> خلاصة حول وضعية المكتب </label>
                                          <input type="text" name="kholassa_wadiat_maktab" value="<?php echo $result["kholassa_wadiat_maktab"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">   الإجراءات المتخدة لإصلاح وضعية المكتب </label>
                                          <input type="text" name="ijraat_isla7_lmktab" value="<?php echo $result["ijraat_isla7_lmktab"] ?>" class="form-control">
                                       </div>
                                    </div>
                                    <div style="text-align : center">
                                       <button type="submit" class="btn btn-info m-margin-left">
                                       <span class="btn-label">
                                       <img  style="width:18px;height:18px" src="svg/rounded-add-button.svg">
                                       </span>
                                       <b class="droid-arabic-kufi m-button-text">حفظ و طباعة</b>
                                       </button>
                                    </div>
                                 </form>
                              </div>
                              <!--end takarir//////////////**********************************************-->
                              <div class="tab-pane" id="jodada">
                                 <!--jodada//////////////////////////////////**************-->
                                 <form action="jodadaP.php" method="post" >
                                    <div class="row" style="margin-left : 20%;">
                                       
                                       <div class="col-md-4" >
                                          <select name="year_jodada" class="selectpicker m-label-form form droid-arabic-kufi" data-style="btn btn-info btn-round" title="السنة" data-size="7" required>
                                             <option value="<?php echo $anneActu ?>" class="m-label-form droid-arabic-kufi" style="text-align:center" selected><?php echo $anneActu ?></option>
                                             <option value="<?php echo $anneActu-1 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-1 ?></option>
                                             <option value="<?php echo $anneActu-2 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-2 ?></option>
                                             <option value="<?php echo $anneActu-3 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-3 ?></option>
                                             <option value="<?php echo $anneActu-4 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-4 ?></option>
                                          </select>
                                       </div>
                                       <div class="col-md-4" >
                                          <select name="month_jodada" class="selectpicker m-label-form form droid-arabic-kufi" data-style="btn btn-info btn-round" title="الشهر" data-size="7" required>
                                             <option value="1" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='01')?'selected':'' ?> >يناير</option>
                                             <option value="2" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='02')?'selected':'' ?> >فبراير</option>
                                             <option value="3" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='03')?'selected':'' ?>>مارس</option>
                                             <option value="4" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='04')?'selected':'' ?>>أبريل</option>
                                             <option value="5" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='05')?'selected':'' ?>>ماي</option>
                                             <option value="6" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='06')?'selected':'' ?>>يونيو</option>
                                             <option value="7" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='07')?'selected':'' ?>>يوليوز</option>
                                             <option value="8" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='08')?'selected':'' ?>>غشت</option>
                                             <option value="9" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='09')?'selected':'' ?>>شتنبر</option>
                                             <option value="10" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='10')?'selected':'' ?>>أكتوبر</option>
                                             <option value="11" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='11')?'selected':'' ?>>نونبر</option>
                                             <option value="12" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='12')?'selected':'' ?>>دجنبر</option>
                                          </select>
                                       </div>
                                    </div>
                                       
                                      <!--info to fill-->
                                      <div class="row"> <!--start a row-->
                                      <h3 class="droid-arabic-kufi" > الولادات و الوفيات : </h3>


                                      <div class="row"> 
                                      <div class="col-md-6 ">
                                      <h4 class="droid-arabic-kufi" style="color : rgb(38, 50, 56)">أحكام الولادات للسنة الجارية</h4>
                                      </div>

                                      <div class="col-md-6 " >
                                      <h4 class="droid-arabic-kufi" style="color : rgb(38, 50, 56)"> ولادات داخل الأجل القانوني</h4>
                                      </div>

                                      </div>

                                      <div class="col-md-3">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> أنثى </label>
                                          <input type="text" name="kholassa_wadiat_maktab" value="" class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-md-3">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">   ذكر </label>
                                          <input type="text" name="ijraat_isla7_lmktab" value="" class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-md-3">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> أنثى </label>
                                          <input type="text" name="kholassa_wadiat_maktab" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  ذكر</label>
                                          <input type="text" name="ijraat_isla7_lmktab" value="" class="form-control">
                                       </div>
                                    </div>


                                    <div class="row"> 
                                      <div class="col-md-6 ">
                                      <h4 class="droid-arabic-kufi" style="color : rgb(38, 50, 56)">مجموع الولادات</h4>
                                      </div>

                                      <div class="col-md-6 " >
                                      <h4 class="droid-arabic-kufi" style="color : rgb(38, 50, 56)"> أحكام الولادات للسنوات الفارطة</h4>
                                      </div>

                                      </div>


                                    <div class="col-md-3">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> أنثى </label>
                                          <input type="text" name="kholassa_wadiat_maktab" value="" class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-md-3">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">   ذكر </label>
                                          <input type="text" name="ijraat_isla7_lmktab" value="" class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-md-3">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> أنثى </label>
                                          <input type="text" name="kholassa_wadiat_maktab" value="" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">  ذكر</label>
                                          <input type="text" name="ijraat_isla7_lmktab" value="" class="form-control">
                                       </div>
                                    </div>

                                      </div><!--end row-->
                                      
                                      <div style="text-align : center">
                                       <button type="submit" name="type_irsal" value="general" class="btn btn-info m-margin-left">
                                       <i class="material-icons">print</i>
                                       <b class="droid-arabic-kufi m-button-text"> طباعة</b>
                                       </button>
                                    </div>

                                 </form>
                              </div>
                              <!--end jodada********************************************//////////////////////////////-->
                              <div class="tab-pane active" id="irsal_chahri">
                                 <!--irsal chahri*************************************-->
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
                                             <option value="<?php echo $anneActu ?>" class="m-label-form droid-arabic-kufi" style="text-align:center" selected><?php echo $anneActu ?></option>
                                             <option value="<?php echo $anneActu-1 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-1 ?></option>
                                             <option value="<?php echo $anneActu-2 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-2 ?></option>
                                             <option value="<?php echo $anneActu-3 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-3 ?></option>
                                             <option value="<?php echo $anneActu-4 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-4 ?></option>
                                          </select>
                                       </div>
                                       <div class="col-md-4" style="margin-right:1%">
                                          <select name="month_general" class="selectpicker m-label-form form droid-arabic-kufi" data-style="btn btn-info btn-round" title="الشهر" data-size="7" required>
                                             <option value="1" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='01')?'selected':'' ?> >يناير</option>
                                             <option value="2" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='02')?'selected':'' ?> >فبراير</option>
                                             <option value="3" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='03')?'selected':'' ?>>مارس</option>
                                             <option value="4" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='04')?'selected':'' ?>>أبريل</option>
                                             <option value="5" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='05')?'selected':'' ?>>ماي</option>
                                             <option value="6" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='06')?'selected':'' ?>>يونيو</option>
                                             <option value="7" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='07')?'selected':'' ?>>يوليوز</option>
                                             <option value="8" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='08')?'selected':'' ?>>غشت</option>
                                             <option value="9" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='09')?'selected':'' ?>>شتنبر</option>
                                             <option value="10" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='10')?'selected':'' ?>>أكتوبر</option>
                                             <option value="11" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='11')?'selected':'' ?>>نونبر</option>
                                             <option value="12" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='12')?'selected':'' ?>>دجنبر</option>
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
                                             <option value="<?php echo $anneActu ?>" class="m-label-form droid-arabic-kufi" style="text-align:center" selected><?php echo $anneActu ?></option>
                                             <option value="<?php echo $anneActu-1 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-1 ?></option>
                                             <option value="<?php echo $anneActu-2 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-2 ?></option>
                                             <option value="<?php echo $anneActu-3 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-3 ?></option>
                                             <option value="<?php echo $anneActu-4 ?>" class="m-label-form droid-arabic-kufi" style="text-align:center"><?php echo $anneActu-4 ?></option>
                                          </select>
                                       </div>
                                       <div class="col-md-4" style="margin-right:1%">
                                          <select name="month_detail" class="selectpicker m-label-form form droid-arabic-kufi" data-style="btn btn-info btn-round" title="الشهر" data-size="7" required>
                                             <option value="1" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='01')?'selected':'' ?>>يناير</option>
                                             <option value="2" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='02')?'selected':'' ?>>فبراير</option>
                                             <option value="3" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='03')?'selected':'' ?>>مارس</option>
                                             <option value="4" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='04')?'selected':'' ?>>أبريل</option>
                                             <option value="5" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='05')?'selected':'' ?>>ماي</option>
                                             <option value="6" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='06')?'selected':'' ?>>يونيو</option>
                                             <option value="7" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='07')?'selected':'' ?>>يوليوز</option>
                                             <option value="8" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='08')?'selected':'' ?>>غشت</option>
                                             <option value="9" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='09')?'selected':'' ?>>شتنبر</option>
                                             <option value="10" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='10')?'selected':'' ?>>أكتوبر</option>
                                             <option value="11" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='11')?'selected':'' ?>>نونبر</option>
                                             <option value="12" class="m-label-form droid-arabic-kufi" style="text-align:center" <?php echo ($monthActu=='12')?'selected':'' ?>>دجنبر</option>
                                          </select>
                                       </div>
                                    </div>

                                       
                                 </form>
                                 <!-- end searhc by num-->     
                              </div>
                              <!--end irsal chahri************************************-->
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
               
              <div class="card">
                  <div class="card-content">
                     <div class="row">
                        <h3 class="droid-arabic-kufi"> معلومات بيان الزواج </h3>
                        <div class="col-md-9">
                           <form action="avis_marriage_P.php" method="post" class="vieCollectForm">
                              <div class="tab-content">
                                <!--end resume avis-->
                                 <div class="tab-pane active" id="resume_avis">
                                    <div class="row col-md-11 m-form-saisie">

                                       <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi">المحكمة الإبتدائية </label>
                                            <input type="text" name="ibtidaayia"  class="form-control">
                                         </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> محكمة الإستئناف </label>
                                             <input type="text" name="istinaf"  class="form-control">
                                          </div>
                                       </div>



                                    </div>
                                 </div><!--end resume avis-->

                                 <!--reference avis-->
                                 <div class="tab-pane" id="reference_avis">
                                   <div class="col-md-6">
                                     <div class="form-group label-floating">
                                        <label class="control-label m-label-form droid-arabic-kufi"> الصحيفة </label>
                                        <input type="text" name="sahifa"  class="form-control">
                                     </div>
                                   </div>
                                   <div class="col-md-6">
                                      <div class="form-group label-floating">
                                         <label class="control-label m-label-form droid-arabic-kufi"> العدد</label>
                                         <input type="text" name="adad"  class="form-control">
                                      </div>
                                   </div>

                                   <div class="col-md-6">
                                     <div class="form-group label-floating">
                                        <label class="control-label m-label-form droid-arabic-kufi"> رقم السجل </label>
                                        <input type="text" name="numero_sijil"  class="form-control">
                                     </div>
                                   </div>
                                   <div class="col-md-6">
                                      <div class="form-group label-floating">
                                         <label class="control-label m-label-form droid-arabic-kufi"> التاريخ</label>
                                         <input type="text" name="date_reference"  class="form-control">
                                      </div>
                                   </div>

                                   <div class="col-md-4 " style="margin-left: 40% ">
                                      <select name="categorie_avis" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title=" نوع الرسم " data-size="7" >
                                         <option value="marriage" class="m-label-form droid-arabic-kufi">زواج</option>
                                         <option value="tobout" class="m-label-form droid-arabic-kufi"> ثبوت زوجية </option>
                                         <option value="morajaa" class="m-label-form droid-arabic-kufi">مراجعة </option>
                                         <option value="rijaa" class="m-label-form droid-arabic-kufi">رجعة</option>
                                      </select>
                                   </div>


                                   <div class="col-md-6">

                                   </div>
                                   <div class="col-md-6">
                                      <div class="form-group label-floating">
                                         <label class="control-label m-label-form droid-arabic-kufi"> تاريخه</label>
                                         <input type="text" name="date_avis" id="date_avis" class="form-control">
                                      </div>
                                   </div>

                                  </div><!--end reference avis-->

                                  <!--info husband-->
                                  <div class="tab-pane" id="info_husband">
                                    <div class="col-md-6">
                                       <div class="form-group label-floating ">
                                          <label class="control-label m-label-form droid-arabic-kufi"> السنة </label>
                                          <input type="text" name="annee_husband" id="annee_husband" class="form-control" required>
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">رقم الرسم </label>
                                          <input type="text" name="numero_husband" id="numero_husband" class="form-control" required>
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating m-input-fr" id="prenom_nom">
                                          <label class="control-label m-label-form droid-arabic-kufi"> Prénom et Nom</label>
                                          <input type="text" name="prenom_nom"  class="form-control" required>
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating" id="prenom_nom_ar">
                                          <label class="control-label m-label-form droid-arabic-kufi"> الإسم الشخصي و العائلي </label>
                                          <input type="text" name="prenom_nom_ar" id="nom_husb" class="form-control" required>
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group label-floating" id="date_naiss_num">
                                         <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادته (بالأرقام) </label>
                                         <input type="text" name="date_naiss_num"  class="form-control">
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating" id="date_naiss">
                                          <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادته </label>
                                          <input type="text" name="date_naiss"  class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating ">
                                          <label class="control-label m-label-form droid-arabic-kufi">جنسيته </label>
                                          <input type="text" name="nationalite" value="<?php echo $nationalite_ar  ?>" class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi">مهنته </label>
                                          <input type="text" name="profession"  class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-md-4 " style="margin-left: 40% ">
                                       <select name="etat_familiale" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="الحالة العائلية" data-size="7" >
                                          <option value="celeb" class="m-label-form droid-arabic-kufi">عازب(ة) </option>
                                          <option value="marie" class="m-label-form droid-arabic-kufi" >متزوج(ة) </option>
                                          <option value="divorce" class="m-label-form droid-arabic-kufi">مطلق(ة) </option>
                                          <option value="veuf" class="m-label-form droid-arabic-kufi">أرمل(ة) </option>
                                       </select>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group label-floating">
                                         <label class="control-label m-label-form droid-arabic-kufi">مكان إقامته</label>
                                         <input type="text" name="adress"  class="form-control">
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group label-floating " id="lieu_naiss">
                                         <label class="control-label m-label-form droid-arabic-kufi"> مكان ولادته </label>
                                         <input type="text" name="lieu_naiss"  class="form-control">
                                      </div>
                                    </div>


                                  </div><!-- end info husband-->

                                  <!--info wife-->
                                  <div class="tab-pane" id="info_wife">
                                    <div class="col-md-6">
                                       <div class="form-group label-floating " >
                                          <label class="control-label m-label-form droid-arabic-kufi"> السنة </label>
                                          <input type="text" name="annee_wife" id="annee_wife" class="form-control" required>
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating" >
                                          <label class="control-label m-label-form droid-arabic-kufi">رقم الرسم </label>
                                          <input type="text" name="numero_wife" id="numero_wife" class="form-control" required>
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating m-input-fr" id="prenom_nom_wife">
                                          <label class="control-label m-label-form droid-arabic-kufi"> Prénom et Nom</label>
                                          <input type="text" name="prenom_nom_wife"  class="form-control" required>
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating" id="prenom_nom_ar_wife">
                                          <label class="control-label m-label-form droid-arabic-kufi"> الإسم الشخصي و العائلي </label>
                                          <input type="text" name="prenom_nom_ar_wife" id="nom_wife" class="form-control" required>
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group label-floating" id="date_naiss_num_wife">
                                         <label class="control-label m-label-form droid-arabic-kufi"> بالأرقام</label>
                                         <input type="text" name="date_naiss_num_wife"  class="form-control">
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating" id="date_naiss_wife">
                                          <label class="control-label m-label-form droid-arabic-kufi">تاريخ ولادتها </label>
                                          <input type="text" name="date_naiss_wife"  class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating ">
                                          <label class="control-label m-label-form droid-arabic-kufi"> جنسيتها </label>
                                          <input type="text" name="nationalite_wife" value="<?php echo $nationalite_ar ?>"  class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="form-group label-floating">
                                          <label class="control-label m-label-form droid-arabic-kufi"> مهنتها </label>
                                          <input type="text" name="profession_wife"  class="form-control">
                                       </div>
                                    </div>

                                    <div class="col-md-4 " style="margin-left: 40% ">
                                       <select id="etat_familiale_select" name="etat_familiale_wife" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="الحالة العائلية" data-size="7" >
                                          <option value="celeb_wife" class="m-label-form droid-arabic-kufi">بكر (لم يسبق لها الزواج) </option>
                                          <option value="divorce_wife" class="m-label-form droid-arabic-kufi">مطلقة </option>
                                          <option value="veuf_wife" class="m-label-form droid-arabic-kufi">أرملة</option>
                                       </select>
                                    </div>

                                    <div id="divorce_wife"  class="etat_familiale_wife" style="display:none">
                                      <div class="col-md-6">
                                      </div>

                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi">تاريخ طلاقها</label>
                                            <input type="text" name="date_divorce"  class="form-control">
                                         </div>
                                      </div>
                                    </div>


                                    <div id="veuf_wife" class="etat_familiale_wife" style="display:none">
                                      <div class="col-md-6">
                                      </div>

                                      <div class="col-md-6">
                                         <div class="form-group label-floating">
                                            <label class="control-label m-label-form droid-arabic-kufi">تاريخ وفاة زوجها</label>
                                            <input type="text" name="date_deces_marie"  class="form-control">
                                         </div>
                                      </div>
                                    </div>


                                    <div class="col-md-6">
                                      <div class="form-group label-floating">
                                         <label class="control-label m-label-form droid-arabic-kufi"> مكان إقامتها </label>
                                         <input type="text" name="adress_wife"  class="form-control">
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group label-floating " id="lieu_naiss_wife">
                                         <label class="control-label m-label-form droid-arabic-kufi">مكان ولادتها </label>
                                         <input type="text" name="lieu_naiss_wife"  class="form-control">
                                      </div>

                                    </div>

                                  </div><!-- end info wife-->

                                  <!--add to tora-->

                                  <div class="tab-pane" id="add_tora">
                                      <div class="col-md-6">
                                          <textarea class="form-control m-input-fr" row="10"  name="tora_fr" id="tora_fr" style="white-space: normal;" placeholder="Le contenu....."></textarea>                                                
                                            
                                      </div>
                                      <div >
                                      <div class="col-md-6" >                                          
                                              <textarea class="form-control " row="10"  name="tora_ar" id="tora_ar" style="white-space: normal;" placeholder="محتوى الطرة"></textarea> 
                                        </div>
                                      </div>    
                                        
                                  </div>

                                  <!--end add to tora-->


                           <!---buttons for sending form-->
                           <br>
                           <hr class="col-md-6" style="margin-left: 22%">
                           <div class="row col-md-12">
                           <div  style="text-align: center;margin-left: 15%;">
                           <button type="submit" name="print_avis" class="btn btn-info m-margin-left" >
                           <span class="btn-label">
                           <i class="material-icons">print</i>
                           </span>
                           <b class="droid-arabic-kufi">طباعة و تسجيل البيان</b>
                           </button>

                            <button type="submit" name="print_ikhbar" class="btn btn-info m-margin-left" id="sendIkhbarZawaj">
                           <span class="btn-label">
                           <i class="material-icons">print</i>
                           </span>
                           <b class="droid-arabic-kufi">طباعة الإخبار</b>
                           </button>

                           <a href="index.php">
                           <button type="button" class="btn btn-info">
                           <span class="btn-label">
                           <i class="material-icons">arrow_back</i>
                           </span>
                           <b class="droid-arabic-kufi">عودة</b>
                           </button>
                           </a>
                           </div>
                           </div>
                           </form>
                           <!---end buttons for sending form-->
                           </div>
                           <!--end form sending print-->
                        </div>
                        <div class="col-md-3">
                           <ul class="nav nav-pills nav-pills-rose nav-stacked">
                              <li class="active">
                                 <a href="#resume_avis" data-toggle="tab" rel="tooltip">
                                 <i class="material-icons myPills">keyboard_arrow_left</i>
                                 <b class="droid-arabic-kufi"> ملخص رسم الزواج </b>
                                 </a>
                              </li>
                              <li>
                                 <a href="#reference_avis" data-toggle="tab" >
                                 <i class="material-icons myPills">keyboard_arrow_left</i>
                                 <b class="droid-arabic-kufi"> مراجع بيان الزواج </b>
                                 </a>
                              </li>

                              <li>
                                 <a href="#info_husband" data-toggle="tab" >
                                 <i class="material-icons myPills">keyboard_arrow_left</i>
                                 <b class="droid-arabic-kufi"> بيانات الزوج </b>
                                 </a>
                              </li>

                              <li>
                                 <a href="#info_wife" data-toggle="tab" >
                                 <i class="material-icons myPills">keyboard_arrow_left</i>
                                 <b class="droid-arabic-kufi"> بيانات الزوجة </b>
                                 </a>
                              </li>

                              <li>
                                 <a href="#add_tora" data-toggle="tab" >
                                 <i class="material-icons myPills">keyboard_arrow_left</i>
                                 <b class="droid-arabic-kufi"> إضافة المعلومات للطرة</b>
                                 </a>
                              </li>

                           </ul>
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
  
   <!-- Sweet Alert 2 plugin -->
   <script src="assets/vendors/sweetalert2.js"></script>


   <!-- Select Plugin -->
   <script src="assets/vendors/jquery.select-bootstrap.js"></script>
   <!--managmnt js-->
   <script src="assets/js/generalSearch.js"></script>
   <script src="assets/js/avis_mngmnt.js"></script>
   <script src="assets/js/someJS.js"></script>
   <script src="assets/js/tasrihMngmnt.js"></script>
   <script src="assets/js/solbMngmt.js"></script>
   <script src="assets/js/extraitMngmnt.js"></script>
   <script src="assets/js/toraMangmnt.js"></script>
   <!--some js contain info about etatcivil*************-->

   <script src="assets/js/etatCivil.js"></script>
   <script>

      $('#sendVieCollectForm').click( function() {
         $('.vieCollectForm').submit();
      });

      $(function() {
        $('#etat_familiale_select').change(function(){
          $('.etat_familiale_wife').hide();
          $('#' + $(this).val()).show();
        });
      });

      //AVIS MARRIAGE  INFO/////////////////////////////////////////////////////
      var husband_name = "";
      var wife_name = "";
      // Husband**********
      $(document).ready(function(){
       load_data();
       function load_data(numero,annee)
       {
      	$.ajax({
      	 url:"searchAvisHusbandWifeInfo.php",
      	 method:"POST",
      	 dataType : "json",
      	 data:{'numero':numero,'annee':annee},
      	 success:function(data)
      	 {   

           if(data["prenom_ar"] !='' && data["nom_ar"] !='')
           {
            $("#tora_ar").append("السيد "+data["prenom_ar"]+" "+data["nom_ar"]+" تزوج السيدة ");
           } 


           if(data["prenom"] !='' && data["nom"] !='')
           {
            $("#tora_fr").append("monsieur "+data["prenom"]+" "+data["nom"]+" épouse  ");
           }  
           

        $("#prenom_nom").replaceWith(`<div class="form-group label-floating m-input-fr" id="prenom_nom">
        <label class="control-label m-label-form droid-arabic-kufi"> Prénom et Nom</label>
        <input type="text" name="prenom_nom" value="`+data["prenom"]+" "+data["nom"]+`" class="form-control">
        </div>`);




        $("#prenom_nom_ar").replaceWith(`<div class="form-group label-floating" id="prenom_nom_ar">
        <label class="control-label m-label-form droid-arabic-kufi"> الإسم الشخصي و العائلي </label>
        <input type="text" name="prenom_nom_ar" id="nom_husb" value="`+data["prenom_ar"]+" "+data["nom_ar"]+`" class="form-control">
        </div>`);


        $("#lieu_naiss").replaceWith(`<div class="form-group label-floating " id="lieu_naiss">
        <label class="control-label m-label-form droid-arabic-kufi"> مكان ولادته </label>
        <input type="text" name="lieu_naiss" value="`+data["lieu_naiss_ar"]+`" class="form-control">
        </div>`);



        $("#date_naiss_num").replaceWith(`<div class="form-group label-floating" id="date_naiss_num">
          <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادته (بالأرقام) </label>
          <input type="text" name="date_naiss_num" value="`+data["date_naiss_miladi"]+`" class="form-control">
        </div>`);

        $("#date_naiss").replaceWith(`<div class="form-group label-floating" id="date_naiss">
        <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادته </label>
        <input type="text" name="date_naiss" value="`+data["date_naiss_miladi_ar"]+`" class="form-control">
        </div>`);

      	 }
      	});
       }
       $('#numero_husband,#annee_husband').keyup(function(){
      	var numero = $("#numero_husband").val();
      	var annee = $("#annee_husband").val();
      	console.log(numero+" "+annee);

      	if(numero != '' && annee != '')
      	{
      	 load_data(numero,annee);
      	}
      	else
      	{
      	 load_data();
      	}
       });

      });

      // Wife**********
      $(document).ready(function(){
       load_data_wife();
       function load_data_wife(numero,annee)
       {
        $.ajax({
         url:"searchAvisHusbandWifeInfo.php",
         method:"POST",
         dataType : "json",
         data:{'numero':numero,'annee':annee},
         success:function(data)
         {
          if(data["prenom_ar"] !='' && data["nom_ar"] !='')
           {
            $("#tora_ar").append(data["prenom_ar"]+" "+data["nom_ar"]+" بتاريخ "+$("#date_avis").val());
           }

           if(data["prenom"] !='' && data["nom"] !='')
           {
            $("#tora_fr").append(data["prenom"]+" "+data["nom"]+" Le "+$("#date_avis").val());
           }  

           $("#prenom_nom_wife").replaceWith(`<div class="form-group label-floating m-input-fr" id="prenom_nom_wife">
           <label class="control-label m-label-form droid-arabic-kufi"> Prénom et Nom</label>
           <input type="text" name="prenom_nom_wife" value="`+data["prenom"]+" "+data["nom"]+`" class="form-control">
           </div>`);


           $("#prenom_nom_ar_wife").replaceWith(`<div class="form-group label-floating" id="prenom_nom_ar_wife">
           <label class="control-label m-label-form droid-arabic-kufi"> الإسم الشخصي و العائلي </label>
           <input type="text" name="prenom_nom_ar_wife" id="nom_wife" value="`+data["prenom_ar"]+" "+data["nom_ar"]+`" class="form-control">
           </div>`);


           $("#lieu_naiss_wife").replaceWith(`<div class="form-group label-floating " id="lieu_naiss_wife">
           <label class="control-label m-label-form droid-arabic-kufi"> مكان ولادته </label>
           <input type="text" name="lieu_naiss_wife" value="`+data["lieu_naiss_ar"]+`" class="form-control">
           </div>`);



           $("#date_naiss_num_wife").replaceWith(`<div class="form-group label-floating" id="date_naiss_num_wife">
              <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادته (بالأرقام) </label>
              <input type="text" name="date_naiss_num_wife" value="`+data["date_naiss_miladi"]+`" class="form-control">
           </div>`);

           $("#date_naiss_wife").replaceWith(`<div class="form-group label-floating" id="date_naiss_wife">
           <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادته </label>
           <input type="text" name="date_naiss_wife" value="`+data["date_naiss_miladi_ar"]+`" class="form-control">
           </div>`);
         }
        });
       }
       $('#numero_wife,#annee_wife').keyup(function(){
        var numero = $("#numero_wife").val();
        var annee = $("#annee_wife").val();
        console.log(numero+" "+annee);

        if(numero != '' && annee != '')
        {
         load_data_wife(numero,annee);
        }
        else
        {
         load_data_wife();
        }
       });

     

      });  

     
   </script>
</html>
