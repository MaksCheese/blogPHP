<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $password = sha1($_POST['password']);

    
    $check_user = mysqli_query($link, "SELECT * FROM users WHERE login = '$login' AND password = '$password'");
    
    if(mysqli_num_rows($check_user) > 0){
        $user = mysqli_fetch_assoc($check_user);
        $_SESSION['user'] =[
            "id" => $user['id'],
            "userName" => $user['userName'],
            "login" => $user['login'],
            "userPhoto" => $user['userPhoto'],
            "email" => $user['email'],
            "aboutUser" => $user['aboutUser'],
        ];
        header('Location: ../allPosts.php');

    } else{
        $_SESSION['message'] = 'Неверный логин или пароль';
        header('Location: ../authorize.php');
    }

    

