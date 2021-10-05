<?php
include "config.php";
session_start();
if(!(isset($_SESSION['username']))){
  header("location:{$hostname}/index.php");
}
if(isset($_GET['indid'])){
  $indid = htmlentities($_GET['indid']);
  if($_GET['indid'] == $_SESSION['id']){
    header("location:{$hostname}/room/profile.php");
  }
}else{
  echo "no id is set";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <title>profile</title>
</head>
<body>
  <header>
    <div class="row">
      <div class="col30"><h2>Profile</h2></div>

      <div class="col40">
        <a href="index.php"><i class="fas fa-home" style = "color:#111;"></i></a><br>
        <a href="logout.php"><i class="fas fa-sign-out-alt" style="color:#111;"></i></a>
      </div>
    </div>
  </header>
  <section class="container">
    <div class="row">
    <?php
      $sql = "SELECT * FROM users WHERE id = $indid";
      $result = mysqli_query($conn,$sql);
      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    ?>
      <div class="col30">
        <div class="profile-img">
          <img src="<?php echo $row['username']."/profile/{$row['profile_img']}";?>" alt="">
        </div>
        <div class="profile-name"><h3><?php echo $row['username'];?></h3></div>
        <div class="profile-email"><h3><?php echo $row['email'];?></h3></div>
        <!-- <div class="change-password">
          <div class="modal password-modal" id="ex1">
            <input type="text" name="old-password" id="old-password" placeholder = "old password"><br>
            <input type="text" name="new-password" id="new-password" placeholder="new password"><br>
            <input type="submit" value="update" class = "update">
          </div>
          <a href="#ex1" rel = "modal:open" class = "password-btn">change password</a>
        </div> -->
        <!-- <div class="update-profile">
          <div class="modal profile-modal" id="ex2">
            <input type="text" name="username" id="update-username" placeholder="username" value = "<?php echo $row['username'];?>"><br>
            <input type="email" name="username" id="update-email" placeholder="email" value = "<?php echo $row['email'];?>"><br>
            <input type="submit" value="update" class = "update">
          </div>
          <a href = "#ex2" rel = "modal:open" class = "profile-btn update-btn">update profile</a>
        </div> -->
      </div>
      <?php
      }
      ?>
      <div class="col70">
        <div class="row-upper">
          <div class="col-img">
            <div class="profile-img">
              <!-- <div class="modal profile_img_modal" id="ex4">
                <input type="file" name="profile_upload" class ="btn_upload " id = "file1"  >
                <input type="submit" class = "save_upload" value="save" id = "save_upload1">
                <?php
                  // if(!($row['profile_img'] == "profile_img.png")){
                  //   echo "<button class = 'delete delete_upload'>Delete</button>";
                  // }
                ?>
              </div> -->
              <a href="#ex4" rel = "modal:open"><img src="<?php echo $row['username']."/profile/{$row['profile_img']}";?>" alt=""></a> 
            </div>
          </div>
          <?php
            $sql1 = "SELECT * FROM posts WHERE username = ( SELECT username FROM users WHERE id = $indid)";
            $result1 = mysqli_query($conn,$sql1);
            $no_posts = mysqli_num_rows($result1);
          ?>
          <div class="col-info">
            <div class="profile-name"><h3>Name : </h3><p><?php echo $row['username'];?></p></div>
            <div class="no-posts"><h3> Posts : </h3><p><?php echo $no_posts?></p></div>
             <!-- <div class="upgrade">
              <div class="update-profile-responsive">
                <div class="modal profile-modal-responsive" id="ex5">
                  <input type="text" name="username" id="update-username-responsive" placeholder="username" value = "<?php echo $row['username'];?>"><br>
                  <input type="email" name="email" id="update-email-responsive" placeholder="email" value = "<?php echo $row['email'];?>"><br>
                  <input type="submit" value="update" class = "update">
                </div>
                <a href = "#ex5" rel = "modal:open" class = "profile-btn-responsive update-btn"><i class="fas fa-user" style = "margin-right:20px;"></i><i class="fas fa-pen"></i></a>
                </div>
                <div class="change-password-responsive">
                <div class="modal password-modal-responsive" id="ex6">
                  <input type="text" name="old-password" id="old-password-responsive" placeholder = "old password"><br>
                  <input type="text" name="new-password" id="new-password-responsive" placeholder="new password"><br>
                  <input type="submit" value="update" class = "update">
                </div>
                 <a href="#ex6" rel = "modal:open" class = "password-btn-responsive"><i class="fas fa-key" style ="margin-right:20px;"></i><i class="fas fa-pen"></i></a>
              </div>
            </div>-->
          </div>
        </div>
         <!--
           .row-lower here
          -->
      </div>
    </div>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <!-- <script>
   var updateUsername = $("#update-username");
   var updateEmail = $("#update-email");
   var profileModal = $(".profile-btn");
     profileModal.on("click",function(){
     updateUsername.addClass("active");
     updateEmail.addClass("active");
   });
   var oldPassword = $("#old-password");
   var newPassword = $("#new-password");
   var passwordModal = $(".password-btn");
   passwordModal.on("click",function(){
     oldPassword.addClass("active");
     newPassword.addClass("active");
   });
   var oldPasswordResponsive = $("#old-password-responsive");
   var newPasswordResponsive = $("#new-password-responsive");
   var passwordModalResponsive = $(".password-btn-responsive");
   passwordModalResponsive.on("click",function(){
    oldPasswordResponsive.addClass("active");
    newPasswordResponsive.addClass("active");
   });
   var updateUsernameResponsive = $("#update-username-responsive");
   var updateEmailResponsive = $("#update-email-responsive");
   var profileBtnResponsive = $(".profile-btn-responsive");
   profileBtnResponsive.on("click",function(){
    updateUsernameResponsive.addClass("active");
    updateEmailResponsive.addClass("active");
   })
  </script> -->
  <script>
    $(document).ready(function(){
      function loadPost(){
        $.ajax({
          url : "profile-post.php?indid=<?php echo $indid;?>",
          type : "POST",
          success : function(data){
            $(".col70").append(data);
          }
        })
      }
      loadPost();
      //delete post
//       $(document).on("click",".delete-btn",function(){
//         var postId = $(this).data("id");
//          var element = this;
//         if(confirm("Are you sure want to delete this post?")){
//           $.ajax({
//             url : "delete-post.php",
//             type : "POST",
//             data : {postId : postId},
//             success : function(data){
//               if(data == 1){
//                 $(element).closest("div").fadeOut();
//                 alert("post deleted successfully");
//               }else{
//                 alert("plz click on delete btn of your post");
//               }
//             }
//           })
//         }
//        })
//       //update profile
//       $(".profile-modal-responsive .update").on("click",function(){
//         var username = $("#update-username-responsive").val();
//         var email = $("#update-email-responsive").val();
//         if(username == "" || email == ""){
//           alert("username or email cant be empty");
//         }else{
//           $.ajax({
//             url : "update-profile.php",
//             type : "POST",
//             data : {username : username , email : email},
//             success : function(data){
//               if(data == 1){
//                 alert("profile updated successfully");
//                 window.open("http://localhost/sage group/room/profile.php","_self");
//               }else if(data == 2){
//                 alert("username already taken");
//               }else if(data == 3){
//                 alert("plz input valid credentials");
//               }else if(data == 0){
//                 alert("update failed due to some reason");
//               }else{
//                 console.log(data);
//               }
//             }
//           })
//         }
//       })
//       $(".profile-modal .update").on("click",function(){
//         var username = $("#update-username").val();
//         var email = $("#update-email").val();
//         if(username == "" || email == ""){
//           alert("username or email cant be empty");
//         }else{
//           $.ajax({
//             url : "update-profile.php",
//             type : "POST",
//             data : {username : username , email : email},
//             success : function(data){
//               if(data == 1){
//                 alert("profile updated successfully");
//                 window.open("http://localhost/sage group/room/profile.php","_self");
//               }else if(data == 2){
//                 alert("username or email already taken");
//               }else if(data == 3){
//                 alert("plz input valid credentials");
//               }else if(data == 0){
//                 alert("update failed due to some reason");
//               }else{
//                 console.log(data);
//               }
//             }
//           })
//         }
//       })
//       //change password
//       $(".password-modal .update").on("click",function(){
//         var oldPassword = $("#old-password").val();
//         var newPassword = $("#new-password").val();
//         if(oldPassword == "" || newPassword == ""){
//           alert("password cannot be empty");
//         }else{
//           $.ajax({
//             url : "update-profile.php",
//             type : "POST",
//             data : {old_password : oldPassword , new_password : newPassword },
//             success : function(data){
//               if(data == 1){
//                 alert("password changed successfully");
//                 window.open("http://localhost/sage group/room/profile.php","_self");
//               }else{
//                 alert("old password is incorrect");
//               }
//             }
//           })
//         }
//       })

//       $(".password-modal-responsive .update").on("click",function(){
//         var oldPassword = $("#old-password-responsive").val();
//         var newPassword = $("#new-password-responsive").val();
//         if(oldPassword == "" || newPassword == ""){
//           alert("password cannot be empty");
//         }else{
//           $.ajax({
//             url : "update-profile.php",
//             type : "POST",
//             data : {old_password : oldPassword , new_password : newPassword },
//             success : function(data){
//               if(data == 1){
//                 alert("password changed successfully");
//                 window.open("http://localhost/sage group/room/profile.php","_self");
//               }else if(data == 0){
//                 alert("old password is incorrect");
//               }else{
//                 console.log(data);
//               }
//             }
//           })
//         }
//       });
//       $("#save_upload1").on("click", function(){
//   var name = $("#file1")[0].files[0].name;
//   console.log(name);
//   var form_data = new FormData();
//   var ext = name.split('.').pop().toLowerCase();
//   if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
//    alert("Invalid Image File");
//   }
//   var f = $("#file1")[0].files[0];
//   var fsize = f.size||f.fileSize;
//   if(fsize > 2000000){
//    alert("Image File Size is very big");
//   }else{
//    form_data.append("file", $("#file1")[0].files[0]);
//    $.ajax({
//     url:"update_profile_img.php",
//     method:"POST",
//     data: form_data,
//     contentType: false,
//     cache: false,
//     processData: false,
//     success:function(data){
//       if(data == 1){
//         window.open("http://localhost/sage group/room/profile.php","_self");
//       }else if(data == 0){
//        console.log("mysqli failed");
//      }else{
//        console.log(data);
//      }
//     }
//    });
//   }
//  });
//  $(".delete_upload").on("click",function(){
//    $.ajax({
//      url : "delete_profile_img.php",
//      type : "POST",
//      success : function(data){
//        if(data == 1){
//          window.open("http://localhost/sage group/room/profile.php","_self");
//        }else if(data == 0){
//          alert("profile img not deleted successfully");
//        }else{
//          console.log(data);
//        }
//      }
//    })
//  })
     })
  </script>
</body>
</html>