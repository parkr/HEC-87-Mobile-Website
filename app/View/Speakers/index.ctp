<ul data-role="listview" data-filter="true" data-inset="true">
<?php 
	foreach($speakers as $speaker){
		echo $this->Html->tag('li',
			$this->Html->tag('a',
				$this->Html->tag('h3', $speaker['Speaker']['name']).
				$this->Html->para(null,
					(($speaker['Speaker']['position'] != "") ? $speaker['Speaker']['position'].", " : "") . $speaker['Speaker']['company']
				),
				array('href' => $this->Html->url(array('controller' => 'speakers', 'action' => 'view', $speaker['Speaker']['id'])))
			)
		);
	
	
	} 	
?>
</ul>
