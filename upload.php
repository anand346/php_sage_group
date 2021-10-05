<?php
include "config.php";
session_start();
if(!(isset($_SESSION['username']))){
	header("location:{$hostname}/index.php");
}
 if($_FILES['post_img']['size'] > 0 && strlen($_POST['post_desc']) > 0){
     $img_name = mysqli_real_escape_string($conn,htmlentities($_FILES['post_img']['name']));
     $img_ext = pathinfo($img_name,PATHINFO_EXTENSION);
     $tmp_name = $_FILES['post_img']['tmp_name'];
     $new_img_name = time().$img_name;
     $path = "{$_SESSION['username']}/post/{$new_img_name}";
     $post_desc = mysqli_real_escape_string($conn,htmlentities($_POST['post_desc']));
	 function compressImage($source, $destination, $quality) {
      // Get image info
      $imgInfo = getimagesize($source);
      $mime = $imgInfo['mime'];

      // Create a new image from file
      switch($mime){
          case 'image/jpeg':
              $image = imagecreatefromjpeg($source);
              break;
          case 'image/png':
              $image = imagecreatefrompng($source);
              break;
          case 'image/gif':
              $image = imagecreatefromgif($source);
              break;
          default:
              $image = imagecreatefromjpeg($source);
      }

      // Save image
      imagejpeg($image, $destination, $quality);

      // Return compressed image
      return $destination;
  }

  compressImage($tmp_name,$path,-1);

    //compression finished
     // move_uploaded_file($tmp_name,$path);
     $sql = "INSERT INTO posts(username,post_desc,post_img) VALUES('{$_SESSION["username"]}','{$post_desc}','{$new_img_name}')";
     if(mysqli_query($conn,$sql)){
      header("location:{$hostname}/room/index.php");
      }else{
        echo "query failed";
      }
 }else if(strlen($_POST['post_desc']) > 0 AND $_FILES['post_img']['size'] == 0){
  $post_desc = mysqli_real_escape_string($conn,htmlentities($_POST['post_desc']));
  $post_img = "0";
  echo $sql = "INSERT INTO posts(username,post_desc,post_img) VALUES('{$_SESSION["username"]}','{$post_desc}','{$post_img}')";
     if(mysqli_query($conn,$sql)){
      header("location:{$hostname}/room/index.php");
      }else{
        echo "query failed";
      }
 }else if($_FILES['post_img']['size'] > 0 AND strlen($_POST['post_desc'])  == 0){
  $img_name = mysqli_real_escape_string($conn,htmlentities($_FILES['post_img']['name']));
  $img_ext = pathinfo($img_name,PATHINFO_EXTENSION);
  $tmp_name = $_FILES['post_img']['tmp_name'];
  $new_img_name = time().$img_name;
  $path = "{$_SESSION['username']}/post/{$new_img_name}";
  $post_desc = " ";
  function compressImage($source, $destination, $quality) {
      // Get image info
      $imgInfo = getimagesize($source);
      $mime = $imgInfo['mime'];

      // Create a new image from file
      switch($mime){
          case 'image/jpeg':
              $image = imagecreatefromjpeg($source);
              break;
          case 'image/png':
              $image = imagecreatefrompng($source);
              break;
          case 'image/gif':
              $image = imagecreatefromgif($source);
              break;
          default:
              $image = imagecreatefromjpeg($source);
      }

      // Save image
      imagejpeg($image, $destination, $quality);

      // Return compressed image
      return $destination;
  }

  compressImage($tmp_name,$path,-1);

    //compression finished
  // move_uploaded_file($tmp_name,$path);
  $sql = "INSERT INTO posts(username,post_desc,post_img) VALUES('{$_SESSION["username"]}','{$post_desc}','{$new_img_name}')";
  if(mysqli_query($conn,$sql)){
   header("location:{$hostname}/room/index.php");
   }else{
     echo "query failed";
   }
 }else{
   echo "there was nothing to upload i am sorry :)";
 }

?>