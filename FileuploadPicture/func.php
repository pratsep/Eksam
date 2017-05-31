<?php
function count_files(){
    $directory = "pics/";
    $files = glob($directory . "*");
    $filecount = count($files);
    include_once('eksam.html');
}
function logout(){
    if(isset($_SESSION['errors'])) {
        session_unset();
        session_destroy();
        $_SESSION = array();
        die;
    }
}