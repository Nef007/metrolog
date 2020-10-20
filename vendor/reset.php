<?php
session_start();
unset($_SESSION['form_select']);
unset($_SESSION['sql']);

$response = [

    "status" => true,
    "message" => "Чисто!",
];
echo json_encode($response);
