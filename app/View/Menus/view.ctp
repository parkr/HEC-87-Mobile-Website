<?php echo $this->Html->tag('h1', $menu['Menu']['name']); ?>
<?php echo $this->Html->tag('h2', $menu['Menu']['boh_fm']); ?>

<dl class="menu">
	<?php foreach($menu['FoodItem'] as $food): ?>
	<dt><?php echo $food['name']; ?></dt>
	<dd><?php echo $food['description']; ?></dd>
	<?php endforeach; ?>
</dl>