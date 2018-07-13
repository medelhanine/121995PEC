<?php
require 'dbConnect.php';


$query='';

$output = '';

$pdoResult;

	$numero= $_POST['numero'];
	$annee = $_POST['annee'];
	if(trim($numero)!="" && trim($annee)!="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar` FROM `exbirth` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
}
if(trim($numero)=="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar` FROM `exbirth` WHERE `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($annee));
}

if(trim($annee)=="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar` FROM `exbirth` WHERE `numero`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero));
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
	<tr class="droid-arabic-kufi">
	 <td style="text-align: center;"><?php echo $row["numero"] ?></td>
	 <td style="text-align: center;"><?php echo$row["annee"] ?></td>
	 <td style="text-align: center;"><?php echo $row["prenom_ar"] ?></td>
	 <td style="text-align: center;"><?php echo $row["nom_ar"] ?></td>

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
