<?php
/**
 * ServiceRequestRelayFixture
 *
 */
class ServiceRequestRelayFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'seeker_provider_request_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'service_provider_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'service_seeker_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'description' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'seeker_provider_request_id' => 1,
			'service_provider_id' => 1,
			'service_seeker_id' => 1,
			'description' => 'Lorem ipsum dolor sit amet',
			'created_date' => '2014-06-19'
		),
	);

}
