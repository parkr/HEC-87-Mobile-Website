<?php echo $this->Form->create('User', array('type' => 'file'));?>
	<fieldset>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('email');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('phone_number');
		echo $this->Html->tag('div', 'Ex: 555 123 4567', array('class' => 'details'));
		echo $this->Form->input('graduation_year', array(
			'type' => 'text'
		));
		if($type != "student") { 
			echo $this->Form->input('company');
		}
		echo $this->Form->input('position');
		echo $this->Form->input('bio');
		
		echo '<div class="form_photo">';
		if($this->Form->data['User']['photo'] != ""){
			echo $this->Html->image($this->Form->data['User']['photo'], array('alt' => $this->Form->data['User']['name'], 'class' => 'photo'));
		}else{
			$this->Html->tag('div', 'No photo chosen.', array('class' => 'details'));
		}
		echo $this->Form->input('photo', array('type' => 'hidden'));
		echo $this->Form->input('picture', array('type' => 'file'));
		echo '</div>';
		
		echo $this->Form->input('show_contact_info', array(
			'label' => 'Show Phone # and Email'
		));
		echo $this->Html->tag('div', 'If you enable this, your phone number and email address will be available to HEC-affiliated students and attendees when they are logged in.', array('class' => 'details'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label' => __('Submit'), 'data-icon' => 'check', 'data-theme' => 'g'));?>
<?php echo $this->Html->link('View Profile', array('controller' => 'users', 'action' => 'view', AuthComponent::user('id')), array('data-role' => 'button', 'data-icon' => 'forward'));  ?>
<?php 
echo $this->Form->postLink(
	__('Delete'), 
	array('action' => 'delete', AuthComponent::user('id')), 
	array('data-role' => 'button', 'data-icon' => 'delete', 'data-theme' => 'r'),
	__('Are you sure you want to delete your account, %s?', $this->Form->value('User.name'))
); 
?>
