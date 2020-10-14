<!DOCTYPE html>
<html>
<head>
	<title>Admin-панель</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="Admin-панель." />
	<meta name="keywords" content="admin панель, управление сайтом, управление лендингом" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link type="text/css" rel="stylesheet" href="/styles/admin.css" />
	<!-- <link type="text/css" rel="stylesheet" href="/styles/main.css" /> -->
	<link type="text/css" rel="stylesheet" href="/css/main.css" />
</head>
<body>
<?php if (isAdmin()) { ?>
	<div id="logout">
		<a href="/?logout=1">Выход</a>
	</div>
	
<?php } ?>