<?php
include "../config.php";
session_start();
  $touserid = $_SESSION['touser'];
   $sql1 = "SELECT * FROM messages WHERE fromuser IN ({$_SESSION['id']},{$touserid}) AND touser IN ({$_SESSION['id']},{$touserid})";
  $result1 = mysqli_query($conn,$sql1);
  $output = "";
  if(mysqli_num_rows($result1) > 0){
    $output .= "<div class = 'msg-box' style = 'clear:both;'>";
   while($row1 = mysqli_fetch_assoc($result1)){
    if($_SESSION['id'] == $row1['fromuser']){
      $output .= "<p style = 'float:right;clear:both;max-width:80%;'>{$row1['message']}</p><br>";
    }else{
      $output .= "<p style = 'float:left;clear:both;max-width:80%;'>{$row1['message']}</p><br>";
    }

   }
   $output .= "</div>";
  }
  echo $output;



?>
