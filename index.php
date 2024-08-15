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
    <h1>Добро пожаловать в Личный блог!</h1>
    <h2>Зарегистрируйтесь и начинайте делиться событиями и личным опытом!</h2>
    <form action="inc/registration.php" method="post" enctype="multipart/form-data">
        <label>Имя</label>
        <input type="text" placeholder="Введите ваше имя" name="userName">

        <label>Логин</label>
        <input type="text" placeholder="Введите ваш логин" name="login">

        <label>Email</label>
        <input type="text" placeholder="Введите вашу почту" name="email">

        <label>Пароль</label>
        <input type="password" placeholder="Введите пароль" name="password">

        <label>Подтверждение пароля</label>
        <input type="password" placeholder="Подтвердите пароль" name="password_check">

        <label type="text">Выберите изображение</label>
        <input type="file" name="userPhoto">

        <label>Расскажите о себе</label>
        <textarea class="form-control input-textarea" style="width: 390px; height: 100px" name="aboutUser" id=""></textarea>

        <button type="submit">Зарегестрироваться</button>
        <p>
            У вас есть аккаунт? | <a href="authorize.php">авторизироваться</a>
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