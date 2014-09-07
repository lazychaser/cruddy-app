<?php

/**
 * Model ProductParameter
 */
class ProductParameter extends Eloquent {

    protected $table = 'product_parameters';

    protected $fillable = ['value', 'order'];

    public $timestamps = false;

    public function parameter()
    {
        return $this->belongsTo('Parameter', 'parameter_id', 'id', 'parameter');
    }

    public function translations()
    {
        return $this->hasMany('Translation', 'product_parameter_id', 'id');
    }

}