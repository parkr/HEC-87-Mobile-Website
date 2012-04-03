<?php
App::uses('AppController', 'Controller');
/**
 * Sponsors Controller
 *
 * @property Sponsor $Sponsor
 */
class SponsorsController extends AppController {
	public $runningPageTitle = "Sponsors";
	public $givingLevels = array('platinum', 'gold', 'silver', 'bronze', 'friends');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('view', 'sponsorsOfGivingLevel');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set(array(
			'title_for_layout' => $this->runningPageTitle,
			'givingLevels' => $this->givingLevels,
			'prevpage_for_layout' => array('title' => "Home", 'routing' => '/')
		));
	}
	
	public function sponsorsOfGivingLevel($givingLevel){
		$this->set(array(
			'title_for_layout' => ucwords($givingLevel),
			'sponsors' => $this->Sponsor->find(
				'all', 
				array(
					'conditions' => array('Sponsor.giving_level' => strtolower($givingLevel)),
					'order' => 'Sponsor.name ASC'
				)
			),
			'prevpage_for_layout' => array('title' => "Sponsors", 'routing' => array("controller" => 'sponsors', 'action' => 'index'))
		));
		
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		$sponsor = $this->Sponsor->read(null, $id);
		$this->set('sponsor', $sponsor);
		$this->set('title_for_layout', $sponsor['Sponsor']['name']);
		$this->set('prevpage_for_layout', array(
				'title' => ucwords($sponsor['Sponsor']['giving_level']), 
				'routing' => array('controller' => $this->params['controller'], 'action' => $sponsor['Sponsor']['giving_level'])
			)
		);
	}

}
