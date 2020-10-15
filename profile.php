<?php
session_start();
require_once 'vendor/connect.php';
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
                    <h1>Приборы <?php echo $_SESSION['user']['distr']; ?> </h1>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-1 ">
                    <button class="button popup-btn">
                        Добавить СИ
                    </button>
                </div>
                <div class="col-lg-1 offset-lg-0 ">
                    <button class="button">
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
                    <table>
                        <tr>
                            <th>Наименование</th>
                            <th>Тип,марка</th>
                            <th>Заводской номер</th>
                            <th>Паспорт</th>
                            <th>год выпуска</th>
                            <th>Дата поверки</th>
                            <th>Дата следующей поверки</th>
                        </tr>

                        <?php
                        $devices = mysqli_query($connect, "SELECT DISTINCT `id`,`dev_name`,`dev_marka`,`dev_zav_number`, `dev_data_pred_poverki`, `dev_data_release`,`dev_data_poverki` FROM `device`, `users` WHERE users.distr_id={$_SESSION['user']['distr_id']} and users.distr_id=device.dist_id");
                        $devices = mysqli_fetch_all($devices);
                        foreach ($devices as $device) {
                            // Обработать картинку!!!!!!!!!!!!!!!!!!!
                            echo '
                         
                    <tr>
                
                        <td>' . $device[1] . '</td>
                        <td>' . $device[2] . '</td>
                        <td>' . $device[3] . '</td>
                        <td>' . $device[3] . '</td>
                        <td>' . $device[4] . '</td>
                        <td>' . $device[5] . '</td>
                        <td>' . $device[6] . '</td>
                        
                  
                </tr>
                    ';
                        }
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </section>





    <!-- Модальное окно получить консультацию -->
    <div class="popup">
        <!-- Само белое модальное окно -->
        <div class="popup-dialog">
            <!-- содержмое модального окна -->
            <div class="popup-content">
                <button class="popup-close">&times;</button>
                <h4 class="popup-header">
                    <?php if (isset($request["func"]) && $request["func"] == "edit") { ?>Редактировать<?php } else { ?>Добавить<?php } ?> прибор
                </h4>
                <div id="form_order">

                    <h1></h1>
                    <form class="addform" name="form_order" action="index.php<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>?func=edit&amp;id=<?= $fd["id"] ?><?php } ?>" method="post" enctype="multipart/form-data">

                        <div>
                            <label>Наименование:</label> <input type="text" name="name" value="<?php if (isset($fd["dev_name"]) && $fd["dev_name"]) { ?><?= $fd["dev_name"] ?><?php } ?>" />
                        </div>
                        <div>
                            <label>Тип,марка:</label> <input type="text" name="marka" value="<?php if (isset($fd["dev_marka"]) && $fd["dev_marka"]) { ?><?= $fd["dev_marka"] ?><?php } ?>" />
                        </div>
                        <div>
                            <label>Заводской №:</label> <input type="text" name="zav_number" value="<?php if (isset($fd["dev_zav_number"]) && $fd["dev_zav_number"]) { ?><?= $fd["dev_zav_number"] ?><?php } ?>" />
                        </div>
                        <div>
                            <label>Паспорт:</label> <input type="file" name="pasport" value="<?php if (isset($fd["pasport"]) && $fd["pasport"]) { ?><?= $fd["pasport"] ?><?php } ?>" />
                        </div>
                        <div>
                            <label>Год выпуска:</label> <input type="date" name="dev_data_release" value="<?php if (isset($fd["dev_data_release"]) && $fd["dev_data_release"]) { ?><?= $fd["dev_data_release"] ?><?php } ?>" />
                        </div>
                        <div>
                            <label>Дата поверки:</label> <input type="date" name="dev_data_pred_poverki" value="<?php if (isset($fd["dev_data_pred_poverki"]) && $fd["dev_data_pred_poverki"]) { ?><?= $fd["dev_data_pred_poverki"] ?><?php } ?>" />
                        </div>
                        <div>
                            <label>Дата следующей поверки:</label> <input type="date" name="dev_data_poverki" value="<?php if (isset($fd["dev_data_poverki"]) && $fd["dev_data_poverki"]) { ?><?= $fd["dev_data_poverki"] ?><?php } ?>" />
                        </div>
                        <div>
                            <input type="hidden" name="id" value="<?php if (isset($fd["id"])) { ?><?= $fd["id"] ?><?php } ?>" />
                            <input type="submit" name="<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>edit<?php } else { ?>add<?php } ?>" value="<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>Редактировать<?php } else { ?>Добавить<?php } ?>" />
                        </div>
                    </form>
                </div>

                </form>
            </div>
        </div>
    </div>
    <!-- подключение jqweri -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".popup-btn").on("click", function(event) {
                event.preventDefault();
                $(".popup").fadeIn();
            });
            $(".popup-close").on("click", function() {
                event.preventDefault();
                $(".popup").fadeOut();
            });

        });
    </script>





</body>




</html>