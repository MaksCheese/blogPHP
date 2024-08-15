<?php 
    session_start();
    require_once 'connect.php';

    $postTheme = $_POST['postTheme'];
    $postDesc = $_POST['postDesc'];
    $postText = $_POST['postText'];

    $pathPhoto = 'uploads/postsImgs/' . time() . $_FILES['postPhoto']['name'];
        if(!move_uploaded_file($_FILES['postPhoto']['tmp_name'], '../' . $pathPhoto)){
            $_SESSION['message'] = 'Ошибка при загрузке изображения';
            header('Location: ../addPost.php');
        }

        $userID = $_SESSION['user']['id'];
        $today = date("F j, Y, g:i a");

        $showTables = mysqli_query($link, "SHOW TABLES FROM 'phpBlog' LIKE `posts'".$userID."'");
        if($showTables == 1) {
            mysqli_query($link, "INSERT INTO `posts".$userID."` SET id = NULL, postTheme = '$postTheme', postDesc = '$postDesc', postText = '$postText', postPhoto = '$pathPhoto', date = '$today'");
        } else{
            mysqli_query($link, "CREATE TABLE `phpBlog`.`posts".$userID."` (`id` INT NOT NULL AUTO_INCREMENT , `postTheme` VARCHAR(150) NULL , `postDesc` VARCHAR(400) NULL , `postText` VARCHAR(2000) NULL , `postPhoto` VARCHAR(500) NULL, `date` VARCHAR(50) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
            mysqli_query($link, "INSERT INTO `posts".$userID."` SET id = NULL, postTheme = '$postTheme', postDesc = '$postDesc', postText = '$postText', postPhoto = '$pathPhoto', date = '$today'");
        }
        header('Location: ../allPosts.php');


        
        

