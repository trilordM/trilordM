<?php
App::uses('ServiceSeekerDeposit', 'Model');

/**
 * ServiceSeekerDeposit Test Case
 *
 */
class ServiceSeekerDepositTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_seeker_deposit',
		'app.user',
		'app.country',
		'app.service_provider_rate',
		'app.provider_service_category',
		'app.service_provider_document'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ServiceSeekerDeposit = ClassRegistry::init('ServiceSeekerDeposit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServiceSeekerDeposit);

		parent::tearDown();
	}

}
