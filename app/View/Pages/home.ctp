<ul id="nodes" data-role="listview" data-inset="true" data-filter="true" data-theme="a">
	<li><?php echo $this->Html->link('Program', array('controller' => 'events')); ?></li>
	<li><?php echo $this->Html->link('Speakers', '/speakers'); ?></li>
	<li><?php echo $this->Html->link('F&B', array('controller' => 'menus')); ?></li>
	<li><?php echo $this->Html->link('Directory', array('controller' => 'users')); ?></li>
	<li><?php echo $this->Html->link('Updates', array('controller' => 'pages', 'action' => 'updates')); ?></li>
	<li><?php echo $this->Html->link('Maps', array('controller' => 'pages', 'action' => 'maps')); ?></li>
	<li><?php echo $this->Html->link('Sponsors', array('controller' => 'sponsors')); ?></li>
	<li><?php echo $this->Html->link('Feedback', array('controller' => 'pages', 'action' => 'feedback')); ?></li>
	<li><?php echo $this->Html->link('FAQs', array('controller' => 'faqs')); ?></li>
</ul>