<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Написать пост</title>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header("Location:../index.php");
        exit();
    }
    ?>
    <h1>Создай свой новый пост:</h1>
    <form action="../inc/insertNewPost.php" method="POST">
        <label for="title">Название поста:</label><br>
        <input type="text" id="title" name="title"><br><br>

        <label for="post">Пост:</label><br>
        <textarea name="post" id="post" rows="10" cols="60" placeholder="напиши сюда" required></textarea><br><br>

        <input type="submit" value="отправить">
    </form><br><br>

    <a href="./main.php">Назад</a><br><br>
    <?php
        if(isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    ?>
</body>
</html>