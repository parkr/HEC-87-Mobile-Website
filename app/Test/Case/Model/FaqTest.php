<?php
/* Faq Test cases generated on: 2012-01-17 23:58:43 : 1326862723*/
App::uses('Faq', 'Model');

/**
 * Faq Test Case
 *
 */
class FaqTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.faq');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Faq = ClassRegistry::init('Faq');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Faq);

		parent::tearDown();
	}

}
