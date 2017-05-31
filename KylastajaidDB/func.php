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
function counter(){
    global $conn;
    $sql = "SELECT * FROM pratsep_hit LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) != 0){
        $sql = "UPDATE pratsep_hit SET counter = counter + 1";
        mysqli_query($conn, $sql);
        $sql = "SELECT * FROM pratsep_hit";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
        $row = mysqli_fetch_assoc($result);
        include('eksam.html');
    } else {
        mysqli_query($conn, "insert into pratsep_hit(counter)
                               values('0')");
    }
}