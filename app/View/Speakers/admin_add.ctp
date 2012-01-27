<div class="speakers form">
<?php echo $this->Form->create('Speaker');?>
	<fieldset>
		<legend><?php echo __('Admin Add Speaker'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Speakers'), array('action' => 'index'));?></li>
	</ul>
</div>
