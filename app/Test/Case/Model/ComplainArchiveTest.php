<?php
App::uses('ComplainArchive', 'Model');

/**
 * ComplainArchive Test Case
 *
 */
class ComplainArchiveTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.complain_archive',
		'app.complain',
		'app.service_provider',
		'app.service_seeker'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ComplainArchive = ClassRegistry::init('ComplainArchive');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ComplainArchive);

		parent::tearDown();
	}

}
