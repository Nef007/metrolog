<?php
	$request = xss($_REQUEST);
	if (isset($request["message_bad"])) $message_bad = $request["message_bad"];
	if (isset($request["message_good"])) $message_good = $request["message_good"];
	
	if (isset($request["auth"])) {
		
///////////////////////////Начало авторизации/////////////////////////////////
/*
    Проверяем была ли отправлена форма, то есть была ли нажата кнопка Войти. Если да, то идём дальше, если нет, то выведем пользователю сообщение об ошибке, о том что он зашёл на эту страницу напрямую.
*/
if(isset($_POST["auth"]) && !empty($_POST["auth"])){

	$login = trim($_POST["login"]);
	if(isset($_POST["login"])){

		if(!empty($login)){
			$login = htmlspecialchars($login, ENT_QUOTES);

		}

		else{
	// Сохраняем в сессию сообщение об ошибке.
	    $massage_bad = "Поле для  ввода Логина не должно быть пустым.";

	//Возвращаем пользователя на страницу регистрации
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: /?massage_bad=".urlencode($massage_bad));

	//Останавливаем скрипт
			exit();
		}
	}


	else{
// Сохраняем в сессию сообщение об ошибке.
          $massage_bad= "Отсутствует поле для Логина";

//Возвращаем пользователя на страницу авторизации
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: /?massage_bad=".urlencode($massage_bad));

//Останавливаем скрипт
		exit();
	}


	if(isset($_POST["password"])){

//Обрезаем пробелы с начала и с конца строки
		$password = trim($_POST["password"]);

		if(!empty($password)){
			$password = htmlspecialchars($password, ENT_QUOTES);

	//Шифруем пароль
			//$password = md5($password);
		}else{
	// Сохраняем в сессию сообщение об ошибке.
	         $massage_bad = "Укажите Ваш пароль";

	//Возвращаем пользователя на страницу регистрации
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: /?massage_bad=".urlencode($massage_bad));

	//Останавливаем скрипт
			exit();
		}

	}else{
// Сохраняем в сессию сообщение об ошибке.
$massage_bad= "Отсутствует поле для ввода пароля";

//Возвращаем пользователя на страницу регистрации
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: /?massage_bad=".urlencode($massage_bad));

//Останавливаем скрипт
		exit();

	}

//Запрос в БД на выборке пользователя.
	$result_query_select = $mysqli->query("SELECT * FROM `users` WHERE login = '$login' AND password = '$password'");

	if(!$result_query_select){
// Сохраняем в сессию сообщение об ошибке.
$massage_bad = "Ошибка запроса на выборке пользователя из БД";

//Возвращаем пользователя на страницу регистрации
	 header("HTTP/1.1 301 Moved Permanently");
	 header("Location: /?massage_bad=".urlencode($massage_bad));

//Останавливаем скрипт
	 exit();
 }else{

//Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
	 if($result_query_select->num_rows == 1){

	// Если введенные данные совпадают с данными из базы, то сохраняем логин и пароль в массив сессий.
		$query1 = "SELECT last_name, patronymic, distr_id, distr  FROM `users` WHERE login = '$login' ";

		$result_set = $mysqli->query($query1);

		while (($row = $result_set->fetch_assoc()) != false) {

			$_SESSION['fio'] = $row['last_name']." ".$row['patronymic'];
			$_SESSION['distr_id'] = $row['distr_id'];
			$_SESSION['distr'] = $row['distr'];
		}


		$_SESSION['login'] = $login;
		$_SESSION['password'] = $password;
		$_SESSION['id'] = 1;


	//Возвращаем пользователя на главную страницу
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: /index.php");

	}else{

	// Сохраняем в сессию сообщение об ошибке.
	
	$massage_bad = "Неправильный логин и/или пароль".$password;

	//Возвращаем пользователя на страницу авторизации
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: /auth.php?massage_bad=".urlencode($massage_bad));
		

	//Останавливаем скрипт
		exit();
	}
}

}else{
exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти  <a href='index.php'> главную страницу </a>.</p>");
}



//Конец авторизация/////////////////////////////////////////////////////


	}



	if (isAdmin()) {
		$data_st = array();
		if (isset($request["logout"])) {
			logout();
			redirect("/");
		}

		elseif (isset($request["func"]) && $request["func"] == "delfile") {

			if(unlink("admin/files/".$request["id"].".pdf")){
			$massage_good = "Файл успешно удален!";
			redirect("/index.php?massage_good=".urlencode($massage_good));}
			else {
				$massage_bad = "Файл не удален!";
				redirect("/index.php?massage_bad=".urlencode($massage_bad));
			}

			


		}



		elseif (isset($request["add"])) {
			$data = array();
			$data["dist_id"] = $_SESSION['distr_id'];
			$data["dev_name"] = $request["name"];
			$data["dev_marka"] = $request["marka"];
			$data["dev_zav_number"] = $request["zav_number"];
			// $data["date_order"] = time();
			$data["dev_data_pred_poverki"] = $request["dev_data_pred_poverki"];
			$data["dev_data_release"] = $request["dev_data_release"];
			$data["dev_data_poverki"] = $request["dev_data_poverki"];

			
			if ($data["dev_name"]) {
				if (addOrder($data)) {

					if(move_uploaded_file($_FILES['pasport']['tmp_name'], "admin/files/".$request["id"].".pdf")){
						$message_file="Файл добавлен";
					}
					$message_good = "прибор успешно добавлен!";
					redirect("/index.php?message_good=".urlencode($message_good)."#main");
				}
				else $message = "Ошибка при добавлении прибора!";
				redirect("/index.php?message_good=".urlencode($message_good)."#main");
			}
			else $message_bad = "Вы не указали данные";
			redirect("/index.php?message_bad=".urlencode($message_bad)."#main");
		}
		elseif (isset($request["edit"])) {
			$order = getOrder($request["id"]);
			$data = array();
			$data["dev_name"] = $request["name"];
			$data["dev_marka"] = $request["marka"];
			$data["dev_zav_number"] = $request["zav_number"];
			// $data["date_order"] = time();
			$data["dev_data_pred_poverki"] = $request["dev_data_pred_poverki"];
			$data["dev_data_release"] = $request["dev_data_release"];
			$data["dev_data_poverki"] = $request["dev_data_poverki"];

			if ($data["dev_name"]) {
				if (setOrder($request["id"], $data)) {

					if(move_uploaded_file($_FILES['pasport']['tmp_name'], "admin/files/".$request["id"].".pdf")){
						$message_file="Файл добавлен";
					}

					$message = "прибор успешно отредактирован!";
					redirect("/index.php?message=".urlencode($message));
				}
				else $message = "Ошибка при редактировании прибора!";
			}	
			else $message = "Вы не указали данные!";
		}
		elseif (isset($request["func"]) && $request["func"] == "delete") {
			if (deleteOrder($request["id"])) {

				if (file_exists("files/".$request["id"].".pdf")){
					unlink("admin/files/".$request["id"].".pdf");}
			
				$message = "прибор успешно удалён!";
				redirect("/index.php?message=".urlencode($message));
			}
			else $message = "Ошибка при удалении прибора!";
		}
		
	}
	
?>