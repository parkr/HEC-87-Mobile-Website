<?php
App::uses('AppController', 'Controller');
App::import('Helper', 'Html');
/**
 * Users Controller
 *
 * @property User $User
 * @property AuthComponent $Auth
 */
class UsersController extends AppController {

	public $account_types = array('student', 'attendee');
	public $account_types_plural = array('students', 'attendees');
	public $account_types_with_routing = array(
		'attendees' => array(
			'Attendees by First Name' => array('controller' => 'users', 'action' => 'attendees', 'by', 'first_name'),
			'Attendees by Last Name' => array('controller' => 'users', 'action' => 'attendees', 'by', 'last_name'),
			'Attendees by Company' => array('controller' => 'users', 'action' => 'attendees', 'by', 'company')
		),
		'students' => array(
			'Students by First Name' => array('controller' => 'users', 'action' => 'students', 'by', 'first_name'),
			'Students by Last Name' => array('controller' => 'users', 'action' => 'students', 'by', 'last_name'),
			'Students by Position' => array('controller' => 'users', 'action' => 'students', 'by', 'position')
		)
	);
	public $sort_fields = array('first_name', 'last_name', 'position', 'company');
	public $invite_codes = array('hecstudent', 'hecattendee');
	public $alias = "Profiles";
	public $uploadsFolder = "userphotos";
	public $uploadsFileTypes = array('image/jpeg', 'image/png', 'image/gif');
	public $maxFileSize = 4194304; // Bytes (4MB)

	public function beforeFilter() {
		$this->Auth->autoRedirect = false;
		parent::beforeFilter();
		$this->Auth->deny('view'); // Cannot see user profiles unless logged in
		$this->Auth->allow('register', 'login', 'forgot', 'reset', 'students', 'attendees'); // Letting users register themselves
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
		$this->set('account_types', $this->account_types_with_routing); 
		$this->set('title_for_layout', $this->alias); 
		$this->set('prevpage_for_layout', array('title' => 'Home', 'routing' => '/')); 
	}
	public function students($by = "by", $field = "first_name"){
		if(in_array($field, $this->sort_fields)){
			$this->set('title_for_layout', 'Students');
			$params = array(
				'conditions' => array('User.type' => 'student'),
				'order' => array("User.$field ASC")
			);
			$this->set('people', $this->User->find('all', $params));
			$this->set('sort_field', $field);
			$this->set('prevpage_for_layout', array('title' => $this->alias, 'routing' => array('controller' => $this->params['controller'], 'action' => 'index')));
		}else{
			$this->Session->setFlash("You may not sort attendees by $field.");
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
	}
	public function attendees($by = "by", $field = "first_name"){
		if(in_array($field, $this->sort_fields)){
			$this->set('title_for_layout', 'Attendees');
			$params = array(
				'conditions' => array('User.type' => 'attendee'),
				'order' => array("User.$field ASC")
			);
			if($field == "company"){
				$params['conditions']['User.company != '] = "";
			}
			$this->set('people', $this->User->find('all', $params));
			$this->set('sort_field', $field);
			$this->set('prevpage_for_layout', array('title' => $this->alias, 'routing' => array('controller' => $this->params['controller'], 'action' => 'index')));
		}else{
			$this->Session->setFlash("You may not sort attendees by $field.");
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
	}

	/** 
	 * Auth Methods
	 */
	public function login() {
		$this->set('title_for_layout', 'Login');
		$this->set('prevpage_for_layout', array('title' => "Home", 'routing' => '/'));
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$user = $this->User->findByEmail($this->request->data['User']['email']);
				if($user['User']['is_new_account'] == 1){
					// create hash. redirect to hash url.
					$this->User->Hash->create();
					$hash = array(
						'Hash' => array(
							'user_id' => $user['User']['id'],
							'hash' => $this->User->Hash->generateNew($user['User']['email']),
							'expires' => date('Y-m-d H:i:s', mktime(date("H"), date("i"), date("s"), date("n"), (date("j")+14), date("Y")))." EST" // 14 days to use.
						)
					);
					if($this->User->Hash->save($hash)){
						$this->Session->setFlash('Your account is marked as new. Please choose a new password.');
						$this->redirect($this->User->Hash->getLink($hash, $user['User']['email']));
					}else{
						$this->Session->setFlash('Something went wrong with your request. Please try again.');
					}
				}else{
					return $this->redirect($this->Auth->redirect());
				}
			} else {
				$this->Session->setFlash(__('Username or password is incorrect or you are not a registered user.'), 'default', array(), 'auth');
			}
		}
	}
	public function forgot() {
		$this->set('title_for_layout', 'Forgot Password?');
		$this->set('prevpage_for_layout', array('title' => "Login", 'routing' => array('action' => 'login')));
		if($this->request->is('post')){
			// Store hash
			$this->User->Hash->create();
			$user = $this->User->findByEmail($this->request->data['User']['email']);
			$hash = array(
				'Hash' => array(
					'user_id' => $user['User']['id'],
					'hash' => $this->User->Hash->generateNew($user['User']['email']),
					'expires' => date('Y-m-d H:i:s', mktime(date("H"), date("i"), date("s"), date("n"), (date("j")+14), date("Y")))." EST" // 14 days to use.
				)
			);
			if($this->User->Hash->save($hash)){
				// Send email
				$email = new CakeEmail();
				$email->from(array('noreply@hotelezracornell.com' => 'Hotel Ezra Cornell IT'));
				$email->to($user['User']['email']);
				$email->subject('Reset your password');
				$email->send("Hello,\n\nYou just requested to reset your password. You may do so here: ".$this->User->Hash->getLink($hash, $user['User']['email'])."\n\nSincerely,\nIT Manager\nHotel Ezra Cornell");
				$this->Session->setFlash('Your request has been processed. An email has been sent to your account.');
				$this->redirect(array('action' => 'forgot'));
			}else{
				$this->Session->setFlash('Something went wrong with your request. Please try again.');
			}
		}
	}
	
