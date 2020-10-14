<?php
require_once("header.php");

require_once("dbconnect.php");
	//////////////////////////////////////////////////////////////ПОЛОСА ПРОКРУТКИ///


function getTable($query) {
	global $mysqli;
	$result_set = $mysqli->query($query);
	if (is_null($result_set)) return false;
	$result = array();
	while (($row = $result_set->fetch_assoc()) != false) {
		$result[] = $row;
	}
	$result_set->close();
	return $result;
}





function getOrders() {

	/*$query = "SELECT * FROM `lan_orders`  ORDER BY `date_order` DESC";*/

	$query = "SELECT * FROM `device`";
	$result = getTable($query);
	if (!$result) return array();
	return $result;
}

$orders = getOrders();





$data_st = array();




function xss($data) {
	if (is_array($data)) {
		$escaped = array();
		foreach ($data as $key => $value) {
			$escaped[$key] = xss($value);
		}
		return $escaped;
	}
	return trim(htmlspecialchars($data));
}

function deleteRow($table, $id) {
	if (!is_numeric($id)) exit;
	global $mysqli;
	$query = "DELETE FROM `$table` WHERE `dev_id`='$id'";
	return $mysqli->query($query);
}



function deleteOrder($id) {
	return deleteRow("device", $id);
}
$request = xss($_REQUEST);
if (isset($request["func"]) && $request["func"] == "delete") {
	if (deleteOrder($request["id"])) {
		$message = "Заказ успешно удалён!";
		redirect("/find.php");
	}
	else $message = "Ошибка при удалении заказа!";
}

?>
<?php if ($message) { ?><p class="message"><?=$message?></p><?php } ?>

<table>
	<tr>
		<td>ID</td>
		<td>Цена</td>
		<td>Телефон</td>
		<td>Дата заказа</td>
		<td>Дата подтверждения</td>
		<td>Дата оплаты</td>
		<td>Дата аннулирования</td>
		<td>Кампания</td>
		<td>Функции</td>
	</tr>
	<?php foreach ($orders as $order) { ?>
		<tr>
			<td><?=$order["dev_id"]?></td>
			<td><?=$order["dev_name"]?></td>
			
			<td>
				<a href="/find.php?func=edit&amp;id=<?=$order["dev_id"]?>">Редактировать</a>
				<br />
				<a href="/find.php?func=delete&amp;id=<?=$order["dev_id"]?>">Удалить</a>
			</td>
		</tr>
	<?php } ?>
</table>




<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {

//Здесь функция function DleTrackDownload

});
</script>





</div>

<?php
//Подключение подвала
require_once("footer.php");
?>
