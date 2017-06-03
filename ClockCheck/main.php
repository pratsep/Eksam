<?php
require_once('func.php');

if(!empty($_GET) && isset($_GET['navigate'])){
    $navigate = htmlspecialchars($_GET['navigate']);
}
else{
    $navigate = "main";
}
include_once ('views/head.html');
switch($navigate){
    case "main":
        time_check();
        break;
    case "delete_cookie":
        delete_cookie();
        break;
    default:
        time_check();
        break;
}
include_once ('views/foot.html');