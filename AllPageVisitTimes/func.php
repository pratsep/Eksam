<?php
function visit_info(){
    global $posts;
    $errors = array();
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

    $file = fopen("data.txt", "a");
    //$date = date('H:i:s d-m-Y');
    $last_visit = date('H:i:s d-m-Y')."\n";
    fwrite($file, $last_visit);
    fclose($file);
}


