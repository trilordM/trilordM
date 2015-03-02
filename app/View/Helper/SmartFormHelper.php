<?php
App::uses('AppHelper', 'View/Helper');


class SmartFormHelper extends AppHelper {
   var $helpers = array('Form');
  
	
	public function getProviderInfo($userId=null,$previousId)
	{
		$users = ClassRegistry::init('Users');
		$sql = $users->query('select * from users where id='.$userId);
		if(!empty($sql[0]['users']['name'])){
		$user_info = '<a href="'.SITE_URL.'/users/provider/'.$userId.'/'.$previousId.'">'.$sql[0]['users']['name'].'</a>';
		return $user_info;
		}
	}
	
	public function getUserInfo($userId=null)
	{
		//debug($userId);die;
		$users = ClassRegistry::init('Users');
		$sql = $users->query('select * from users where id='.$userId);
		if(!empty($sql)){
		$user_info = $sql[0]['users']['name'];
		}else{
		$user_info=null;	
		}
		
		return $user_info;	
	}
	
		
	
	public function getServiceInfo($joblist=null)
	{ //debug($joblist);die;
		$category = ClassRegistry::init('provider_service_categories');
		$sql = $category->query('select count(user_id) count from provider_service_categories where service_categories_id='.$joblist);
		//debug($sql);die;
		$user_count = $sql[0][0]['count'];
		return $user_count;	
	}
	
	public function getUserCategory($userId=null)
	{
		$category = ClassRegistry::init('ServiceCategories');
		$serviceCategories = $category->query("SELECT title FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$userId}");
		//debug($serviceCategories);
		return $serviceCategories;	
	}
	
	
	public function ProviderCategory($userId=null)
	{
		$category = ClassRegistry::init('ServiceCategories');
		$serviceCategories = $category->query("SELECT group_concat(title) title FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$userId}");
		//debug($serviceCategories);
		return $serviceCategories;	
	}
	
	public function getsubcategories($category_id=null)
	{
		$category = ClassRegistry::init('ServiceCategories');
		$subcategories = $category->query("SELECT title FROM `service_categories` where service_categories.parent_id={$category_id}");
		return $subcategories;	
	}
	
	//rating of provider
		public function getProviderRating($userId=null)
		{
			$Rating = ClassRegistry::init('Ratings');
			$get_rating = $Rating->query('select * from ratings Rating where user_id='.$userId);
			
			foreach($get_rating as $rating){
                    $rate_db[] = $rating;
                    $sum_rates[] = $rating['Rating']['rating'];
            }
			if(@count($rate_db)){
				$rate_times = count($rate_db);
				$sum_rates = array_sum($sum_rates);
				$rate_value = $sum_rates/$rate_times;
				$rate_bg = (($rate_value)/5)*100;
			}else{
				$rate_times = 0;
				$rate_value = 0;
				$rate_bg = 0;
			}
			$ratingArray = array('rating'=>$rate_bg,'people'=>$rate_times,'rating_point'=>round($rate_value,1));
			return $ratingArray;	
		}
		
		public function getIndividualProviderRating($userId=null,$seekerId=null,$request_id=null)
		{
			
			$Rating = ClassRegistry::init('Ratings');
			$get_rating = $Rating->query("select * from ratings Rating where user_id='$userId'and seeker_id='$seekerId' and request_id='$request_id'");
			//debug($get_rating[0]['Rating']['rating']);
			foreach($get_rating as $rating){
                    $rate_db[] = $rating;
                    $sum_rates[] = $rating['Rating']['rating'];
            }
			if(@count($rate_db)){
				$rate_times = count($rate_db);
				$sum_rates = array_sum($sum_rates);
				$rate_value = $sum_rates/$rate_times;
				$rate_bg = (($rate_value)/5)*100;
			}else{
				$rate_times = 0;
				$rate_value = 0;
				$rate_bg = 0;
			}
			//$rate=$get_rating[0]['Rating']['rating'];
			$ratingArray = array('rating'=>$rate_bg,'rating_point'=>round($rate_value,1));
			
			//debug($get_rating[0]['Rating']['rating']);die;
			//debug($ratingArray);//die;
			return $ratingArray;	
			/*
                    $rates =$get_rating[0]['Rating']['rating'];
					return $rates;*/
		}
		
/*
call in veiw
echo $this->SmartForm->nepaliDate('data[Model][field]','value from database');
*/		
						
