<div class="events view">
<h2><?php  echo __('Event Details');?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($event['Event']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($event['Event']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h(date("l, g:i a", strtotime($event['Event']['start_time']))); ?> &mdash; <?php echo h(date("l, g:i a", strtotime($event['Event']['end_time']))); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($event['Event']['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo'); ?></dt>
		<dd>
			<?php echo h($event['Event']['photo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Menus'); ?></dt>
		<dd>
			<?php foreach($event['Menu'] as $menu): ?>
			<?php echo $this->Html->link($menu['name'], array('controller' => 'menus', 'action' => 'view', $menu['id'])); ?><br>
			<?php endforeach; ?>
			&nbsp;
		</dd>
		
	</dl>
</div>