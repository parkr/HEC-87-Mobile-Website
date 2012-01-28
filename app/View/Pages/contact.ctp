<ul id="nodes" data-role="listview" data-inset="true" data-theme="a" data-filter="false">
	
	<li data-role="list-divider">Go "old-fashioned":</li>
	<li><a href="mailto:hec@cornell.edu">hec@cornell.edu</a></li>
	<li><a href="tel:+16072553824">+1 (607) 255-3824</a></li>
	
	<li data-role="list-divider">We're social!</li>
	<?php
	
	$social = array(
		'Facebook' => 'http://www.facebook.com/HotelEzraCornell',
		'Twitter' => 'http://twitter.com/HtlEzraCornell',
		'Flickr' => 'http://www.flickr.com/photos/hec87/',
		'YouTube' => 'http://www.youtube.com/results?search_query=hotel+ezra+cornell&oq=hotel+ezra+cornell'
	);
	
	foreach($social as $name => $url){
		echo $this->Html->tag('li', $this->Html->link($name, $url, array('target' => "_blank"))) ."\n\t";
	}
	
	?>
</ul>
