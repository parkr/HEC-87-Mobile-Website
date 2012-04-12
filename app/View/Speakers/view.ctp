<div id="speaker_page">
	<h2><?php echo $speaker['Speaker']['name']; ?></h2>
	<?php if($speaker['Speaker']['position'] != ""): ?>
		<?php echo $this->Html->tag('h4', $speaker['Speaker']['position'] . ', ' . $speaker['Speaker']['company']); ?>
	<?php endif; ?>
	<?php if($speaker['Event'] && $speaker['Event']['name']): ?>
		<?php echo $this->Html->tag('h4', 'Keynote Speaker: ' . $this->Html->link($speaker['Event']['name'], array('controller' => 'events', 'action' => 'view', $speaker['Event']['id']))); ?>
	<?php endif; ?>
	<p>
		<?php 
		if($speaker['Speaker']['photo']){
			echo $this->Html->image(
				$speaker['Speaker']['photo'],
				array(
					'alt' => $speaker['Speaker']['name']
				)
			);
		} 
		?>
		<?php if($speaker['Speaker']['bio']): ?>
		<p id="bio">
			<?php
				$bio = str_replace("\r\n", "\n\n", $speaker['Speaker']['bio']);
				$paras = explode("\n\n", $bio);
				foreach($paras as $para){
					echo $this->Html->para('bio', $para);
				}
			?>
		</p>
		<?php endif; ?>
	</p>
	
</div>