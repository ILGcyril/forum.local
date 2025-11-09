<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лента постов</title>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header("Location:../index.php");
        exit();
    }
    ?>
    <h1>Лента постов</h1>
    <p>Добро пожаловать, <?= htmlspecialchars($_SESSION['login'])?>!</p>
    <hr>

    <?php
    require_once "../inc/forumDB.php";
    $forumDB = new forumDB();
    foreach($forumDB->getPosts() as $post)
    {
        echo "<p><strong>Автор: " . $post['login'] . "</strong></p>" . 
        "<p><strong>Название: «" . $post['title'] . "»</strong></p>" .
        "<p>" . $post['post'] . "</p><br><hr>";
    }
    ?><br>
    <a href="./main.php">Назад</a>

</body>
</html>