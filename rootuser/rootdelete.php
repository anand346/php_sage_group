<?php
include "../config.php";
$uname = "there";
$pswd = "wego";
if (isset($_POST['id'])) {
  $userid = mysqli_real_escape_string($conn, htmlentities($_POST['id']));
  $username = mysqli_real_escape_string($conn, htmlentities($_POST['username']));
  $password = mysqli_real_escape_string($conn, htmlentities($_POST['password']));
  if ($uname == $username and $pswd == $password) {
    $sql = "SELECT * FROM users WHERE id = $userid";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    }
    $sql1 = "DELETE FROM users WHERE id = $userid;";
    $sql1 .= "DELETE FROM posts WHERE username = '{$row["username"]}';";
    $sql1 .= "DELETE FROM messages WHERE fromuser = $userid;";
    if (mysqli_multi_query($conn, $sql1)) {
      // rmdir("../room/{$row['username']}");
      echo 1;
    } else {
      echo 0;
    }
  } else {
    echo 2;
  }
} else {
  echo "plz post id";
}
