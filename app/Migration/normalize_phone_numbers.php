<?php

require_once("Lib/connect.php");

$query = "SELECT id,phone_number FROM ".$db['prefix']."users WHERE 1=1";
$r = mysql_query($query) or die("Could not get list of Users.\n");
$users = array();
while($line = mysql_fetch_assoc($r)){
	$users[] = array(
		'id' => $line['id'],
		'phone_number' => $line['phone_number']
	);
}

echo "Normalizing phone numbers...\n";
foreach($users as $user){
	$num = preg_replace('/(-|_| |\+|\(|\)|\.)+/', "", $user['phone_number']);
	$query = "UPDATE ".$db['prefix']."users SET phone_number = '$num' WHERE id = ".$user['id'];
	mysql_query($query) or die("Could not complete query: '$query': ".mysql_error());
}

echo "Completed.\n";

	
?>