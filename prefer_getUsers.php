<?php
      session_start();
      if(!isset($_SESSION["username"])){
            header("Location: login.php");
            exit;
        }  
      $conn = mysqli_connect("localhost", "root", "", "hw1");
      $utenti = array();
      $user=mysqli_real_escape_string($conn, $_SESSION["username"]);
      $res = mysqli_query($conn, "SELECT * FROM users WHERE username!='$user'  ORDER BY postnumber DESC");
      while($row = mysqli_fetch_assoc($res))
      {
            $utenti[] = $row;
      }
      mysqli_free_result($res);
      mysqli_close($conn);
      echo json_encode($utenti);
?>