<?php
session_start();
    if(!isset($_SESSION["username"])){
      header("Location: login.php");
      exit;
  }  
      if(isset($_GET["id_post"]))
      {
            $conn = mysqli_connect("localhost", "root", "", "hw1");
            $postid = mysqli_real_escape_string($conn, $_GET["id_post"]);
            $creator=mysqli_real_escape_string($conn, $_SESSION["username"]); 
            $res=mysqli_query($conn,"SELECT * FROM users WHERE username='$creator'");
            $row=mysqli_fetch_assoc($res);
            $idcreator=$row['id'];
            mysqli_query($conn, "DELETE FROM post WHERE codCreator='$idcreator' AND id = '".$postid."'");
            mysqli_close($conn);
      }

?>