<?
	require('config.php');
	mysql_connect($Cfg["mysql"]["host"],$Cfg["mysql"]["user"],$Cfg["mysql"]["pass"]);
	mysql_select_db($Cfg["mysql"]["db"]);
?>