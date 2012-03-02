<?php
App::uses('AppModel', 'Model');
/**
 * Speaker Model
 *
 */
class Speaker extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $virtualFields = array(
	    'name' => 'CONCAT(Speaker.first_name, " ", Speaker.last_name)'
	);
	public $belongsTo = 'Event';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
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
	
}