		public function nepaliDate($title, $value=null){
			
			if(!empty($value))
			{
				$arr = explode('-',$value);
				$yearSel = $arr[0];
				$monSel = $arr[1];
				$daySel = $arr[2];
				//debug($arr);
			}else{
				$yearSel = '';
				$monSel = '';
				$daySel = '';	
			}
			//month
			
			$months = array(
									'01'=>'Baishak',
									'02'=>'Jestha',
									'03'=>'Ashad',
									'04'=>'Shrawn',
									'05'=>'Bhadra',
									'06'=>'Aswin',
									'07'=>'Kartik',
									'08'=>'Mangsir',
									'09'=>'Poush',
									'10'=>'Magh',
									'11'=>'Falgun',
									'12'=>'Chaitra'
						);	
			echo '<select name="'.$title.'[month]" id="month">';
				echo '<option value="">Month</option>';
				foreach($months as $key=>$month)
				{
					//$months = str_pad($month, 2, '0',  STR_PAD_LEFT);
					echo '<option value="'.$key.'" '.($monSel == $key ? ' selected="selected"' : '').'>'.$month.'</option>';
				}
			echo '</select>';
			//days
			echo '&nbsp;<select name="'.$title.'[day]" id="day">';
				echo '<option value="">Day</option>';
				foreach(range(1,32) as $day)
				{
					$days = str_pad($day, 2, '0',  STR_PAD_LEFT);
					echo '<option value="'.$days.'" '.($daySel == $days ? ' selected="selected"' : '').'>'.$days.'</option>';
				}
			echo '</select>';
			//year
			echo '&nbsp;<select name="'.$title.'[year]" id="year">';
				echo '<option value="">Year</option>';
				foreach(range(2000,2080) as $years)
				{
					//$years = str_pad($year, 2, '0',  STR_PAD_LEFT);
					echo '<option value="'.$years.'" '.($yearSel == $years ? ' selected="selected"' : '').'>'.$years.'</option>';
				}
			echo '</select>';
		
		
		}
		
		public function RecursiveCategories($array,$checked=null) { 
			
			if(count($checked)<1)
				$checked = array();
			$i =0;
			if (count($array)) { 
				echo "\n<ul>\n"; 
				//debug($checked);die;
				
				foreach ($array as $vals) { 
				//debug($checked);
					$i++; 
					
					echo "<li>".$this->Form->checkbox('category_id_'.$i, array('checked' =>in_array($vals['ServiceCategory']['id'],$checked, true)?true:false,'hiddenField'=>false,'name'=>'data[User][category_id][]','value'=>$vals['ServiceCategory']['id'],'id'=>'category','class'=>'default')).$vals['ServiceCategory']['title']; 
					
					if (count($vals['children'])) { 
						
						$this->RecursiveCategories($vals['children'],$checked); 
					} 
					echo "</li>\n"; 
					
				} 
				echo "</ul>\n"; 
			} 
		}
		
	public function getReviewCount($review_id=null)
	{
		$review = ClassRegistry::init('Reviews');
		$reviewCount = $review->query("SELECT count(id) ID FROM reviews where reviews.request_id={$review_id}");
		//debug($reviewCount);
		return $reviewCount[0][0]['ID'];	
	}	
	
	public function getDistrict()
	{
		$district = ClassRegistry::init('District');
		$District = $district->query("SELECT id,name FROM districts order by name asc");
		//$District=explode(',',$District[0][0]['Name']);
		//debug($District);die;
		/*foreach($District as $districts){
			
		
		}*/
		$data = array();
		foreach($District as $list):
			$data[$list['districts']['id']] = $list['districts']['name'];
		endforeach;
		
		
		return $data;	
	}	
	
		
}
?>