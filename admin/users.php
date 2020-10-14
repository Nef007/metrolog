<?php
	require_once "libcontrol/start.php";
	require_once "top.php";
	if (isAdmin()) { $orders = getusers();
		$maxcount = maxdistrId();
		foreach ($maxcount as $max) {
				$max=($max["distr_id"])+1;
		}


		
	if (isset($request["func"]) && $request["func"] == "edit") {
		$fd = getOrder($request["id"]);
	}
	else $fd = $request; ?>
<div id="form_order">

	<h1><?php if (isset($request["func"]) && $request["func"] == "edit") { ?>Редактировать<?php } else { ?>Добавить<?php } ?> пользователя</h1>
	<form name="form_order" action="users.php<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>?func=edit&amp;id=<?=$fd["user_id"]?><?php } ?>" method="post">
		<div>
			<label>Район:</label> <input type="text" name="distr" value="<?php if (isset($fd["distr"]) && $fd["distr"]) { ?><?=$fd["distr"]?><?php } ?>" />
		</div>
		<div>
			<label>Фамилия</label> <input type="text" name="first_name" value="<?php if (isset($fd["first_name"]) && $fd["first_name"]) { ?><?=$fd["first_name"]?><?php } ?>" />
		</div>
		<div>
			<label>Имя</label><input type="text" name="last_name" value="<?php if (isset($fd["last_name"]) && $fd["last_name"]) { ?><?=$fd["last_name"]?><?php } ?>" />
		</div>
		<div>
			<label>Отчество</label><input type="text" name="patronymic" value="<?php if (isset($fd["patronymic"]) && $fd["patronymic"]) { ?><?=$fd["patronymic"]?><?php } ?>" />
		</div>
		<div>
			<label>Логин</label> <input type="text" name="login" value="<?php if (isset($fd["login"]) && $fd["login"]) { ?><?=$fd["login"]?><?php } ?>" />
		</div>
		<div>
			<label>Пароль</label> <input type="text" name="password" value="<?php if (isset($fd["password"]) && $fd["password"]) { ?><?=$fd["password"]?><?php } ?>" />
		</div>
		<div>
			<input type="hidden" name="id" value="<?php if (isset($fd["user_id"])) { ?><?=$fd["user_id"]?><?php } ?>" />
			<input type="hidden" name="max" value=<?=$max?>>
			<input type="submit" name="<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>edit<?php } else { ?>add<?php } ?>" value="<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>Редактировать<?php } else { ?>Добавить<?php } ?>" />
		</div>
	</form>
</div>
<h1>Пользователи</h1>
<?php if ($message) { ?><p class="message"><?=$message?></p><?php } ?>
<table>
	<tr>
		<td>Район</td>
		<td>Фамилия</td>
		<td>Имя</td>
		<td>Отчетсво</td>
		<td>Логин</td>
		<td>Функции</td>
		
	</tr>
	<?php
	$x=1;
	 foreach ($orders as $order) {
			
		
		?>
        <tr>
		
			<td><?=$order["distr"]?></td>
			<td><?=$order["first_name"]?></td>
			<td><?=$order["last_name"]?></td>
			<td><?=$order["patronymic"]?></td>
			<td><?=$order["login"]?></td>
		
			
			
			<td>
				<a href="/admin/users.php?func=edit&amp;id=<?=$order["user_id"]?>">Редактировать</a>
				<br />
				<a href="/admin/users.php?func=delete&amp;id=<?=$order["user_id"]?>">Удалить</a>
			</td>
		</tr>
	<?php } ?>
</table>
<?php } else require_once "auth.php"; ?>
<?php
	require_once "footer.php";
?>