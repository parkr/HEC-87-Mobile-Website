<div class="speakers view">
<h2><?php  echo __('Speaker');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($speaker['Speaker']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($speaker['Speaker']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Speaker'), array('action' => 'edit', $speaker['Speaker']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Speaker'), array('action' => 'delete', $speaker['Speaker']['id']), null, __('Are you sure you want to delete # %s?', $speaker['Speaker']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Speakers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speaker'), array('action' => 'add')); ?> </li>
	</ul>
</div>
