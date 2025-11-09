<?php
require_once "./forumDB.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

$forumDB = new forumDB();
$id = htmlspecialchars($_SESSION['id']);
if(!empty($_POST['title'])) {
    $title = htmlspecialchars($_POST['title']);
} else {
    $title = "Без названия";
}
$post = htmlspecialchars($_POST['post']);

try {
    $forumDB->insertNewPost($id, $title, $post);
    header("Location:/../views/writePost.php");
    $_SESSION['message'] = "Пост успешно добавлен!";
    exit();
} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>