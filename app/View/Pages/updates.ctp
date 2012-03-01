<h2>Stay up-to-date with HEC's latest tweets!</h2>
<p>
	Follow <?php echo $this->Html->link('@HtlEzraCornell', 'https://twitter.com/HtlEzraCornell', array('target' => '_blank')); ?> for the latest.
</p>
<ul data-role="listview" id="tweetsList">
	<?php 
	foreach($data as $tweet){
		echo $this->Html->tag('li',
			$this->Html->tag('a',
				$this->Html->tag('h3', str_replace("HtlEzraCornell: ", "", $tweet['description'])).
				$this->Html->para(null, str_replace("HtlEzraCornell: ", "", $tweet['description'])).
				$this->Html->para('ui-li-aside', date("F j, Y \a\\t g:i a", strtotime($tweet['pubDate']))),
				array('href' => $tweet['link'], 'target' => "_blank")
			)
		);
	} 
	?>
</ul>