<?php
App::uses('ProviderRequestedDocument', 'Model');

/**
 * ProviderRequestedDocument Test Case
 *
 */
class ProviderRequestedDocumentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.provider_requested_document'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProviderRequestedDocument = ClassRegistry::init('ProviderRequestedDocument');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProviderRequestedDocument);

		parent::tearDown();
	}

}
