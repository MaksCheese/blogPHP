<?php
    session_start();
    require_once 'connect.php';

    $postID = $_GET['id'];
    $userID = $_SESSION['user']['id'];

    $themePost = mysqli_fetch_all(mysqli_query($link, "SELECT postTheme, date FROM `posts".$userID."` WHERE id = $postID"));
    foreach($themePost as $themeP){}

    $theme = $themeP[0];
    $sqlDate = $themeP[1];
    // $sqlDateQuery = mysqli_query($link, "SELECT date FROM `posts".$userID."` WHERE id = $postID");
    // $sqlDateQuery = date('d.m.Y', strtotime($themeP[1]));

    $tableName = $theme . $sqlDate;
    
    $commentText = $_POST['commentText'];
    $today = date("F j, Y, g:i a");

    
    $userData = mysqli_fetch_all(mysqli_query($link, "SELECT login FROM users WHERE id = $userID"));
    foreach($userData as $usData)
    $userLogin = $usData[0];

    if(!mysqli_query($link, "CREATE TABLE IF NOT EXISTS `phpBlog`.`comment".$tableName."`
                                                            (`id` INT NOT NULL AUTO_INCREMENT ,
                                                             `usersLogin` VARCHAR (100) NULL ,
                                                             `commentText` VARCHAR (1000) NULL ,
                                                             `date` VARCHAR (50) NULL ,
                                                             PRIMARY KEY (`id`)) ENGINE = InnoDB;
                                                            ")){
        print_r("Error: " . mysqli_error($link));                               
    } else{                  
        mysqli_query($link, "INSERT INTO `comment".$tableName."` SET id = NULL, usersLogin = '$userLogin', commentText = '$commentText', date = '$today'");
            // $posts = mysqli_query($link, "SELECT * FROM `posts".$userID."`");
            // if(!$posts){
            //     die("Ошибка");
            // }
            // $posts = mysqli_fetch_all($posts);
            // foreach($posts as $post){}                             
                
        header('Location: ../post.php?id='.$postID);
    }
    