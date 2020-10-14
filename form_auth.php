<?php
    //Запускаем сессию
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
      </a>
    </div>
  </div>

  <div id="rasporka0"></div>
  <div class="container">

    <div id="content_auth" >
      <!-- Блок для вывода сообщений -->
      <div class="block_for_messages">
        <?php

        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
          echo $_SESSION["error_messages"];

            //Уничтожаем чтобы не появилось заново при обновлении страницы
          unset($_SESSION["error_messages"]);
        }

        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
          echo $_SESSION["success_messages"];

            //Уничтожаем чтобы не появилось заново при обновлении страницы
          unset($_SESSION["success_messages"]);
        }
        ?>
      </div>

      <?php
    //Проверяем, если пользователь не авторизован, то выводим форму авторизации,
    //иначе выводим сообщение о том, что он уже авторизован
      if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])){
        ?>

        <div id="auth" >

          <form action="auth.php" method="post" name="form_auth">
            <table >
              <tr>
                <td align="left">
                 <p>Логин: </p></td><td> <p> <input type="text" name="login" /></p>
                 </td>

               </tr>
               <tr>
                <td>
                  <br />
                </td>
              </tr>
              <tr>
                <td align="left">
                 <p>Пароль:</p></td><td> <p><input type="password" name="password" /></p>

                 </td>

               </tr>
               <tr>
                <td>
                  <br />
                </td>
                <td>
                  <span id="valid_password_message" class="mesage_error"></span>
                </td>
              </tr>
              <tr>
                <td align="left">
                 <input type="submit" value="Войти" name="btn_submit_auth" /></td>
                 <td>
                  <a href="/form_register.php">Регистрация</a>
                </td>
              </td>
            </tr>
          </table>
        </form>
      </div>
      <?php
    }else{
      ?>

      <div id="authorized">
        <h2>Вы уже авторизованы </h2>
      </div>

      <?php
    }
    ?>
  </div>
</div>

<?php
    //Подключение подвала
require_once("footer.php");
?>

