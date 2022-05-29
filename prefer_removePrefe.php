<?php
session_start();
    if(!isset($_SESSION["username"])){
      header("Location: login.php");
      exit;
  }  
      if(isset($_GET["id_user"]))
      {
            $conn = mysqli_connect("localhost", "root", "", "hw1");
            $userid = mysqli_real_escape_string($conn, $_GET["id_user"]);
            $preferente=mysqli_real_escape_string($conn, $_SESSION["username"]);    
            mysqli_query($conn, "DELETE FROM pref WHERE preferente= (SELECT id FROM users WHERE username='$preferente')AND preferito = '".$userid."'");
            mysqli_close($conn);
      }

?>