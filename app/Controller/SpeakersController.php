<?php
App::uses('AppController', 'Controller');
/**
 * Speakers Controller
 *
 * @property Speaker $Speaker
 */
class SpeakersController extends AppController {
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
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		$this->set('speakers', $this->Speaker->find('all', array('order' => 'Speaker.last_name')));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Speaker->id = $id;
		if (!$this->Speaker->exists()) {
			throw new NotFoundException(__('Speaker not found.'));
		}
		$speaker = $this->Speaker->read(null, $id);
		$speaker['Speaker']['name'] = $this->Speaker->formattedName($speaker);
		$this->set('speaker', $speaker);
		$this->set('title_for_layout', $speaker['Speaker']['name']);
		$this->set('prevpage_for_layout', array('title' => ucwords($this->params['controller']), 'routing' => array('controller' => $this->params['controller'], 'action' => 'index')));
	}

}
