<?php $alias = 'User'; ?>
<ul id="nodes" data-role="listview" data-inset="true" data-theme="a" data-filter="true">
	<?php
		foreach($people as $person){
			echo $this->Html->tag('li', 
				$this->Html->tag('a',
					$this->Html->tag('h3', (($sort_field == "name") ? $person[$alias]['name'] : $person[$alias]['position'])) .
					$this->Html->para(null, (($sort_field == "name") ? $person[$alias]['position'] : $person[$alias]['name'])),
					array('href' => $this->Html->url(array('controller' => 'users', 'action' => 'view', $person[$alias]['id'])))
				)
			);
		}
	?>
</ul>
