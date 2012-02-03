<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property AuthComponent $Auth
 */
class UsersController extends AppController {

	public $account_types = array('student', 'attendee');

	public function beforeFilter() {
		$this->Auth->autoRedirect = false;
		parent::beforeFilter();
		$this->Auth->deny('view'); // Cannot see user profiles unless logged in
		$this->Auth->allow('register', 'login'); // Letting users register themselves
	}

	public function index(){ $this->set('account_types', $this->account_types); }
	public function students(){
		$this->set('title_for_layout', 'Students');
		$params = array(
			'conditions' => array('User.type' => 'student'),
			'order' => array('User.name ASC')
		);
		$this->set('people', $this->User->find('all', $params));
	}
	public function attendees(){
		$this->set('title_for_layout', 'Attendees');
		$params = array(
			'conditions' => array('User.type' => 'attendee'),
			'order' => array('User.name ASC')
		);
		$this->set('people', $this->User->find('all', $params));
		
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect'. AuthComponent::password($this->request->data['User']['password'])), 'default', array(), 'auth');
			}
		}
	}

	public function logout() {
		$redirect_to = $this->Auth->logout();
		if($redirect_to){
			$this->Session->setFlash('You have been successfully logged out.');
			$this->redirect($redirect_to);
		}else{
			$this->Session->setFlash('You could not be logged out.');
			$this->redirect($redirect_to);
		}
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
			if($this->request->data['User']['password'] != $this->request->data['User']['confirm_password']){
				$this->Session->setFlash(__('Your passwords do not match.'));
			} else {
				if($this->User->emailExists($this->request->data['User']['email'])){
					$this->Session->setFlash(__('The email you entered is already associated with another user.'));
				}else{
					$this->request->data['User']['role'] = "user";
					$this->request->data['User']['date_created'] = date("Y-m-d H:i:s");
					if ($this->User->save($this->request->data)) {
						$id = $this->User->id;
						$this->request->data['User'] = array_merge($this->request->data["User"], array('id' => $id));
						$this->Auth->login($this->request->data['User']);
						$this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
					} else {
						$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
					}
				}
			}
		}
	}

	public function admin_login(){
		if($this->isAuthorized($this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id')))))){ $this->set("good", "YOU'RE GOOD HOMIE"); }
		else{ $this->redirect(array('action' => 'login', 'admin' => false)); }
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->set('user', $this->User->read(null, $id));
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
