<h2>Stay up-to-date with HEC's latest tweets!</h2>
<p>
	Follow <?php echo $this->Html->link('@HtlEzraCornell', 'https://twitter.com/HtlEzraCornell', array('target' => '_blank')); ?> for the latest.
</p>
<ul data-role="listview">
	<?php foreach($data as $tweet): ?>
	<li>
		<h3><?php echo implode(" ", array_splice(explode(" ", str_replace("HtlEzraCornell: ", "", $tweet['description'])), 0, 5)) . " . . . "; ?></h3>
		<p>
			<?php echo linkify(str_replace("HtlEzraCornell: ", "", $tweet['description'])); ?>
		</p>
		<p class="ui-li-aside">
			<?php echo date("F j, Y \a\\t g:i a", strtotime($tweet['pubDate'])); ?>
		</p>
	</li>
	<?php endforeach; ?>
</ul>