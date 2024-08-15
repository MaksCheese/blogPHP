<?php
    $link = mysqli_connect('localhost', 'root', '', 'phpBlog');

    if(!$link){
        die('Error connect to DataBase!');
    }