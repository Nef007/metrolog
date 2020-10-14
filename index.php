<?php
session_start();
if($_SESSION['id'] != 1 ){
	header("Location: form_auth.php");}
	?>
	<?php
    //Подключение шапки
	require_once("header.php");
	?>

	<?php
	require_once("dbconnect.php");

	if (isset($_POST['enter'])) {
		$dev_name = $mysqli->real_escape_string(htmlspecialchars($_POST['dev_name']));
		// $number_house = $mysqli->real_escape_string(htmlspecialchars($_POST['number_house']));
		// $number_flat = $mysqli->real_escape_string(htmlspecialchars($_POST['number_flat']));

	



		$query1 = "INSERT INTO `device`
		( `dev_id`, `dev_name`)
		VALUES ( NULL, '$dev_name')";
		$result1 = $mysqli->query($query1);
	

	
	}
	$mysqli->close();
	?>
	<?php if (isset($result1)) { ?>
		<?php if ($result1) { ?>
			<p class='success_message'>Ввод данных прошел успешно!</p>
		<?php } else { ?>
			<p class='mesage_error'>Ошибка при добавлении данных в базу!</p>
		<?php } ?>
	<?php } ?>


	<form name='enter' action="index.php" method="post" >
		<table >
			<tr >
				<td>
					<b>Введите данные</b>
				</td>
			</tr>
			<tr>
				<td>
					<p>Название:<br/><input type="text" name="dev_name" required="required" /></p>
				</td>

				<!-- <td>
					<p>Дом: <br /><input type="text" name="number_house" required="required" /></p>
				</td>
				<td>
					<p>Кв:<br /><input type="text" name="number_flat"  /></p>
				</td> -->
			</tr>
			<tr><td>
				<p><input type="submit" name='enter' value ="Ввод" /></p>
			</td>
		</tr>
	</table>
</form>
</div>



<?php
    //Подключение  футера
require_once("footer.php");
?>

