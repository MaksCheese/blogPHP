<?php   
    session_start();
    require_once 'connect.php';

    $postID = $_GET['id'];

    mysqli_query($link, "DELETE FROM `posts".$_SESSION['user']['id']."` WHERE id = '$postID'");
    header('Location: ../allPosts.php');