<?php
/* FoodItem Test cases generated on: 2012-01-31 14:44:32 : 1328039072*/
App::uses('FoodItem', 'Model');

/**
 * FoodItem Test Case
 *
 */
class FoodItemTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.food_item', 'app.menus');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->FoodItem = ClassRegistry::init('FoodItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FoodItem);

		parent::tearDown();
	}

}
