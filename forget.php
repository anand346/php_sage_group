<?php
include "config.php";
if (isset($_POST['email'])) {
  $email = mysqli_real_escape_string($conn,htmlentities($_POST['email']));
  $sql = "SELECT * FROM users WHERE email = '{$email}'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $txt = "your password is : ".$row['password'].", ";
    $txt .= "Login here https://anand346.host20.uk/sage%20group/login.php ";
    $to = $email;
    $subject = "Password Recovery";
    $headers = "From: Sageuniversity@gmail.com";
    if (mail($to, $subject, $txt, $headers)) {
      echo 1;
    } else {
      echo 0;
    }
  }else{
    echo 3;
  }
} else {
  echo 2;
}
