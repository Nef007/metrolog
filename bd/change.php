<?php
session_start();
require_once '../vendor/connect.php';
$dev_id = $_POST['dev_id'];
$name = $_POST['name'];
$marka = $_POST['marka'];
$zav_number = $_POST['zav_number'];
$dev_data_release = $_POST['dev_data_release'];
$dev_data_pred_poverki = $_POST['dev_data_pred_poverki'];
$dev_data_poverki = $_POST['dev_data_poverki'];
$distr_id = $_SESSION['user']['distr_id'];





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






// $path = 'uploads/' . time() . $_FILES['pasport']['name'];
// if (!move_uploaded_file($_FILES['pasport']['tmp_name'], '../' . $path)) {
//     $response = [
//         "status" => false,
//         "type" => 2,
//         "message" => "Ошибка при загрузке аватарки",
//     ];
//     echo json_encode($response);
// }

// echo $_FILES['pasport'];


if ($_FILES['pasport']) {
    $path = 'uploads/' . time() . $_FILES['pasport']['name'];
    if (!move_uploaded_file($_FILES['pasport']['tmp_name'], '../' . $path)) {
        $response = [
            "status" => false,
            "type" => 2,
            "message" => "Ошибка при загрузке аватарки",
        ];
        echo json_encode($response);

        die();
    }


    mysqli_query($connect, "UPDATE `device` SET  `dev_name`='$name', `dev_marka`='$marka', `dev_zav_number`='$zav_number', `dev_data_release`='$dev_data_release', `dev_data_pred_poverki`='$dev_data_pred_poverki',  `dev_data_poverki`='$dev_data_poverki', `dev_img`='$path' WHERE `id`=$dev_id");
} else mysqli_query($connect, "UPDATE `device` SET  `dev_name`='$name', `dev_marka`='$marka', `dev_zav_number`='$zav_number', `dev_data_release`='$dev_data_release', `dev_data_pred_poverki`='$dev_data_pred_poverki',  `dev_data_poverki`='$dev_data_poverki' WHERE `id`=$dev_id");





$response = [
    "status" => true,
    "message" => "Сохранение успешно!",
];
echo json_encode($response);
