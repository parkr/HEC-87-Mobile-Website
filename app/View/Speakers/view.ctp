<div id="speaker_page">
	<h2><?php echo $speaker['Speaker']['first_name'] .' '. $speaker['Speaker']['last_name']; ?></h2>
	<?php if($speaker['Speaker']['position'] != ""): ?>
		<h4><?php echo $speaker['Speaker']['position']; ?>, <?php echo $speaker['Speaker']['company']; ?></h4>
	<?php endif; ?>
	<p>
		<?php 
			echo $this->Html->image(
				$speaker['Speaker']['photo'],
				array(
					'width' => '300'
				)
			); 
		?>
		<p id="bio">
			<?php
				$paras = explode("\n\n", $speaker['Speaker']['bio']);
				foreach($paras as $para){
					echo $this->Html->para('bio', $para);
				}
			?>
		</p>
	</p>
	
</div>