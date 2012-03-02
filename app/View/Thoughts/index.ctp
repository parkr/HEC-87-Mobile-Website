<?php
if($thoughts && count($thoughts) > 0){
	foreach($thoughts as $thought){
		echo $this->Html->tag('li', 
			$this->Html->tag('a',
				$this->Html->tag('h3', 
					$thought['Event']['name'],
					array('href' => $this->Html->url(array('controller' => 'thoughts', 'action' => 'add', $thought['Thought']['id'])))
				)
			)
		);
	}
}else{
	echo $this->Html->tag('h3', 'No feedback forms available at this time.');
}
?>