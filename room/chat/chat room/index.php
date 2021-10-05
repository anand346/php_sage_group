<?php
include "../config.php";
session_start();
if(!(isset($_SESSION['username']))){
  header("location:{$hostname}/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/style-chat-room.css">
  <title>Document</title>
</head>
<body>
  <header>
    <div class="content">
      <h2>Chat room , hello <?php echo $_SESSION['username'];?></h2>

    </div>
  </header>
  <section class="banner">
    <div class="users-list">
      <?php

      $sql = "SELECT * FROM users WHERE NOT id = {$_SESSION['id']}";
      $result = mysqli_query($conn,$sql) or die("sql failed");
      if(mysqli_num_rows($result) > 0){
      ?>
      <ul>
        <?php
          while($row = mysqli_fetch_assoc($result)){
        ?>
        <li><i class = "fa fa-user" style ="margin-right:10px;"></i><a href="index.php?touser=<?php echo $row['id']?>"><?php echo $row['username'];?></a></li>
        <?php
          }
          echo "</ul>";
        }
        ?>
    </div>
    <?php
    if(isset($_GET['touser'])){
      $_SESSION['touser'] = $_GET['touser'];
	  $display = "";
    }else{
		$display = "none";
      $_SESSION['touser'] = 1;
    }
      if(isset($_SESSION['touser'])){
        $touserid = $_SESSION['touser'];
      $sql2 = "SELECT * FROM users WHERE id = {$touserid}";
      $result2 = mysqli_query($conn,$sql2);
      if(mysqli_num_rows($result2) > 0){
        $row2 = mysqli_fetch_assoc($result2);
      ?>
    <div class="chat-box" style = "display:<?php echo $display; ?>">
      <div class="tousername"><h2><?php echo $row2['username'];?></h2></div>
      <div class="msgs">

      </div>
      <div class="send-msgs">
        <input type="text" name="fromuser" id="fromuserid" value = "<?php echo $_SESSION['id'];?>" hidden>
        <input type="text" name="touser" id="touserid" value = "<?php echo $touserid;?>" hidden>
        <form id = "addform">
        <!-- <form action = "save-msg.php" method = "POST"> -->
        <input type = "text" name = "msg" id = "msg" placeholder = "type here...">
        <button name = "send" id = "send"><i class = 'fas fa-paper-plane'></i></button>
        </form>
        <!-- </form> -->
      </div>
    </div>
    <?php
    }
  }else{
    echo "plz click the user you want to send message";
  }
    ?>
    <div class="logout-section">
    <?php
        $sql1 = "SELECT * FROM users WHERE username = '{$_SESSION['username']}' ";
        $result1 = mysqli_query($conn,$sql1);
        if(mysqli_num_rows($result1) > 0){
          $row1 = mysqli_fetch_assoc($result1)
      ?>
    <div class="user-details">
    <div class = "user-image"><img src="<?php echo "../../".$_SESSION['username']."/profile/{$row1['profile_img']}";?>" alt=""></div>
      <ul>
        <li><?php echo $row1['username'];?></li>
        <li><?php echo $row1['email'];?></li>
        <li>
        <a href="../../index.php" style = "margin-right:20px;"><i class = "fas fa-home"></i></a><br>
        <a href= "logout.php" ><i class="fas fa-sign-out-alt"></i></a>
        </li>

      </ul>
      <?php
        }
      ?>
    </div>
    </div>
  </section>
  <div class="footer">
      <p> Developer : <span>Anand Raj</span></p>
    </div>
  <script src = "jquery.js"></script>
  <script>
          $(document).ready(function(){
            //show message
            function showMessages(){
              $.ajax({
                url : 'show-messages.php',
                type : "POST",
                success : function(data){
                  $(".chat-box .msgs").html(data);
                }
              })
              $(".chat-box .msgs").animate({scrollTop:10000000},100);
            }
            showMessages();
            //refresh page

            setInterval(() => {
              showMessages();
            }, 1000);


           //send messages

          $("#send").on("click",function(e){
            e.preventDefault();
           var touserid = $("#touserid").val();
            var fromuserid = $("#fromuserid").val();
             var message = $("#msg").val();
      if(message == ""){
        alert("message is empty");
      }else{
        $.ajax({
                 url : "save-msg.php",
                 type : "POST",
                 data : {fromuser : fromuserid, touser : touserid, message : message},
                 success : function(data){
                   if(data == 1){
                     showMessages();
                     $("#addform").trigger("reset");
                  }else if(data == 2){
                    alert("plz select the user from users list");
                    window.open("http://localhost/sage%20group/room/chat/chat%20room/","_self");
                  }else if(data == 3){
                    window.open("http://localhost/sage%20group/room/chat/chat%20room/","_self");
                  }else{
                    showMessages();
                    alert("message not saved");
                    $("#addform").trigger("reset");
                  }
                 }
             })
      }

    });

          })
  </script>
</body>
</html>