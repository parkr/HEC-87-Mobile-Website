<ul id="nodes" data-role="listview" data-inset="true" data-theme="a">
	<?php
		foreach($account_types as $type){
			echo $this->Html->tag('li', $this->Html->link(ucwords($type), array('controller' => 'users', 'action' => Inflector::pluralize($type))));
		}
	?>
</ul>
