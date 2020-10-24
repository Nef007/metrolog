<?php
session_start();
require_once '../vendor/connect.php';
unset($_SESSION["sql"]["sql"]);
$name = $_POST['name'];
$marka = $_POST['marka'];
$zav_number = $_POST['zav_number'];
$dev_data_release_start = $_POST['dev_data_release_start'];
$dev_data_release_end = $_POST['dev_data_release_end'];
$dev_data_pred_poverki_start = $_POST['dev_data_pred_poverki_start'];
$dev_data_pred_poverki_end = $_POST['dev_data_pred_poverki_end'];
$dev_data_poverki_start = $_POST['dev_data_poverki_start'];
$dev_data_poverki_end = $_POST['dev_data_poverki_end'];
$fif = $_POST['fif'];
$prikaz = $_POST['prikaz'];
$to = $_POST['to'];

$distr_name = $_POST['distr_name'];


$_SESSION['form_select'] = [
    "distr_name" => $distr_name,
    "name" => $name,
    "fif" => $fif,
    "prikaz" => $prikaz,
    "to" => $to,
    "marka" => $marka,
    "zav_number" => $zav_number,
    "dev_data_release_start" => $dev_data_release_start,
    "dev_data_release_end" => $dev_data_release_end,
    "dev_data_pred_poverki_start" => $dev_data_pred_poverki_start,
    "dev_data_pred_poverki_end" => $dev_data_pred_poverki_end,
    "dev_data_poverki_start" => $dev_data_poverki_start,
    "dev_data_poverki_end" => $dev_data_poverki_end,

];








function addWhere($where, $add, $and = true, $ferst = false)
{
    if ($where && $ferst) {
        $where = $add;
    } elseif ($where) {
        if ($and) $where .= " AND $add";
        else $where .= " OR $add";
    } else $where = $add;
    return $where;
}
// Принимаем принадлежность
$search = explode(' ', $_POST['distr_name']);


//если оно есть
if (!empty($_POST['distr_name'])) {
    $where = " users.distr_id=device.dist_id AND (";
    if (count($search) === 1) {
        //  если оно одно 
        $where .= addWhere($where, " users.distr LIKE '%" . htmlspecialchars($search[0]), false, true) . "%'";
        $where .= ")";
    } else {
        // если их несколько
        $where .= addWhere($where, " users.distr LIKE '%" . htmlspecialchars($search[0]), false, true) . "%'";
        unset($search[0]);
        foreach ($search as $name) {

            $where = addWhere($where, " users.distr LIKE '%" . htmlspecialchars($name), false) . "%'";
        }

        $where .= ")";
    }
}



// Принимаем ИМЯ
$search = explode(' ', $_POST['name']);


//если оно есть
if (!empty($_POST['name'])) {
    if ($where) {
        $where .= "AND (";
    } else $where = "(";

    if (count($search) === 1) {
        //  если оно одно 
        $where .= addWhere($where, "`dev_name` LIKE '%" . htmlspecialchars($search[0]), false, true) . "%'";
        $where .= ")";
    } else {
        // если их несколько
        $where .= addWhere($where, "`dev_name` LIKE '%" . htmlspecialchars($search[0]), false, true) . "%'";
        unset($search[0]);
        foreach ($search as $name) {

            $where = addWhere($where, "`dev_name` LIKE '%" . htmlspecialchars($name), false) . "%'";
        }

        $where .= ")";
    }
}

// Принимаем марку


$search = explode(' ', $_POST['marka']);


//если оно есть
if (!empty($_POST['marka'])) {
    // и если имя есть
    if ($where) {
        $where .= "AND (";
    } else $where = "(";

    if (count($search) === 1) {
        //  если оно одно 
        $where .= addWhere($where, "`dev_marka` LIKE '%" . htmlspecialchars($search[0]), false, true) . "%'";
        $where .= ")";
    } else {
        // если их несколько
        $where .= addWhere($where, "`dev_marka` LIKE '%" . htmlspecialchars($search[0]), false, true) . "%'";
        unset($search[0]);
        foreach ($search as $name) {

            $where = addWhere($where, "`dev_marka` LIKE '%" . htmlspecialchars($name), false) . "%'";
        }

        $where .= ")";
    }
}

// Принимаем заводской номер
if (!empty($_POST['zav_number'])) {

    if ($where) {
        $where .= "AND (";
    } else $where = "(";

    $where .= addWhere($where, "`dev_zav_number` LIKE '%" . htmlspecialchars($zav_number), false, true) . "%'";

    $where .= ")";
}

// принимаем год выпуска

