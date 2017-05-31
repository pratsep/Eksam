<?php
require_once('func.php');
configDB();
if (isset($_POST['vote'])) {
    $vote = mysqli_real_escape_string($conn, $_POST['vote']);
    $cookie_name = "voted";
    setcookie($cookie_name, $vote, time() + (86400 * 30), "/"); // 86400 = 1 day
    mysqli_query($conn, "insert into pratsep_vote(vote)
                               values('$vote')")
    or die("MySQL error:" . $conn->error);
}
header('Location: main.php');
exit();