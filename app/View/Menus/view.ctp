<?php echo $this->Html->tag('h1', $menu['Menu']['name']); ?>
<?php echo $this->Html->tag('h2', $menu['Menu']['boh_fm']); ?>
<?php 
	if($menu['Event'] && $menu['Event']['id']):
		echo __('F&B Menu for ') . $this->Html->link($menu['Event']['name'], array('controller' => 'events', 'action' => 'view', $menu['Event']['id']));
	endif;
?>
<dl class="menu">
	<?php foreach($menu['FoodItem'] as $food): ?>
	<dt><?php echo $food['name']; ?></dt>
	<dd><?php echo $food['description']; ?></dd>
	<?php endforeach; ?>
</dl>