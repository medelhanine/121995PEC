
<?php
$request = $_REQUEST;
require "dbConnect.php";
$numero = $request["numero"];
$annee = $request["annee"];
$table = $request["table"];
$folder = $request["folder"];


$query="SELECT  * FROM $table WHERE `numero`=? AND `annee`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($numero,$annee));

$ds          = DIRECTORY_SEPARATOR;
$storeFolder = $numero.".".$annee;   //2

if($numero !="" && $annee !="")
{


    $j=1;
     $folder = "uploads/".$folder."/".$numero.".".$annee."/";

       $images = glob($folder."*.*");
       if(count($images) > 0 )
       {

?>
<form action="printScans.php" method="get">
  <input type="hidden" name="numero" value="<?php echo $numero ?>">
  <input type="hidden" name="annee" value="<?php echo $annee ?>">
  <div class="" style="text-align:center">
    <button type="submit"  id="" class="btn btn-default btn-round btn-fab btn-fab-regular droid-arabic-kufi" style="margin-bottom:10px;margin-left:10px" rel="tooltip" title="طباعة الصور "> <i class="material-icons">print</i></button>
    <button type="button"  id="more_data_btn" class="btn btn-default btn-round btn-fab btn-fab-regular droid-arabic-kufi" style="margin-bottom:10px;" rel="tooltip" title="معلومات إضافية "> <i class="material-icons">more_horiz</i></button>
  </div>

</form>


  <div class="more_data" style="display : none">
    <?php
    $result=$pdoResult->fetch();
    if($pdoResult->rowCount()>0)
    {
      ?>
      <div style="margin-bottom:40px">
        <b class="droid-arabic-kufi"> الإسم الشخصي :</b>
       <b class="droid-arabic-kufi"> <?php echo $result["prenom_ar"] ?> </b><br>

          <b class="droid-arabic-kufi"> الإسم العائلي :</b>
         <b class="droid-arabic-kufi"> <?php echo $result["nom_ar"] ?> </b> <br>

        <b class="droid-arabic-kufi"> تاريخ الولادة :</b>
       <b class="droid-arabic-kufi"> <?php echo $result["date_naiss_miladi"] ?> </b><br>

       <b class="droid-arabic-kufi"> اسم الأب :</b>
      <b class="droid-arabic-kufi"> <?php echo $result["nom_pere_ar"] ?> </b><br>

      <b class="droid-arabic-kufi">اسم الأم :</b>
     <b class="droid-arabic-kufi"> <?php echo $result["nom_mere_ar"] ?> </b><br>
        </div>
      </div>


  <?php } ?>
  </div>

<div class="container">

   <div class="main-img" id="main_img" style="margin-top: 5px;">

     <img src="<?php echo $images[0] ?>"   id="current">

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
     ?>

   </div>
   <?php
 }else{

   $result=$pdoResult->fetch();
   if($pdoResult->rowCount()>0)
   {
   ?>
   <div style="margin-bottom:40px">
     <b class="droid-arabic-kufi"> الإسم الشخصي :</b>
    <b class="droid-arabic-kufi"> <?php echo $result["prenom_ar"] ?> </b><br>

       <b class="droid-arabic-kufi"> الإسم العائلي :</b>
      <b class="droid-arabic-kufi"> <?php echo $result["nom_ar"] ?> </b> <br>

     <b class="droid-arabic-kufi"> تاريخ الولادة :</b>
    <b class="droid-arabic-kufi"> <?php echo $result["date_naiss_miladi"] ?> </b><br>

    <b class="droid-arabic-kufi"> اسم الأب :</b>
   <b class="droid-arabic-kufi"> <?php echo $result["nom_pere_ar"] ?> </b><br>

   <b class="droid-arabic-kufi">اسم الأم :</b>
   <b class="droid-arabic-kufi"> <?php echo $result["nom_mere_ar"] ?> </b><br>
     </div>
   <h3 style="text-align: center;color:#EF6C00">لا توجد صور </h3>


   <?php
 }
 }
   ?>


 </div>
 <?php
 }
 ?>

 <script type="text/javascript">
 $(document).ready(function(){
   $("#more_data_btn").click(function () {
           $(".more_data").toggle();
       });
 });

 //gallery js
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
