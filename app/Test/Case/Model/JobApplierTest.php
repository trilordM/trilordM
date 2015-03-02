<?php
App::uses('JobApplier', 'Model');

/**
 * JobApplier Test Case
 *
 */
class JobApplierTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.job_applier',
		'app.career'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->JobApplier = ClassRegistry::init('JobApplier');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->JobApplier);

		parent::tearDown();
	}

}
