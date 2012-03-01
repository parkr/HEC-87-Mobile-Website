<?php
	
require_once(dirname(__FILE__)."/../../Config/database.php");

$dbconfig = new DATABASE_CONFIG();
$db = $dbconfig->default;

echo "Establishing connection...\n";
mysql_connect($db['host'], $db['login'], $db['password']) or die("Could not establish connection to database.\n");
mysql_select_db($db['database']);
	
?>