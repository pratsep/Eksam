<?php
require_once('func.php');
configDB();
if (isset($_POST['user']) && isset($_POST['comment'])) {
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    mysqli_query($conn, "insert into pratsep_touchdown(username, comment)
                               values('$username','$comment')")
    or die("MySQL error:" . $conn->error);
}
header('Location: main.php');
exit();