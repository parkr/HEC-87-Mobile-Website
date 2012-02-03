<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property AuthComponent $Auth
 */
class UsersController extends AppController {

	public $account_types = array('student', 'attendee', 'speaker');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register'); // Letting users register themselves
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

/**
 * add method
 *
 * @return void
 */
	public function register() {
		$this->set('params', $this->params->query);
		$this->set('type', (isset($this->params->query['type']) && $this->params->query['type'] != "" && in_array($this->params->query['type'], $this->account_types)) ? $this->params->query['type'] : "student");
		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['role'] = "user";
			$this->request->data['User']['date_created'] = date("Y-m-d H:i:s");
			if ($this->User->save($this->request->data)) {
				$id = $this->User->id;
				$this->request->data['User'] = array_merge($this->request->data["User"], array('id' => $id));
				$this->Auth->login($this->request->data['User']);
				$this->redirect(array('controller' => 'pages', 'action' => 'home'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_login(){
		$this->set('user_id', $this->Auth->user('id'));
		$this->set('isAuthorized', $this->Auth->user());
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
