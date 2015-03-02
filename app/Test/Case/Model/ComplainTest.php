<?php
App::uses('Complain', 'Model');

/**
 * Complain Test Case
 *
 */
class ComplainTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.complain',
		'app.complain_archive',
		'app.service_provider',
		'app.service_seeker',
		'app.complain_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Complain = ClassRegistry::init('Complain');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Complain);

		parent::tearDown();
	}

}
