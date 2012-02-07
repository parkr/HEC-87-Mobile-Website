<?php
App::uses('AppController', 'Controller');
/**
 * Sponsors Controller
 *
 * @property Sponsor $Sponsor
 */
class SponsorsController extends AppController {
	public $runningPageTitle = "Sponsors";
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('view');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout', $this->runningPageTitle);
		$this->set('sponsors', $this->Sponsor->find('all', array('order' => 'Sponsor.name ASC')));
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
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
		$this->set('title_for_layout', $sponsor['Sponsor']['name'] . $this->runningPageTitle);
		$this->set('prevpage_for_layout', array('title' => ucwords($this->params['controller']), 'routing' => array('controller' => $this->params['controller'], 'action' => 'index')));
	}

}
