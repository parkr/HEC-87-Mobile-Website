<?php
/* Thought Test cases generated on: 2012-02-07 02:26:15 : 1328599575*/
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
	public $fixtures = array('app.thought');

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
