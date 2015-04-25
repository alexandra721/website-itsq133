<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 4/25/15
 * Time: 11:34 AM
 */
class Location extends Eloquent {
    protected $table = 'locations';

    public function articles(){
        return $this->hasMany('Location');
    }
}