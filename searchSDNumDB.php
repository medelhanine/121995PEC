<?php
require 'dbConnect.php';


$query='';

$output = '';

$pdoResult;

	$numero= $_POST['numero'];
	$annee = $_POST['annee'];
	if(trim($numero)!="" && trim($annee)!="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar`,`validate` FROM `sdeadtable` WHERE `numero`=? AND `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero,$annee));
}
if(trim($numero)=="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar`,`validate` FROM `sdeadtable` WHERE `annee`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($annee));
}

if(trim($annee)=="")
{
	$query="SELECT `numero`,`annee`,`prenom_ar`,`nom_ar`,`validate` FROM `sdeadtable` WHERE `numero`=?";
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
						 <th style="text-align: center;width:100px;">الرقم</th>
							<th style="text-align: center;width:150px;" >السنة</th>
							<th style="text-align: center;width:250px;">الإسم الشخصي</th>
							<th style="text-align: center;width:240px;">الإسم العائلي</th>
							<th style="text-align: center;"></th>

					</thead>
				 </table>
			</td>
		</tr>
		<tr>
			<td>
				 <div style="width:860px; height:200px; overflow:auto;">
					 <table class="table table-hover " width="840" id="tableSDeath">
	<?php
	foreach($result as $row)
	{
		if($row["validate"]==1)
		{


?>

<tr class="droid-arabic-kufi">
 <td style="text-align: center;color:green;"><?php echo $row["numero"] ?></td>
 <td style="text-align: center;color:green;"><?php echo$row["annee"] ?></td>
 <td style="text-align: center;color:green;"><?php echo $row["prenom_ar"] ?></td>
 <td style="text-align: center;color:green;"><?php echo $row["nom_ar"] ?></td>
<td style="text-align: center;color:green;"><i class="material-icons">check_circle</i></td>
</tr>
  <?php
}//end test if solb is validate
else{
	?>
	<tr class="droid-arabic-kufi">
	 <td style="text-align: center;"><?php echo $row["numero"] ?></td>
	 <td style="text-align: center;"><?php echo$row["annee"] ?></td>
	 <td style="text-align: center;"><?php echo $row["prenom_ar"] ?></td>
	 <td style="text-align: center;"><?php echo $row["nom_ar"] ?></td>
	 <td style="text-align: center;color :#EF6C00"><i class="material-icons">warning</i></td>
	</tr>
	<?php
}
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
