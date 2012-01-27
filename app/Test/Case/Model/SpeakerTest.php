<?php
/* Speaker Test cases generated on: 2012-01-27 16:29:42 : 1327699782*/
App::uses('Speaker', 'Model');

/**
 * Speaker Test Case
 *
 */
class SpeakerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.speaker');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Speaker = ClassRegistry::init('Speaker');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Speaker);

		parent::tearDown();
	}

}
