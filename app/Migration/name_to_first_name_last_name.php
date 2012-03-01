<?php
	
require_once(dirname(__FILE__)."/../Config/database.php");

$dbconfig = new DATABASE_CONFIG();
$db = $dbconfig->default;

echo "Establishing connection...\n";
mysql_connect($db['host'], $db['login'], $db['password']) or die("Could not establish connection to database.\n");
mysql_select_db($db['database']);

$db['prefix'];

$query = "SELECT id,name FROM ".$db['prefix']."users WHERE 1=1";
$r = mysql_query($query) or die("Could not get list of User.id's.\n");
$users = array();
while($line = mysql_fetch_assoc($r)){
	$users[] = array(
		'id' => $line['id'],
		'name' => $line['name']
	);
}

foreach($users as $user){
	$firstlast = explode(" ", trim($user['name']));
	$query = "UPDATE ".$db['prefix']."users SET last_name = '".$firstlast[count($firstlast)-1]."', first_name = '". implode(" ", array_slice($firstlast, 0, count($firstlast)-1)) ."' WHERE id = ".$user['id'];
	mysql_query($query) or die("Could not complete query: '$query': ".mysql_error());
}
	
?>