<?php
include "config.php";
$search_value = htmlentities($_POST["search"]);
$sql = "SELECT * FROM users WHERE username LIKE '%{$search_value}%'";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "<ul class='list'>";
if(mysqli_num_rows($result) > 0 ){
              while($row = mysqli_fetch_assoc($result)){
                $output .= "<li class='list-item'><a href='indprofile.php?indid=".$row['id']."'>{$row['username']}</a></li>";
              }
              $output .= "</ul>";
    mysqli_close($conn);
    echo $output;
}else{
    echo "<ul class='list'><li class='list-item'>No records found</li></ul>";
}
?>