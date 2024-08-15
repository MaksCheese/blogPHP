<?php 
    session_start();
    require_once 'inc/connect.php';

    $postID = $_GET['id'];
    $posts = mysqli_query($link, "SELECT * FROM `posts".$_SESSION['user']['id']."` WHERE id = '$postID'");

    $postArr = mysqli_fetch_all($posts);
    foreach($postArr as $post){
        // print_r($post);
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/allPosts.css">
    <link rel="stylesheet" href="css/post.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include 'templates/nav.php';?>

    <div class="formPost">
        <div class="rowAbout">
            <div class="rowAbout">
                <div class="leftColPost">
                    <img src="<?php print_r($post[4]); ?>" style="width: 500px; height: 400px; border-radius: 10px">
                </div>
                <div class="rightColPost">
                    <div class="theme"><?php print_r($post[1]);?></div>
                    <div class="text"><?php print_r($post[3]);?></div>
                    
                </div> 
                <div class="date"><?php print_r($post[5]); ?></div>     
            </div>
        </div>        
    </div>
    <div class="btnComments">        
        <a class="more" href="addComment.php?id=<?=$postID;?>" style="color: #200772; font-weight: bold; font-style: italic;">Комментаровать</a>
    </div>
    <div class="comments">
        <h2>Комментарии:</h2>
    </div>
        <?php 
            $userID = $_SESSION['user']['id'];
            $themePost = mysqli_fetch_all(mysqli_query($link, "SELECT postTheme, date FROM `posts".$userID."` WHERE id = $postID"));
            foreach($themePost as $themeP){}
        
            $theme = $themeP[0];
            $sqlDate = $themeP[1];
            // $sqlDateQuery = mysqli_query($link, "SELECT date FROM `posts".$userID."` WHERE id = $postID");
            // $sqlDateQuery = date('d.m.Y', strtotime($themeP[1]));
        
            $tableName = $theme . $sqlDate;

            $qAll = mysqli_query($link, "SELECT * FROM `comment".$tableName."`");
            if(!$qAll){
                // print_r("Error: " . mysqli_error($link));
                die();
            }
            $comments = mysqli_fetch_all($qAll);
            foreach($comments as $com){

            
        ?>
    <div class="comment">
        <div class="loginComm">
            <div>
                <?= $com[1];?>
            </div>
        </div>
        <div class="textCom">
            <div>
                <?= $com[2];?>
            </div>
        </div>
        <div class="dateCom">
            <div>
                <?= $com[3];?>
            </div>
        </div>
    </div>
    <?php }?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
</body>
</html>