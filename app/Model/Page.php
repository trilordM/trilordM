<?php
App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class Page extends AppModel
{

    public $useTable = false;

    public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array())
    {
        //$conditions=implode(' and ',$conditions);
        if ($conditions != null) {
            $condition = implode(' and ', $conditions);

        }

        //debug($conditions);die;
        $pageLimit = ($page - 1) * $limit;

        $recursive = -1;

        $sql = "SELECT U.id as __id, U.name as __name, U.temporary_address as __temporary_address, concat_ws(' - ',Place.name,District.name) as __placename,U.about_me as __aboutme,U.profile_photo as __profilephoto, group_concat(distinct(SC.title)) as __categories  FROM `users` U
        inner join places as Place on Place.id = U.place_id
		inner join districts as District on District.id = Place.district_id
		Left JOIN provider_service_categories PSC on PSC.user_id = U.id
		Left JOIN service_categories SC on PSC.service_categories_id = SC.id where U.role ='Serviceprovider' and U.status ='1' and U.profile_visibility = '1' {$condition}";

        if ((sizeof($conditions) > 2) && ($conditions[0] !== "" && $conditions[1] !== "")) {
            $sql .= " union ";
            $sql .= "SELECT U.id as __id, U.name as __name, U.temporary_address as __temporary_address, concat_ws(' - ',Place.name,District.name) as __placename,U.about_me as __aboutme,U.profile_photo as __profilephoto, group_concat(distinct(SC.title)) as __categories  FROM `users` U
            inner join places as Place on Place.id=U.place_id
            inner join districts as District on District.id=Place.district_id
            Left JOIN provider_service_categories PSC on PSC.user_id=U.id
            Left JOIN service_categories SC on PSC.service_categories_id= SC.id where U.role='Serviceprovider' and U.status='1' and U.profile_visibility='1'and {$conditions[2]}";
        }

        $sql .= " group by U.id DESC limit {$pageLimit},{$limit}";

        $this->recursive = $recursive;
        $results = $this->query($sql);

        return $results;

    }

    public function paginateCount($conditions = null, $recursive = 0, $extra = array())
    {
        //$conditions=implode(' and ',$conditions);
        if ($conditions != null) {
            $condition = implode(' and ', $conditions);

        }

        $recursive = -1;

        $sql = "SELECT U.id as __id, U.name as __name, U.temporary_address as __temporary_address, concat_ws(' - ',Place.name,District.name) as __placename,U.about_me as __aboutme,U.profile_photo as __profilephoto, group_concat(distinct(SC.title)) as __categories  FROM `users` U
        inner join places as Place on Place.id=U.place_id
		inner join districts as District on District.id=Place.district_id
		Left JOIN provider_service_categories PSC on PSC.user_id=U.id
		Left JOIN service_categories SC on PSC.service_categories_id= SC.id where U.role='Serviceprovider' and U.status='1' and U.profile_visibility='1' {$condition}";

        if ((sizeof($conditions) > 2) && ($conditions[0] !== "" && $conditions[1] !== "")) {
            $sql .= " union ";
            $sql .= "SELECT U.id as __id, U.name as __name, U.temporary_address as __temporary_address, concat_ws(' - ',Place.name,District.name) as __placename,U.about_me as __aboutme,U.profile_photo as __profilephoto, group_concat(distinct(SC.title)) as __categories  FROM `users` U
            inner join places as Place on Place.id=U.place_id
            inner join districts as District on District.id=Place.district_id
            Left JOIN provider_service_categories PSC on PSC.user_id=U.id
            Left JOIN service_categories SC on PSC.service_categories_id= SC.id where U.role='Serviceprovider' and U.status='1' and U.profile_visibility='1'and {$conditions[2]}";
        }

        $sql .= " group by U.id DESC";

        $this->recursive = $recursive;
        $results = $this->query($sql);

        return count($results);


    }

}
