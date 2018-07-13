<?php
require "dbConnect.php";
	$i=1;
	$numero_etat_civil = $_POST["numero_etat_civil"];
  $numero = $_POST["numero"];
  $annee = $_POST["annee"];

	$query = "DELETE FROM `etat_civil` WHERE `numero`=? AND `annee`=? AND type=2";
$pdoResult = $pdoConnect->prepare($query);
$pdoExec = $pdoResult->execute(array($numero,$annee));

$query="SELECT * FROM `etat_civil` WHERE `numero_etat_civil`=?";
	$pdoResult = $pdoConnect->prepare($query);
	$pdoResult->execute(array($numero_etat_civil));
	$result=$pdoResult->fetchAll();
  if($pdoResult->rowCount()>0)
  {
			foreach($result as $row)
			{
        ?>
        <h4 class=" droid-arabic-kufi m-title-color">
    الإبن رقم <?php echo $i ?>
        <button  class="btn btn-default btn-round btn-fab btn-fab-mini m-button-mini" rel="tooltip" title="حذف الإبن " data-numero_etat_civil="<?php echo $numero_etat_civil ?>" data-numero="<?php echo $row["numero"]?>" data-annee="<?php echo $row["annee"]?>" id="delChild">
        <i class="material-icons">close</i>
      </button>
      <button  class="btn btn-default btn-round btn-fab btn-fab-mini m-button-mini updateChild" rel="tooltip" title="تغيير"  >
        <i class="material-icons">edit</i>
      </button>
       </h4>
      <div class="row">
      <form action="updateChildDB.php" method="post" class="childupdateForm">
        <input type="hidden" name="numero_etat_civil" value="<?php echo $numero_etat_civil ?>">
      <div class="col-md-6">
        <div class="form-group label-floating">
      <label class="control-label m-label-form droid-arabic-kufi"> السنة </label>
      <input type="hidden" name="original_annee" value="<?php echo $row["annee"] ?>">
      <input type="text" name="annee" value="<?php echo $row["annee"] ?>" class="form-control" required readonly>
    </div>
    </div>
    <div class="col-md-6">
      <div class="form-group label-floating">
        <label class="control-label m-label-form droid-arabic-kufi">  الرقم </label>
        <input type="hidden" name="original_numero" value="<?php echo $row["numero"] ?>">
        <input type="text" name="numero" value="<?php echo $row["numero"] ?>" class="form-control" required>
      </div>
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
