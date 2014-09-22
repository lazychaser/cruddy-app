<?php

use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class GroupEntity extends BaseSchema {

    protected $model = 'Group';

    protected $titleAttribute = 'name';

    protected $defaultOrder = 'name';

    public function fields($schema)
    {
        $schema->increments('id');
        $schema->string('name');
        $schema->code('permissions_string');
        $schema->timestamps();
    }

    public function columns($schema)
    {
        $schema->col('id');
        $schema->col('name');
    }

    public function rules($v)
    {
        $v->rules(
        [
            'name' => 'required|max:255',
        ]);
    }
}