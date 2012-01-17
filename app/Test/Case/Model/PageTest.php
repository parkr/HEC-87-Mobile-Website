<?php
/* Page Test cases generated on: 2012-01-13 10:52:50 : 1326469970*/
App::uses('Page', 'Model');

/**
 * Page Test Case
 *
 */
class PageTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.page');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Page = ClassRegistry::init('Page');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Page);

		parent::tearDown();
	}

}
