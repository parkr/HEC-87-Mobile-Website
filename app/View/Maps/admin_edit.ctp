<div class="maps form">
<?php echo $this->Form->create('Map');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Map'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('order');
		echo $this->Form->input('name');
		echo $this->Form->input('url');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Map.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Map.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Maps'), array('action' => 'index'));?></li>
	</ul>
</div>
