<ul data-role="listview" data-inset="true" data-theme="a">
<?php foreach($days as $day => $routing): ?>
	<li data-theme="a">
		<?php echo $this->Html->link($day, $routing); ?>
	</li>
<?php endforeach;?>
</ul>
