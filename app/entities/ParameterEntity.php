<?php

use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class ParameterEntity extends BaseSchema {

    /**
     * @inheritdoc
     *
     * @type string
     */
    protected $model = 'Parameter';

    /**
     * @inheritdoc
     *
     * @type string
     */
    protected $titleAttribute = 'name';

    /**
     * @inheritdoc
     *
     * @var string
     */
    protected $defaultOrder = 'name';

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
        $s->string('name')->required();
        $s->timestamps();
    }

    /**
     * @inheritdoc
     *
     * @param 
     *
     * @return void
     */
    public function columns($s)
    {
        $s->col('id');
        $s->col('name');
        $s->col('updated_at')->orderDirection('desc');
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
            'name' => 'required',
        ]);
    }
}