<?php
include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>rootuser</title>
</head>
<body>
<center>
  <table>
  <?php
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);
  ?>
    <thead>
      <tr>
        <th>Username</th>
        <th>delete</th>
      </tr>
    </thead>
    <tbody>
    <?php
      while($row = mysqli_fetch_assoc($result)){
    ?>
      <tr>
        <td><?php echo $row['username'];?></td>
        <td><button id = "delete" data-val = "<?php echo $row['id'];?>">Delete</button></td>
      </tr>
      <?php
          }
      ?>
    </tbody>
  </table>
  </center>
  <script src="../assets/js/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      var username = prompt("enter username");
      var password = prompt("enter password");
      if(username == "" || password == ""){
        alert("all fields are required , refresh the page");
      }else{
        var buttons = document.querySelectorAll("#delete");
      $.each(buttons,function(){
        $(this).on("click",function(){
        var button = this;
        var id = $(button).data("val");
        $.ajax({
          url : "rootdelete.php",
          type :"POST",
          data : {id : id ,username : username,password : password},
          success : function(data){
            if(data == 1){
              $(button).closest("tr").fadeOut();
            }else if(data == 0){
              alert("user not delete");
            }else if(data == 2){
              alert("username or password is incorrect");
            }else{
              alert("plz post some id");
              console.log(data);
            }
          }
        })
      })
      })
      }
    })
  </script>
</body>
</html>