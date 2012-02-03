<?php $alias = 'User'; pr($people); ?>
<ul id="nodes" data-role="listview" data-inset="true" data-theme="a">
	<?php
		foreach($people as $person){
			echo $this->Html->tag('li', $this->Html->link($person[$alias]['name'], array('controller' => 'users', 'action' => 'view', $person[$alias]['id'])));
		}
	?>
</ul>
