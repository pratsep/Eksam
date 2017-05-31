<?php
function cookie(){
    global $voted;
}

function show_average(){
    global $voted;
    $total = 0;
    $count = 0;

    $posts = array();
    if (filesize("data.txt") != 0){
        $file = fopen("data.txt", "r");
        while(!feof($file)) {
            $posts[] = fgets($file);
        }
        for($i=0; $i<count($posts)-1; $i++){
            $total = $total + $posts[$i];
            $count = $count + 1;
        }
        fclose($file);
    }

    if($count > 0){
        $average = $total/$count;
    }

    $cookie_name = "voted";
    if(!isset($_COOKIE[$cookie_name])) {
        $cookie_value = 0;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $voted = "Sina pole veel hinnanud!";
    }else{
        if($_COOKIE[$cookie_name] == 0) {
            $voted = "Sina pole veel hinnanud!";
        }else {
            $voted = "Sina andsid hindeks " . $_COOKIE[$cookie_name];
        }
    }

    //cookie();
    include('eksam.html');
}