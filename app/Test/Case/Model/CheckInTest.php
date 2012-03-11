<?php
/* CheckIn Test cases generated on: 2012-03-10 22:18:41 : 1331435921*/
App::uses('CheckIn', 'Model');

/**
 * CheckIn Test Case
 *
 */
class CheckInTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.check_in', 'app.event', 'app.menu', 'app.food_item', 'app.speaker', 'app.user', 'app.hash', 'app.events_user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->CheckIn = ClassRegistry::init('CheckIn');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CheckIn);

		parent::tearDown();
	}

}
