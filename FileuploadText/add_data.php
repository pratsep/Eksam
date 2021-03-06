<?php
session_start();
if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}
$filecount = 0;
if(isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
    $extensions = array("txt");
    $file_name = $_FILES['image']['name'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];

    if (in_array($file_ext, $extensions) === false) {
        $_SESSION['errors'] = "Extension not allowed, please choose a TXT file";
    }
    if(empty($_SESSION['errors'])){
        $directory = "files/";
        $files = glob($directory . "*");
        $filecount = count($files)+1;
        move_uploaded_file($file_tmp,$directory.$filecount.'.'.$file_ext);
    }
}
header('Location: main.php');
exit();