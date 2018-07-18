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
   $request = $_REQUEST;
   $numero = $request["numero"];
   $annee = $request["annee"];
   if(trim($numero)!="" && trim($annee)!="" )
   {
   	$query="SELECT * FROM `sbirth` WHERE `numero`=? AND `annee`=?";
   $pdoResult = $pdoConnect->prepare($query);
   $pdoResult->execute(array($numero,$annee));
   }

   $result=$pdoResult->fetch();
   if($pdoResult->rowCount()>0)
   {
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

         .nav-pills > li > a 
         {
          font-size : 10px !important ;
           
         }


         /*image slider*/
/*gallery styling*/
.container {
  max-width: 610px;
  height : 900px;
  margin-top : 2%;
  /*margin: auto;*/
  border: #253340 solid 2px;
  /*border-radius : 25px;*/
  background: #D8D8D8;
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
/*end image slider*/
      </style>
   </head>
   <body class="rtl-layout sidebar-mini" >
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
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;">الرئيسية </p>
                     </a>
                  </li>

                  <li>
                     <a href="#" data-toggle="modal" data-target=".general_search">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/search_general.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;">    بحث عام </p>
                     </a>
                  </li>
                  <li>
                     <a href="#" data-toggle="modal" data-target=".etatCivil">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/open-book.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;">  كناش الحالة المدنية </p>
                     </a>
                  </li>
                  <li>
                     <a data-toggle="collapse" href="#dbBayane" class="collapsed" aria-expanded="false">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/contract.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;"> بيان الزواج و الطلاق
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
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;"> الأحكام و التصاريح
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
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;"> قاعدة بيانات الصلب
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
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;">قاعدة بيانات الطرر
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
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px">قاعدة بيانات العقود
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
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;"> انتقاء البيانات</p>
                     </a>
                  </li>
                  <!--irsal-->
                  <li>
                     <a href="" data-toggle="modal" data-target=".irsal">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/send-file.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;">   الإرسالات و التقارير </p>
                     </a>
                  </li>
                  <!--end irsal-->
                  <!--Archive Numeriques-->
                  <li>
                     <a href="archive_numerique.php">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/archive.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;"> الأرشيف الرقمي </p>
                     </a>
                  </li>
                  <li>
                     <a href="statistiques.php">
                        <img class="material-icons" style="width:24px;height:24px;display:inline;" src="svg/graph.svg">
                        <p class="m-pages droid-arabic-kufi" style="margin-right:8px;">إحصائيات</p>
                     </a>
                  </li>
                  <!-- end db management-->
               </ul>
            </div>
         </div>
         <div class="main-panel" style="width: calc(100% - 80px); margin-right: 80px !important;margin-left : 0;">
            <nav class="navbar navbar-default navbar-absolute" data-topbar-color="blue">
               <div class="container-fluid">
                  <div class="collapse navbar-collapse">
                     <ul class="nav navbar-nav navbar-right">
                       <div id="validation">

                       </div>


                       <?php if($result['validate']==0){ ?>
                        <li>
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="تأكيد المعلومات" data-placement="bottom" data-numero="<?php echo $numero?>" data-annee="<?php echo $annee?>" id="validateBirth">
                              <img class="material-icons" style="width:40px;height:40px;display:inline;" src="svg/exclamation.svg">
                              <p class="hidden-lg hidden-md">Apps</p>
                           </a>
                         </li>
                           <?php }else{ ?>
                             <li>
                               <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#add_to_etat_civil" rel="tooltip" title="إضافة لكناش الحالة المدنية" data-placement="bottom">
                                  <img class="material-icons" style="width:40px;height:40px;display:inline;" src="svg/add-book.svg">
                                  <p class="hidden-lg hidden-md">Apps</p>
                               </a>
                             </li>

                             <li>
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown"  rel="tooltip" title="تم تأكيد الصلب " data-placement="bottom">
                                  <img class="material-icons" style="width:40px;height:40px;display:inline;" src="svg/checked.svg">
                                  <p class="hidden-lg hidden-md">Apps</p>
                               </a>
                             </li>

                           <?php } ?>
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
               <div class="modal fade " id="add_to_etat_civil" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog  m-modal-margin" role="document" style="margin-top: 100px !important;">
                     <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h3 style="text-align: center" class="droid-arabic-kufi">البحث في قاعدة البيانات  </h3>
                        </div>
                        <div class="modal-body">
                           <!--searhc with num-->
                           <form action="insert_solb_to_etat_civilDB.php" method="post" class="insert_to_etat_civil">
                             <input type="hidden" name="numero" value="<?php echo  $numero ?> ">
                             <input type="hidden" name="annee" value="<?php echo  $annee ?> ">
                              <div class="row m-search-margin">
                                 <h4 class="droid-arabic-kufi m-title-color"> المرجو إضافة رقم كناش حالة مدنية </h4>

                                 <div class="col-md-2" style="text-align: center">
                                    <button type="submit" class="btn btn-info btn-round btn-fab btn-fab-mini m-button-margin">
                                    <i class="material-icons">add</i>
                                    </button>
                                 </div>

                                 <div class="col-md-5">
                                   <select name="type" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="أب أو ابن" data-size="7" >
                                      <option  value="1"  class="m-label-form">أب</option>
                                      <option value="2"  < class="m-label-form">ابن</option>
                                   </select>
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
                     </div>
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
               <div class="">
                  <div class="card">
                     <div class="card-content" style="padding : 0 !important">
                          <div class="col-md-6"><!--images div-->
                          <div class="container">
                          <div class="main-img">
                          <?php 
                              $j=1;
                              $folder = "uploads/solbBirth/".$numero.".".$annee."/";

                                $images = glob($folder."*.*");
                                if(count($images) > 0 )
                                { 
                            ?>
                          
                            <img src="<?php echo $images[0] ?>" id="current" style="height : 650px;margin-top:3%;">
                          </div>

                          <div class="imgs">
                                    <?php
                                    foreach($images as $image)
                                    {
                                      ?>
                                      <img src="<?php echo $image ?>">
                                      <?php
                                      $j++;
                                    }
                                    
                                  }else{
                                    ?>
                                    <img src="assets/img/no-image.png" id="current" style="height : 650px;margin-top:3%;opacity: 0.5;">
                                    </div>

                                    <div class="imgs">
                                    </div>

                                 <?php } ?>

                                  </div>
                        </div>
                          </div><!--end image div-->
                        <div class=" col-md-6">
                           <div class="col-md-9">
                              <form action="updateSBirthDB.php" method="post" class="sBirthFormUpdate">
                                 <div class="tab-content">
                                    <!--info rasm-->
                                    <div class="tab-pane active" id="infoRasm">
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">السنة</label>
                                             <input type="text" name="annee"  value="<?php echo $annee?>" class="form-control" readonly >
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> الرقم</label>
                                             <input type="text" name="numero" value="<?php echo $numero?>"  class="form-control" readonly >
                                          </div>
                                       </div>

                                       <!--cetegorie sejil-->
                                       <div class="row" >
                                          <h3 class="droid-arabic-kufi" style="text-align: center">نوع السجل</h3>
                                           <div class="col-md-4 " style="margin-left: 35% ">
                                              <select name="sejil_categ" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="نوع السجل" data-size="7" >
                                                 <option value="naissance" <?php echo ($result["sejil_categ"]=='naissance')?'selected':'' ?> class="m-label-form droid-arabic-kufi" style="text-align: center" selected>سجل الولادات</option>
                                                 <option value="tasarih" <?php echo ($result["sejil_categ"]=='tasarih')?'selected':'' ?> class="m-label-form droid-arabic-kufi" style="text-align: center"> سجل التصاريح</option>
                                                 <option value="ahkam" <?php echo ($result["sejil_categ"]=='ahkam')?'selected':'' ?> class="m-label-form droid-arabic-kufi" style="text-align: center">سجل الأحكام</option>
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
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Prénom</label>
                                             <input type="text" name="prenom" value="<?php echo $result["prenom"]?>" class="form-control">
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
                                       <!--prenom tora-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Prénom</label>
                                             <input type="text" name="prenom_tora" value="<?php echo $result["prenom_tora"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم الشخصي طرة</label>
                                             <input type="text" name="prenom_tora_ar" value="<?php echo $result["prenom_tora_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end prenom tora-->
                                       <!--nom tora-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom_tora" value="<?php echo $result["nom_tora"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم العائلي طرة</label>
                                             <input type="text" name="nom_tora_ar" value="<?php echo $result["nom_tora_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom tora-->
                                       <!--sex-->
                                       <div class="row" >
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="sex" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="الجنس" data-size="7" >
                                                <option  value="feminin" <?php echo ($result["sex"]=='feminin')?'selected':'' ?> class="m-label-form">أنثى</option>
                                                <option value="masculin"  <?php echo ($result["sex"]=='masculin')?'selected':'' ?> class="m-label-form">ذكر</option>
                                             </select>
                                          </div>
                                       </div>
                                       <!---end sex-->
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
                                       <!--commune-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Commune</label>
                                             <input type="text" name="commune" value="<?php echo $result["commune"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">جماعة</label>
                                             <input type="text" name="commune_ar" value="<?php echo $result["commune_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end commune-->
                                       <!--date naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form">الهجري</label>
                                             <input type="text" name="date_naiss_hijri" value="<?php echo $result["date_naiss_hijri"]?>" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
                                             <input type="text" name="date_naiss_miladi" value="<?php echo $result["date_naiss_miladi"]?>" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <!---end date naiss-->
                                       <!--en letrre arabe-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_hijri_ar" value="<?php echo $result["date_naiss_hijri_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_miladi_ar" value="<?php echo $result["date_naiss_miladi_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end en letrre arabe-->
                                       <!--en letrre franciase-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_hijri_fr" value="<?php echo $result["date_naiss_hijri_fr"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_miladi_fr" value="<?php echo $result["date_naiss_miladi_fr"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end en letrre franciase-->
                                       <!--heure et min-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">و الدقيقة</label>
                                             <input type="text" name="min_naiss" value="<?php echo $result["min_naiss"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">على الساعة</label>
                                             <input type="text" name="heure" value="<?php echo $result["heure"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end heure et min-->
                                       <!--nationalite-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Nationalité</label>
                                             <input type="text" name="nationalite" value="<?php echo $result["nationalite"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                             <input type="text" name="nationalite_ar" value="<?php echo $result["nationalite_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---nationalite-->
                                       <!--tora deces-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Mention marginale de décès</label>
                                             <input type="text" name="tora_deces" value="<?php echo $result["tora_deces"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">طرة الوفاة</label>
                                             <input type="text" name="tora_deces_ar" value="<?php echo $result["tora_deces_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end tora deces-->
                                    </div>
                                    <!--end info child-->
                                    <!-- info dad-->
                                    <div class="tab-pane" id="infoDad">

                                       <!--nom dad-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom_pere" value="<?php echo $result["nom_pere"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم العائلي</label>
                                             <input type="text" name="nom_pere_ar" value="<?php echo $result["nom_pere_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom dad-->

                                       <!--nom dad marginal -->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Nom(marge)</label>
                                             <input type="text" name="nom_pere_tora" value="<?php echo $result["nom_pere_tora"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم في الطرة</label>
                                             <input type="text" name="nom_pere_tora_ar" value="<?php echo $result["nom_pere_tora_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom dad marginal-->
                                       <!--dead pere-->
                                       <div class="row" >
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="dead_pere" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="متوفي أو غير متوفي" data-size="7" >
                                                <option value="notDead"  <?php echo ($result["dead_pere"]=='notDead')?'selected':'' ?> class="m-label-form droid-arabic-kufi">غير متوفي</option>
                                                <option value="dead" <?php echo ($result["dead_pere"]=='dead')?'selected':'' ?> class="m-label-form droid-arabic-kufi">متوفي</option>
                                             </select>
                                          </div>
                                       </div>
                                       <!---end dead pere-->
                                       <!--date naiss dad-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating ">
                                             <label class="control-label m-label-form droid-arabic-kufi">الهجري</label>
                                             <input type="text" name="date_naiss_pere_hijri" value="<?php echo $result["date_naiss_pere_hijri"]?>" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي</label>
                                             <input type="text" name="date_naiss_pere_miladi" value="<?php echo $result["date_naiss_pere_miladi"]?>" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <!---end date naiss dad-->
                                       <!--letrre arabe-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_pere_hijri_ar" value="<?php echo $result["date_naiss_pere_hijri_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_pere_miladi_ar" value="<?php echo $result["date_naiss_pere_miladi_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end lettre arabe-->
                                       <!--en lettre francaise-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_pere_hijri_fr" value="<?php echo $result["prenom"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_pere_miladi_fr" value="<?php echo $result["date_naiss_pere_miladi_fr"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end en lettre francaise-->
                                       <!--lieu naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Lieu de naissance</label>
                                             <input type="text" name="lieu_naiss_pere" value="<?php echo $result["lieu_naiss_pere"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
                                             <input type="text" name="lieu_naiss_pere_ar" value="<?php echo $result["lieu_naiss_pere_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end lieu naiss-->
                                       <!--nationalite-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Nationalité</label>
                                             <input type="text" name="nationalite_pere" value="<?php echo $result["nationalite_pere"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                             <input type="text" name="nationalite_pere_ar" value="<?php echo $result["nationalite_pere_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nationalite-->
                                       <!--profession-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Profession</label>
                                             <input type="text" name="profession_pere" value="<?php echo $result["profession_pere"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
                                             <input type="text" name="profession_pere_ar" value="<?php echo $result["profession_pere_ar"]?>" class="form-control">
                                          </div>
                                       </div>


                                        <div class="row" ><!--category profession-->
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="prof_pere_categ" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="نوع المهنة" data-size="7" >
                                                <option value="P1" class="m-label-form droid-arabic-kufi" style = "text-align : center; font-size : 12px !important" <?php echo ($result["prof_pere_categ"]=='P1') ? 'selected':'' ?>> أعضاء الهيأة التشريعية المنتخبون المحليون. المسؤولون التسلسليون في الإدارة المحلية المديرون و أطر إدارة المقاولات</option>
                                                <option value="P2" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_pere_categ"]=='P2') ? 'selected':'' ?>>أطر العليا و أعضاء المهن الحرة</option>

                                                <option value="P3" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_pere_categ"]=='P3')?'selected':'' ?>>     
                                                الأطر المتوسطة
                                                </option>

                                                <option value="P4" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_pere_categ"]=='P4')?'selected':'' ?>>     
                                                المستخدمون
                                                </option>

                                                <option value="P5" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_pere_categ"]=='P5')?'selected':'' ?>>     
                                                التجار الوسطاء التجاريون و الماليون
                                                </option>

                                                <option value="P6" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_pere_categ"]=='P6')?'selected':'' ?>>     
                                                المستغلون الفلاحيون صيادو السمك ، الغابويون القناصون و المشتغلون الذين يشابهونهم
                                                </option>

                                                <option value="P7" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_pere_categ"]=='P7')?'selected':'' ?>>     
                                                الحرفيون و العمال المؤهلون في المهن الحفية باسثثناء عمال الفلاحة
                                                </option>

                                                <option value="P8" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_pere_categ"]=='P8')?'selected':'' ?>>     
                                                العمال و العمال اليدويون في الفلاحة و الصيد ـبما فيهم العمال المؤهلون
                                                </option>

                                                <option value="P9" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_pere_categ"]=='P9')?'selected':'' ?>>     
                                                مسيروا التجهيزات و الآلات و عمال التركيب و التجميع
                                                </option>

                                                
                                                <option value="P10" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_pere_categ"]=='P10')?'selected':'' ?>>     
                                                العمال اليدويون عمال حمل البضائع و عمال المهن الصغرى باسثثناء الفلاحة
                                                </option>

                                                <option value="P11" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_pere_categ"]=='P11')?'selected':'' ?>>     
                                                أشخاص لايمكن تصنيفهم حسب المهنة و مهنة غير مصرح بها                                                                                              
                                                </option>
                                             </select>
                                          </div>                                          
                                       </div><!--end category profession-->

                                       <!---end profession-->
                                       <!--niveau scolarite-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Niveau scolaire</label>
                                             <input type="text" name="niveau_pere_scol" value="<?php echo $result["niveau_pere_scol"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">مستواه الدراسي</label>
                                             <input type="text" name="niveau_scol_pere_ar" value="<?php echo $result["niveau_scol_pere_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end niveau scolarite-->
                                    </div>
                                    <!--end info dad-->
                                    <!-- info mom-->
                                    <div class="tab-pane" id="infoMom">
                                       <!--nom mere-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom_mere" value="<?php echo $result["nom_mere"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم </label>
                                             <input type="text" name="nom_mere_ar" value="<?php echo $result["nom_mere_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom mere-->
                                       <!--nom mere-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom_mere_tora" value="<?php echo $result["nom_mere_tora"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الاسم في الطرة </label>
                                             <input type="text" name="nom_mere_tora_ar" value="<?php echo $result["nom_mere_tora_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end nom mere-->
                                       <!--dead mere-->
                                       <div class="row" >
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="dead_mere" class="selectpicker m-label-form" data-style="btn btn-info btn-round" title="متوفي أو غير متوفي" data-size="7" >
                                                <option value="notDead" class="m-label-form" <?php echo ($result["dead_mere"]=='notDead')?'selected':'' ?>>غير متوفي</option>
                                                <option value="dead" class="m-label-form" <?php echo ($result["dead_mere"]=='dead')?'selected':'' ?>>متوفي</option>
                                             </select>
                                          </div>
                                       </div>
                                       <!---end dead mere-->
                                       <!--date naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating ">
                                             <label class="control-label  m-label-form droid-arabic-kufi">الهجري</label>
                                             <input type="text" name="date_naiss_mere_hijri" value="<?php echo $result["date_naiss_mere_hijri"]?>" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">تاريخ الازدياد الميلادي </label>
                                             <input type="text" name="date_naiss_mere_miladi" value="<?php echo $result["date_naiss_mere_miladi"]?>" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <!---end date naiss-->
                                       <!--en lettre arabe-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating ">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_naiss_mere_hijri_ar" value="<?php echo $result["date_naiss_mere_hijri_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية </label>
                                             <input type="text" name="date_naiss_mere_miladi_ar" value="<?php echo $result["date_naiss_mere_miladi_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end lettre arabe-->
                                       <!--lettere francaise-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating ">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_naiss_mere_hijri_fr" value="<?php echo $result["date_naiss_mere_hijri_fr"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية </label>
                                             <input type="text" name="date_naiss_mere_miladi_fr" value="<?php echo $result["date_naiss_mere_miladi_fr"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end lettere francaise-->
                                       <!--lieu naiss-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Lieu de naissance</label>
                                             <input type="text" name="lieu_naiss_mere" value="<?php echo $result["lieu_naiss_mere"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد </label>
                                             <input type="text" name="lieu_naiss_mere_ar" value="<?php echo $result["lieu_naiss_mere_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end lieu naiss-->
                                       <!--Nationalité-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Nationalité</label>
                                             <input type="text" name="nationalite_mere" value="<?php echo $result["nationalite_mere"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الجنسية </label>
                                             <input type="text" name="nationalite_mere_ar" value="<?php echo $result["nationalite_mere_ar"]?>"  class="form-control">
                                          </div>
                                       </div>
                                       <!---end Nationalité-->
                                       <!--Profession mere-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Profession</label>
                                             <input type="text" name="profession_mere" value="<?php echo $result["profession_mere"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
                                             <input type="text" name="profession_mere_ar" value="<?php echo $result["profession_mere_ar"]?>" class="form-control">
                                          </div>
                                       </div>

                                      <div class="row" ><!--category profession-->
                                          <div class="col-md-4 " style="margin-left: 40% ">
                                             <select name="prof_mere_categ" class="selectpicker m-label-form droid-arabic-kufi" data-style="btn btn-info btn-round" title="نوع المهنة" data-size="7" >
                                                <option value="P1" class="m-label-form droid-arabic-kufi" style = "text-align : center; font-size : 12px !important" <?php echo ($result["prof_mere_categ"]=='P1')?'selected':'' ?>> أعضاء الهيأة التشريعية المنتخبون المحليون. المسؤولون التسلسليون في الإدارة المحلية المديرون و أطر إدارة المقاولات</option>
                                                <option value="P2" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_mere_categ"]=='P2')?'selected':'' ?>>أطر العليا و أعضاء المهن الحرة</option>

                                                <option value="P3" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_mere_categ"]=='P3')?'selected':'' ?>>     
                                                الأطر المتوسطة
                                                </option>

                                                <option value="P4" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_mere_categ"]=='P4')?'selected':'' ?>>     
                                                المستخدمون
                                                </option>

                                                <option value="P5" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_mere_categ"]=='P5')?'selected':'' ?>>     
                                                التجار الوسطاء التجاريون و الماليون
                                                </option>

                                                <option value="P6" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_mere_categ"]=='P6')?'selected':'' ?>>     
                                                المستغلون الفلاحيون صيادو السمك ، الغابويون القناصون و المشتغلون الذين يشابهونهم
                                                </option>

                                                <option value="P7" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_mere_categ"]=='P7')?'selected':'' ?>>     
                                                الحرفيون و العمال المؤهلون في المهن الحفية باسثثناء عمال الفلاحة
                                                </option>

                                                <option value="P8" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_mere_categ"]=='P8')?'selected':'' ?>>     
                                                العمال و العمال اليدويون في الفلاحة و الصيد ـبما فيهم العمال المؤهلون
                                                </option>

                                                <option value="P9" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_mere_categ"]=='P9')?'selected':'' ?>>     
                                                مسيروا التجهيزات و الآلات و عمال التركيب و التجميع
                                                </option>

                                                
                                                <option value="P10" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_mere_categ"]=='P10')?'selected':'' ?>>     
                                                العمال اليدويون عمال حمل البضائع و عمال المهن الصغرى باسثثناء الفلاحة
                                                </option>

                                                <option value="P11" class="m-label-form droid-arabic-kufi" style = "text-align : center" <?php echo ($result["prof_mere_categ"]=='P11')?'selected':'' ?>>     
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
                                             <input type="text" name="niveau_scol_mer" value="<?php echo $result["niveau_scol_mer"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">مستواها الدراسي </label>
                                             <input type="text" name="niveau_scol_mer_ar" value="<?php echo $result["niveau_scol_mer_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Niveau scolaire mere-->
                                    </div>
                                    <!--end info mom-->
                                    <!-- plus details-->
                                    <div class="tab-pane" id="plusDetail">
                                       <!--ordre naiss-->
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="form-group label-floating">
                                                <label class="control-label m-label-form droid-arabic-kufi">رتبة الولادة </label>
                                                <input type="text" name="ordre_naiss" value="<?php echo $result["ordre_naiss"]?>" class="form-control">
                                             </div>
                                          </div>
                                       </div>
                                       <!---end ordre naiss-->
                                       <!--Adresse-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Adresse</label>
                                             <input type="text" name="adresse_parent" value="<?php echo $result["adresse_parent"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">القاطنان ب </label>
                                             <input type="text" name="adresse_parent_ar" value="<?php echo $result["adresse_parent_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Adresse-->
                                    </div>
                                    <!--end plus details-->
                                    <!-- info tasrih-->
                                    <div class="tab-pane" id="infoTasrih">
                                       <!--Selon-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Selon</label>
                                             <input type="text" name="selon" value="<?php echo $result["selon"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بناء على </label>
                                             <input type="text" name="selon_ar" value="<?php echo $result["selon_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Selon-->

                                       <!--Selon-->
                                       <div class="col-md-6">

                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi"> التصريح عدد </label>
                                             <input type="text" name="annonce_numero" value="<?php echo $result["annonce_numero"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Selon-->
                                       <!--Age-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Age</label>
                                             <input type="text" name="age_num_fr" value="<?php echo $result["age_num_fr"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">عمره </label>
                                             <input type="text" name="age_num_ar" value="<?php echo $result["age_num_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Age-->
                                       <!--Adresse-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Adresse</label>
                                             <input type="text" name="adresse_annonceur" value="<?php echo $result["adresse_annonceur"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">الساكن ب </label>
                                             <input type="text" name="adresse_annonceur_ar" value="<?php echo $result["adresse_annonceur_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Adresse-->
                                       <!--موافق-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating ">
                                             <label class="control-label m-label-form droid-arabic-kufi">موافق</label>
                                             <input type="text" name="date_annonce_hijri" value="<?php echo $result["date_annonce_hijri"]?>" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">حرر بتاريخ </label>
                                             <input type="text" name="date_annonce_miladi" value="<?php echo $result["date_annonce_miladi"]?>" class="form-control datepicker">
                                          </div>
                                       </div>
                                       <!---end موافق-->
                                       <!--بالأحرف العربية-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating ">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية</label>
                                             <input type="text" name="date_annonce_hijri_ar" value="<?php echo $result["date_annonce_hijri_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف العربية </label>
                                             <input type="text" name="date_annonce_miladi_ar" value="<?php echo $result["date_annonce_miladi_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end بالأحرف العربية-->
                                       <!--الفرنسية-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form droid-arabic-kufi">بالأحرف الفرنسية</label>
                                             <input type="text" name="date_annonce_hijri_fr" value="<?php echo $result["date_annonce_hijri_fr"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form m-input-fr droid-arabic-kufi">بالأحرف الفرنسية </label>
                                             <input type="text" name="date_annonce_miladi_fr" value="<?php echo $result["date_annonce_miladi_fr"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end الفرنسية-->

                                       <!--heure min-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">و الدقيقة </label>
                                             <input type="text" name="min_ecrit" value="<?php echo $result["min_ecrit"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form droid-arabic-kufi">على الساعة</label>
                                             <input type="text" name="heure_ecrit" value="<?php echo $result["heure_ecrit"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!--- heure min-->
                                    </div>
                                    <!--end info tasrih-->
                                    <!-- officeEtat-->
                                    <div class="tab-pane" id="officeEtat">
                                       <!--Par nous-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Par nous</label>
                                             <input type="text" name="par_nous" value="<?php echo $result["par_nous"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form m-input-fr">من طرفنا نحن </label>
                                             <input type="text" name="par_nous_ar" value="<?php echo $result["par_nous_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Par nous-->
                                       <!--Officier de l'état civile-->
                                       <div class="col-md-6">
                                          <div class="form-group label-floating m-input-fr">
                                             <label class="control-label m-label-form">Officier de l'état civile</label>
                                             <input type="text" name="officier_etat_civil" value="<?php echo $result["officier_etat_civil"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group label-floating">
                                             <label class="control-label m-label-form m-input-fr">ضابط الحالة المدنية </label>
                                             <input type="text" name="officier_etat_civil_ar" value="<?php echo $result["officier_etat_civil_ar"]?>" class="form-control">
                                          </div>
                                       </div>
                                       <!---end Officier de l'état civile-->
                                    </div>
                                    <!--end officeEtat-->
                              </form>
                              <!--  image upload-->
                              <div class="tab-pane" id="image">
                              
                              <form action="uploadSBirthDB.php" class="dropzone" id="myAwesomeDropzone">
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
                           <div class="col-md-3 ">
                              <ul class="nav nav-pills nav-pills-rose nav-stacked col-md-12">
                                 <li class="active">
                                    <a href="#infoRasm" data-toggle="tab" rel="tooltip">
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">معلومات حول الرسم</b>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#infoChild" data-toggle="tab" >
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">معلومات حول المولود</b>
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
                                 <li>
                                    <a href="#plusDetail" data-toggle="tab">
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">معلومات اضافية</b>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#infoTasrih" data-toggle="tab">
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
                                    <a href="#image" data-toggle="tab">
                                    <i class="material-icons myPills">keyboard_arrow_left</i>
                                    <b class="droid-arabic-kufi">الصور</b>
                                    </a>
                                 </li>
                              </ul>
                           </div>
                           <!---end vertical pills-->
                        </div>
                        <!--  <form  action="tasrihP.php" method="get" class="tasrihForm">
                           <input type="hidden" name="numero" value="<?php echo $numero ?>">
                           <input type="hidden" name="annee" value="<?php echo $annee ?>">
                           <button  class="btn btn-success m-margin-left"  id="sumbitTasrihForm">
                                 <span class="btn-label">
                                     <i class="material-icons">insert_drive_file</i>
                                 </span>
                                 <b class="droid-arabic-kufi"> التوصيل </b>
                             </button>
                           </form>-->
                        <div style="text-align: center;margin-right: 17% ;">
                           <?php if($result['validate']==0){ ?>
                           <button class="btn btn-info m-margin-left" id="submitSbirthForm" type="submit">
                           <span class="btn-label">
                           <i class="material-icons">save</i>
                           </span>
                           <b class="droid-arabic-kufi"> حفظ </b>
                           </button>
                           <?php } ?>
                           <button class="btn btn-info m-margin-left" data-numero="<?php echo $numero?>" data-annee="<?php echo $annee?>" id="delSBirth">
                           <span class="btn-label">
                           <i class="material-icons">close</i>
                           </span>
                           <b class="droid-arabic-kufi"> حذف </b>
                           </button>
                           <!--<button id="submitSbirthForm" type="submit" class="btn btn-success btn-round btn-fab btn-fab-regular" rel="tooltip" title="حفظ" >
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
  
   <script src="assets/js/lightbox.js"></script>

  
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
         $('.sBirthFormUpdate').submit();
      });

      $('#sumbitTasrihForm').click( function() {
       $('.tasrihForm').submit();
      });

      $('#validateBirth').click(function(){
      $("#validation").replaceWith(`<li>
       <a href='#' class='dropdown-toggle' data-toggle='dropdown' rel='tooltip' title=' تم تأكيد الصلب'  data-placement='bottom'><img class="material-icons" style="width:40px;height:40px;display:inline;" src="svg/checked.svg">
       <p class='hidden-lg hidden-md'>Apps</p>
       </a>
       </li>
       `);
      });



      //DELETE **********
      $(document).ready(function(){

         $(document).on('click', '#delSBirth', function(e){

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
      		   		url: 'delSBirthDB.php',
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


      //image slider 
      const current = document.querySelector("#current");
const imgs = document.querySelectorAll(".imgs img");
const opacity = 0.6;

// Set first img opacity
imgs[0].style.opacity = opacity;

imgs.forEach(img => img.addEventListener("click", imgClick));

function imgClick(e) {
  // Reset the opacity
  imgs.forEach(img => (img.style.opacity = 1));

  // Change current image to src of clicked image
  current.src = e.target.src;

  // Add fade in class
  current.classList.add("fade-in");

  // Remove fade-in class after .5 seconds
  setTimeout(() => current.classList.remove("fade-in"), 500);

  // Change the opacity to opacity var
  e.target.style.opacity = opacity;
}
   </script>
</html>
<?php } ?>