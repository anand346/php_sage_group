<?php
include "config.php";
$username = mysqli_real_escape_string($conn,htmlentities($_POST['username']));
$email = mysqli_real_escape_string($conn,htmlentities($_POST['email']));
$password = mysqli_real_escape_string($conn,htmlentities($_POST['password']));
$vkey = md5(time().$username);
function get_client_ip() {
  $ipaddress = '';
  if (isset($_SERVER['HTTP_CLIENT_IP']))
      $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
  else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_X_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
  else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_FORWARDED'];
  else if(isset($_SERVER['REMOTE_ADDR']))
      $ipaddress = $_SERVER['REMOTE_ADDR'];
  else
      $ipaddress = '0.0.0.0';
  return $ipaddress;
}
$ip  = get_client_ip();
$sql_check = "SELECT * FROM users WHERE username = '{$username}' OR email = '{$email}'";
$result_check = mysqli_query($conn,$sql_check);
if(mysqli_num_rows($result_check) > 0){
    echo 0;
}else if(!(filter_var($email,FILTER_VALIDATE_EMAIL))){
    echo 3;
}else{
    $dir = getcwd();
        if(mkdir($dir."/room/{$username}")){
            $dir1 = $dir."/room/{$username}/profile";
            mkdir($dir1);
            $dir2 = $dir."/room/{$username}/post";
            mkdir($dir2);
        }
        if(file_exists($dir."/room/{$username}/profile")){
            $default_profile_img_dest = $dir."/room/images/profile_img.png";
             $move_default_profile_img_dest = $dir."/room/{$username}/profile/profile_img.png";
             copy($default_profile_img_dest,$move_default_profile_img_dest);
        }
        $profile_img = basename($move_default_profile_img_dest);
    $sql = "INSERT INTO users(username, email, password , ip,profile_img,vkey) VALUES('{$username}','{$email}','{$password}','{$ip}','{$profile_img}','{$vkey}')";
    $result = mysqli_query($conn,$sql);
    if($result){
        // $to = $email;
        // $subject = "email verification";
        // $message = "verify here <a href = 'http://localhost/sage%20group/verify.php?vkey={$vkey}'>Verify</a>";
        // $headers = "From : sageuniversity@gmail.com"."\r\n";
        // $headers .= "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // if(mail($to,$subject,$message,$headers)){
        //     echo 1;
        // }
        echo 1;
    }else{
        echo 2;
    }
}
?>