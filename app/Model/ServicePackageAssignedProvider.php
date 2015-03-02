<?php
App::uses('AppModel', 'Model');
/**
 * ServicePackageAssignedProvider Model
 *
 * @property ServicePackageRequest $ServicePackageRequest
 */
class ServicePackageAssignedProvider extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'service_package_request_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'service_package_request_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'service_package_request_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'provider_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'assigned_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ServicePackageRequest' => array(
			'className' => 'ServicePackageRequest',
			'foreignKey' => 'service_package_request_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
