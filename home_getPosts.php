<?php
    $conn=mysqli_connect("localhost","root","","hw1");
    $posts=array();
    $res=mysqli_query($conn,"SELECT p.id as id, u.username as creator, p.text as text, u.postnumber as postnumber, p.time as time FROM post p inner join users u on p.codCreator=u.id ORDER BY p.id DESC LIMIT 10");
    while($row = mysqli_fetch_assoc($res))
      {
            $time= getTime($row['time']);
            $posts[] = array( 'id'=>$row['id'],'creator' => $row['creator'], 'postnumber' => $row["postnumber"], 'text'=> $row["text"], "time"=>"$time");
      }
      mysqli_free_result($res);
      mysqli_close($conn);
      echo json_encode($posts);
      exit;

      function getTime($timestamp) {            
            $posted = strtotime($timestamp); 
            $diff = time() - $posted;           
            $posted = date('d/m/y', $posted);
    
            if ($diff /60 <1) {
                return intval($diff%60)." secondi fa";
            } else if (intval($diff/60) == 1)  {
                return "Un minuto fa";  
            } else if ($diff / 60 < 60) {
                return intval($diff/60)." minuti fa";
            } else if (intval($diff / 3600) == 1) {
                return "Un'ora fa";
            } else if ($diff / 3600 <24) {
                return intval($diff/3600) . " ore fa";
            } else if (intval($diff/86400) == 1) {
                return "Ieri";
            } else if ($diff/86400 < 30) {
                return intval($diff/86400) . " giorni fa";
            } else {
                return $posted; 
            }
        }
    
    
?>