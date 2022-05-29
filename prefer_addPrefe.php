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
            $res=mysqli_query($conn, "SELECT * FROM pref where preferito='$userid' and preferente=(SELECT id FROM users WHERE username='$preferente')");
            if(mysqli_num_rows($res)==0){
            mysqli_query($conn, "INSERT INTO pref(preferente,preferito) VALUES ((SELECT id FROM users WHERE username=\"$preferente\"),\"$userid\" )");
            }
            mysqli_close($conn);
      }

?>