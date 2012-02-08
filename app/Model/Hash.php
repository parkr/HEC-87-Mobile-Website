<?php
App::uses('AppModel', 'Model');
App::import('Helper', 'Html');
/**
 * Hash Model
 *
 * @property User $User
 */
class Hash extends AppModel {
	
	public function getLink($hash, $email){
		return FULL_BASE_URL. HtmlHelper::url("/reset/".$email."/".$hash['Hash']['hash']);
	}
	
	public function generateNew($email){
		// Generate hash based on email address
		return AuthComponent::password($email);
	}
	
	public function hasExpired($hash){
		$expires = strtotime($hash['Hash']['expires']);
		$now = time();
		return ($now > $expires);
	}
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'hash' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
