<?php echo $this->Form->create('User', array('type' => 'file'));?>
	<fieldset>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('email');
		echo $this->Form->input('name');
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
		echo $this->Form->input('show_contact_info');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
<?php echo $this->Html->link('View Profile', array('controller' => 'users', 'action' => 'view', AuthComponent::user('id')), array('data-role' => 'button', 'data-icon' => 'delete'));  ?>
<?php 
echo $this->Form->postLink(
	__('Delete'), 
	array('action' => 'delete', AuthComponent::user('id')), 
	array('data-role' => 'button', 'data-icon' => 'delete'),
	__('Are you sure you want to delete your account, %s?', $this->Form->value('User.name'))
); 
?>
