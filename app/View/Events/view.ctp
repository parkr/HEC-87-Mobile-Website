<?php 

echo $this->Html->tag('h2', h($event['Event']['name']));
echo $this->Html->tag('h3', date("l, F j, Y", strtotime($event['Event']['start_time'])));
echo $this->Html->tag('h3',
	date("g:i a", strtotime($event['Event']['start_time'])) . " &mdash; " . date("g:i a", strtotime($event['Event']['end_time']))
);
echo $this->Html->tag('h3', h($event['Event']['location']));

?>

<dl>
		<dt><?php echo __('Description'); ?></dt>
		<dd><?php echo h($event['Event']['description']); ?></dd>
		<dt><?php echo __('Menus'); ?></dt>
		<dd>
			<?php foreach($event['Menu'] as $menu): ?>
			<?php echo $this->Html->link($menu['name'], array('controller' => 'menus', 'action' => 'view', $menu['id'])); ?><br>
			<?php endforeach; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo'); ?></dt>
		<dd>
			<?php echo h($event['Event']['photo']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>