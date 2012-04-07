<div id="menu_titles">
<?php echo $this->Html->tag('h1', $menu['Menu']['name']); ?>
<?php echo $this->Html->tag('h2', $menu['Menu']['boh_fm']); ?>
<?php 
	if($menu['Event'] && $menu['Event']['id']):
		echo __('F&B Menu for ') . $this->Html->link($menu['Event']['name'], array('controller' => 'events', 'action' => 'view', $menu['Event']['id']));
	endif;
?>
</div>
<dl class="menu">
	<?php foreach($menu['FoodItem'] as $food): ?>
	<dt><?php echo $food['name']; ?></dt>
	<dd><?php echo $food['description']; ?></dd>
	<?php endforeach; ?>
</dl>
<?php if(isset($menu['Menu']['photo']) && $menu['Menu']['photo'] != ""): ?>
<dl class="team_photo">
	<dt>Team</dt>
	<dd>
		<?php 
			echo $this->Html->image($menu['Menu']['photo']); 
			if($menu['Menu']['photo_caption'] && $menu['Menu']['photo_caption'] != ""){
				echo $this->Html->tag('div', $menu['Menu']['photo_caption'], array('class' => 'caption'));
			}
		?>
	</dd>
</dl>
<?php endif; ?>