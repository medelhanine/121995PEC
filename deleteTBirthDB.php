<?php
require "dbConnect.php";
	$i=1;
	$id = $_POST["id"];
	$query = "DELETE FROM `torabirth` WHERE `id`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($id));

$query="SELECT `id`,`numero`, `annee`, `content_ar`, `content_fr` FROM `torabirth` WHERE `id`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($id));



	$result=$pdoResult->fetchAll();
if($pdoResult->rowCount()>0)
{


											foreach($result as $row)
											{
										?>

										 		<h4 class=" droid-arabic-kufi">

											  محتوى الطرة رقم <?php echo $i ?>

											  <button  class="btn btn-default btn-round btn-fab btn-fab-mini m-button-mini" rel="tooltip" title="حذف الطرة" data-id="<?php echo $row["id"]?>" id="delTBirth">
												<i class="material-icons">close</i>
											</button>


											<button  class="btn btn-default btn-round btn-fab btn-fab-mini m-button-mini updateTBirth" rel="tooltip" title="تغيير"  >
												<i class="material-icons">edit</i>
											</button>

											 </h4>

											<div class="row">
											<form action="updateTBirthDB.php" method="post" class="tBirthupdateForm">
										<input type="hidden" name="id" value="<?php echo $row["id"] ?>">
									  	<div class="col-md-6">
									  	<textarea class="form-control m-input-fr" rows="5" name="content_fr" style="white-space: normal;" disabled>
									  	<?php echo $row["content_fr"] ?>
									  	</textarea>
									  </div>
									  <div class="col-md-6">
									  	<textarea class="form-control droid-arabic-kufi" rows="5" name="content_ar" style="white-space: normal;" disabled>
									  	<?php echo $row["content_ar"] ?>
									  	</textarea>
									  </div>
										  <div class="updateFormBtn" style="display: none;text-align: center">
										  	<button type="submit" class="btn btn-success">
											  <span class="btn-label">
											  <i class="material-icons">save</i>
											  </span>
											  <b class="droid-arabic-kufi"> حفظ</b>
											  </button>
											 </div>
											 </form>
									  </div>



									  <br><br>
									  <?php
											$i++;
											}
}

?>
