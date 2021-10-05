<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
  header("location:{$hostname}/login.php");
}
if(isset($_GET['vkey'])){
  $oldmail = mysqli_real_escape_string($conn,htmlentities($_GET['oldmail']));
  $updatemail = mysqli_real_escape_string($conn,htmlentities($_GET['updatemail']));
  $vkey = mysqli_real_escape_string($conn,htmlentities($_GET['vkey']));
  if($_SESSION['vkey'] == $vkey){
    $sql1 = "UPDATE users SET email = '{$updatemail}' WHERE email = '{$oldmail}'";
    if(mysqli_query($conn,$sql1)){
    echo 1;
    }else{
    echo 0;
  }
  }
}

?>