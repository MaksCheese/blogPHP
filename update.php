<?php
    session_start();
    require_once 'inc/connect.php';

    $userID = $_SESSION['user']['id'];

    $postID = $_GET['id'];
    $posts = mysqli_query($link, "SELECT * FROM `posts".$_SESSION['user']['id']."` WHERE id = '$postID'");

    if(!$posts){
        echo "Error: " . mysqli_error($link);
    }
    $postArr = mysqli_fetch_all($posts);
    foreach($postArr as $post){
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/allPosts.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include 'templates/nav.php';?>

    <div class="formPost">
        <form action="inc/updatePost.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $post['0']?>">
            <label>Тема</label>
            <input type="text" placeholder="Введите тему поста" name="postTheme" value="<?php print_r($post['1'])?>">

            <label>Описание</label>
            <textarea class="form-control input-textarea" style="width: 690px; height: 150px" name="postDesc"><?php print_r($post['2'])?></textarea>
    
            <label>Текст</label>
            <textarea class="form-control input-textarea" style="width: 690px; height: 300px" name="postText" ><?php print_r($post['3'])?></textarea>
    
            <label type="text">Выберите изображение</label>
            <input type="file" name="postPhoto">
    
            <button type="submit">Обновить пост</button>
            <?php 
                if($_SESSION['message']){
                    echo '<p class="msg">' . $_SESSION['message'] . '</p>';
                }
                unset($_SESSION['message']);
            ?>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
</body>
</html>