<?php
$server = "localhost"; /* имя хоста (уточняется у провайдера), если работаем на локальном сервере, то указываем localhost */
$username = "root"; /* Имя пользователя БД */
$password = "root"; /* Пароль пользователя, если у пользователя нет пароля то, оставляем пустым */
$database = "metr31"; /* Имя базы данных, которую создали */

    // Подключение к базе данный через MySQLi
$mysqli = new mysqli($server, $username, $password, $database);

    // Проверяем, успешность соединения.
if (mysqli_connect_errno()) {
    echo "<p><strong>Ошибка подключения к БД</strong>. Описание ошибки: ".mysqli_connect_error()."</p>";
    exit();
}

    // Устанавливаем кодировку подключения
$mysqli->set_charset('utf8');

    //Для удобства, добавим здесь переменную, которая будет содержать название нашего сайта
$address_site = "http://metr31/form_auth.php";

function redirect($link){
    header("location: $link");
    exit;
}
?>