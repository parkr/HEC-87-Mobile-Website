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
	public $account_types_plural = array('students', 'attendees');
	public $invite_codes = array('hecstudent', 'hecattendee', 'bod');
	public $alias = "Profiles";

	public function beforeFilter() {
		$this->Auth->autoRedirect = false;
		parent::beforeFilter();
		$this->Auth->deny('view'); // Cannot see user profiles unless logged in
		$this->Auth->allow('register', 'login', 'students', 'attendees'); // Letting users register themselves
	}
	
	public function isAuthorized($user) {
		if(parent::isAuthorized($user)){
			return true;
		}
		if (isset($user['role']) && $user['role'] === 'user') {
			return true;
		}
		return false;
	}


	/** 
	 * Directory Listings
	 */
	public function index(){ 
		$this->set('account_types', $this->account_types_plural); 
		$this->set('title_for_layout', $this->alias); 
		$this->set('prevpage_for_layout', array('title' => 'Home', 'routing' => '/')); 
	}
	public function students(){
		$this->set('title_for_layout', 'Students');
		$params = array(
			'conditions' => array('User.type' => 'student'),
			'order' => array('User.name ASC')
		);
		$this->set('people', $this->User->find('all', $params));
		$this->set('prevpage_for_layout', array('title' => $this->alias, 'routing' => array('controller' => $this->params['controller'], 'action' => 'index')));
	}
	public function attendees(){
		$this->set('title_for_layout', 'Attendees');
		$params = array(
			'conditions' => array('User.type' => 'attendee'),
			'order' => array('User.name ASC')
		);
		$this->set('people', $this->User->find('all', $params));
		$this->set('prevpage_for_layout', array('title' => $this->alias, 'routing' => array('controller' => $this->params['controller'], 'action' => 'index')));
	}

	/** 
	 * Auth Methods
	 */
	public function login() {
		$this->set('title_for_layout', 'Login');
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect or you are not a registered user.'), 'default', array(), 'auth');
			}
		}
	}
	public function logout() {
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		$redirect_to = $this->Auth->logout();
		if($redirect_to){
			$this->Session->setFlash('You have been successfully logged out.');
			$this->redirect($redirect_to);
		}else{
			$this->Session->setFlash('You could not be logged out.');
			$this->redirect($redirect_to);
		}
	}
	public function register() {
		$this->set('title_for_layout', 'Register');
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		
		// Check for invalidity.
		if($this->Auth->loggedIn()){
			$this->Session->setFlash('You are already logged in.');
			$this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
		}
		if(isset($this->params->query) && isset($this->params->query['invite']) && in_array($this->params->query['invite'], $this->invite_codes)){
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
						if($this->request->data['User']['type'] == 'student'){
							$this->request->data['User']['company'] = "Hotel Ezra Cornell ".$this->_currentHECYear();
						}
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
		}else{
			$this->Session->setFlash('You must have a valid invite code to be qualified to register.');
			$this->redirect(array('controller' => 'pages', 'action' => 'home'));
		}
	}
	
	private function _currentHECYear(){
		$base_year = 2012;
		$base_hec_year = 87;
		if( ((int) date("m")) >= 6 ){
			// It's June. We're thinking about next year.
			return $base_year - 1924;
		}else{
			return $base_year - 1925;
		}
	}
	
	/***************************************** 
	 * Profile methods
	 */
 	public function view($id = null) {
 		$this->User->id = $id;
 		if (!$this->User->exists()) {
 			throw new NotFoundException(__('Invalid event'));
 		}
		$user = $this->User->read(null, $id);
 		$this->set('user', $user);
		$this->set('title_for_layout', $user['User']['name']. "'s Profile");
		$this->set('prevpage_for_layout', array('title' => ucwords(Inflector::pluralize($user['User']['type'])), 'routing' => array('controller' => $this->params['controller'], 'action' => Inflector::pluralize($user['User']['type']))));
 	}
	public function edit($id = null) {
		$this->set('title_for_layout', 'Edit Profile');
		$this->set('prevpage_for_layout', array('title' => 'My Profile', 'routing' => array('controller' => $this->params['controller'], 'action' => 'view', AuthComponent::user('id'))));
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if($this->User->id != AuthComponent::user('id')){
			$this->Session->setFlash(__('You may only edit your own profile.'));
			$this->redirect(array('action' => 'edit', AuthComponent::user('id')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$fieldList = array('name', 'show_contact_info', 'email', 'phone_number', 'graduation_year', 'company', 'position', 'bio', 'picture');
			
			if ($this->User->save($this->request->data, true, $fieldList)) {
				$this->Session->setFlash(__('Your profile has been saved!'));
				$this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash(__('Your profile could not be saved. Please, try again.'));
				$this->set('type', $this->request->data['User']['type']);
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
			$this->set('type', $this->request->data['User']['type']);
		}
	}
	
 	public function delete($id = null) {
 		$this->User->id = $id;
 		if (!$this->User->exists()) {
 			throw new NotFoundException(__('Invalid event'));
 		}
		if ($this->request->is('post')) {
			$this->requestAction('/logout', array('return'));
			if($this->User->delete($id)){
				$this->Session->setFlash('Your account has been successfully deleted.');
			}else{
				$this->Session->setFlash('Your account could not be deleted.');
			}
		}
		$this->redirect('/');
	}

}
