<?php
require 'dbConnect.php';
$query='';
$output = '';
$pdoResult;
	$annee_epoux= $_POST['annee_epoux'];
	$numero_epoux= $_POST['numero_epoux'];
	if(trim($annee_epoux)!="" && trim($numero_epoux)!="")
{
	$query="SELECT `adad`,`sahifa`,`numero_sijil`,`type_rasm`,`nom_epoux_ar`,`nom_epouse_ar` FROM `avis_mariage` WHERE `numero_epoux`=? AND `annee_epoux`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero_epoux,$annee_epoux));
}
if(trim($annee_epoux)=="")
{
	$query="SELECT `adad`,`sahifa`,`numero_sijil`,`type_rasm`,`nom_epoux_ar`,`nom_epouse_ar` FROM `avis_mariage` WHERE `numero_epoux`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero_epoux));
}
if(trim($numero_epoux)=="")
{
	$query="SELECT `adad`,`sahifa`,`numero_sijil`,`type_rasm`,`nom_epoux_ar`,`nom_epouse_ar` FROM `avis_mariage` WHERE `annee_epoux`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($annee_epoux));
}


$result=$pdoResult->fetchAll();
if($pdoResult->rowCount()>0)
{
	?>

	<h4 class="droid-arabic-kufi m-title-color" style="margin-right : 7%"> نتائج البحث </h4>
	<table class="table "  width="860">
		<tr>
			<td>
				 <table  width="830" >
					 <thead class="text-primary droid-arabic-kufi">
						 <th style="text-align: center;width:12%;">العدد</th>
							<th style="text-align: center;width:15%;" >رقم السجل</th>
							<th style="text-align: center;width:15%;"> الصحيفة</th>
							<th style="text-align: center;width:15%;"> نوع الرسم</th>
							<th style="text-align: center;width:25%;">  اسم الزوجة</th>
							<th style="text-align: center;">اسم الزوج</th>
					</thead>
				 </table>
			</td>
		</tr>
		<tr>
			<td>
				 <div style="width:860px; height:200px; overflow:auto;">
					 <table class="table table-hover " width="840" id="tableAvisMariage">

	<?php
	foreach($result as $row)
	{
		?>
   <tr class="droid-arabic-kufi" style="width:860px">
    <td style="text-align: center;width:10%"><?php echo $row["adad"] ?></td>
    <td style="text-align: center;width:15%"><?php echo$row["numero_sijil"] ?></td>
    <td style="text-align: center;width:10%"><?php echo $row["sahifa"] ?></td>
	
	<?php
		if($row["type_rasm"]=="marriage")
		{
	?>
	<td style="text-align: center;width:15%">زواج</td>
	<?php
	} 
	?>

	<?php
		if($row["type_rasm"]=="tobout")
		{
	?>
	<td style="text-align: center;width:15%">ثبوت زوجية</td>
	<?php
	} 
	?>

	<?php
		if($row["type_rasm"]=="morajaa")
		{
	?>
	<td style="text-align: center;width:15%">مراجعة</td>
	<?php
	} 
	?>

    <?php
		if($row["type_rasm"]=="rijaa")
		{
	?>
	<td style="text-align: center;width:15%">رجعة</td>
	<?php
	} 
	?>

    <td style="text-align: center;width:20%"><?php echo $row["nom_epouse_ar"] ?></td>
    <td style="text-align: center;width:20%"><?php echo $row["nom_epoux_ar"] ?></td>
   </tr>
  <?php

}//end foreach
?>
</table>
</div>
</td>
</tr>
</table>
<?php
}
else
{
	?>
	<h3 style="text-align: center;color: red">لا توجد نتائج</h3>
	<?php
}
?>