if ($dev_data_release_start && $dev_data_release_end) {

    if ($where) {
        $where .= "AND (";
    } else $where = "(";

    $where .= addWhere($where, "YEAR(dev_data_release) BETWEEN " . htmlspecialchars($dev_data_release_start) . " AND " . htmlspecialchars($dev_data_release_end), false, true) . "";

    $where .= ")";
} else {

    if ($dev_data_release_start) {

        if ($where) {
            $where .= "AND (";
        } else $where = "(";

        $where .= addWhere($where, "YEAR(dev_data_release) >= " . htmlspecialchars($dev_data_release_start), false, true) . "";

        $where .= ")";
    }

    if ($dev_data_release_end) {

        if ($where) {
            $where .= "AND (";
        } else $where = "(";

        $where .= addWhere($where, "YEAR(dev_data_release) <= " . htmlspecialchars($dev_data_release_end), false, true) . "";

        $where .= ")";
    }
}

// принимаем дату поверки

if ($dev_data_pred_poverki_start && $dev_data_pred_poverki_end) {

    if ($where) {
        $where .= "AND (";
    } else $where = "(";

    $where .= addWhere($where, "dev_data_pred_poverki  BETWEEN '" . htmlspecialchars($dev_data_pred_poverki_start) . "' AND '" . htmlspecialchars($dev_data_pred_poverki_end), false, true) . "'";

    $where .= ")";
} else {

    if ($dev_data_pred_poverki_start) {

        if ($where) {
            $where .= "AND (";
        } else $where = "(";

        $where .= addWhere($where, "dev_data_pred_poverki>= '" . htmlspecialchars($dev_data_pred_poverki_start), false, true) . "'";

        $where .= ")";
    }

    if ($dev_data_pred_poverki_end) {

        if ($where) {
            $where .= "AND (";
        } else $where = "(";

        $where .= addWhere($where, "dev_data_pred_poverki <= '" . htmlspecialchars($dev_data_pred_poverki_end), false, true) . "'";

        $where .= ")";
    }
}

// принимаем дату следующей  поверки

if ($dev_data_poverki_start && $dev_data_poverki_end) {

    if ($where) {
        $where .= "AND (";
    } else $where = "(";

    $where .= addWhere($where, "dev_data_poverki  BETWEEN '" . htmlspecialchars($dev_data_poverki_start) . "' AND '" . htmlspecialchars($dev_data_poverki_end), false, true) . "'";

    $where .= ")";
} else {

    if ($dev_data_poverki_start) {

        if ($where) {
            $where .= "AND (";
        } else $where = "(";

        $where .= addWhere($where, "dev_data_poverki >= '" . htmlspecialchars($dev_data_poverki_start), false, true) . "'";

        $where .= ")";
    }

    if ($dev_data_poverki_end) {

        if ($where) {
            $where .= "AND (";
        } else $where = "(";

        $where .= addWhere($where, "dev_data_poverki <= '" . htmlspecialchars($dev_data_poverki_end), false, true) . "'";

        $where .= ")";
    }
}

// Принимаем fif
if (!empty($_POST['fif'])) {

    if ($where) {
        $where .= "AND (";
    } else $where = "(";

    $where .= addWhere($where, "`fif` LIKE '%" . htmlspecialchars($fif), false, true) . "%'";

    $where .= ")";
}

// Принимаем приказ
if (!empty($_POST['prikaz'])) {

    if ($where) {
        $where .= "AND (";
    } else $where = "(";

    $where .= addWhere($where, "`prikaz` LIKE '%" . htmlspecialchars($prikaz), false, true) . "%'";

    $where .= ")";
}

// Принимаем то
if (!empty($_POST['to'])) {

    if ($where) {
        $where .= "AND (";
    } else $where = "(";

    $where .= addWhere($where, "`tex_o` LIKE '%" . htmlspecialchars($to), false, true) . "%'";

    $where .= ")";
}










$sql = "SELECT DISTINCT `id`,`dev_name`,`dev_marka`,`dev_zav_number`, `dev_data_release`, `dev_data_pred_poverki`, `dev_data_poverki`, `dev_img` , `status`, `dev_akt_img`,`fif`,`prikaz`,`tex_o`,`dist_id` FROM `device`, `users` WHERE ";
if ($where) {
    $sql .= "$where";
    $_SESSION['sql'] = [
        "sql" =>  $sql,
        "btn" => true,
    ];
} else {

    $_SESSION['sql'] = [
        "sql" =>  "SELECT DISTINCT `id`,`dev_name`,`dev_marka`,`dev_zav_number`, `dev_data_release`, `dev_data_pred_poverki`, `dev_data_poverki`, `dev_img` , `status`, `dev_akt_img`,`fif`,`prikaz`,`tex_o`,`dist_id` FROM `device`, `users`",
        "btn" => false,
    ];
}






//$_SESSION['sql'] = "SELECT DISTINCT `id`,`dev_name`,`dev_marka`,`dev_zav_number`, `dev_data_pred_poverki`,`dev_data_release`,`dev_data_poverki`, `dev_img` FROM `device`, `users` WHERE users.distr_id={$_SESSION['user']['distr_id']} and users.distr_id=device.dist_id and `dev_name`='$name' or `dev_name`=null ";





$response = [

    "status" => true,
    "message" => "Показываю результат!",
];
echo json_encode($response);
