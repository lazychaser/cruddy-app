<?php

use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class StateEntity extends BaseSchema {

    protected $model = 'State';

    protected $titleAttribute = 'name';

    /**
     * Define some fields.
     *
     * @param $schema
     */
    public function fields($schema)
    {
        $schema->increments('id');
        $schema->relates('country', 'countries')->hide();
        $schema->string('name');
        $schema->timestamps();
    }

    /**
     * Define validation rules.
     *
     * @param $v
     */
    public function rules($v)
    {
        $v->rules(
        [
            'name' => 'required',
        ]);
    }
}