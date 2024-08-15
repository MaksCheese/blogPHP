<?php 
    session_start();
    require_once 'inc/connect.php';
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
    <div class="container">
        <div class="infoUser">
            <?php 
                $userID = $_GET['id'];

                $aboutUser = mysqli_query($link, "SELECT * FROM `users` WHERE `id` = $userID");
                $userArr = mysqli_fetch_all($aboutUser);
                foreach($userArr as $usArr){

                }
            ?>
            <div class="photo">
                <img src="<?php print_r($usArr[5]);?>" style="width: 200px; height: 200px" alt="Avatar">
            </div>
            <div class="infoAbout">
                <p>Имя: <?php print_r($usArr[1]);?></p>
                <p>Email: <?php print_r($usArr[3]);?></p>
                <p>Немного обо мне:<br> <?php print_r($usArr[6]);?></p>
            </div>
        </div>
    </div>    
    <?php 
        if(!mysqli_query($link, "SELECT * FROM `posts".$userID."`")){
            include 'templates/printPost.php';
        } else{
    ?>
    <div class="allContainer">        
        <div class="container post1">
            <div class="posts">
                <?php 
                    $posts = mysqli_query($link, "SELECT * FROM `posts".$userID."`");
                    if(!$posts){
                        die("Ошибка");
                    }
                    $posts = mysqli_fetch_all($posts);
                    foreach($posts as $post){                                
                ?>
                <div class="container post2">
                    <div class="row">                    
                        <div class="col">
                            <div class="main-block">    
                                <div class="rowAbout">
                                    <div class="colLeft">
                                        <div class="postPhoto">
                                            <img src="<?= $post[4]?>" alt="" style="width: 200px; height: 200px;">
                                        </div>
                                    </div>
                                    <div class="colRight">
                                        <div class="postTheme">
                                            <?= $post[1];?>                                        
                                        </div>
                                        <div class="postDesc">
                                            <?= $post[2];?>
                                        </div>
                                        <div class="postDate">
                                            <a class="more" href="post.php?id=<?= $post[0]?>" style="color: #200772; font-weight: bold; font-style: italic;">Подробнее</a>
                                            <?= $post[5];?>
                                        </div>
                                    </div>
                                 </div>    
                            </div>
                        </div>
                    </div>       
                </div> 
                <?php }}?>                           
            </div>            
        </div>
        
        <div class="allUsers">
            <?php 
                $users = mysqli_query($link, "SELECT id, login FROM users");
                $usersAll = mysqli_fetch_all($users);
                foreach($usersAll as $usAll){
            ?>
            <div class="anyUser">
                <p class="user"><a href="anotherUser.php?id=<?= $usAll[0];?>" style="text-decoration: none; color: black;"><?= $usAll[1];?></a></p>
            </div>
            <?php }?>
        </div>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
</body>
</html>