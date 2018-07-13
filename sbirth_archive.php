

<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'etat_civil_db';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
mysqli_set_charset($mysqli,"utf8");

$request = $_REQUEST;




//create collumn like table in datatabase
$collumn = array(
  0 => 'numero',
  1 => 'annee',
  2 => 'prenom_ar',
  3 => 'nom_ar',
);

$sql= "SELECT `numero`,`annee`,`prenom_ar`,`nom_ar` FROM sbirth";
$query = mysqli_query($mysqli,$sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

$sql ="SELECT * FROM sbirth WHERE 1 ";
if(!empty($request['search']['value'])){
    $sql.=" AND (numero Like '".$request['search']['value']."%' ";
    $sql.=" OR annee Like '".$request['search']['value']."%' ";
    $sql.=" OR prenom_ar Like '".$request['search']['value']."%' ";
    $sql.=" OR nom_ar Like '".$request['search']['value']."%' )";
}

$query = mysqli_query($mysqli,$sql);
$totalData = mysqli_num_rows($query);
$sql.="  LIMIT ".$request['start']." ,".$request['length']."   ";
$query = mysqli_query($mysqli,$sql);
$data = array();

while($row=mysqli_fetch_array($query))
{
  $subdata= array();
  $subdata[]='<tr style="cursor: pointer;" data-numero="'.$row["numero"].'"><div  style="text-align: center;font-size: 0.95em;">'.$row['numero'].'</div>'; // numero
  $subdata[]='<div style="text-align: center;font-size: 0.95em;">'.$row['annee'].'</div>'; // annee
  $subdata[]='<div style="text-align: center;font-size: 0.95em;">'.$row['prenom_ar'].'</div>'; // prenom_ar
  $subdata[]='<div style="text-align: center;font-size: 0.95em;">'.$row['nom_ar'].'</div></tr>'; // nom_ar

  $data[]= $subdata;
}

$json_data = array(
  "draw"          => intval($request['draw']),
  "recordsTotal"  => intval($totalData),
  "recordsFilter" => intval($totalFilter),
  "data" => $data
);

echo json_encode($json_data);
?>
