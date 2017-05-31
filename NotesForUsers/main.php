<?php
session_start();
require_once('func.php');
configDB();

if(!empty($_GET) && isset($_GET['navigate'])){
    $navigate = htmlspecialchars($_GET['navigate']);
}
else{
    $navigate = "main";
}

switch($navigate){
    case "main":
        showPosts();
        break;
    case "logout":
        log_out();
        break;
    case "login":
        log_in();
        break;
    default:
        showPosts();
        break;
}