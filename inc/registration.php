<?php
    session_start();
    require_once 'connect.php';

    $userName = $_POST['userName'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_check = $_POST['password_check'];
    $aboutUser = $_POST['aboutUser'];

    mysqli_query($link, "CREATE TABLE IF NOT EXISTS `phpBlog`.`users` (`id` INT NOT NULL AUTO_INCREMENT ,
                                                                        `userName` VARCHAR (255) NULL , 
                                                                        `login` VARCHAR (255) NULL ,
                                                                        `email` VARCHAR (255) NULL ,
                                                                        `password` VARCHAR (255) NULL ,
                                                                        `userPhoto` VARCHAR (255) NULL ,
                                                                        `aboutUser` VARCHAR (4000) NULL ,
                                                                        PRIMARY KEY (`id`)) ENGINE = InnoDB;");

    $checkLogin = mysqli_query($link, "SELECT * FROM users WHERE login = '$login'");

    if(mysqli_num_rows($checkLogin) > 0) {
        $_SESSION['message'] = 'Такой логин уже существует!';
        header('Location: ../index.php');
    } else {
        if($password === $password_check) {
            $path = 'uploads/avatarsImgs/' . time() . $_FILES['userPhoto']['name'];
            if(!move_uploaded_file($_FILES['userPhoto']['tmp_name'], '../' . $path)){
                $_SESSION['message'] = 'Ошибка при загрузке изображения';
                header('Location: ../index.php');
            }

            $password = sha1($password);

            mysqli_query($link, "INSERT INTO `users` (`id`, `userName`, `login`, `email`, `password`, `userPhoto`, `aboutUser`) 
                                VALUES (NULL, '$userName', '$login', '$email', '$password', '$path', '$aboutUser')");
            $_SESSION['message'] = 'Регистрация прошла успешно!';
            header('Location: ../authorize.php');
        } else {
            $_SESSION['message'] = 'Пароли не совпадают';
            header('Location: ../index.php');
        }
    }
?>

