<?php

use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class CountryEntity extends BaseSchema {

    protected $model = 'Country';

    /**
     * The name of the column that is used to convert a model to a string.
     *
     * @var string
     */
    protected $titleAttribute = 'name';

    /**
     * The name of the column that will sort data by default.
     *
     * @var string
     */
    protected $defaultOrder = 'name';

    /**
     * Define some fields.
     *
     * @param $schema
     */
    public function fields($schema)
    {
        $schema->increments('id');
        $schema->string('name');
        $schema->embed('states', 'states');
        $schema->timestamps();
    }

    /**
     * Define some columns.
     *
     * @param $schema
     */
    public function columns($schema)
    {
        $schema->col('id');
        $schema->col('name');
        $schema->col('updated_at')->orderDirection('desc');
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