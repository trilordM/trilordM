<?php
App::uses('ServiceRequestRelay', 'Model');

/**
 * ServiceRequestRelay Test Case
 *
 */
class ServiceRequestRelayTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_request_relay',
		'app.seeker_provider_request',
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
		$this->ServiceRequestRelay = ClassRegistry::init('ServiceRequestRelay');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServiceRequestRelay);

		parent::tearDown();
	}

}
