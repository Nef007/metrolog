<?php
	$request = xss($_REQUEST);
	if (isset($request["message"])) $message = $request["message"];
	
	
	elseif (isset($request["auth"])) {
		if (login($request["login"], $request["password"])) redirect("/admin");
		else $message = "Неверные имя пользователя и/или пароль!";
	}


	if (isAdmin()) {
		$data_st = array();
		if (isset($request["logout"])) {
			logout();
			redirect("/");
		}


		
		elseif (isset($request["add"])) {
			$data = array();
			$data["distr"] = $request["distr"];
			$data["distr_id"] = $request["max"];
			$data["first_name"] = $request["first_name"];
			$data["last_name"] = $request["last_name"];
			$data["patronymic"] = $request["patronymic"];
			// $data["date_order"] = time();
			$data["login"] = $request["login"];
			$data["password"] = $request["password"];

			
			if ($data["first_name"]) {
				if (addOrder($data)) {
					$message = "пользователь успешно добавлен!";
					redirect("/admin/users.php?message=".urlencode($message));
				}
				else $message = "Ошибка при добавлении пользователя!".$data["distr_id"];
			}
			else $message = "Вы не указали данные";
		}
		elseif (isset($request["edit"])) {
			$order = getOrder($request["id"]);
			$data = array();
			$data["first_name"] = $request["first_name"];
			$data["distr"] = $request["distr"];
			$data["last_name"] = $request["last_name"];
			$data["patronymic"] = $request["patronymic"];
			// $data["date_order"] = time();
			$data["login"] = $request["login"];
			$data["password"] = $request["password"];

			if ($data["first_name"]) {
				if (setOrder($request["id"], $data)) {
					$message = "пользователь успешно отредактирован!";
					redirect("/admin/users.php?message=".urlencode($message));
				}
				else $message = "Ошибка при редактировании пользователя!";
			}	
			else $message = "Вы не указали данные!";
		}
		elseif (isset($request["func"]) && $request["func"] == "delete") {
			if (deleteOrder($request["id"])) {
				$message = "пользователь успешно удалён!";
				redirect("/admin/users.php?message=".urlencode($message));
			}
			else $message = "Ошибка при удалении пользователя!";
		}
		
	}
	
?>