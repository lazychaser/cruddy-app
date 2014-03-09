<?php

use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class ProductParameterEntity extends BaseSchema {

    /**
     * @inheritdoc
     *
     * @type string
     */
    protected $model = 'ProductParameter';

    /**
     * @inheritdoc
     *
     * @param 
     *
     * @return void
     */
    public function fields($s)
    {
        $s->increments('id');
        $s->relates('parameter', 'parameters')->required()->label('Test label');
        $s->string('value')->required();
        $s->string('order');
    }

    /**
     * @inheritdoc
     *
     * @param \Kalnoy\Cruddy\Service\Validation\FluentValidator 
     *
     * @return void
     */
    public function rules($v)
    {
        $v->rules(
        [
            'parameter' => 'required|exists:parameters,id',
            'value' => 'required',
        ]);
    }
}