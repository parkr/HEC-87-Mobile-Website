<ul data-role="listview" data-filter="true" data-theme="a">
	<li data-role="list-divider" data-theme="c"><?php echo $todays_date; ?></li>
	<?php if($today && count($today) > 0): ?>
	<?php foreach ($today as $menu): ?>
	<li data-theme="a">
		<a href="<?php echo $this->Html->url(array('action' => 'view', $menu['Menu']['id'])); ?>">
			<h3><?php echo h($menu['Menu']['name']); ?>&nbsp;</h3>
			<p>
				<?php echo h('BOH FM: '.$menu['Menu']['boh_fm']); ?>
				<?php if($menu['Event'] && $menu['Event']['id']): ?>
					<?php echo '<br>' . __('To be served at ') . $this->Html->tag('strong', $menu['Event']['name']); ?>
				<?php endif; ?>
				
			</p>
			<p class="ui-li-aside">
				<strong>
					<?php echo h(date("g:i a", strtotime($menu['Menu']['date']))); ?> 
				</strong>
				in 
				<strong><?php echo h($menu['Menu']['location']); ?></strong>
			</p>
		</a>
	</li>
	<?php endforeach; ?>
	<?php else: ?>
	<li>No menus for this day.</li>
	<?php endif; ?>
</ul>
