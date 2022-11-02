<?php
    $host = "localhost";
    $user = "se11se";
    $pw = "Whdtjrdl098!";
    $db = "se11se";
    $connect = new mysqli($host, $user, $pw, $db);
    $connect -> set_charset("utf8");
    if(mysqli_connect_errno()){
        echo "database connect false";
    } else {
        // echo "database connect true";
    }
?>