<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
   // var $actsAs = array ('Searchable'); 

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'name' => array(
			'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'Please enter your name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
		),
		
		'company_name' => array(
			'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'Please enter your company name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
		),
		'identifier' => array(
			'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'Please choose identifier',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
		),
		
		'identification_number' => array(
			'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'Please enter your selected identifier number.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
		),
		'email' => array(
			 /*'required' => array(
				'rule' => 'notEmpty',
				'message' => 'Please Enter your email.'
			  ),*/
				'email' => array(
					'rule' => array('email'),
					'message' => 'Enter your valid email.',
					'allowEmpty' => true,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
				'unique' => array(
				'rule' => 'isUnique',
				'message' => 'An account with that email already exists.'
			  )
		),
		'mail' => array(
					'email' => array(
						'rule' => array('email'),
						'message' => 'Enter your valid email.',
						'allowEmpty' => true,
						//'required' => false,
						//'last' => false, // Stop validation after this rule
						//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
				'unique' => array(
				'rule' => 'check_Unique',
				'message' => 'An account with that email already exists.'
			  ),
		 ),
		 
		 'ward_number' => array(
			'numeric' => array(
				'rule' =>'check_ward_number' ,
				'message' => 'Enter valid ward number',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
				
		'primary_phone' => array(
			'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'Please enter your phone number',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
		),
		/*'username' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'Please Enter Username.'
			  ),			
			 'characters' => array(
                'rule'     => 'alphaNumeric',
                'message'  => 'Alphanumeric characters only'
            ),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'An account with that username already exists.'
			  ),
		),*/
		'password' => array(
		  		'required' => array(
					'rule' => array('notEmpty'),
					'message'=>'Please enter password.'
		  		),
				'min' => array(
					'rule' => array('minLength', 6),
					'message' => 'Password must be at least 6 characters.'
		  		),
		),
		'old_Password' => array(
		  		'required' => array(
					'rule' => array('notEmpty'),
					'message'=>'Please enter password.'
		  		)
		),
		'new_Password' => array(
		  		'required' => array(
					'rule' => array('notEmpty'),
					'message'=>'Please enter password.'
		  		),
				'min' => array(
					'rule' => array('minLength', 6),
					'message' => 'Password must be at least 6 characters.'
		  		),
		),
		'confirm_password' => array(
		  		'required' => array(
					'rule' => array('notEmpty'),
					'message'=>'Please confirm password.'
		  		),
				'match'=>array(
				'rule' =>  'validatePasswdConfirm',
				'message' => "Passwords did not match"
      			),
				
		),
		/*'phone' => array(
			
				'min' => array(
						'rule' => array('minLength', 10),
						'message' => 'Phone number must be 10 digit.'
				),
			
		),*/
		/*'dob' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Select your birth date',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
		
		'place_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select your working place',
				//'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		/*'country_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select your country',
				//'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		*/
		
		/*'expertise_level' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select your expertise level',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
		'profile_image' => array(
		
				//'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg')),
				'rule' =>'check_profile_photo',
				//'message' => 'Supported format gif, jpeg, jpg, png',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			
		'document_id_1' => array(
				'rule' =>'checkdocument',
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
			
		'document_1' => array(
				'rule' => 'checkdocument',
				//'message' => '',
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			
		),
		
		'doc_title_1' => array(
				'rule' =>'checkdocumentEdit',
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
			
		'doc_name_1' => array(
				'rule' => 'checkdocumentEdit',
				//'message' => 'Invalid Image. Supported format gif, jpeg, jpg, png,bmp.',
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			
		),
		
		'role' => array(
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
	
	 function validatePasswdConfirm($data)
	{
		
		if ($this->data['User']['confirm_password'] !== $this->data['User']['password'])
		{
		  return false;
		}
		return true;
	}
	
	function  check_Unique ($data){
		$check=$this->query("select * from users where email='{$data['mail']}'");
		
		if($check){
			return false;
		}else{
			return true;
		}
	}
	
	function  check_ward_number($data){
		//debug($data);die;
		if(!empty($data['ward_number'])){
			if(is_numeric($data['ward_number'])&&($data['ward_number']>0)){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}
	
	//add document
	public function checkdocument(){
		//debug($this->data);exit;
		$message = '';
		$invalid = 0;
		 for($j=1;$j<=$this->data['User']['document_count'];$j++):
			if(!empty($this->data['User']['document_'.$j]['name'])){
				
				if(empty($this->data['User']['document_id_'.$j])){
					$message.= 'Title empty. ';
					$invalid = 1;	
				}
				
				if(empty($this->data['User']['document_'.$j]['name'])){
					$invalid = 1;
					$message.= 'Document Empty. ';
				}
				
				
				if(!empty($this->data['User']['document_'.$j]['name'])){
					$image_type = @getimagesize($this->data['User']['document_'.$j]['tmp_name']);
					
					$file_type = array('image/jpg','image/jpeg','image/gif','image/png','image/bmp');
					if(!in_array($image_type['mime'],$file_type))
					{
						$invalid = 1;
						$message.= 'Invalid Image. Supported format gif, jpeg, jpg, png,bmp.';
					}	
				}
				if($invalid==1)
				{
						$this->invalidate('document_id_1', $message);
						return false;	
				}
			}
			
			
		endfor;
		return true;
		
	}
	
	//document edit
	public function checkdocumentEdit(){
		//debug($this->data);exit;
		$message = '';
		$invalid = 0;
		 for($i=1;$i<=$this->data['User']['doc_count'];$i++){
			if(!empty($this->data['User']['doc_name_'.$i]['name'])){
				
				if(empty($this->data['User']['doc_title_'.$i])){
					$message.= 'Title empty. ';
					$invalid = 1;	
				}
				
				if(empty($this->data['User']['doc_name_'.$i]['name'])){
					$invalid = 1;
					$message.= 'Document Empty. ';
				}
				
				
				if(!empty($this->data['User']['doc_name_'.$i]['name'])){
					$image_type = @getimagesize($this->data['User']['doc_name_'.$i]['tmp_name']);
					
					$file_type = array('image/jpg','image/jpeg','image/gif','image/png','image/bmp');
					if(!in_array($image_type['mime'],$file_type))
					{
						$invalid = 1;
						$message.= 'Invalid Image. Supported format gif, jpeg, jpg, png,bmp.';
					}	
				}
				if($invalid==1)
				{
						$this->invalidate('doc_name_1', $message);
						return false;	
				}
			}	
		 }
		return true;
		
	}
	
	public function check_profile_photo(){
		$message = '';
		$invalid = 0;
		 if(!empty($this->data['User']['profile_image']['name'])){
			 
					$image_type = @getimagesize($this->data['User']['profile_image']['tmp_name']);
					
					$file_type = array('image/jpg','image/jpeg','image/gif','image/png','image/bmp');
					//debug(in_array($image_type['mime'],$file_type));die;
					if(!in_array($image_type['mime'],$file_type))
					{
						$invalid = 1;
						$message.= 'Invalid Image. Supported format gif, jpeg, jpg, png,bmp.';
					}	
				}
				if($invalid==1){
						$this->invalidate('profile_image', $message);
						return false;	
				}
				
				return true;
			}
	
	
	public function check_profile_photo_edit(){
		//debug($this->data);exit;
		$message = '';
		$invalid = 0;
		
		 if(!empty($this->data['User']['profile_photo_edit']['name'])){
			 
					$image_type = @getimagesize($this->data['User']['profile_photo_edit']['tmp_name']);
					
					$file_type = array('image/jpg','image/jpeg','image/gif','image/png','image/bmp');
					//debug(in_array($image_type['mime'],$file_type));die;
					if(!in_array($image_type['mime'],$file_type))
					{
						$invalid = 1;
						$message.= 'Invalid Image. Supported format gif, jpeg, jpg, png,bmp.';
					}	
				}
				if($invalid==1){
						$this->invalidate('profile_photo_edit', $message);
						return false;	
				}
				
	return true;
	}
	
	public function beforeSave($options = array()) {
		//debug($this->data[$this->alias]['password']);die;
    if (isset($this->data[$this->alias]['password'])) {
        $passwordHasher = new SimplePasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
        );
    }
    return true;
}
/*
public function isOwnedBy($post, $user) {
	
	//debug($this->field('id', array('id' => $user)));die;
    return $this->field('id', array('id' =>$post,'id' => $user)) !== false;
}
*/

	
	public $hasMany = array(
		'ServiceProviderRate' => array(
			'className' => 'ServiceProviderRate',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProviderServiceCategory' => array(
			'className' => 'ProviderServiceCategory',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ServiceProviderDocument'=>array(
			'className' => 'ServiceProviderDocument',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);
	
	public $belongsTo = array(
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Place' => array(
			'className' => 'Place',
			'foreignKey' => 'place_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	
}
