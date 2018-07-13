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
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar` FROM `acte_deces` WHERE `nom_ar`=? AND `nom`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($nameAr,$nameFr));
}
if(trim($nameAr)=="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar` FROM `acte_deces` WHERE `nom`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($nameFr));
}

if(trim($nameFr)=="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar` FROM `acte_deces` WHERE `nom_ar`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($nameAr));
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
						 <th style="text-align: center;width:100px;">الرقم</th>
							<th style="text-align: center;width:150px;" >السنة</th>
							<th style="text-align: center;width:250px;">الإسم الشخصي</th>
							<th style="text-align: center;width:240px;">الإسم العائلي</th>
					

					</thead>
				 </table>
			</td>
		</tr>
		<tr>
			<td>
				 <div style="width:860px; height:200px; overflow:auto;">
					 <table class="table table-hover " width="840" id="tableActeDeces">

	<?php

	foreach($result as $row)
	{
	?>

	<tr class="droid-arabic-kufi">
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
