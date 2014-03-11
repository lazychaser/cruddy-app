<?php

/**
 * Model State
 */
class State extends Eloquent {

    protected $table = 'states';

    protected $fillable = ['name'];

    public function country()
    {
        return $this->belongsTo('Country', 'country_id', 'id', 'country');
    }

}