<?php
	mb_internal_encoding("UTF-8");
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	session_start();

	$message = false;
	//define("SECRET", "ds9gdsags");
	define("ADM_LOGIN", "1");
	define("ADM_PASSWORD", "123");

	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASSWORD", "root");
	define("DB_NAME", "metr31");

	define("SMS_USER", "");
	define("SMS_PASSWORD", md5(""));
	define("SMS_PHONE", "");

	define("DIRECT_TOKEN", "");

	define("FORMAT_DATE", "Y.m.d H:i:s");

	require_once "functions.php";
	require_once "request.php";
?>