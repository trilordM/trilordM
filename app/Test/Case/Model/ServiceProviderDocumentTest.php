<?php
App::uses('ServiceProviderDocument', 'Model');

/**
 * ServiceProviderDocument Test Case
 *
 */
class ServiceProviderDocumentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_provider_document',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ServiceProviderDocument = ClassRegistry::init('ServiceProviderDocument');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServiceProviderDocument);

		parent::tearDown();
	}

}
