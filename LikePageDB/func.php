<?php
function delete_cookie(){
    $cookie_name = "voted";
    setcookie("$cookie_name", "", time() - 3600, "/");
}
function cookie(){
    global $voted;
}

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

function show_liked(){
    global $conn;
    $count = 0;
    $sql = "SELECT * FROM pratsep_like";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);
    $count = $row['liked'];


    $cookie_name = "voted";
    if(!isset($_COOKIE[$cookie_name])) {
        $cookie_value = 0;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $voted = "Sina pole veel LIKE pannud!";
    }else{
        if($_COOKIE[$cookie_name] == 0) {
            $voted = "Sina pole veel LIKE pannud!";
        }else {
            $voted = "Sina juba panid lehele LIKE, aga võid seda veel teha :)";
        }
    }

    //cookie();
    include('eksam.html');
}