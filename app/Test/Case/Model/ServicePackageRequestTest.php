<?php
App::uses('ServicePackageRequest', 'Model');

/**
 * ServicePackageRequest Test Case
 *
 */
class ServicePackageRequestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_package_request',
		'app.service_package',
		'app.service_package_assigned_provider'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ServicePackageRequest = ClassRegistry::init('ServicePackageRequest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServicePackageRequest);

		parent::tearDown();
	}

}
