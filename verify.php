<?php
include "config.php";
if(isset($_GET['vkey'])){
  $vkey = $_GET['vkey'];
  $sql = "SELECT * FROM users WHERE verified = 0 AND vkey = '{$vkey}'";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) == 1){
    $sql1 = "UPDATE users SET verified = 1 WHERE vkey = '{$vkey}'";
    if(mysqli_query($conn,$sql1)){
      $output =  "<center style = 'font-size:1.5em;'>you are verfied</center><br><br>";
      $output .= "<center><a href = 'http://localhost/sage%20group/login.php'>Login Here</a></center>";
    }else{
      die("something went wrong");
    }
  }else{
   $output = "<center style = 'font-size:1.5em;'>Account does not exists or already verified</center>";
  }
  echo $output;
}else{
  echo "<center>something went wrong</center>";
}
?>