<?php
echo '<script src="setclienttime.js">clienttime();</script>';
$servertime = round(microtime('get_as_float'));
setcookie("servertime", $servertime, time() + (86400 * 30), "/");
if(isset($_COOKIE['servertime']) && isset($_COOKIE['clienttime'])){
    //echo $_COOKIE['servertime'];
    //echo "<br/>";
    //echo $_COOKIE['clienttime'];
    $difference = $_COOKIE['servertime'] - $_COOKIE['clienttime'];
    //echo "<br/>";
    if($difference < 0){
        echo "Client time is ahead of server time by about ".abs($difference)." seconds!";
    }elseif ($difference > 0){
        echo "Server time is ahead of client time by about ".abs($difference)." seconds!";
    }elseif ($difference == 0){
        echo "Server and client times are synchronized";
    }
}

//header('Location: main.php');