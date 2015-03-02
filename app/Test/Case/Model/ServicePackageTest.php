<?php
App::uses('ServicePackage', 'Model');

/**
 * ServicePackage Test Case
 *
 */
class ServicePackageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_package',
		'app.service_package_request'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ServicePackage = ClassRegistry::init('ServicePackage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServicePackage);

		parent::tearDown();
	}

}
