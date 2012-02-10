<ul data-role="listview" data-filter="true" data-theme="a">
	<li data-role="list-divider" data-theme="c">Saturday, April 14, 2012</li>
	<?php foreach ($today as $event): ?>
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
</ul>
