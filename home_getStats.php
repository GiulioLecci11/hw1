<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: login.php");
        exit;
    }
    $conn=mysqli_connect("localhost","root","","hw1");
    $profile= array();
    $user=mysqli_real_escape_string($conn,$_SESSION["username"]);
    $res=mysqli_query($conn,"SELECT * from users where username='$user'");
    while($userinfo = mysqli_fetch_assoc($res))
      {
        if($userinfo["postnumber"]<=0){
            $url="imgs/1.jpg";
            $songReq=1;
        }
        else if ($userinfo["postnumber"]>0 && $userinfo["postnumber"]<=4){
            $url="imgs/2.jpg";
            $songReq=2;
        }
        else if ($userinfo["postnumber"]>4 && $userinfo["postnumber"]<=9){
            $url="imgs/3.jpg";
            $songReq=3;
        }
        else{$url="imgs/4.jpg";
            $songReq=4;}
        $profile[] = array( 'usern'=>$userinfo['username'],'url'=>$url,'songReq'=>$songReq, 'postnumber' => $userinfo["postnumber"]);
      }
      mysqli_free_result($res);
      mysqli_close($conn);
      echo json_encode($profile);
      exit;

?>