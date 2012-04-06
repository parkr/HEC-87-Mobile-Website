<?php
/**
 * ThoughtFixture
 *
 */
class ThoughtFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'event_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'question_1' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'question_2' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'question_3' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'question_4' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'question_5' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'comments' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'event_id' => 1,
			'user_id' => 1,
			'question_1' => 1,
			'question_2' => 1,
			'question_3' => 1,
			'question_4' => 1,
			'question_5' => 1,
			'comments' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
