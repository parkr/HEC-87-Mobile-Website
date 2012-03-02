<?php $alias = 'User'; ?>
<ul id="nodes" data-role="listview" data-inset="true" data-theme="a" data-filter="true">
	<?php
		$indices = array(
			'prev' => '',
			'curr' => ''
		);
		foreach($people as $person){
			$indices['curr'] = strtolower(substr($person[$alias][$sort_field], 0, 1));
			if($indices['prev'] != $indices['curr']){
				echo $this->Html->tag('li', ucwords($indices['curr']), array('data-role' => 'list-divider', 'data-theme' => 'c'));
				$indices['prev'] = $indices['curr'];
			}
			echo $this->Html->tag('li', 
				$this->Html->tag('a',
					$this->Html->tag('h3', 
						(($sort_field == "first_name") 
							? $person[$alias]['name'] 
							: (
								($sort_field == "last_name") 
									? $person[$alias]['formal_name'] 
									: $person[$alias]['position']
								)
						)
					) .
					$this->Html->para(null, (($sort_field == "first_name" || $sort_field == "last_name") ? $person[$alias]['position'] : $person[$alias]['name'])),
					array('href' => $this->Html->url(array('controller' => 'users', 'action' => 'view', $person[$alias]['id'])))
				)
			);
		}
	?>
</ul>
