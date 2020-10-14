<?php
	$request = xss($_REQUEST);
	$message_file="";
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

		elseif (isset($request["func"]) && $request["func"] == "delfile") {

			if(unlink("files/".$request["id"].".pdf")){
			$message = "Файл успешно удален!";}
			else {
				$message = "Файл не удален!";
			}


		}


		elseif (isset($request["add"])) {
			$data = array();
			$data["dist_id"] = $request["dist_user"];
			$data["fif"] = $request["fif"];
			$data["dev_name"] = $request["name"];
			$data["dev_marka"] = $request["marka"];
			$data["dev_zav_number"] = $request["zav_number"];
			$data["tex_o"] = $request["tex_o"];
			$data["prikaz"] = $request["prikaz"];
		//	$data["pasport"] = $request["pasport"];
			// $data["date_order"] = time();
			$data["dev_data_pred_poverki"] = $request["dev_data_pred_poverki"];
			$data["dev_data_release"] = $request["dev_data_release"];
			$data["dev_data_poverki"] = $request["dev_data_poverki"];
			
			//move_uploaded_file($_FILES['pasport']['tmp_name'], "files/".$_FILES['pasport']['name']);
			
			if ($data["dev_name"]) {
				if (addOrder($data)) {

					if(move_uploaded_file($_FILES['pasport']['tmp_name'], "files/".$request["id"].".pdf")){
						$message_file="Файл добавлен";
					}

					$message = "Прибор успешно добавлен!".$message_file;
					redirect("/admin/index.php?message=".urlencode($message));
				}
				else $message = "Ошибка при добавлении прибора!".$_SESSION['distr'];
			}
			else $message = "Вы не указали данные";
		}
		elseif (isset($request["edit"])) {
			$order = getOrder($request["id"]);
			$data = array();
			$data["dist_id"] = $request["dist_user"];
			$data["fif"] = $request["fif"];
			$data["dev_name"] = $request["name"];
			$data["dev_marka"] = $request["marka"];
			$data["dev_zav_number"] = $request["zav_number"];
			$data["tex_o"] = $request["tex_o"];
			$data["prikaz"] = $request["prikaz"];
		//	$data["pasport"] = $request["pasport"];
			// $data["date_order"] = time();
			$data["dev_data_pred_poverki"] = $request["dev_data_pred_poverki"];
			$data["dev_data_release"] = $request["dev_data_release"];
			$data["dev_data_poverki"] = $request["dev_data_poverki"];

			if ($data["dev_name"]) {
				if (setOrder($request["id"], $data)) {

					if(move_uploaded_file($_FILES['pasport']['tmp_name'], "files/".$request["id"].".pdf")){
						$message_file="Файл добавлен";
					}

					$message = "Прибор успешно отредактирован!".$message_file;
					redirect("/admin/index.php?message=".urlencode($message));
				}
				else $message = "Ошибка при редактировании прибора!";
			}	
			else $message = "Вы не указали данные!";
		}
		elseif (isset($request["func"]) && $request["func"] == "delete") {
			if (deleteOrder($request["id"])) {
				if (file_exists("files/".$request["id"].".pdf")){
					unlink("files/".$request["id"].".pdf");}
			
				$message = "Прибор успешно удалён!";
				redirect("/admin/index.php?message=".urlencode($message));
			}
			else $message = "Ошибка при удалении прибора!";
		}
		
	}
	
?>