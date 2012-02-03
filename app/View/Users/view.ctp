<h2><?php  echo h($user['User']['name']);?></h2>
<dl>
	<?php if($user['User']['show_contact_info']): ?>
	<dt><?php echo __('Email'); ?></dt>
	<dd>
		<?php echo h($user['User']['email']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __('Phone Number'); ?></dt>
	<dd>
		<?php echo h($user['User']['phone_number']); ?>
		&nbsp;
	</dd>
	<?php endif; ?>
	<?php if($user['User']['graduation_year']): ?>
	<dt><?php echo __('Graduation Year'); ?></dt>
	<dd>
		<?php echo h($user['User']['graduation_year']); ?>
		&nbsp;
	</dd>
	<?php endif; ?>
	<dt><?php echo __('Company'); ?></dt>
	<dd>
		<?php echo h($user['User']['company']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __('Position'); ?></dt>
	<dd>
		<?php echo h($user['User']['position']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __('Bio'); ?></dt>
	<dd>
		<?php echo h($user['User']['bio']); ?>
		&nbsp;
	</dd>
	<dt><?php echo __('Joined'); ?></dt>
	<dd>
		<?php echo date("l, F j, Y", strtotime(h($user['User']['date_created']))); ?>
		&nbsp;
	</dd>
</dl>