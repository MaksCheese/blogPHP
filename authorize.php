<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать!</title>
    <link rel="stylesheet" href="css/main.css">
    
</head>
<body>
    <h1>С возвращением!</h1>
    <form action="inc/authorization.php" method="post">
        <label>Логин</label>
        <input type="text" placeholder="Введите ваш логин" name="login">

        <label>Пароль</label>
        <input type="password" placeholder="Введите пароль" name="password">

        <button type="submit">Войти</button>
        <p>
            У вас еще нет аккаунта? | <a href="/">зарегестрироваться</a>
        </p>
        <?php 
            if($_SESSION['message']){
                echo '<p class="msg">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']);
        ?>
    </form>
</body>
</html>