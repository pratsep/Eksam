<?php
function visit_info(){
    global $posts;
    $errors = array();
    $file = fopen("data.txt", "a");

    $ip = $_SERVER['REMOTE_ADDR']."\n";
    fwrite($file, $ip);
    fclose($file);
    if (filesize("data.txt") == 0){
        $errors[] = "Fail on millegipärast tühi!";
    } else {
        $file = fopen("data.txt", "r");
        while(!feof($file)) {
            $posts[] = fgets($file);
            //$posts[] = explode("\n", fread($file, filesize("comments.txt")));
        }
        fclose($file);
    }
    include('eksam.html');

}


