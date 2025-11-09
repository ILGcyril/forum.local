<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <!-- login / password1 / password2 / checkbox-->

    <?php
        session_start();
    ?>
    <form action="/../inc/register.php" method="POST">
        <label for="login">Логин:</label>
        <input type="text" name="login" id="login" required><br><br>

        <label for="password1">Пароль:</label>
        <input type="text" name="password1" id="password1" required><br><br>

        <label for="password2">Подтвердите пароль:</label>
        <input type="text" name="password2" id="password2" required><br><br>

        <label for="cb">Согласие на обработку персональных данных:</label>
        <input type="checkbox" name="cb" id="cb" required><br><br>

        <input type="submit" value="Ввести"><br><br>
    </form>
    <a href="../../index.php">Логин</a><br><br><br>
    <?php
    if(isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>
</body>
</html>