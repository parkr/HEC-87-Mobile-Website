<div class="thoughts view">
<h2><?php  echo __('Thought');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($thought['Thought']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event'); ?></dt>
		<dd>
			<?php echo $this->Html->link($thought['Event']['name'], array('controller' => 'events', 'action' => 'view', $thought['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($thought['User']['name'], array('controller' => 'users', 'action' => 'view', $thought['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Event Type'); ?></dt>
		<dd>
			<?php echo h($thought['Thought']['event_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question 1'); ?></dt>
		<dd>
			<?php echo h($thought['Thought']['question_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question 2'); ?></dt>
		<dd>
			<?php echo h($thought['Thought']['question_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question 3'); ?></dt>
		<dd>
			<?php echo h($thought['Thought']['question_3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question 4'); ?></dt>
		<dd>
			<?php echo h($thought['Thought']['question_4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question 5'); ?></dt>
		<dd>
			<?php echo h($thought['Thought']['question_5']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($thought['Thought']['comments']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Thought'), array('action' => 'edit', $thought['Thought']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Thought'), array('action' => 'delete', $thought['Thought']['id']), null, __('Are you sure you want to delete # %s?', $thought['Thought']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Thoughts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Thought'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
