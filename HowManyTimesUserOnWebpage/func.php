<?php

function show_visit_info(){
    $current_visit = Date('H:i:s d-m-Y');

    if(!isset($_COOKIE["total_visits"])) {
        $visits = 1;
        setcookie("total_visits", $visits, time() + (86400 * 30 * 12 * 5), "/"); // 86400 = 1 day
    }else{
        $visits = $_COOKIE["total_visits"]+1;
        setcookie("total_visits", $visits, time() + (86400 * 30 * 12 * 5), "/");
    }

    if(!isset($_COOKIE["last_visit"])) {
        $last_visit = 0;
        setcookie("last_visit", $current_visit, time() + (86400 * 30 * 12 * 5), "/");
    }else{
        $last_visit = $_COOKIE["last_visit"];
        setcookie("last_visit", $current_visit, time() + (86400 * 30 * 12 * 5), "/");
    }

    include('eksam.html');
}