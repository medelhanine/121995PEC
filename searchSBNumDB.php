<?php
require 'dbConnect.php';
$query='';
$output = '';
$pdoResult;
	$numero= $_POST['numero'];
	$annee= $_POST['annee'];
	if(trim($numero)!="" && trim($annee)!="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar`,`validate`,`sejil_categ` FROM `sbirth` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
}
if(trim($numero)=="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar`,`validate`,`sejil_categ` FROM `sbirth` WHERE `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($annee));
}
if(trim($annee)=="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar`,`validate`,`sejil_categ` FROM `sbirth` WHERE `numero`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero));
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
						 <th style="text-align: center;width:15%;">الرقم</th>
							<th style="text-align: center;width:20%;" >السنة</th>
							<th style="text-align: center;width:20%;">الإسم الشخصي</th>
							<th style="text-align: center;width:20%;">الإسم العائلي</th>
							<th style="text-align: center;width:30%;"> نوع السجل</th>
							<th style="text-align: center;width:0%">مراقبة</th>
					</thead>
				 </table>
			</td>
		</tr>
		<tr>
			<td>
				 <div style="width:860px; height:200px; overflow:auto;">
					 <table class="table table-hover " width="840" id="tableSBirth">

	<?php
	foreach($result as $row)
	{
		?>
   <tr class="droid-arabic-kufi" style="width:860px">
    <td style="text-align: center;width:15%"><?php echo $row["numero"] ?></td>
    <td style="text-align: center;width:15%"><?php echo$row["annee"] ?></td>
    <td style="text-align: center;width:20%"><?php echo $row["prenom_ar"] ?></td>
	<td style="text-align: center;width:20%"><?php echo $row["nom_ar"] ?></td>
	<?php
		if($row["sejil_categ"]=="naissance")
		{
	?>
	<td style="text-align: center;width:20%">الولادات</td>
	<?php
	} 
	?>

	<?php
		if($row["sejil_categ"]=="tasarih")
		{
	?>
	<td style="text-align: center;width:20%">التصاريح</td>
	<?php
	} 
	?>

	<?php
		if($row["sejil_categ"]=="ahkam")
		{
	?>
	<td style="text-align: center;width:20%">الأحكام</td>
	<?php
	} 
	?>

	<?php
	if($row["validate"]==1)
	{
?>
		<td style="text-align: center;color:green;width:10%"><i class="material-icons">check_circle</i></td>
		<?php 
		}else {
			?>
				<td style="text-align: center;color :#EF6C00;width:10%"><i class="material-icons">warning</i></td>
			<?php
		}?>
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
