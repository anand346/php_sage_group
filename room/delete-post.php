<?php
include "config.php";
session_start();
$post_id = $_POST['postId'];
$sql = "SELECT * FROM posts WHERE username = '{$_SESSION["username"]}'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    if($post_id == $row['id']){
      $sql1 = "SELECT * FROM posts WHERE id = {$post_id}";
      $result1 = mysqli_query($conn,$sql1);
      $row1 = mysqli_fetch_assoc($result1);
      if(!($row1['post_img'] == 0)){
        unlink("{$_SESSION['username']}/post/".$row1['post_img']);
      }
      $sql2 = "DELETE FROM posts WHERE id = '{$post_id}'";
      if(mysqli_query($conn,$sql2)){
        echo 1;
      }
    }else{
      echo 0;
    }
  }
}
?>