<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('role', array(
			'value' => "student",
			'hiddenField' => true
        ));
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