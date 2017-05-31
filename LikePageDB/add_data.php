<?php
require_once('func.php');
configDB();
if (isset($_POST['vote']) && $_POST['vote'] == 1) {
    $cookie_name = "voted";
    setcookie($cookie_name, "1", time() + (86400 * 30), "/"); // 86400 = 1 day
    $sql = "UPDATE pratsep_like SET liked = liked + 1";
    mysqli_query($conn, $sql)
    or die("MySQL error:" . $conn->error);
}
header('Location: main.php');
exit();