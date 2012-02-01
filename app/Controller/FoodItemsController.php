<?php
App::uses('AppController', 'Controller');
/**
 * FoodItems Controller
 *
 * @property FoodItem $FoodItem
 */
class FoodItemsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FoodItem->recursive = 0;
		$this->set('foodItems', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->FoodItem->id = $id;
		if (!$this->FoodItem->exists()) {
			throw new NotFoundException(__('Invalid food item'));
		}
		$this->set('foodItem', $this->FoodItem->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FoodItem->create();
			if ($this->FoodItem->save($this->request->data)) {
				$this->Session->setFlash(__('The food item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The food item could not be saved. Please, try again.'));
			}
		}
		$menuses = $this->FoodItem->Menu->find('list');
		$this->set(compact('menuses'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->FoodItem->id = $id;
		if (!$this->FoodItem->exists()) {
			throw new NotFoundException(__('Invalid food item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FoodItem->save($this->request->data)) {
				$this->Session->setFlash(__('The food item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The food item could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->FoodItem->read(null, $id);
		}
		$menuses = $this->FoodItem->Menu->find('list');
		$this->set(compact('menuses'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->FoodItem->id = $id;
		if (!$this->FoodItem->exists()) {
			throw new NotFoundException(__('Invalid food item'));
		}
		if ($this->FoodItem->delete()) {
			$this->Session->setFlash(__('Food item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Food item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
