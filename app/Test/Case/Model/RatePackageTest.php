<?php
App::uses('RatePackage', 'Model');

/**
 * RatePackage Test Case
 *
 */
class RatePackageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.rate_package',
		'app.service_provider_rate'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RatePackage = ClassRegistry::init('RatePackage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RatePackage);

		parent::tearDown();
	}

}
