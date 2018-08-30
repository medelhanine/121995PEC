

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
   date_default_timezone_set('Africa/Casablanca');
   $ActualDate = date('Y/m/d');
   $heure = substr(date('H:i'),0,2);
    $min = substr(date('H:i'),3,5);
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
                           <li style="line-height: 0 !important" class="active">
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
                           <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#parentsModal" rel="tooltip" title=" معلومات حول الأب/الأم " data-placement="bottom">
                              <img class="material-icons" style="width:40px;height:40px;display:inline;" src="svg/file-search.svg">
                              <p class="hidden-lg hidden-md">
                                 profile
                                 <b class="caret"></b>
                              </p>
                           </a>
                        </li>
                        <!--modal about parents info-->
                        <div class="modal fade" id="parentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                           <div class="modal-dialog" role="document" style="margin-top: 70px !important;">
                              <div class="modal-content" style="height : 300px">
                                 <div class="modal-header" style="padding : 0 !important;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-md-9">
                                       <div class="tab-content">
                                          <!--get data from solb birth-->
                                          <div class="tab-pane active" id="solbData">
                                             <form action="searchParentDB.php" method="post" class="searchMotherForm">
                                                <div class="row m-search-margin">
                                                   <h5 class="droid-arabic-kufi" style="margin-bottom : 0 !important"> الأم </h5>
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
                                             <form action="searchParentDB.php" method="post" class="searchDadForm">
                                                <div class="row m-search-margin">
                                                   <h5 class="droid-arabic-kufi" style="margin-bottom : 0 !important"> الأب </h5>
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
                                          <!--end getting data from solb birth-->
                                          <!--get data From Ahkam-->
                                          <div class="tab-pane" id="ahkam">
                                             <form action="searchTasrihInfoDB.php" method="post" class="searchTasrihForm">
                                                <div class="row m-search-margin">
                                                   <h5 class="droid-arabic-kufi" style="margin-bottom : 0 !important"> باستخدام الرقم و السنة </h5>
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
                                             <i class="material-icons" style="padding : 0 !important">location_on</i>
                                             <strong class="droid-arabic-kufi">  صلب الولادة</strong>
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
                        <!--END MODAL PARENTS-->
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
                              <form action="insertBirthDB.php" method="post"   class="sBirthForm">
                                 <div class="tab-content">
                                 <?php
                                       $result = '';
                                       $result2 = ''; 
                                       $query="SELECT MAX(annee) FROM `sbirth`";
                                       $pdoResult = $pdoConnect->prepare($query);
                                       $pdoResult->execute();
                                       $result=$pdoResult->fetch();

                                       ?>
                                    <!--info rasm-->
                                    <div class="tab-pane active" id="infoRasm">
                                    <?php if($anneActu == $result["MAX(annee)"]){                                          
                                          $query2="SELECT MAX(numero) FROM `sbirth` WHERE annee=?";
                                          $pdoResult2 = $pdoConnect->prepare($query2);
                                          $pdoResult2->execute(array( $anneActu));
                                          $result2=$pdoResult2->fetch();
                                          $numero  = (int)$result2["MAX(numero)"];                                          
                                         ?>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                             <input type="text" name="annee"  value="<?php echo $anneActu ?>" id="anneeVal" class="form-control"  required>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi "> الرقم</label>
                                             <input type="text" name="numero" value="<?php echo ($numero+1) ?>" id="numeroVal" class="form-control" required>
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
                                             <input type="text" name="numero" value="1"  class="form-control" id="numeroVal" required>
                                          </div>
                                       </div>
                                       <?php } ?>

                                       <!--cetegorie sejil-->
                                       <div class="row" >
                                         <h3 class="droid-arabic-kufi" style="text-align: center">نوع السجل</h3>
                                          <div class="col-md-4 " style="margin-left: 35% ">
                                             <select name="sejil_categ" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="نوع السجل" data-size="7" >
                                                <option value="naiss" class="m-label-form droid-arabic-kufi" style="text-align: center" selected>سجل الولادات</option>
                                                <option value="tasarih" class="m-label-form droid-arabic-kufi" style="text-align: center"> سجل التصاريح</option>
                                                <option value="ahkam" class="m-label-form droid-arabic-kufi" style="text-align: center">سجل الأحكام</option>
                                             </select>
                                          </div>
                                       </div>
                                       <!--end categorie sejil-->
                                       

                                    </div>
                                    <!--end info rasm-->
                                    <!-- info child-->
                                    <div class="tab-pane " id="infoChild">
                                       <!--prenom-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="prenom">
                                             <label class="control-label m-label-form ">Prénom</label>
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
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Prénom</label>
                                             <input type="text" name="prenom_tora" value="Néant" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم الشخصي طرة</label>
                                             <input type="text" name="prenom_tora_ar" value="لا توجد" class="form-control">
                                          </div>
                                       </div>
                                       <!---end prenom tora-->
                                       <!--nom tora-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom_tora" value="Néant" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم العائلي طرة</label>
                                             <input type="text" name="nom_tora_ar" value="لا توجد" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom tora-->
                                       <!--sex-->
                                       <div class="row" >
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="sex" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="الجنس" data-size="7" >
                                                <option value="feminin" class="m-label-form droid-arabic-kufi">أنثى</option>
                                                <option value="masculin" class="m-label-form droid-arabic-kufi">ذكر</option>
                                             </select>
                                          </div>
                                       </div>
                                       <!---end sex-->
                                       <!--lieu naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Lieu de naissance</label>
                                             <input type="text" name="lieu_naiss"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6" >
                                          <div class="form-group label-floating" id="lieu_naiss_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
                                             <input type="text" name="lieu_naiss_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end lieu naiss-->
                                       <!--commune-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Commune</label>
                                             <input type="text" name="commune" value="<?php echo $communeName_fr ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">جماعة</label>
                                             <input type="text" name="commune_ar" value="<?php echo $communeName ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end commune-->
                                       <!--date naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
                                             <input type="text" name="date_naiss_hijri"  class="form-control" value="1439-02-25">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
                                             <input type="text" name="date_naiss_miladi"  class="form-control datepicker" value="2018-02-25">
                                          </div>
                                       </div>
                                       <!---end date naiss-->
                                       <!--en letrre arabe-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_hijri">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_hijri_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_miladi">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_miladi_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end en letrre arabe-->
                                       <!--en letrre franciase-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_hijri_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_miladi_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end en letrre franciase-->
                                       <!--heure et min-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="min">
                                             <label class="control-label m-label-form droid-arabic-kufi">و الدقيقة</label>
                                             <input type="text" name="min_naiss"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="heure">
                                             <label class="control-label m-label-form droid-arabic-kufi">على الساعة</label>
                                             <input type="text" name="heure"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end heure et min-->
                                       <!--nationalite-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Nationalité</label>
                                             <input type="text" name="nationalite" value="<?php echo $nationalite ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                             <input type="text" name="nationalite_ar" value="<?php echo  $nationalite_ar ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---nationalite-->
                                       <!--tora deces-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Mention marginale de décès</label>
                                             <input type="text" name="tora_deces"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">طرة الوفاة</label>
                                             <input type="text" name="tora_deces_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end tora deces-->
                                    </div>
                                    <!--end info child-->
                                    <!-- info dad-->
                                    <div class="tab-pane" id="infoDad">

                                       <!--nom dad-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nom_pere">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom_pere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nom_pere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الإسم </label>
                                             <input type="text" name="nom_pere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom dad-->

                                       <!--nom dad marginal -->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nom_pere_tora">
                                             <label class="control-label m-label-form">Nom(marge)</label>
                                             <input type="text" name="nom_pere_tora"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nom_pere_tora_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم في الطرة</label>
                                             <input type="text" name="nom_pere_tora_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom dad marginal-->
                                       <!--dead pere-->
                                       <div class="row" >
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="dead_pere" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="متوفي أو غير متوفي" data-size="7" >
                                                <option value="notDead" class="m-label-form droid-arabic-kufi">غير متوفي</option>
                                                <option value="dead" class="m-label-form droid-arabic-kufi">متوفي</option>
                                             </select>
                                          </div>
                                       </div>
                                       <!---end dead pere-->
                                       <!--date naiss dad-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating " id="date_naiss_pere_hijri_number">
                                             <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
                                             <input type="text" name="date_naiss_pere_hijri"  class="form-control " value="1439-02-25">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_pere_miladi_number">
                                             <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
                                             <input type="text" name="date_naiss_pere_miladi"  class="form-control datepicker" value="2018-02-25">
                                          </div>
                                       </div>
                                       <!---end date naiss dad-->
                                       <!--letrre arabe-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating " id="date_naiss_pere_hijri">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_pere_hijri_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_pere_miladi">
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
                                       <!--lieu naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="lieu_naiss_pere_fr">
                                             <label class="control-label m-label-form">Lieu de naissance</label>
                                             <input type="text" name="lieu_naiss_pere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="lieu_naiss_pere">
                                             <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
                                             <input type="text" name="lieu_naiss_pere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end lieu naiss-->
                                       <!--nationalite-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nationalite_pere_fr">
                                             <label class="control-label m-label-form">Nationalité</label>
                                             <input type="text" name="nationalite_pere" value="<?php echo  $nationalite ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nationalite_pere">
                                             <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                             <input type="text" name="nationalite_pere_ar" value="<?php echo  $nationalite_ar ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nationalite-->
                                       <!--profession-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" >
                                             <label class="control-label m-label-form">Profession</label>
                                             <input type="text" name="profession_pere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="profession_pere">
                                             <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
                                             <input type="text" name="profession_pere_ar"  class="form-control">
                                          </div>
                                       </div>

                                       <div class="row" ><!--category profession-->
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="prof_pere_categ" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="نوع المهنة" data-size="7" >
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
                                       <!---end profession-->
                                       <!--niveau scolarite-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" >
                                             <label class="control-label m-label-form">Niveau scolaire</label>
                                             <input type="text" name="niveau_pere_scol"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="niveau_scol_pere">
                                             <label class="control-label m-label-form droid-arabic-kufi">مستواه الدراسي</label>
                                             <input type="text" name="niveau_scol_pere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end niveau scolarite-->
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
                                       <!--nom mere-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nom_mere_tora">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom_mere_tora"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nom_mere_tora_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم في الطرة </label>
                                             <input type="text" name="nom_mere_tora_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom mere-->
                                       <!--dead mere-->
                                       <div class="row" >
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="dead_mere" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="متوفي أو غير متوفي" data-size="7" >
                                                <option value="notDead" class="m-label-form droid-arabic-kufi">غير متوفي</option>
                                                <option value="dead" class="m-label-form droid-arabic-kufi">متوفي</option>
                                             </select>
                                          </div>
                                       </div>
                                       <!---end dead mere-->
                                       <!--date naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating " id="date_naiss_mere_hijri_number">
                                             <label class="control-label  m-label-form droid-arabic-kufi">الهجري</label>
                                             <input type="text" name="date_naiss_mere_hijri"  class="form-control " value="1439-02-25">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_mere_miladi_number">
                                             <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي </label>
                                             <input type="text" name="date_naiss_mere_miladi"  class="form-control datepicker" value="2018-02-25">
                                          </div>
                                       </div>
                                       <!---end date naiss-->
                                       <!--en lettre arabe-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating " id="date_naiss_mere_hijri_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_mere_hijri_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_mere_miladi_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية </label>
                                             <input type="text" name="date_naiss_mere_miladi_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end lettre arabe-->
                                       <!--lettere francaise-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating " id="date_naiss_mere_hijri_fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_mere_hijri_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_naiss_mere_miladi_fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية </label>
                                             <input type="text" name="date_naiss_mere_miladi_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end lettere francaise-->
                                       <!--lieu naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="lieu_naiss_mere_fr">
                                             <label class="control-label m-label-form">Lieu de naissance</label>
                                             <input type="text" name="lieu_naiss_mere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="lieu_naiss_mere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد </label>
                                             <input type="text" name="lieu_naiss_mere_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end lieu naiss-->
                                       <!--Nationalité-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="nationalite_mere_fr">
                                             <label class="control-label m-label-form">Nationalité</label>
                                             <input type="text" name="nationalite_mere" value="<?php echo  $nationalite ?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="nationalite_mere_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">الجنسية </label>
                                             <input type="text" name="nationalite_mere_ar" value="<?php echo  $nationalite_ar ?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Nationalité-->
                                       <!--Profession mere-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" >
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


                                       <div class="row" ><!--category profession-->
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="prof_mere_categ" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="نوع المهنة" data-size="7" >
                                                <option value="P1" class="m-label-form droid-arabic-kufi" style = "text-align : center; font-size : 12px !important"> أعضاء الهيأة التشريعية المنتخبون المحليون. المسؤولون التسلسليون في الإدارة المحلية المديرون و أطر إدارة المقاولات</option>
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
                                       <!---end Profession mere-->
                                       <!--Niveau scolaire mere-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Niveau scolaire</label>
                                             <input type="text" name="niveau_scol_mere"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="niveau_scol_mer_ar">
                                             <label class="control-label m-label-form droid-arabic-kufi">مستواها الدراسي </label>
                                             <input type="text" name="niveau_scol_mer_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end Niveau scolaire mere-->
                                    </div>
                                    <!--end info mom-->
                                    <!-- plus details-->
                                    <div class="tab-pane" id="plusDetail">
                                       <!--ordre naiss-->
                                       <div class="row">
                                          <div class="col-md-6"></div>
                                          <div class="col-md-6">
                                             <div class="form-group label-floating" id="ordre_naiss">
                                                <label class="control-label m-label-form droid-arabic-kufi">رتبة الولادة </label>
                                                <input type="text" name="ordre_naiss"  class="form-control">
                                             </div>
                                          </div>
                                       </div>
                                       <!---end ordre naiss-->
                                       <!--Adresse-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" >
                                             <label class="control-label m-label-form">Adresse</label>
                                             <input type="text" name="adresse_parent"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="adresse_parent">
                                             <label class="control-label m-label-form droid-arabic-kufi">القاطنان ب </label>
                                             <input type="text" name="adresse_parent_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end Adresse-->
                                    </div>
                                    <!--end plus details-->
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
                                          <div class="form-group label-floating" id="selon">
                                             <label class="control-label m-label-form droid-arabic-kufi">بناء على </label>
                                             <input type="text" name="selon_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end Selon-->

                                       <!--numero tasrih-->
                                       <div class="col-md-6">

                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="annonce_numero">
                                             <label class="control-label m-label-form droid-arabic-kufi"> التصريح عدد</label>
                                             <input type="text" name="annonce_numero"  class="form-control">
                                          </div>
                                       </div>
                                       <!--end numero tasrih-->



                                       <!--Age-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Age</label>
                                             <input type="text" name="age_num_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="age_annonceur">
                                             <label class="control-label m-label-form droid-arabic-kufi">عمره </label>
                                             <input type="text" name="age_num_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end Age-->
                                       <!--Adresse-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Adresse</label>
                                             <input type="text" name="adresse_annonceur"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="adresse_annonceur">
                                             <label class="control-label m-label-form droid-arabic-kufi">الساكن ب </label>
                                             <input type="text" name="adresse_annonceur_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end Adresse-->
                                       <!--موافق-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating ">
                                             <label class="control-label m-label-form droid-arabic-kufi">موافق</label>
                                             <input type="text" name="date_annonce_hijri"  class="form-control " value="1439-02-25">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">حرر بتاريخ </label>
                                             <input type="text" name="date_annonce_miladi"  class="form-control datepicker" value="2018-02-25">
                                          </div>
                                       </div>
                                       <!---end موافق-->
                                       <!--بالأحرف العربية-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating " id="date_annonce_hijri">
                                             <label class="control-label m-label-form droid-arabic-kufi"> بالأحرف العربية (هجري) </label>
                                             <input type="text" name="date_annonce_hijri_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="date_annonce_miladi">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية (ميلادي)</label>
                                             <input type="text" name="date_annonce_miladi_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end بالأحرف العربية-->
                                       <!--الفرنسية-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية (هجري)  </label>
                                             <input type="text" name="date_annonce_hijri_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form m-input-fr droid-arabic-kufi">بالأحرف الفرنسية (ميلادي)</label>
                                             <input type="text" name="date_annonce_miladi_fr"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end الفرنسية-->



                                       <!--Heure et minute ecrit-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr" id="min_ecrit">
                                             <label class="control-label m-label-form droid-arabic-kufi"> و الدقيقة </label>
                                             <input type="text" name="min_ecrit" value="<?php echo $min ?>"  class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating" id="heure_ecrit">
                                             <label class="control-label m-label-form m-input-fr droid-arabic-kufi"> على الساعة </label>
                                             <input type="text" name="heure_ecrit" value="<?php echo $heure ?>"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end heure min ecrit-->
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
                                             <label class="control-label m-label-form m-input-fr droid-arabic-kufi">ضابط الحالة المدنية </label>
                                             <input type="text" name="officier_etat_civil_ar"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end Officier de l'état civile-->
                                    </div>
                                    <!--end officeEtat-->
                              </form>
                              <!--  image upload-->
                              <div class="tab-pane" id="image">
                              <form action="uploadSBirthDB.php" class="dropzone" id="myAwesomeDropzone">
                              <input type="hidden" name="numero" id="numeroUpload">
                              <input type="hidden" name="annee" id="anneeUpload">
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
                                    <a href="#infoChild" data-toggle="tab" >
                                    <b class="droid-arabic-kufi">معلومات حول المولود </b>
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#infoDad" data-toggle="tab">
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
                                    <a href="#plusDetail" data-toggle="tab"  >
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">معلومات اضافية </b>
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
                        <div style="text-align: center;margin-right: 25%;">
                           <button type="button" class="btn btn-info m-margin-left" id="submitSbirthForm">
                           <span class="btn-label">
                           <i class="material-icons">save</i>
                           </span>
                           <b class="droid-arabic-kufi"> حفظ </b>
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
      $('#submitSbirthForm').click( function() {
         $('.sBirthForm').submit();
      });

      var numero = $('#numeroVal').attr('value');
      var annee = $('#anneeVal').attr('value');
      $('#numeroUpload').attr('value', numero);
      $('#anneeUpload').attr('value', annee);


   </script>
</html>
