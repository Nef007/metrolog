<?php
session_start();
require_once 'vendor/connect.php';
require_once 'vendor/functions.php';

if (!$_SESSION['user']) {
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
                    <div class="logout">
                        <a href="vendor/logout.php">Выход</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 ">
                    <h1> <?php echo $_SESSION['user']['distr']; ?> </h1>
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
                    <button class="button popup-select-btn  <?php if ($_SESSION['sql']['btn'])
                                                                echo "select-color";
                                                            ?>">
                        Фильтр
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
                                <th>Наименование</th>
                                <th>Тип,марка</th>
                                <th>Заводской номер</th>
                                <th class="noExl">Паспорт</th>
                                <th>год выпуска</th>
                                <th>Дата поверки</th>
                                <th>Дата следующей поверки</th>
                               

                            </tr>
                        </thead>

                        <?php

                        if (empty($_SESSION['sql']['sql'])) {
                            $sql = "SELECT DISTINCT `id`,`dev_name`,`dev_marka`,`dev_zav_number`, `dev_data_release`, `dev_data_pred_poverki`, `dev_data_poverki`, `dev_img` FROM `device`, `users` WHERE users.distr_id={$_SESSION['user']['distr_id']} and users.distr_id=device.dist_id";
                        } else {
                            $sql = $_SESSION['sql']['sql'];
                        }
                        $devices = mysqli_query($connect,  $sql);
                        $devices = mysqli_fetch_all($devices);
                        foreach ($devices as $device) {

                            if (!empty($device[7]) && getExtension($device[7]) === "pdf") {
                                $img = $device[7];
                                $device[7] = '<a href="' . $img  . '" target="_blank"> <img src="assets\img\pdf.png" width="50" alt=""></a>';
                            } elseif (!empty($device[7]) && (getExtension($device[7]) === "jpg" || getExtension($device[7]) === "png")) {
                                $img = $device[7];
                                $device[7] = '<a href="' . $device[7] . '" target="_blank"> <img src="assets\img\jpg.png" width="50" alt=""></a>';
                            } else $img = "1";

                            echo '

                                 <tr> 

                                    
                                    <td>' . $device[1] . '</td>
                                    <td>' . $device[2] . '</td>
                                    <td>' . $device[3] . '</td>
                                    <td class="noExl"> ' . $device[7] . '</td>
                                    <td>' . $device[4] . '</td>
                                    <td>' . $device[5] . '</td>
                                    <td>' . $device[6] . '</td>
                                    <td class="col_id noExl">' . $device[0] . '</td>
                                    <td class="col_id noExl">' . $img . '</td>


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
                            <label>Наименование:</label> <input type="text" name="name" />
                        </div>
                        <div>
                            <label>Тип,марка:</label> <input type="text" name="marka" />
                        </div>
                        <div>
                            <label>Заводской №:</label> <input type="text" name="zav_number" />
                        </div>
                        <div>
                            <label>Паспорт:</label> <input type="file" name="pasport" />
                        </div>
                        <div>
                            <label>Год выпуска:</label> <input type="date" name="dev_data_release" />
                        </div>
                        <div>
                            <label>Дата поверки:</label> <input type="date" name="dev_data_pred_poverki" />
                        </div>
                        <div>
                            <label>Дата след. поверки:</label> <input type="date" name="dev_data_poverki" />
                        </div>
                        <div class="popup-add-subbtn">
                            <input type="submit" class="add-btn" value="Добавить" />
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
                            <input type="submit" class="select-btn" value="Выбрать" />
                        </div>
                        <div class="popup-select-subbtn">
                            <input type="submit" class="clean-btn" value="Сбросить" />
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
                    Изменить
                </h4>
                <div id="form_order">
                    <form class="addform">


                        <div>
                            <input type="hidden" name="dev_id" id="dev_id" />
                        </div>
                        <div>
                            <label>Наименование:</label> <input type="text" name="name3" id="name" />
                        </div>
                        <div>
                            <label>Тип,марка:</label> <input type="text" name="marka3" id="marka" />
                        </div>
                        <div>
                            <label>Заводской №:</label> <input type="text" name="zav_number3" id="zav_number" />
                        </div>
                        <div>
                            <label>Паспорт:</label>



                            <input class="vibor" type="file" name="pasport" />
                            <div class="per"> <a id="seatch_bt" href="" target="_blank">
                                    <img src="assets\img\file.png" width="50"></a>
                                <img class="del-btn" src="assets\img\del.png" width="50">

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
            </div>
        </div>
    </section>





    <!-- подключение jqweri -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.table2excel.js"></script>
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
            $("tr").on("dblclick", function() {
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
                $('#name').val(name);
                $('#marka').val(marka);
                $('#zav_number').val(zav_number);
                $('#pasport').val(pasport);
                $('#dev_data_release3').val(dev_data_release3);
                $('#dev_data_pred_poverki3').val(dev_data_pred_poverki3);
                $('#dev_data_poverki3').val(dev_data_poverki3);
                $('#dev_id').val(dev_id);

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