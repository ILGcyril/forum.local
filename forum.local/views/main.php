<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форум</title>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header("Location:../index.php");
        exit();
    }
    ?>
    <h1>Выбери раздел:</h1>
    <a href="./allPosts.php">Смотреть все посты</a><br><br>
    <a href="./writePost.php">Написать пост</a><br><br>
    <a href="./profile.php">Мой профиль</a><br><br><br><br>
    <a href="../inc/logout.php">Выйти из аккаунта</a>
</body>
</html>