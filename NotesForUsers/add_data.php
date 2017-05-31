<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Notes++</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
session_start();
require_once('func.php');
configDB();

if (isset($_POST['comment']) && isset($_SESSION['user'])) {
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $user = mysqli_real_escape_string($conn, $_SESSION['user']);
    mysqli_query($conn, "insert into pratsep_usernotes(username, notes)
                               values('$user', '$comment')")
    or die("MySQL error:" . $conn->error);
    header('Location: main.php');
    exit();
}
if (isset($_POST['delete'])) {
    $confirm = "SELECT * FROM pratsep_usernotes WHERE id = '" . mysqli_real_escape_string($conn, $_POST['delete']) . "'";
    $result = mysqli_query($conn, $confirm);
    $check = mysqli_fetch_assoc($result);
    $sql = "DELETE FROM pratsep_usernotes WHERE id='" . mysqli_real_escape_string($conn, $_POST['delete']) . "'";
    mysqli_query($conn, $sql);
    header('Location: main.php');
    exit();
}
if (isset($_POST['edit'])) {
    $confirm = "SELECT * FROM pratsep_usernotes WHERE id = '" . mysqli_real_escape_string($conn, $_POST['edit']) . "'";
    $result = mysqli_query($conn, $confirm);
    $check = mysqli_fetch_assoc($result);

}
if(isset($_POST['confirm'])){
    $edited_note = mysqli_real_escape_string($conn, $_POST['confirm']);
    $sql = "UPDATE pratsep_usernotes SET notes = '".$edited_note."' WHERE id=" . mysqli_real_escape_string($conn, $_POST['edit_id']);
    mysqli_query($conn, $sql);
    header('Location: main.php');
    exit();
}
if(!isset($_POST['edit'])){
    echo '<form method="post" action="add_data.php" id="insert_form">';
    echo    '<textarea id="txtArea" name="comment" form="insert_form" placeholder="Enter comment" required></textarea><br>';
    echo    '<input id="submit_button" type="submit" value="Post"/>';
    echo '</form>';
}else{
    echo '<form method="post" action="add_data.php" id="edit_form">';
    echo    '<input type="hidden" name="edit_id" value="'.htmlspecialchars($_POST["edit"]).'"/>';
    echo    '<textarea id="txtArea" name="confirm" form="edit_form" required>'.htmlspecialchars($check["notes"]).'</textarea><br>';
    echo    '<input id="submit_button" type="submit" value="Confirm edit"/>';
    echo '</form>';
}
?>
</body>
</html>


