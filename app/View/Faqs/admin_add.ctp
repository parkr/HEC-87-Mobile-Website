<div class="faqs form">
<?php echo $this->Form->create('Faq');?>
	<fieldset>
		<legend><?php echo __('Admin Add Faq'); ?></legend>
	<?php
		echo $this->Form->input('question');
		echo $this->Form->input('answer');
		echo $this->Form->input('order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Faqs'), array('action' => 'index'));?></li>
	</ul>
</div>