	public function reset($email, $hash_code) {
		$user = $this->User->findByEmail($email);
		$hash = $this->User->Hash->findByHash($hash_code);
		$this->set('title_for_layout', 'Reset Password');
		$this->set('prevpage_for_layout', array('title' => "Login", 'routing' => array('action' => 'login')));
		if($user['User']['id'] == $hash['Hash']['user_id'] && !$this->User->Hash->hasExpired($hash)){
			// Login
			if(!$this->Auth->loggedIn()){ $this->Auth->login($user['User']); }
			if($this->request->is('post') || $this->request->is('put')){
				// Is the password confirmed?
				if($this->request->data['User']['password'] == $this->request->data['User']['confirm_password']){
					// Set new password, is_new_account
					$this->request->data['User']['is_new_account'] = 0;
					$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
					if ($this->User->save($this->request->data, true, array('password', 'is_new_account'))) {
						$this->Session->setFlash('Your password has been updated.');
						$this->redirect($this->Auth->loginRedirect);
					}else{
						$this->Session->setFlash('Your password could not be updated. Try again.');
					}
				}else{
					$this->Session->setFlash('Your passwords do not match! Enter them again.');
				}
			}else{
				$user['User']['password'] = ""; // Clear old password
				$this->request->data = $user;
			}
		}else{
			$this->Session->setFlash('Something went wrong when trying to request your password. Try requesting a reset again.');
			$this->redirect(array('controller' => 'users', 'action' => 'forgot'));
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
		
		// Check for access from logged-in user.
		if($this->Auth->loggedIn()){
			$this->Session->setFlash('You are already logged in.');
			$this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('id')));
		}
		
