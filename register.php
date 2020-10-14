<?php
    //Запускаем сессию
session_start();

    //Добавляем файл подключения к БД
require_once("dbconnect.php");

    //Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
$_SESSION["error_messages"] = '';

    //Объявляем ячейку для добавления успешных сообщений
$_SESSION["success_messages"] = '';

    /*
        Проверяем была ли отправлена форма, то есть была ли нажата кнопка зарегистрироваться. Если да, то идём дальше, если нет, то выведем пользователю сообщение об ошибке, о том что он зашёл на эту страницу напрямую.
    */
        if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){

        // (1) Место для следующего куска кода
            if(isset($_POST["first_name"])){

    //Обрезаем пробелы с начала и с конца строки
                $first_name = trim($_POST["first_name"]);

    //Проверяем переменную на пустоту
                if(!empty($first_name)){
        // Для безопасности, преобразуем специальные символы в HTML-сущности
                    $first_name = htmlspecialchars($first_name, ENT_QUOTES);
                }else{
        // Сохраняем в сессию сообщение об ошибке.
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваше имя</p>";

        //Возвращаем пользователя на страницу регистрации
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: /form_register.php");

        //Останавливаем скрипт
                    exit();
                }

            }else{
    // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с именем</p>";

    //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: form_register.php");

    //Останавливаем скрипт
                exit();
            }


            if(isset($_POST["last_name"])){

    //Обрезаем пробелы с начала и с конца строки
                $last_name = trim($_POST["last_name"]);

                if(!empty($last_name)){
        // Для безопасности, преобразуем специальные символы в HTML-сущности
                    $last_name = htmlspecialchars($last_name, ENT_QUOTES);
                }else{

        // Сохраняем в сессию сообщение об ошибке.
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Вашу фамилию</p>";

        //Возвращаем пользователя на страницу регистрации
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: form_register.php");

        //Останавливаем  скрипт
                    exit();
                }


            }else{

    // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с фамилией</p>";

    //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: form_register.php");

    //Останавливаем  скрипт
                exit();
            }

            if(isset($_POST["patronymic"])){

    //Обрезаем пробелы с начала и с конца строки
                $patronymic = trim($_POST["patronymic"]);

                if(!empty($patronymic)){
        // Для безопасности, преобразуем специальные символы в HTML-сущности
                    $patronymic = htmlspecialchars($patronymic, ENT_QUOTES);
                }else{

        // Сохраняем в сессию сообщение об ошибке.
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваше Отчество</p>";

        //Возвращаем пользователя на страницу регистрации
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: form_register.php");

        //Останавливаем  скрипт
                    exit();
                }


            }else{

    // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с Отчеством</p>";

    //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: form_register.php");

    //Останавливаем  скрипт
                exit();

            }



            if(isset($_POST["login"])){

    //Обрезаем пробелы с начала и с конца строки
                $login = trim($_POST["login"]);

                if(!empty($login)){
        // Для безопасности, преобразуем специальные символы в HTML-сущности
                    $login = htmlspecialchars($login, ENT_QUOTES);
                }else{

        // Сохраняем в сессию сообщение об ошибке.
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваш Логин</p>";

        //Возвращаем пользователя на страницу регистрации
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: form_register.php");

        //Останавливаем  скрипт
                    exit();
                }


            }else{

    // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с Логином</p>";

    //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /form_register.php");

    //Останавливаем  скрипт
                exit();

            }

            if(isset($_POST["password"])){

    //Обрезаем пробелы с начала и с конца строки
                $password = trim($_POST["password"]);

                if(!empty($password)){
                    $password = htmlspecialchars($password, ENT_QUOTES);

        //Шифруем папроль
                    $password = md5($password."top_secret");
                }else{
        // Сохраняем в сессию сообщение об ошибке.
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваш пароль</p>";

        //Возвращаем пользователя на страницу регистрации
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: /form_register.php");

        //Останавливаем  скрипт
                    exit();
                }

            }else{
    // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода пароля</p>";

    //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /form_register.php");

    //Останавливаем  скрипт
                exit();
            }
        //Запрос на добавления пользователя в БД
            $result_query_insert = $mysqli->query("INSERT INTO `ul31_users` ( `first_name`, `last_name`, `patronymic`, `password`, `login`) VALUES ('$first_name', '$last_name', '$patronymic', '$password', '$login')");

            if(!$result_query_insert){
    // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на добавления пользователя в БД</p>";

    //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /form_register.php");

    //Останавливаем  скрипт
                exit();
            }else{

                $_SESSION["success_messages"] = "<p class='success_message'>Регистрация прошла успешно!!! <br />Теперь Вы можете авторизоваться используя Ваш логин и пароль.</p>";

    //Отправляем пользователя на страницу авторизации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /form_auth.php");
            }

            /* Завершение запроса */
            $result_query_insert->close();

//Закрываем подключение к БД
            $mysqli->close();

        // ----------------------------------

        }else{

            exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href='form_auth.php'> главную страницу </a>.</p>");
        }
        ?>

