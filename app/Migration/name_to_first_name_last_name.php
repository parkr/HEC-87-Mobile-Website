<?php
	
require_once("Lib/connect.php");

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