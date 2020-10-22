<?php
session_start();
require_once '../vendor/connect.php';
$dev_id = $_POST['dev_id'];
$status = $_POST['status'];
$distr_id = $_SESSION['user']['distr_id'];




$ext = pathinfo($_FILES['akt']['name'], PATHINFO_EXTENSION);

if ($_FILES['akt']) {

    if ($ext === "pdf" || $ext === "jpg" || $ext === "png") {
        $path = 'uploads/akt/' . time() . $_FILES['akt']['name'];
        if (!move_uploaded_file($_FILES['akt']['tmp_name'], '../' . $path)) {
            $response = [
                "status" => false,
                "type" => 2,
                "message" => "Ошибка при загрузке файла",
            ];
            echo json_encode($response);
        }

        if (mysqli_query($connect, "UPDATE `device` SET  `status`='1', `dev_akt_img`='$path' WHERE `id`=$dev_id")) {




            $response = [
                "status" => true,
                "message" => "Отправлено на подтверждение!",
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
        $error_fields[] = 'akt';
        $response = [
            "status" => false,
            "type" => 1,
            "message" => "Неверный формат(jpg,png,pdf)",
            "fields" => $error_fields,

        ];
        echo json_encode($response);
    }
} else {

    $error_fields[] = 'akt';
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Загрузите документ!",
        "fields" => $error_fields,

    ];
    echo json_encode($response);
}
