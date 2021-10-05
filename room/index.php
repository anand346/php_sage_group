<?php
include "config.php";
session_start();
if (!(isset($_SESSION['username']))) {
  header("location:{$hostname}/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/style.css">
  <title>room</title>
</head>

<body>
  <header id="upper-header">
    <div class="container">
      <div class="sage-logo">
        <div class="logo">
          <img src="images/sage-logo2.png" alt="">
        </div>
      </div>
    </div>
  </header>
  <section id="header">
    <div class="container">
      <nav>
        <?php
        $sql2 = "SELECT * FROM users WHERE username = '{$_SESSION['username']}'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        ?>
        <div class="profile-info">
          <div class="profile-img">
            <img src="<?php echo "{$hostname}/room/{$_SESSION['username']}/profile/{$row2['profile_img']}"; ?>" alt="">
          </div>
          <span class="profile-name"><?php echo $_SESSION['username']; ?></span>
        </div>
        <div class="menutoggle" onclick="togglemenu()"></div>
        <ul class="toolbar">
          <li class="toolbar-item" onclick="togglemenu()"><a href="profile.php">Profile</a></li>
          <li class="toolbar-item" onclick="togglemenu()"><a href="exam/index.php">Exam</a></li>
          <li class="toolbar-item" onclick="togglemenu()"><a href="chat/chat room/index.php">Chat</a></li>
          <li class="toolbar-item" onclick="togglemenu()"><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </section>
  <section id="content">
    <div class="container">
      <div class="profile-info">
       <div class="shade"></div>
       <div class="profile-img">
         <img src="<?php echo "{$hostname}/room/{$_SESSION['username']}/profile/{$row2['profile_img']}"; ?>" alt="">
       </div>
       <p class="profile-name"><?php echo $_SESSION['username'];?></p>
       <p class = "profile-email"><?php echo $row2['email'];?></p>
       <a class = "profile-link" href="profile.php">Profile</a>
      </div>
      <div class="posts">
        <form action="upload.php" id="post_create" enctype="multipart/form-data" method="POST" style="display:block;width:100%;padding:0;margin:0;">
          <div class="create-post">
            <input name="post_desc" id="post_desc" cols="30" rows="10" placeholder="what's on your mind...">
            <!-- </textarea> -->
            <div class="row">
              <div class="col50">
                <!-- <input type="file" style="color:transparent; width:70px;"/> -->
                <input id="post_img" type="file" name="post_img" class="file-input">
                <!-- <label for="choose">Choose file</label> -->
              </div>
              <div class="col50">
                <input id="submit" type="submit" value="post" class="submit">
              </div>
            </div>
          </div>
        </form>
        <?php
        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $sql3 = "SELECT * FROM users WHERE username = '{$row["username"]}'";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_assoc($result3);
        ?>
            <div class="single-post">
              <div class="post-header">
                <div class="author-info">
                  <div class="author-img">
                    <img src="<?php echo "{$hostname}/room/{$row['username']}/profile/{$row3['profile_img']}"; ?>" alt="">
                  </div>
                  <span class="author-name"><?php echo $row['username']; ?></span></br>
                </div>
              </div>
              <div class="post-body">
                <div class="post-body-desc">
                  <p><?php echo $row['post_desc']; ?></p>
                </div>
                <?php
                if (!($row['post_img'] == 0)) {
                ?>
                  <div class="post-body-img">
                    <img src="<?php echo "{$hostname}/room/{$row['username']}/post/{$row['post_img']}"; ?>" alt="img is not posted">
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>
      <div class="sidebar">
        <div class="search-field">
          <input type="text" name="search" id="search" placeholder="search users">
        </div>
        <div class="users">
          <ul class="list">
            <?php
            $sql1 = "SELECT * FROM users";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
              while ($row1 = mysqli_fetch_assoc($result1)) {
            ?>
                <li class="list-item"><a href="indprofile.php?indid=<?php echo $row1['id'];?>"><?php echo $row1['username']; ?></a></li>
            <?php
              }
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <script>
    function togglemenu() {
      const menutoggle = document.querySelector(".menutoggle");
      const navigation = document.querySelector(".toolbar");
      menutoggle.classList.toggle("active");
      navigation.classList.toggle("active");
    }
  </script>
  <script src="js/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#search").on("keyup", function() {
        var search_term = $(this).val();
        $.ajax({
          url: "search.php",
          type: "POST",
          data: {
            search: search_term
          },
          success: function(data) {
            $(".users").html(data);
          }
        });
      });
    })
  </script>
</body>

</html>