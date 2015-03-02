<?php


App::uses('Helper', 'View');
class RatingHelper extends AppHelper {
	
	var $helpers = array('Form');
	
	public function getproviderRating($userId=null,$seekerId=null,$request_id=null)
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

}