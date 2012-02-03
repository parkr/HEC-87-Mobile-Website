<?php echo $this->Form->create('User', array('type' => 'file'));?>
	<fieldset>
	<?php
		echo $this->Form->input('role', array(
			'value' => "user",
			'type' => 'hidden'
        ));
		echo $this->Form->input('type', array(
			'value' => $type,
			'type' => 'hidden'
        ));
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('confirm_password');
		echo $this->Form->input('name');
		echo $this->Form->input('phone_number');
		echo $this->Form->input('graduation_year', array(
			'type' => 'text'
		));
		if($type != "student") { 
			echo $this->Form->input('company');
			echo $this->Form->input('position');
		}
		echo $this->Form->input('bio');
		echo $this->Form->input('show_contact_info');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>