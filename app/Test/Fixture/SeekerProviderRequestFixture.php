<?php
/**
 * SeekerProviderRequestFixture
 *
 */
class SeekerProviderRequestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'service_seeker_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'service_provider_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'requested_date_from' => array('type' => 'date', 'null' => false, 'default' => null),
		'requested_date_to' => array('type' => 'date', 'null' => false, 'default' => null),
		'created_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'description' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'assigned_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'completed_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'withdrawn_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'remarks' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'rate_package_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'rate' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'service_seeker_id' => 1,
			'service_provider_id' => 1,
			'requested_date_from' => '2014-06-11',
			'requested_date_to' => '2014-06-11',
			'created_date' => '2014-06-11',
			'description' => 'Lorem ipsum dolor sit amet',
			'status' => 1,
			'assigned_date' => '2014-06-11',
			'completed_date' => '2014-06-11',
			'withdrawn_date' => '2014-06-11',
			'remarks' => 'Lorem ipsum dolor sit amet',
			'rate_package_id' => 1,
			'rate' => 'Lorem ipsum dolor sit amet'
		),
	);

}
