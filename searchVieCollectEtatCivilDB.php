<?php
require 'dbConnect.php';
$query='';
$output = '';
$pdoResult;
$i=1;
	$numero_etat_civil= $_POST['numero_etat_civil'];

//search father
$query="SELECT exbirth.prenom_ar,exbirth.prenom FROM exbirth LEFT JOIN etat_civil ON exbirth.numero = etat_civil.numero AND exbirth.annee = etat_civil.annee WHERE etat_civil.numero_etat_civil =? AND etat_civil.type=1";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($numero_etat_civil));
$result=$pdoResult->fetch();

if($pdoResult->rowCount()>0)
{
?>
<!--add father--->
<h3 class="droid-arabic-kufi">إضافة الأب</h3>
<div class="col-md-6">
<div class="form-group label-floating">
<label class="control-label m-label-form droid-arabic-kufi">Nom  </label>
<input type="text" name="prenom_pere"  class="form-control" value="<?php echo $result["prenom"] ?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group label-floating">
<label class="control-label m-label-form droid-arabic-kufi">  الإسم</label>
<input type="text" name="prenom_pere_ar"  class="form-control" value="<?php echo $result["prenom_ar"] ?>">
</div>
</div>
<!--end add father-->
<?php
}
else
{
	?>

	<h3 style="color:red">لا توجد نتائج  الأب</h3>
	<?php
}


//children
$query="SELECT exbirth.prenom_ar,exbirth.prenom,exbirth.nom_ar,exbirth.nom,exbirth.lieu_naiss_ar,exbirth.lieu_naiss ,exbirth.date_naiss_miladi FROM exbirth LEFT JOIN etat_civil ON exbirth.numero = etat_civil.numero AND exbirth.annee = etat_civil.annee WHERE etat_civil.numero_etat_civil =? AND etat_civil.type=2";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($numero_etat_civil));
$result=$pdoResult->fetchAll();

if($pdoResult->rowCount()>0)
{

?>
<h3 class="droid-arabic-kufi">إضافة الأبناء</h3>
<div class="row">
 <div class="table-responsive col-md-12" style="margin-left: 20%">
<table class="table table-hover droid-arabic-kufi ">
	<thead class="text-primary">
			<th style="text-align: center"></th>
		 <th style="text-align: center"> الإسم الشخصي</th>
		 <th style="text-align: center"> Prenom </th>
		 <th style="text-align: center">مكان الإزدياد </th>
		 <th style="text-align: center">Lieu de naissance </th>
		 <th style="text-align: center">تاريخ الإزدياد</th>

	</thead>
<tbody >
<?php
foreach($result as $row)
{
?>
<input type="hidden" name="child_prenom_ar<?php echo  $i ?>"  value="<?php echo $row["prenom_ar"] ?>">
<input type="hidden" name="child_prenom<?php echo $i ?>" value="<?php echo $row["prenom"] ?>">
<input type="hidden" name="child_nom_ar<?php echo $i ?>" value="<?php echo $row["nom_ar"] ?>">
<input type="hidden" name="child_nom<?php echo $i ?>" value="<?php echo $row["nom"] ?>">
<input type="hidden" name="child_lieu_naiss_ar<?php echo $i ?>" value="<?php echo $row["lieu_naiss_ar"] ?>">
<input type="hidden" name="child_lieu_naiss<?php echo $i ?>" value="<?php echo $row["lieu_naiss"] ?>">
<input type="hidden" name="child_date_naiss<?php echo $i ?>" value="<?php echo $row["date_naiss_miladi"] ?>">
<tr class="droid-arabic-kufi" style="text-align: center">
	<td><?php echo " الإبن رقم".$i ?></td>
    <td><?php echo $row["prenom_ar"] ?></td>
	<td><?php echo $row["prenom"] ?></td>
	<td><?php echo $row["lieu_naiss_ar"] ?></td>
	<td><?php echo $row["lieu_naiss"] ?></td>
    <td><?php echo $row["date_naiss_miladi"] ?></td>
</tr>
<?php
$i++;
}
?>
</tbody>
</table>
<br><br>
</div>
</div>
<?php
}
else
{
	?>
	<h3 style="color:red">لا توجد نتائج الأبناء</h3>
	<?php

?>

<?php
}
?>
