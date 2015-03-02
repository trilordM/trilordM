<?php
App::uses('Place', 'Model');

/**
 * Place Test Case
 *
 */
class PlaceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.place',
		'app.district',
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
		$this->Place = ClassRegistry::init('Place');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Place);

		parent::tearDown();
	}

}
