<div id="sponsor_page">
	<h2><?php echo $sponsor['Sponsor']['name']; ?></h2>
	<p>
		<?php 
			echo $this->Html->image(
				$sponsor['Sponsor']['photo_url'], 
				array(
					'alt' => $sponsor['Sponsor']['name']."'s logo", 
					'url' => $sponsor['Sponsor']['website'],
					'target' => '_blank',
					'id' => 'logo'
				)
			); 
		?>
		<p id="details">
			<?php
				echo $this->Html->tag('div', nl2br($sponsor['Sponsor']['details']), array('class' => 'details'));
			?>
		</p>
	</p>
</div>