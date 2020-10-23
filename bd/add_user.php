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



// $check_zav_number = mysqli_query($connect, "SELECT * FROM `device` WHERE `dev_zav_number` = '$zav_number'");
// if (mysqli_num_rows($check_zav_number) > 0) {
//     $response = [
//         "status" => false,
//         "type" => 1,
//         "message" => "Такой заводской номер уже существует",
//         "fields" => ['zav_number']
//     ];

//     echo json_encode($response);
//     die();
// }



$error_fields = [];


if ($first_name === '') {
    $error_fields[] = 'first_name';
}

if ($last_name === '') {
    $error_fields[] = 'last_name';
}

if ($patronymic === '') {
    $error_fields[] = 'patronymic';
}

if ($distr === '') {
    $error_fields[] = 'distr';
}

if ($login === '') {
    $error_fields[] = 'login';
}
if ($password === '') {
    $error_fields[] = 'password';
}
if ($access === '') {
    $error_fields[] = 'access';
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






  

        if (mysqli_query($connect, "INSERT INTO `device` (`id`, `dist_id`, `fif`, `dev_name`, `dev_marka`, `dev_zav_number`, `tex_o`, `prikaz`, `dev_data_release`, `dev_data_pred_poverki`,  `dev_data_poverki`, `dev_img`) 
VALUES (NULL, '$distr_id', NULL, '$name', '$marka', '$zav_number', NULL, NULL, '$dev_data_release', '$dev_data_pred_poverki', '$dev_data_poverki', '$path')")) {



            $response = [
                "status" => true,
                "message" => "Добавлеение успешно!",
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
   
