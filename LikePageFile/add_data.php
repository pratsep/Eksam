<?php
require_once('func.php');
if (isset($_POST['vote']) && $_POST['vote'] == 1) {
    //$vote = $_POST['vote'];
    $cookie_name = "voted";
    setcookie($cookie_name, "yes", time() + (86400 * 30), "/"); // 86400 = 1 day

    if (filesize("data.txt") != 0){
        $file = fopen("data.txt", "r");
        $data = fgets($file) + 1;
        fclose($file);
    }else{
        $file = fopen("data.txt", "r");
        $data = 1;
        fclose($file);
    }

    $file = fopen("data.txt", "w");
    fwrite($file, $data);
    fclose($file);
}
header('Location: main.php');
exit();