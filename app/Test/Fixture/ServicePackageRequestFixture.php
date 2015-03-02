<?php
/**
 * ServicePackageRequestFixture
 *
 */
class ServicePackageRequestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'service_package_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'seeker_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'requested_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'description' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'assigned_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'is_locked' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'locked_by' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'completed_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'rate' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'requested_amount' => array('type' => 'integer', 'null' => false, 'default' => null),
		'freezed_amount' => array('type' => 'integer', 'null' => false, 'default' => null),
		'completed_amount' => array('type' => 'integer', 'null' => false, 'default' => null),
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
			'service_package_id' => 1,
			'seeker_id' => 1,
			'requested_date' => '2014-07-02',
			'description' => 'Lorem ipsum dolor sit amet',
			'status' => 'Lorem ipsum dolor sit amet',
			'assigned_date' => '2014-07-02',
			'is_locked' => 1,
			'locked_by' => 'Lorem ipsum dolor sit amet',
			'completed_date' => '2014-07-02',
			'rate' => 'Lorem ipsum dolor sit amet',
			'requested_amount' => 1,
			'freezed_amount' => 1,
			'completed_amount' => 1
		),
	);

}
