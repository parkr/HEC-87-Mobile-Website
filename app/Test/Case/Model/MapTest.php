<?php
/* Map Test cases generated on: 2012-01-28 02:25:16 : 1327735516*/
App::uses('Map', 'Model');

/**
 * Map Test Case
 *
 */
class MapTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.map');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Map = ClassRegistry::init('Map');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Map);

		parent::tearDown();
	}

}
