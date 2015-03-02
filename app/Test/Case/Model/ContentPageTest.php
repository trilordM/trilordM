<?php
App::uses('ContentPage', 'Model');

/**
 * ContentPage Test Case
 *
 */
class ContentPageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.content_page'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ContentPage = ClassRegistry::init('ContentPage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ContentPage);

		parent::tearDown();
	}

}
