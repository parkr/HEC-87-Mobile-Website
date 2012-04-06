<?php
$links = array();
foreach($events as $event){
	$links[] = $this->Html->link($event['Event']['name'], array('action' => 'add', $event['Event']['id']));
}
echo $this->Html->nestedList($links, array(
	'data-role' => 'listview',
	'id' => 'nodes',
	'data-inset' => 'true',
	'data-theme' => 'a',
	'data-filter' => 'true'
));
?>

