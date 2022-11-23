<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    $myBlogID = $_GET['myBlogID'];
    $myBlogID = $connect -> real_escape_string($myBlogID);

    $sql = "DELETE FROM myBlog WHERE myBlogID={$myBlogID}";
    $connect -> query($sql);
?>

<script>
location.href = "http://se11se.dothome.co.kr/php/blog/blog.php";
</script>