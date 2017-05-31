<?php
if (isset($_POST['vote'])) {
    $vote = $_POST['vote'];
    $cookie_name = "voted";
    setcookie($cookie_name, $vote, time() + (86400 * 30), "/"); // 86400 = 1 day

    $file = fopen("data.txt", "a");
    $voted = $_POST['vote']."\n";
    fwrite($file, $voted);
    fclose($file);
}
header('Location: main.php');
exit();