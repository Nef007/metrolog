<?php
session_start();
require_once 'vendor/connect.php';
require_once 'vendor/functions.php';

if (!$_SESSION['user'] || $_SESSION['user']['access'] == "0") {
    header('Location: /');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Метрология</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.css">


</head>

<body>

    <!-- Шапка -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <h1>Пользователи </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 offset-lg-9 ">
                    <div class="logout">
                        <a href="admin.php">Главная</a>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="logout">
                        <a href="users.php">Пользователи</a>
                    </div>
                </div>
                <div class="col-lg-1 ">
                    <div class="logout">
                        <a href="vendor/logout.php">Выход</a>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <button class="button popup-add-btn">
                        Добавить
                    </button>

                    <button class="button loadexel">
                        Выгрузить в Exel
                    </button>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">

                    <table id="tableexl">
                        <thead>
                            <tr>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Подразделение</th>

                                <th>Логин</th>
                                <th>Пароль</th>
                                <th>Права</th>



                            </tr>
                        </thead>


                        <?php


                        $sql = "SELECT `first_name`,`last_name`,`patronymic`,`distr`,`login`,`password`,`access`, `distr_id`  FROM `users` ";




                        $users = mysqli_query($connect,  $sql);
                        $users = mysqli_fetch_all($users);



                        foreach ($users as $user) {


                            echo '


                                 <tr  id="tbody"> 

                                    
                                 <td style="cursor: pointer;">' . $user[0] . '</td>
                                    <td>' . $user[1] . '</td>
                                    <td>' . $user[2] . '</td>
                                    <td>' . $user[3] . '</td>
                                    <td>' . $user[4] . '</td>
                                    <td>' . $user[5] . '</td>
                                    <td>' . $user[6] . '</td>
                                    <td class="col_id noExl">' . $user[7] . '</td>
                                    
                                   
                                    


                                   </tr>
                                ';
                        }



                        ?>



                    </table>
                </div>
            </div>
        </div>

    </section>



    <!-- Модальное окно ДОБАВИТЬ пользоватея -->
    <section>

        <div class="popup-add">

            <div class="popup-content">
                <button class="popup-close">&times;</button>
                <h4 class="popup-header">
                    Добавить
                </h4>
                <div id="form_order">
                    <form class="addform">

                        <div>
                            <label>Фамилия:</label> <input type="text" name="first_name" />
                        </div>
                        <div>
                            <label>Имя:</label> <input type="text" name="last_name" />
                        </div>
                        <div>
                            <label>Отчество:</label> <input type="text" name="patronymic" />
                        </div>
                        <div>
                            <label>Подразделение:</label> <input type="text" name="distr" />
                        </div>
                        <div>
                            <label>Логин:</label> <input type="text" name="login" />
                        </div>
                        <div>
                            <label>Пароль:</label> <input type="text" name="password" />
                        </div>
                        <div>
                            <label>Права:</label> <select name="access">

                                <option value="1">admin</option>
                                <option value="0">user</option>


                            </select>


                        </div>

                        <div class="popup-add-subbtn">
                            <input type="submit" class="add-btn-adm-user" value="Добавить" />
                        </div>
                        <div class="popup-add-msg">
                            <p class="gifload  none"></p>
                            <p class="msg  none">LOrem</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>




    <!-- Модальное окно Изменить -->

    <section>
        <div class="popup-change">


            <div class="popup-content">
                <button class="popup-close">&times;</button>
                <h4 class="popup-header">
                    Изменить
                </h4>
                <div id="form_order">
                    <form class="addform">


                        <img class="del-btn-user" src="assets\img\del.png" width="50">
                        <div>
                            <input type="hidden" name="distr_id" id="distr_id" />
                        </div>
                        <div>
                            <label>Фамилия:</label> <input type="text" name="first_name2" id="first_name" />
                        </div>
                        <div>
                            <label>Имя:</label> <input type="text" name="last_name2" id="last_name" />
                        </div>
                        <div>
                            <label>Отчество:</label> <input type="text" name="patronymic2" id="patronymic" />
                        </div>
                        <div>
                            <label>Подразделение:</label> <input type="text" name="distr2" id="distr" />
                        </div>
                        <div>
                            <label>Логин:</label> <input type="text" name="login2" id="login" />
                        </div>
                        <div>
                            <label>Пароль:</label> <input type="text" name="password2" id="password" />
                        </div>
                        <div>
                            <label>Права:</label> <select name="access2" id="access">

                                <option value="1">admin</option>
                                <option value="0">user</option>
                        </div>
                        <div class="popup-add-subbtn">
                            <input type="submit" class="change-btn-user" value="Сохранить" />
                        </div>
                        <div class="popup-add-msg">
                            <p class="gifload  none"></p>
                            <p class="msg  none">LOrem</p>
                        </div>
                    </form>

                </div>


            </div>




        </div>
    </section>





    <!-- подключение jqweri -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.table2excel.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

    <script>
        $(document).ready(function() {

            $(".popup-add-btn").on("click", function() {
                $(".popup-add").fadeIn();
                $(".msg").addClass("none");
                $(`input`).removeClass("error");

            });




            $("tr#tbody").on("dblclick", function() {
                $(".popup-change").fadeIn();
                $(".msg").addClass("none");
                $(`input`).removeClass("error");

                let first_name = $(this).children('td:first-child').text();
                let last_name = $(this).children('td:nth-child(2)').text();
                let patronymic = $(this).children('td:nth-child(3)').text();

                let distr = $(this).children('td:nth-child(4)').text();
                let login = $(this).children('td:nth-child(5)').text();
                let password = $(this).children('td:nth-child(6)').text();

                access = $(this).children('td:nth-child(7)').text();
                distr_id = $(this).children('td:nth-child(8)').text();

                $('#first_name').val(first_name);
                $('#last_name').val(last_name);
                $('#patronymic').val(patronymic);
                $('#distr').val(distr);
                $('#login').val(login);
                $('#password').val(password);
                $('#access').val(access);
                $('#distr_id').val(distr_id);


            });



            $(".popup-close").on("click", function() {
                $(".popup-add").fadeOut();
                $(".popup-select").fadeOut();
                $(".popup-change").fadeOut();
            });


            $('.loadexel').click(function() {
                $('#tableexl').table2excel({
                    exclude: ".noExl",
                    name: "SI",
                    filename: "Выгрузка_в_Exel.xls",
                    fileext: ".xls", //File extension type 
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true,


                });


            });
        });
    </script>
    <!-- Конец модального окна -->






</body>

</html>