<?php
require_once "./forumDB.php";
session_start();

$forumDB = new forumDB();
$login = htmlspecialchars($_POST['login']);
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$hash = password_hash($password1, PASSWORD_DEFAULT);

if($password1 !== $password2) {
    $_SESSION['error'] = "Пароли не совпадают";
    header("Location:/../views/register.php");
    exit();
}

if($forumDB->checkLogin($login) !== 0) {
    $_SESSION['error'] = "Такой логин уже есть";
    header("Location:/../views/register.php");
    exit();
}

try {
    $forumDB->insertUser($login, $hash);
    $_SESSION['id'] = (int)($forumDB->getUser($login))['id'];
    $_SESSION['login'] = $login;
    header("Location:/../views/main.php");
    exit();
} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>