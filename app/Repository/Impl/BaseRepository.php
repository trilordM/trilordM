<?php
/**
 * Created by PhpStorm.
 * User: shashi
 * Date: 3/7/15
 * Time: 8:06 PM
 */

App::uses('IRepository', 'Repository');


abstract class BaseRepository implements IRepository{

    protected $Model;

    public function __construct($model) {
        $this->Model = $model;
    }

    public function GetById($id) {
        return $this->Model->find('first', array('conditions' => array('id' => $id)));
    }

    public function GetAll() {
        return $this->Model->find('all');
    }



}