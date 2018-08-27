<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'etat_civil_db';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
mysqli_set_charset($mysqli,"utf8");

$request = $_REQUEST;
$ActualDate = date('d/m/Y');
$anneActu = substr($ActualDate,6,4);

//create collumn like table in datatabase
$collumn = array(
  0 => 'numero',
  1 => 'annee',
  2 => 'prenom_ar',
  3 => 'nom_ar',
);

$sql= "SELECT `numero`, `annee`, `prenom_ar`, `prenom`, `nom_ar`, `nom`, `prenom_tora_ar`, `prenom_tora`, `nom_tora_ar`, `nom_tora`, `cine`, `lieu_deces_ar`, `lieu_deces`, `commune_ar`, `commune`, `date_deces_miladi`, `date_deces_hijri`, `date_deces_miladi_ar`, `date_deces_hijri_ar`, `date_deces_miladi_fr`, `date_deces_hijri_fr`, `heure`, `minute`, `sex`, `lieu_naissance_ar`, `lieu_naissance`, `date_naiss_miladi`, `date_naiss_hijri`, `date_naiss_miladi_ar`, `date_naiss_hijri_ar`, `date_naiss_miladi_fr`, `date_naiss_hijri_fr`, `profession_ar`, `profession`, `prof_categ`, `nationalite_ar`, `nationalite`, `domicile_ar`, `domicile`, `etat_familiale`, `mr_mme_ar`, `mr_mme`, `nom_pere_ar`, `nom_pere`, `dead_pere`, `nationalite_pere_ar`, `nationalite_pere`, `domicile_pere_ar`, `domicile_pere`, `ne_a_pere_ar`, `ne_a_pere`, `date_naiss_pere_miladi`, `date_naiss_pere_hijri`, `date_naiss_pere_miladi_ar`, `date_naiss_pere_hijri_ar`, `date_naiss_pere_miladi_fr`, `date_naiss_pere_hijri_fr`, `profession_pere_ar`, `profession_pere`, `nom_mere_ar`, `nom_mere`, `dead_mere`, `nationalite_mere_ar`, `nationalite_mere`, `domicile_mere_ar`, `domicile_mere`, `ne_a_mere_ar`, `ne_a_mere`, `date_naiss_mere_miladi`, `date_naiss_mere_hijri`, `date_naiss_mere_miladi_ar`, `date_naiss_mere_hijri_ar`, `date_naiss_mere_miladi_fr`, `date_naiss_mere_hijri_fr`, `profession_mere_ar`, `profession_mere`, `selon_ar`, `selon`, `age_mosarih_ar`, `age_mosarih`, `domicile_mosarih_ar`, `domicile_mosarih`, `ecrite_le_miladi`, `ecrite_le_hijri`, `ecrite_le_miladi_ar`, `ecrite_le_hijri_ar`, `ecrite_le_miladi_fr`, `ecrite_le_hijri_fr`, `heure_ecrit`, `min_ecrit`, `par_nous_ar`, `par_nous`, `officier_etat_civil_ar`, `officier_etat_civil`, `validate` FROM sdeadtable";
$query = mysqli_query($mysqli,$sql);

$totalData = mysqli_num_rows($query);

$annee_naiss= 0;
$totalFilter = $totalData;

$sql ="SELECT * FROM sdeadtable WHERE 1 ";
if(!empty($request['search']['value']))
{
    $sql.=" AND (numero Like '".$request['search']['value']."%' ";
    $sql.=" OR annee Like '".$request['search']['value']."%' ";
    $sql.=" OR prenom_ar Like '".$request['search']['value']."%' ";
    $sql.=" OR nom_ar Like '".$request['search']['value']."%' )";
}
//$request['is_gender'] = "feminin";
if(isset($request['is_gender']))
{
  if($request['is_gender']== "all")
  {
    $sql .= "  ";
  }
  else{
    $sql .= " AND sex = '".$request['is_gender']."' ";
  }
}

