<?php
echo '<ul data-role="listview" data-inset="true" data-theme="a" data-filter="true">';
$links = array();
$today = NULL;
foreach($events as $event){
	if($today != date('l', strtotime($event['Event']['start_time']))){
		echo '<li data-role="list-divider" data-theme="c">'.date('l, F d', strtotime($event['Event']['start_time'])).'</li>';
		$today = date('l', strtotime($event['Event']['start_time']));
	}
	echo $this->Html->tag('li', $this->Html->link($event['Event']['name'], array('action' => 'add', $event['Event']['id'])));
}
echo '</ul>';
?>

