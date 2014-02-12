<?php

use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class AddressEntity extends BaseSchema {

    protected $model = 'Address';

    protected $titleAttribute = 'address';

    public function fields($schema)
    {
        $schema->increments('id');
        $schema->string('address')->required();
    }

    public function rules($v)
    {
        $v->rules(['address' => 'required']);
    }
}