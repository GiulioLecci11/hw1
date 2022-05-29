<?php 
    if (!isset($_GET["q"])) {
        echo "Accesso illecito";
        exit;
    }
    header('Content-Type: application/json');
    $conn=mysqli_connect("localhost","root","","hw1");
    $username = mysqli_real_escape_string($conn, $_GET["q"]);
    $query = "SELECT username FROM users WHERE username = '$username'";
    $res = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($res) > 0){
        echo json_encode(array('exists' => true));
    }
    else echo json_encode(array('exists' => false));

    mysqli_close($conn);
?>