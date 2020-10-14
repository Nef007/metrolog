<?php
	require_once "libuser/start.php";
	require_once "top.php";
	if (isAdmin()) { $orders = getOrders();
		
	if (isset($request["func"]) && $request["func"] == "edit") {
		$fd = getOrder($request["id"]);
	}
	else $fd = $request; ?>

             
              

<h1>Приборы <?php echo $_SESSION['distr']; ?> </h1>
<?php $path= scandir("admin/files"); 
if ($message_bad){?> <div class="massage_bad"> <a  href="#" id="main">
	<div id="okno" "><?=$message_bad?></div>
	</a></div><?php } ?> 
	<?php if ($message_good){?> <div class="massage_good"> <a href="#" id="main">
	<div id="okno" class="message_good"><?=$message_good?></div>
	</a></div><?php } ?> 
	

<button class="button header-btn popup-btn">
                  Добавить СИ
                </button>
<button id="btn" class="button" >Выгрузить в Exel</button>


<table id="filter-table" class="table_sort tableexl">
<thead>
	<tr class='header'>

	    <!-- <td>ID</td> -->
		<th>Наименование</th>
		<th>Тип,марка</th>
		<th>Заводской номер</th>
		<th>Паспорт</th>
		<th>год выпуска</th>
		<th>Дата поверки</th>
		<th>Дата следующей поверки</th>
		
		
	</tr>
	

	<tr class='table-filters'>
        <td>
            <input type="text" placeholder="Поиск"/>
        </td>
        <td>
            <input type="text" placeholder="Поиск"/>
        </td>
        <td>
            <input type="text" placeholder="Поиск"/>
		</td>
		<td>
            <input type="text" placeholder="Поиск"/>
        </td>
        <td>
            <input type="text" placeholder="Поиск"/>
        </td>
        <td>
            <input type="text" placeholder="Поиск"/>
		</td>
        <td>
            <input type="text" placeholder="Поиск"/>
		</td>
		
		
	</tr>
	</thead>
	
	
	<?php
	$x=1;
	 foreach ($orders as $order) {
			if (date('Y-m-d')<$order["dev_data_poverki"]) {
				echo(" <tr class='table-data'>\n");
				$x=0;
			  } else {
				echo(" <tr class='table-data gr'>\n");
				$x=1;
			  }
		
		?>
		
		
			<td width="200px"><?=$order["dev_name"]?> </td>
			<td width="200px"><?=$order["dev_marka"]?></td>
			<td width="200px"><?=$order["dev_zav_number"]?></td>
			<td width="200px"><?php foreach($path as $f){ if ($f != '.' and $f != '..' and $f==$order["id"].".pdf") {echo "<a href=admin/files/".$f." target=_blank>".$f."</a><a href=/index.php?func=delfile&amp;id=".$order["id"].">X</a>";}}?></td>
			<td width="200px"><?=$order["dev_data_release"]?></td>
			<td width="200px"><?=$order["dev_data_pred_poverki"]?></td>
			<td width="200px"><?=$order["dev_data_poverki"]?></td>
			
			
			
		</tr>
	<?php } ?>
	
</table>
<?php } else require_once "auth.php"; ?>

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
	<form class="addform" name="form_order" action="index.php<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>?func=edit&amp;id=<?=$fd["id"]?><?php } ?>" method="post" enctype="multipart/form-data">
		
	<div>
			<label>Наименование:</label> <input type="text" name="name" value="<?php if (isset($fd["dev_name"]) && $fd["dev_name"]) { ?><?=$fd["dev_name"]?><?php } ?>" />
		</div>
		<div>
			<label>Тип,марка:</label> <input type="text" name="marka" value="<?php if (isset($fd["dev_marka"]) && $fd["dev_marka"]) { ?><?=$fd["dev_marka"]?><?php } ?>" />
		</div>
		<div>
			<label>Заводской №:</label> <input type="text" name="zav_number" value="<?php if (isset($fd["dev_zav_number"]) && $fd["dev_zav_number"]) { ?><?=$fd["dev_zav_number"]?><?php } ?>" />
		</div>
		<div>
			<label>Паспорт:</label> <input type="file" name="pasport" value="<?php if (isset($fd["pasport"]) && $fd["pasport"]) { ?><?=$fd["pasport"]?><?php } ?>" />
		</div>
		<div>
			<label>Год выпуска:</label> <input type="date" name="dev_data_release" value="<?php if (isset($fd["dev_data_release"]) && $fd["dev_data_release"]) { ?><?=$fd["dev_data_release"]?><?php } ?>" />
		</div>
		<div>
			<label>Дата поверки:</label> <input type="date" name="dev_data_pred_poverki" value="<?php if (isset($fd["dev_data_pred_poverki"]) && $fd["dev_data_pred_poverki"]) { ?><?=$fd["dev_data_pred_poverki"]?><?php } ?>" />
		</div>
		<div>
			<label>Дата следующей поверки:</label> <input type="date" name="dev_data_poverki" value="<?php if (isset($fd["dev_data_poverki"]) && $fd["dev_data_poverki"]) { ?><?=$fd["dev_data_poverki"]?><?php } ?>" />
		</div>
		<div>
			<input type="hidden" name="id" value="<?php if (isset($fd["id"])) { ?><?=$fd["id"]?><?php } ?>" />
			<input type="submit" name="<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>edit<?php } else { ?>add<?php } ?>" value="<?php if (isset($request["func"]) && $request["func"] == "edit") { ?>Редактировать<?php } else { ?>Добавить<?php } ?>" />
		</div>
	</form>
</div>

            </form>
          </div>
        </div>
      </div>
	</div>

	 <!-- подключение jqweri -->
	 <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	
	 <script>
      $(document).ready(function () {
        $(".popup-btn").on("click", function (event) {
          event.preventDefault();
          $(".popup").fadeIn();
        });
        $(".popup-close").on("click", function () {
          event.preventDefault();
          $(".popup").fadeOut();
        });

	});

		</script>





<?php
	require_once "footer.php";
?>

<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/jquery.table2excel.js"></script>
<script>
$('.table-filters input').on('input', function () {
    filterTable($(this).parents('table'));
});

function filterTable($table) {
    var $filters = $table.find('.table-filters td');
    var $rows = $table.find('.table-data');
    $rows.each(function (rowIndex) {
        var valid = true;
        $(this).find('td').each(function (colIndex) {
            if ($filters.eq(colIndex).find('input').val()) {
                if ($(this).html().toLowerCase().indexOf(
                $filters.eq(colIndex).find('input').val().toLowerCase()) == -1) {
                    valid = valid && false;
                }
            }
        });
        if (valid === true) {
            $(this).css('display', '');
        } else {
            $(this).css('display', 'none');
        }
    });
}

$('#btn').click(function() {
    $('.tableexl').table2excel({
        exclude: ".noExl",
		name: "SI",
		filename: "SI"
            
        
    } );
} );
</script>

<script>document.addEventListener('DOMContentLoaded', () => {

const getSort = ({ target }) => {
	const order = (target.dataset.order = -(target.dataset.order || -1));
	const index = [...target.parentNode.cells].indexOf(target);
	const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
	const comparator = (index, order) => (a, b) => order * collator.compare(
		a.children[index].innerHTML,
		b.children[index].innerHTML
	);
	
	for(const tBody of target.closest('table').tBodies)
		tBody.append(...[...tBody.rows].sort(comparator(index, order)));

	for(const cell of target.parentNode.cells)
		cell.classList.toggle('sorted', cell === target);
};

document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));

});



</script>


