<?php
require 'dbConnect.php';
$ds          = DIRECTORY_SEPARATOR;  //1

$id_user=$_POST["id_user"];
echo $id_user;
$storeFolder = $id_user;   //2
if (!empty($_FILES)) {

   $file = $_FILES['file'];
$fileName = $_FILES['file']['name'];
$fileTmpName  = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];
$fileType = $_FILES['file']['type'];
$fileExt = explode('.',$fileName);
$fileActualExt = strtolower(end($fileExt));

      $fileNameNew = uniqid('',true).".".$fileActualExt;
	mkdir(dirname( __FILE__ ) .$ds."uploads".$ds."profile".$ds);
    $targetPath = dirname( __FILE__ ) .$ds."uploads".$ds."profile".$ds;  //4

    $targetFile =  $targetPath.$fileNameNew;  //5

    move_uploaded_file($fileTmpName,$targetFile); //6




	$query = '';
$pdoResult;


				$query ="INSERT INTO `scan` (`folder_name`) VALUES(?)";
		$pdoResult = $pdoConnect->prepare($query);
		$pdoExec = $pdoResult->execute(array($storeFolder));
    echo "success";

}
?>
