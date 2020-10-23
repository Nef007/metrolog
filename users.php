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


                        $sql = "SELECT `first_name`,`last_name`,`patronymic`,`distr`,`login`,`password`,`access` FROM `users` ";




                        $users = mysqli_query($connect,  $sql);
                        $users = mysqli_fetch_all($users);



                        foreach ($users as $user) {


                            echo '


                                 <tr  id="tbody"> 

                                    
                                 <td style="cursor: pointer;">  ' . $user[0] . '</td>
                                    <td>' . $user[1] . '</td>
                                    <td>' . $user[2] . '</td>
                                    <td> ' . $user[3] . '</td>
                                    <td>' . $user[4] . '</td>
                                    <td>' . $user[5] . '</td>
                                    <td>' . $user[6] . '</td>
                                   
                                    


                                   </tr>
                                ';
                        }



                        ?>



                    </table>
                </div>
            </div>
        </div>

    </section>



    <!-- Модальное окно ДОБАВИТЬ ПРИБОР -->
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


                        </div>
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
                            <label>Права:</label> <input type="text" name="access" />
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


    <!-- Модальное окно Выборка -->

    <section>
        <div class="popup-select">


            <div class="popup-content">
                <button class="popup-close">&times;</button>
                <h4 class="popup-header">
                    Фильтр
                </h4>
                <div id="form_order">
                    <form class="addform">

                        <div>
                            <label>Принадлежность:</label> <input type="text" name="distr_name" value="<?php if ($_SESSION['form_select']['distr_name']) { ?><?= $_SESSION['form_select']['distr_name'] ?><?php } ?>" />
                        </div>
                        <div>
                            <label>Наименование:</label> <input type="text" name="name2" value="<?php if ($_SESSION['form_select']['name']) { ?><?= $_SESSION['form_select']['name'] ?><?php } ?>" />
                        </div>
                        <div>
                            <label>Тип,марка:</label> <input type="text" name="marka2" value="<?php if ($_SESSION['form_select']['marka']) { ?><?= $_SESSION['form_select']['marka'] ?><?php } ?>" />
                        </div>
                        <div>
                            <label>Заводской №:</label> <input type="text" name="zav_number2" value="<?php if ($_SESSION['form_select']['zav_number']) { ?><?= $_SESSION['form_select']['zav_number'] ?><?php } ?>" />
                        </div>

                        <div>
                            <label>Год выпуска: </label>

                            c<input class="input-min" type="number" min="1900" max="2099" step="1" name="dev_data_release2_start" value="<?php if ($_SESSION['form_select']['dev_data_release_start']) { ?><?= $_SESSION['form_select']['dev_data_release_start'] ?><?php } ?>" />по
                            <input class="input-min" type="number" min="1900" max="2099" step="1" name="dev_data_release2_end" value="<?php if ($_SESSION['form_select']['dev_data_release_end']) { ?><?= $_SESSION['form_select']['dev_data_release_end'] ?><?php } ?>" />


                        </div>
                        <div>
                            <label>Дата поверки:</label> с<input class="input-min" type="date" name="dev_data_pred_poverki2_start" value="<?php if ($_SESSION['form_select']['dev_data_pred_poverki_start']) { ?><?= $_SESSION['form_select']['dev_data_pred_poverki_start'] ?><?php } ?>" />по
                            <input class="input-min" type="date" name="dev_data_pred_poverki2_end" value="<?php if ($_SESSION['form_select']['dev_data_pred_poverki_end']) { ?><?= $_SESSION['form_select']['dev_data_pred_poverki_end'] ?><?php } ?>" />
                        </div>
                        <div>
                            <label>Дата след. поверки:</label> с<input class="input-min" type="date" name="dev_data_poverki2_start" value="<?php if ($_SESSION['form_select']['dev_data_poverki_start']) { ?><?= $_SESSION['form_select']['dev_data_poverki_start'] ?><?php } ?>" />по
                            <input class="input-min" type="date" name="dev_data_poverki2_end" value="<?php if ($_SESSION['form_select']['dev_data_poverki_end']) { ?><?= $_SESSION['form_select']['dev_data_poverki_end'] ?><?php } ?>" />
                        </div>
                        <div class="popup-select-subbtn">
                            <input type="submit" class="select-btn-adm" value="Применить" />
                        </div>
                        <div class="popup-select-subbtn">
                            <input type="submit" class="clean-btn-adm" value="Сбросить" />
                        </div>
                        <div class="popup-select-msg">
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
                    Свойства
                </h4>

                <!-- Навигация вкладки -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#description">Изменение</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#characteristics">Списание</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="description">


                        <form class="addform">


                            <div>
                                <input type="hidden" name="dev_id" id="dev_id" />
                            </div>
                            <div>
                                <label>Наименование:</label> <input type="text" name="name3" id="name" disabled="" />
                            </div>
                            <div>
                                <label>Тип,марка:</label> <input type="text" name="marka3" id="marka" disabled="" />
                            </div>
                            <div>
                                <label>Заводской №:</label> <input type="text" name="zav_number3" id="zav_number" disabled="" />
                            </div>
                            <div>
                                <label>Паспорт:</label>



                                <input class="vibor" type="file" name="pasport" />
                                <div class="per"> <a id="seatch_bt" href="" target="_blank">
                                        <img src="assets\img\file.png" width="50"></a>
                                    <img class="del-btn" src="assets\img\del.png" width="20">

                                </div>




                            </div>
                            <div>
                                <label>Год выпуска:</label> <input type="date" name="dev_data_release3" id="dev_data_release3" />
                            </div>
                            <div>
                                <label>Дата поверки:</label> <input type="date" name="dev_data_pred_poverki3" id="dev_data_pred_poverki3" />
                            </div>
                            <div>
                                <label>Дата след. поверки:</label> <input type="date" name="dev_data_poverki3" id="dev_data_poverki3" />
                            </div>
                            <div class="popup-add-subbtn">
                                <input type="submit" class="change-btn" value="Сохранить" />
                            </div>
                            <div class="popup-add-msg">
                                <p class="gifload  none"></p>
                                <p class="msg  none">LOrem</p>
                            </div>
                        </form>

                    </div>
                    <div class="tab-pane fade" id="characteristics">
                        <form class="addform">

                            <label>АКТ списания:</label>
                            <input class="vibor1" type="file" name="akt" />
                            <div class="per1"> <a id="akt_bt" href="" target="_blank">
                                    <img src="assets\img\file.png" width="50"></a>
                                <img class="del-btn" src="assets\img\del.png" width="20">

                            </div>

                            <label>Статус:</label> <input type="text" name="status" id="status" disabled="" />

                            <div class="popup-spisat-subbtn">
                                <input type="submit" class="spisat-btn" value="Списать" />
                            </div>
                            <div class="popup-add-msg">
                                <p class="gifload  none"></p>
                                <p class="msg  none">LOrem</p>
                            </div>

                        </form>
                    </div>

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



            $(".popup-select-btn").on("click", function() {
                $(".popup-select").fadeIn();
                $(".msg").addClass("none");
                $(`input`).removeClass("error");

            });
            $("tr#tbody").on("dblclick", function() {
                $(".popup-change").fadeIn();
                $(".msg").addClass("none");
                $(`input`).removeClass("error");

                let name = $(this).children('td:first-child').text();
                let marka = $(this).children('td:nth-child(2)').text();
                let zav_number = $(this).children('td:nth-child(3)').text();

                let dev_data_release3 = $(this).children('td:nth-child(5)').text();
                let dev_data_pred_poverki3 = $(this).children('td:nth-child(6)').text();
                let dev_data_poverki3 = $(this).children('td:nth-child(7)').text();
                let dev_id = $(this).children('td:nth-child(8)').text();
                pasport = $(this).children('td:nth-child(9)').text();
                let status = $(this).children('td:nth-child(10)').text();
                let akt = $(this).children('td:nth-child(11)').text();
                $('#name').val(name);
                $('#marka').val(marka);
                $('#zav_number').val(zav_number);
                $('#pasport').val(pasport);
                $('#dev_data_release3').val(dev_data_release3);
                $('#dev_data_pred_poverki3').val(dev_data_pred_poverki3);
                $('#dev_data_poverki3').val(dev_data_poverki3);
                $('#dev_id').val(dev_id);
                $('#status').val(getstringstatus(status));


                function getstringstatus($num) {
                    if ($num === "") {
                        $status = "В работе"
                    }
                    if ($num === "1") {
                        $status = "На подтверждении"
                    }
                    if ($num === "3") {
                        $status = "Списан"
                    }
                    return $status;
                }
                // Обработка поля загрузки файла паспорта
                document.getElementById('seatch_bt').href = pasport;
                if (pasport === "1") {
                    $(".per").removeClass("del");
                    $(".vibor").removeClass("none");
                    $(".per").addClass("none");


                } else {
                    $(".vibor").addClass("none");
                    $(".per").removeClass("none");
                    $(".per").addClass("del");

                }
                // Обработка поля загрузки файла списания
                document.getElementById('akt_bt').href = akt;
                if (akt === "") {
                    $(".per1").removeClass("del");
                    $(".vibor1").removeClass("none");
                    $(".per1").addClass("none");


                } else {
                    $(".vibor1").addClass("none");
                    $(".per1").removeClass("none");
                    $(".per1").addClass("del");

                }



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