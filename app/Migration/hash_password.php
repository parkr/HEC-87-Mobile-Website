<?php

$password = ($argv[0] == basename(__FILE__)) ? $argv[1] : $argv[0];
require_once(dirname(__FILE__)."/../../index.php");
$hashed = AuthComponent::password($password);
echo $hashed."\n";
?>