//age_start
//$request['is_age_start'] = 30;
if(isset($request['is_age_start']))
{
  if($request['is_age_start']== "all")
  {
    $sql .= " ";
  } else{
    $sql .= " AND  $anneActu - RIGHT(date_naiss_miladi , 4)  > '".$request['is_age_start']."' ";
  }
}

//age_end
//$request['is_age_end'] = 50;
if(isset($request['is_age_end']))
{
  if($request['is_age_end']== "all")
  {
    $sql .= " ";
  } else{
    $sql .= " AND $anneActu - RIGHT(date_naiss_miladi , 4)  < '".$request['is_age_end']."' ";
  }
}


// ordre naissance
if(isset($request['is_ordre_naiss']))
{
  if($request['is_ordre_naiss']== "all")
  {
    $sql .= "  ";
  }
  else{
    $sql .= " AND ordre_naiss = '".$request['is_ordre_naiss']."' ";
  }
}



//annee
if(isset($request['is_annee']))
{
  if($request['is_annee']== "all")
  {
    $sql .= "  ";
  }
  else{
  $decade =   $request['is_annee']+10;
    $sql .= " AND annee >= '".$request['is_annee']."' AND annee < '".$decade."' ";
  }

}
// age
/*if(isset($request['is_age']))
{
  if($request['is_age']== "all")
  {
    $sql .= "  ";
  }

  if($request['is_age']== "<6")
  {
      $sql .= " AND '". $anneActu."'-annee <= 6 ";
  }

  if($request['is_age']== "<18")
  {
      $sql .= " AND '". $anneActu."'-annee <= 18 ";
  }

  if($request['is_age']== "18-45")
  {
      $sql .= " AND '". $anneActu."'-annee >= 18 AND '". $anneActu."'-annee <= 45 ";
  }

  if($request['is_age']== "45-60")
  {
      $sql .= " AND '". $anneActu."'-annee >= 45 AND '". $anneActu."'-annee <= 60 ";
  }


  if($request['is_age']== ">60")
  {
      $sql .= " AND '". $anneActu."'-annee >= 60 ";
  }

}*/

//numero
if(isset($request['is_numero']))
{
  if($request['is_numero']== "all")
  {
    $sql .= "  ";
  }

  if($request['is_numero']== "0-300")
  {
      $sql .= " AND numero >0 AND numero <=300 ";
  }

  if($request['is_numero']== "300-600")
  {
      $sql .= " AND numero >300 AND numero <=600 ";
  }
  if($request['is_numero']== "600-900")
  {
      $sql .= " AND numero >600 AND numero <=900 ";
  }
  if($request['is_numero']== "900-1200")
  {
      $sql .= " AND numero >900 AND numero <=1200 ";
  }
  if($request['is_numero']== "1200-1500")
  {
      $sql .= " AND numero >1200 AND numero <=1500 ";
  }
  if($request['is_numero']== "1500-1800")
  {
      $sql .= " AND numero >1500 AND numero <=1800 ";
  }
  if($request['is_numero']== "1800-2100")
  {
      $sql .= " AND numero >1800 AND numero <=2100 ";
  }
  if($request['is_numero']== "2100-2400")
  {
      $sql .= " AND numero >2100 AND numero <=2400 ";
  }
  if($request['is_numero']== "2400-2700")
  {
      $sql .= " AND numero >2400 AND numero <=2700 ";
  }
  if($request['is_numero']== "2700-3000")
  {
      $sql .= " AND numero >2700 AND numero <=3000 ";
  }
  if($request['is_numero']== ">3000")
  {
      $sql .= " AND numero >3000  ";
  }

}

