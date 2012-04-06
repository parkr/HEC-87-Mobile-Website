<div class="thoughts form">
<?php echo $this->Form->create('Thought');?>
	<fieldset>
		<legend><?php echo __('Submit Feedback for \''.$event['Event']['name']."'"); ?></legend>
	<?php
		echo $this->Form->input('event_id', array('type' => 'hidden', 'value' => $event['Event']['id']));
		echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => (AuthComponent::user('id') > 0) ? AuthComponent::user('id') : 0));
		for($i=0; $i<count($questions[$event['Event']['event_type']]); $i++){
			echo $this->Form->input('question_'.$i, 
				array(
					'label' => $questions[$event['Event']['event_type']][$i],
					'type' => 'select', 
					'options' => $options
				)
			);
		}
		echo $this->Form->input('comments');
		if(!AuthComponent::user('id')){
			echo $this->Html->tag('h4', __('Sign in or input your name and email:'), array('class' => 'input'));
			echo $this->Form->input('name');
			echo $this->Form->input('email');
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>