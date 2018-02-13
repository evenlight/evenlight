<?php

	version_compare(phpversion(), '5.5.0', '>=') || die('PHP version isn\'t high enough! Need PHP v5.5 or higher.');

//Вывод PHP ошибок
	if ( $php_errors )
	{

		@error_reporting(-1);
		@ini_set('error_reporting', E_ALL);
		@ini_set('display_errors', 1);
		@ini_set('html_errors', 1);

	}
	else
	{

		@error_reporting(0);
		@ini_set('error_reporting', ~E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
		@ini_set('display_errors', 0);
		@ini_set('html_errors', 0);

	}

//Константы
	defined('ROOT') 	|| define('ROOT', substr(dirname(__FILE__), 0, -6));
	defined('ENGINE') 	|| define('ENGINE', ROOT . '/engine');
	defined('CONFIG') 	|| define('CONFIG', ENGINE . '/config');
	defined('CLASSES') 	|| define('CLASSES', ENGINE . '/classes');
	defined('LOGS') 	|| define('LOGS', ENGINE . '/logs/');

//Подключение конфига
	$cfg = require CONFIG . '/main.php';

//Установка часового пояса
	date_default_timezone_set($cfg['timezone']);

//Заголовки
	header("Content-Type: text/html; charset=utf-8");
	header('Access-Control-Allow-Origin: ' . $cfg['home_url']);