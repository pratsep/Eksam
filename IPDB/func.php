<?php
function configDB(){
    global $conn;
    $servername = "localhost";
    $username = "test";
    $password = "t3st3r123";
    $dbname = "test";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Ei saanud ühendada: ".$conn->connect_error);
    }
}
function ip(){
    global $conn;
    $ip = mysqli_real_escape_string($conn, $_SERVER['REMOTE_ADDR']);

    $sql = "INSERT INTO pratsep_ip(ip) VALUES('$ip')";
    mysqli_query($conn, $sql);

    $sql = "SELECT DISTINCT ip FROM pratsep_ip;";
    $result = mysqli_query($conn, $sql);
    $unique_ip = mysqli_num_rows($result);
    include('eksam.html');
}