		// Check for the existence and validity of invite code
		if(isset($this->params->query) && isset($this->params->query['invite']) && in_array($this->params->query['invite'], $this->invite_codes)){
			$this->set('type', 
						(isset($this->params->query['type']) && $this->params->query['type'] != "" && in_array($this->params->query['type'], $this->account_types)) 
							? $this->params->query['type'] 
							: ($this->params->query['invite'] == "hecattendee") ? "attendee" : "student"
			);
			if ($this->request->is('post')) {
				$this->User->create();
				// Utilizing the confirm_password concept
				if($this->request->data['User']['password'] != $this->request->data['User']['confirm_password']){
					$this->Session->setFlash(__('Your passwords do not match.'));
				} else {
					// Check to see if this email already exists. Unique emails enforced.
					if($this->User->emailExists($this->request->data['User']['email'])){
						$this->Session->setFlash(__('The email you entered is already associated with another user.'));
					}else{
						// Automatically set role and date_created
						$this->request->data['User']['role'] = "user";
						$this->request->data['User']['date_created'] = date("Y-m-d H:i:s");
						
						// Automatically set company if User.type is student
						if($this->request->data['User']['type'] == 'student'){
							$this->request->data['User']['company'] = $this->_defaultStudentCompany();
						}
						
						// Upload photo.
						$this->request->data['User']['photo'] = $this->_uploadFile($this->request->data);
						$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
						
						if ($this->User->save($this->request->data)) {
							$user = $this->request->data;
							// Send email
							$email = new CakeEmail();
							$email->from(array('registration-noreply@hotelezracornell.com' => 'Hotel Ezra Cornell IT'));
							$email->to($user['User']['email']);
							$email->subject('Your Profile Has Been Successfully Created!');
							$email->send("Hello ".$user['User']['first_name'].",\n\nYour profile on http://www.mobile.hotelezracornell.com/ has been successfully created! Make sure to complete your profile before HEC weekend (April 12-15, 2012). Check back soon, as features are added daily.\n\nHappy networking!\n\nSincerely,\nParker Moore\nIT Manager\nHotel Ezra Cornell");
							$this->Session->setFlash('Your account has been successfully created and a confirmation email has been sent to your email address.');
							$this->redirect('/');
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
	
	private function _defaultStudentCompany(){
		return "HEC ".$this->_currentHECYear();
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
 			throw new NotFoundException(__('User does not exist.'));
 		}
		$this->User->recursive = 2;
		$user = $this->User->read(null, $id);
		$this->User->bumpProfileViews();
 		$this->set('user', $user);
		$this->set('title_for_layout', $user['User']['name']);
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
			
			$fieldList = array('name', 'show_contact_info', 'email', 'phone_number', 'graduation_year', 'company', 'position', 'bio', 'photo');
			$this->request->data['User']['photo'] = $this->_uploadFile($this->request->data);
			
			$this->request->data['User']['bio'] = normalize_newlines($this->request->data['User']['bio']);
			
			if ($this->User->save($this->request->data, true, $fieldList)) {
				$this->Session->setFlash(__('Your profile has been saved successfully.'));
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
			$this->Auth->logout();
			if($this->User->delete($id)){
				$this->Session->setFlash('Your account has been successfully deleted.');
			}else{
				$this->Session->setFlash('Your account could not be deleted.');
			}
		}
		$this->redirect('/');
	}
	
	/**
	 * Upload File Function
	 * 
	 * @param $data - the request data submitted from the form
	 * @return new file url, or a blank string if something went wrong
	 */
	private function _uploadFile($data){
		$photo = $data['User']['picture'];
		if($photo['name'] == ""){ // Don't reset.
			return $data['User']['photo'];
		}
		
		// Validate the file's type
		if(!in_array($photo['type'], $this->uploadsFileTypes)){
			$this->Session->setFlash('You may only upload image files. The rest of your data was saved.');
			return "";
		}
		
		// Validate the file's size
		if($photo['size'] > $this->maxFileSize){
			$this->Session->setFlash('Your upload cannot exceed '. ($this->maxFileSize/1000) .'KB. Please try a smaller photo.');
			return "";
		}
		
		// Hash filename
		$filename = substr($photo['name'], 0, strrpos($photo['name'], '.'));
		$extension = substr($photo['name'], strrpos($photo['name'], '.'));
		$hashedName = md5($filename) . $extension;
		
		// Create paths
		$path = DS . $this->uploadsFolder . DS . $hashedName;
		$fullpath = realpath(dirname(__FILE__) . DS . '..' . DS . 'webroot') . $path;
		
		// Insure that directories are there.
		if(!file_exists(dirname($fullpath))){
			mkdir(dirname($fullpath), 0777, true);
		}
			
		// Move files & return file path
		if(move_uploaded_file($photo['tmp_name'], $fullpath)){
			$this->Session->setFlash('Your file was uploaded successfully.');
			return $path;
		}else{
			$this->Session->setFlash('Your file could not be uploaded.');
			return "";
		}
		return "";
	}

}
