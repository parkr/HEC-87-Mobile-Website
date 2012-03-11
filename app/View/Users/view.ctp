<div id="profile">
<h2>
<?php
	echo h($user['User']['name']);
	echo ($user['User']['graduation_year']) ? " '".date('y', mktime(0, 0, 0, 5, 27, $user['User']['graduation_year'])) : "";
?>
</h2>
<h4>
	<?php
		echo '<em>';
		echo ($user['User']['position'] != "") ? h($user['User']['position']).", " : "";
		echo ($user['User']['company'] != "") ? h($user['User']['company']) : "";
		echo '</em>';
	?>
</h4>
<?php
	if($user['User']['photo'] != ""){
		echo $this->Html->image($user['User']['photo'], array('alt' => $user['User']['name'], 'class' => 'photo'));
	}
?>
<dl>
	<?php if($user['User']['show_contact_info']): ?>
		<?php if($user['User']['email']): ?>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo $this->Html->link(h($user['User']['email']), 'mailto:'.$user['User']['email']); ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<?php if($user['User']['phone_number']): ?>
		<dt><?php echo __('Phone Number'); ?></dt>
		<dd>
			<?php echo $this->Html->link(h($user['User']['phone_number']), 'tel:'.$user['User']['phone_number']); ?>
			&nbsp;
		</dd>
		<?php endif; ?>
	<?php endif; ?>
	<?php if($user['CheckIn']): ?>
		<dt><?php echo __('Check-Ins'); ?></dt>
		<dd>
		<?php foreach($user['CheckIn'] as $check_in): ?>
			<?php
				echo $this->Html->tag('div',
					(
						$this->Html->tag('span', $check_in['Event']['name'], array('class' => 'event_name')) . 
						$this->Html->tag('span', 'on ' . date('l, F d, Y \a\t g:ia', strtotime($check_in['datetime'])), array('class' => 'datetime'))
					),
					array('class' => 'user_check_in')
				);
			?>
		<?php endforeach; ?>
		<dd>
	<?php endif; ?>
	<?php if($user['User']['bio']): ?>
	<dt><?php echo __('Bio'); ?></dt>
	<dd>
		<?php echo linkify(nl2br($user['User']['bio'])); ?>
		&nbsp;
	</dd>
	<?php endif; ?>
</dl>

<?php echo $this->Html->tag('div', __('Member since') . ' ' . date("l, F j, Y", strtotime(h($user['User']['date_created']))) , array('class' => 'details')); ?>

<?php

if($user['User']['id'] == AuthComponent::user('id')){
	echo $this->Html->link('Edit Profile', array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array('data-role' => 'button'));
}
	
?>
</div>