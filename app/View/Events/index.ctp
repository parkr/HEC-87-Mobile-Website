<?php
	
$days = array(
	array(
		"date" => "Thursday, April 12, 2012",
		"events" => $thursday
	),
	array(
		"date" => "Friday, April 13, 2012",
		"events" => $friday
	),
	array(
		"date" => "Saturday, April 14, 2012",
		"events" => $saturday
	),
);
	
?>
<ul data-role="listview" data-filter="true" data-theme="a">
<?php foreach($days as $day): ?>
	<li data-role="list-divider" data-theme="c"><?php echo $day['date']; ?></li>
	<?php foreach ($day['events'] as $event): ?>
	<li data-theme="a">
		<a href="<?php echo $this->Html->url(array('action' => 'view', $event['Event']['id'])); ?>">
			<h3><?php echo h($event['Event']['name']); ?>&nbsp;</h3>
			<p>
				<?php echo h($event['Event']['description']); ?>&nbsp;
			</p>
			<p class="ui-li-aside">
				<strong>
					<?php echo h(date("g:i a", strtotime($event['Event']['start_time']))); ?> 
					&mdash; 
					<?php echo h(date("g:i a", strtotime($event['Event']['end_time']))); ?>
				</strong>
				in 
				<strong><?php echo h($event['Event']['location']); ?></strong>
			</p>
		</a>
	</li>
	<?php endforeach; ?>
<?php endforeach;?>
</ul>
