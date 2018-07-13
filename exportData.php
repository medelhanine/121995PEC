<?php

session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: login/error.php");
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $username = $_SESSION['username'];
    //$superUser = $_SESSION['superUser'];
}



date_default_timezone_set('UTC');
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'etat_civil_db';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
mysqli_set_charset($mysqli,"utf8");

$request = $_REQUEST;
$ActualDate = date('d/m/Y');
$anneActu = substr($ActualDate,6,4);

$request = $_REQUEST;


$sql ="SELECT * FROM sbirth WHERE 1 ";


//annee
if(isset($request['annee']))
{
  if($request['annee']== "all")
  {
    $sql .= "  ";
  }
  else{
  $decade =   $request['annee']+10;
    $sql .= " AND annee >= '".$request['annee']."' AND annee < '".$decade."' ";
  }

}


//numero
if(isset($request['numero']))
{
  if($request['numero']== "all")
  {
    $sql .= "  ";
  }

  if($request['numero']== "0-300")
  {
      $sql .= " AND numero >0 AND numero <=300 ";
  }

  if($request['numero']== "300-600")
  {
      $sql .= " AND numero >300 AND numero <=600 ";
  }
  if($request['numero']== "600-900")
  {
      $sql .= " AND numero >600 AND numero <=900 ";
  }
  if($request['numero']== "900-1200")
  {
      $sql .= " AND numero >900 AND numero <=1200 ";
  }
  if($request['numero']== "1200-1500")
  {
      $sql .= " AND numero >1200 AND numero <=1500 ";
  }
  if($request['numero']== "1500-1800")
  {
      $sql .= " AND numero >1500 AND numero <=1800 ";
  }
  if($request['numero']== "1800-2100")
  {
      $sql .= " AND numero >1800 AND numero <=2100 ";
  }
  if($request['numero']== "2100-2400")
  {
      $sql .= " AND numero >2100 AND numero <=2400 ";
  }
  if($request['numero']== "2400-2700")
  {
      $sql .= " AND numero >2400 AND numero <=2700 ";
  }
  if($request['numero']== "2700-3000")
  {
      $sql .= " AND numero >2700 AND numero <=3000 ";
  }
  if($request['numero']== ">3000")
  {
      $sql .= " AND numero >3000  ";
  }
}

//prenom_ar
if(isset($request['prenom_ar']))
{
  if($request['prenom_ar']== "all")
  {
    $sql .= "  ";
  }
  else{
    $sql .= " AND prenom_ar LIKE '".$request['prenom_ar']."%' ";
  }

}

//nom_ar
if(isset($request['nom_ar']))
{
  if($request['nom_ar']== "all")
  {
    $sql .= "  ";
  }
  else{
    $sql .= " AND nom_ar LIKE '".$request['nom_ar']."%' ";
  }

}

//lieu_naiss_ar
if(isset($request['lieu_naiss']))
{
  if($request['lieu_naiss']== "all")
  {
    $sql .= "  ";
  }
  else{
    $sql .= " AND lieu_naiss_ar LIKE '".$request['lieu_naiss']."%' ";
  }

}

//niveau_scol_pere
if(isset($request['niveau_scol_pere']))
{
    if($request['niveau_scol_pere']== "all")
    {
        $sql .= "  ";
    }else{
        $sql .= " AND niveau_scol_pere_ar = '". $request['niveau_scol_pere']."'  ";
    }
}

//niveau_scol_mer
if(isset($request['niveau_scol_mer']))
{
    if($request['niveau_scol_mer']== "all")
    {
        $sql .= "  ";
    }else{
        $sql .= " AND niveau_scol_mer_ar = '". $request['niveau_scol_mer']."'  ";
    }
}

//ordre_naiss
if(isset($request['ordre_naiss']))
{
    if($request['ordre_naiss']== "all")
    {
        $sql .= "  ";
    }else{
        $sql .= " AND ordre_naiss = '". $request['ordre_naiss']."'  ";
    }
}

