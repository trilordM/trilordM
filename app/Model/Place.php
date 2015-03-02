<?php
App::uses('AppModel', 'Model');
/**
 * Place Model
 *
 * @property District $District
 * @property User $User
 */
class Place extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'district_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'place_1' => array(
			'rule' =>array('ValidatePlaces','place_1'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
		),
		'place_2' => array(
			'rule' =>array('ValidatePlaces','place_2'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
		),
		'place_3' => array(
			'rule' =>array('ValidatePlaces','place_3'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
		),
		'place_4' => array(
			'rule' =>array('ValidatePlaces','place_4'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
		),
		'place_5' => array(
			'rule' =>array('ValidatePlaces','place_5'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
		),
		'place_6' => array(
			'rule' =>array('ValidatePlaces','place_6'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
		),
		'place_7' => array(
			'rule' =>array('ValidatePlaces','place_7'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
		),
		'place_8' => array(
			'rule' =>array('ValidatePlaces','place_8'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
		),
		'place_9' => array(
			'rule' =>array('ValidatePlaces','place_9'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
		),
		'place_10' => array(
			'rule' =>array('ValidatePlaces','place_10'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
			),
	);
	
	public function ValidatePlaces($fieldName){
		$value = array_keys($fieldName);
		$place_name=$value[0];
		
		$place = $this->find('count',array(
							'conditions'=>array('district_id'=>$this->data['Place']['district_id'],'name'=>$this->data['Place'][$place_name]),'recursive'=>-1
							));
		
		if ($place>0)
		{
		  $this->invalidate($place_name, 'The place name for the district already exists');
		  return false;
		}
		return true;
		//}
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'District' => array(
			'className' => 'District',
			'foreignKey' => 'district_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'place_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
