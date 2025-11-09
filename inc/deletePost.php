<?php
require_once "./forumDB.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

$forumDB = new forumDB();
$post_id = $_POST['post_id'];

try {
    $forumDB->deletePost($post_id);
    header("Location:/../views/profile.php");
    $_SESSION['message'] = "Пост успешно удален!";
    exit();
} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>