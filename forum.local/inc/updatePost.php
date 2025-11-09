<?php
require_once "./forumDB.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = (int)$_POST['post_id'];
    $title = trim($_POST['title']);
    $post = trim($_POST['post']);

    $forumDB = new forumDB();
    $existing = $forumDB->getPostById($postId);

    if ($existing['user_id'] == $_SESSION['id']) {
        $forumDB->updatePost($postId, $title, $post);
        $_SESSION['message'] = "Пост успешно обновлён.";
    } else {
        $_SESSION['message'] = "Ошибка доступа.";
    }

    header("Location: ../views/profile.php");
    exit();
}
?>