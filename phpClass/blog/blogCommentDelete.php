<?php
    include "../connect/connect.php";
    $myCommentID = $_POST['commentID'];
    $pass = $_POST['pass'];
    $regTime = time();

    $sql = "DELETE FROM myComment WHERE commentID=$myCommentID";
    $result = $connect -> query($sql);

    echo json_encode(array("info" => $myCommentID));
?>