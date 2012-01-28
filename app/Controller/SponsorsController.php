<?php
App::uses('AppController', 'Controller');
/**
 * Sponsors Controller
 *
 * @property Sponsor $Sponsor
 */
class SponsorsController extends AppController {
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
		$this->set('sponsors', $this->Sponsor->find('all', array('order' => 'Sponsor.name ASC')));
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
		$this->set('sponsor', $this->Sponsor->read(null, $id));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Sponsor->recursive = 0;
		$this->set('sponsors', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		$this->set('sponsor', $this->Sponsor->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Sponsor->create();
			if ($this->Sponsor->save($this->request->data)) {
				$this->Session->setFlash(__('The sponsor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sponsor could not be saved. Please, try again.'));
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
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sponsor->save($this->request->data)) {
				$this->Session->setFlash(__('The sponsor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sponsor could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Sponsor->read(null, $id);
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
		$this->Sponsor->id = $id;
		if (!$this->Sponsor->exists()) {
			throw new NotFoundException(__('Invalid sponsor'));
		}
		if ($this->Sponsor->delete()) {
			$this->Session->setFlash(__('Sponsor deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Sponsor was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
