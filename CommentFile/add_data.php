<?php
require_once('func.php');
if (isset($_POST['user']) && isset($_POST['comment'])) {
    $file = fopen("comments.txt", "a");
    $username = $_POST['user']."\n";
    fwrite($file, $username);
    $comment = $_POST['comment']."\n";
    fwrite($file, $comment);
    fclose($file);
}
header('Location: main.php');
exit();