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
function print_form() {
    echo '
    <div class="loginForm">
        <form method="post" action="?navigate=login">
            <input type="text" name="userID" placeholder="Username" required/>
            <input id="login_button" type="submit" value="Log in"/>
        </form>
    </div>
  ';
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

    include('eksam.html');
}