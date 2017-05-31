<?php
function showPosts(){
    $posts = array();
    $errors = array();
    if (filesize("comments.txt") == 0){
        $errors[] = "Kommentaarid puuduvad";
    } else {
        $file = fopen("comments.txt", "r");
        while(!feof($file)) {
            $posts[] = fgets($file);
            //$posts[] = explode("\n", fread($file, filesize("comments.txt")));
        }
        fclose($file);
    }
    include('comment.html');
}