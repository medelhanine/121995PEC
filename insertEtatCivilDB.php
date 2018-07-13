<?php
require 'dbConnect.php';
$query='';
$output = '';
$pdoResult;
$i=1;

  $numero_etat_civil = $_POST['numero_etat_civil'];
	$numero_pere= $_POST['numero_pere'];
  $annee_pere= $_POST['annee_pere'];
//verify existance of all elements etat civil





//verify if etat civil exists
$query="SELECT `numero_etat_civil` FROM `etat_civil` WHERE `numero_etat_civil`=?";
$pdoResult = $pdoConnect->prepare($query);
$pdoResult->execute(array($numero_etat_civil));
$result=$pdoResult->fetch();
if($pdoResult->rowCount()>0)
{
  echo "alreadyExists";
}else { //if it's a new etat civil
  //insert pere
  //verify if father exists already in etat civil table
  $query="SELECT `numero_etat_civil`,`annee`,`numero` FROM `etat_civil` WHERE `numero`=? AND `annee`=? AND `type`=1";
  $pdoResult = $pdoConnect->prepare($query);
  $pdoResult->execute(array($numero_pere,$annee_pere));
  $result=$pdoResult->fetch();
  if($pdoResult->rowCount()>0)
  {
    echo "fatherAlreadyExists";
  }else {
    $query="SELECT `annee`,`numero` FROM `exbirth` WHERE `numero`=? AND `annee`=?";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoResult->execute(array($numero_pere,$annee_pere));
    $result=$pdoResult->fetch();
    if($pdoResult->rowCount()>0)
    {
    $query="INSERT INTO `etat_civil`(`numero_etat_civil`,`numero`,`annee`,`type`) VALUES (?,?,?,1)";
    $pdoResult = $pdoConnect->prepare($query);
    $pdoResult->execute(array($numero_etat_civil,$numero_pere,$annee_pere));

    //insert children
    while($i<17 && isset($_POST['numero_child_'.$i]))
    {
      $query="SELECT `numero_etat_civil`,`annee`,`numero` FROM `etat_civil` WHERE `numero`=? AND `annee`=? AND `type`=2";
      $pdoResult = $pdoConnect->prepare($query);
      $pdoResult->execute(array($_POST['numero_child_'.$i],$_POST['annee_child_'.$i]));
      $result=$pdoResult->fetch();
      if($pdoResult->rowCount()>0)
      {
        echo "child already exists";
      }else {
        $query="SELECT `annee`,`numero` FROM `exbirth` WHERE `numero`=? AND `annee`=?";
        $pdoResult = $pdoConnect->prepare($query);
        $pdoResult->execute(array($_POST['numero_child_'.$i],$_POST['annee_child_'.$i]));
        $result=$pdoResult->fetch();
        if($pdoResult->rowCount()>0)
        {
        $query="INSERT INTO `etat_civil`(`numero_etat_civil`,`numero`,`annee`,`type`) VALUES (?,?,?,2)";
        $pdoResult = $pdoConnect->prepare($query);
        $pdoResult->execute(array($numero_etat_civil,$_POST['numero_child_'.$i],$_POST['annee_child_'.$i]));
        }
        else
        {
        echo "child doesn't exist";
        }
      }
      $i++;
    }
    }
    else
    {
    echo "error father doesn't exist";
    }

  }
}

?>