//lieu naiss
    if(isset($request['is_lieu_naiss']))
    {
        if($request['is_lieu_naiss']== "all")
        {
            $sql .= "  ";
        }else{
            $sql .= " AND lieu_naiss_ar = '". $request['is_lieu_naiss']."'  ";
        }
    }

    //lieu deces
    if(isset($request['is_lieu_deces']))
    {
        if($request['is_lieu_deces']== "all")
        {
            $sql .= "  ";
        }else{
            $sql .= " AND lieu_deces_ar = '". $request['is_lieu_deces']."'  ";
        }
    }

    //profession pere
    if(isset($request['is_profession_pere']))
    {
        if($request['is_profession_pere']== "all")
        {
            $sql .= "  ";
        }else{
            $sql .= " AND profession_pere_ar = '". $request['is_profession_pere']."'  ";
        }
    }





    //profession mere
    if(isset($request['is_profession_mere']))
    {
        if($request['is_profession_mere']== "all")
        {
            $sql .= "  ";
        }else{
            $sql .= " AND profession_mere_ar = '". $request['is_profession_mere']."'  ";
        }
    }

    //prenom_ar
    if(isset($request['is_prenom_ar']))
    {
        if($request['is_prenom_ar']== "all")
        {
            $sql .= "  ";
        }else{
            $sql .= " AND prenom_ar = '". $request['is_prenom_ar']."'  ";
        }
    }

    //nom_ar
    if(isset($request['is_nom_ar']))
    {
        if($request['is_nom_ar']== "all")
        {
            $sql .= "  ";
        }else{
            $sql .= " AND nom_ar = '". $request['is_nom_ar']."'  ";
        }
    }

     //nom_mere
     if(isset($request['is_nom_mere']))
     {
         if($request['is_nom_mere']== "all")
         {
             $sql .= "  ";
         }else{
             $sql .= " AND nom_mere_ar LIKE '". $request['is_nom_mere']."%'  ";
         }
     }

     //officier_etat_civil
     if(isset($request['is_officier_etat_civil']))
     {
         if($request['is_officier_etat_civil']== "all")
         {
             $sql .= "  ";
         }else{
             $sql .= " AND officier_etat_civil_ar LIKE '". $request['is_officier_etat_civil']."%'  ";
         }
     }
 
     //nom_pere
     if(isset($request['is_nom_pere']))
     {
         if($request['is_nom_pere']== "all")
         {
             $sql .= "  ";
         }else{
             $sql .= " AND nom_pere_ar LIKE '". $request['is_nom_pere']."%'  ";
         }
     }  


$query = mysqli_query($mysqli,$sql);
$totalData = mysqli_num_rows($query);

//$request['start'] = 0;
//$request['length'] = 100;
$sql.="  LIMIT ".$request['start']." ,".$request['length']."   ";
$query = mysqli_query($mysqli,$sql);
$data = array();

while($row=mysqli_fetch_array($query))
{
  //$annee_naiss = $anneActu- (int)$row['annee'];
  $annee_naiss =  substr($row['date_naiss_miladi'],-4);
  $annee_deces =  substr($row['date_deces_miladi'],-4);
  $subdata= array();
  $subdata[]='<tr style="cursor: pointer;"><div  style="text-align: center;font-size: 0.95em;">'.$row['numero'].'</div>'; // numero
  $subdata[]='<div style="text-align: center;font-size: 0.95em;">'.$row['annee'].'</div>'; // annee
  $subdata[]='<div style="text-align: center;font-size: 0.95em;">'.$row['prenom_ar'].'</div>'; // prenom_ar
  $subdata[]='<div style="text-align: center;font-size: 0.95em;">'.$row['nom_ar'].'</div>'; // nom_ar

  if($row["sex"]=="feminin")//sex
  {
      $subdata[]='<div style="text-align: center;font-size: 0.95em;">أنثى</div>';
  }else {
      $subdata[]='<div style="text-align: center;font-size: 0.95em;">ذكر</div>';
  }


$subdata[]='<div style="text-align: center;font-size: 0.95em;">'.$row['lieu_naissance_ar'].'</div>'; //lieu niass
$subdata[]='<div style="text-align: center;font-size: 0.95em;">'.$row['lieu_deces_ar'].'</div>'; //lieu niass
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
