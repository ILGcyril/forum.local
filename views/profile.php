<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header("Location:../index.php");
        exit();
    }
    ?>
    <h1>Мой профиль</h1>
    <h2>Мой логин: <? echo $_SESSION['login']?></h2>
    <?php
    require_once "../inc/forumDB.php";
    $forumDB = new forumDB();
    if(!empty($forumDB->getUsersPosts($_SESSION['login']))){
    foreach($forumDB->getUsersPosts($_SESSION['login']) as $post)
        {
            echo "
            <h2>Все мои посты: </h2><hr>" .
            "<p><strong>«" . $post['title'] . "»</strong></p>" .
            "<p>" . $post['post'] . "</p><br>" .
            "<form action='./postPage.php' method='get'>
            <input type='hidden' name='post_id' value='" . htmlspecialchars($post['id']) . "'>
                <button type='submit'>
                    Редактировать пост
                </button>
            </form><br>
            <form action='../inc/deletePost.php' method='post'>
            <input type='hidden' name='post_id' value='" . htmlspecialchars($post['id']) . "'>
                <button type='submit'>
                    Удалить пост
                </button>
            </form>" .  "<hr>";
        }
    } else {
        echo "<br><h2>У вас нет постов</h2>";
    }
    ?><br>
    <a href="./main.php">Назад</a><br><br>
    <?php
    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
</body>
</html>