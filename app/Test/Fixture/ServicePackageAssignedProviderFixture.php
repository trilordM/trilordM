<?php
/**
 * ServicePackageAssignedProviderFixture
 *
 */
class ServicePackageAssignedProviderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'service_package_request_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'provider_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'assigned_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'service_package_request_id', 'unique' => 1)
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
			'service_package_request_id' => 1,
			'provider_id' => 1,
			'assigned_date' => '2014-07-02',
			'status' => 'Lorem ipsum dolor sit amet'
		),
	);

}
