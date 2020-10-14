<?php



function get_posts($mysqli){

	
	$result = $mysqli->query("SELECT * FROM `device`");

	if (!$result) {
		exit ("<p> В базе данных не обнаружено таблицы</p>");
	}


$row = array();
for ($i=0; $i<$result->num_rows; $i++ ) {
$row[]=$result->fetch_assoc();
}

return $row;
}


// function get_count_statti($mysqli, $surname_owner,$name_owner,$patronymic_owner) {

// 	if(!empty($surname_owner) && !empty($name_owner)){
// 		$sql = "SELECT * FROM `ul31_adress`, `ul31_owner`, `ul31_check` WHERE ul31_owner.surname_owner LIKE '$surname_owner' and ul31_owner.name_owner LIKE '$name_owner' and ul31_adress.id=ul31_check.id_check and ul31_adress.id=ul31_owner.id_owner";

// 	}

// 	elseif (!empty($surname_owner) && !empty($patronymic_owner)){

// 		$sql = "SELECT * FROM `ul31_adress`, `ul31_owner`, `ul31_check` WHERE (ul31_owner.surname_owner LIKE '$surname_owner' and ul31_owner.patronymic_owner  LIKE '$patronymic_owner') and ul31_adress.id=ul31_check.id_check and ul31_adress.id=ul31_owner.id_owner";
// 	}
// 	elseif(!empty($name_owner) && !empty($patronymic_owner)){

// 		$sql = "SELECT * FROM `ul31_adress`, `ul31_owner`, `ul31_check` WHERE ( ul31_owner.name_owner LIKE '$name_owner' and ul31_owner.patronymic_owner  LIKE '$patronymic_owner') and ul31_adress.id=ul31_check.id_check and ul31_adress.id=ul31_owner.id_owner";}


// 		elseif(!empty($name_owner) && !empty($patronymic_owner) && !empty($surname_owner)){

// 			$sql = "SELECT * FROM `ul31_adress`, `ul31_owner`, `ul31_check` WHERE (ul31_owner.surname_owner LIKE '$surname_owner' and ul31_owner.name_owner LIKE '$name_owner' and ul31_owner.patronymic_owner  LIKE '$patronymic_owner') and ul31_adress.id=ul31_check.id_check and ul31_adress.id=ul31_owner.id_owner";}

// 			else  {

// 				$sql = "SELECT * FROM `ul31_adress`, `ul31_owner`, `ul31_check` WHERE (ul31_owner.surname_owner LIKE '$surname_owner' or ul31_owner.name_owner LIKE '$name_owner' or ul31_owner.patronymic_owner  LIKE '$patronymic_owner') and ul31_adress.id=ul31_check.id_check and ul31_adress.id=ul31_owner.id_owner";
// 			}
// 			$result = $mysqli->query($sql) ;

// 			if(!$result) {
// 				exit ($mysqli->error());

// 			}

// 			return $result->num_rows;
// 		}

// 		function number_pages ($count_statti) {
// 			if($count_statti<=COUNT_PER_PAGE){
// 				return FALSE;
// 			}

// 			$number_pages = ceil($count_statti/COUNT_PER_PAGE);


// 			return $number_pages;
// 		}

?>



