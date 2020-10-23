<?php
session_start();
require_once '../vendor/connect.php';

//$dist_id_admin = $_POST['dist_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$patronymic = $_POST['patronymic'];
$distr = $_POST['distr'];
$login = $_POST['login'];
$password = $_POST['password'];
$access = $_POST['access'];
$distr_id = $_POST['distr_id'];



// $check_login = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
// if (mysqli_num_rows($check_login) > 0) {
//     $response = [
//         "status" => false,
//         "type" => 1,
//         "message" => "Такой логин уже существует",
//         "fields" => ['login']
//     ];

//     echo json_encode($response);
//     die();
// }



$error_fields = [];



if ($first_name === '') {
    $error_fields[] = 'first_name2';
}

if ($last_name === '') {
    $error_fields[] = 'last_name2';
}

if ($patronymic === '') {
    $error_fields[] = 'patronymic2';
}

if ($distr === '') {
    $error_fields[] = 'distr2';
}

if ($login === '') {
    $error_fields[] = 'login2';
}
if ($password === '') {
    $error_fields[] = 'password2';
}
if ($access === '') {
    $error_fields[] = 'access2';
}



if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Проверьте правильность полей",
        "fields" => $error_fields
    ];

    echo json_encode($response);

    die();
}








if (mysqli_query($connect, "UPDATE `users` SET  `first_name`='$first_name', `last_name`='$last_name', `patronymic`='$patronymic', `distr`='$distr', `password`='$password', `login`='$login', `access`='$access' WHERE `distr_id`='$distr_id' ")) {



    $response = [
        "status" => true,
        "message" => "Сохранение успешно!",
    ];
    echo json_encode($response);

    die();
} else {
    $response = [
        "status" => false,
        "type" => 2,
        "message" => "Данные некорректны",
    ];
    echo json_encode($response);
}
