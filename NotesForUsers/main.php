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
include_once ('views/head.html');
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
    case "add_note":
        add_post();
        break;
    case "edit_note":
        edit_post();
        break;
    case "delete_note":
        delete_post();
        break;
    default:
        showPosts();
        break;
}
include_once ('views/foot.html');