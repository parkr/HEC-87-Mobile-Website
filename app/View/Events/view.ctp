<?php 

echo $this->Html->tag('h2', h($event['Event']['name']));
echo $this->Html->tag('h3', date("l, F j, Y", strtotime($event['Event']['start_time'])));
echo $this->Html->tag('h4', date("g:i a", strtotime($event['Event']['start_time'])) . " &mdash; " . date("g:i a", strtotime($event['Event']['end_time'])));
echo $this->Html->tag('h3', h($event['Event']['location']));
?>

<?php if(AuthComponent::user('id')): ?>
<a href="#" data-direction="reverse" class="ui-btn-left ui-btn ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-a" data-theme="a" id="check_in_button">
	<span class="ui-btn-inner ui-btn-corner-all">
		<span class="ui-btn-text">Check In</span>
	</span>
</a>
<?php endif; ?>

<?php if($event['Event']['photo']): ?>
	<?php echo $this->Html->tag('div', $this->Html->image($event['Event']['photo'], array('class' => 'event_photo')), array('class' => 'event')); ?>
<?php endif; ?>

<dl>
	<?php if($event['Event']['description']): ?>
	<dt><?php echo __('Description'); ?></dt>
	<dd><?php echo h($event['Event']['description']); ?></dd>
	<?php endif; ?>
	<?php if($event['Speaker']): ?>
	<dt><?php echo __('Speakers'); ?></dt>
	<dd>
		<?php
			$output = array();
			foreach($event['Speaker'] as $sp){
				$output[] = $this->Html->link($sp['name'], array('controller' => 'speakers', 'action' => 'view', $sp['id'])) .
					', ' . $sp['position'] . ', ' . $sp['company'];
			}
			for($i=0; $i<count($output); $i++){
				echo $output[$i];
				if($i < count($output)-1){ echo '<br>'; }
			}
				
		?>
	</dd>
	<?php endif; ?>
	<?php if($event['Menu']): ?>
	<dt><?php echo __('F&B Menus'); ?></dt>
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
	<?php if($event['User']): ?>
		<dt><?php echo __('Student Volunteers'); ?></dt>
	<dd>
		<?php
			$output = array();
			foreach($event['User'] as $users){
				$output[] = $this->Html->link($users['name'], array('controller' => 'users', 'action' => 'view', $users['id']));
			}
			for($i=0; $i<count($output); $i++){
				echo $output[$i];
				if($i < count($output)-1){ echo '<br>'; }
			}
				
		?>
	</dd>
	<?php endif; ?>
</dl>