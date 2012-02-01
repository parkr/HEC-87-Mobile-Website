<ul id="nodes" data-role="listview" data-inset="true" data-theme="a">
	<?php
		foreach($menus as $menu){
			echo $this->Html->tag('li', $this->Html->link($menu['Menu']['name'], array('controller' => 'menus', 'action' => 'view', $menu['Menu']['id'])));
		}
	?>
</ul>
