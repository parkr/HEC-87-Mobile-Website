Looking for something to do during your downtime? Maps with information are below!

<ul id="nodes" data-role="listview" data-inset="true" data-theme="a">
	<?php
		foreach($maps as $map){
			echo $this->Html->tag('li', $this->Html->link($map['Map']['name'], (($map['Map']['url'] != "") ? $map['Map']['url'] : "#"), array("target" => "_blank")));
		}
	?>
</ul>