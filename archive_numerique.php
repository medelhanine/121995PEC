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
      <!--drop zone-->
      <link href="assets/vendors/dropzone/dropzone.min.css" rel="stylesheet">

      <link href="assets/vendors/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
      <!--some CSS-->
      <link href="assets/css/someCss.css" rel="stylesheet">
      <style>
      .dropzone{
      border: 2px dashed #BBB;
      border-radius: 5px;
      }

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
        }
      </style>
   </head>
   <body class="rtl-layout" style="overflow: hidden !important">
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
                   <a href="irsal.php" >
                      <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/send-file.svg">
                      <p class="m-pages droid-arabic-kufi" style="margin-right:8px;display:inline;">   الإرسالات و التقارير </p>
                   </a>
                </li>
                <!--end irsal-->
                <!--Archive Numeriques-->
                <li class="active">
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
                                   <a href="#solb_death" data-toggle="tab" class="droid-arabic-kufi" style="font-size:18px !important">صلب الوفيات</a>
                               </li>
                               <li  class="active">
                                   <a href="#solb_birth" data-toggle="tab" class="droid-arabic-kufi" style="font-size:18px !important">صلب الولادات</a>
                               </li>
                           </ul>

                           <div class="tab-content">
                               <div class="tab-pane active" id="solb_birth">
                                 <div class="material-datatables col-md-6" > <!--datatables result-->
                                   <h3 class="droid-arabic-kufi"> نتائج البحث </h3>
                                     <table id="datatables_sBirth" class="table table-striped table-no-bordered table-hover droid-arabic-kufi" cellspacing="0" width="100%" style="width:100%">
                                         <thead>
                                             <tr>
                                               <th style="text-align : center"> الرقم </th>
                                               <th style="text-align : center">السنة</th>
                                                <th style="text-align : center">الإسم الشخصي</th>
                                                <th style="text-align : center">الإسم العائلي</th>

                                             </tr>
                                         </thead>
                                         <tfoot>
                                             <tr>
                                               <th style="text-align : center"> الرقم </th>
                                               <th style="text-align : center">السنة</th>
                                                <th style="text-align : center">الإسم الشخصي</th>
                                                <th style="text-align : center">الإسم العائلي</th>

                                             </tr>
                                         </tfoot>

                                     </table>
                                 </div><!--end datatables result-->

                                 <div class="col-md-6"><!--scanes field-->
                                   <h3 class="droid-arabic-kufi"> الصور و المعلومات </h3>
                                   <div id="scans"> <!--get the scans and info about the clicked row-->

                                   </div><!--get the scans and info about the clicked row-->

                                 </div><!--end scanes field-->

                               </div>
                               <div class="tab-pane" id="solb_death">
                                 <div class="material-datatables col-md-6" > <!--datatables result-->
                                   <h3 class="droid-arabic-kufi">نتائج البحث</h3>
                                     <table id="datatables_sDeath" class="table table-striped table-no-bordered table-hover droid-arabic-kufi" cellspacing="0" width="100%" style="width:100%">
                                         <thead>
                                             <tr>
                                               <th style="text-align : center"> الرقم </th>
                                               <th style="text-align : center">السنة</th>
                                                <th style="text-align : center">الإسم الشخصي</th>
                                                <th style="text-align : center">الإسم العائلي</th>

                                             </tr>
                                         </thead>
                                         <tfoot>
                                             <tr>
                                               <th style="text-align : center"> الرقم </th>
                                               <th style="text-align : center">السنة</th>
                                                <th style="text-align : center">الإسم الشخصي</th>
                                                <th style="text-align : center">الإسم العائلي</th>

                                             </tr>
                                         </tfoot>

                                     </table>
                                 </div><!--end datatables result-->

                                 <div class="col-md-6"><!--scanes field-->
                                   <h3 class="droid-arabic-kufi"> الصور و المعلومات </h3>
                                   <div id="scansDeath"> <!--get the scans and info about the clicked row-->

                                   </div><!--get the scans and info about the clicked row-->

                                 </div><!--end scanes field-->
                               </div><!--end tab sdeath -->
                               <div class="tab-pane" id="tasrih_birth">

                               </div>
                               <div class="tab-pane" id="tasrih_deces">

                               </div>
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
<!--  DataTables.net Plugin    -->
<script src="assets/vendors/jquery.datatables.js"></script>

<script type="text/javascript">


    $(document).ready(function() {

      //SBirth datatables
        var datatable=$('#datatables_sBirth').DataTable({
          lengthChange: false,
           bPaginate: true,
           bFilter: true,
           bInfo: false,
           ordering : false,
           pageLength: 10,
           pagingType: "simple_numbers",
           language: {
             processing: "<h3 class='waiting'> المرجو الإنتظار لتحميل البيانات ...... </h3>",
               search: "_INPUT_",
               searchPlaceholder: "بحث",
               lengthMenu: "Aficher &nbsp&nbsp_MENU_ &nbsp linges par page",
               info: "page _PAGE_ sur _PAGES_ - _MAX_ lignes",
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
                   url :"sbirth_archive.php",
                   type: "post",
                   crossDomain: true,
                   data:
                   {

                   },
                   dataFilter: function(response){
            // this to see what exactly is being sent back
            $('#datatables_sBirth tbody').on('click', 'tr', function () {
            var data = datatable.row( this ).data();
            var numero = data[0].substring(data[0].lastIndexOf("em")+5,data[0].lastIndexOf("</"));
            var annee = data[1].substring(data[1].lastIndexOf("em")+5,data[1].lastIndexOf("</"));
            var folder  = "solbBirth";
            var table = "sbirth";
            //send data for search scans of the clicked row
            $.ajax({
          		url :"getScans.php",
          		type:"POST",
          		data:{"numero":numero,"annee":annee,"table":table,"folder":folder},
          		success: function(data){
          			//console.log(data);
                $("#scans").html(data);
          		}
          	});
      } );
                  return response;
              },

               }
        });

        //SDeath datatables
          var datatableSDeath=$('#datatables_sDeath').DataTable({
            lengthChange: false,
             bPaginate: true,
             bFilter: true,
             bInfo: false,
             ordering : false,
             pageLength: 10,
             pagingType: "simple_numbers",
             language: {
               processing: "<h3 class='waiting'> المرجو الإنتظار لتحميل البيانات ...... </h3>",
                 search: "_INPUT_",
                 searchPlaceholder: "بحث",
                 lengthMenu: "Aficher &nbsp&nbsp_MENU_ &nbsp linges par page",
                 info: "page _PAGE_ sur _PAGES_ - _MAX_ lignes",
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
                     url :"sDeath_archive.php",
                     type: "post",
                     crossDomain: true,
                     data:
                     {

                     },
                     dataFilter: function(response){
              // this to see what exactly is being sent back
              $('#datatables_sDeath tbody').on('click', 'tr', function () {
              var data = datatableSDeath.row( this ).data();
              var numero = data[0].substring(data[0].lastIndexOf("em")+5,data[0].lastIndexOf("</"));
              var annee = data[1].substring(data[1].lastIndexOf("em")+5,data[1].lastIndexOf("</"));
              var folder  = "solbDeath";
              var table = "sdeadtable";
              //send data for search scans of the clicked row
              $.ajax({
            		url :"getScans.php",
            		type:"POST",
            		data:{"numero":numero,"annee":annee,"table":table,"folder":folder},
            		success: function(data){
            			//console.log(data);
                  $("#scansDeath").html(data);
            		}
            	});
        } );
                    return response;
                },

                 }
          });

        $('.card .material-datatables label').addClass('form-group');


    });




</script>
</html>
