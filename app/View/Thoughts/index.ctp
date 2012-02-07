<ul data-role="listview" data-filter="true" data-inset="true">
	<?php foreach($thoughts as $thought): ?>
	<li>
		<?php echo $this->Html->link($thought['Thought']['name'], $thought['Thought']['link']); ?>
	</li>
	<?php endforeach; ?>
</ul>
