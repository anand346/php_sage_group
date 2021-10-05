<?php 

$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_cee";
$conn = null;

try {
  $conn = new PDO("mysql:host={$host};dbname={$db};",$user,$pass);
} catch (Exception $e) {
  
}


 ?>