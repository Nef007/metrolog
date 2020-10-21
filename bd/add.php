<?php
session_start();
require_once '../vendor/connect.php';

$name = $_POST['name'];
$marka = $_POST['marka'];
$zav_number = $_POST['zav_number'];
$dev_data_release = $_POST['dev_data_release'];
$dev_data_pred_poverki = $_POST['dev_data_pred_poverki'];
$dev_data_poverki = $_POST['dev_data_poverki'];
$distr_id = $_SESSION['user']['distr_id'];
$pasport = $_FILES['pasport']['name'];


// $_SESSION['form_select'] = [
//     "name_s" => $name,
// ];




$check_zav_number = mysqli_query($connect, "SELECT * FROM `device` WHERE `dev_zav_number` = '$zav_number'");
if (mysqli_num_rows($check_zav_number) > 0) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Такой заводской номер уже существует",
        "fields" => ['zav_number']
    ];

    echo json_encode($response);
    die();
}



$error_fields = [];


if ($name === '') {
    $error_fields[] = 'name';
}

if ($marka === '') {
    $error_fields[] = 'marka';
}

if ($zav_number === '') {
    $error_fields[] = 'zav_number';
}

if ($dev_data_release === '') {
    $error_fields[] = 'dev_data_release';
}

if ($dev_data_pred_poverki === '') {
    $error_fields[] = 'dev_data_pred_poverki';
}
if ($dev_data_poverki === '') {
    $error_fields[] = 'dev_data_poverki';
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

$ext = pathinfo($_FILES['pasport']['name'], PATHINFO_EXTENSION);

if ($_FILES['pasport']) {

    if ($ext === "pdf" || $ext === "jpg" || $ext === "png") {
        $path = 'uploads/' . time() . $_FILES['pasport']['name'];
        if (!move_uploaded_file($_FILES['pasport']['tmp_name'], '../' . $path)) {
            $response = [
                "status" => false,
                "type" => 2,
                "message" => "Ошибка при загрузке файла",
            ];
            echo json_encode($response);
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
    } else {
        $error_fields[] = 'pasport';
        $response = [
            "status" => false,
            "type" => 1,
            "message" => "Неверный формат(jpg,png,pdf)",
            "fields" => $error_fields,

        ];
        echo json_encode($response);
    }
} else {

    if (mysqli_query($connect, "INSERT INTO `device` (`id`, `dist_id`, `fif`, `dev_name`, `dev_marka`, `dev_zav_number`, `tex_o`, `prikaz`, `dev_data_release`, `dev_data_pred_poverki`,  `dev_data_poverki`, `dev_img`) 
VALUES (NULL, '$distr_id', NULL, '$name', '$marka', '$zav_number', NULL, NULL, '$dev_data_release', '$dev_data_pred_poverki', '$dev_data_poverki', NULL)")) {



        $response = [
            "status" => true,
            "message" => "Добавлеение успешно!",
        ];
        echo json_encode($response);
    } else {
        $response = [
            "status" => false,
            "type" => 2,
            "message" => "Данные некорректны",
        ];
        echo json_encode($response);
    }
}


