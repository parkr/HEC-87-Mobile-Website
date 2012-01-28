<?php
/* Sponsor Test cases generated on: 2012-01-28 01:27:52 : 1327732072*/
App::uses('Sponsor', 'Model');

/**
 * Sponsor Test Case
 *
 */
class SponsorTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.sponsor');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Sponsor = ClassRegistry::init('Sponsor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sponsor);

		parent::tearDown();
	}

}
