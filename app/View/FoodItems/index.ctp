<div class="foodItems index">
	<h2><?php echo __('Food Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('menu_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($foodItems as $foodItem): ?>
	<tr>
		<td><?php echo h($foodItem['FoodItem']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($foodItem['Menus']['name'], array('controller' => 'menus', 'action' => 'view', $foodItem['Menus']['id'])); ?>
		</td>
		<td><?php echo h($foodItem['FoodItem']['name']); ?>&nbsp;</td>
		<td><?php echo h($foodItem['FoodItem']['description']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $foodItem['FoodItem']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $foodItem['FoodItem']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $foodItem['FoodItem']['id']), null, __('Are you sure you want to delete # %s?', $foodItem['FoodItem']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Food Item'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menus'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
