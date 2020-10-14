<?php
	require_once "lib/start.php";
	require_once "top.php";
	if (isAdmin()) { $orders = getOrders();
		$distrs=getDistusers();
		
	if (isset($request["func"]) && $request["func"] == "edit") {
		$fd = getOrder($request["id"]);
	}
	else $fd = $request; ?>
<div id="form_order">

	<h1><?php if (isset($request["func"]) && $request["func"] == "edit") { ?>Редактировать<?php } else { ?>Добавить<?php } ?> прибор</h1>
	<form name="form_order" action="index.php<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>?func=edit&amp;id=<?=$fd["id"]?><?php } ?>" method="post" enctype="multipart/form-data">
		<div>
			<label>№ФИФ:</label> <input type="text" name="fif" value="<?php if (isset($fd["fif"]) && $fd["fif"]) { ?><?=$fd["fif"]?><?php } ?>" />
		</div>
		<div>
			<label>Наименование:</label> <input type="text" name="name" value="<?php if (isset($fd["dev_name"]) && $fd["dev_name"]) { ?><?=$fd["dev_name"]?><?php } ?>" />
		</div>
		<div>

		 <label>Район:</label> <select id="selecttheme" name="dist_user">
			<?php
			foreach ($distrs as $dist){
				?>
         <option value=<?=$dist["distr_id"]?>><?=$dist["distr"]?></option> 
		 <?php
		 }
		 ?>
   
           </select>


		</div>
		<div>
			<label>Тип,марка:</label> <input type="text" name="marka" value="<?php if (isset($fd["dev_marka"]) && $fd["dev_marka"]) { ?><?=$fd["dev_marka"]?><?php } ?>" />
		</div>
		<div>
			<label>Заводской номер:</label><input type="text" name="zav_number" value="<?php if (isset($fd["dev_zav_number"]) && $fd["dev_zav_number"]) { ?><?=$fd["dev_zav_number"]?><?php } ?>" />
		</div>
		<div>
			<label>ТО:</label><input type="text" name="tex_o" value="<?php if (isset($fd["tex_o"]) && $fd["tex_o"]) { ?><?=$fd["tex_o"]?><?php } ?>" />
		</div>
		<div>
			<label>Приказ:</label><input type="text" name="prikaz" value="<?php if (isset($fd["prikaz"]) && $fd["prikaz"]) { ?><?=$fd["prikaz"]?><?php } ?>" />
		</div>
		<div>
			<label>Паспорт:</label><input type="file" name="pasport" value="<?php if (isset($fd["pasport"]) && $fd["pasport"]) { ?><?=$fd["pasport"]?><?php } ?>" />
		</div>
		<div>
			<label>год выпуска:</label> <input type="date" name="dev_data_release" value="<?php if (isset($fd["dev_data_release"]) && $fd["dev_data_release"]) { ?><?=$fd["dev_data_release"]?><?php } ?>" />
		</div>
		<div>
			<label>дата поверки:</label> <input type="date" name="dev_data_pred_poverki" value="<?php if (isset($fd["dev_data_pred_poverki"]) && $fd["dev_data_pred_poverki"]) { ?><?=$fd["dev_data_pred_poverki"]?><?php } ?>" />
		</div>
		<div>
			<label>дата следующей поверки:</label> <input type="date" name="dev_data_poverki" value="<?php if (isset($fd["dev_data_poverki"]) && $fd["dev_data_poverki"]) { ?><?=$fd["dev_data_poverki"]?><?php } ?>" />
		</div>
		<div>
			<input type="hidden" name="id" value="<?php if (isset($fd["id"])) { ?><?=$fd["id"]?><?php } ?>" />
			<input type="submit" name="<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>edit<?php } else { ?>add<?php } ?>" value="<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>Редактировать<?php } else { ?>Добавить<?php } ?>" />
		</div>
	</form>
</div>
<h1>Приборы всех районов </h1>
<?php if ($message) { ?><p class="message"><?=$message?></p><?php } ?>

<?php
$path= scandir("files");
foreach ($distrs as $dist){?>
	<table>

	<tr>
		<td><?=$dist["distr"]?></td>

		</tr>
	</table>



<table>

	<tr>
		<td>ID</td>
		<td>№ФИФ</td>
		<td>Наименование</td>
		<td>Тип,марка</td>
		<td>Заводской номер</td>
		<td>ТО</td>
		<td>Приказ</td>
		<td>Паспорт</td>
		<td>год выпуска</td>
		<td>Дата поверки</td>
		<td>Дата следующей поверки</td>
		<td>Функции</td>
		
	</tr>
	<?php



	$x=1;
	 foreach ($orders as $order) {

		if ($order["dist_id"]==$dist["distr_id"]) {

			if (date('Y-m-d')<$order["dev_data_poverki"]) {
				echo(" <tr>\n");
				$x=0;
			  } else {
				echo(" <tr class='gr'>\n");
				$x=1;
			  }
			
		?>
		
			<td><?=$order["id"]?></td>
			<td><?=$order["fif"]?></td>
			<td width="300px"><?=$order["dev_name"]?> </td>
			<td width="200px"><?=$order["dev_marka"]?></td>
			<td width="200px"><?=$order["dev_zav_number"]?></td>
			<td width="200px"><?=$order["tex_o"]?></td>
			<td width="200px"><?=$order["prikaz"]?></td>
			<td width="200px"><?php foreach($path as $f){ if ($f != '.' and $f != '..' and $f==$order["id"].".pdf") {echo "<a href=files/".$f." target=_blank>".$f."</a><a href=/admin/index.php?func=delfile&amp;id=".$order["id"].">X</a>";}}?></td>
			<td width="200px"><?=$order["dev_data_release"]?></td>
			<td width="200px"><?=$order["dev_data_pred_poverki"]?></td>
			<td width="200px"><?=$order["dev_data_poverki"]?></td>
			
			
			<td>
				<a href="/admin/index.php?func=edit&amp;id=<?=$order["id"]?>">Редактировать</a>
				<br />
				<a href="/admin/index.php?func=delete&amp;id=<?=$order["id"]?>">Удалить</a>
			</td>
		</tr>
	<?php }}} ?>
</table>
<?php } else require_once "auth.php"; ?>
<?php
	require_once "footer.php";
?>