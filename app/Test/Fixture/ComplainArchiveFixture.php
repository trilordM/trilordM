<?php
/**
 * ComplainArchiveFixture
 *
 */
class ComplainArchiveFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'complain_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'service_provider_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'service_seeker_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'complain_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'archieved_date' => array('type' => 'date', 'null' => false, 'default' => null),
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
			'complain_id' => 1,
			'service_provider_id' => 1,
			'service_seeker_id' => 1,
			'complain_date' => '2014-05-23',
			'archieved_date' => '2014-05-23'
		),
	);

}
