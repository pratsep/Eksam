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

function show_votes(){
    global $conn;
    $sql = "SELECT * FROM pratsep_yesno";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $jah = $row['jah'];
    $ei = $row['ei'];

    $cookie_name = "yesno";
    if(!isset($_COOKIE[$cookie_name])) {
        $cookie_value = 0;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $voted = "You have not voted yet, DO IT!";
    }else{
        if($_COOKIE[$cookie_name] == "yes" || $_COOKIE[$cookie_name] == "no") {
            $voted = "You voted <i>" . $_COOKIE[$cookie_name] . "</i>";

        }else{
            $voted = "You have not voted yet, DO IT!";
        }
    }
    include('eksam.html');
}