<?php
App::uses('ServicePackageAssignedProvider', 'Model');

/**
 * ServicePackageAssignedProvider Test Case
 *
 */
class ServicePackageAssignedProviderTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_package_assigned_provider',
		'app.service_package_request',
		'app.service_package'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ServicePackageAssignedProvider = ClassRegistry::init('ServicePackageAssignedProvider');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServicePackageAssignedProvider);

		parent::tearDown();
	}

}
