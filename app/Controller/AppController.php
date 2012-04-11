<?php
class AppController extends Controller {

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'home'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'home'),
			'authorize' => array('Controller'),
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email')
				)
			)
        ),
		'RequestHandler',
		'RememberMe.RememberMe'
    );
	
	public function isAuthorized($user) {
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}
		return false;
	}

    function beforeFilter() {
		$this->Auth->allow('index', 'view');
		if ($this->Auth->user() && $this->params['action'] != 'logout') {
			$this->RememberMe->checkUser();
		}
		
    }
	
}