<div class="foodItems form">
<?php echo $this->Form->create('FoodItem');?>
	<fieldset>
		<legend><?php echo __('Add Food Item'); ?></legend>
	<?php
		echo $this->Form->input('menu_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Food Items'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menus'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
