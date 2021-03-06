<?php

use Kalnoy\Cruddy\Schema\BaseSchema;
use Kalnoy\Cruddy\Service\Validation\FluentValidator;

class ThrottleEntity extends BaseSchema {

    protected $model = 'Throttle';

    public function fields($schema)
    {
        $schema->increments('id');
        $schema->bool('suspended');
        $schema->bool('banned');
        $schema->string('ip_address')->disable();
        $schema->datetime('suspended_at')->disable();
        $schema->datetime('banned_at')->disable();
    }

    public function columns($s)
    {
        $s->col('suspended');
        $s->col('banned');
    }

}