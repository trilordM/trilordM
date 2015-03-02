<?php
App::uses('PaypalSetting', 'Model');

/**
 * PaypalSetting Test Case
 *
 */
class PaypalSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.paypal_setting'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PaypalSetting = ClassRegistry::init('PaypalSetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PaypalSetting);

		parent::tearDown();
	}

}
