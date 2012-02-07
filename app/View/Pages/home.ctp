<?php
$links = array(
	$this->Html->link('Program', array('controller' => 'events'), array('data-prefetch' => 'true')),
	$this->Html->link('Speakers', '/speakers', array('data-prefetch' => 'true')),
	$this->Html->link('Menus', array('controller' => 'menus'), array('data-prefetch' => 'true')),
	$this->Html->link('Profiles', array('controller' => 'users'), array('data-prefetch' => 'true')),
	$this->Html->link('Updates', array('controller' => 'pages', 'action' => 'updates'), array('data-prefetch' => 'true')),
	$this->Html->link('Maps', array('controller' => 'maps'), array('data-prefetch' => 'true')),
	$this->Html->link('Sponsors', array('controller' => 'sponsors'), array('data-prefetch' => 'true')),
	$this->Html->link('Feedback', array('controller' => 'pages', 'action' => 'feedback'), array('data-prefetch' => 'true')),
	$this->Html->link('FAQs', array('controller' => 'faqs'), array('data-prefetch' => 'true'))
);
if(AuthComponent::user('id') > 0){
	$links[] = $this->Html->link('Account', array('controller' => 'users', 'action' => 'edit', AuthComponent::user('id')), array('data-icon' => 'gear'));
}
echo $this->Html->nestedList($links, array(
	'data-role' => 'listview',
	'id' => 'nodes',
	'data-inset' => 'true',
	'data-theme' => 'a'
));
?>