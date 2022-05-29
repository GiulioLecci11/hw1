<?php

if(isset($_GET["song"])){

$client_id = 'd9552ed1bd0b4b4f909b8b4c6996eaf5';
$client_secret = '950b4850d3da47c8a8f78297c6a7a459';
$conn = mysqli_connect("localhost", "root", "", "hw1");

$curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    
    $token = json_decode($result)->access_token;
    $songReq=mysqli_real_escape_string($conn, $_GET["song"]);

    switch($songReq){
        case '1': $data = http_build_query(array("q" => "life's incredible", "type" => "track"));
        break;
        case '2': $data = http_build_query(array("q" => "robot rock", "type" => "track"));
        break;
        case '3': $data = http_build_query(array("q" => "Embraced by the flame", "type" => "track"));
        break;
        case '4': $data = http_build_query(array("q" => "heart of courage", "type" => "track"));
        break;
        default:
    }    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?".$data);
    $headers = array("Authorization: Bearer ".$token);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    print_r($result);
    
}
?>