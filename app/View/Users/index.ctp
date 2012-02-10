<ul id="nodes" data-role="listview" data-inset="true" data-theme="a">
	<?php
		foreach($account_types as $name => $routing){
			echo $this->Html->tag('li', $this->Html->link($name, $routing));
		}
	?>
</ul>
