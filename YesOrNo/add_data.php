<?php
require_once('func.php');
configDB();
if (isset($_POST['vote'])) {
    $vote = $_POST['vote'];

    $cookie_name = "yesno";
    setcookie($cookie_name, $vote, time() + (86400 * 30), "/"); // 86400 = 1 day
    if($_POST['vote'] == "no"){
        $sql = "UPDATE pratsep_yesno SET ei = ei + 1";
        mysqli_query($conn, $sql);
    }elseif($_POST['vote'] == "yes"){
        $sql = "UPDATE pratsep_yesno SET jah = jah + 1";
        mysqli_query($conn, $sql);
    }

}
header('Location: main.php');
exit();