<?php

	$giving_links = array();
	foreach($givingLevels as $givingLevel){
		$giving_links[] = $this->Html->link(ucwords($givingLevel), array('controller' => 'sponsors', 'action' => $givingLevel));
	}
	
	if(count($giving_links) == 0){
		echo "There are no sponsors at this time.";
	}else{
		echo $this->Html->nestedList($giving_links, array(
			'data-role' => 'listview',
			'id' => 'nodes',
			'data-inset' => 'true',
			'data-theme' => 'a'
		));
	}

?>
