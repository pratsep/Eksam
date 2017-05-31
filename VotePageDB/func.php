<?php
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

function show_average(){
    global $conn;
    $total = 0;
    $count = 0;
    $sql = "SELECT * FROM pratsep_vote";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $total = $total + $row['vote'];
            $count = $count + 1;
        }
    }
    if($count > 0){
        $average = $total/$count;
    }
    $cookie_name = "voted";
    if(!isset($_COOKIE[$cookie_name])) {
        $cookie_value = 0;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $voted = "Pole veel hinnanud!";
    }else{
        if($_COOKIE[$cookie_name] == 0) {
            $voted = "Pole veel hinnanud!";
        }else {
            $voted = "Sina andsid hindeks " . $_COOKIE[$cookie_name];
        }
    }
    //cookie();
    include('eksam.html');
}