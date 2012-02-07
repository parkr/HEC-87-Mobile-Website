<?php
/* Hash Test cases generated on: 2012-02-07 15:42:39 : 1328647359*/
App::uses('Hash', 'Model');

/**
 * Hash Test Case
 *
 */
class HashTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.hash', 'app.user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Hash = ClassRegistry::init('Hash');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Hash);

		parent::tearDown();
	}

}
