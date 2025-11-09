<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пост</title>
</head>
<body>
    <?php
    session_start();
    require_once "../inc/forumDB.php";

    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");
        exit();
    }

    $forumDB = new forumDB();

    if (!isset($_GET['post_id'])) {
        die("Пост не найден.");
    }

    $postId = (int)$_GET['post_id'];
    $post = $forumDB->getPostById($postId);

    if (!$post || $post['user_id'] !== $_SESSION['id']) {
        die("Ошибка доступа: вы не можете редактировать этот пост.");
    }
    ?>

    <h1>Редактировать пост</h1>
    <form action="../inc/updatePost.php" method="post">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <label>Заголовок:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>"><br><br>
        <label>Текст поста:</label><br>
        <textarea name="post" rows="6" cols="60"><?= htmlspecialchars($post['post']) ?></textarea><br><br>
        <input type="submit" value="Сохранить изменения"><br><br>
    </form>
        
    <a href="./profile.php">Назад</a>
</body>
</html>