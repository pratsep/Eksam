<?php

function time_check(){
    include('views/eksam.html');
}
function delete_cookie(){
    setcookie('servertime', '', 1, '/');
    setcookie('clienttime', '', 1, '/');
    header('Location: main.php');
    exit();
}