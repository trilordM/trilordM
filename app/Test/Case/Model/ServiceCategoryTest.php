<?php
App::uses('ServiceCategory', 'Model');

/**
 * ServiceCategory Test Case
 *
 */
class ServiceCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ServiceCategory = ClassRegistry::init('ServiceCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServiceCategory);

		parent::tearDown();
	}

}
