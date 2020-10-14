<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Метрология</title>
</head>
<body>
    <div id="maket">
        <div class="main-loader">
            <div class="loader-img"></div>
        </div>
        <div id="header-1">
            <div class="container">
                <div class="header-gerb">
                    <div class="header-gerb__inner"></div>
                </div>
                <a class="header-logo" href="/"><div class="header-logo__icon">
                    <div class="icon logo"></div>
                </div>
                <div class="header-logo__info">
                    <div class="header-logo__info-title">УМВД России Белгородской области</div>
                    <div class="header-logo__info-text">Метрология</div>
                </div>

            </a><div class="header-buttons">
                <?php
              session_start();
              if($_SESSION['id'] === 1 ){
               echo  '<div id="welcome">
               <p style= margin:0; padding:0; >Добро пожаловать!</p>';
               echo  $_SESSION['fio'];
               echo '</div>';
           }?>

       </div>
   </div>
</div>

<div id="rasporka0"></div>
<div class="container">
    <div id="menu">
        <a href="index.php">Добавить запись</a>
        <a href="find.php">Список </a>
        <a href="logout.php">Выход </a>
    </div>