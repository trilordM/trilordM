<?php
/**
 * Created by PhpStorm.
 * User: shashi
 * Date: 3/7/15
 * Time: 8:28 PM
 */

App::uses('BaseRepository', 'Repository/Impl');
App::uses('IUser', 'Repository');
App::uses('CakeEvent', 'Event');

class UserRepository extends BaseRepository implements IUser
{
    public function create($data)
    {
        $data['User']['created_date'] = date('Y-m-d');
        $data['User']['role'] = 'ServiceSeeker';
        $name = $data['User']['name'];

        //creates a unique id with the $user' prefix
        $usercode = uniqid($name);

        $data['User']['registration_code'] = $usercode;
        $data['User']['status'] = '0';
        $data['User']['profile_visibility'] = '1';

        if ($this->Model->save($data)) {
            $event = new CakeEvent('Repository.User.registered', $this, array(
                'data' => $data['User']
            ));
            $this->Model->getEventManager()->dispatch($event);
            return 1;
        }
        return 0;
    }

    public function update($data)
    {
        $this->Model->save($data);
    }
}