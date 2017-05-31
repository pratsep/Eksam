<?php

function calculate(){
    $errors = array();
    if(isset($_GET['esimene']) && isset($_GET['teine'])){
        $result = hypot($_GET['esimene'],$_GET['teine']);
    }else{
        $errors[] = "FAILED!";
    }
    include('eksam.html');
}