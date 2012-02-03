<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Admin Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('role');
		echo $this->Form->input('type');
		echo $this->Form->input('name');
		echo $this->Form->input('password');
		echo $this->Form->input('show_contact_info');
		echo $this->Form->input('email');
		echo $this->Form->input('phone_number');
		echo $this->Form->input('graduation_year');
		echo $this->Form->input('company');
		echo $this->Form->input('position');
		echo $this->Form->input('bio');
		echo $this->Form->input('picture');
		echo $this->Form->input('date_created');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index'));?></li>
	</ul>
</div>
