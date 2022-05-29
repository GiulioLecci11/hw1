<?php
session_start();
    if(!isset($_SESSION["username"])){
      header("Location: login.php");
      exit;
  }  
      if(isset($_GET["text"]))
      {
            $conn = mysqli_connect("localhost", "root", "", "hw1");
            $text = mysqli_real_escape_string($conn, $_GET["text"]);
            $creator=mysqli_real_escape_string($conn, $_SESSION["username"]);
            $res=mysqli_query($conn,"SELECT * FROM users WHERE username='$creator'");
            $row=mysqli_fetch_assoc($res);
            $idcreator=$row["id"];
            mysqli_query($conn, "INSERT INTO post (codCreator,text) VALUES ('$idcreator','$text')" );
            mysqli_close($conn);
      }

?>