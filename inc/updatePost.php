<?php
    session_start();
    require_once 'connect.php';

    $userID = $_SESSION['user']['id'];

    $id = $_POST['id'];
    $postTheme = $_POST['postTheme'];
    $postDesc = $_POST['postDesc'];
    $postText = $_POST['postText'];

    $pathPhoto = 'uploads/postsImgs/' . time() . $_FILES['postPhoto']['name'];
        if(!move_uploaded_file($_FILES['postPhoto']['tmp_name'], '../' . $pathPhoto)){
            $_SESSION['message'] = 'Ошибка при загрузке изображения';
            header('Location: ../addPost.php');
        }

        mysqli_query($link, "UPDATE `posts".$userID."` SET postTheme = '$postTheme', postDesc = '$postDesc', postText = '$postText', postPhoto = '$pathPhoto' WHERE `posts".$userID."`.id = '$id'");
        header('Location: ../allPosts.php');


    
