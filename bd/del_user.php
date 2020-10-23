<?php

require_once '../vendor/connect.php';

$distr_id = $_POST['distr_id'];


if (
    mysqli_query($connect, "DELETE FROM `users` WHERE `users`.`distr_id` = '$distr_id'")

) {

    $response = [
        "status" => true,
        "message" => "Пользователь удален!",
    ];
    echo json_encode($response);
} else {
    $response = [
        "status" => false,
        "message" => "Пользователь не удален!",
    ];
}
