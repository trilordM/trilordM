<?php
App::uses('UsdRate', 'Model');

/**
 * UsdRate Test Case
 *
 */
class UsdRateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.usd_rate'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UsdRate = ClassRegistry::init('UsdRate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsdRate);

		parent::tearDown();
	}

}