//profession mere
if(isset($request['profession_mere']))
{
    if($request['profession_mere']== "all")
    {
        $sql .= "  ";
    }else{
        $sql .= " AND profession_mere_ar = '". $request['profession_mere']."'  ";
    }
}

//profession_pere
if(isset($request['profession_pere']))
{
  if($request['profession_pere']== "all")
  {
    $sql .= "  ";
  }
  else{
    $sql .= " AND profession_pere_ar LIKE '".$request['profession_pere']."%' ";
  }

}

 //nom_mere
 if(isset($request['nom_mere']))
 {
     if($request['nom_mere']== "all")
     {
         $sql .= "  ";
     }else{
         $sql .= " AND nom_mere_ar LIKE '". $request['nom_mere']."%'  ";
     }
 }

 //nom_pere
 if(isset($request['nom_pere']))
 {
     if($request['nom_pere']== "all")
     {
         $sql .= "  ";
     }else{
         $sql .= " AND nom_pere_ar LIKE '". $request['nom_pere']."%'  ";
     }
 }



 //officier_etat_civil
 if(isset($request['officier_etat_civil']))
 {
     if($request['officier_etat_civil']== "all")
     {
         $sql .= "  ";
     }else{
         $sql .= " AND officier_etat_civil_ar LIKE '". $request['officier_etat_civil']."%'  ";
     }
 }


//gender
if(isset($request['sex']))
{
  if($request['sex']== "all")
  {
    $sql .= "  ";
  }
  else{
    $sql .= " AND sex = '".$request['sex']."' ";
  }

}
$query = mysqli_query($mysqli,$sql);
header('Content-Type: application/xls');
header('Content-Disposition: attachment; filename=انتقاءـالبيانات.xls');
?>

<table class="table" bordered="1">  
                    <tr>  
                         <th>الرقم</th>  
                         <th>السنة</th>  
                         <th>الإسم الشخصي</th>  
                          <th>الإسم العائلي </th>
                          <th>الجنس</th>
                          <th>مكان الإزدياد</th>
                          <th> اسم الأم</th>
                          <th> اسم الأب</th>
                          <th> مهنة الأم</th>
                          <th>  المستوى الدراسي للأم</th>
                          <th>مهنة الأب</th>
                          <th>  المستوى الدراسي للأب</th>
                          <th>رتبة الولادة </th>
                          <th> ضابط الحالة المدنية </th>
                    </tr>
<?php
while($row=mysqli_fetch_array($query))
{
?>
  <tr>
    <td style="text-align:center"><?php echo $row["numero"] ?></td>
    <td style="text-align:center"><?php echo $row["annee"] ?></td>
    <td style="text-align:center"><?php echo $row["prenom_ar"] ?></td>
    <td style="text-align:center"><?php echo $row["nom_ar"] ?></td>
    
    <td style="text-align:center">
    <?php
     if($row["sex"]=="feminin")
    {
      echo "أنثى";
    }else {
      echo "ذكر";
    }   
    ?>
    </td>
    <td style="text-align:center"><?php echo $row["lieu_naiss_ar"] ?></td>
    <td style="text-align:center"><?php echo $row["nom_mere_ar"] ?></td>
    <td style="text-align:center"><?php echo $row["nom_pere_ar"] ?></td>
    <td style="text-align:center"><?php echo $row["profession_mere_ar"] ?></td>
    <td style="text-align:center"><?php echo $row["niveau_scol_mer_ar"] ?></td>
    <td style="text-align:center"><?php echo $row["profession_pere_ar"] ?></td>
    <td style="text-align:center"><?php echo $row["niveau_scol_pere_ar"] ?></td>
    <td style="text-align:center"><?php echo $row["ordre_naiss"] ?></td>
    <td style="text-align:center"><?php echo $row["officier_etat_civil_ar"] ?></td>
  </tr>
<?php
}
?>
</table>
<?php
?>

