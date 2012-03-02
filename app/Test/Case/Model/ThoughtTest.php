<?php
/* Thought Test cases generated on: 2012-03-02 17:47:54 : 1330728474*/
App::uses('Thought', 'Model');

/**
 * Thought Test Case
 *
 */
class ThoughtTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.thought', 'app.event', 'app.menu', 'app.food_item', 'app.speaker', 'app.user', 'app.hash', 'app.events_user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Thought = ClassRegistry::init('Thought');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Thought);

		parent::tearDown();
	}

}
