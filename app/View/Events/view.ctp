<?php 

echo $this->Html->tag('h2', h($event['Event']['name']));
echo $this->Html->tag('h3', 
	date("l, F j, Y", strtotime($event['Event']['start_time'])) . ', ' .
	date("g:i a", strtotime($event['Event']['start_time'])) . " &mdash; " . date("g:i a", strtotime($event['Event']['end_time']))
);
echo $this->Html->tag('h3', h($event['Event']['location']));
?>

<?php if($event['Event']['photo']): ?>
	<?php echo $this->Html->tag('div', $this->Html->image($event['Event']['photo'], array('class' => 'event_photo')), array('class' => 'event')); ?>
<?php endif; ?>


<dl>
	<?php if($event['Event']['description']): ?>
	<dt><?php echo __('Description'); ?></dt>
	<dd><?php echo h($event['Event']['description']); ?></dd>
	<?php endif; ?>
	<?php if($event['Menu']): ?>
	<dt><?php echo __('Menus'); ?></dt>
	<dd>
		<?php
			$output = array();
			foreach($event['Menu'] as $menu){
				$output[] = $this->Html->link($menu['name'], array('controller' => 'menus', 'action' => 'view', $menu['id']));
			}
			for($i=0; $i<count($output); $i++){
				echo $output[$i];
				if($i < count($output)-1){ echo '<br>'; }
			}
				
		?>
	</dd>
	<?php endif; ?>
</dl>