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
		$this->set('title_for_layout', $speaker['Speaker']['name']." &mdash; Speakers");
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Speaker->recursive = 0;
		$this->set('speakers', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Speaker->id = $id;
		if (!$this->Speaker->exists()) {
			throw new NotFoundException(__('Invalid speaker'));
		}
		$this->set('speaker', $this->Speaker->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Speaker->create();
			if ($this->Speaker->save($this->request->data)) {
				$this->Session->setFlash(__('The speaker has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The speaker could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Speaker->id = $id;
		if (!$this->Speaker->exists()) {
			throw new NotFoundException(__('Invalid speaker'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Speaker->save($this->request->data)) {
				$this->Session->setFlash(__('The speaker has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The speaker could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Speaker->read(null, $id);
		}
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Speaker->id = $id;
		if (!$this->Speaker->exists()) {
			throw new NotFoundException(__('Invalid speaker'));
		}
		if ($this->Speaker->delete()) {
			$this->Session->setFlash(__('Speaker deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Speaker was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
