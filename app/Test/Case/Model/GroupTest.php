<?php
/* Group Test cases generated on: 2012-01-17 17:17:26 : 1326838646*/
App::uses('Group', 'Model');

/**
 * Group Test Case
 *
 */
class GroupTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.group', 'app.user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Group = ClassRegistry::init('Group');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Group);

		parent::tearDown();
	}

}
