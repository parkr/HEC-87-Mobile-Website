<?php
/* Menu Test cases generated on: 2012-01-31 14:45:52 : 1328039152*/
App::uses('Menu', 'Model');

/**
 * Menu Test Case
 *
 */
class MenuTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.menu', 'app.food_item', 'app.menus');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Menu = ClassRegistry::init('Menu');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Menu);

		parent::tearDown();
	}

}
