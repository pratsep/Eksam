<?php
function log_out(){
    if(isset($_SESSION['user'])) {
        session_unset();
        session_destroy();
        $_SESSION = array();
        header("Location: main.php");
        die;
    }
    //header("Location: ?navigate=main");
}
function log_in(){
    $_SESSION['user'] = $_POST['userID'];
    header("Location: main.php");
    die;
}
function login_form() {
    echo '
    <div class="loginForm">
        <form method="post" action="?navigate=login">
            <input id="username_field" type="text" name="userID" placeholder="Username" pattern="[A-Za-z]{0,10}" title="To create new user type in desired username and Log in. Or log in with existing user. Username must be up to 10 uppercase and lowercase letters" autofocus required/>
            <input id="login_button" type="submit" value="Log in"/>
        </form>
    </div>
  ';
}
function add_post(){
    global $conn;
    include ('views/add_note.html');
    if (isset($_POST['comment']) && isset($_SESSION['user'])) {
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $user = mysqli_real_escape_string($conn, $_SESSION['user']);
        mysqli_query($conn, "insert into pratsep_usernotes(username, notes)
                               values('$user', '$comment')")
        or die("MySQL error:" . $conn->error);
        header('Location: main.php');
        exit();
    }
}
function delete_post(){
    global $conn;
    if (isset($_POST['delete'])) {
        /*
        $confirm = "SELECT * FROM pratsep_usernotes WHERE id = '" . mysqli_real_escape_string($conn, $_POST['delete']) . "'";
        $result = mysqli_query($conn, $confirm);
        $check = mysqli_fetch_assoc($result);
        */
        $sql = "DELETE FROM pratsep_usernotes WHERE id='" . mysqli_real_escape_string($conn, $_POST['delete']) . "'";
        mysqli_query($conn, $sql);
        header('Location: main.php');
        exit();
    }
}
function edit_post(){
    global $conn;
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
    include('views/edit_note.html');
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function configDB(){
    global $conn;
    $servername = "localhost";
    $username = "test";
    $password = "t3st3r123";
    $dbname = "test";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Ei saanud ühendada: ".$conn->connect_error);
    }
}
function showPosts(){
    global $conn;
    if(isset($_SESSION['user'])){
        $posts = array();
        $sql = "SELECT * FROM pratsep_usernotes WHERE username='".$_SESSION['user']."' order by id DESC ";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $posts[] = $row;
            }
        }
    }else{
        $users = array();
        $sql = "SELECT DISTINCT username FROM pratsep_usernotes";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));;
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }
    }

    include('views/eksam.html');
}