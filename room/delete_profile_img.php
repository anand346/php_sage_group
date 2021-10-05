<?php
include "config.php";
session_start();
$sql1 = "SELECT * FROM users WHERE username = '{$_SESSION["username"]}'";
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_assoc($result1);
unlink($_SESSION['username']."/profile/{$row1["profile_img"]}");
$sql = "UPDATE users SET profile_img = 'profile_img.png' WHERE username = '{$_SESSION["username"]}'";
if(mysqli_query($conn,$sql)){
  echo 1;
}else{
  echo 0;
}

?>