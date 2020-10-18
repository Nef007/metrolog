<?php
session_start();
require_once '../vendor/connect.php';
unset($_SESSION["sql"]);
$name = $_POST['name'];
$marka = $_POST['marka'];
$zav_number = $_POST['zav_number'];
$dev_data_release = $_POST['dev_data_release'];
$dev_data_pred_poverki = $_POST['dev_data_pred_poverki'];
$dev_data_poverki = $_POST['dev_data_poverki'];
$distr_id = $_SESSION['user']['distr_id'];

//  $_SESSION['form_select'] = [
//      "name_s" => $name,
//  ];




// $check_zav_number = mysqli_query($connect, "SELECT * FROM `device` WHERE `dev_zav_number` = '$zav_number'");
// if (mysqli_num_rows($check_zav_number) > 0) {
//     $response = [
//         "status" => false,
//         "type" => 1,
//         "message" => "Такой заводской номер уже существует",
//         "fields" => ['zav_number']
//     ];

//     echo json_encode($response);
//     die();
// }



$error_fields = [];


// if ($name === '' && $marka === '' && $zav_number === '' && $dev_data_release === '' && $dev_data_pred_poverki === '' && $dev_data_poverki === '') {
//     $error_fields[] = 'name';
//     $error_fields[] = 'marka';
//     $error_fields[] = 'zav_number';
//     $error_fields[] = 'dev_data_release';
//     $error_fields[] = 'dev_data_pred_poverki';
//     $error_fields[] = 'dev_data_poverki';
// }

// if ($marka === '') {
//     $error_fields[] = 'marka';
// }

// if ($zav_number === '') {
//     $error_fields[] = 'zav_number';
// }

// if ($dev_data_release === '') {
//     $error_fields[] = 'dev_data_release';
// }

// if ($dev_data_pred_poverki === '') {
//     $error_fields[] = 'dev_data_pred_poverki';
// }
// if ($dev_data_poverki === '') {
//     $error_fields[] = 'dev_data_poverki';
// }

// value="<?= $_SESSION["form_select"]["name_s"]

// if (!$_FILES['pasport']) {
//     $error_fields[] = 'pasport';
// }

if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Проверьте правильность полей",
        "fields" => $error_fields
    ];

    echo json_encode($response);

    die();
}



// $path = 'uploads/' . time() . $_FILES['pasport']['name'];
// if (!move_uploaded_file($_FILES['pasport']['tmp_name'], '../' . $path)) {
//     $response = [
//         "status" => false,
//         "type" => 2,
//         "message" => "Ошибка при загрузке аватарки",
//     ];
//     echo json_encode($response);
// }

// echo $_FILES['pasport'];


function addWhere($where, $add, $and = true)
{
    if ($where) {
        if ($and) $where .= " AND $add";
        else $where .= " OR $add";
    } else $where = $add;
    return $where;
}
$search = explode(' ', $_POST['name']);

$where = "";
if ($search) {

    foreach ($search as $name) {

        $where = addWhere($where, "`dev_name` LIKE '%" . htmlspecialchars($name), false) . "%'";
    }
}







if ($_POST["marka"]) $where = addWhere($where, "`dev_marka` = '" . htmlspecialchars($_POST["marka"])) . "'";
// if ($_POST["manufacturers"]) $where = addWhere($where, "`manufacturer` IN (".htmlspecialchars(implode(",", $_POST["manufacturers"])).")");
// if ($_POST["wifi"]) $where = addWhere($where, "`wifi` = '1'");
$sql = "SELECT DISTINCT `id`,`dev_name`,`dev_marka`,`dev_zav_number`, `dev_data_pred_poverki`,
    `dev_data_release`,`dev_data_poverki`, `dev_img` FROM `device`, `users` WHERE (users.distr_id={$_SESSION['user']['distr_id']} and users.distr_id=device.dist_id) and (";
if ($where) {
    $sql .= " $where )";
    $_SESSION['sql'] = $sql;
} else {

    $_SESSION['sql'] = "SELECT DISTINCT `id`,`dev_name`,`dev_marka`,`dev_zav_number`, `dev_data_pred_poverki`, `dev_data_release`,`dev_data_poverki`, `dev_img` FROM `device`, `users` WHERE users.distr_id={$_SESSION['user']['distr_id']} and users.distr_id=device.dist_id";
}






//$_SESSION['sql'] = "SELECT DISTINCT `id`,`dev_name`,`dev_marka`,`dev_zav_number`, `dev_data_pred_poverki`,`dev_data_release`,`dev_data_poverki`, `dev_img` FROM `device`, `users` WHERE users.distr_id={$_SESSION['user']['distr_id']} and users.distr_id=device.dist_id and `dev_name`='$name' or `dev_name`=null ";





$response = [
    "status" => true,
    "message" => "Показываю результат!",
];
echo json_encode($response);
