<?php

require_once("Lib/connect.php");


/********* USERS **********/
$query = "SELECT id,bio FROM ".$db['prefix']."users WHERE 1=1";
$r = mysql_query($query) or die("Could not get list of Users.\n");
$users = array();
while($line = mysql_fetch_assoc($r)){
	$users[] = $line;
}

echo "Normalizing newlines in User bios...\n";
foreach($users as $user){
	$bio = mysql_real_escape_string(str_replace("\r\n", "\n", $user['bio']));
	$query = "UPDATE ".$db['prefix']."users SET bio = '$bio' WHERE id = ".$user['id'];
	mysql_query($query) or die("Could not complete query: '$query': ".mysql_error());
}


/********* SPEAKERS **********/
$query = "SELECT id,bio FROM ".$db['prefix']."speakers WHERE 1=1";
$r = mysql_query($query) or die("Could not get list of Speakers.\n");
$users = array();
while($line = mysql_fetch_assoc($r)){
	$users[] = $line;
}

echo "Normalizing newlines in Speaker bios...\n";
foreach($users as $user){
	$bio = mysql_real_escape_string(str_replace("\r\n", "\n", $user['bio']));
	$query = "UPDATE ".$db['prefix']."speakers SET bio = '$bio' WHERE id = ".$user['id'];
	mysql_query($query) or die("Could not complete query: '$query': ".mysql_error());
}


/********* FAQs **********/
$query = "SELECT id,answer FROM ".$db['prefix']."faqs WHERE 1=1";
$r = mysql_query($query) or die("Could not get list of Users.\n");
$users = array();
while($line = mysql_fetch_assoc($r)){
	$users[] = $line;
}

echo "Normalizing newlines in FAQ answers...\n";
foreach($users as $user){
	$bio = mysql_real_escape_string(str_replace("\r\n", "\n", $user['answer']));
	$query = "UPDATE ".$db['prefix']."faqs SET answer = '$bio' WHERE id = ".$user['id'];
	mysql_query($query) or die("Could not complete query: '$query': ".mysql_error());
}

echo "Completed.\n";

	
?>