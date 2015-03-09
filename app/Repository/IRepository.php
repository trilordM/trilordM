<?php
/**
 * Created by PhpStorm.
 * User: shashi
 * Date: 3/7/15
 * Time: 7:50 PM
 */

interface IRepository{

    public function getById($id);
    public function getAll();
}