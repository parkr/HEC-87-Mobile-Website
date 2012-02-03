<?php 

echo $this->Html->tag('h2', h($event['Event']['name']));
echo $this->Html->tag('h3', date("l, F j, Y", strtotime($event['Event']['start_time'])));
echo $this->Html->tag('h3',
	date("g:i a", strtotime($event['Event']['start_time'])) . " &mdash; " . date("g:i a", strtotime($event['Event']['end_time']))
);
echo $this->Html->tag('h3', h($event['Event']['location']));

?>

<dl>
		<dt><?php echo __('Description'); ?></dt>
		<dd><?php echo h($event['Event']['description']); ?></dd>
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
		<dt><?php echo __('Photo'); ?></dt>
		<dd>
			<?php echo h($event['Event']['photo']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>