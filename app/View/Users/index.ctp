<ul id="nodes" data-role="listview" data-inset="true" data-theme="a">
	<?php
		foreach($account_types as $account_type => $routing_arr){
			echo $this->Html->tag('li', ucwords($account_type), array('data-role' => 'list-divider', 'data-theme' => 'c'));
			foreach($routing_arr as $name => $routing){
				echo $this->Html->tag('li', $this->Html->link($name, $routing));
			}
		}
	?>
</ul>
