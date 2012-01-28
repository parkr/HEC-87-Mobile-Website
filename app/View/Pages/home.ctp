<?php
$links = array(
	$this->Html->link('Program', array('controller' => 'events')),
	$this->Html->link('Speakers', '/speakers'),
	$this->Html->link('F&B', array('controller' => 'menus')),
	$this->Html->link('Directory', array('controller' => 'users')),
	$this->Html->link('Updates', array('controller' => 'pages', 'action' => 'updates')),
	$this->Html->link('Maps', array('controller' => 'maps')),
	$this->Html->link('Sponsors', array('controller' => 'sponsors')),
	$this->Html->link('Feedback', array('controller' => 'pages', 'action' => 'feedback')),
	$this->Html->link('FAQs', array('controller' => 'faqs'))
);
echo $this->Html->nestedList($links, array(
	'data-role' => 'listview',
	'id' => 'nodes',
	'data-inset' => 'true',
	'data-theme' => 'a'
));
?>