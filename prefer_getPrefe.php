<?php
      session_start();
      if(!isset($_SESSION["username"])){
          header("Location: login.php");
          exit;
      }
      $conn = mysqli_connect("localhost", "root", "", "hw1");
      $utenti = array();
      $preferente=mysqli_real_escape_string($conn, $_SESSION["username"]);
      $res = mysqli_query($conn,( "SELECT users.id as id, users.username as username, users.postnumber as postnumber, users.email as email 
      FROM users inner join pref on users.id=pref.preferito
      WHERE preferente= (SELECT id FROM users where username='$preferente') ORDER BY users.postnumber DESC"));
      while($row = mysqli_fetch_assoc($res))
      {
            $utenti[] = $row;
      }
      mysqli_free_result($res);
      mysqli_close($conn);
      echo json_encode($utenti);
?>