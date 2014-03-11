<?php

/**
 * Model Country
 */
class Country extends Eloquent {

    protected $table = 'countries';

    protected $fillable = ['name'];

    public function states()
    {
        return $this->hasMany('State', 'country_id', 'id');
    }

}