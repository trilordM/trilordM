<?php
App::uses('SeekerProviderRequest', 'Model');

/**
 * SeekerProviderRequest Test Case
 *
 */
class SeekerProviderRequestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.seeker_provider_request',
		'app.service_seeker',
		'app.service_provider',
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
		$this->SeekerProviderRequest = ClassRegistry::init('SeekerProviderRequest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SeekerProviderRequest);

		parent::tearDown();
	}

}
