<?php
	$i = 0;
	foreach ($faqs as $faq): ?>
	<div data-role="collapsible">
		<h4><?php echo h($faq['Faq']['question']); ?>&nbsp;</h4>
		<p>
			<em><?php echo h($faq['Faq']['question']); ?></em>
		</p>
		<p>
			<?php echo nl2br($faq['Faq']['answer']); ?>&nbsp;
		</p>
	</div>
<?php endforeach; ?>