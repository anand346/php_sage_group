<?php
session_start();
include "config.php";
if(!(empty($_FILES['file']['name']))){
  $img_name = htmlentities($_FILES['file']['name']);
  $img_ext = pathinfo($img_name,PATHINFO_EXTENSION);
  $tmp_name = $_FILES['file']['tmp_name'];
  $new_img_name = time().$img_name;
  $path = "{$_SESSION['username']}/profile/{$new_img_name}";
  // compress image before upload
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

compressImage($tmp_name,$path,5);

  //compression finished
  // move_uploaded_file($tmp_name,$path);
  $sql = "SELECT * FROM users WHERE username = '{$_SESSION["username"]}'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  if(!($row['profile_img'] == "profile_img.png")){
    unlink("{$_SESSION['username']}/profile/{$row['profile_img']}");
  }
  $sql1 = "UPDATE users SET profile_img = '{$new_img_name}' WHERE username = '{$_SESSION["username"]}'";
  if(mysqli_query($conn,$sql1)){
   echo 1;
   }else{
     echo 0;
   }
}
?>