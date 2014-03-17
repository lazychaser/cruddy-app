<?php

class Product extends Eloquent {

    protected $fillable = [
        'title', 'description', 'image', 'type', 'price',
    ];

    public function categories()
    {
        return $this->belongsToMany('Category', 'product_categories');
    }

    public function parameters()
    {
        return $this->hasMany('ProductParameter', 'product_id', 'id');
    }
}