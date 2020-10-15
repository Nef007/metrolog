<?php

$connect = mysqli_connect('localhost', 'root', 'root', 'metr31');

if (!$connect) {
    die('Error connect to DataBase');
}
