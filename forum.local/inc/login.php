<?php
session_start();
require_once "./forumDB.php";

$forumDB = new forumDB();
$login = htmlspecialchars($_POST['login']);
$password = $_POST['password'];

if($forumDB->checkLogin($login) == 0) {
    $_SESSION['error'] = "Неправильный логин или пароль";
    header("Location:/../index.php");
    exit();
}

if(!password_verify($password, ($forumDB->getUser($login))['password'])) {
    $_SESSION['error'] = "Неправильный логин или пароль";
    header("Location:/../index.php");
    exit();
} else {
    $_SESSION['id'] = (int)($forumDB->getUser($login))['id'];
    $_SESSION['login'] = $login;
    header("Location:../views/main.php");
    exit();
}
?>