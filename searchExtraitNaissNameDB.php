<?php
require 'dbConnect.php';


$query='';

$output = '';

$pdoResult;


//search by name

	$nameAr= $_POST['nameAr'];
	$nameFr = $_POST['nameFr'];
	if(trim($nameAr)!="" && trim($nameFr)!="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar` FROM `exbirth` WHERE `nom_ar`=? AND `nom`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($nameAr,$nameFr));
}
if(trim($nameAr)=="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar` FROM `exbirth` WHERE `nom`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($nameFr));
}

if(trim($nameFr)=="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar` FROM `exbirth` WHERE `nom_ar`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($nameAr));
}




$result=$pdoResult->fetchAll();

if($pdoResult->rowCount()>0)
{
	?>
	<h4 class="droid-arabic-kufi m-title-color" style="margin-right : 7%"> نتائج البحث </h4>
	<table class="table table-hover "  width="865">
		<tr>
			<td>
				 <table  width="840" >
					 <thead class="text-primary droid-arabic-kufi">
						 <th style="text-align: center">الرقم</th>
							<th style="text-align: center" >السنة</th>
							<th style="text-align: center">الإسم الشخصي</th>
							<th style="text-align: center">الإسم العائلي</th>

					</thead>
				 </table>
			</td>
		</tr>
		<tr>
			<td>
				 <div style="width:860px; height:200px; overflow:auto;">
					 <table class="table table-hover " width="840" id="tableExtBirth">


	<?php

	foreach($result as $row)
	{
	?>
   <tr>
    <td style="text-align: center"><?php echo $row["numero"]?></td>
    <td style="text-align: center"><?php echo $row["annee"]?></td>
		<td style="text-align: center"><?php echo $row["prenom_ar"]?></td>
    <td style="text-align: center"><?php echo $row["nom_ar"]?></td>


   </tr>

 <?php
	}
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
