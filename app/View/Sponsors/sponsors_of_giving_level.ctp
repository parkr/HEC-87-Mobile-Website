<?php

	$sponsors_links = array();
	foreach($sponsors as $sponsor){
		$sponsors_links[] = $this->Html->link($sponsor['Sponsor']['name'], array('controller' => 'sponsors', 'action' => 'view', $sponsor['Sponsor']['id']));
	}
	
	if(count($sponsors_links) == 0){
		echo $this->Html->tag('h3', "There are no sponsors at this time.");
	}else{
		echo $this->Html->nestedList($sponsors_links, array(
			'data-role' => 'listview',
			'id' => 'nodes',
			'data-inset' => 'true',
			'data-theme' => 'a'
		));
	}

?>
