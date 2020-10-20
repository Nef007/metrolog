<?php

require_once '../vendor/connect.php';

$dev_id = $_POST['dev_id'];
$href = $_POST['href'];

if (
    mysqli_query($connect, "UPDATE `device` SET  `dev_img`=null WHERE `id`=$dev_id") &&
    unlink("../$href")
) {

    $response = [
        "status" => true,
        "message" => "Файл удален!",
    ];
    echo json_encode($response);
} else {
    $response = [
        "status" => false,
        "message" => "Файл не удален!",
    ];
}
