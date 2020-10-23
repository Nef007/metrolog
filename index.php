<?php
session_start();
if ($_SESSION['user'] && $_SESSION['user']['access'] == "0") {
    header('Location: profile.php');
}
if ($_SESSION['user'] && $_SESSION['user']['access'] == "1") {
    header('Location: admin.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="assets/css/main_aut.css">
</head>

<body>

    <!-- Форма авторизации -->

    <form>

        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Пароль</label>


        <input type="password" name="password" placeholder="Введите пароль">
        <button type="submit" class="login-btn">Войти</button>

        <p class="msg none">Lorem ipsum dolor sit amet.</p>
    </form>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>