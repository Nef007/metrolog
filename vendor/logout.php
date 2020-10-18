<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['sql']);
header('Location: ../index.php');
