<?php
App::uses('AppController', 'Controller');
/**
 * Maps Controller
 *
 * @property Map $Map
 */
class MapsController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('statler', 'sha', 'cornell', 'collegetown', 'ithaca');
	}
	
	public $name = "Maps";
	
	public function index(){
		$this->set("title_for_layout", $this->name);
		$this->set("maps", $this->Map->find('all', array('order' => 'Map.order ASC')));
	}
	public function statler(){
		$this->set("title_for_layout", $this->_makeTitle("The Statler Hotel"));
	}
	public function sha(){
		$this->set("title_for_layout", $this->_makeTitle("The School of Hotel Administration"));
	}
	public function collegetown(){
		$this->set("title_for_layout", $this->_makeTitle("Collegetown"));
	}
	public function ithaca(){
		$this->set("title_for_layout", $this->_makeTitle("Downtown Ithaca"));
	}
	
	private function _makeTitle($pageTitle){
		return "$pageTitle &raquo; $this->name";
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Map->recursive = 0;
		$this->set('maps', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Map->id = $id;
		if (!$this->Map->exists()) {
			throw new NotFoundException(__('Invalid map'));
		}
		$this->set('map', $this->Map->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Map->create();
			if ($this->Map->save($this->request->data)) {
				$this->Session->setFlash(__('The map has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The map could not be saved. Please, try again.'));
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
		$this->Map->id = $id;
		if (!$this->Map->exists()) {
			throw new NotFoundException(__('Invalid map'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Map->save($this->request->data)) {
				$this->Session->setFlash(__('The map has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The map could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Map->read(null, $id);
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
		$this->Map->id = $id;
		if (!$this->Map->exists()) {
			throw new NotFoundException(__('Invalid map'));
		}
		if ($this->Map->delete()) {
			$this->Session->setFlash(__('Map deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Map was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
