<?php
include "config.php";
$username = mysqli_real_escape_string($conn,htmlentities($_POST['username']));
$password = mysqli_real_escape_string($conn,htmlentities($_POST['password']));
$sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
$result = mysqli_query($conn,$sql);
 if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    if($row['verified'] == 0){
      echo 2;
    }else{
      session_start();
     $_SESSION['username'] = $row['username'];
     $_SESSION['id'] = $row['id'];
     echo 1;
    }
 }else{
   echo 0;
 }
?>