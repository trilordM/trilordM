<?php
App::uses('Component', 'Controller');
$components = array('Useful');

class UsefulComponent extends Component
{

    /*generate random numbers*/
    public function random_code()
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        srand((double)microtime() * 1000000);
        $i = 0;
        $pass = '';
        while ($i <= 10) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }

    /*Creating slug for the url*/
    public function stringToSlug($str)
    {
        // turn into slug
        $str = Inflector::slug($str);
        // to lowercase
        $str = ucfirst(strtolower($str));
        return $str;
    }

    public function getUserCategory($userId = null)
    {
        $category = ClassRegistry::init('ServiceCategories');
        $serviceCategories = $category->query("SELECT title FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$userId}");
        //debug($serviceCategories);
        return $serviceCategories;
    }

    //rating of provider
    public function getProviderRating($userId = null)
    {
        $Rating = ClassRegistry::init('Ratings');
        $get_rating = $Rating->query('select * from ratings Rating where user_id=' . $userId);

        foreach ($get_rating as $rating) {
            $rate_db[] = $rating;
            $sum_rates[] = $rating['Rating']['rating'];
        }
        if (@count($rate_db)) {
            $rate_times = count($rate_db);
            $sum_rates = array_sum($sum_rates);
            $rate_value = $sum_rates / $rate_times;
            $rate_bg = (($rate_value) / 5) * 100;
        } else {
            $rate_times = 0;
            $rate_value = 0;
            $rate_bg = 0;
        }
        $ratingArray = array('rating' => $rate_bg, 'people' => $rate_times, 'rating_point' => round($rate_value, 1));
        return $ratingArray;
    }

    //get max date for USD Rate
    public function getMaxUSDDate()
    {
        $USDRate = ClassRegistry::init('UsdRates');
        $today_date = '"' . date('Y-m-d') . '"';
        $get_rate = $USDRate->query('SELECT *
										FROM   usd_rates
										WHERE  rate_date = (SELECT max(rate_date)
														  FROM usd_rates
                 							 WHERE rate_date <=' . $today_date . ')');

        return $get_rate[0]['usd_rates']['rate'];
    }


    public function CalculateAmount($userId = null)
    {
        $Deposits = ClassRegistry::init('ServiceSeekerDeposits');
        /*$total_deposit_amount = $Deposits->query("select SUM(amount_nrs) Deposit from service_seeker_deposits where user_id='{$userId}'");


        $Paid = ClassRegistry::init('SeekerProviderRequests');
        $total_freeze_amount = $Paid->query("select SUM(freeze_amount) Freeze from seeker_provider_requests where service_seeker_id='{$userId}'");

        $total_completion_amount = $Paid->query("select SUM(completion_amount) Complete from seeker_provider_requests where service_seeker_id='{$userId}'");*/

        $totalDeposits = $Deposits->query("Select SUM(SSD.amount_nrs) Deposit from service_seeker_deposits  SSD where SSD.user_id='{$userId}' and SSD.status='Success'");
        $getRequestDeposits = $Deposits->query("select SUM(SPR.freeze_amount) Freeze,SUM(SPR.completion_amount) Complete
								from seeker_provider_requests  SPR
								
					 where SPR.service_seeker_id='{$userId}'");
        $getPackageDeposits = $Deposits->query("select SUM(SSPR.freezed_amount) PackageFreezed,
								SUM(SSPR.completed_amount) PacakageCompleted
								from service_package_requests SSPR
								
					 where SSPR.seeker_id ='{$userId}'");

        $remaining_balance = $totalDeposits[0][0]['Deposit'] - $getRequestDeposits[0][0]['Freeze'] - $getRequestDeposits[0][0]['Complete'] - $getPackageDeposits[0][0]['PackageFreezed'] - $getPackageDeposits[0][0]['PacakageCompleted'];

        return $remaining_balance;

    }

    //available balance
    public function availableAmount($userId = null)
    {

        $Deposits = ClassRegistry::init('ServiceSeekerDeposits');
        /*$total_deposit_amount = $Deposits->query("select SUM(amount_nrs) Deposit from service_seeker_deposits where user_id='{$userId}'");


        $Paid = ClassRegistry::init('SeekerProviderRequests');
        $total_freeze_amount = $Paid->query("select SUM(freeze_amount) Freeze from seeker_provider_requests where service_seeker_id='{$userId}'");

        $total_completion_amount = $Paid->query("select SUM(completion_amount) Complete from seeker_provider_requests where service_seeker_id='{$userId}'");*/
        $remaining_balance = array();
        $totalDeposits = $Deposits->query("Select SUM(SSD.amount_nrs) Deposit from service_seeker_deposits  SSD where SSD.user_id='{$userId}' and SSD.status='Success'");
        $getRequestDeposits = $Deposits->query("select SUM(SPR.freeze_amount) Freeze,SUM(SPR.completion_amount) Complete
								from seeker_provider_requests  SPR
								
					 where SPR.service_seeker_id='{$userId}'");
        $getPackageDeposits = $Deposits->query("select SUM(SSPR.freezed_amount) PackageFreezed,
								SUM(SSPR.completed_amount) PacakageCompleted
								from service_package_requests SSPR
								
					 where SSPR.seeker_id ='{$userId}'");

        $freezedAmount = $getRequestDeposits[0][0]['Freeze'] + $getPackageDeposits[0][0]['PackageFreezed'];
        $usedBalance = $getRequestDeposits[0][0]['Complete'] + $getPackageDeposits[0][0]['PacakageCompleted'];
        $available_balance = $totalDeposits[0][0]['Deposit'] - $getRequestDeposits[0][0]['Freeze'] - $getRequestDeposits[0][0]['Complete'] - $getPackageDeposits[0][0]['PackageFreezed'] - $getPackageDeposits[0][0]['PacakageCompleted'];
        $remaining_balance = array(
            'RemainBalance' => $available_balance,
            'FreezedAmount' => $freezedAmount,
            'TotalDeposit' => $totalDeposits[0][0]['Deposit'],
            'UsedBalance' => $usedBalance
        );
        return $remaining_balance;

    }

    //for auto suggest
    public function getSuggestionList()
    {
        $User = ClassRegistry::init('Users');
        $providerList = $User->query("select id,name from users where role='ServiceProvider'");
        $data = array();
        $i = 0;
        foreach ($providerList as $provider):
            $data[$i]['id'] = $provider['users']['id'];
            $data[$i]['name'] = $provider['users']['name'];
            $i++;
        endforeach;

        return $data;
    }

    public function provider_name($id = null)
    {
        $User = ClassRegistry::init('Users');
        $providerList = $User->query("select id,name from users where role='ServiceProvider' and id='$id'");
        $data = array();
        $i = 0;
        foreach ($providerList as $provider):
            $data[$i]['id'] = $provider['users']['id'];
            $data[$i]['name'] = $provider['users']['name'];
            $i++;
        endforeach;

        return $data;
    }


    public function company_name($id = null)
    {
        $User = ClassRegistry::init('Users');
        $providerList = $User->query("select id,name from users where role='ServiceProvider' and id='$id'");
        $data = array();
        $i = 0;
        foreach ($providerList as $provider):
            $data[$i]['id'] = $provider['users']['id'];
            $data[$i]['name'] = $provider['users']['name'];
            $i++;
        endforeach;

        return $data;
    }


    public function getProviderSuggestionList($id = null)
    {
        $Provider = ClassRegistry::init('service_package_assigned_providers');
        $User = ClassRegistry::init('Users');
        $provider_id = $Provider->query("SELECT GROUP_CONCAT(provider_id) ProviderIds FROM service_package_assigned_providers where service_package_request_id ='$id'");
        //debug($provider_id);die;

        if (!empty($provider_id[0][0]['ProviderIds'])) {
            $providerList = $User->query("select id,name from users where role='ServiceProvider' and id not in (" . $provider_id[0][0]['ProviderIds'] . ")");
            $data = array();
            $i = 0;
            foreach ($providerList as $provider):
                $data[$i]['id'] = $provider['users']['id'];
                $data[$i]['name'] = $provider['users']['name'];
                $i++;
            endforeach;
        } else {

            $providerList = $User->query("select id,name from users where role='ServiceProvider'");
            $data = array();
            $i = 0;
            foreach ($providerList as $provider):
                $data[$i]['id'] = $provider['users']['id'];
                $data[$i]['name'] = $provider['users']['name'];
                $i++;
            endforeach;
        }

        return $data;
    }

    public function getSeekerSuggestionList()
    {
        $User = ClassRegistry::init('Users');
        $providerList = $User->query("select id,name from users where role='ServiceSeeker' and status=1");
        $data = array();
        $i = 0;
        foreach ($providerList as $provider):
            $data[$i]['id'] = $provider['users']['id'];
            $data[$i]['name'] = $provider['users']['name'];
            $i++;
        endforeach;

        return $data;
    }

    public function getSearchplaceSuggestionList()
    {
        $User = ClassRegistry::init('Users');
        $addressList = $User->query("select distinct temporary_address from users where role='ServiceProvider'");
        $data = array();
        $i = 0;
        foreach ($addressList as $address):
            //$data[$i]['id'] = $address['users']['id'];
            $data[$i]['name'] = $address['users']['temporary_address'];
            $i++;
        endforeach;
        //debug($data);
        return $data;
    }

    public function getSearchjobSuggestionList()
    {
        $User = ClassRegistry::init('ServiceCategory');
        $categoriesList = $User->query("select id,title from service_categories");
        $data = array();
        $i = 0;
        foreach ($categoriesList as $categories):
            $data[$i]['id'] = $categories['service_categories']['id'];
            $data[$i]['name'] = $categories['service_categories']['title'];
            $i++;
        endforeach;

        return $data;
    }

    public function getPlaceSuggestionList()
    {
        $Place = ClassRegistry::init('Place');
        $placeList = $Place->query("select Place.id,concat_ws('-',Place.name,District.name)PlaceName from places as Place inner join districts as District on District.id=Place.district_id");

        $data = array();
        $i = 0;
        foreach ($placeList as $place):
            $data[$i]['id'] = $place['Place']['id'];
            //$data[$i]['district_id'] = $place['places']['district_id'];
            $data[$i]['name'] = $place[0]['PlaceName'];
            $i++;
        endforeach;

        return $data;
    }

    public function PlaceSuggestionList($name = null)
    {
        $Place = ClassRegistry::init('Place');
        $placeList = $Place->query("select Place.id,concat_ws('-',Place.name,District.name)PlaceName from places as Place inner join districts as District on District.id=Place.district_id where concat_ws('-',Place.name,District.name) like '%$name%'");


        $data = array();
        $i = 0;
        foreach ($placeList as $place):
            $data[$i]['id'] = $place['Place']['id'];
            //$data[$i]['district_id'] = $place['places']['district_id'];
            $data[$i]['name'] = $place[0]['PlaceName'];
            $i++;
        endforeach;

        return $data;
    }


    public function getCompanySuggestionList()
    {
        $User = ClassRegistry::init('User');
        $CompanyList = $User->query("select id,name from users where role='ServiceProvider' and registered_as ='company'");
        //debug($CompanyList);die;
        $data = array();
        $i = 0;
        foreach ($CompanyList as $Company):
            $data[$i]['id'] = $Company['users']['id'];
            //$data[$i]['district_id'] = $place['places']['district_id'];
            $data[$i]['name'] = $Company['users']['name'];
            $i++;
        endforeach;

        return $data;
    }
    public function checkMobileNumber($seeker_number){
        $seeker_mob_num = '';
        if (is_numeric($seeker_number)) {
            $number_digit = strlen($seeker_number);
            if ($number_digit == 10) {
                $digit = substr($seeker_number, 0, 2);
                if ($digit == '98') {
                    $seeker_mob_num = $seeker_number;
                }
            }
            if ($number_digit == 13) {
                $digit = substr($seeker_number, 0, 5);
                if ($digit == '97798') {
                    $seeker_mob_num = $seeker_number;
                }
            }
        }
        return $seeker_mob_num;
    }
    public function getCompanyName(){
        return "trilordMarket";
    }
    public function sendEmail($emailTo, $subject, $template, $vars = array(), $config = "default", $format = "html"){
        $this->autoRender = false;

        $Email = new CakeEmail();
        $Email->config($config);
        $Email->viewVars($vars);
        $Email->from(array(MAIL_FROM => COMPANY_NAME))
            ->to($emailTo)
            ->subject($subject)
            ->emailFormat($format)
            ->template($template, $template)
            ->send();

    }


}
	
	