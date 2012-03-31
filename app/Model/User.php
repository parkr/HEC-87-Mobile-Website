<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
App::uses('CakeEmail', 'Network/Email');
/**
 * User Model
 *
 */
class User extends AppModel {
	
	public $name = 'User';
	public $displayField = 'name';
	public $virtualFields = array(
	    'name' => 'CONCAT(User.first_name, " ", User.last_name)',
		'formal_name' => 'CONCAT(User.last_name, ", ", User.first_name)',
	);
	public $hasMany = array(
		'Hash',
		'CheckIn'
	);
	public $hasAndBelongsToMany = array(
        'Event' => array(
			'className'              => 'Event',
			'joinTable'              => 'events_users',
			'foreignKey'             => 'user_id',
			'associationForeignKey'  => 'event_id',
			'unique'                 => false,
		)
	);
	
	public function beforeSave() {
		if (isset($this->data[$this->alias]['password']) && $this->data[$this->alias]['password'] != "") {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		if(isset($this->data[$this->alias]['phone_number'])){
			$num = $this->data[$this->alias]['phone_number'];
			$num = preg_replace('/(-|_| |\+|\(|\)|\.)+/', "", $num);
			$this->data[$this->alias]['phone_number'] = $num;
		}
		if(isset($this->data[$this->alias]['bio'])){
			$this->data[$this->alias]['bio'] = normalize_newlines($this->data[$this->alias]['bio']);
		}
		return true;
	}
	
	public function emailExists($email){
		return $this->find('count', array(
			'conditions' => array('User.email' => $email)
		)) > 0;
	}
	
	public function bumpProfileViews(){
		if($this->data && $this->data[$this->alias]){
			$newpv = $this->data[$this->alias]['profile_views'] += 1;
			$this->set('profile_views', $newpv);
			$this->data['User']['profile_views'] = $newpv;
			return $this->save(null, true, array('profile_views'));
		}else{
			return false;
		}
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Your first name cannot be blank.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Your last name cannot be blank.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must provide a password.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'show_contact_info' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'You must select',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'You must provide a valid email address.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Your email address may not be empty.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone_number' => array(
			'phone' => array(
				'rule' => array('phone'),
				'message' => 'You have not entered a valid phone number.',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'graduation_year' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Your graduation year must be numeric.',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
