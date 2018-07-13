<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'etat_civil_db';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
mysqli_set_charset($mysqli,"utf8");
