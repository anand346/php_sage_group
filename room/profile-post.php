<?php
include "config.php";
session_start();
if(isset($_GET['indid'])){
  $indid = htmlentities($_GET['indid']);
}
$sql = "SELECT * FROM posts WHERE username = (SELECT username FROM users WHERE id = $indid)";
$result = mysqli_query($conn,$sql);
$output = "";
$output .= "<div class='row-lower'>";
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    if($row['post_img'] == 0){
      $output .= "<div class='single-post' style = 'border:3px solid black;border-radius:10px;text-align:center;word-wrap:break-word;text-overflow:ellipsis;'>
      <p><b>{$row['post_desc']}</b></p>";
      if($indid == $_SESSION['id']){
        $output .= "<button class = 'delete-btn' data-id = '{$row["id"]}'><i class = 'far fa-trash-alt'></i></button>";
      }
     $output .= "</div>";
    }else{
      $output .= "<div class='single-post' style = 'border:3px solid black;border-radius:10px;text-align:center;word-wrap:break-word;text-overflow:ellipsis;'>
     <img src='{$row["username"]}/post/{$row["post_img"]}' alt=''>";
     if($indid == $_SESSION['id']){
      $output .= "<button class = 'delete-btn' data-id = '{$row["id"]}'><i class = 'far fa-trash-alt'></i></button>";
     }
    $output .= "</div>";
    }
  }
}
$output .= "</div>";
echo $output;
?>