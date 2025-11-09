<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Логин</title>
</head>
<body>
    <?php
        session_start();
    ?>
    <form action="./inc/login.php" method="POST">
        <label for="login">Логин:</label>
        <input type="text" name="login" id="login" required><br><br>

        <label for="password">Пароль:</label>
        <input type="text" name="password" id="password" required><br><br>

        <input type="submit" value="Ввести"><br><br>
    </form>
    <a href="./views//register.php">Нету логина?</a><br><br><br>
    <?php
    if(isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>
</body>
</html>