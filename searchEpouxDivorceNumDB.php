<?php
require 'dbConnect.php';
$query='';
$output = '';
$pdoResult;
	$annee_epouxDivorce= $_POST['annee_epouxDivorce'];
	$numero_epouxDivorce= $_POST['numero_epouxDivorce'];
	if(trim($annee_epouxDivorce)!="" && trim($numero_epouxDivorce)!="")
{
	$query="SELECT `adad`,`sahifa`,`numero_sijil`,`type_divorce`,`nom_motalak_ar`,`nom_motalaka_ar` FROM `avis_divorce` WHERE `numero_motalak`=? AND `annee_motalak`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero_epouxDivorce,$annee_epouxDivorce));
}
if(trim($annee_epouxDivorce)=="")
{
	$query="SELECT `adad`,`sahifa`,`numero_sijil`,`type_divorce`,`nom_motalak_ar`,`nom_motalaka_ar` FROM `avis_divorce` WHERE `numero_motalak`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero_epouxDivorce));
}
if(trim($numero_epouxDivorce)=="")
{
	$query="SELECT `adad`,`sahifa`,`numero_sijil`,`type_divorce`,`nom_motalak_ar`,`nom_motalaka_ar` FROM `avis_divorce` WHERE `annee_motalak`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($annee_epouxDivorce));
}


$result=$pdoResult->fetchAll();
if($pdoResult->rowCount()>0)
{
	?>

	<h4 class="droid-arabic-kufi m-title-color" style="margin-right : 7%"> نتائج البحث </h4>
	<table class="table"  width="860">
		<tr>
			<td>
				 <table  width="830" >
					 <thead class="text-primary droid-arabic-kufi">
						 <th style="text-align: center;width:12%;">العدد</th>
							<th style="text-align: center;width:15%;" >رقم السجل</th>
							<th style="text-align: center;width:15%;"> الصحيفة</th>
							<th style="text-align: center;width:15%;"> نوع الطلاق</th>
							<th style="text-align: center;width:25%;">  اسم المطلقة</th>
							<th style="text-align: center;">اسم المطلق</th>
					</thead>
				 </table>
			</td>
		</tr>
		<tr>
			<td>
				 <div style="width:860px; height:200px; overflow:auto;">
					 <table class="table table-hover " width="840" id="tableAvisDivorce">

	<?php
	foreach($result as $row)
	{
		?>
   <tr class="droid-arabic-kufi" style="width:860px">
    <td style="text-align: center;width:10%"><?php echo $row["adad"] ?></td>
    <td style="text-align: center;width:15%"><?php echo$row["numero_sijil"] ?></td>
    <td style="text-align: center;width:10%"><?php echo $row["sahifa"] ?></td>
	
	<?php
		if($row["type_divorce"]=="rijii")
		{
	?>
	<td style="text-align: center;width:15%">رجعي</td>
	<?php
	} 
	?>

	<?php
		if($row["type_divorce"]=="kabl_binaa")
		{
	?>
	<td style="text-align: center;width:15%"> قبل البناء</td>
	<?php
	} 
	?>

	<?php
		if($row["type_divorce"]=="khilii")
		{
	?>
	<td style="text-align: center;width:15%">خلعي</td>
	<?php
	} 
	?>

    <?php
		if($row["type_divorce"]=="momlak")
		{
	?>
	<td style="text-align: center;width:15%">مملك</td>
	<?php
	} 
	?>

    <?php
		if($row["type_divorce"]=="mokamil_talat")
		{
	?>
	<td style="text-align: center;width:15%">مكمل للثلاث</td>
	<?php
	} 
	?>

    <td style="text-align: center;width:20%"><?php echo $row["nom_motalaka_ar"] ?></td>
    <td style="text-align: center;width:20%"><?php echo $row["nom_motalak_ar"] ?></td>
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