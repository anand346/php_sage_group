<?php
session_start();
if(!(isset($_SESSION['username']))){
  header("location:{$hostname}/index.php");
}
include "../config.php";
$fromuser = $_POST['fromuser'];
$touser = $_POST['touser'];
$message = htmlentities($_POST['message']);
if($_SESSION['id'] == $fromuser){
 $sql = "INSERT INTO messages(fromuser,touser,message) VALUES('{$fromuser}','{$touser}','{$message}')";
if(mysqli_query($conn,$sql)){
  //header("location:{$hostname}/chat room/index.php?touser='{$touser}'");
echo 1;
}else{
  echo 0;
}
}else{
  header("location:{$hostname}/room/chat/chat room/index.php?touser='{$touser}'");
}
?>