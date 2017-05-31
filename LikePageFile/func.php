<?php
function delete_cookie(){
    $cookie_name = "voted";
    setcookie("$cookie_name", "", time() - 3600, "/");
}
function cookie(){
    global $voted;
}

function show_liked(){
    //global $voted;
    $count = 0;
    if (filesize("data.txt") != 0){
        $file = fopen("data.txt", "r");
        $count = fgets($file);
        fclose($file);
    }

    //cookie();

    $cookie_name = "voted";
    if(!isset($_COOKIE[$cookie_name])) {
        $cookie_value = "no";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $voted = "Sina pole veel LIKE pannud!";
    }else{
        if($_COOKIE[$cookie_name] == "no") {
            $voted = "Sina pole veel LIKE pannud!";
        }else {
            $voted = "Sina juba panid lehele LIKE, aga võid seda veel teha :)";
        }
    }
    include('eksam.html');
}