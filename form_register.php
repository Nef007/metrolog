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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      "use strict";

                //================ Проверка длины пароля ==================
                var password = $('input[name=password]');

                password.blur(function(){
                  if(password.val() != ''){

                        //Если длина введенного пароля меньше шести символов, то выводим сообщение об ошибке
                        if(password.val().length < 6){
                            //Выводим сообщение об ошибке
                            $('#valid_password_message').text('Минимальная длина пароля 6 символов');

                            // Дезактивируем кнопку отправки
                            $('input[type=submit]').attr('disabled', true);

                          }else{
                            // Убираем сообщение об ошибке
                            $('#valid_password_message').text('');

                            //Активируем кнопку отправки
                            $('input[type=submit]').attr('disabled', false);
                          }
                        }else{
                          $('#valid_password_message').text('Введите пароль');
                        }
                      });
              });
            </script>

            <div id="rasporka0"></div>
            <div class="container">

              <div id="content_auth" >


                <!-- Блок для вывода сообщений -->
                <div class="block_for_messages">
                  <?php
        //Если в сессии существуют сообщения об ошибках, то выводим их
                  if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
                    echo $_SESSION["error_messages"];

            //Уничтожаем чтобы не выводились заново при обновлении страницы
                    unset($_SESSION["error_messages"]);
                  }

        //Если в сессии существуют радостные сообщения, то выводим их
                  if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
                    echo $_SESSION["success_messages"];

            //Уничтожаем чтобы не выводились заново при обновлении страницы
                    unset($_SESSION["success_messages"]);
                  }
                  ?>
                </div>

                <?php
    //Проверяем, если пользователь не авторизован, то выводим форму регистрации,
    //иначе выводим сообщение о том, что он уже зарегистрирован
                if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])){
                  ?>
                  <div id="auth" >

                    <form   action="register.php" method="post" name="form_register">
                      <table>
                        <tr >
                          <td align="left">
                           <p>Логин: </p></td><td> <p>  <input type="text" name="login" required="required" /></p>
                           </td>

                         </tr>
                         <tr>
                          <td>
                            <br />
                          </td>
                        </tr>
                        <tr >
                          <td >
                           <p>Фамилия: </p></td><td> <p>  <input type="text" name="first_name"  required="required"/></p>
                           </td>

                         </tr>
                         <tr >
                          <td >
                           <p>Имя: </p></td><td> <p>  <input type="text" name="last_name" required="required" /></p>
                           </td>

                         </tr>
                         <tr >
                          <td align="left">
                           <p>Отчество: </p></td><td> <p>  <input type="text" name="patronymic" required="required"/></p>
                           </td>

                         </tr>
                         <tr>
                          <td>
                            <br />
                          </td>
                        </tr>
                        <tr>
                          <td align="left">
                            <p>Пароль:</p></td><td> <p><input type="password" name="password" required="required"  placeholder="минимум 6 символов"/></p>

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
                            <input type="submit" value="Зарегистрироваться" name="btn_submit_register" />
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
                  <h2>Вы уже зарегистрированы</h2>
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

