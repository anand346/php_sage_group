<?php
include "config.php";
session_start();
//testing code
if (!isset($_SESSION['username'])) {
  header("location:{$hostname}/login.php");
}
if (isset($_POST['username']) && strlen($_POST['email']) == 0) {
  $username = mysqli_real_escape_string($conn, htmlentities($_POST['username']));
  if (strlen($username) == 0) {
    echo 3;
  }
  $sql = "SELECT * FROM users WHERE username = '{$username}'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo 2;
  } else {
    $sql1 = "UPDATE users SET username = '{$username}' WHERE username = '{$_SESSION["username"]}';";
    $sql1 .= "UPDATE posts SET username = '{$username}' WHERE username = '{$_SESSION["username"]}';";
    if (mysqli_multi_query($conn, $sql1)) {
      rename("{$_SESSION['username']}", "{$username}");
      $_SESSION['username'] = $username;
      echo 1;
    } else {
      echo 0;
    }
  }
} else if (isset($_POST['email']) && strlen($_POST['username']) == 0) {
  $email = mysqli_real_escape_string($conn, htmlentities($_POST['email']));
  if (strlen($email) == 0) {
    echo 3;
  }
  $sql = "SELECT * FROM users WHERE  email = '{$email}'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo 2;
  } else {
    $sql1 = "SELECT * FROM users WHERE username = '{$_SESSION["username"]}'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $vkey = md5(time() . $email);
    $_SESSION['vkey'] = $vkey;
    $to = $email;
    $subject = "email verification";
    $message = "verify here <a href = '{$hostname}/room/updatemail.php?vkey={$vkey}&oldmail={$row1["email"]}&updatemail={$email}'>Verify</a>";
    $headers = "From : sageuniversity@gmail.com" . "\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    if (mail($to, $subject, $message, $headers)) {
      echo 4;
    }
    //   $sql1 = "UPDATE users SET email = '{$email}' WHERE username = '{$_SESSION["username"]}';";
    // if(mysqli_query($conn,$sql1)){
    //   echo 1;
    // }else{
    //   echo 0;
    // }
  }
} else if (isset($_POST['username']) && isset($_POST['email'])) {
  $username = mysqli_real_escape_string($conn, htmlentities($_POST['username']));
  $email = mysqli_real_escape_string($conn, htmlentities($_POST['email']));
  if (strlen($username) == 0 or strlen($email) == 0) {
    echo 3;
  }
  $sql = "SELECT * FROM users WHERE username = '{$username}' OR email = '{$email}'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo 2;
  } else {
    $sql1 = "UPDATE users SET username = '{$username}' WHERE username = '{$_SESSION["username"]}';";
    $sql1 .= "UPDATE posts SET username = '{$username}' WHERE username = '{$_SESSION["username"]}';";
    if (mysqli_multi_query($conn, $sql1)) {
      rename("{$_SESSION['username']}", "{$username}");
      $_SESSION['username'] = $username;
      $sql2 = "SELECT * FROM users WHERE username = '{$_SESSION["username"]}'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $vkey = md5(time() . $email);
      $_SESSION['vkey'] = $vkey;
      $to = $email;
      $subject = "email verification";
      $message = "verify here <a href = '{$hostname}/room/updatemail.php?vkey={$vkey}&oldmail={$row2["email"]}&updatemail={$email}'>Verify</a>";
      $headers = "From : sageuniversity@gmail.com" . "\r\n";
      $headers .= "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      if (mail($to, $subject, $message, $headers)) {
        echo 4;
      }
      echo 1;
    } else {
      echo 0;
    }
  }
} else if (isset($_POST['old_password']) and isset($_POST['new_password'])) {
  $old_password = htmlentities($_POST['old_password']);
  $new_password = htmlentities($_POST['new_password']);
  $sql = "SELECT * FROM users WHERE username = '{$_SESSION["username"]}' AND password = '{$old_password}'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $sql1 = "UPDATE users SET password = '{$new_password}' WHERE username = '{$_SESSION["username"]}'";
    if (mysqli_query($conn, $sql1)) {
      echo 1;
    }
  } else {
    echo 0;
  }
}
