<ul data-role="listview" data-filter="true" data-inset="true">
	<?php foreach($speakers as $speaker): ?>
	<li>
		<?php echo $this->Html->link($speaker['Speaker']['first_name'] ." ". $speaker['Speaker']['last_name'], array('controller' => 'speakers', 'action' => 'view', $speaker['Speaker']['id'])); ?>
	</li>
	<?php endforeach; ?>
</ul>
